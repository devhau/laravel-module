<?php

namespace DevHau\Modules\Http\Livewire\Admin\Schedule;

use Illuminate\Support\Collection;
use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Schedule\CommandService;
use DevHau\Modules\Traits\UseModuleEdit;

class Edit extends ModalComponent
{
    use UseModuleEdit;
    public Collection $commands;
    public $commandChoose;
    public function updatedCommand($value)
    {
        $this->commandChoose = $this->commands[$value];
        $this->params = [];
        $this->options = [];
        foreach ($this->commandChoose['arguments'] as $arguments) {
            $this->params[] = ['key' => $arguments['name']];
        }
    }
    public function mount($module, $dataId = null)
    {
        $this->LoadModule($module, $dataId);
        $this->commands = CommandService::get();
        $this->command = $this->commands->first()['name'];
        $this->updatedCommand($this->command);
    }
    public function beforeBinding()
    {
        $this->CheckNullAndEmptySetValue([
            'sendmail_success',
            'run_in_background',
            'even_in_maintenance_mode',
            'status',
            'on_one_server',
            'without_overlapping',
            'sendmail_error'
        ], 0);
    }
}
