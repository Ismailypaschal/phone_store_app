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
                            id="product-name" type="text" placeholder="e.g., iPhone 15 Pro - 256GB" required>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="brand">Brand</label>
                            <select name="brand_id" id="brand"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                required>
                                <option value="">Select a brand</option>
                                @forelse ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
                                id="category" type="text" placeholder="e.g., smartphone" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1"
                            for="product-description">Description</label>
                        <textarea name="description"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                            id="product-description" rows="3" placeholder="Enter product details" required></textarea>
                    </div>

                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="price">Price</label>
                            <input name="price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="price" type="number" placeholder="e.g., $999.00" required>
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="discount_price">Discount
                                price</label>
                            <input name="discount_price"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="discount_price" type="number" placeholder="e.g., $50">
                        </div>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="storage">Storage</label>
                            <input name="storage"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="storage" type="number" placeholder="e.g., 512GB" required>
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="color">Color</label>
                            <input name="color"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="color" type="text" placeholder="e.g., black">
                        </div>
                    </div>
                    <div class="flex -mx-2 mb-4">
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1"
                                for="availability_status">Availability Status</label>
                            <input name="availability_status"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="availability_status" type="text" placeholder="e.g., In stock">
                        </div>
                        <div class="w-1/2 px-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="quantity">Quantity</label>
                            <input name="quantity"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:outline-none"
                                id="quantity" type="number" placeholder="e.g., 200" required>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Product Image</label>
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 cursor-pointer hover:bg-gray-100">
                            <p class="text-sm text-gray-600 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-500">SVG, PNG, JPG (MAX. 800x400px)</p>
                            <input name="img_path" type="file" class="visible" id="dropzone-file">
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-lg font-semibold hover:bg-blue-800">
                        Add Product
                    </button>
                </form>

                <hr class="border-gray-300 mb-4">

                <!-- Search and Filter Bar -->
                <div class="py-3">
                    <div class="flex items-center gap-2">
                        <label class="flex flex-col h-12 w-full">
                            <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                <div
                                    class="text-slate-500 dark:text-slate-400 flex border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 items-center justify-center pl-3 rounded-l-lg border-r-0">
                                    <span class="material-symbols-outlined">search</span>
                                </div>
                                <input
                                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-0 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 focus:border-primary h-full placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 pl-2 text-base font-normal leading-normal"
                                    placeholder="Search by name or model" value="" />
                            </div>
                        </label>
                        <button
                            class="flex shrink-0 items-center justify-center rounded-lg h-12 w-12 border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-400">
                            <span class="material-symbols-outlined">filter_list</span>
                        </button>
                    </div>
                </div>

                <!-- Product List -->
                <main class="flex-1 gap-5 pb-24">
                    <!-- List Item 1 -->
                    @foreach ($products as $product)
                        <div
                            class="flex mb-6 gap-4 bg-white dark:bg-slate-800 p-3 justify-between rounded-xl border border-slate-200 dark:border-slate-700">
                            <div class="flex items-center gap-4">
                                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-lg size-[70px] shrink-0"
                                    data-alt="Image of a silver smartphone"
                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBlYCMiK7GNx7AeIlaNnKLMSoQ9F3kqmPIYKjlwOfdz_BQ40LwZ12cdGpfT4gN_ygCh-u434uvyvN5FCjKytj3LtNkVNKa9RBumBSBn75giTStAfJSgdoZaJ9KL9q68KGlCXVofiiHJb5e_7A-Ecpz9TYr3Ua_pyqU8g6pS702AdR7xd-o09owF-krKmnKSta-zjOysNeJHl3mbmUGZzpCY-nrQRIUzTrvSXRSk_CRthKK2ETIf4DriFwZDUwrIuuFuGBZYAvhKDREa");'>
                                </div>
                                <div class="flex flex-1 flex-col justify-center gap-1">
                                    <p class="text-slate-900 dark:text-white text-base font-bold leading-tight">
                                        {{ $product->name }} -
                                        {{ $product->storage }}GB</p>
                                    <div class="flex items-center gap-1.5">
                                        <span class="inline-block h-2 w-2 rounded-full bg-green-500"></span>
                                        <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">
                                            Active
                                        </p>
                                    </div>
                                    <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">
                                        ${{ $product->price }} •
                                        {{ $product->quantity }} {{ $product->availabilty_status }}</p>
                                </div>
                            </div>
                            <div class="shrink-0 flex items-center gap-2">
                                <form method="POST" action="{{ route('delete.product', ['id' => $product->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 dark:text-red-400 flex size-8 items-center justify-center">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>
                                <a href="{{ route('update.product', ['id' => $product->id]) }}"
                                    class="text-slate-500 dark:text-slate-400 flex size-8 items-center justify-center">
                                    <span class="material-symbols-outlined">more_vert</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    <!-- Pagination -->
                    <div class="mt-4 mb-4 px-4 pb-8">
                        @if (method_exists($products, 'links'))
                            <div class="flex justify-center">
                                {{ $products->links() }}
                            </div>
                        @endif
                </main>
            </div>
        </div>
    </div>
@endsection
