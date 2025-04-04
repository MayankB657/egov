<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Company;
use App\Models\Countries;
use App\Models\User;
use App\Traits\HandlesDatabaseExceptions;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use HandlesDatabaseExceptions;

    public function index()
    {
        $user = Auth::user();
        $sessions = DB::table('sessions')
            ->where('user_id', $user->id)
            ->get()
            ->map(function ($session) {
                return (object) [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'user_agent' => $session->user_agent,
                    'last_activity' => Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                    'location' => getLocationFromIp($session->ip_address),
                    'device' => parseUserAgent($session->user_agent),
                ];
            });
        $countries = Countries::orderBy('name')->get();
        return view('profile', compact('user', 'sessions', 'countries'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $data = User::find($user->id);
            if ($request->type === "details") {
                $data->name = $request->name;
                $data->language = $request->language;
                $data->address = $request->address;
                if ($request->avatar_remove == 1) {
                    Helper::DeleteFile($data->photo);
                    $data->photo = 'public/images/blank.svg';
                }
                if (isset($request->photo)) {
                    $Image = time() . '.' . $request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('storage/user-images'), $Image);
                    Helper::DeleteFile($data->photo);
                    $data->photo = 'public/storage/user-images/' . $Image;
                }
                $msg = "Profile updated successfully.";
            }
            if ($request->type === "companydetails") {
                $company = Company::find($user->company_id);
                $company->name = $request->name;
                $company->website = $request->website;
                $company->mobile = $request->full_phone;
                $company->country_iso = $request->country_code;
                $company->countries_id = $request->countries_id;
                if (isset($request->photo)) {
                    $Image = time() . '.' . $request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('storage/company-images'), $Image);
                    Helper::DeleteFile($company->photo);
                    $company->photo = 'public/storage/company-images/' . $Image;
                }
                if ($request->avatar_remove == 1) {
                    Helper::DeleteFile($company->photo);
                    $company->photo = 'public/images/dummy.png';
                }
                $company->save();
                $msg = "Company details updated successfully.";
            }
            if ($request->type === "email") {
                if ($request->email !== $data->email) {
                    if (Hash::check($request->confirmemailpassword, $data->password)) {
                        $data->email = $request->email;
                    } else {
                        DB::rollback();
                        return redirect()->back()->with('error', 'Confirm password not matched.');
                    }
                }
                $msg = "Email updated successfully.";
            }
            if ($request->type === "password") {
                if (Hash::check($request->currentpassword, $data->password)) {
                    if ($request->newpassword === $request->confirmpassword) {
                        $data->password = Hash::make($request->newpassword);
                    } else {
                        DB::rollback();
                        return redirect()->back()->with('error', 'New password & Confirm new password not matched.');
                    }
                } else {
                    DB::rollback();
                    return redirect()->back()->with('error', 'Current password not matched.');
                }
                $msg = "Password updated successfully.";
            }
            $data->save();
            DB::commit();
            return redirect()->back()->with('success', $msg);
        } catch (QueryException $e) {
            DB::rollback();
            return $this->handleDatabaseException($e)->withInput();
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = User::find($id);
            $data->is_deleted = 1;
            $data->email = time() . '-' . $data->email;
            $data->save();
            DB::commit();
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Account deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage())->withInput();
        }
    }

    public function MarkAsRead($id)
    {
        try {
            $user = Auth::user();
            $notification = $user->notifications->where('id', $id)->first();
            $notification->update(['read_at' => now()]);
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function MarkAllRead()
    {
        try {
            $user = Auth::user();
            foreach ($user->unreadNotifications as $notification) {
                $notification->markAsRead();
            }
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function ShowNotification($id)
    {
        $user = Auth::user();
        $notification = $user->notifications->where('id', $id)->first();
        if ($notification) {
            $modalView = view('components.notification-model', compact('notification'))->render();
            return response()->json([
                'status' => true,
                'modal_html' => $modalView
            ]);
        }
        return response()->json(['status' => false]);
    }
}
