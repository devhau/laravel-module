<?php

namespace DevHau\Modules\Http\Livewire\Admin\Table;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleExport;

class Export extends ModalComponent
{
    use UseModuleExport;
    public function mount($module)
    {
        return $this->LoadModule($module);
    }
}
