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

        $this->search = ['name'];

        $this->sortable = 'position';

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
                        'label' => 'Descrição',
                        'name' => 'description',
                        'input' => 'textarea',
                        'inline' => true,
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
                        'label' => 'Telefone',
                        'name' => 'phone',
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
                        'link' => 'admin.products',
                        'size' => 7
                    ],
                ],
            ],
        ];
    }
}
