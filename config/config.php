<?php

/*
 * You can place your custom package configuration in here.
 */

use DevHau\Modules\FileActivator;

return [
    'auth' => [
        'user' => \DevHau\Modules\Models\User::class,
        'role' => \DevHau\Modules\Models\Role::class,
        'permission' => \DevHau\Modules\Models\Permission::class
    ],
    'router' => [
        'admin' => [
            'page' => DevHau\Modules\Http\Livewire\Admin\Dashboard\Index::class,
            'prefix' => 'admincp',
            'middleware' => ['web', 'theme.admin']
        ],
        'home' => [
            'page' => DevHau\Modules\Http\Livewire\Home\Index::class,
            'prefix' => '/',
            'middleware' => ['web', 'theme.home']
        ]
    ],
    'livewire' => [
        'namespace' => 'Http\\Livewire'
    ],

    /*
    |--------------------------------------------------------------------------
    | Caching
    |--------------------------------------------------------------------------
    |
    | Here is the config for setting up caching feature.
    |
    */
    'cache' => [
        'enabled' => false,
        'key' => 'laravel-modules',
        'lifetime' => 60,
    ],
    /*
    |--------------------------------------------------------------------------
    | Choose what laravel-modules will register as custom namespaces.
    | Setting one to false will require you to register that part
    | in your own Service Provider class.
    |--------------------------------------------------------------------------
    */
    'register' => [
        'translations' => true,
        /**
         * load files on boot or register method
         *
         * Note: boot not compatible with asgardcms
         *
         * @example boot|register
         */
        'files' => 'register',
    ],

    /*
    |--------------------------------------------------------------------------
    | Activators
    |--------------------------------------------------------------------------
    |
    | You can define new types of activators here, file, database etc. The only
    | required parameter is 'class'.
    | The file activator will store the activation status in storage/installed_modules
    */
    'activators' => [
        'file' => [
            'class' => FileActivator::class,
            'statuses-file' => base_path('modules_statuses.json'),
            'cache-key' => 'activator.installed',
            'cache-lifetime' => 604800,
        ],
    ],

    'activator' => 'file',
];
