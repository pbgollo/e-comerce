<?php

namespace App\Models;

class OrderItemModel extends BaseModel
{
    protected $table = 'order_items';

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }


}
