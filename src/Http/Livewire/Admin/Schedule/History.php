<?php

namespace DevHau\Modules\Http\Livewire\Admin\Schedule;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Models\ScheduleHistory;
use DevHau\Modules\Traits\UseModuleIndex;

class History extends ModalComponent
{
    use UseModuleIndex;
    public function mount()
    {
        $this->isCheckDisableModule = false;
        return $this->LoadModule('schedule_history');
    }
    public function clearData()
    {
        ScheduleHistory::query()->delete();
    }
}
