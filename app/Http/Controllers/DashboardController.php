<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $inward = Letter::where('type', 'Inward')->get();
        $outward = Letter::where('type', 'Outward')->get();
        $case = Topic::where('is_deleted', 0)->get();
        if ($user->roles->first()->name == "Administrator") {
            return view('dashboard.administrator', compact('inward', 'outward','case'));
        }
        return view('dashboard.dashboard', compact('inward', 'outward','case'));
    }
}
