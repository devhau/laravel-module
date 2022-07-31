<?php

use DevHau\Modules\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('router_config')) {
    function router_config($router, $arr = null)
    {
        if (is_array($arr)) {
            return [...config("devhau-module.router.{$router}", []), ...$arr];
        }
        return config("devhau-module.router.{$router}", []);
    }
}
if (!function_exists('router_admin')) {
    function router_admin($arr = null)
    {
        return router_config('admin', $arr);
    }
}

if (!function_exists('router_home')) {
    function router_home($arr = null)
    {
        return router_config('home', $arr);
    }
}
if (!function_exists('getValueByKey')) {
    function getValueByKey($data, $key, $default = '')
    {
        if ($data && $key) {
            $arrkey = explode('.', $key);
            $dataTemp = $data;
            foreach ($arrkey as $keyItem) {
                if (isset($dataTemp[$keyItem])) {
                    $dataTemp = $dataTemp[$keyItem];
                } else {
                    return $default;
                }
            }
            return $dataTemp;
        }
        return $default;
    }
}

if (!function_exists('setting')) {
    /**
     * Get Value: setting("seo_key")
     * Get Value Or Default: setting("seo_key","value_default")
     * Set Value: setting("seo_key",null,"value_new") || setting("seo_key",null,"value_new",true) || setting("seo_key",null,"value_new",false)
     * Remove Setting By Key: setting("seo_key",null,null,-1)
     */
    function setting($key, $default = null,  $value = -999999999, $locked = null)
    {
        if ($value == -999999999 && $locked == null && Cache::has($key) && Cache::get($key) != '') return Cache::get($key);

        $setting = Setting::where('key', $key)->first();
        if ($value !== -999999999) {
            $setting = $setting ?? new Setting(['key' => $key]);
            $setting->value = $value;
            $setting->locked = $locked === true;
            $setting->save();
            Cache::forget($key);
        }
        if ($setting == null) {
            if ($locked === -1) {
                Cache::forget($key);
            }
            return $default;
        }
        if ($value === -999999999 && $locked === -1) {
            Cache::forget($key);
            $setting->delete();
            return null;
        }
        //Set Cache Forever
        Cache::forever($key, $setting->value);
        return $setting->value ?? $default;
    }
}
if (!function_exists('CronNextRunDate')) {
    function CronNextRunDate($expression)
    {
        try {
            return (new Carbon\Carbon(((new Cron\CronExpression($expression))->getNextRunDate())))->format('Y-m-d H:i:s');
        } catch (\Exception) {
            return $expression . ' is error';
        }
    }
}
if (!function_exists('loadFileReturn')) {
    function loadFileReturn($path)
    {
        return include_once($path);
    }
}
if (!function_exists('getAllAttributeByModel')) {
    function getAllAttributeByModel($model)
    {
        return  $model->getFillable();
        // $columns = $model->getFillable();
        // Another option is to get all columns for the table like so:
        // $columns = \Schema::getColumnListing($this->table);
        // but it's safer to just get the fillable fields

        /* $attributes = $model->getAttributes();

        foreach ($columns as $column) {
            if (!array_key_exists($column, $attributes)) {
                $attributes[$column] = null;
            }
        }
        return $attributes;*/
    }
}
if (!function_exists('module_path')) {
    function module_path($name, $path = '')
    {
        $module = app('modules')->find($name);

        return $module->getPath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('module_by')) {
    function module_by($name)
    {
        return app('modules')->find($name);
    }
}
if (!function_exists('module_all')) {
    function module_all()
    {
        return app('modules')->all();
    }
}
