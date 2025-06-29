<?php

namespace App\Models;


class ProductImagesModel extends BaseModel
{
    protected $table = 'product_images';
    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }

}
