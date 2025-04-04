<?php

use App\Models\Log;
use GeoSot\EnvEditor\Facades\EnvEditor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

if (!function_exists('addLog')) {
    function addLog($method, $endpoint, $statusCode, $response)
    {
        Log::create([
            'users_id' => Auth::id(),
            'method' => $method,
            'endpoint' => $endpoint,
            'status_code' => $statusCode,
            'response' => $response,
        ]);
    }
}

if (!function_exists('getLocationFromIp')) {
    function getLocationFromIp($ip)
    {
        if ($ip == "::1") {
            return "localhost";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ip-api.com/json/' . $ip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);
        $location = ($res->city ?? "") . ', ' . ($res->regionName ?? "") . ', ' . ($res->country ?? "");
        $location = ($location == ", , ") ? 'NA' : $location;
        return $location;
    }
}

if (!function_exists('getCountryFromIp')) {
    function getCountryFromIp($ip)
    {
        if ($ip == "::1") {
            return "localhost";
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ip-api.com/json/' . $ip,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($response);
        $location = $res->country ?? "";
        return $location;
    }
}

if (!function_exists('parseUserAgent')) {
    function parseUserAgent($userAgent)
    {
        if (!$userAgent) {
            return 'Unknown Device';
        }
        $platform = 'Unknown';
        $browser = 'Unknown';
        if (preg_match('/windows/i', $userAgent)) {
            $platform = 'Windows';
        } elseif (preg_match('/linux/i', $userAgent)) {
            $platform = 'Linux';
        } elseif (preg_match('/macintosh|mac os x/i', $userAgent)) {
            $platform = 'Mac';
        } elseif (preg_match('/iPhone|ipad|ipod/i', $userAgent)) {
            $platform = 'iOS';
        } elseif (preg_match('/android/i', $userAgent)) {
            $platform = 'Android';
        }
        if (preg_match('/chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } elseif (preg_match('/firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/safari/i', $userAgent)) {
            $browser = 'Safari';
        } elseif (preg_match('/msie|trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        }
        return "$browser - $platform";
    }
}

if (!function_exists('validate_purchase')) {
    function validate_purchase($data)
    {
        envWriteNoPorts('DB_HOST', $data['DB_HOST']);
        envWriteNoPorts('DB_PORT', $data['DB_PORT']);
        envWriteNoPorts('DB_DATABASE', $data['DB_DATABASE']);
        envWriteNoPorts('DB_USERNAME', $data['DB_USERNAME']);
        envWriteNoPorts('DB_PASSWORD', $data['DB_PASSWORD']);
        Artisan::call('config:clear');
        Artisan::call('config:cache');
        sleep(5);
        return 'success';
    }
}

if (!function_exists('envWriteNoPorts')) {
    function envWriteNoPorts($key, $value)
    {
        try {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            } else {
                $value = trim($value);
            }
            if (EnvEditor::keyExists($key)) {
                EnvEditor::editKey($key, $value);
            } else {
                EnvEditor::addKey($key, $value);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}
if (!function_exists('envWrite')) {
    function envWrite($key, $value)
    {
        try {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            } else {
                $value = '"' . trim($value) . '"';
            }
            if (EnvEditor::keyExists($key)) {
                EnvEditor::editKey($key, $value);
            } else {
                EnvEditor::addKey($key, $value);
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

if (!function_exists('curlRequest')) {
    function curlRequest($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }
}

if (!function_exists('curlPostRequest')) {
    function curlPostRequest($url, $data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }
}

if (!function_exists('encryptKey')) {
    function encryptKey($string, $staticKey)
    {
        $cipher = 'AES-256-CBC';
        $key = hash('sha256', $staticKey, true);
        $iv = random_bytes(16); // Always 16 bytes for AES-256-CBC
        $encrypted = openssl_encrypt($string, $cipher, $key, 0, $iv);
        return base64_encode($iv . base64_decode($encrypted));
    }
}

if (!function_exists('decryptKey')) {
    function decryptKey($encryptedString, $staticKey)
    {
        $cipher = 'AES-256-CBC';
        $key = hash('sha256', $staticKey, true);
        $data = base64_decode($encryptedString);

        $ivLength = 16; // Always 16 bytes for AES-256-CBC
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);
        return openssl_decrypt(base64_encode($encrypted), $cipher, $key, 0, $iv);
    }
}

if (!function_exists('base64UrlEncode')) {
    function base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        $base64Url = str_replace(['+', '/', '='], ['-', '_', ''], $base64);
        return $base64Url;
    }
}

if (!function_exists('base64UrlDecode')) {
    function base64UrlDecode($data)
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $data);
        $decoded = base64_decode($base64);
        return $decoded;
    }
}
