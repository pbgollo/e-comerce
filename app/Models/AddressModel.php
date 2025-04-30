<?php

namespace App\Models;

class AddressModel extends BaseModel
{
    protected $table = 'addresses';

    public function addressable()
    {
        return $this->morphTo();
    }

}
