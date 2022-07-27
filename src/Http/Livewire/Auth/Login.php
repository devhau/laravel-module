<?php

namespace DevHau\Modules\Http\Livewire\Auth;

use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Builder\Modal\ModalSize;
use DevHau\Modules\Theme;
use Illuminate\Support\Facades\Auth;

class Login extends ModalComponent
{
    public function mount(\Illuminate\Http\Request $request)
    {
        $this->isPage = $request->isMethod('get');
        if (!$this->isPage) {
            $this->sizeModal =  ModalSize::Default;
        }
        $this->setTitle('Login System');
    }
    public function render()
    {
        return $this->viewModal('devhau-module::auth.login');
    }
    public $password;
    public $email;
    public $isRememberMe;

    protected $rules = [
        'password' => 'required|min:6',
        'email' => 'required|email',
    ];

    public function submit()
    {
        $this->validate();
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->isRememberMe)) {
            return redirect('/');
        } else {
            $this->ShowMessage("Login Fail");
        }
    }
}
