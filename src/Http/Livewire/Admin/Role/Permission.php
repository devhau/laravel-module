<?php

namespace DevHau\Modules\Http\Livewire\Admin\Role;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;

class Permission extends ModalComponent
{
    public $roleId;
    public $role_name;
    public $permission;
    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $role = app(config('devhau-module.auth.role'))->with('permissions')->find($this->roleId);
        $this->role_name = $role->name;
        $this->permission = $role->permissions->pluck('id', 'id');
        $this->sizeModal = ModalSize::ExtraLarge;
        $this->setTitle('Phân quyền cho:' . $this->role_name);
    }
    public function doSave()
    {
        $role = app(config('devhau-module.auth.role'))->find($this->roleId);
        $role->permissions()->sync(collect($this->permission)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $this->hideModal();
        $this->ShowMessage("Update successfull!");
    }
    public function render()
    {
        return $this->viewModal('devhau-module::admin.role.permission', null, null, [
            'permissionAll' => app(config('devhau-module.auth.permission'))->orderby('name')->get(),
        ]);
    }
}
