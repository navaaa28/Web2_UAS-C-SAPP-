<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $activeUsers = User::where(function($query) {
            $query->whereNotNull('last_login_at')
                  ->where('last_login_at', '>=', now()->subDays(30));
        })->orWhere('created_at', '>=', now()->subDays(30))->count();
        $totalModules = Module::count();
        
        return view('admin.dashboard', compact('totalUsers', 'activeUsers', 'totalModules'));
    }
} 