
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;  // For Guzzle (Laravel default)
use App\Models\User;


class TestFlutterController extends Controller
{
public function verifyPayment(Request $request)
{
    try {
        $transaction_id = $request->input('transaction_id');  // From callback
        $flw_secret_key = env('FLUTTERWAVE_SECRET_KEY');  // In .env

        // Verify with Flutterwave API (replaces direct input reliance)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $flw_secret_key,
        ])->get("https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify");

        if ($response->failed()) {
            Log::error('Flutterwave verification failed', ['status' => $response->status(), 'body' => $response->body()]);
            return response()->json(['success' => false, 'message' => 'Verification failed'], 500);
        }

        $result = $response->json();  // Full API response
        $data = $result['data'] ?? null;  // Extract nested data

        if (!$data || $data['status'] !== 'successful') {  // Flutterwave uses 'successful'
            return response()->json(['success' => false, 'message' => $data['message'] ?? 'Payment incomplete']);
        }

        // Now use $data for processing (safer than raw request)
        $reference = $data['tx_ref'] ?? $request->input('reference');  // Fallback
        $status = $data['status'];
        $amount = $data['amount'];
        $email = $data['customer']['email'] ?? $request->input('email');
        $order_id = $data['meta']['order_id'] ?? $request->input('order_id');  // Assume you pass order_id in meta during charge

        // Rest of your code: updateOrCreate Order, create Payment, send email...
        $order = Order::updateOrCreate(['id' => $order_id], [
            'customer_email' => $email,
            'amount' => $amount,
            'reference' => $reference,
        ]);

        if ($order) {
            Mail::to($order->customer_email)->send(new OrderConfirmationMail($order));

            DB::beginTransaction();
            try {
                $payment = Payment::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'payment_method' => 'flutterwave',
                    'amount' => $amount,
                    'status' => 'paid',
                    'transaction_id' => $transaction_id,
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Payment record creation failed', ['error' => $e->getMessage()]);
            }
        }

        // Return JSON with extracted data for JS to handle redirect
        return response()->json([
            'success' => true,
            'reference' => $reference,
            'data' => $data  // Pass full verified data for success page
        ]);

    } catch (\Exception $e) {
        Log::error('Payment verification error: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'Server error'], 500);
    }
}

}
?>