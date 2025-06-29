<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class ProductModel extends BaseModel
{
    protected $table = 'products';

    use HasSlug;
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('id')
            ->saveSlugsTo('slug');
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class);
    }

    public function stock()
    {
        return $this->hasOne(StockModel::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImagesModel::class, 'product_id');
    }

}
