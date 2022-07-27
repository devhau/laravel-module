<?php

namespace DevHau\Modules\Http\Livewire\Admin\User;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleIndex;

class Index extends ModalComponent
{
    use UseModuleIndex;

    public function mount()
    {
        $this->isCheckDisableModule = false;
        return $this->LoadModule('user');
    }
}
