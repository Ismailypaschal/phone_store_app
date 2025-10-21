<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $products = config('products');
        $query = trim((string) $request->get('q', ''));
        if ($query !== '') {
            $products = array_values(array_filter($products, function ($p) use ($query) {
                return str_contains(strtolower($p['brand'].' '.$p['model']), strtolower($query));
            }));
        }
        return view('store.index', compact('products', 'query'));
    }

    public function show(string $slug): View
    {
        $product = collect(config('products'))
            ->firstWhere('slug', $slug);

        abort_unless($product, 404);

        return view('store.show', compact('product'));
    }
}




