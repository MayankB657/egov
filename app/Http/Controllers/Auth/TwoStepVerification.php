<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RememberDevices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TwoStepVerification extends Controller
{
    public function index()
    {
        return view('auth.two-step');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $otp = $request->code_1 . $request->code_2 . $request->code_3 . $request->code_4 . $request->code_5 . $request->code_6;
            $data = [
                'secret' => $user->verification_secret,
                'token' => $otp
            ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => config('app.node_url') . '/check/' . $user->id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            if ($response) {
                $res = json_decode($response);
                if ($res->status === false) {
                    DB::commit();
                    return response()->json(['status' => false, 'msg' => $res->msg, 'reset' => true]);
                } else {
                    if (isset($request->dont_ask_again)) {
                        $mac = substr(exec('getmac'), 0, 17);
                        $device = new RememberDevices();
                        $device->name = parseUserAgent($request->header('User-Agent')) ?? 'Unknown';
                        $device->mac = $mac;
                        $device->users_id = $user->id;
                        $device->save();
                    }
                    session(['two_step_verify' => true]);
                    DB::commit();
                    return response()->json(['status' => true, 'msg' => "Login successful.", 'url' => route('dashboard.index')]);
                }
            } else {
                DB::commit();
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login')->with('error', "Something went wrong, please try again later.");
            }
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }
}
