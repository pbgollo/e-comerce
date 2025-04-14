<?php

namespace App\Models;

class Test extends BaseModel
{

    protected $table = 'test';

    protected $translatable = [
        'name',
        'file',
        'image'
    ];

}
