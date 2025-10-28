<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Log;
use App\Models\Payment;

class FlutterPaymentController extends Controller
{
    public function pay_with_flutter(Request $request)
    {
        return view('pays.paymentPage');
    }
    public function verifyPayment(Request $request)
    {
        try {
            // Example of verifying data received from Flutterwave
            // $transaction_id = $request->transaction_id;
            // $reference = $request->reference;
            // $status = $request->status;
            $transaction_id = $request->input('transaction_id');
            $reference = $request->input('reference');
            $status = $request->input('status');
            $amount = $request->input('amount');
            $email = $request->input('email') ?? $request->input('customer.email');
            $order_id = $request->input('order_id');

            if ($status == 'completed') {
                // Create or Update Order data
                $order = Order::updateOrCreate([
                    'id' => $order_id,
                ], [
                    'customer_email' => $email,
                    'amount' => $amount,
                    'reference' => $reference,

                ]);
                if ($order) {
                    // Send confirmation email
                    try {
                        Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));
                        // Payment table logic
                        DB::beginTransaction();
                        try {
                            $payment = Payment::create([
                                'order_id' => $order->id,
                                'payment_method' => 'flutterwave',
                                'amount' => $amount,
                                'status' => 'paid',
                                'transaction_id' => $transaction_id,
                            ]);
                            DB::commit();
                        } catch (\Exception $e) {
                            DB::rollback();
                            Log::error('Payment record creation failed', [
                                'error' => $e->getMessage(),
                                'trace' => $e->getTraceAsString()
                            ]);
                        }
                    } catch (\Exception $mailError) {
                        Log::error('Mail send failed: ' . $mailError->getMessage());
                    }
                }
                // ✅ Return a success response so the JS redirect can happen
                return response()->json(['success' => true, 'reference' => $reference]);
            }
        } catch (\Exception $e) {
            Log::error('Payment verification error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }
    public function showPaymentDetails($reference)
    {
        $order = Order::where('reference', $reference)->first();

        if (!$order) {
            return redirect()->route('store.index')->with('error', 'Order not found.');
        }

        return view('pays.flutterPaymentSuccess', compact('order'));
    }
}
