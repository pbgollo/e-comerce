<?php

namespace App\Http\Controllers\Admin;

use App\Models\Test;

class TestController extends GenericController
{

    function __construct()
    {

        parent::__construct();

        $this->model = Test::class;

        $this->title = 'Teste upload multi idioma';

        $this->translate = true;

        $this->table = [
            [
                'label' => '#',
                'name' => 'id',
                'size' => 50
            ],
            [
                'label' => 'Nome',
                'name' => 'name'
            ]
        ];

        $this->form = [
            [
                'title' => 'Teste',
                'icon' => 'description',
                'inputs' => [
                    [
                        'label' => 'Nome',
                        'name' => 'name',
                        'translate' => true
                    ],
                    [
                        'input' => 'file',
                        'label' => 'Imagem',
                        'name' => 'image',
                        'type' => 'image',
                        'alt' => true,
                        'translate' => true
                    ],
                    [
                        'input' => 'file',
                        'label' => 'Arquivo',
                        'name' => 'file',
                        'type' => 'file',
                        'translate' => true
                    ],
                    [
                        'label' => 'Arquivo não traduzível',
                        'name' => 'not_translatable',
                        'input' => 'file',
                        'translate' => false
                    ]
                ]
            ]
        ];
    }
}
