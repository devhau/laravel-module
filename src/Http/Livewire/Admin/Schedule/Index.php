<?php

namespace DevHau\Modules\Http\Livewire\Admin\Schedule;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Models\Schedule;
use DevHau\Modules\Traits\UseModuleIndex;
use DevHau\Modules\Schedule\Scheduling;
use Illuminate\Support\Facades\Log;

class Index extends ModalComponent
{
    use UseModuleIndex;
    public function mount()
    {
        $this->isCheckDisableModule = false;
        return $this->LoadModule('schedule');
    }
    public function RunNow(Schedule $schedule)
    {
        $params = [];
        $options = [];
        if ($schedule->params && is_array($schedule->params)) {
            foreach ($schedule->params as $param) {
                $params[$param['key']] = $param['value'];
            }
        }
        if ($schedule->options && is_array($schedule->options)) {
            foreach ($schedule->options as $param) {
                $options[] = [$param['key'] => $param['value']];
            }
        }
        ob_start();
        Scheduling::RunTask($schedule);
        $log = ob_get_clean();
        $log = substr($log, 0, 200);
        $this->ShowMessage("Đã chạy Thành công:\n" . ($log));
    }
}
