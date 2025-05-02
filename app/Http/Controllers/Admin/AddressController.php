<?php

namespace App\Http\Controllers\Admin;

use App\Models\AddressModel;
use App\Models\AppUserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class AddressController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = AddressModel::class;

        $this->title = 'Endereço';

        $this->search = ['name'];

        $this->sortable = 'position';

        $this->unique = true;

        $this->fk = 'addressable';

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Rua',
                'name' => 'street',
            ],
            [
                'label' => 'Número',
                'name' => 'number',
            ],
            [
                'label' => 'Bairro',
                'name' => 'neighborhood',
            ],
        ];

        $this->form = [
            [
                'title' => 'Endereço',
                'icon' => 'road',
                'inputs' => [
                    [
                        'label' => 'Rua',
                        'name' => 'street',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Número',
                        'name' => 'number',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Complemento',
                        'name' => 'complement',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Bairro',
                        'name' => 'neighborhood',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'CEP',
                        'name' => 'zip_code',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Cidade',
                        'name' => 'city',
                        'size' => 7,
                        'validators' => 'required'
                    ],
                    [
                        'label' => 'Estado',
                        'name' => 'state',
                        'size' => 7,
                        'validators' => 'required'
                    ]
                ],
            ],
        ];
    }
}
