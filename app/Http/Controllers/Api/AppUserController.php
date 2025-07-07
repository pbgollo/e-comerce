<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use App\Models\EvaluationUserModel;
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
 *     name="Usuários",
 *     description="Endpoints de autenticação e cadastro de usuários do aplicativo"
 * )
 */
class AppUserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/app-user/login",
     *     summary="Login de usuário",
     *     description="Realiza o login do usuário fornecendo um token de autenticação em caso de sucesso.",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", description="Nome de usuário"),
     *             @OA\Property(property="password", type="string", description="Senha do usuário")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login realizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="token", type="string", description="Token JWT gerado")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Usuário ou senha inválido",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Usuário ou senha inválido")
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Usuário inativo",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Usuário inativo")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Usuário ou senha inválido")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422);
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = AppUserModel::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas'
            ], 401);
        }

        if (!$user->active) {
            return response()->json([
                'success' => false,
                'message' => 'Usuário inativo'
            ], 403);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Senha incorreta'
            ], 401);
        }

        $token = $this->generateToken($user);

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

    /**
     * Registra um novo usuário.
     *
     * @OA\Post(
     *     path="/api/app-user/register",
     *     summary="Cadastro de novo usuário",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resultado do cadastro",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Usuário cadastrado com sucesso"),
     *             @OA\Property(property="user_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Erro de validação"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:app_users,email',
            'password' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = new AppUserModel();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->active = true;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Usuário cadastrado com sucesso',
                'user_id' => $user->id
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno ao registrar usuário',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/app-user/me",
     *     summary="Obter usuário logado",
     *     description="Retorna os dados do usuário logado a partir do token JWT.",
     *     security={{"bearerAuth":{}}},
     *     tags={"Usuários"},
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Token inválido ou não fornecido",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Token inválido ou não fornecido")
     *         )
     *     )
     * )
     */
    public function getCurrentUser(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token não fornecido'
            ], 401);
        }

        $token = str_replace('Bearer ', '', $token);

        try {
            $decoded = JWT::decode($token, new Key("5XwLWBbAHTu1JlJ0SosDt1liLBwiD8FDpL3G8DAe58YyA46AUGJpEdC5ogsAwm7c", 'HS256'));

            $user = AppUserModel::find($decoded->data->id);

            if ($user) {
                return response()->json([
                    'success' => true,
                    'user' => $user
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não encontrado'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token inválido ou expirado'
            ], 401);
        }
    }

    // /**
    //  * @OA\Post(
    //  *     path="/api/app-user/logout",
    //  *     summary="Logout do usuário",
    //  *     description="Encerra a sessão do usuário (frontend deve remover o token).",
    //  *     tags={"Usuários"},
    //  *     security={{"bearerAuth":{}}},
    //  *     @OA\Response(
    //  *         response=200,
    //  *         description="Logout realizado com sucesso",
    //  *         @OA\JsonContent(
    //  *             @OA\Property(property="success", type="boolean", example=true),
    //  *             @OA\Property(property="message", type="string", example="Logout efetuado com sucesso")
    //  *         )
    //  *     )
    //  * )
    //  */
    // public function logout(Request $request)
    // {
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Logout efetuado com sucesso'
    //     ]);
    // }

    private function generateToken($user)
    {

        $token = array(
            "iat" => time(),
            "exp" => time() + (60 * 60 * 24 * 365),
            "data" => array(
                "id" => $user['id']
            )
        );

        return JWT::encode($token, "5XwLWBbAHTu1JlJ0SosDt1liLBwiD8FDpL3G8DAe58YyA46AUGJpEdC5ogsAwm7c", 'HS256');
    }


}
