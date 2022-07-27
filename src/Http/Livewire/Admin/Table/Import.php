<?php

namespace DevHau\Modules\Http\Livewire\Admin\Table;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleImport;

class Import extends ModalComponent
{
    use UseModuleImport;
    public function mount($module)
    {
        return $this->LoadModule($module);
    }
}
