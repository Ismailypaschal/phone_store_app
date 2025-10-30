<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.index');
    }
    public function showTable() {
        return view('admin.table');
    }
    public function showBilling() {
        return view('admin.billing');
    }
    public function showProfile() {
        return view('admin.profile');
    }
}
