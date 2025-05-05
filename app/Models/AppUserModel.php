<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

class AppUserModel extends BaseModel
{
    protected $table = 'app_users';

    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {

            $this->attributes['password'] = Hash::make($value);
        }
    }

}
