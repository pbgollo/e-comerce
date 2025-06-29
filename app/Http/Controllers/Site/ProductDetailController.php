<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;

class ProductDetailController extends Controller
{
    public function show($slug)
    {
        $this->vm['product'] = ProductModel::with(['supplier', 'stock', 'images'])
            ->where('slug', $slug)
            ->firstOrFail()
            ->toArray();

        $this->vm['product'] = array_merge($this->vm['product'], [
            'review_amount' => '254',
            'review_stars_average' => '4',
        ]);

        $this->vm['related_products'] = ProductModel::with(['supplier', 'stock', 'images'])
            ->where('category_id', $this->vm['product']['category_id'])
            ->get()
            ->toArray();

        return view("site.Pages.product-detail", $this->vm);
    }

    public function cart($slug)
    {

        $this->vm['product'] = ProductModel::with(['supplier', 'stock'])
            ->where('slug', $slug)
            ->firstOrFail()
            ->toArray();

        return view("site.Pages.shopping-cart", $this->vm);
    }

    public function payment($slug)
    {

        $this->vm['product'] = ProductModel::with(['supplier', 'stock'])
            ->where('slug', $slug)
            ->firstOrFail()
            ->toArray();

        return view("site.Pages.payment", $this->vm);
    }
}
