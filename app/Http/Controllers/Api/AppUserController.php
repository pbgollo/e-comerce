<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // Importar Auth facade
use Illuminate\Support\Facades\Session; // Importar Session facade

class AppUserController extends Controller {

    public function login(Request $request){
        $data = $request->all();

        // Validação básica para email e password
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas.',
                'errors' => $validator->errors()
            ], 422); // Unprocessable Entity
        }

        $user = AppUserModel::where('email', $data['email'])->first();

        if (!is_null($user)) {
            // Apenas para comparação, não expor a senha
            $user = $user->makeVisible('password');

            if ($user->active) {
                if (Hash::check($data['password'], $user->password)) {
                    // Login bem-sucedido: Armazenar usuário na sessão
                    Auth::login($user); // Usa o sistema de autenticação do Laravel
                    Session::put('user_name', $user->name); // Armazena o nome na sessão para fácil acesso

                    return response()->json([
                        'success' => true,
                        'message' => 'Login realizado com sucesso!',
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                        ]
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Credenciais inválidas - senha incorreta'
                    ], 401); // Unauthorized
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Falha ao autenticar-se - usuário inativo'
                ], 403); // Forbidden
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Credenciais inválidas - usuário não encontrado'
            ], 404); // Not Found
        }
    }

    public function register(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:app_users,email',
            'password' => 'required|string|min:3', // Laravel já faz hash por padrão se você usar o Auth::attempt()
        ]);

        // Se houver erro de validação, retornar erro
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors'  => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Criação do usuário
        $user = new AppUserModel();
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password; // O mutator AppUserModel::setPasswordAttribute fará o hash.
        $user->active   = true; // Ativa por padrão, ajuste conforme sua lógica
        $user->save();

        // Após o registro bem-sucedido, podemos logar o usuário automaticamente
        Auth::login($user);
        Session::put('user_name', $user->name);

        return response()->json([
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'user_id' => $user->id,
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }

    // Nova função para verificar o status do usuário
    public function userStatus(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'logged_in' => true,
                'user_name' => Session::get('user_name', Auth::user()->name) // Tenta pegar da sessão, senão do objeto Auth
            ]);
        } else {
            return response()->json([
                'logged_in' => false
            ]);
        }
    }

    // Nova função para logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalida a sessão atual
        $request->session()->regenerateToken(); // Regenera o token CSRF

        return response()->json([
            'success' => true,
            'message' => 'Logout realizado com sucesso!'
        ]);
    }
}
