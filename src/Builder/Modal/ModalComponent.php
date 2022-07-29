<?php

namespace DevHau\Modules\Builder\Modal;

use DevHau\Modules\Livewire\Component;
use DevHau\Modules\Builder\Modal\Contracts\ModalComponent as Contract;
use DevHau\Modules\Theme;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

abstract class ModalComponent extends Component implements Contract
{
    public $isPage = false;
    public $hideHeader = false;
    public $hideFooter = true;
    public $showModal = true;
    public $viewInclude = [];
    public $modal_title = "";
    public $sizeModal = ModalSize::Large;
    public $code_permission = "";
    public function boot()
    {
        $this->isPage = Request::method() == 'GET';
    }
    public function setTitle($modal_title)
    {
        $this->modal_title = $modal_title;
    }
    public function viewModal($content = null, $footer = null, $header = null, $params = [])
    {
        if (isset($this->code_permission) && $this->code_permission != '') {
            if (!Gate::check($this->code_permission, [auth()]))
                return abort(403);
        }
        $this->viewInclude['content'] = $content;
        $this->viewInclude['footer'] = $footer;
        $this->viewInclude['header'] = $header;
        if ($this->isPage && $content) {
            Theme::setTitle($this->modal_title);
            return view($content, $params);
        }
        return view('devhau-module::modal-component', $params);
    }
    public function hideModal()
    {
        $this->dispatchBrowserEvent('closemodal', ['id' => $this->id]);
    }
}
