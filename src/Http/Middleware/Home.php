<?php

namespace DevHau\Modules\Http\Middleware;

use Closure;
use DevHau\Modules\Theme;
use Illuminate\Http\Request;

class Home
{
    public function handle(Request $request, Closure $next)
    {
        Theme::SetTheme(setting('theme_site','home'), 'devhau-module::layout.home');
        return $next($request);
    }
}
