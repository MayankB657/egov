<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\RememberDevices;
use App\Notifications\GeneralNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        if ($user->uniqkey == null) {
            $user->uniqkey = substr(md5($user->id), 0, 10);
        }
        if ($user->current_login != null) {
            $user->last_login = $user->current_login;
        }
        $user->current_login = now();
        $user->is_online = 1;
        $user->save();
        session(['two_step_verify' => true]);
        $redirectPath = RouteServiceProvider::HOME;
        return redirect()->intended($redirectPath);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $user->is_online = 0;
        $user->save();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function logoutSession($sessionId)
    {
        if ($sessionId === session()->getId()) {
            auth()->logout();
            return redirect()->route('login');
        }
        DB::table('sessions')->where('id', $sessionId)->delete();
        return redirect()->back()->with('success', 'Session logged out successfully.');
    }

    public function logoutAllSessions($id)
    {
        DB::table('sessions')->where('user_id', $id)->delete();
        if ($id == auth()->id()) {
            auth()->logout();
            return redirect()->route('login')->with('success', 'Logged out of all sessions.');
        }
        return redirect()->back()->with('success', 'Logged out of all sessions.');
    }
}
