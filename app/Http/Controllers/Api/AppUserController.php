<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AppUserController extends Controller {

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
                        'message' => 'Credenciais inválidas - senha incorreta'
                    ];
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Falha ao autenticar-se  - inativo'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Credenciais inválidas  -  usuário nao encontrado'
            ];
        }
    }

    public function register(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:app_users,email',
            'password' => 'required|string|min:3',
        ]);

        // Se houver erro de validação, retornar erro
        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Erro de validação',
                'errors'  => $validator->errors(),
            ];
        }

        // Criação do usuário
        $user = new AppUserModel();
        $user->name     = $request->name;
        $user->email    = $request->email;
        // $user->password = Hash::make($request->password);
        $user->password = $request->password;
        $user->active   = true; // Ativa por padrão, ajuste conforme sua lógica
        $user->save();

        return [
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso',
            'user_id' => $user->id,
        ];
    }
}
