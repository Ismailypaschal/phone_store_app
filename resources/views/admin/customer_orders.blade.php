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
            <div class="flex items-start justify-between mb-3">
              <div>
                <p class="text-gray-900 text-base font-semibold">#10582</p>
                <p class="text-gray-600 text-sm">Jane Doe</p>
              </div>
              <div class="text-right">
                <p class="text-gray-900 text-base font-semibold">$1,299.00</p>
                <p class="text-gray-600 text-sm">Oct 26, 2023</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-yellow-500 mr-2"></div>
                Processing
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
          </div>

          <div class="flex flex-col bg-gray-100 p-4 rounded-lg mb-4 border border-black">
            <div class="flex items-start justify-between mb-3">
              <div>
                <p class="text-gray-900 text-base font-semibold">#10581</p>
                <p class="text-gray-600 text-sm">John Smith</p>
              </div>
              <div class="text-right">
                <p class="text-gray-900 text-base font-semibold">$899.00</p>
                <p class="text-gray-600 text-sm">Oct 25, 2023</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-green-500 mr-2"></div>
                Shipped
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
          </div>

          <div class="flex flex-col bg-gray-100 p-4 rounded-lg mb-4 border border-black">
            <div class="flex items-start justify-between mb-3">
              <div>
                <p class="text-gray-900 text-base font-semibold">#10580</p>
                <p class="text-gray-600 text-sm">Alice Johnson</p>
              </div>
              <div class="text-right">
                <p class="text-gray-900 text-base font-semibold">$2,150.50</p>
                <p class="text-gray-600 text-sm">Oct 24, 2023</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-blue-500 mr-2"></div>
                Delivered
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
          </div>

          <div class="flex flex-col bg-gray-100 p-4 rounded-lg mb-4 border border-black">
            <div class="flex items-start justify-between mb-3">
              <div>
                <p class="text-gray-900 text-base font-semibold">#10579</p>
                <p class="text-gray-600 text-sm">Michael Brown</p>
              </div>
              <div class="text-right">
                <p class="text-gray-900 text-base font-semibold">$450.00</p>
                <p class="text-gray-600 text-sm">Oct 23, 2023</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-red-500 mr-2"></div>
                Cancelled
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
          </div>

          <div class="flex flex-col bg-gray-100 p-4 rounded-lg mb-4 border border-black">
            <div class="flex items-start justify-between mb-3">
              <div>
                <p class="text-gray-900 text-base font-semibold">#10578</p>
                <p class="text-gray-600 text-sm">Emily Davis</p>
              </div>
              <div class="text-right">
                <p class="text-gray-900 text-base font-semibold">$1,899.99</p>
                <p class="text-gray-600 text-sm">Oct 22, 2023</p>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <div class="flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                <div class="h-2 w-2 rounded-full bg-blue-500 mr-2"></div>
                Delivered
              </div>
              <span class="material-symbols-outlined text-gray-500">chevron_right</span>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

@endsection