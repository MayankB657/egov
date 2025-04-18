<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),
    'app_installed' => env('APP_INSTALLED', false),
    'encryption_key' => env('ENCRYPTION_KEY', '123'),
    'max_upload_size' => env('MAX_UPLOAD_SIZE', 5120),
    'max_uploads' => env('MAX_UPLOADS', 5),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => env('APP_TIMEZONE', 'Asia/Kolkata'),

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    'aliases' => Facade::defaultAliases()->merge([
        'Helper' => App\Helper\Helper::class,
        'Carbon' => \Carbon\Carbon::class,
        'Site' => App\Models\SiteSettings::class,
        'Excel' => Maatwebsite\Excel\Facades\Excel::class,
    ])->toArray(),

    'languages' => [
        'Afrikaans' => 'af',
        'Albanian' => 'sq',
        'Arabic' => 'ar',
        'Azerbaijani' => 'az',
        'Bengali' => 'bn',
        'Bulgarian' => 'bg',
        'Catalan' => 'ca',
        'Chinese (CHN)' => 'zh_CN',
        'Chinese (HKG)' => 'zh_HK',
        'Chinese (TAI)' => 'zh_TW',
        'Croatian' => 'hr',
        'Czech' => 'cs',
        'Danish' => 'da',
        'Dutch' => 'nl',
        'English' => 'en',
        'English (UK)' => 'en_GB',
        'English (US)' => 'en_US',
        'Estonian' => 'et',
        'Filipino' => 'fil',
        'Finnish' => 'fi',
        'French' => 'fr',
        'Georgian' => 'ka',
        'German' => 'de',
        'Greek' => 'el',
        'Gujarati' => 'gu',
        'Hausa' => 'ha',
        'Hebrew' => 'he',
        'Hindi' => 'hi',
        'Hungarian' => 'hu',
        'Indonesian' => 'id',
        'Irish' => 'ga',
        'Italian' => 'it',
        'Japanese' => 'ja',
        'Kannada' => 'kn',
        'Kazakh' => 'kk',
        'Kinyarwanda' => 'rw_RW',
        'Korean' => 'ko',
        'Kyrgyz (Kyrgyzstan)' => 'ky_KG',
        'Lao' => 'lo',
        'Latvian' => 'lv',
        'Lithuanian' => 'lt',
        'Macedonian' => 'mk',
        'Malay' => 'ms',
        'Malayalam' => 'ml',
        'Marathi' => 'mr',
        'Norwegian' => 'nb',
        'Persian' => 'fa',
        'Polish' => 'pl',
        'Portuguese (BR)' => 'pt_BR',
        'Portuguese (POR)' => 'pt_PT',
        'Punjabi' => 'pa',
        'Romanian' => 'ro',
        'Russian' => 'ru',
        'Serbian' => 'sr',
        'Slovak' => 'sk',
        'Slovenian' => 'sl',
        'Spanish' => 'es',
        'Spanish (ARG)' => 'es_AR',
        'Spanish (SPA)' => 'es_ES',
        'Spanish (MEX)' => 'es_MX',
        'Swahili' => 'sw',
        'Swedish' => 'sv',
        'Tamil' => 'ta',
        'Telugu' => 'te',
        'Thai' => 'th',
        'Turkish' => 'tr',
        'Ukrainian' => 'uk',
        'Urdu' => 'ur',
        'Uzbek' => 'uz',
        'Vietnamese' => 'vi',
        'Zulu' => 'zu'
    ],
];
