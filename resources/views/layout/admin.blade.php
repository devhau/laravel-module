<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-header-seo />
    @livewireStyles
    <x-devhau-module-style />
    @yield('style')
    @stack('styles')
    @stack('header_scripts')
</head>

<body class="{{\DevHau\Modules\Theme::getBodyClass()}}">
    <div class="wrapper">
        <aside class="main-sidebar">
            @foreach(\DevHau\Modules\Theme::getTheme('.sidebar.before',[]) as $path)
            @includeif($path)
            @endforeach
            @menuRender(key(sidebar),position(sidebar),class(menu-action))
            @foreach(\DevHau\Modules\Theme::getTheme('.sidebar.after',[]) as $path)
            @includeif($path)
            @endforeach
        </aside>
        <div class="main-wrapper">
            <nav class="main-header navbar navbar-expand-lg bg-light">
                <a class="sidebar-mini-btn"><i class="bi bi-grid-3x3-gap-fill"></i></a>
                <div class="header-left">
                    @menuRender(key(top),position(top),class(menu-action),active(false))
                    @foreach(\DevHau\Modules\Theme::getTheme('.header.left',[]) as $path)
                    @includeif($path)
                    @endforeach
                </div>
                <div class="header-center">
                    @foreach(\DevHau\Modules\Theme::getTheme('.header.center',[]) as $path)
                    @includeif($path)
                    @endforeach
                </div>
                <div class="header-right">
                    @foreach(\DevHau\Modules\Theme::getTheme('.header.right',[]) as $path)
                    @includeif($path)
                    @endforeach
                </div>
            </nav>
            <main class="main-content">
                <x-core-content />
            </main>
            <nav class="main-footer">
            </nav>
        </div>

    </div>

    @livewireScripts
    <x-devhau-module-script />
    @section('script')
    @stack('scripts')
</body>

</html>