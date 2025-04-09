<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->can($request->route()->getName())) {
                return $next($request);
            } else {
                return redirect()->route('dashboard.index')->with('error', 'You do not have the necessary permissions to perform this action.');
            }
        }
        return $next($request);
    }
}
