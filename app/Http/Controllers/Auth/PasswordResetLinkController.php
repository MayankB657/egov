<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $check = User::where('email', $request->email)->first();
            if (!isset($check)) {
                return back()->with('error', 'Invalid email address');
            }
            $email = $request->email;
            PasswordResetToken::where('email', $email)->delete();

            $url = url('/') . '/reset-password?token=' . $request->_token . '&email=' . Crypt::encryptString($email);
            $data = new PasswordResetToken();
            $data->email = $email;
            $data->token = $request->_token;
            $data->save();
            Mail::send('mail-templates.reset-password', compact('url'), function ($message) use ($email) {
                $message->to($email);
                $message->subject('Reset-Password');
            });
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('login')->with('success', 'Password reset link sent on mail.');
    }
}
