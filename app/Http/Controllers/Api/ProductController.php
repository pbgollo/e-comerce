<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductModel;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Produto A"),
 *     @OA\Property(property="stock", type="object"),
 *     @OA\Property(property="supplier", type="object"),
 *     @OA\Property(property="images", type="array", @OA\Items(type="object"))
 * )
 */

class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     summary="Retorna uma lista de produtos pelos IDs",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="ids",
     *         in="query",
     *         description="Lista de IDs de produtos separados por vírgula. Ex: 1,2,3",
     *         required=true,
     *         @OA\Schema(type="string", example="1,2,3")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos retornada com sucesso",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Product"))
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida (sem parâmetro 'ids')"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $ids = $request->query('ids');

        if ($ids) {
            $productIds = explode(',', $ids);
            $products = ProductModel::with(['stock', 'supplier', 'images'])
                ->whereIn('id', $productIds)
                ->get();
            return response()->json($products);
        }

        return response()->json([], 400); // Bad Request
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Retorna os detalhes de um produto específico",
     *     tags={"Produtos"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto encontrado",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $product = ProductModel::with(['stock', 'supplier', 'images'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($product);
    }
}
