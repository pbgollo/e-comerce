<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;


class AppUserModel extends Authenticatable
{
    protected $table = 'app_users';

    protected $fillable = [
        'image',
        'image_alt',
        'name',
        'email',
        'password',
        'phone',
        'ceredit_card',
        'role',
        'active',
    ];

    public function toArrayTranslation()
    {
        return parent::toArray();
    }


    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }

}
