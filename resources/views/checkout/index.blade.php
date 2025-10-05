@extends('layouts.app')

@section('content')
<h1 class="text-lg font-semibold mb-4">Checkout</h1>

@if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-50 text-red-800 border border-red-200">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl">
    <div class="space-y-2">
        <p>Subtotal: <span class="font-semibold">$ {{ number_format($subtotal, 2) }}</span></p>
        <p>Shipping: <span class="font-semibold">$ {{ number_format($shipping, 2) }}</span></p>
        <p>Total: <span class="text-xl font-semibold">$ {{ number_format($total, 2) }}</span></p>
    </div>

    <form method="POST" action="{{ route('checkout.process') }}" class="mt-6 space-y-3">
        @csrf
        <input required placeholder="First name" name="first_name" value="{{ old('first_name') }}" autocomplete="given-name" class="w-full border rounded px-3 py-2">
        <input required placeholder="Last name" name="last_name" value="{{ old('last_name') }}" autocomplete="family-name" class="w-full border rounded px-3 py-2">
        <input required placeholder="Email" name="customer_email" type="email" value="{{ old('customer_email') }}" autocomplete="email" class="w-full border rounded px-3 py-2">
        <input required placeholder="Phone Number" name="customer_phone" value="{{ old('customer_phone') }}" autocomplete="tel" class="w-full border rounded px-3 py-2">
        <input required placeholder="Shipping Address" name="shipping_address" value="{{ old('shipping_address') }}" autocomplete="street-address" class="w-full border rounded px-3 py-2">
        <input required placeholder="State" name="customer_state" value="{{ old('customer_state') }}" autocomplete="address-level1" class="w-full border rounded px-3 py-2">
        <input required placeholder="City" name="customer_city" value="{{ old('customer_city') }}" autocomplete="address-level2" class="w-full border rounded px-3 py-2">
        <button class="px-4 py-2 bg-green-600 text-white rounded">Place Order</button>
    </form>
    
    <!-- Debug: Simple test button -->
    {{-- <div class="mt-4 p-4 bg-yellow-100 border border-yellow-400 rounded">
        <p class="text-sm text-yellow-800 mb-2">Debug Test:</p>
        <a href="{{ route('store.index') }}" class="px-3 py-1 bg-blue-500 text-white rounded text-sm">Test Route</a>
        <button onclick="alert('JavaScript is working!')" class="px-3 py-1 bg-purple-500 text-white rounded text-sm ml-2">Test JS</button>
        <button onclick="document.querySelector('form').submit()" class="px-3 py-1 bg-red-500 text-white rounded text-sm ml-2">Force Submit</button>
    </div> --}}
</div>
@endsection


