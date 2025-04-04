<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialLogin;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Models\Role;

class SocialLoginController extends Controller
{
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function unlinkgoogle()
    {
        SocialLogin::where('users_id', Auth::id())->where('type', 'google')->delete();
        return redirect()->back()->with('success', 'Account unlink successfull.');
    }

    public function linkgoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googlecallback()
    {
        try {
            DB::beginTransaction();
            $data = Socialite::driver('google')->user();
            if (Auth::user()) {
                $user = Auth::user();
                $user->sociallogin()->create([
                    'key' => $data->id,
                    'type' => 'google',
                    'users_id' => $user->id
                ]);
                DB::commit();
                return redirect()->route('profile.index')->with('success', 'Google account link successfull.');
            }
            $socialLogin = SocialLogin::where('key', $data->id)->where('type', 'google')->first();
            if ($socialLogin) {
                $user = User::find($socialLogin->users_id);
                if ($user) {
                    Auth::login($user);
                    DB::commit();
                    return redirect()->route('dashboard.index')->with('success', 'Login successfull.');
                } else {
                    SocialLogin::where('users_id', $socialLogin->users_id)->delete();
                    DB::commit();
                    return redirect()->route('login')->with('error', "User is deleted.");
                }
            } else {
                $user = User::where('email', $data->email)->first();
                if ($user) {
                    return redirect()->route('login')->with('error', "Email already exist login with password and link social account in profile.");
                } else {
                    return redirect()->route('login')->with('success', 'Email not registered with us.');
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('login')->with('error', $e->getMessage())->withInput();
        }
    }
}
