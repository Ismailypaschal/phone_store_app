@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-3xl">
    <img src="{{ $product->img_path ? asset($product->img_path) : 'https://picsum.photos/600/400?random=' . $product->id }}"
                        alt="{{ $product->brand->name }}" class="w-full h-48 object-cover" />
    <div class="p-6">
        <h1 class="text-xl font-semibold">{{ $product->name }}</h1>
        <p class="text-gray-500">{{ $product->storage }} GB • {{ $product->color }}</p>
        <p class="mt-4">{{ $product->description }}</p>
        <p class="mt-4 text-2xl font-semibold">$ {{ number_format($product->price, 2) }}</p>
        <p class="mt-4 text-2xl font-semibold"><span class="text-red-400">Discount: </span> $ {{ number_format($product->discount_price, 2) }}</p>
        <form method="POST" action="{{ route('cart.add') }}" class="mt-4 flex gap-2 items-center">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="number" min="1" name="quantity" value="1" class="border rounded px-3 py-2 w-24">
            <button class="px-4 py-2 bg-green-600 text-white rounded">Add to Cart</button>
            <a href="{{ route('cart.index') }}" class="px-4 py-2 bg-gray-100 rounded">View Cart</a>
        </form>
    </div>
</div>
@endsection




