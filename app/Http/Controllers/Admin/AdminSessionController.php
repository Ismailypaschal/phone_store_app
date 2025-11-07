<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AdminSessionController extends Controller
{
    public function showSignin()
    {
        return view('admin.signin');
    }
    // public function storeSignin(Request $request)
    // {   
    //     Log::info('Request data:', $request->all());
    //     Log::info('Admin signin hit'); // add this
    //     $data = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => 'required'
    //     ]);
    //     if (! Auth::attempt($data)) {
    //         throw ValidationException::withMessages([
    //             'email' => 'Sorry, incorrect email or password'
    //         ]);
    //     }
    //     return response()->json([
    //         'message' => 'Admin logged in successfully!',
    //     ], 200);
    //     // return redirect('admin.index');
    // }
    public function storeSignin(Request $request)
    {
        Log::info('Admin signin hit');
        Log::info('Request data: ' . json_encode($request->all()));

        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (! Auth::guard('admin')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password'
            ])->status(401);
        }

        // Redirect to dashboard after successful login
        return redirect()->route('dashboard')->with('success', 'Login successful!');
        // return response()->json([
        //     'message' => 'Admin logged in successfully!',
        // ], 201);
    }
}
