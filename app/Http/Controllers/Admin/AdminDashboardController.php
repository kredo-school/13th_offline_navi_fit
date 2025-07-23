<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Here you can return the admin dashboard view
        return view('admin.dashboard');
    }
}
