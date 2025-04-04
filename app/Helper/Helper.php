<?php

namespace App\Helper;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Helper
{
    public static function DateHuman($date)
    {
        $date = Carbon::parse($date);
        return $date->diffForHumans();
    }

    public static function DateHumanShort($date)
    {
        $date = Carbon::parse($date);
        return $date->diffForHumans(['short' => true]);
    }

    public static function DeleteFile($path)
    {
        if (File::exists($path) && strpos($path, 'public/images') === false) {
            unlink($path);
        }
        return true;
    }

    // 22 Sep 2024, 9:23 pm date format
    public static function datetimeFormat($datetime)
    {
        if ($datetime != null) {
            return Carbon::parse($datetime)->format('d M Y, h:i a');
        }
        return null;
    }

    public static function timeFormat($datetime)
    {
        return Carbon::parse($datetime)->format('h:i a');
    }

    public static function dateFormat($datetime)
    {
        return Carbon::parse($datetime)->format('d M Y');
    }

    public static function randomBsColor()
    {
        $colors = [
            'bg-light-danger text-danger',
            'bg-light-success text-success',
            'bg-light-warning text-warning',
            'bg-light-info text-info',
            'bg-light-primary text-primary'
        ];
        return $colors[rand(0, 4)];
    }

    public static function statusColor($status)
    {
        switch ($status) {
            case 'Received':
                return 'primary';
                break;
            case 'In Process':
                return 'warning';
                break;
            case 'Rejected':
                return 'danger';
                break;
            case 'Signed':
                return 'success';
                break;
        }
    }
}
