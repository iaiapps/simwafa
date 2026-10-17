<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/grades.png') }}">

    <!-- Fonts (Nunito display, Inter body, Geist Mono angka) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|nunito:700,800|geist-mono:400,500"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
</head>

<body>
    <div id="app">
        <!-- sidemenu -->
        @include('layouts.partials.sidemenu')

        <!-- header -->
        @include('layouts.partials.header')

        <!-- content -->
        <main class="app-main">
            <div class="page">
                @include('layouts.partials.title')
                @yield('content')
            </div>
        </main>

    </div>
</body>

<!-- script -->
<script src="{{ asset('assets/jquery/jquery-3.6.4.min.js') }}"></script>
@stack('scripts')

</html>
