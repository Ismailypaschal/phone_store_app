@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-center">Payment Successful!</h2>
        <table class="w-100">
            <tbody>
                <tr class="flex justify-between"><td>Status: </td><td>{{$data->status}}</td></tr>
                <tr class="flex justify-between"><td>Reference: </td><td>{{$data->reference}}</td></tr>
                <tr class="flex justify-between"><td>Amount: </td><td>₦{{number_format($data->amount/100, 2)}}</td></tr>
                <tr class="flex justify-between"><td>Fees: </td><td>₦{{number_format($data->fees/100, 2)}}</td></tr>
                <tr class="flex justify-between"><td>Email: </td><td>{{$data->customer->email}}</td></tr>
                <a href="{{ route('store.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">Continue Shopping</a>
            </tbody>
        </table>
        {{-- @if (session()->has('error'))
        {{ session()->get('error')}}
            
        @endif --}}
    </div>
@endsection