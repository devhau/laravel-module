<?php

namespace DevHau\Modules;

use Illuminate\Support\ServiceProvider;
use DevHau\Modules\Providers\BootstrapServiceProvider;
use DevHau\Modules\Providers\ConsoleServiceProvider;

abstract class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Booting the package.
     */
    public function boot()
    {
    }

    /**
     * Register all modules.
     */
    public function register()
    {
    }

    /**
     * Register all modules.
     */
    protected function registerModules()
    {
        $this->app->register(BootstrapServiceProvider::class);
    }

    /**
     * Register package's namespaces.
     */
    protected function registerNamespaces()
    {
        $configPath = __DIR__ . '/../config/config.php';
        $stubsPath = dirname(__DIR__) . '/src/Commands/stubs';

        $this->publishes([
            $configPath => config_path('modules.php'),
        ], 'config');

        $this->publishes([
            $stubsPath => base_path('stubs/devhau-stubs'),
        ], 'stubs');
    }

    /**
     * Register the service provider.
     */
    abstract protected function registerServices();

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Contracts\RepositoryInterface::class, 'modules'];
    }

    /**
     * Register providers.
     */
    protected function registerProviders()
    {
        $this->app->register(ConsoleServiceProvider::class);
    }
}
