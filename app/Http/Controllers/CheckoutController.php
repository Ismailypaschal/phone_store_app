<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function index(): View
    {   
        $cart = session()->get('cart', []);
        $items = array_values($cart);
        $subtotal = array_reduce($items, fn ($sum, $i) => $sum + ($i['product']['price'] * $i['quantity']), 0);
        $shipping = $subtotal > 0 ? 15.00 : 0.00;
        $total = $subtotal + $shipping;
        
        // Debug: Log cart data
        Log::info('Checkout index - Cart data', [
            'cart_count' => count($cart),
            'items_count' => count($items),
            'subtotal' => $subtotal,
            'user_id' => Auth::id()
        ]);
        
        return view('checkout.index', compact('items', 'subtotal', 'shipping', 'total'));
    }

    public function process(Request $request): RedirectResponse
    {
        Log::info('Form received:', $request->all());
        // dd($request->all());

        // Debug: Log that we reached this method
        Log::info('Checkout process method called', [
            'user_id' => Auth::id(),
            'cart_count' => count(session()->get('cart', [])),
            'request_data' => $request->all()
        ]);

        // Validate checkout form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_state' => 'required|string|max:100',
            'customer_city' => 'required|string|max:100',
            'shipping_address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Calculate totals
        $items = array_values($cart);
        $subtotal = array_reduce($items, fn ($sum, $i) => $sum + ($i['product']['price'] * $i['quantity']), 0);
        $shipping = $subtotal > 0 ? 15.00 : 0.00;
        $total = $subtotal + $shipping;

        // Create order in database transaction
        DB::beginTransaction();
        
        try {
            Log::info('Starting order creation', ['total' => $total, 'shipping' => $shipping]);
            
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'customer_email' => $validated['customer_email'],
                'customer_phone' => $validated['customer_phone'],
                'customer_state' => $validated['customer_state'],
                'customer_city' => $validated['customer_city'],
                'shipping_address' => $validated['shipping_address'],
                'total_price' => $total,
                'shipping_fee' => $shipping,
                'order_status' => 'processing',
            ]);
            
            Log::info('Order created successfully', ['order_id' => $order->id]);

            // Create order items
            foreach ($items as $item) {
                $product = $item['product']; // Product is already stored in cart
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price_at_purchase' => $product->price,
                    'discount_at_purchase' => $product->discount_price,
                ]);
                
                Log::info('Order item created', [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity']
                ]);
            }

            DB::commit();
            Log::info('Transaction committed successfully');
            
            // Clear cart after successful order
            session()->forget('cart');
            
            return redirect()->route('store.index')->with('status', 'Order placed successfully! Order #' . $order->id);
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Order creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}


