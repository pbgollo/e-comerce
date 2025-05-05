<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppUserModel;
use App\Models\CategoryModel;

class CategoryController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = CategoryModel::class;

        $this->title = 'Categorias de Produtos';

        $this->search = ['name'];

        $this->sortable = 'position';

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
        ];

        $this->form = [
            [
                'title' => 'Categoria',
                'icon' => 'list',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                ],
            ],
        ];
    }
}
