<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Template;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Here you can return the admin dashboard view
        return view('admin.dashboard', [
            'templateCount' => Template::count(),
            'exerciseCount' => Exercise::count(),
            'recentTemplates' => Template::latest()->take(5)->get(),
            'recentUsers' => User::latest()->take(5)->get(),
        ]);
    }
}
