<?php

namespace DevHau\Modules\Providers;

use DevHau\Modules\Builder\Menu\MenuBuilder;
use DevHau\Modules\Builder\Modal\ModalBuilder;
use DevHau\Modules\Components\ContentComponent;
use DevHau\Modules\Components\HeaderSEOComponent;
use DevHau\Modules\Components\ScriptComponent;
use DevHau\Modules\Components\StyleComponent;
use DevHau\Modules\Directives\CoreBladeDirectives;
use DevHau\Modules\Livewire\ComponentLoader;
use DevHau\Modules\ModuleLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->app->alias('Theme', 'DevHau\Modules\Theme');
        $router->aliasMiddleware('theme.admin', \DevHau\Modules\Http\Middleware\Admin::class);
        $router->aliasMiddleware('theme.home', \DevHau\Modules\Http\Middleware\Home::class);
        $router->aliasMiddleware('theme.none', \DevHau\Modules\Http\Middleware\None::class);
        $router->aliasMiddleware('theme.set', \DevHau\Modules\Http\Middleware\SetTheme::class);
        $router->aliasMiddleware('role',  \DevHau\Modules\Http\Middleware\Role::class);
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'devhau-module');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'devhau-module');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../config/config.php' => config_path('devhau-module.php'),
                __DIR__ . '/../../config/module.php' => config_path('devhau-module.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../../resources/views' => resource_path('views/vendor/devhau-module'),
            ], 'views');

            // Publishing assets.
            $this->publishes([
                __DIR__ . '/../../resources/assets' => public_path('vendor/devhau-module'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__ . '/../../resources/lang' => base_path('lang/vendor/devhau-module'),
            ], 'lang');

            // Registering package commands.
            // $this->commands([]);

        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!$this->app->runningInConsole()) {
            ComponentLoader::Register(__DIR__ . '/..', 'DevHau\\Modules', 'devhau-module');
            $this->app->register(ScheduleServiceProvider::class);
            $this->app->register(SeedServiceProvider::class);
            $this->app->register(AuthServiceProvider::class);
            Blade::component('devhau-module-script', ScriptComponent::class);
            Blade::component('devhau-module-style', StyleComponent::class);
            Blade::component('core-content', ContentComponent::class);
            Blade::component('header-seo', HeaderSEOComponent::class);
            Blade::directive('livewireModal', [CoreBladeDirectives::class, 'livewireModal']);
            Blade::directive('menuRender', [CoreBladeDirectives::class, 'menuRender']);
            Livewire::component('devhau-module::modal-builder', ModalBuilder::class);
            MenuBuilder::Menu()->AddItem(function ($item) {
                $item->setSort(-9999999);
                $item->setName('Dashboard');
                $item->setIcon('bi bi-box2-fill');
                $item->setRouter('admin.dashboard', []);
            })->AddItem(function ($item) {
                $item->setName('Danh mục');
                $item->setIcon('bi bi-box2-fill');
                foreach (ModuleLoader::Table()->getData() as $key => $module) {
                    if (!getValueByKey($module, 'DisableModule', false)) {
                        $item->AddItem(function ($item) use ($module, $key) {
                            $item->setName($module['title']);
                            $item->setIcon('bi bi-box2-fill');
                            $item->setRouter('admin.table', ["module" => $key]);
                        });
                    }
                }
            })->AddItem(function ($item) {
                $item->setSort(9999999);
                $item->setName('Tài khoản');
                $item->setIcon('bi bi-people-fill');
                $item->AddItem(function ($item) {
                    $item->setName('Tài khoản');
                    $item->setIcon('bi bi-person-bounding-box');
                    $item->setRouter('admin.user', []);
                })->AddItem(function ($item) {
                    $item->setName('Vai trò');
                    $item->setIcon('bi bi-person-check');
                    $item->setRouter('admin.role', []);
                })->AddItem(function ($item) {
                    $item->setName('Quyền hệ thống');
                    $item->setIcon('bi bi-lightning-charge');
                    $item->setRouter('admin.permission', []);
                });
            })->AddItem(function ($item) {
                $item->setSort(9999999);
                $item->setName('Hệ thống');
                $item->setIcon('bi bi-laptop');
                $item->AddItem(function ($item) {
                    $item->setName('Module');
                    $item->setIcon('bi bi-collection');
                    $item->setRouter('admin.module', []);
                })->AddItem(function ($item) {
                    $item->setName('Schedule');
                    $item->setIcon('bi bi-calendar2-week');
                    $item->setRouter('admin.schedule', []);
                })->AddItem(function ($item) {
                    $item->setName('Thiết lập');
                    $item->setIcon('bi bi-gear-fill');
                    $item->setRouter('admin.setting', []);
                });
            });
            // Automatically apply the package configuration
            $this->mergeConfigFrom(__DIR__ . '/../../config/menu.php', 'devhau-menu');
            ModuleLoader::Table()->loadFromFile(__DIR__ . '/../../config/table.php');
        } else {
            include_once(__DIR__ . '/../../database/seeders/AuthTableSeeder.php');
        }
        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'devhau-module');
        //fix auth user
        config(['auth.providers.users.model' =>  config('devhau-module.auth.user')]);
    }
}
