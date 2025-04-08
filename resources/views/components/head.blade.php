<head>
    @if ($sitesettings != null)
        <link rel="icon" href="{{ url('/') }}/{{ $sitesettings->favicon }}" />
        <link rel="shortcut" href="{{ url('/') }}/{{ $sitesettings->favicon }}" />
        <title>{{ $sitesettings->title }}</title>
    @else
        <link rel="icon" href="{{ url('/') }}/public/images/favicon-16x16.png" />
        <link rel="shortcut" href="{{ url('/') }}/public/images/favicon-32x32.png" />
        <title>{{ config('app.name', 'Laravel') }}</title>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ url('/') }}/public/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/stylesheet.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/intlTelInput.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/public/css/flag-icons.min.css" rel="stylesheet" type="text/css">
    <link href="{{ url('/') }}/public/css/style.css" rel="stylesheet" type="text/css" />
    <script>
        const base_url = "{{ url('/') }}";
        const lang = "{{ $user->language }}"
    </script>
    <style>
        body {
            background-image: url('{{ asset('public/images/bg6.jpg') }}');
        }

        [data-bs-theme="dark"] body {
            background-image: url('{{ asset('public/images/bg6-dark.jpg') }}');
        }
    </style>
    @stack('css')
</head>
