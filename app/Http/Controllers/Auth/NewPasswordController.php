<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewPasswordController extends Controller
{
    public function create(Request $request)
    {
        $email = $request->email;
        $check  = PasswordResetToken::where('email', Crypt::decryptString($email))->where('token', $request->token)->first();
        if (!isset($check)) {
            return view('auth.forgot-password')->with('error', 'Invalid request');
        }
        return view('auth.confirm-password', compact('email'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = User::where('email', Crypt::decryptString($request->email))->first();
            if (!isset($data)) {
                return back()->with('error', 'Invalid email address');
            }
            $data->password = Hash::make($request->password);
            $token = $request->_token;
            $data->remember_token = $token;
            $data->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
        return redirect()->route('login')->with('success', 'Password reset successfully, Please login with new password.');
    }
}
