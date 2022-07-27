<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <x-header-seo />

    @livewireStyles
    <x-devhau-module-style />
    @yield('style')
    @stack('styles')
    @stack('header_scripts')
</head>

<body class="{{DevHau\Modules\Theme::getBodyClass()}}">
    <x-core-content />
    @livewireScripts
    <x-devhau-module-script />
    @yield('script')
    @stack('scripts')
</body>

</html>