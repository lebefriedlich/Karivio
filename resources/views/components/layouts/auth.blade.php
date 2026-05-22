<!DOCTYPE html>
<html lang="en" data-mode="dark" data-topbar-color="dark" data-menu-color="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Karivio - Authentication" name="description">
    <meta content="Karivio" name="author">
    <title>Karivio - {{ $title ?? 'Auth' }}</title>

    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/auth.css') }}" rel="stylesheet" type="text/css">

    <script>
        // Force full dark mode session storage setting
        const forceConfig = {
            direction: "ltr",
            theme: "dark",
            layout: { width: "default", position: "fixed" },
            topbar: { color: "dark" },
            menu: { color: "dark" },
            sidenav: { view: "default" }
        };
        sessionStorage.setItem("__ATTEX_CONFIG__", JSON.stringify(forceConfig));
        document.documentElement.setAttribute("data-mode", "dark");
        document.documentElement.setAttribute("data-topbar-color", "dark");
        document.documentElement.setAttribute("data-menu-color", "dark");
    </script>
    <script src="{{ asset('assets/js/config.min.js') }}"></script>
    @livewireStyles
</head>

<body class="relative flex flex-col">
    {{ $slot }}

    @livewireScripts
    <!-- Plugin Js -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/lucide/umd/lucide.min.js') }}"></script>
    <script src="{{ asset('assets/libs/@frostui/tailwindcss/frostui.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
