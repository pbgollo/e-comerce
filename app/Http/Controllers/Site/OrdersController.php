<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;
use App\Models\TranslateModel;

class OrdersController extends Controller
{

    public function index()
    {
        $this->vm['products'] = ProductModel::with(['supplier', 'stock'])->where('active', '1')->orderBy('position')->get()->toArray();

        return view("site.pages.orders", $this->vm);
    }
}
