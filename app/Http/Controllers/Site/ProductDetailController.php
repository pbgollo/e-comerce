<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;

class ProductDetailController extends Controller
{
    public function show($slug)
    {

        $this->vm['product'] = ProductModel::get()->where("slug", $slug)->first()->toArray();

        return view("site.product-detail", $this->vm);
    }
}
