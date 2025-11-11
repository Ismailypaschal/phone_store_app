@extends('layouts.admin-app')
@section('content')

  <div class="flex flex-wrap mx-auto">
    <div class="flex-none w-full max-w-full px-3">
      <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-lg rounded-lg">
        <div class="p-6 pb-0 mb-0 border-b border-gray-200 rounded-t-lg">
          <h6 class="text-gray-800 font-semibold">Customer Orders</h6>
        </div>

        <!-- Search Bar -->
        <div class="px-4 py-3">
          <div class="flex items-center">
            <label class="flex flex-col h-12 w-full">
              <div class="flex w-full items-center rounded-lg h-full border border-gray-300 bg-white">
                <div class="flex items-center justify-center pl-3 border-r border-gray-200 text-gray-500">
                  <span class="material-symbols-outlined">search</span>
                </div>
                <input class="flex w-full px-4 text-gray-800 focus:outline-none"
                  placeholder="Search by Order ID, Customer..." />
              </div>
            </label>
          </div>
        </div>

        <!-- Filter Buttons -->
        <div class="flex p-4 pt-1 overflow-x-auto whitespace-no-wrap">
          <button
            class="flex h-8 items-center justify-center px-4 rounded-full bg-blue-500 text-white text-sm font-semibold mr-2">
            All
          </button>
          <button
            class="flex h-8 items-center justify-center px-4 rounded-full bg-gray-200 text-gray-800 text-sm font-medium mr-2">
            Processing
          </button>
          <button
            class="flex h-8 items-center justify-center px-4 rounded-full bg-gray-200 text-gray-800 text-sm font-medium mr-2">
            Shipped
          </button>
          <button
            class="flex h-8 items-center justify-center px-4 rounded-full bg-gray-200 text-gray-800 text-sm font-medium mr-2">
            Delivered
          </button>
          <button
            class="flex h-8 items-center justify-center px-4 rounded-full bg-gray-200 text-gray-800 text-sm font-medium">
            Cancelled
          </button>
        </div>

        <!-- Orders -->
        <main class="flex-1 overflow-y-auto px-4 pb-24 mt-4">
          <!-- Order Card -->
          <div class="flex flex-col bg-gray-100 p-4 rounded-lg mb-4 border border-black">
            @foreach ($orders as $order)
              <div class="flex items-start justify-between mb-3">
                <div>
                  <p class="text-gray-900 text-base font-semibold">#{{ $order->id }}</p>
                  <p class="text-gray-600 text-sm">
                    {{ $order->user->name}}</p>
                </div>
                <div class="text-right">
                  <p class="text-gray-900 text-base font-semibold">${{ $order->total_price }}</p>
                  <p class="text-gray-600 text-sm">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                </div>
              </div>
              <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></div>
                {{ $order->order_status }}
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
            @endforeach
            
            <!-- Pagination -->
            <div class="mt-4 mb-4 px-4 pb-8">
              @if(method_exists($orders, 'links'))
                <div class="flex justify-center">
                  {{ $orders->links() }}
                </div>
              @endif
            </div>
            @if ($orders->isEmpty())
              <p class="text-gray-500 text-center h-full">No Order found.</p>
            @endif
          </div>
        </main>
      </div>
    </div>
  </div>

@endsection