<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;
use App\Models\TranslateModel;

class HomeController extends Controller
{

    public function index()
    {
        $this->vm['products'] = ProductModel::with(['supplier', 'stock'])->where('active', '1')->orderBy('position')->get()->toArray();

        return view("site.home", $this->vm);
    }
}
