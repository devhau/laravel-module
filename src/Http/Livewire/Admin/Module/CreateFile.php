<?php

namespace DevHau\Modules\Http\Livewire\Admin\Module;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;
use Illuminate\Support\Facades\Artisan;

class CreateFile extends ModalComponent
{
    public $module_name = '';
    public $file_name = '';
    public $file_type = 'command';
    public $array_type = [
        "command",
        'livewire',
        "component",
        "component-view",
        "migration",
        "middleware",
        "model",
        "controller",
        "seed",
        "event",
        "factory",
        "job",
        "listener",
        "mail",
        "notification",
        "policy",
        "provider",
        "request",
        "resource",
        "provider",
        "rule"
    ];
    public function mount($module)
    {
        $this->module_name = $module;
        $this->sizeModal = ModalSize::Default;
        $this->setTitle('Tạo File trên Module:' . $module);
    }
    public function DoCreate()
    {
        if (!$this->file_name) {
            $this->ShowMessage('Bạn chưa nhập tên file');
            return;
        }
        Artisan::call('module:make-' . $this->file_type . ' ' . $this->file_name . ' ' . $this->module_name);
        $this->refreshData(['module' => 'module']);
        $this->hideModal();
        $this->ShowMessage('Tạo file thành công');
    }
    public function render()
    {
        return $this->viewModal('devhau-module::admin.module.create-file');
    }
}
