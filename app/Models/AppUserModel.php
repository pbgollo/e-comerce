<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUserModel extends Authenticatable
{
    protected $table = 'app_users';

    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }

}
