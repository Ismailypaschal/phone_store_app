<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class RegisterUserController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }
    public function storeRegister(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email', 'max:254'],
            'password' => ['required', Password::min(6)]
        ]);
        $user = User::create($data);
        Auth::login($user);
        
        // Send welcome email after registration
        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect('/');
    }

}
