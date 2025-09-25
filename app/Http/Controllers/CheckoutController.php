<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function index(): View
    {
        $cart = session()->get('cart', []);
        $items = array_values($cart);
        $subtotal = array_reduce($items, fn ($sum, $i) => $sum + ($i['product']['price'] * $i['quantity']), 0);
        $shipping = $subtotal > 0 ? 15.00 : 0.00;
        $total = $subtotal + $shipping;
        return view('checkout.index', compact('items', 'subtotal', 'shipping', 'total'));
    }

    public function process(): RedirectResponse
    {
        session()->forget('cart');
        return redirect()->route('store.index')->with('status', 'Order placed! (mock)');
    }
}


