<?php

namespace App\Http\Controllers\Admin;

use App\Models\AppearanceModel;
use Intervention\Image\Size;

class AppearanceController extends GenericController
{
    function __construct()
    {

        parent::__construct();

        $this->model = AppearanceModel::class;

        $this->title = 'Aparência Gerenciador';

        $this->unique = true;

        $this->form = [
            [
                'title' => 'Login',
                'icon' => 'login',
                'inputs' => [
                    [
                        'label' => 'Cor primaria',
                        'name' => 'login_primary_color',
                        'type' => 'color',
                        'size' => 6
                    ],
                    [
                        'label' => 'Cor secundária',
                        'name' => 'login_secondary_color',
                        'type' => 'color',
                        'size' => 6
                    ],
                    [
                        'label' => 'Logo - login',
                        'name' => 'login_logo',
                        'input' => 'image',
                        'size' => 6
                    ],
                ],
            ],
            [
                'title' => 'Menu Lateral',
                'icon' => 'menu',
                'size' => 6,
                'inputs' => [
                    [
                        'label' => 'Logo',
                        'name' => 'menu_logo',
                        'input' => 'image',
                    ]
                ],
            ],
            [
                'title' => 'Dashboard',
                'icon' => 'dashboard',
                'size' => 6,
                'inputs' => [
                    [
                        'label' => 'Imagem incial - Dashboard',
                        'name' => 'dashboard_image',
                        'input' => 'image',
                        'size' => 6
                    ],
                ],
            ],
            [
                'title' => 'Cor interna do gerenciador',
                'icon' => 'palette',
                'inputs' => [
                    [
                        'input' => 'alert',
                        'type' => 'info',
                        'text' => 'Este campo de cor, é a principal cor interna do gerenciador',
                    ],
                    [
                        'label' => 'Cor',
                        'name' => 'background_color_page',
                        'type' => 'color',
                        'size' => 6,
                    ],
                ],
            ],
            [
                'title' => 'Cor dos botões',
                'icon' => 'palette',
                'inputs' => [
                    [
                        'label' => 'Cor - botão de salvar e upload',
                        'name' => 'btn_color_save',
                        'type' => 'color',
                        'size' => 3,
                    ],
                    [
                        'label' => 'Cor - botão de visualizar',
                        'name' => 'btn_color_view',
                        'type' => 'color',
                        'size' => 3,
                    ],
                    [
                        'label' => 'Cor - botão de deletar',
                        'name' => 'btn_color_delete',
                        'type' => 'color',
                        'size' => 3,
                    ],
                    [
                        'label' => 'Cor - checkbox',
                        'name' => 'checkbox_color',
                        'type' => 'color',
                        'size' => 3,
                    ],
                ],
            ],
        ];
    }
}
