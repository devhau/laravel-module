<?php

namespace DevHau\Modules\Builder\Setting;

use DevHau\Modules\Livewire\Component;

abstract class SettingComponent extends Component
{
    public $viewInclude = [];
    public $data = [];
    public function getOptionProperty()
    {
        return [];
    }
    public function mount()
    {
        foreach (getValueByKey($this->option, 'fields', []) as $item) {
            $this->{$item['field']} = setting($item['field']);
        }
    }
    public function doSave()
    {
        foreach (getValueByKey($this->option, 'fields', []) as $item) {
            setting($item['field'], null, $this->{$item['field']});
        }
        $this->ShowMessage('Update success!');
    }
    public function viewSetting($content = null,  $params = [])
    {
        $this->viewInclude['content'] = $content;
        return view('devhau-module::setting-component', $params);
    }
    public function render()
    {
        return $this->viewSetting(null, [
            'option' => $this->option
        ]);
    }
}
