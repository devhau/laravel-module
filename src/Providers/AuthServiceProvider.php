<?php

namespace DevHau\Modules\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public const RoleAdmin = "admin";
    public const DashboardRoute = 'admin.dashboard';
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            config('devhau-module.auth.permission', \DevHau\Modules\Models\Permission::class)::get()->map(function ($permission) {
                Gate::define($permission->slug, function ($user = null) use ($permission) {
                    if (!$user) $user = auth();
                    return $user->hasPermissionTo($permission) || $user->isSuperAdmin();
                });
            });
            Gate::define(AuthServiceProvider::DashboardRoute, function ($user) {
                return true;
            });

            //Blade directives
            Blade::directive('role', function ($role) {
                return "if(auth()->check() &&(auth()->user()->hasRole(\DevHau\Modules\Providers\AuthServiceProvider::RoleAdmin) || auth()->user()->hasRole('{$role}'))) :"; //return this if statement inside php tag
            });

            Blade::directive('endrole', function ($role) {
                return "endif;"; //return this endif statement inside php tag
            });
        }
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
