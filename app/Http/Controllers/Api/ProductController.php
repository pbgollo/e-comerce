<?php

namespace App\Http\Controllers\Api;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $ids = $request->query('ids');

        if ($ids) {
            $productIds = explode(',', $ids);
            $products = ProductModel::with(['stock', 'supplier', 'images'])
                ->whereIn('id', $productIds)
                ->get();
            return response()->json($products);
        }

        return response()->json([], 400); // Bad Request
    }

    public function show($id)
    {
        $product = ProductModel::with(['stock', 'supplier', 'images'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        return response()->json($product);
    }
}
