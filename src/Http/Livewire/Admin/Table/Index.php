<?php

namespace DevHau\Modules\Http\Livewire\Admin\Table;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleIndex;

class Index extends ModalComponent
{
    use UseModuleIndex;

    public function mount($module)
    {
        return $this->LoadModule($module);
    }
}
