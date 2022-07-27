<?php

namespace DevHau\Modules\Components;

use Illuminate\View\Component;

class ContentComponent extends Component
{
    public function render()
    {
        return view('devhau-module::content');
    }
}
