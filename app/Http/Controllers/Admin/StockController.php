<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddressModel;
use App\Models\AppUserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StockModel;

class StockController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = StockModel::class;

        $this->title = 'Estoque';

        $this->fk = 'product_id';

        //$this->unique = true;

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name',
            ],
            [
                'label' => 'Quantidade',
                'name' => 'quantity',
            ],
            [
                'label' => 'Preço',
                'name' => 'price',
            ],
        ];

        $this->form = [
            [
                'title' => 'Estoque',
                'icon' => 'database',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Quantidade',
                        'name' => 'quantity',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Preço',
                        'name' => 'price',
                        'size' => 7,
                        'validators' => 'required'
                    ]
                ],
            ],
        ];
    }
}
