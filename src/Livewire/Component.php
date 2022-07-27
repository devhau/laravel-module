<?php

namespace DevHau\Modules\Livewire;

use DevHau\Modules\Theme;
use Livewire\Component as ComponentBase;

class Component extends ComponentBase
{
    public $styles;
    public $scripts;
    protected function getListeners()
    {
        return ['refreshData' => 'loadData'];
    }
    public function loadData()
    {
    }
    public function refreshData($option = [])
    {
        $this->dispatchBrowserEvent('refreshData', $option);
    }
    public function ShowMessage($option)
    {
        $this->dispatchBrowserEvent('swal-message', $option);
    }
    public function __construct($id = null)
    {
        parent::__construct($id);
    }
    protected function ensureViewHasValidLivewireLayout($view)
    {
        if ($view == null) return;
        parent::ensureViewHasValidLivewireLayout($view);;
        $view->extends(Theme::Layout());
        $this->styles = $this->preRenderedView->getFactory()->yieldPushContent('styles');
        $this->scripts = $this->preRenderedView->getFactory()->yieldPushContent('scripts');
    }
}
