<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class ProductDetailController extends Controller
{
    public function show($slug)
    {
        $this->vm['product'] = ProductModel::with(['supplier', 'stock', 'images'])
            ->where('slug', $slug)
            ->firstOrFail()
            ->toArray();

        // $this->vm['product'] = array_merge($this->vm['product'], [
        //     'review_amount' => '254',
        //     'review_stars_average' => '4',
        // ]);

        $this->vm['related_products'] = ProductModel::with(['supplier', 'stock', 'images'])
            ->where('category_id', $this->vm['product']['category_id'])
            ->get()
            ->toArray();

        $this->vm['product_cat'] = CategoryModel::where('id', $this->vm['product']['category_id'])
            ->first();


        return view("site.Pages.product-detail", $this->vm);
    }

}
