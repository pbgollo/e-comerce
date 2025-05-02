<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;

class AppUserController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = AppUserModel::class;

        $this->title = 'Usuários do Sistema';

        $this->search = ['name'];

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Imagem',
                'name' => 'image',
                'type' => 'image',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name',
            ],
            [
                'label' => 'E-mail',
                'name' => 'email',
            ],
            [
                'label' => 'Admin?',
                'name' => 'role',
            ]
        ];

        $this->form = [
            [
                'title' => 'Usuário',
                'icon' => 'person',
                'inputs' => [
                    [
                        'label' => 'Imagem',
                        'name' => 'image',
                        'input' => 'image',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'E-mail',
                        'name' => 'email',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Senha',
                        'name' => 'password',
                        'type' => 'password',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Telefone',
                        'name' => 'phone',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Cartão de Crédito',
                        'name' => 'credit_card',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Admin?',
                        'name' => 'role',
                        'input' => 'checkbox',
                        'default' => false,
                        'size' => 7,
                    ],
                    [
                        'label' => 'Ativo?',
                        'name' => 'active',
                        'input' => 'checkbox',
                        'default' => true,
                        'size' => 7,
                    ],
                ],
            ],
        ];
    }
}
