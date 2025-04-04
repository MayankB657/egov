<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->is_online == 0 || Auth::user()->is_online == 2) {
                Auth::user()->update(['is_online' => 1]);
            }
            Auth::user()->update(['last_active_at' => now()]);
        }
        return $next($request);
    }
}
