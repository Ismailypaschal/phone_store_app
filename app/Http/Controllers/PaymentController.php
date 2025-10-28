<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\Payment;


class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // Try to find the order based on the ID from query string
        $order = Order::where('id', $request->order_id)
            ->where('order_status', 'pending')
            ->first();

        if (!$order) {
            return back()->with('error', 'No pending order found for this email or ID.');
        }

        Log::info('PaymentController@pay called');
        return view('pays.paymentPage', [
            'order' => $order,
            'amount' => $request->amount,
            'customer_email' => $request->customer_email,
            'reference' => $request->reference,
        ]);
    }
    public function handleGatewayCallback()
    {
        Log::info('PaymentController@handleGatewayCallback called', ['reference' => request('reference')]);
        $response = $this->verifyPayment(request('reference'));
        Log::info('Payment verification response', ['response' => $response]);
        $result = json_decode($response);
        $data = $result ? $result->data : null;
        // $data = $result->data;
        // Assuming $order is available or needs to be fetched based on $data
        // Example: $order = Order::where('reference', $data->reference)->first();
        // For demonstration, we'll use $data as $order if it contains customer_email
        // Find the order saved earlier using the Paystack reference
        $order = Order::where('reference', $data->reference)->first();
        if ($order) {
            // Send confirmation email
            Mail::to($order->customer_email)->queue(new OrderConfirmationMail($order));

            // Payment table logic
            DB::beginTransaction();
            try {
                $status = $result && $result->status ? 'paid' : 'failed';
                $payment = Payment::create([
                    'order_id' => $order->id,
                    'payment_method' => 'paystack',
                    'amount' => $data->amount / 100, // Convert back to Naira
                    'status' => 'paid',
                    'transaction_id' => $data->id,
                ]);
                DB::commit();
                if ($status === 'paid') {
                    // Send confirmation email
                    Mail::to($order->customer_email)->queue(new OrderConfirmationMail($order));
                    return view('pays.paymentcallback')->with(compact('order', 'data'));
                } else {
                    return back()->withError($result->message ?? "Something went wrong, please try again later");
                }
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Payment record creation failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            return view('pays.paymentcallback')->with(compact('order', 'data'));
        } else {
            Log::error('Payment verification failed', ['message' => $result->message]);
            return back()->withError($result->message);
        }
    }
    public function processPayment()
    {
        Log::info('PaymentController@processPayment called', [
            'order_id' => request('amount'),
            'email' => request('email')
        ]);
        // Fetch the user's pending order (created before payment)
        $order = Order::where('reference', request('reference'))->first();

        if (!$order) {
            return back()->withError("No pending order found for this email.");
        }

        $formData = [
            'amount' => request('amount') * 100, // Convert to kobo
            'email' => request('customer_email'),
            'currency' => 'NGN',
            'reference' => $order->reference, // ✅ Important line
            'callback_url' => route('payment.callback')
        ];
        Log::info('Initiating payment', $formData);
        $pay = json_decode($this->initiatePayment($formData));
        Log::info('Payment initiation response', ['pay' => $pay]);
        if ($pay) {
            if ($pay->status) {
                Log::info('Redirecting to Paystack authorization URL', ['url' => $pay->data->authorization_url]);
                return redirect($pay->data->authorization_url);
            } else {
                Log::error('Payment initiation failed', ['message' => $pay->message]);
                return back()->withError($pay->message);
            }
        } else {
            Log::error('Payment initiation failed: No response');
            return back()->withError("Something went wrong, please try again later");
        }
    }

    public function initiatePayment($formData)
    {
        Log::info('initiatePayment called', $formData);
        $url = 'https://api.paystack.co/transaction/initialize';
        $field_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            [
                'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'cache-control: no-cache',
                // 'content-type: application/json'
            ]
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        Log::info('initiatePayment curl result', ['result' => $result]);
        curl_close($ch);
        return $result;
    }
    public function verifyPayment($reference)
    {
        // Logic to verify payment with a payment gateway
        // $url = "https://api.paystack.co/transaction/verify/$reference";
        $url = 'https://api.paystack.co/transaction/verify/' . rawurlencode($reference);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('PAYSTACK_SECRET_KEY'),
                'Cache-Control: no-cache',
            )
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
