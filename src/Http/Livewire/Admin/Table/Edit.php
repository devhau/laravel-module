<?php

namespace DevHau\Modules\Http\Livewire\Admin\Table;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleEdit;

class Edit extends ModalComponent
{
    use UseModuleEdit;
    public function mount($module, $dataId = null)
    {
        return $this->LoadModule($module, $dataId);
    }
}
