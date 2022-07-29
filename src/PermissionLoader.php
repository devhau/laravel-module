<?php

namespace DevHau\Modules;

use DevHau\Modules\Providers\AuthServiceProvider;
use DevHau\Modules\Traits\UseModuleIndex;
use Illuminate\Support\Facades\Route;

class PermissionLoader
{
    private const routerExcept = [
        'login',
        'register',
        'ignition.',
        'livewire.',
        AuthServiceProvider::DashboardRoute,
    ];
    public static function SetPermission($name, $router = null)
    {
        $check = false;
        foreach (self::routerExcept as $r) {
            if (str_contains($name, $r)) {
                $check = true;
                break;
            }
        }
        if ($check) return;
        $arrCode = [$name];
        if ($router != null && !str_contains($router->action['controller'], '@') && in_array(UseModuleIndex::class, class_uses_recursive($router->action['controller']))) {
            array_push($arrCode, "{$name}.add");
            array_push($arrCode, "{$name}.edit");
            array_push($arrCode, "{$name}.remove");
        }
        foreach ($arrCode as $code) {
            if (!config('devhau-module.auth.permission', \DevHau\Modules\Models\Permission::class)::where('slug', $code)->exists()) {
                config('devhau-module.auth.permission', \DevHau\Modules\Models\Permission::class)::create([
                    'name' => $code,
                    'slug' => $code,
                    'group' => 'admin'
                ]);
            }
        }
    }
    public static function UpdatePermission()
    {
        $routeCollection = Route::getRoutes();
        config('devhau-module.auth.permission', \DevHau\Modules\Models\Permission::class)::query()->delete();
        foreach ($routeCollection as $value) {
            $name = $value->getName();
            if (!$name) continue;
            self::SetPermission($name, $value);
        }
        $table = ModuleLoader::Table()->getData();
        foreach ($table as $key => $value) {
            self::SetPermission('admin.' . $key);
        }
    }
}
