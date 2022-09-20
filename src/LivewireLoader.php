<?php

namespace DevHau\Modules;

use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Livewire;
use ReflectionClass;

class LivewireLoader
{
    private static $paths = [];
    public static function Register($path, $namespace, $aliasPrefix = '')
    {
        $namespaceLivewire = config('devhau-module.livewire.namespace', 'Http\\Livewire');
        $LivewireNamespace = $namespace . '\\' . $namespaceLivewire;
        if ($aliasPrefix) {
            $aliasPrefix = strtolower($aliasPrefix) . '::';
        }
        $directory = Str::of($path)
            ->append('/' .  $namespaceLivewire)
            ->replace(['\\'], '/');
        $filesystem = new Filesystem();

        if (!$filesystem->isDirectory($directory)) {
            return false;
        }

        collect($filesystem->allFiles($directory))
            ->map(function (SplFileInfo $file) use ($LivewireNamespace) {
                return (string) Str::of($LivewireNamespace)
                    ->append('\\', $file->getRelativePathname())
                    ->replace(['/', '.php'], ['\\', '']);
            })
            ->filter(function ($class) {
                return is_subclass_of($class, Component::class) && !(new ReflectionClass($class))->isAbstract();
            })
            ->each(function ($class) use ($LivewireNamespace, $aliasPrefix) {
                $alias = $aliasPrefix . Str::of($class)
                    ->after($LivewireNamespace . '\\')
                    ->replace(['/', '\\'], '.')
                    ->explode('.')
                    ->map([Str::class, 'kebab'])
                    ->implode('.');
                // fix class namespace
                $alias_class =  trim(Str::of($class)
                    ->replace(['/', '\\'], '.')
                    ->explode('.')
                    ->map([Str::class, 'kebab'])
                    ->implode('.'), '.');
                if (Str::endsWith($class, ['\Index', '\index'])) {
                    Livewire::component(Str::beforeLast($alias, '.index'), $class);
                    Livewire::component(Str::beforeLast($alias_class, '.index'), $class);
                }
                Livewire::component($alias_class, $class);
                Livewire::component($alias, $class);
            });
    }
}
