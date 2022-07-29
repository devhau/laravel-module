<?php

namespace DevHau\Modules\Http\Livewire\Admin\Module;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;
use Illuminate\Support\Facades\Artisan;

class Create extends ModalComponent
{
    public $module_name = '';
    public function mount()
    {
        $this->sizeModal = ModalSize::Small;
        $this->setTitle('Tạo module');
    }
    public function DoCreate()
    {
        if (module_by($this->module_name)) {
            $this->ShowMessage('Module đã tồn tại rồi');
            return;
        }
        Artisan::call('module:make ' . $this->module_name);

        $this->refreshData(['module' => 'module']);
        $this->hideModal();
        $this->ShowMessage('Tạo module thành công');
    }
    public function render()
    {
        return $this->viewModal('devhau-module::admin.module.create');
    }
}
