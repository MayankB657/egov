<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ url('/') }}/public/images/favicon-32x32.png" />
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
    }

    [data-bs-theme="dark"] body {
        background-image: url('{{ asset('public/images/bg6-dark.jpg') }}');
    }
</style>

<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root">
        @include('alert')
        @yield('content')
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
        $(document).ready(function() {
            var options = {
                useTheme: 'bs3form'
            };
            $('#FormId').bValidator(options);
        });
    </script>
    @stack('js')
</body>

</html>
