<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\CategoryModel;
use App\Models\ProductImagesModel;

class ProductImagesController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = ProductImagesModel::class;

        $this->title = 'Imagens do produto';

        $this->search = ['name'];

        $this->sortable = 'position';

        $this->fk = 'product_id';

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
                ],
            ],
        ];
    }
}
