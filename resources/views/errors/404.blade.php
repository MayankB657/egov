<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{{ url('/') }}/public/images/favicon-16x16.png" />
    <link rel="shortcut" href="{{ url('/') }}/public/images/favicon-32x32.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ url('/') }}/public/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>
<style>
    body {
        background-image: url('{{ asset('public/images/bg1-dark.jpg') }}');
    }

    [data-bs-theme="dark"] body {
        background-image: url('{{ asset('public/images/bg1-dark.jpg') }}');
    }
</style>

<body id="kt_body" class="auth-bg bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <div class="d-flex flex-column flex-center text-center p-10">
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">We can't find that page.</div>
                        <div class="mb-3">
                            <img src="{{ url('/') }}/public/images/dribbble_1.gif" class="mw-100 mh-300px"/>
                        </div>
                        <div class="mb-0">
                            <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-primary">Return Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('/') }}/public/js/plugins.bundle.js"></script>
    <script src="{{ url('/') }}/public/js/scripts.bundle.js"></script>
    <script src="{{ url('/') }}/public/js/custom.js"></script>
</body>

</html>
