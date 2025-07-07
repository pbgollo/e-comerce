<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = ProductModel::class;

        $this->title = 'Produtos';

        $this->search = ['name'];

        $this->sortable = 'position';

        $this->fk = 'supplier_id';

        $categories = CategoryModel::get()->toArray();
        $categories = array_map(function ($value) {
            return [
                'value' => $value['id'],
                'description' => $value['name'],
            ];
        }, $categories);

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Imagem principal',
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
                        'input' => 'select',
                        'label' => 'Categoria',
                        'name' => 'category_id',
                        'data' => $categories,
                        'size' => 7,
                        'validators' => 'required',

                    ],
                    [
                        'label' => 'Imagem principal',
                        'name' => 'image',
                        'input' => 'image',
                        'validators' => 'required',
                        'size' => 7
                    ],
                    [
                        'label' => 'Imagens',
                        'input' => 'link',
                        'link' => 'admin.product-images',
                        'size' => 7,

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
                        'validators' => 'required',
                        'size' => 7,
                    ],
                    [
                        'label' => 'Especificações técnicas',
                        'name' => 'technical_details',
                        'input' => 'textarea',
                        'inline' => true,
                        'size' => 7
                    ],
                    [
                        'label' => 'Ativo?',
                        'name' => 'active',
                        'input' => 'checkbox',
                        'default' => true,
                    ],
                    [
                        'input' => 'link',
                        'label' => 'Estoque',
                        'link' => 'admin.stocks',
                        'size' => 7,
                    ],
                ],
            ],
        ];
    }
}
