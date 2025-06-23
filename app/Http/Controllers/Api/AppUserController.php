<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Tag(
 *     name="App Users",
 *     description="Endpoints de autenticação e cadastro de usuários do aplicativo"
 * )
 */
class AppUserController extends Controller {

    /**
     * Realiza o login de um usuário.
     *
     * @OA\Post(
     *     path="/api/app-user/login",
     *     summary="Login de usuário do app",
     *     tags={"App Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="usuario@email.com"),
     *             @OA\Property(property="password", type="string", format="password", example="123456")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Resultado do login",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Falha ao autenticar-se", nullable=true)
     *         )
     *     )
     * )
     */
    public function login(Request $request){
        $data = $request->all();

        $user = AppUserModel::where('email', $data['email'])->first();

        if (!is_null($user)) {
            $user = $user->makeVisible('password');

            if ($user->active) {
                if (Hash::check($data['password'], $user->password)) {
                    return [
                        'success' => true
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Falha ao autenticar-se'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Falha ao autenticar-se'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Falha ao autenticar-se'
            ];
        }
    }

    /**
     * Registra um novo usuário.
     *
     * @OA\Post(
     *     path="/api/app-user/register",
     *     summary="Cadastro de novo usuário",
     *     tags={"App Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="João Silva"),
     *             @OA\Property(property="email", type="string", format="email", example="joao@email.com"),
     *             @OA\Property(property="password", type="string", format="password", example="123456")
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:app_users,email',
            'password' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Erro de validação',
                'errors'  => $validator->errors(),
            ];
        }

        $user = new AppUserModel();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->active   = true;
        $user->save();

        return [
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'user_id' => $user->id,
        ];
    }
}
