<?php

namespace DevHau\Modules\Http\Middleware;

use Closure;
use DevHau\Modules\Theme;
use Illuminate\Http\Request;

class None
{
    public function handle(Request $request, Closure $next)
    {
        Theme::SetTheme('none', 'devhau-module::layout.none');
        return $next($request);
    }
}
