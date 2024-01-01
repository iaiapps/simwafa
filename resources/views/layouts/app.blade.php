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

    <!-- Fonts -->
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('css')
</head>

<body>
    <div id="app">
        <!-- header -->
        @include('layouts.partials.header')

        <!-- sidemenu -->
        @include('layouts.partials.sidemenu')

        <!-- content -->
        <main id="page" class="page-margin px-3 pb-5">
            @include('layouts.partials.title')
            @yield('content')

            <!-- footer -->
            {{-- @include('layouts.partials.footer') --}}
        </main>

    </div>
</body>

<!-- script -->
<script src="{{ asset('assets/jquery/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
@stack('scripts')

</html>
