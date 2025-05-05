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

        return view("site.product-detail", $this->vm);
    }
}
