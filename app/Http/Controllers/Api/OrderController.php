<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use App\Models\EvaluationUserModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\StockModel;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="Pedidos",
 *     description="Endpoints relacionados à realização de pedidos"
 * )
 */
class OrderController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/orders",
     *     summary="Cria um novo pedido",
     *     tags={"Pedidos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"items"},
     *             @OA\Property(
     *                 property="items",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     required={"product_id", "quantity"},
     *                     @OA\Property(property="product_id", type="integer", example=1),
     *                     @OA\Property(property="quantity", type="integer", example=2)
     *                 )
     *             ),
     *             @OA\Property(property="isPix", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pedido criado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Pedido realizado com sucesso!"),
     *             @OA\Property(property="order_id", type="integer", example=1),
     *             @OA\Property(property="total", type="number", format="float", example=99.90)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação ou produto sem estoque",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $user = $this->getAuthenticatedUserFromToken($request);

        $validator = Validator::make($request->all(), [
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'isPix' => 'sometimes|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422);
        }

        $isPix = $request->boolean('isPix', false);

        $total = 0;
        $itensValidados = [];

        foreach ($request->items as $item) {
            $stock = StockModel::where('product_id', $item['product_id'])->first();

            if (!$stock || $stock->quantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => "Produto {$item['product_id']} sem estoque."
                ], 400);
            }

            if ($stock->quantity < $item['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => "Estoque insuficiente para o produto {$item['product_id']}. Disponível: {$stock->quantity}",
                    'available_quantity' => $stock->quantity
                ], 400);
            }

            $preco = $stock->promotion_active ? $stock->promotion_price : $stock->price;
            $subtotal = $item['quantity'] * $preco;
            $total += $subtotal;

            $itensValidados[] = [
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $preco
            ];
        }

        if ($isPix) {
            $total *= 0.85;
        }

        $order = OrderModel::create([
            'app_user_id' => $user->id,
            'data_pedido' => now(),
            'situacao'    => 'novo'
        ]);

        foreach ($itensValidados as $item) {
            OrderItemModel::create([
                'order_id'   => $order->id,
                'product_id' => $item['product_id'],
                'quantity'   => $item['quantity'],
                'price'      => $item['price']
            ]);

            StockModel::where('product_id', $item['product_id'])->decrement('quantity', $item['quantity']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pedido realizado com sucesso!',
            'order_id' => $order->id,
            'total' => round($total, 2)
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/orders",
     *     summary="Lista os pedidos com filtro por número ou nome do cliente",
     *     tags={"Pedidos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="numero",
     *         in="query",
     *         description="Número do pedido",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="cliente",
     *         in="query",
     *         description="Nome do cliente",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de pedidos retornada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="pedidos", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $user = $this->getAuthenticatedUserFromToken($request);

        $query = OrderModel::with(['itens.product'])->orderBy('id', 'desc');

        if (!$user->admin) {
            $query->where('app_user_id', $user->id);
        }

        if ($request->filled('numero')) {
            $query->where('id', $request->numero);
        }

        if ($request->filled('cliente')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->cliente . '%');
            });
        }

        $pedidos = $query->get();

        return response()->json([
            'success' => true,
            'pedidos' => $pedidos
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/orders/{id}/status",
     *     summary="Altera o status do pedido para enviado ou cancelado",
     *     tags={"Pedidos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do pedido",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="string", example="enviado"),
     *             @OA\Property(property="data_envio", type="string", format="date-time", example="2025-07-01T15:00:00"),
     *             @OA\Property(property="data_cancelamento", type="string", format="date-time", example="2025-07-01T16:00:00")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status atualizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Status atualizado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Pedido não encontrado"
     *     )
     * )
     */
    public function updateStatus(Request $request, $id)
    {
        $user = $this->getAuthenticatedUserFromToken($request);

        if (!$user->role == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Acesso negado'
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:enviado,cancelado',
            'data_envio' => 'nullable|date',
            'data_cancelamento' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors()
            ], 422);
        }

        $pedido = OrderModel::find($id);

        if (!$pedido) {
            return response()->json([
                'success' => false,
                'message' => 'Pedido não encontrado'
            ], 404);
        }

        $pedido->situacao = $request->status;

        if ($request->status === 'enviado') {
            $pedido->data_envio = $request->data_envio ?? now();
        }

        if ($request->status === 'cancelado') {
            $pedido->data_cancelamento = $request->data_cancelamento ?? now();
        }

        $pedido->save();

        return response()->json([
            'success' => true,
            'message' => 'Status atualizado'
        ]);
    }

    private function getAuthenticatedUserFromToken(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            abort(response()->json([
                'success' => false,
                'message' => 'Token não fornecido'
            ], 401));
        }

        $token = str_replace('Bearer ', '', $token);

        try {
            $decoded = JWT::decode($token, new Key("5XwLWBbAHTu1JlJ0SosDt1liLBwiD8FDpL3G8DAe58YyA46AUGJpEdC5ogsAwm7c", 'HS256'));
            $user = AppUserModel::find($decoded->data->id);

            if (!$user) {
                abort(response()->json([
                    'success' => false,
                    'message' => 'Usuário não encontrado'
                ], 404));
            }

            return $user;
        } catch (Exception $e) {
            abort(response()->json([
                'success' => false,
                'message' => 'Token inválido ou expirado'
            ], 401));
        }
    }
}
