<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('plugins/submodaljs/src/bs.sm.js') }}" defer></script>
    @stack('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="http://reservas.operadoralasmananitas.com.mx">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/submodaljs/src/bs.sm.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div id="app">
        @include('layouts.partials.main-navbar')

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
