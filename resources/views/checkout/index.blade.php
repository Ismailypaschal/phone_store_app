{{-- @extends('layouts.app')

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

    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-1">
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
                <button type="submit" name="paystack" value="1" class="px-4 py-2 bg-blue-600 text-white rounded">Pay with Paystack</button>
            </form>
        </div>
    </div>
</div>
@endsection

 --}}
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

    <div class="flex flex-col md:flex-row gap-6">
        <div class="flex-1">
            <div class="space-y-2">
                <p>Subtotal: <span class="font-semibold">$ {{ number_format($subtotal, 2) }}</span></p>
                <p>Shipping: <span class="font-semibold">$ {{ number_format($shipping, 2) }}</span></p>
                <p>Total: <span class="text-xl font-semibold">$ {{ number_format($total, 2) }}</span></p>
            </div>

            {{-- Saved Details Option --}}
            @auth
                @if(isset($savedDetails) && !empty($savedDetails))
                    <div class="mt-6 space-y-2 border-b pb-4">
                        <label class="flex items-center">
                            <input type="radio" name="use_saved_details" value="1" id="use-saved" class="mr-2" onchange="toggleSavedDetails(true)">
                            <span class="text-sm font-medium">Use saved shipping details</span>
                        </label>
                        <div id="saved-preview" class="hidden ml-6 text-sm text-gray-600 space-y-1">
                            <p><strong>Address:</strong> {{ $savedDetails['shipping_address'] ?? '' }}, {{ $savedDetails['customer_city'] ?? '' }}, {{ $savedDetails['customer_state'] ?? '' }}</p>
                            <p><strong>Name:</strong> {{ $savedDetails['first_name'] ?? '' }} {{ $savedDetails['last_name'] ?? '' }}</p>
                            <p><strong>Email:</strong> {{ $savedDetails['customer_email'] ?? '' }}</p>
                            <p><strong>Phone:</strong> {{ $savedDetails['customer_phone'] ?? '' }}</p>
                        </div>
                    </div>
                @endif
            @endauth

            <form method="POST" action="{{ route('checkout.process') }}" class="mt-6 space-y-3" id="checkout-form">
                @csrf

                {{-- Payment Method Selection --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Choose Payment Method</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="paystack" checked class="mr-2">
                            <span>Paystack</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" name="payment_method" value="flutterwave" class="mr-2">
                            <span>Flutterwave</span>
                        </label>
                    </div>
                </div>

                {{-- Checkout Fields --}}
                <input required placeholder="First name" name="first_name" id="first_name" value="{{ old('first_name') }}" autocomplete="given-name" class="w-full border rounded px-3 py-2">
                <input required placeholder="Last name" name="last_name" id="last_name" value="{{ old('last_name') }}" autocomplete="family-name" class="w-full border rounded px-3 py-2">
                <input required placeholder="Email" name="customer_email" id="customer_email" type="email" value="{{ old('customer_email') }}" autocomplete="email" class="w-full border rounded px-3 py-2">
                <input required placeholder="Phone Number" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" autocomplete="tel" class="w-full border rounded px-3 py-2">
                <input required placeholder="Shipping Address" name="shipping_address" id="shipping_address" value="{{ old('shipping_address') }}" autocomplete="street-address" class="w-full border rounded px-3 py-2">
                <input required placeholder="State" name="customer_state" id="customer_state" value="{{ old('customer_state') }}" autocomplete="address-level1" class="w-full border rounded px-3 py-2">
                <input required placeholder="City" name="customer_city" id="customer_city" value="{{ old('customer_city') }}" autocomplete="address-level2" class="w-full border rounded px-3 py-2">

                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Place Order & Pay</button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleSavedDetails(useSaved) {
    const savedDetails = @json($savedDetails ?? []);
    const preview = document.getElementById('saved-preview');
    
    if (useSaved && savedDetails) {
        document.getElementById('first_name').value = savedDetails.first_name || '';
        document.getElementById('last_name').value = savedDetails.last_name || '';
        document.getElementById('customer_email').value = savedDetails.customer_email || '';
        document.getElementById('customer_phone').value = savedDetails.customer_phone || '';
        document.getElementById('shipping_address').value = savedDetails.shipping_address || '';
        document.getElementById('customer_state').value = savedDetails.customer_state || '';
        document.getElementById('customer_city').value = savedDetails.customer_city || '';
        if (preview) preview.classList.remove('hidden');
    } else {
        if (preview) preview.classList.add('hidden');
    }
}
// 👇 Add this code for Flutterwave redirect
// document.addEventListener("DOMContentLoaded", function () {
//     const flutterwaveRadio = document.querySelector('input[value="flutterwave"]');
//     if (flutterwaveRadio) {
//         flutterwaveRadio.addEventListener("change", function () {
//             if (this.checked) {
//                 // Redirect to your Flutterwave payment route
//                 window.location.href = "{{ route('flutter_payment.page') }}";
//             }
//         });
//     }
// });
</script>

@endsection