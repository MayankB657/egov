<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        Artisan::call('user:update-expired-sessions');
        $RoleList = Role::all();
        $searchQuery = $request->input('search');
        $searchRole = $request->input('filter_role');
        $data = User::with('roles')->where('is_deleted', 0)
            ->where(function ($query) use ($searchQuery, $searchRole) {
                if (!empty($searchQuery)) {
                    $query->where('users.name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('users.email', 'like', '%' . $searchQuery . '%');
                }
                if (!empty($searchRole)) {
                    $query->role($searchRole);
                }
            })->orderBy('id', 'desc')->paginate(10);
        $i = (request()->input('page', 1) - 1) * 10;
        if ($request->ajax()) {
            $view = view('users.row', compact('data', 'i'))->render();
            $pagination = $data->appends($request->except('page'))->links()->toHtml();
            return response()->json(['html' => $view, 'pagination' => $pagination, 'i' => $i]);
        }
        return view('users.index', compact('data', 'RoleList'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'email' => 'required|unique:users|max:255',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if (isset($request->photo)) {
                $Image = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('storage/user-images'), $Image);
                $user->photo = 'public/storage/user-images/' . $Image;
            }
            $user->save();
            $role = Role::findOrFail($request->role);
            $user->assignRole($role);
            DB::commit();
        } catch (QueryException | \Throwable $e) {
            DB::rollback();
            if ($e instanceof QueryException) {
                return response()->json(['status' => false, 'msg' => $this->handleDatabaseException($e)]);
            } else {
                return response()->json(['status' => false, 'msg' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => true, 'msg' => 'User created successfully']);
    }

    public function show($id)
    {
        $today = Carbon::now();
        $dayafterten = Carbon::now()->addDays(10);
        $daysList = [];
        while ($today->lte($dayafterten)) {
            $daysList[$today->format('d')] = $today->format('D');
            $today->addDay();
        }
        $user = User::find($id);
        $logs = Log::where('users_id', $user->id)->orderBy('created_at', 'desc')->limit(10)->get();
        $sessions = DB::table('sessions')
            ->where('user_id', $id)
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
        return view('users.view', compact('user', 'today', 'daysList', 'sessions', 'logs'));
    }

    public function edit($id)
    {
        $RoleList = Role::all();
        $user = User::find($id);
        $view = view('users.edit', compact('user', 'RoleList'))->render();
        return response()->json(['html' => $view]);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'email' => [
                    'max:255',
                    'required',
                    Rule::unique('users')->ignore($id),
                ],
            ]);
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->language = $request->language;
            $user->address = $request->address;
            if ($request->password != "") {
                $user->password = Hash::make($request->password);
            }
            if (isset($request->photo)) {
                $Image = time() . '.' . $request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('storage/user-images'), $Image);
                Helper::DeleteFile($user->photo);
                $user->photo = 'public/storage/user-images/' . $Image;
            }
            if ($request->avatar_remove == 1) {
                Helper::DeleteFile($user->photo);
                $user->photo = "public/images/blank.svg";
            }
            $user->save();
            $roleId = NULL;
            if ($user->roles->first() != NULL) {
                $roleId = $user->roles->first()->id;
            }
            if ($roleId != $request->role || $roleId == NULL) {
                if ($roleId != NULL) {
                    $user->removeRole($roleId);
                }
                $user->assignRole($request->role);
            }
            DB::commit();
        } catch (QueryException | \Throwable $e) {
            DB::rollback();
            if ($e instanceof QueryException) {
                return $this->handleDatabaseException($e)->withInput();
            } else {
                return response()->json(['status' => false, 'msg' => $e->getMessage()]);
            }
        }
        return response()->json(['status' => true, 'msg' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->is_deleted = 1;
        $user->save();
        return redirect()->route('users.index')->with('success', "User deleted successfully.");
    }

    public function downloadReport()
    {
        $logs = Log::where('users_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $filename = "user_logs_" . now()->format('Y_m_d_H_i_s') . ".csv";
        $handle = fopen(storage_path("app/public/{$filename}"), 'w');
        fputcsv($handle, ['Status', 'Method', 'Endpoint', 'Response', 'Date & Time']);
        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->status_code == 200 ? '200 OK' : $log->status_code . ' ERR',
                $log->method,
                $log->endpoint,
                $log->response,
                $log->created_at->format('d M Y, h:i a')
            ]);
        }
        fclose($handle);
        return response()->download(storage_path("app/public/{$filename}"));
    }

    public function LoginAsUser($id)
    {
        $currentId = Auth::id();
        if (session()->has('return_admin')) {
            session()->forget('return_admin');
        } else {
            session()->put('return_admin', $currentId);
        }
        $user = User::find($id);
        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    public function ChangeLanguage($lang)
    {
        $user = Auth::user();
        $user->language = $lang;
        $user->save();
        return redirect()->back()->with('success', 'Language changed successfully.');
    }
}
