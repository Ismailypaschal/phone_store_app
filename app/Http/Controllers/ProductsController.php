<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
public function index() {
    $products = Products::latest()->get();
    return view('store.index', ['products' => $products]);
}
public function __invoke(Products $product) {
    return view('store.show', ['product' => $product]);
}
}
