@php
    $str = Str::random(21);
    session()->put('hash_token', $str);

    $php_version_success = false;
    $mysql_success = false;
    $curl_success = false;
    $gd_success = false;
    $allow_url_fopen_success = false;
    $timezone_success = true;

    $php_version_required_min = '8.2';
    $php_version_required_max = '9.0';
    $current_php_version = phpversion();

    //check required php version
    if (
        floatval($current_php_version) >= floatval($php_version_required_min) &&
        floatval($current_php_version) < $php_version_required_max
    ):
        $php_version_success = true;
    endif;

    //check mySql
    if (function_exists('mysqli_connect')):
        $mysql_success = true;
    endif;

    //check curl
    if (function_exists('curl_version')):
        $curl_success = true;
    endif;

    //check gd
    if (extension_loaded('gd') && function_exists('gd_info')):
        $gd_success = true;
    endif;

    //check allow_url_fopen
    if (ini_get('allow_url_fopen')):
        $allow_url_fopen_success = true;
    endif;

    //check allow_url_fopen
    $timezone_settings = ini_get('date.timezone');
    if ($timezone_settings):
        $timezone_success = true;
    endif;

    //check if all requirement is success
    if ($php_version_success && $mysql_success && $curl_success && $gd_success && $allow_url_fopen_success):
        $all_requirement_success = true;
    else:
        $all_requirement_success = false;
    endif;

    if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')):
        $writeable_directories = [
            '../app',
            '../config',
            '../routes',
            '../resources',
            '../public',
            '../storage',
            '../.env',
            '../bootstrap/cache',
        ];
    else:
        $writeable_directories = [
            './app',
            './config',
            './routes',
            './resources',
            './public',
            './storage',
            '.env',
            './bootstrap/cache',
        ];
    endif;

    foreach ($writeable_directories as $value):
        if (!is_writeable($value)):
            $all_requirement_success = false;
        endif;
    endforeach;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('/') }}/public/images/favicon-32x32.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ url('/') }}/public/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/mbiconstyle.css" rel="stylesheet" type="text/css" />
    <script>
        const lang = "en";
    </script>
</head>
<style>
    body {
        background-image: url('{{ asset('public/images/bg6.jpg') }}');
        background-size: cover;
    }

    [data-bs-theme="dark"] body {
        background-image: url('{{ asset('public/images/bg6-dark.jpg') }}');
        background-size: cover;
    }
</style>

