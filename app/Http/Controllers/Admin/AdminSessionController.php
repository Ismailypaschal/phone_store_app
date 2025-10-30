<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSessionController extends Controller
{   
    public function showSignin() {
        return view('admin.signin');
    }
}
