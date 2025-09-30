<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
public function index(Request $request) {
    $products = Products::latest()->get();
    // $query = trim((string) $request->get('q', ''));
    // if($query !== '') {
    //     $products = $products->filter( function ($p) use ($query) {
    //         return str_contains(strtolower($p->name . ' ' . $p->brand->name), $query);
    //     });
    // }
    return view('store.index', ['products' => $products]);
}
public function show(Products $product) {
    return view('store.show', ['product' => $product]);
}

public function __invoke(Request $request) {
    $query = $request->get('q', '');
    
    if (empty($query)) {
        $products = collect();
    } else {
        $products = Products::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->orWhere('storage', 'LIKE', '%' . $query . '%')
            ->orWhere('color', 'LIKE', '%' . $query . '%')
            ->with('brand')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }
    
    return view('store.search_results', compact('products', 'query'));
}
}
