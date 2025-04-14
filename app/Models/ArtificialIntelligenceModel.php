<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class ArtificialIntelligenceModel extends BaseModel
{
    protected $table = "artificial_intelligence";

    /**
     * Boot method to register model events for cache clearing
     */
    protected static function booted()
    {
        static::saved(function ($model) {
            Cache::forget('openai_models');
        });

        static::deleted(function ($model) {
            Cache::forget('openai_models');
        });
    }
}
