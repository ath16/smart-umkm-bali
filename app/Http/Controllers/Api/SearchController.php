<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->query('q');

        if (empty($query)) {
            return response()->json(['data' => []]);
        }

        $products = Product::search($query)
            ->query(fn ($q) => $q->active()->where('is_published', true)->with('store', 'images'))
            ->take(5)
            ->get();

        $results = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->formatted_sell_price,
                'store' => $product->store->name ?? '',
                'url' => route('products.show', $product->slug),
                'image' => $product->images->first() ? imageUrl($product->images->first()->image_url ?? null, 'thumbnail') : null,
            ];
        });

        return response()->json(['data' => $results]);
    }
}
