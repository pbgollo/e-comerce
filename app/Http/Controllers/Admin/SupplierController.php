<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupplierModel;

class SupplierController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = SupplierModel::class;

        $this->title = 'Fornecedores';

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
            ]
        ];

        $this->form = [
            [
                'title' => 'Fornecedor',
                'icon' => 'group',
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
