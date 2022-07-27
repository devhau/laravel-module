<?php

namespace DevHau\Modules\Http\Livewire\Admin\User;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;

class Permission extends ModalComponent
{
    public $userId;
    public $user_name;
    public $role;
    public $permission;
    public function mount($userId)
    {
        $this->userId = $userId;
        $user = app(config('devhau-module.auth.user'))->with('roles', 'permissions')->find($this->userId);
        $this->user_name = $user->email;
        $this->role = $user->roles->pluck('id', 'id');
        $this->permission = $user->permissions->pluck('id', 'id');
        $this->sizeModal = ModalSize::ExtraLarge;
        $this->setTitle('Phân quyền cho:' . $this->user_name);
    }
    public function doSave()
    {
        $user = app(config('devhau-module.auth.user'))->find($this->userId);
        $user->permissions()->sync(collect($this->permission)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $user->roles()->sync(collect($this->role)->filter(function ($item) {
            return $item > 0;
        })->toArray());
        $this->hideModal();
        $this->ShowMessage("Update successfull!");
    }
    public function render()
    {
        return $this->viewModal('devhau-module::admin.user.permission', null, null, [
            'roleAll' => app(config('devhau-module.auth.role'))->orderby('name')->get(),
            'permissionAll' => app(config('devhau-module.auth.permission'))->orderby('name')->get(),
        ]);
    }
}
