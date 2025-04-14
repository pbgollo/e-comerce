<?php

namespace App\Providers;

use App\Models\ArtificialIntelligenceModel;
use Illuminate\Support\ServiceProvider;

class ChatGPTServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('ChatGPT', function () {

            $chatGptKey = ArtificialIntelligenceModel::first()->chat_gpt_key;

            if (!$chatGptKey) {
                throw new \Exception('Chave ChatGPT não encontrada no banco de dados.');
            }

            return new \App\Services\ChatGPTService($chatGptKey);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
