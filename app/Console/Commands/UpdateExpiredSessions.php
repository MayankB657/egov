<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateExpiredSessions extends Command
{
    protected $signature = 'user:update-expired-sessions';
    protected $description = 'Set is_online = 0 for users whose sessions have expired';

    public function handle()
    {
        $sessionLifetime = config('session.lifetime') * 60;
        $twentyMinutes = 20 * 60;
        $currentTime = time();
        $expiryThreshold = $currentTime - $sessionLifetime;
        $twentyMinutesAgo = $currentTime - $twentyMinutes;
        $affectedRows = 0;
        $expiryThresholdDate = Carbon::createFromTimestamp($expiryThreshold, 'Asia/Kolkata');
        $twentyMinutesAgoDate = Carbon::createFromTimestamp($twentyMinutesAgo, 'Asia/Kolkata');

        DB::table('sessions')->where('last_activity', '<', $expiryThreshold)->delete();
        $step1 = DB::table('sessions')->where('user_id', null)->where('last_activity', '<', $twentyMinutesAgo)->delete();
        $step2 = DB::table('users')->where('is_online', '!=', 0)->where('last_active_at', '<', $twentyMinutesAgoDate)->update(['is_online' => 2]);
        $step3 = DB::table('users')->where('is_online', '!=', 0)->where('last_active_at', '<', $expiryThresholdDate)->update(['is_online' => 0]);
        $affectedRows = $step1 + $step2 + $step3;

        $online = DB::table('users')->where('is_online', 1)->count();
        $offline = DB::table('users')->where('is_online', 0)->count();
        $ideal = DB::table('users')->where('is_online', 2)->count();

        Log::info("Expired user sessions updated. changed rows: $affectedRows. Ideal: $ideal. Offline: $offline. Online: $online");
        $this->info('Expired user sessions updated. changed rows: ' . $affectedRows . ' Ideal: ' . $ideal . ' Offline: ' . $offline . ' Online: ' . $online);
    }
}
