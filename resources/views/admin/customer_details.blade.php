@extends('layouts.admin-app')
@section('content')

    {{-- <div class="relative flex flex-col min-h-screen w-full bg-gray-100">
        <main class="flex-1 pb-24">
            <!-- Profile Header -->
            <div class="p-4">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 w-full">
                    <div class="flex items-center gap-4">
                        <div class="h-20 w-20 rounded-full bg-cover bg-center"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBOxafze7bfi_yq734ob5WjjrI5f5arzwvVq3PJCd-hXTeBUAIiU-7bWgDmvUgh_lo7aQHNsrkPqKsBKtFtmGdbiKHlEM44vfq5ihe7r2BPsERr6bk4KH6CTQnSF31kmUqgK3w__7_g2EKpRkiwx9KmCSc69pWb-RGrAtFRJtklms42-Dt6FFRSUQfFxKI3JewCQ9iCn3cnrVfOVRmhPFGb9SwtIwpEcX2YolMEG8SiTj0iUGCgIhWP7PtH-cc9dSIyJEi30sfax3aJ");'>
                        </div>
                        <div>
                            <p class="text-gray-900 text-xl font-bold leading-tight">Alexandre Dupont</p>
                            <p class="text-gray-600 text-sm">alex.dupont@email.com</p>
                            <p class="text-gray-600 text-sm">+1-202-555-0125</p>
                        </div>
                    </div>
                    <button class="h-10 px-4 bg-gray-200 text-gray-900 font-bold rounded-lg text-sm">
                        Contact Customer
                    </button>
                </div>
            </div>

            <!-- Stats -->
            <div class="flex flex-wrap gap-4 p-4">
                <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-medium">Total Spent</p>
                    <p class="text-gray-900 text-2xl font-bold">$2,450.75</p>
                </div>
                <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                    <p class="text-gray-900 text-2xl font-bold">12</p>
                </div>
                <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                    <p class="text-gray-600 text-sm font-medium">Last Active</p>
                    <p class="text-gray-900 text-2xl font-bold">2 days ago</p>
                </div>
            </div>

            <!-- Tabs -->
            <div class="pb-3 sticky top-16 bg-white z-10">
                <div class="flex border-b border-gray-300 px-4 justify-between">
                    <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-blue-500 text-blue-600 pb-3 pt-4"
                        href="#">
                        <p class="text-sm font-bold">Order History</p>
                    </a>
                    <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-transparent text-gray-500 pb-3 pt-4"
                        href="#">
                        <p class="text-sm font-bold">Activity Log</p>
                    </a>
                </div>
            </div>

            <!-- List Items -->
            <div class="flex flex-col">
                <!-- List Item 1 -->
                <div class="flex justify-between items-center gap-4 bg-white px-4 py-3 border-b border-gray-300">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-gray-100 text-gray-900">
                            <span class="material-icons">receipt_long</span>
                        </div>
                        <div>
                            <p class="text-gray-900 text-base font-medium">Order #120594</p>
                            <p class="text-gray-500 text-sm">Oct 24, 2023</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-gray-900 text-base font-medium">$1199.00</p>
                        <span
                            class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">Delivered</span>
                    </div>
                </div>

                <!-- List Item 2 -->
                <div class="flex justify-between items-center gap-4 bg-white px-4 py-3 border-b border-gray-300">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-gray-100 text-gray-900">
                            <span class="material-icons">receipt_long</span>
                        </div>
                        <div>
                            <p class="text-gray-900 text-base font-medium">Order #119843</p>
                            <p class="text-gray-500 text-sm">Sep 15, 2023</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-gray-900 text-base font-medium">$850.50</p>
                        <span
                            class="px-2 py-1 text-xs font-medium bg-orange-100 text-orange-700 rounded-full">Shipped</span>
                    </div>
                </div>

                <!-- List Item 3 -->
                <div class="flex justify-between items-center gap-4 bg-white px-4 py-3 border-b border-gray-300">
                    <div class="flex items-start gap-4">
                        <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-gray-100 text-gray-900">
                            <span class="material-icons">receipt_long</span>
                        </div>
                        <div>
                            <p class="text-gray-900 text-base font-medium">Order #119210</p>
                            <p class="text-gray-500 text-sm">Sep 01, 2023</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <p class="text-gray-900 text-base font-medium">$400.25</p>
                        <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-full">Cancelled</span>
                    </div>
                </div>
            </div>
        </main>

        <!-- Floating Action Button -->
        <button
            class="fixed bottom-6 right-6 flex items-center justify-center h-14 w-14 rounded-full bg-blue-600 text-white shadow-lg">
            <span class="material-icons text-3xl">add_shopping_cart</span>
        </button>
    </div> --}}

    <div class="flex flex-wrap mx-auto">
        <div class="flex-none w-full max-w-full px-3">
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                <main class="flex-1 pb-24">
                    <!-- Profile Header -->
                    <div class="p-4">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 w-full">
                            <div class="flex items-center gap-4">
                                {{-- <div class="h-20 w-20 rounded-full bg-cover bg-center"
                                    style="background-image: url('{{ asset('assets/img/shapes/ceo.jpg') }}');">
                                </div> --}}
                                <div class="h-20 w-20 rounded-full bg-cover bg-center mr-6">
                                    <img src="{{ asset('assets/img/shapes/ceo.jpg') }}" class="h-20 w-20 rounded-full">
                                </div>
                                <div>
                                    <p class="text-gray-900 text-xl font-bold leading-tight">{{ $user->name }}</p>
                                    <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                                    <p class="text-gray-600 text-sm">{{ $user->phone ?? '—' }}</p>
                                </div>
                            </div>
                            <button class="h-10 px-4 bg-gray-200 text-gray-900 font-bold rounded-lg text-sm">
                                Contact Customer
                            </button>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="flex flex-wrap space-x-4 p-4">
                        <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p class="text-gray-600 text-sm font-medium">Total Spent</p>
                            <p class="text-gray-900 text-2xl font-bold">${{ $summary->total_spent }}</p>
                        </div>
                        <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p class="text-gray-600 text-sm font-medium">Total Orders</p>
                            <p class="text-gray-900 text-2xl font-bold">{{ $summary->order_count }}</p>
                        </div>
                        <div class="flex flex-1 flex-col min-w-[158px] bg-gray-100 border border-gray-300 rounded-lg p-4">
                            <p class="text-gray-600 text-sm font-medium">Last Active</p>
                            <p class="text-gray-900 text-2xl font-bold">{{ \Carbon\Carbon::parse($summary->last_order_at)->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="pb-3 sticky top-16 bg-white z-10">
                        <div class="flex border-b border-gray-300 px-4 justify-between">
                            <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-blue-500 text-blue-600 pb-3 pt-4"
                                href="#">
                                <p class="text-sm font-bold">Order History</p>
                            </a>
                            <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-transparent text-gray-500 pb-3 pt-4"
                                href="#">
                                <p class="text-sm font-bold">Activity Log</p>
                            </a>
                        </div>
                    </div>

                    <!-- List Items -->
                    <div class="flex flex-col">
                        @if (isset($orders) && $orders->count())
                            @foreach ($orders as $order)
                                <div
                                    class="flex justify-between items-center gap-4 bg-white px-4 py-3 border-b border-gray-300">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="flex items-center justify-center h-12 w-12 rounded-lg bg-gray-100 text-gray-900">
                                            <i class="fa-solid fa-receipt fa-xl"></i>
                                        </div>
                                        <div>
                                            <p class="text-gray-900 text-base font-bold">Order #{{ $order->id }}</p>
                                            <p class="text-gray-500 text-sm">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <p class="text-gray-900 text-base font-bold">
                                            ${{ number_format($order->total_price, 2) }}</p>
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full {{ $order->order_status === 'delivered' ? 'bg-green-100 text-green-700' : ($order->order_status === 'shipped' ? 'bg-orange-100 text-orange-700' : ($order->order_status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700')) }}">{{ ucfirst($order->order_status) }}</span>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-4 mb-4 px-4 pb-8">
                                @if (method_exists($orders, 'links'))
                                    <div class="flex justify-center">
                                        {{ $orders->links() }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <p class="text-gray-500 text-center h-full">No orders found for this customer.</p>
                        @endif
                    </div>
                </main>

                <!-- Floating Action Button -->
                {{-- <button
                    class="fixed bottom-6 right-6 flex items-center justify-center h-14 w-14 rounded-full bg-blue-600 text-white shadow-lg">
                    <span class="material-icons text-3xl">add_shopping_cart</span>
                </button> --}}
            </div>
        </div>
    </div>

@endsection
