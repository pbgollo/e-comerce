<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;
use App\Models\TranslateModel;

class HomeController extends Controller
{

    public function index()
    {
        $this->vm['products'] = ProductModel::with(['supplier', 'stock'])->where('active', '1')->orderBy('position')->get()->toArray();

        // foreach ($this->vm['products'] as &$product) {
        //     $product = array_merge(
        //         [
        //             'review_amount' => '254',
        //             'review_stars_average' => '4',
        //         ],
        //         $product,
        //     );
        // }

        return view("site.home", $this->vm);
    }
}
