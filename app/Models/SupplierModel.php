<?php

namespace App\Models;

class SupplierModel extends BaseModel
{
    protected $table = 'suppliers';

    public function address()
    {
        return $this->morphOne(AddressModel::class, 'addressable');
    }


}
