<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;

class ProductDetailController extends Controller
{
    public function show($slug)
    {

        $this->vm['product'] = ProductModel::with(['supplier', 'stock'])
        ->where('slug', $slug)
        ->firstOrFail()
        ->toArray();

        $this->vm['related_products'] = ProductModel::with(['supplier', 'stock'])
            ->where('category_id', $this->vm['product']['category_id'])
            ->where('id', '!=', $this->vm['product']['id'])
            ->where('active', 1)
            ->orderBy('position')
            ->get();

        return view("site.product-detail", $this->vm);
    }
}