<body class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root">
        @include('alert')
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="d-flex flex-column flex-row-fluid">
                <div class="content d-flex flex-column flex-column-fluid">
                    <div class="post d-flex flex-column-fluid mb-10">
                        <div class="container-xxl">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title fs-3 fw-bold">Project Settings</div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div class="separator"></div>
                                    <ul
                                        class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                        <li class="nav-item">
                                            <a
                                                class="nav-link nav-1 text-active-primary py-5 me-6 active">Pre-Installation</a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                class="nav-link nav-2 disabled text-active-primary py-5 me-6">Configuration</a>
                                        </li>
                                        <li class="nav-item">
                                            <a
                                                class="nav-link nav-3 disabled text-active-primary py-5 me-6">Finished</a>
                                        </li>
                                    </ul>
                                    <div class="separator mb-10"></div>
                                    <div class="step step-1">
                                        <div class="section mb-5">
                                            <p>1. Please configure your PHP settings to match following requirements:
                                            </p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-3">PHP Settings</th>
                                                            <th class="col-3">Current Version</th>
                                                            <th class="col-3">Required Version</th>
                                                            <th class="col-3 text-center">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>PHP Version</td>
                                                            <td><?php echo phpversion(); ?></td>
                                                            <td><?php echo $php_version_required_min; ?>
                                                                or Later
                                                            </td>
                                                            <td class="text-center">
                                                                @if ($php_version_success)
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="section mb-5">
                                            <p>2. Please make sure the extensions/settings listed below are
                                                installed/enabled:</p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-3">Extension/settings</th>
                                                            <th class="col-3">Current Settings</th>
                                                            <th class="col-3">Required Settings</th>
                                                            <th class="col-3 text-center">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>MySQLi</td>
                                                            <td>
                                                                @if ($mysql_success)
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if ($mysql_success)
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>GD</td>
                                                            <td>
                                                                @if ($gd_success)
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if ($gd_success)
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>cURL</td>
                                                            <td>
                                                                @if ($curl_success)
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if ($curl_success)
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>allow_url_fopen</td>
                                                            <td>
                                                                @if ($allow_url_fopen_success)
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if ($allow_url_fopen_success)
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>zip</td>
                                                            <td>
                                                                @if (extension_loaded('zip'))
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('zip'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>zlip</td>
                                                            <td>
                                                                @if (extension_loaded('zlib'))
                                                                    On
                                                                @else
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('zlib'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>OpenSSL PHP Extension</td>
                                                            <td>
                                                                @if (OPENSSL_VERSION_NUMBER < 0x009080bf)
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @else
                                                                    On
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (OPENSSL_VERSION_NUMBER < 0x009080bf)
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @else
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>PDO PHP Extension</td>
                                                            <td>
                                                                @if (PDO::getAvailableDrivers())
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (PDO::getAvailableDrivers())
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>BCMath PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('bcmath'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('bcmath'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ctype PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('ctype'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('ctype'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Fileinfo PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('fileinfo'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('fileinfo'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mbstring PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('mbstring'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('mbstring'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tokenizer PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('tokenizer'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('tokenizer'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>XML PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('xml'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('xml'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i
                                                                        class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>JSON PHP Extension</td>
                                                            <td>
                                                                @if (extension_loaded('json'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                @if (extension_loaded('json'))
                                                                    <i
                                                                        class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                @else
                                                                    <i
                                                                        class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>PHP ZipArchive Class</td>
                                                            <td>
                                                                @if (class_exists('ZipArchive'))
                                                                    On
                                                                @else
                                                                    @php $all_requirement_success = false; @endphp
                                                                    Off
                                                                @endif
                                                            </td>
                                                            <td>On</td>
                                                            <td class="text-center">
                                                                <i
                                                                    class="status fa {{ class_exists('ZipArchive') ? 'text-success bi bi-check-circle-fill fs-2' : 'text-danger bi bi-x-circle-fill fs-2' }}"></i>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="section mb-5">
                                            <p>3. Please make sure you have set the <strong>writable</strong> permission
                                                on the following folders/files:</p>
                                            <hr />
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead class="">
                                                        <tr>
                                                            <th class="col-3">Folder</th>
                                                            <th class="col-3"></th>
                                                            <th class="col-3"></th>
                                                            <th class="col-3 text-center">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($writeable_directories as $value)
                                                            <tr>
                                                                <td>{{ $value }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-center">
                                                                    @if (is_writeable($value))
                                                                        <i
                                                                            class="text-success bi bi-check-circle-fill fs-2"></i>
                                                                    @else
                                                                        @php
                                                                            $all_requirement_success = false;
                                                                        @endphp
                                                                        <i
                                                                            class="text-danger bi bi-x-circle-fill fs-2"></i>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($all_requirement_success)
                                        <div class="step step-2 d-none">
                                            <form class="form FormClass" action="{{ route('DbDetails') }}"
                                                id="formDbDetails" method="POST">
                                                @csrf
                                                <div class="section">
                                                    <p>1. Please enter your database connection details.</p>
                                                    <hr />
                                                    <input type="hidden" name="random_token"
                                                        value="{{ bcrypt($str) }}">
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Database Host</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="host"
                                                                data-bvalidator="required"
                                                                value="{{ old('host') ?? 'localhost' }}"
                                                                placeholder="Database Host (usually localhost)" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Database Port</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="port"
                                                                data-bvalidator="required,digit"
                                                                value="{{ old('port') ?? '3306' }}"
                                                                placeholder="Database Port (usually 3306)" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Database User</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="db_user"
                                                                data-bvalidator="required"
                                                                value="{{ old('db_user') ?? '' }}"
                                                                placeholder="Database user name" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3">
                                                                Password
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control"
                                                                name="db_password"
                                                                value="{{ old('db_password') ?? '' }}"
                                                                placeholder="Database user password" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Database Name</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="db_name"
                                                                data-bvalidator="required"
                                                                value="{{ old('db_name') ?? '' }}"
                                                                placeholder="Database Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end pb-6 px-9">
                                                    <button type="submit" class="btn btn-success me-10 btn-submit">
                                                        <span class="indicator-label">
                                                            Connect
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Please wait... <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                            <form class="form FormClass d-none" method="POST"
                                                action="{{ route('install.finalize') }}" id="formUserDetails">
                                                @csrf
                                                <div class="section-admin-details">
                                                    <p>Please enter your account details for administration.</p>
                                                    <hr />
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Name</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="name"
                                                                data-bvalidator="required"
                                                                value="{{ old('name') }}"
                                                                placeholder="Enter name" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Email</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group">
                                                            <input type="text" class="form-control" name="email"
                                                                placeholder="example@domain.com"
                                                                data-bvalidator="email,required"
                                                                data-bvalidator-msg="Enter email address."
                                                                value="{{ old('email') }}"
                                                                placeholder="Enter email" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-8">
                                                        <div class="col-xl-2">
                                                            <div class="fs-6 fw-semibold mt-2 mb-3 required">
                                                                Password</div>
                                                        </div>
                                                        <div class="col-xl-10 fv-row form-group"
                                                            data-kt-password-meter="true">
                                                            <div class="position-relative mb-3">
                                                                <input class="form-control form-control-lg"
                                                                    type="password" name="password"
                                                                    autocomplete="off"
                                                                    data-bvalidator="required,passwordFormat"
                                                                    placeholder="Enter Password"
                                                                    data-bvalidator-msg="Paasword strength must be 100%." />
                                                                <span
                                                                    class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2 showPassword">
                                                                    <i class="mb mb-eye-close text-muted fs-1"></i>
                                                                </span>
                                                            </div>
                                                            <div class="d-flex align-items-center mb-3"
                                                                data-kt-password-meter-control="highlight">
                                                                <div
                                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                </div>
                                                                <div
                                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                </div>
                                                                <div
                                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                                                </div>
                                                                <div
                                                                    class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                                                </div>
                                                            </div>
                                                            <div class="form-text"><span
                                                                    class="text-danger fw-bold">Note:
                                                                    &nbsp;</span>Password must be at least 8 character
                                                                and contain number,symbol, a-z, A-Z.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="section">
                                                    <hr>
                                                    <h3 class="text-center">Or</h3>
                                                    <p class="text-center">If you have already database and table
                                                        present check this:</p>
                                                    <div class="d-flex mb-8 flex-center text-center">
                                                        <div
                                                            class="form-check form-check-custom form-check-success form-check-solid">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" name="reset_database"
                                                                id="resetDB" />
                                                            <label class="form-check-label text-info" for="resetDB">
                                                                Don't reset database
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end pb-6">
                                                    <button type="submit" class="btn btn-success me-10 btn-submit">
                                                        <span class="indicator-label">
                                                            Submit
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Please wait... <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="step step-3 d-none">
                                            <div class="text-center">
                                                <i class="text-success bi bi-check-circle-fill fs-2"></i><span
                                                    class="mb-10 ms-3">Congratulation! You have successfully installed
                                                    <strong>{{ config('app.name') }}</strong></span>
                                                <br>
                                                <i class="bi bi-display fs-6x "></i>
                                                <br>
                                                <a href="{{ route('login') }}" class="btn btn-primary mt-10 mb-10">
                                                    <div>Login to Admin Dashboard</div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="button"
                                        class="btn btn-primary {{ !$all_requirement_success ? 'disabled' : '' }}"
                                        id="BtnNext" data-next="2">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('/') }}/public/js/plugins.bundle.js"></script>
    <script src="{{ url('/') }}/public/js/scripts.bundle.js"></script>
    <!--start::Bvalidation-->
    <script src="{{ url('/') }}/public/js/bvalidator/jquery.bvalidator.js"></script>
    <script src="{{ url('/') }}/public/js/bvalidator/bValidator.Bs3FormPresenter.js"></script>
    <script src="{{ url('/') }}/public/js/bvalidator/bs3form.js"></script>
    <!--end::Bvalidation-->
    <script src="{{ url('/') }}/public/js/custom.js"></script>
    <script>
        $('#BtnNext').click(function(e) {
            e.preventDefault();
            var nextDiv = $(this).data('next');
            if (nextDiv == "2") {
                $(this).addClass('d-none');
                $('.card-footer').addClass('d-none');
            }
            $('.step').addClass('d-none');
            $('.step-' + nextDiv).removeClass('d-none');
            $('.nav-link').addClass('disabled').removeClass('active');
            $('.nav-' + nextDiv).removeClass('disabled').addClass('active');
            $(this).attr('data-next', 'step-3');
        });


        //submit form
        $('#formDbDetails').submit(function(e) {
            e.preventDefault();
            let selector = this;
            let url = $(selector).attr('action');
            let formData = new FormData(selector);
            let method = $(selector).attr('method');
            let button = $(selector).find('.btn-submit')[0];
            $(selector).bValidator();
            if ($(selector).data('bValidator').isValid()) {
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        button.setAttribute("data-kt-indicator", "on");
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Toast.fire({
                                icon: "success",
                                title: response.msg
                            });
                            $(selector).addClass('d-none');
                            $('#formUserDetails').append(
                                `<input type="hidden" name="key" value="${response.key}" />`);
                            $('#formUserDetails').removeClass('d-none');
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: response.msg
                            });
                        }
                    },
                    complete: function() {
                        button.setAttribute("data-kt-indicator", "off");
                    }
                });
            }
        });

        $('#formUserDetails').submit(function(e) {
            e.preventDefault();
            let selector = this;
            let url = $(selector).attr('action');
            let formData = new FormData(selector);
            let method = $(selector).attr('method');
            let button = $(selector).find('.btn-submit')[0];
            $(selector).bValidator();
            if ($(selector).data('bValidator').isValid()) {
                $.ajax({
                    type: method,
                    url: url,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        button.setAttribute("data-kt-indicator", "on");
                    },
                    success: function(response) {
                        if (response.status == true) {
                            Toast.fire({
                                icon: "success",
                                title: response.msg
                            });
                            $(selector).addClass('d-none');
                            var nextDiv = 3
                            $('.step-' + nextDiv).removeClass('d-none');
                            $('.nav-link').addClass('disabled').removeClass('active');
                            $('.nav-' + nextDiv).removeClass('disabled').addClass('active');
                        } else {
                            Toast.fire({
                                icon: "error",
                                title: response.msg
                            });
                        }
                    },
                    complete: function() {
                        button.setAttribute("data-kt-indicator", "off");
                    }
                });
            }
        });

        $('#resetDB').change(function() {
            if ($(this).is(':checked')) {
                $('.section-admin-details').addClass('d-none');
            } else {
                $('.section-admin-details').removeClass('d-none');
            }
        });
    </script>
</body>

</html>
