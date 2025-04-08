<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $inward = Letter::where('type', 'Inward')->get();
        $outward = Letter::where('type', 'Outward')->get();
        if ($user->roles->first()->name == "Administrator") {
            return view('dashboard.administrator', compact('inward', 'outward'));
        }
        return view('dashboard.dashboard');
    }
}
