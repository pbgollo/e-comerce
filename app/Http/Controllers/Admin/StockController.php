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
                'icon' => 'database',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 6,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Quantidade',
                        'name' => 'quantity',
                        'size' => 6,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Preço original',
                        'name' => 'price',
                        'validators' => 'required'
                    ],
                ],
            ],
            [
                'title' => 'Estoque | Promoção',
                'icon' => 'database',
                'inputs' => [
                    [
                        'label' => 'Item em promoção?',
                        'name' => 'promotion_active',
                        'input' => 'checkbox',
                    ],
                    [
                        'label' => 'Nome da promoção',
                        'name' => 'promotion_label',
                        'size' => 6,
                    ],
                    [
                        'label' => 'Percentual',
                        'name' => 'promotion_percentage',
                        'size' => 3,
                        'validators' => 'integer',
                        'hint' => 'Apenas o valor numérico'
                    ],
                    [
                        'label' => 'Novo preço',
                        'name' => 'promotion_price',
                        'size' => 3,
                    ],
                ],
            ],
            [
                'title' => 'Estoque | Pagamento',
                'icon' => 'database',
                'inputs' => [
                    [
                        'label' => 'Formas de Pagamento',
                        'name' => 'payment_methods',
                        'input' => 'textarea',
                        'inline' => true,
                    ],
                    [
                        'label' => 'Benefícios',
                        'name' => 'benefit_label',
                        'size' => 10,
                        'hint' => 'Por exemplo Frete Grátis'
                    ],
                    [
                        'label' => 'Benefício ativo?',
                        'name' => 'benefit_active',
                        'input' => 'checkbox',
                        'size' => 2,
                    ],
                ],
            ],
        ];
    }
}
