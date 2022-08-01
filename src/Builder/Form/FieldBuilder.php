<?php

namespace DevHau\Modules\Builder\Form;

class FieldBuilder
{
    public $option;
    public $data;
    public $formData;
    public function __construct($option, $data, $formData)
    {
        $this->option = $option;
        $this->data = $data;
        $this->formData = $formData;
    }
    public function getModelField()
    {
        if (getValueByKey($this->formData, 'filter', false)) {
            return 'wire:model.lazy="' . getValueByKey($this->formData, 'prex', '') . $this->option['field'] . '"';
        }
        return (getValueByKey($this->option, 'defer', true) ? 'wire:model.defer' : 'wire:model') . '="' . getValueByKey($this->formData, 'prex', '')  . $this->option['field'] . '"';
    }
    public function RenderToHtml()
    {
        $fieldType = getValueByKey($this->option, 'fieldType', '');
        if (getValueByKey($this->formData, 'filter', false) && ($fieldType == FieldType::Quill || $fieldType == FieldType::Textarea)) {
            $fieldType = FieldType::Text;
        }
        ob_start();
        switch ($fieldType) {
            case FieldType::Check:
                echo '<div class="form-check"><input type="checkbox" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-check-input" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/></div>';
                break;
            case FieldType::Number:
                echo '<input type="number" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;

            case FieldType::Date:
                echo '<input type="date" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control el-date" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;

            case FieldType::DateTime:
                echo '<input type="datetime" ' . (getValueByKey($this->option, 'attr', '')) . ' data-enable-time="true" class="form-control el-date" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;

            case FieldType::Time:
                echo '<input type="time" data-mode="time" class="form-control el-date" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;

            case FieldType::Color:
                echo '<input type="color" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;

            case FieldType::Textarea:
                echo '<textarea ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"></textarea>';
                break;

            case FieldType::Quill:
                echo '<textarea ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control  el-quill" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"></textarea>';
                break;

            case FieldType::Password:
                echo '<input type="password" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;
            case FieldType::Tag:
                echo '<input type="text" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control el-tag" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;
            case FieldType::Dropdown:
                $funcData = getValueByKey($this->option, 'funcData', null);
                if ($funcData && is_array($funcData)) {
                } else if ($funcData) {
                    $funcData = $funcData();
                }
                echo '<select ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control"  id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '">';
                if (getValueByKey($this->formData, 'filter', false)) {
                    echo '<option value="">' . $this->option['title'] . '</option>';
                }
                if ($funcData) {
                    foreach ($funcData as $item) {
                        echo '<option value="' . getValueByKey($item, getValueByKey($this->option, 'fieldKey', 'id'), $item) . '">' . getValueByKey($item, getValueByKey($this->option, 'fieldText', 'text'), $item) . '</option>';
                    }
                }
                echo '</select>';
                break;
            case FieldType::Multiselect:
                $funcData = getValueByKey($this->option, 'funcData', null);
                if ($funcData && is_array($funcData)) {
                } else if ($funcData) {
                    $funcData = $funcData();
                }
                echo '<select ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" multiple id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '">';
                if ($funcData) {
                    foreach ($funcData as $item) {
                        echo '<option value="' . getValueByKey($item, getValueByKey($this->option, 'fieldKey', 'id'), $item) . '">' . getValueByKey($item, getValueByKey($this->option, 'fieldText', 'text'), $item) . '</option>';
                    }
                }
                echo '</select>';
                break;

            case FieldType::File:
                echo '<div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
            >';
                echo '<input type="file" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control el-file" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                echo '<div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
        </div>';
                break;

            case FieldType::Image:
                $value_image = isset($this->data->{$this->option['field']}) ? $this->data->{$this->option['field']} : null;
                echo '<div  x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                class="form-control el-image" for="input-' . $this->option['field'] . '" >';
                if ($value_image && !is_string($value_image)) {
                    echo '<img src="' . $value_image->temporaryUrl() . '"/>';
                } else if ($value_image) {
                    echo '<img src="' . asset($value_image) . '"/>';
                }
                echo '<div x-show="isUploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>';
                echo '<input type="file" ' . (getValueByKey($this->option, 'attr', '')) . ' class=" " id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>
                </div>';
                break;
            case FieldType::Cron:
                echo '<input type="text" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control text-warning fw-bold fs-6" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '" style="background-color: rgb(56, 43, 95);"/>';
                break;
            case FieldType::Text:
            default:
                echo '<input type="text" ' . (getValueByKey($this->option, 'attr', '')) . ' class="form-control" id="input-' . $this->option['field'] . '" ' .  $this->getModelField() . '"/>';
                break;
        }
        $errors = getValueByKey($this->formData, 'errors');
        if ($errors && $errors->has($this->option['field'])) {
            echo '<span class="error">' . $errors->first($this->option['field']) . '</span> ';
        }
        return ob_get_clean();
    }
    public static function Render($option, $data, $formData)
    {
        return (new self($option, $data, $formData))->RenderToHtml();
    }
}
