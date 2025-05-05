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


/**
* @OA\Tag(
*     name="Usuários",
*     description="Usuários"
* )
*/
class AppUserController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login de usuário",
     *     description="Realiza o login do usuário fornecendo um token de autenticação em caso de sucesso.",
     *     tags={"Autenticação"},
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
    public function login(Request $request){
        $data = $request->all();

        $user = AppUserModel::where('email', $data['email'])->first();

        if (!is_null($user)) {
            $user = $user->makeVisible('password')->toArray();

            if ($user['active']) {
                if ($data['password'] == $user['password']) {
                    return [
                        'success' => true
                    ];
                } else {
                    return [
                        'success' => false,
                        'message' => 'Usuário ou senha inválido'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Usuário inativo'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'E-mail ou senha inválido'
            ];
        }
    }
}
