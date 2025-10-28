@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white rounded-lg shadow-sm p-6">
        @if (session()->has('error'))
            {{ session()->get('error')}}

        @endif
        <h1 class="text-lg font-semibold mb-4">Payment</h1>
        <form method="POST" action="{{ route('flutter_payment.page') }}" class="space-y-4" id="paymentForm">
            @csrf
            <div>
                <label class="block text-sm font-medium">Amount</label>
                <input type="number" id="amount" name="amount" value="{{ request('amount') }}"
                    class="mt-1 w-full border rounded px-3 py-2" readonly>
                @error('amount')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ request('customer_email') }}"
                    class="mt-1 w-full border rounded px-3 py-2" readonly>
                @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Order ID</label>
                <input type="text" id="order_id" name="order_id" value="{{ request('order_id') }}"
                    class="mt-1 w-full border rounded px-3 py-2" readonly>
            </div>
            <div class="flex gap-3">
                <h4 class="">Reference ID:</h4>
                <p class="text-green-500">{{ request('reference') }} </p>
            </div>
            <div class="flex gap-2 items-center">
                <button class="px-4 py-2 bg-blue-600 text-white rounded" id="flutterwaveBtn">Make Payment</button>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
        $(function () {
            // Prevent default form submission
            $('#paymentForm').on('submit', function (e) {
                e.preventDefault();
            });

            // Handle Flutterwave payment
            document.getElementById('flutterwaveBtn').addEventListener('click', function (e) {
                e.preventDefault();

                const amount = $('input[name="amount"]').val();
                const email = $('input[name="email"]').val();
                const order_id = $('input[name="order_id"]').val();
                const reference = "{{ 'ORD_' . substr(rand(0, time()), 0, 7) }}";

                FlutterwaveCheckout({
                    public_key: "{{ env('FLUTTERWAVE_PUBLIC_KEY') }}",
                    tx_ref: reference,
                    amount: amount,
                    currency: "NGN",
                    payment_options: "card, banktransfer, ussd",
                    callback: function (data) {
                        const transaction_id = data.transaction_id;
                        console.log(data);
                        //  Make Ajax request
                        $.ajax({
                            url: '{{ route('flutter_payment.verify') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                transaction_id,
                                order_id: order_id,
                                amount: amount,
                                email: email,
                                reference: reference,
                                status: data.status
                            },
                            success: function (response) {
                                // alert('Payment successful! Transaction ID: ' + data.transaction_id);
                                console.log(response);
                                // ✅ Redirect to show payment data
                                window.location.href = "{{ url('/payment/success') }}/" + reference;
                            },
                            error: function (xhr, status, error) {
                                alert('Payment verification failed. Please contact support.');
                            }
                        })
                    },
                    onclose: function () {
                        console.log('Payment window closed');
                    },
                    customer: {
                        email: email,
                        order_id: order_id,
                    },
                    customizations: {
                        title: "Phone Store Purchase",
                        description: "Payment for order #" + reference,
                        logo: "{{ asset('images/logo.png') }}"
                    }
                });
            });
        });
    </script>

    </script>
@endsection