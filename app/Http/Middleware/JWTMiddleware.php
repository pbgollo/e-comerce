<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\UserController;
use App\Models\AppUserModel;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class JWTMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if($request->header('Authorization')){
            try{
                $token = trim(str_replace('Bearer', '', $request->header('Authorization')));
                $decoded = JWT::decode($token, new Key("5XwLWBbAHTu1JlJ0SosDt1liLBwiD8FDpL3G8DAe58YyA46AUGJpEdC5ogsAwm7c", 'HS256'));
                // Verificamos se o usuário não tinha sido deletado, para caso ainda exista o token dele no servidor,
                // e se ele está ativo
                $user = AppUserModel::where('id', $decoded->data->id)->where('active', true)->first();
                if ($user != null) {
                    $request->attributes->add([
                        'user_id' => $user->id,
                    ]);
                }
            }catch(\Exception $e){}
        }

        return $next($request);
    }
}
