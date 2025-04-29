<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\SuppliersProductsModel;

class SuppliersProductsController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = SuppliersProductsModel::class;

        $this->title = 'Produtos';

        $this->fk = 'supplier_id';

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
        ];

        $this->form = [
            [
                'title' => 'Produto',
                'icon' => 'sell',
                'inputs' => [
                    [
                        'label' => 'Imagem',
                        'name' => 'image',
                        'input' => 'image',
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
                ],
            ],
        ];
    }
}
