<?php

namespace DevHau\Modules\Traits;

use DevHau\Modules\Builder\Modal\ModalSize;
use DevHau\Modules\TableLoader;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Replace;

trait UseModuleEdit
{
    use WithFileUploads;
    public $module = '';
    public $dataId = 0;
    public $isFormNew = true;
    public $rules = [];
    protected function getView()
    {
        return 'devhau-module::admin.table.edit';
    }
    public function getOptionProperty()
    {
        return TableLoader::getInstance()->getTableByKey($this->module);
    }
    public function getFieldsProperty()
    {
        return  getValueByKey($this->getOptionProperty(), 'fields', []);
    }
    public function LoadModule($module, $dataId = null)
    {
        $this->dataId = $dataId;
        if (!$module) return abort(404);
        $this->module = $module;
        $option = $this->getOptionProperty();
        if (!$option || !isset($option['model']) || $option['model'] == '')
            return abort(404);

        if (!$this->isPage) {
            $this->sizeModal = getValueByKey($option, 'formSize',  ModalSize::FullscreenMd);
        }
        $this->setTitle(getValueByKey($option, 'title', ''));
        $fields = $this->getFieldsProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option['model'])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option['model']));
        }
        foreach ($fields as $item) {
            if (isset($item['field']) && $item['field'] != '') {
                if (isset($data->{$item['field']}))
                    $this->{$item['field']} = $data->{$item['field']};
                else {
                    if ($this->isFormNew) {
                        $this->{$item['field']} = getValueByKey($item, 'default', '');
                    } else {
                        $this->{$item['field']} = '';
                    }
                }
            }
        }
        $fnRule = getValueByKey($option, 'formRule', null);
        if ($fnRule) {
            $this->rules = $fnRule($dataId, $this->isFormNew) ?? [];
        }
    }
    public function SaveForm()
    {
        if ($this->rules && count($this->rules) > 0)
            $this->validate();

        $option = $this->getOptionProperty();
        $data = null;
        if ($this->dataId) {
            // edit
            $data = app($option['model'])->find($this->dataId);
            if (!$data)
                return abort(404);
            $this->isFormNew = false;
        } else {
            // new
            $data = new (app($option['model']));
        }
        $fields = $this->getFieldsProperty();
        foreach ($fields as $item) {
            if (isset($item['field']) && $item['field'] != '') {
                $valuePreview = $this->{$item['field']};
                if (is_object($valuePreview)) {
                    $valuePreview = $valuePreview->store('public');
                    $valuePreview = str_replace('public', 'storage', $valuePreview);
                }
                $data->{$item['field']} =  $valuePreview;
            }
        }
        $data->save();
        $this->refreshData(['module' => $this->module]);
        $this->hideModal();
        $this->ShowMessage('Update successful!');
    }
    public function render()
    {
        return $this->viewModal($this->getView(), null, null, [
            'option' => $this->option,
            'fields' => $this->fields
        ]);
    }
}
