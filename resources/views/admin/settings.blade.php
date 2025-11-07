@extends('layouts.admin-app')
@section('content')

    <div class="flex flex-wrap mx-auto">
        <div class="w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-xl rounded-lg">

                <!-- Tabs -->
                <nav class="sticky top-0 z-10 bg-white px-4 pb-3 border-b border-gray-200">
                    <div class="flex justify-between">
                        <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-blue-500 pb-3 pt-4 text-blue-600"
                            href="#">
                            <p class="text-sm font-bold">App Settings</p>
                        </a>
                        <a class="flex-1 flex flex-col items-center justify-center border-b-4 border-transparent pb-3 pt-4 text-gray-500"
                            href="#">
                            <p class="text-sm font-bold">User Roles</p>
                        </a>
                    </div>
                </nav>

                <!-- Main Content -->
                <main class="flex-grow px-4 pb-24 pt-4">

                    <!-- General Settings -->
                    <section class="rounded-lg border border-gray-200 bg-white mb-6">
                        <header class="border-b border-gray-200 p-4">
                            <h2 class="text-lg font-bold text-gray-900">General</h2>
                        </header>
                        <div class="p-4">
                            <label class="block mb-4">
                                <p class="pb-2 text-sm font-medium text-gray-700">Store Name</p>
                                <input
                                    class="form-input w-full h-12 rounded border border-gray-300 bg-gray-100 p-3 text-base text-gray-900"
                                    placeholder="e.g. Mobile World" value="PhoneDash">
                            </label>

                            <label class="block mb-4">
                                <p class="pb-2 text-sm font-medium text-gray-700">Default Currency</p>
                                <select
                                    class="form-select w-full h-12 rounded border border-gray-300 bg-gray-100 p-3 text-base text-gray-900">
                                    <option>USD - US Dollar</option>
                                    <option>EUR - Euro</option>
                                    <option>GBP - British Pound</option>
                                </select>
                            </label>

                            <label class="block mb-2">
                                <p class="pb-2 text-sm font-medium text-gray-700">Language</p>
                                <select
                                    class="form-select w-full h-12 rounded border border-gray-300 bg-gray-100 p-3 text-base text-gray-900">
                                    <option>English</option>
                                    <option>Spanish</option>
                                    <option>French</option>
                                </select>
                            </label>
                        </div>
                    </section>

                    <!-- Notifications -->
                    <section class="rounded-lg border border-gray-200 bg-white mb-6">
                        <header class="border-b border-gray-200 p-4">
                            <h2 class="text-lg font-bold text-gray-900">Notifications</h2>
                        </header>
                        <div class="p-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <div>
                                    <p class="font-medium text-gray-900">New Orders</p>
                                    <p class="text-sm text-gray-500">Notify on new order received</p>
                                </div>
                                <input type="checkbox" checked class="form-checkbox h-5 w-5 text-blue-600">
                            </div>

                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <p class="font-medium text-gray-900">Low Stock</p>
                                    <p class="text-sm text-gray-500">Notify when stock is low</p>
                                </div>
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                            </div>
                        </div>
                    </section>

                    <!-- Maintenance & Security -->
                    <section class="rounded-lg border border-gray-200 bg-white mb-6">
                        <header class="border-b border-gray-200 p-4">
                            <h2 class="text-lg font-bold text-gray-900">Maintenance & Security</h2>
                        </header>
                        <div class="p-4">
                            <div class="flex items-center justify-between py-3 border-b border-gray-200">
                                <div>
                                    <p class="font-medium text-gray-900">Maintenance Mode</p>
                                    <p class="text-sm text-gray-500">Temporarily disable store access</p>
                                </div>
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-600">
                            </div>

                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <p class="font-medium text-gray-900">Enforce 2FA</p>
                                    <p class="text-sm text-gray-500">Require two-factor authentication</p>
                                </div>
                                <input type="checkbox" checked class="form-checkbox h-5 w-5 text-blue-600">
                            </div>
                        </div>
                    </section>

                </main>

                <!-- Bottom Action Bar -->
                <div class="bg-white p-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <button
                            class="w-1/2 mr-2 rounded border border-gray-300 bg-white px-4 py-3 text-base font-bold text-gray-900">Cancel</button>
                        <button style="background-color: blue"
                            class="w-1/2 ml-2 rounded bg-blue-600 px-4 py-3 text-base font-bold text-white">Save
                            Changes</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection