<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
                        'message' => 'Credenciais inválidas'
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
                'message' => 'Credenciais inválidas'
            ];
        }
    }
}
