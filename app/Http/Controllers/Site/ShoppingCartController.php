<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view("site.shopping-cart", $this->vm);
    }
}
