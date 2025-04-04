<?php

namespace App\View\Components;

use App\Models\SiteSettings;
use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function render(): View
    {
        $route = explode('/', Request::path());
        if (!isset($route[0])) {
            $route[0] = '';
        }
        $lastindex = count($route) - 1 ?? 0;
        $sitesettings = SiteSettings::first();
        return view('layout.app', compact('route', 'lastindex', 'sitesettings'));
    }
}
