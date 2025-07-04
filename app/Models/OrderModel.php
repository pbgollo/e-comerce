<?php

namespace App\Models;

class OrderModel extends BaseModel
{
    protected $table = 'orders';

    public function itens()
    {
        return $this->hasMany(OrderItemModel::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(AppUserModel::class, 'app_user_id');
    }

}
