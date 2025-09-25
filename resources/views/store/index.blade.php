@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h1 class="text-lg font-semibold">Shop Phones</h1>
    <form method="GET" action="{{ route('store.index') }}" class="flex gap-2">
        {{-- <input type="text" name="q" value="{{ $query }}" placeholder="Search phones" class="border rounded px-3 py-2 text-sm"> --}}
        <button class="px-3 py-2 text-sm bg-gray-800 text-white rounded">Search</button>
    </form>
    </div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($products as $product)
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <img src="{{ $product->img_path }}" alt="{{ $product->quantity }} {{ $product->discount_price }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h2 class="font-semibold">{{ $product->name }} {{ $product->availability_status}}</h2>
            <p class="text-sm text-gray-500">{{ $product->description }} GB • {{ $product->color}}</p>
            <p class="mt-2 font-semibold">$ {{ number_format($product->price, 2) }}</p>
            <div class="mt-3 flex gap-2">
                {{-- <a href="{{ route('store.show', $p['slug']) }}" class="px-3 py-2 text-sm bg-blue-600 text-white rounded">View</a> --}}
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    {{-- <input type="hidden" name="slug" value="{{ $p['slug'] }}"> --}}
                    <button class="px-3 py-2 text-sm bg-green-600 text-white rounded">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

@if (empty($products))
    <p class="text-gray-500">No products found.</p>
@endif
@endsection


