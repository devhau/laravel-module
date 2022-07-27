<?php

namespace DevHau\Modules\Http\Middleware;

use Closure;
use DevHau\Modules\Theme;
use Illuminate\Http\Request;

class SetTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $theme)
    {
        Theme::SetTheme($theme);
        return $next($request);
    }
}
