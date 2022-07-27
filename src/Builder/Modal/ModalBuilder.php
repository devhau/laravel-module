<?php

namespace DevHau\Modules\Builder\Modal;

use Illuminate\Support\Str;
use Livewire\Component;

class ModalBuilder extends Component
{
    protected $listeners = ['openModal' => 'openModal', 'closeModal' => 'closeModal'];
    public $modals = [];
    public function render()
    {
        return view('devhau-module::modal');
    }
    public function openModal($modal, $params)
    {
        $modalId = Str::random(20);
        $this->modals[] = [
            'modal' => $modal,
            'params' => isset($params) && count($params) > 0 ? $params[0] : [],
            'id' => $modalId
        ];
    }
    public function closeModal($modalId)
    {
        $this->modals = \array_filter($this->modals, static function ($element) use ($modalId) {
            return $element['id'] != $modalId;
        });
    }
}
