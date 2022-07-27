<?php

namespace DevHau\Modules\Http\Livewire\Admin\Permission;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\PermissionLoader;
use DevHau\Modules\Traits\UseModuleIndex;

class Index extends ModalComponent
{
    use UseModuleIndex;
    public function updatePermission()
    {
        PermissionLoader::UpdatePermission();
        $this->ShowMessage('Update permission successful');
    }
    public function mount()
    {
        $this->isCheckDisableModule = false;
        return $this->LoadModule('permission');
    }
}
