<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    public function index()
    {
        $data = SiteSettings::first();
        return view('site-settings.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $sitesettings = SiteSettings::first();
            if ($request->type === "details") {
                $sitesettings->title = $request->name;
                if (isset($request->photo)) {
                    $Image = time() . '.' . $request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('storage/site-settings'), $Image);
                    Helper::DeleteFile($sitesettings->logo);
                    $sitesettings->logo = 'public/storage/site-settings/' . $Image;
                }
                if (isset($request->favicon)) {
                    $Image = time() . '1.' . $request->favicon->getClientOriginalExtension();
                    $request->favicon->move(public_path('storage/site-settings'), $Image);
                    Helper::DeleteFile($sitesettings->favicon);
                    $sitesettings->favicon = 'public/storage/site-settings/' . $Image;
                }
                $sitesettings->save();
                $msg = "Site basic details updated";
            }
            if ($request->type === "mail_details") {
                try {
                    envWriteNoPorts('MAIL_MAILER', $request->default);
                    envWriteNoPorts('MAIL_HOST', $request->host);
                    envWriteNoPorts('MAIL_PORT', $request->port);
                    envWriteNoPorts('MAIL_USERNAME', $request->username);
                    envWriteNoPorts('MAIL_PASSWORD', $request->password);
                    envWriteNoPorts('MAIL_ENCRYPTION', $request->encryption);
                    envWrite('MAIL_FROM_ADDRESS', $request->from_address . '@' . request()->getHost());
                    envWrite('MAIL_FROM_NAME', $request->from_name);
                    Artisan::call('config:clear');
                    Artisan::call('config:cache');
                    sleep(5);
                    $msg = "Mail details updated successfully.";
                    DB::commit();
                    return response()->json(['status' => true, 'msg' => $msg, 'url' => route('site-settings.index')]);
                } catch (\Throwable $t) {
                    return response()->json(['status' => false, 'msg' => $t->getMessage()]);
                }
            }
            if ($request->type === "danger") {
                envWriteNoPorts('PROJRCT_PATH', $request->prject_path);
                envWriteNoPorts('STORAGE_SPACE', $request->total_storage);
                Artisan::call('config:clear');
                Artisan::call('config:cache');
                sleep(5);
                $msg = "Other details updated successfully.";
            }
            DB::commit();
            return redirect()->route('site-settings.index')->with('success', $msg);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        # code...
    }

    public function update(Request $request, $id)
    {
        return $request->all();
    }

    public function destroy($id)
    {
        # code...
    }
}
