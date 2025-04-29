<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\Suppliers;
use App\Models\SuppliersModel;

class SuppliersController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = SuppliersModel::class;

        $this->title = 'Fornecedores';

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name',
            ]
        ];

        $this->form = [
            [
                'title' => 'Fornecedor',
                'icon' => 'group',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Ativo?',
                        'name' => 'active',
                        'input' => 'checkbox',
                        'default' => true,
                        'size' => 7,
                    ],
                    [
                        'input' => 'link',
                        'label' => 'Produtos',
                        'link' => 'admin.supplier-products',
                    ],
                ],
            ],
        ];
    }
}
