<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlutterPaymentController extends Controller
{
    public function pay_with_flutter(Request $request) {
        return view('pays.paymentPage');
    }
    public function verifyPayment(Request $request) {
        return $request->transaction_id;
    }
}
