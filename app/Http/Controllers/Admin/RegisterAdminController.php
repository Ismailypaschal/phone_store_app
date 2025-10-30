<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class RegisterAdminController extends Controller
{
    public function showSignup() {
        return view('admin.signup');
    }
    public function storeSignup(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:admins,email', 'max:254'],
            'password' => ['required', 'min:6']
        ]);
        $admin = Admin::create($data);
        Auth::login($admin);
        return redirect('admin.index');
    }
}
