<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importar a classe Authenticatable

class AppUserModel extends Authenticatable // Mude aqui para estender Authenticatable
{
    protected $table = 'app_users';

    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }

}
