<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->setTimezone();
    }

    public function boot(): void
    {
        //
    }

    public static function setTimezone()
    {
        $currentTime = Carbon::now();
        $currentTime->setTimezone('Asia/Kolkata');
        return;
    }
}
