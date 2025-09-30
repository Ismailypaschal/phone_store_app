<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Products;

class CartController extends Controller
{
    public function index(): View
    {
        [$items, $subtotal] = $this->getCart();
        return view('cart.index', [
            'items' => $items,
            'subtotal' => $subtotal,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => ['required', 'string', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);
        $quantity = $data['quantity'] ?? 1;

        // $product = Products::firstWhere('product_id', $data['product_id']);
        // fetch product by ID
        $product = Products::findOrFail($data['product_id']);
        abort_unless($product, 404);

        $cart = session()->get('cart', []);
        $cart[$product->id] = [
            'product' => $product,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + $quantity,
        ];
        session(['cart' => $cart]);

        return back()->with('status', 'Added to cart');
    }

    public function remove(string $slug): RedirectResponse
    {
        $cart = session()->get('cart', []);
        unset($cart[$slug]);
        session(['cart' => $cart]);
        return back()->with('status', 'Removed from cart');
    }

    private function getCart(): array
    {
        $cart = session()->get('cart', []);
        $items = array_values($cart);
        $subtotal = array_reduce($items, function ($sum, $item) {
            return $sum + ($item['product']['price'] * $item['quantity']);
        }, 0);
        return [$items, $subtotal];
    }
}


