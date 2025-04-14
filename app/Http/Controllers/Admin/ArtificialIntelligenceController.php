<?php

namespace App\Http\Controllers\Admin;

use App\Models\ArtificialIntelligenceModel;

class ArtificialIntelligenceController extends GenericController
{
    protected $chatGPT;

    function __construct()
    {
        parent::__construct();

        $this->model = ArtificialIntelligenceModel::class;

        $this->title = 'Inteligência Artificial';

        $this->unique = true;

        $this->chatGPT = app('ChatGPT');

        $gptModels = $this->chatGPT->getModels();
        $currentCost = $this->chatGPT->getCurrentCost();

        if (empty($gptModels)) {
            $gptModels = [
                [
                    'value' => 'gpt-4o-mini',
                    'description' => 'gpt-4o-mini'
                ]
            ];
        } else {
            $gptModels = array_map(function ($model) {
                return [
                    'value' => $model['id'],
                    'description' => $model['id']
                ];
            }, $gptModels);
        }

        $this->form = [
            [
                'title' => 'Detalhes de IA',
                'icon' => 'smart_toy',
                'inputs' => [
                    [
                        'label' => 'Chave de Administrador na OpenAI (ChatGPT)',
                        'name' => 'admin_chatgpt_key',
                        'generate' => false,
                        'size' => 6
                    ],
                    [
                        'label' => 'Chave de Projeto na OpenAI (ChatGPT)',
                        'name' => 'chat_gpt_key',
                        'generate' => false,
                        'size' => 6
                    ],
                    [
                        'label' => 'Modelo a ser utilizado',
                        'name' => 'model',
                        'input' => 'select',
                        'data' => $gptModels,
                    ],
                    [
                        'label' => 'Gasto Atual',
                        'input' => 'cost',
                        'data' => empty($currentCost) ? "Não há gastos até o momento" : json_encode($currentCost['data']['result']['amount'])
                    ]
                ],
            ],
        ];
    }
}
