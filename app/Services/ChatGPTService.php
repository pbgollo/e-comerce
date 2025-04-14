<?php

namespace App\Services;

use App\Models\ArtificialIntelligenceModel;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Cache;

class ChatGPTService
{
    protected $apiKey;
    protected $client;
    protected $model;

    public function __construct()
    {

        $model = ArtificialIntelligenceModel::first(['chat_gpt_key', 'model']);
        $this->apiKey = $model ? $model->chat_gpt_key : null;
        $this->model = $model ? $model->model : 'gpt-4o-mini';


        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'verify' => false, // Desabilita a verificação de SSL (não recomendado para produção)
        ]);
    }

    /**
     * Obtém a lista de modelos disponíveis
     *
     * @return array
     */

    public function getModels()
    {
        // Try to get the cached data
        $cacheKey = 'openai_models'; // Unique key for caching the models

        // If the data is cached, return it, otherwise make the request and cache the result
        return Cache::remember($cacheKey, now()->addHours(24), function () use ($cacheKey) {
            try {
                $response = $this->client->get('models');

                $responseData = json_decode($response->getBody(), true);

                return $responseData['data'] ?? [];
            } catch (RequestException $e) {
                // Handle exception and clear the cache
                return [];
            }
        });
    }



    /**
     * Obtém o custo atual dos modelos
     *
     * @return array
     */
    public function getCurrentCost($startTime = null)
    {
        // Use a default start_time if not provided
        $startTime = $startTime ?? '1730419200';  // Default start_time as the example
        $cacheKey = 'openai_costs_' . $startTime;  // Unique cache key based on start_time

        // Try to get the cached data
        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($startTime) {
            try {
                $response = $this->client->get('organization/costs', [
                    'query' => [
                        'start_time' => $startTime,  // Passes the provided or default start_time
                        'limit' => 1,
                    ],
                    'headers' => [
                        'Authorization' => 'Bearer ' . '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',
                    ],
                ]);

                // Decodes the API response
                $responseData = json_decode($response->getBody(), true);

                // Returns the 'data' if available
                return $responseData['data'] ?? [];
            } catch (RequestException $e) {
                throw new \Exception('Erro ao obter custo: ' . $e->getMessage());
            }
        });
    }



    /**
     * Gera um texto a partir do prompt fornecido
     *
     * @param string $prompt
     * @return array
     */
    public function generateText($prompt)
    {
        try {
            $response = $this->client->post('chat/completions', [
                'json' => [
                    'model' => $this->model,
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            $tokensUsed = $responseData['usage']['total_tokens'] ?? 0;
            $generatedText = $responseData['choices'][0]['message']['content'] ?? '';

            return [
                'generated_text' => $generatedText,
                'tokens_used' => $tokensUsed,
            ];
        } catch (RequestException $e) {
            throw new \Exception('Erro ao gerar texto: ' . $e->getMessage());
        }
    }
}
