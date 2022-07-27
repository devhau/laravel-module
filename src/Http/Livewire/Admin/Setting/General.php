<?php

namespace DevHau\Modules\Http\Livewire\Admin\Setting;

use DevHau\Modules\Builder\Form\FieldSize;
use DevHau\Modules\Builder\Form\FieldType;
use DevHau\Modules\Builder\Setting\SettingComponent;

class General extends SettingComponent
{
    public function getOptionProperty()
    {
        return [
            'fields' => [
                [
                    'title' => 'Tên hệ thống',
                    'field' => 'system_name',
                    'column' => FieldSize::Col12
                ],
                [
                    'title' => 'Mô tả hệ thống',
                    'field' => 'system_description',
                    'fieldType' => FieldType::Quill,
                    'column' => FieldSize::Col12
                ],
                [
                    'title' => 'Đóng cửa thời gian',
                    'field' => 'system_datetime',
                    'fieldType' => FieldType::Time,
                    'column' => FieldSize::Col12
                ]
            ]
        ];
    }
}
