@extends('layouts.app')

@section('content')
<h1 class="text-lg font-semibold mb-4">Your Cart</h1>

<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-4 py-2"></th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse ($items as $item)
            <tr>
                <td class="px-4 py-2">{{ $item['product']['name'] }}</td>
                <td class="px-4 py-2">$ {{ number_format($item['product']['price'], 2) }}</td>
                <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                <td class="px-4 py-2">$ {{ number_format($item['product']['price'] * $item['quantity'], 2) }}</td>
                <td class="px-4 py-2 text-right">
                    <form method="POST" action="{{ route('cart.remove', $item['product']['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-6 text-center text-gray-500">Your cart is empty.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4 flex items-center justify-between">
    <p class="text-lg">Subtotal: <span class="font-semibold">$ {{ number_format($subtotal, 2) }}</span></p>
    <a href="{{ route('checkout.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Checkout</a>
    </div>
@endsection




