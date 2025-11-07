<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegisterAdminController extends Controller
{
    public function showSignup()
    {
        return view('admin.signup');
    }
    public function storeSignup(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:admins,email', 'max:254'],
            'password' => ['required', 'min:6']
        ]);
        // Hash the password before storing
        $data['password'] = bcrypt($data['password']);

        $admin = Admin::create($data);

        Auth::guard('admin')->login($admin);
        return redirect(route('dashboard'));
        // return response()->json([
        //     'message' => 'Admin created successfully!',
        //     'data' => $admin,
        // ], 201);
    }
}
