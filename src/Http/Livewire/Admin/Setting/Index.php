<?php

namespace DevHau\Modules\Http\Livewire\Admin\Setting;

use DevHau\Modules\Builder\Modal\ModalComponent;

class Index extends ModalComponent
{
    private const default = [
        ['name' => 'General', 'icon' => '<i class="bi bi-gear"></i>', 'key' => 'devhau-module::admin.setting.general'],
        ['name' => 'Theme', 'icon' => '<i class="bi bi-gear"></i>', 'key' => 'devhau-module::admin.setting.theme'],
    ];
    public $settingKey = "";
    public $settings = [];
    public function mount()
    {
        $this->setTitle('Thiết lập');
        $this->settings = Index::default;
        $this->settingKey = $this->settings[0]['key'];
    }
    public function SetKey($key)
    {
        $this->settingKey = $key;
    }
    public function render()
    {
        return $this->viewModal('devhau-module::admin.setting.index');
    }
}
