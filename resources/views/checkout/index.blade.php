@extends('layouts.app')

@section('content')
<h1 class="text-lg font-semibold mb-4">Checkout</h1>

<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <div class="space-y-2">
        <p>Subtotal: <span class="font-semibold">$ {{ number_format($subtotal, 2) }}</span></p>
        <p>Shipping: <span class="font-semibold">$ {{ number_format($shipping, 2) }}</span></p>
        <p>Total: <span class="text-xl font-semibold">$ {{ number_format($total, 2) }}</span></p>
    </div>

    <form method="POST" action="{{ route('checkout.process') }}" class="mt-6 space-y-3">
        @csrf
        <input required placeholder="Full name" class="w-full border rounded px-3 py-2">
        <input required placeholder="Email" type="email" class="w-full border rounded px-3 py-2">
        <input required placeholder="Address" class="w-full border rounded px-3 py-2">
        <button class="px-4 py-2 bg-green-600 text-white rounded">Place Order</button>
    </form>
</div>
@endsection


