<?php

namespace DevHau\Modules\Http\Livewire\Auth;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;

class Register extends ModalComponent
{
    public function mount(\Illuminate\Http\Request $request)
    {
        $this->isPage = $request->isMethod('get');
        if (!$this->isPage) {
            $this->sizeModal =  ModalSize::Default;
        }
        $this->setTitle('Register System');
    }
    public function render()
    {
        return $this->viewModal('devhau-module::auth.register');
    }
}
