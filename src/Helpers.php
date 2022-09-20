<?php

use Illuminate\Support\Facades\Cache;


if (!function_exists('get_module_path')) {
    function get_module_path($name, $path = '')
    {
        $module = app('modules')->find($name);

        return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('get_module_by')) {
    function get_module_by($name)
    {
        return app('modules')->find($name);
    }
}
if (!function_exists('get_module_all')) {
    function get_module_all()
    {
        return app('modules')->all();
    }
}
