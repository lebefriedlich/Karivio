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
    @livewireStyles
</head>

<body>
    {{ $slot }}

    @livewireScripts
</body>

</html>
