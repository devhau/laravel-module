<?php

namespace DevHau\Modules\Schedule;

use Illuminate\Console\Scheduling\Schedule as ScheduleBase;
use DevHau\Modules\Models\Schedule as ScheduleModel;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Container\Container;

class Scheduling
{
    /**
     * @var BaseSchedule
     */
    private $schedule;

    private $tasks;
    private $container;

    public function __construct(Container $container, ScheduleService $scheduleService, ScheduleBase $schedule)
    {
        $this->tasks = $scheduleService->getActives();
        $this->schedule = $schedule;
        $this->container = $container;
    }

    public function execute()
    {
        foreach ($this->tasks as $task) {
            $this->dispatch($task);
        }
    }
    public static function RunTask($task)
    {
        app(self::class)->dispatch($task, false);
    }
    /**
     * @throws \Exception
     */
    private function dispatch($task, $isCron = true)
    {
        if ($task instanceof ScheduleModel) {
            // @var Event $event
            if ($task->command === 'custom') {
                $command = $task->command_custom;
                $event = $this->schedule->exec($command);
            } else {
                $command = $task->command;
                $event = $this->schedule->command(
                    $command,
                    $task->getArguments() + $task->getOptions()
                );
            }
            if ($isCron)
                $event->cron($task->expression);
            //ensure output is being captured to write history
            $event->storeOutput();

            if ($task->environments) {
                $event->environments(explode(',', $task->environments));
            }

            if ($task->even_in_maintenance_mode) {
                $event->evenInMaintenanceMode();
            }

            if ($task->without_overlapping) {
                $event->withoutOverlapping();
            }

            if ($task->run_in_background) {
                $event->runInBackground();
            }

            if (!empty($task->webhook_before)) {
                $event->pingBefore($task->webhook_before);
            }

            if (!empty($task->webhook_after)) {
                $event->thenPing($task->webhook_after);
            }

            if (!empty($task->email_output)) {
                if ($task->sendmail_success) {
                    $event->emailOutputTo($task->email_output);
                }

                if ($task->sendmail_error) {
                    $event->emailOutputOnFailure($task->email_output);
                }
            }

            if (!empty($task->on_one_server)) {
                $event->onOneServer();
            }

            $event->onSuccess(
                function () use ($task, $event, $command) {
                    $this->createLogFile($task, $event);
                    if ($task->log_success) {
                        $this->createHistoryEntry($task, $event, $command);
                    }
                }
            );

            $event->onFailure(
                function () use ($task, $event, $command) {
                    $this->createLogFile($task, $event, 'critical');
                    if ($task->log_error) {
                        $this->createHistoryEntry($task, $event, $command);
                    }
                }
            );

            $event->after(function () use ($event) {
                unlink($event->output);
            });
            if (!$isCron) {
                $event->run($this->container);
            }
            unset($event);
        } else {
            throw new \Exception('Task with invalid instance type');
        }
    }

    private function createLogFile($task, $event, $type = 'info')
    {
        if ($task->log_filename) {
            $logChannel = Log::build([
                'driver' => 'single',
                'path' => storage_path('logs/' . $task->log_filename . '.log'),
            ]);
            Log::stack([$logChannel])->$type(file_get_contents($event->output));
        }
    }

    private function createHistoryEntry($task, $event, $command)
    {
        $task->histories()->create(
            [
                'command' => $command,
                'params' => $task->getArguments(),
                'options' => $task->getOptions(),
                'output' => file_get_contents($event->output)
            ]
        );
    }
}
