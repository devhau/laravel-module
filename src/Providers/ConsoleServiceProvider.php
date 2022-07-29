<?php

namespace DevHau\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use DevHau\Modules\Commands;

class ConsoleServiceProvider extends ServiceProvider
{

    /**
     * The available commands
     * @var array
     */
    protected $commands = [
        Commands\ClearAllCache::class,
        Commands\ModuleMakeCommand::class

    ];
    public function register(): void
    {
        $this->commands(config('devhau-module.commands', $this->commands));
    }

    public function provides(): array
    {
        return $this->commands;
    }
}
