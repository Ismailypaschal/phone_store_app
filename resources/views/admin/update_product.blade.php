@extends('layouts.admin-app')
@section('content')
    <div class="flex flex-wrap mx-auto">
        <div class="w-full px-3">
            <div class="relative flex flex-col bg-white border border-gray-300 shadow-lg rounded-lg p-6">

                <h2 class="text-lg font-semibold text-gray-800 mb-4">Add New Product</h2>

                <form class="mb-6" method="POST" enctype="multipart/form-data" action="{{ route('admin.products.store') }}">
                    @csrf
                    {{-- flash messages --}}
                    @if (session('success'))
                        <div class="mb-4 p-3 bg-green-100 text-green-500 rounded-lg text-center">{{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg text-center">{{ session('error') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded text-center">
                            <ul class="text-sm text-red-600 list-disc pl-5">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1" for="product-name">Product Name</label>
                        <input name="name"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                            id="product-name" type="text" placeholder="e.g., iPhone 15 Pro - 256GB"
                            value="{{ $product->name }}" required>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="brand">Brand</label>
                            <select name="brand_id" id="brand"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                required>
                                {{-- Show the current product brand first (unless old input overrides) --}}
                                @if (old('brand_id'))
                                    {{-- If there's old input, respect it and show placeholder first --}}
                                    <option value="">Select a brand</option>
                                @else
                                    @if (optional($product->brand)->id)
                                        <option value="{{ $product->brand->id }}" selected>{{ $product->brand->name }}
                                        </option>
                                    @else
                                        <option value="">Select a brand</option>
                                    @endif
                                @endif

                                {{-- Then list other brands, marking selected if matching old input or product brand --}}
                                @forelse ($brands as $brand)
                                    @if (optional($product->brand)->id != $brand->id)
                                        <option value="{{ $brand->id }}"
                                            {{ old('brand_id') == $brand->id || (!old('brand_id') && optional($product->brand)->id == $brand->id) ? 'selected' : '' }}>
                                            {{ $brand->name }}</option>
                                    @endif
                                @empty
                                    <option disabled>No brands available</option>
                                @endforelse
                            </select>
                            @error('brand_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="category">Category</label>
                            <input name="category"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="category" type="text" placeholder="e.g., smartphone"
                                value="{{ $product->category }}" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1"
                            for="product-description">Description</label>
                        <input name="description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                            id="product-description" rows="3" placeholder="{{ $product->description }}"
                            value="{{ $product->description }}" required />
                    </div>

                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="price">Price</label>
                            <input name="price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="price" type="number" placeholder="e.g., $999.00" value="{{ $product->price }}"
                                required>
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="discount_price">Discount
                                price</label>
                            <input name="discount_price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="discount_price" type="number" placeholder="e.g., $50"
                                value="{{ $product->discount_price }}">
                        </div>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="storage">Storage</label>
                            <input name="storage"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="storage" type="number" placeholder="e.g., 512GB" value="{{ $product->storage }}"
                                required>
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="color">Color</label>
                            <input name="color"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="color" type="text" placeholder="e.g., black" value="{{ $product->color }}">
                        </div>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1"
                                for="availability_status">Availability Status</label>
                            <input name="availability_status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="availability_status" type="text" placeholder="e.g., In stock"
                                value="{{ $product->availability_status }}" required>
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="quantity">Quantity</label>
                            <input name="quantity"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="quantity" type="number" placeholder="e.g., 200" value="{{ $product->quantity }}"
                                required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 cursor-pointer hover:bg-gray-100">
                            <p class="text-sm text-gray-600 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG (MAX. 800x400px)</p>
                            <input name="img_path" type="file" class="visible" id="dropzone-file"
                                value="{{ asset('/products/'.$product->img_path) }}">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg font-semibold hover:bg-blue-800">
                        Add Product
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
