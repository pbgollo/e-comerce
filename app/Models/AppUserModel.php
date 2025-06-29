<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable; // Importar a classe Authenticatable

class AppUserModel extends Authenticatable // Mude aqui para estender Authenticatable
{
    protected $table = 'app_users';

    // Se você não tem timestamps nas suas tabelas, adicione esta linha:
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // Adicione os campos que podem ser preenchidos em massa
        'name',
        'email',
        'password',
        'active', // Se 'active' for preenchido no registro
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token', // Se você tiver um campo remember_token para "lembrar-me"
    ];

    // O seu método setPasswordAttribute já está bom para criptografar a senha
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }
}
