<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }
    public function storeLogin(Request $request) {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if(! Auth::attempt($data)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, incorrect email or password'
            ]);
        }
        return redirect('/');
    }
    public function destroy() {
        Auth::logout();

        return redirect('/');
    }
}
