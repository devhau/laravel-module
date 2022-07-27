<?php

namespace DevHau\Modules\Schedule;

use App\Console\Kernel;
use Illuminate\Support\Collection;

class CommandService
{
    const commands_exclude = [ //regex
        'help',
        'list',
        'test',
        'down',
        'up',
        'env',
        'serve',
        'tinker',
        'clear-compiled',
        'key:generate',
        'package:discover',
        'storage:link',
        'notifications:table',
        'session:table',
        'stub:publish',
        'vendor:publish',
        'route:*',
        'event:*',
        'migrate:*',
        'cache:*',
        'auth:*',
        'config:*',
        'db:*',
        'optimize*',
        'make:*',
        'queue:*',
        'schedule:*',
        'view:*',
        'phpunit:*',
        'permission*',
        '_complete',
        'model*',
        'database',
        'schema*',
        'completion*',
        'module:*'
    ];
    public static function get(): Collection
    {
        $commands = collect(app(Kernel::class)->all())->sortKeys();
        $commandsKeys = $commands->keys()->toArray();
        foreach (self::commands_exclude as $exclude) {
            $commandsKeys = preg_grep("/^$exclude/", $commandsKeys, PREG_GREP_INVERT);
        }
        return $commands->only($commandsKeys)
            ->map(function ($command) {
                return [
                    'name' => $command->getName(),
                    'description' => $command->getDescription(),
                    'signature' => $command->getSynopsis(),
                    'arguments' => $this->getArguments($command),
                    'options' => $this->getOptions($command),
                ];
            });
    }

    private static function getArguments($command)
    {
        $arguments = [];
        foreach ($command->getDefinition()->getArguments() as $argument) {
            $arguments[] = [
                'name' => $argument->getName(),
                'default' => $argument->getDefault(),
                'required' => $argument->isRequired()
            ];
        }

        return $arguments;
    }

    private static function getOptions($command)
    {
        $options = [
            'withValue' => [],
            'withoutValue' => []
        ];
        foreach ($command->getDefinition()->getOptions() as $option) {
            if ($option->acceptValue()) {
                $options['withValue'][] = [
                    'name' => $option->getName(),
                    'default' => $option->getDefault(),
                    'required' => $option->isValueRequired()
                ];
            } else {
                $options['withoutValue'][] = $option->getName();
            }
        }

        return $options;
    }
}
