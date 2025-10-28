
@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-center">Payment Successful!</h2>
        <table class="w-100">
            <tbody>
                <tr class="flex justify-between"><td>First Name: </td><td>{{$order->first_name}}</td></tr>
                <tr class="flex justify-between"><td>Reference: </td><td>{{$order->reference}}</td></tr>
                <tr class="flex justify-between"><td>Amount: </td><td>₦{{ number_format($order->total_price, 2) }}</td></tr>
                <tr class="flex justify-between"><td>Email: </td><td>{{$order->customer_email}}</td></tr>
                <a href="{{ route('store.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">Continue Shopping</a>
                {{-- <tr class="flex justify-between"><td>Status: </td><td>{{$data->status}}</td></tr>
                <tr class="flex justify-between"><td>Reference: </td><td>{{$data->reference}}</td></tr>
                <tr class="flex justify-between"><td>Amount: </td><td>₦{{$data->amount}}</td></tr>
                <tr class="flex justify-between"><td>Fees: </td><td>₦{{$data->fees}}</td></tr>
                <tr class="flex justify-between"><td>Email: </td><td>{{$data->customer->email}}</td></tr> --}}
            </tbody>
        </table>    
    </div>
@endsection