<?php

namespace App\Http\Controllers;

use App\Mail\Sendmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailsController extends Controller
{
    public function sendEmail(Request $request)
    {

        Mail::to('aguolisapaschal@gmail.com')->send(new Sendmail());

        return 'email sent successfully';
        // Validate the request data
        // $request->validate([
        //     'to' => 'required|email',
        //     'subject' => 'required|string|max:255',
        //     'body' => 'required|string',
        // ]);

        // // Send the email using Laravel's Mail facade
        // Mail::raw($request->body, function ($message) use ($request) {
        //     $message->to($request->to)
        //             ->subject($request->subject);
        // });

        // return response()->json(['message' => 'Email sent successfully']);
    }
}
