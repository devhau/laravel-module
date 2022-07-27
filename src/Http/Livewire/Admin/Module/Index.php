<?php

namespace DevHau\Modules\Http\Livewire\Admin\Module;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use DevHau\Modules\Builder\Modal\ModalComponent;
use DevHau\Modules\Traits\UseModuleIndex;

class Index extends ModalComponent
{
    use UseModuleIndex;
    public function getData()
    {
        return $this->paginate(app('modules')->all());
    }
    public function mount()
    {
        $this->isCheckDisableModule = false;
        return $this->LoadModule('module');
    }
    public function ChangeStatus($module_name)
    {
        $module =  GetModule($module_name);
        if ($module) {
            if ($module->isEnabled()) {
                $module->setActive(false);
            } else {
                $module->setActive(true);
            }
        } else {
            $this->ShowMessage("$module_name is not found module");
        }
    }
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
