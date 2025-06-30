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
                'label' => 'Nome do estoque',
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
            [
                'label' => 'Promoção?',
                'name' => 'promotion_active',
            ],
            [
                'label' => 'Nome',
                'name' => 'promotion_label',
            ],
            [
                'label' => 'Percentual',
                'name' => 'promotion_label',
            ],
            [
                'label' => 'Novo preço',
                'name' => 'promotion_price',
            ],
        ];

        $this->form = [
            [
                'title' => 'Estoque',
                'icon' => 'list',
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
                        'label' => 'Preço original',
                        'name' => 'price',
                        'validators' => 'required',
                        'size' => 7,
                    ],
                ],
            ],
            [
                'title' => 'Promoção',
                'icon' => 'sell',
                'inputs' => [
                    [
                        'label' => 'Nome da promoção',
                        'name' => 'promotion_label',
                        'size' => 7,
                    ],
                    [
                        'label' => 'Item em promoção?',
                        'name' => 'promotion_active',
                        'input' => 'checkbox',
                        'size' => 5,
                        'default' => false,
                    ],
                    [
                        'label' => 'Percentual',
                        'name' => 'promotion_percentage',
                        'size' => 7,
                        'validators' => 'integer',
                        'hint' => 'Apenas o valor numérico'
                    ],
                    [
                        'label' => 'Novo preço',
                        'name' => 'promotion_price',
                        'size' => 7,
                    ],
                ],
            ],
            [
                'title' => 'Pagamento',
                'icon' => 'payments',
                'inputs' => [
                    [
                        'label' => 'Formas de Pagamento',
                        'name' => 'payment_methods',
                        'input' => 'textarea',
                        'inline' => true,
                        'size' => 7,
                    ],
                    [
                        'label' => 'Benefícios',
                        'name' => 'benefit_label',
                        'size' => 7,
                        'hint' => 'Por exemplo Frete Grátis'
                    ],
                    [
                        'label' => 'Benefício ativo?',
                        'name' => 'benefit_active',
                        'input' => 'checkbox',
                        'size' => 2,
                        'default' => false,
                    ],
                ],
            ],
        ];
    }
}
