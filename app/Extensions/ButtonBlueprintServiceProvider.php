<?php

namespace App\Extensions;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\Router;

class ButtonBlueprintServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
    }

    public function boot(Router $router)
    {
        Blueprint::macro('button', function($name) {
            $this->string($name.'_label')->nullable();
            $this->string($name.'_link')->nullable();
            $this->boolean($name.'_target')->nullable();
        });

    }
}
