<?php

namespace DevHau\Modules\Components;

use Illuminate\View\Component;

class ScriptComponent extends Component
{
    public $distPathCore = __DIR__ . '/../../dist/';
    public function render()
    {
        return view('devhau-module::script');
    }
}
