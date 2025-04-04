<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->roles->first()->name == "Administrator") {
            return view('dashboard.administrator');
        }
        return view('dashboard.dashboard');
    }
}
