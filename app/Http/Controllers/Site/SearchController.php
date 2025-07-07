<?php

namespace App\Http\Controllers\Site;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class SearchController extends Controller
{
    public function show($id)
    {
        $this->vm['product'] = ProductModel::with(['supplier', 'stock', 'images'])
            ->where('category_id', $id)
            ->get()
            ->toArray();

        // $this->vm['product'] = array_merge($this->vm['product'], [
        //     'review_amount' => '254',
        //     'review_stars_average' => '4',
        // ]);

        $html = view("site.components.product", $this->vm)->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $string = $request->get('q', '');

        $search = slugify($string);
        $keywords = explode('-', $search);

        $query = ProductModel::with(['supplier', 'stock', 'images']);

        $query->where(function ($q) use ($keywords) {
            foreach ($keywords as $keyword) {
                $q->orWhere('slug', 'like', '%' . $keyword . '%');
            }
        });

        $this->vm['products'] = $query->get()->toArray();

        // Só renderiza HTML de produtos
        $html = view("site.components.product", $this->vm)->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function filter(\Illuminate\Http\Request $request)
    {
        $id = $request->get('q', '');


        $query = ProductModel::with(['supplier', 'stock', 'images']);

        $query->where(function ($q) use ($id) {
            $q->orWhere('category_id', 'like', '%' . $id . '%');
        });

        $this->vm['products'] = $query->get()->toArray();

        // Só renderiza HTML de produtos
        $html = view("site.components.product", $this->vm)->render();

        return response()->json([
            'html' => $html,
        ]);
    }

}
