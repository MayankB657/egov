<?php

namespace App\Http\Middleware;

use App\Models\SiteSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckInstalltion
{
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.app_installed') !== true) {
            return redirect('/install/initialize');
        }
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return redirect('/install/initialize');
        }
        $check = SiteSettings::where('appkey', config('app.key'))->first();
        if (!isset($check)) {
            return redirect()->route('install.initialize')->with('error', "App key changed, Please validate it");
        } elseif (config('app.app_installed') == true) {
            return $next($request);
        } else {
            return redirect('/install/initialize');
        }
    }
}
