@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-center">Payment Successful!</h2>
        <table class="w-100">
            <tbody>
                <tr class="flex justify-between"><td>Status: </td><td>{{$data->status}}</td></tr>
                <tr class="flex justify-between"><td>Reference: </td><td>{{$data->reference}}</td></tr>
                <tr class="flex justify-between"><td>Amount: </td><td>₦{{$data->amount/100}}</td></tr>
                <tr class="flex justify-between"><td>Fees: </td><td>₦{{$data->fees/100}}</td></tr>
                <tr class="flex justify-between"><td>Email: </td><td>{{$data->customer->email}}</td></tr>
                <a href="{{ route('store.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">Continue Shopping</a>
            </tbody>
        </table>
        {{-- @if (session()->has('error'))
        {{ session()->get('error')}}
            
        @endif
        <h1 class="text-lg font-semibold mb-4">Payment</h1>
        <form method="POST" action="{{ route('payment.process') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium">Amount</label>
                <input type="text" name="amount" class="mt-1 w-full border rounded px-3 py-2" required autofocus>
                @error('amount')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full border rounded px-3 py-2"
                    required autofocus>
                @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex gap-2 items-center">
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Make Payment</button>
            </div>
        </form> --}}
    </div>
@endsection