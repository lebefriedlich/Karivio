<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Karivio - Authentication" name="description">
    <meta content="Karivio" name="author">
    <title>Karivio - {{ $title ?? 'Auth' }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/config.js') }}"></script>

    @livewireStyles
</head>

<body>
    {{ $slot }}

    <script src="{{ asset('assets/libs/preline/preline.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    @livewireScripts
</body>

</html>
