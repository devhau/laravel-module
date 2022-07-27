<?php

namespace DevHau\Modules\Http\Livewire\Admin\Setting;

use DevHau\Modules\Builder\Form\FieldSize;
use DevHau\Modules\Builder\Form\FieldType;
use DevHau\Modules\Builder\Setting\SettingComponent;
use DevHau\Modules\Theme as ThemeCore;

class Theme extends SettingComponent
{
    public function getOptionProperty()
    {
        $themes = ThemeCore::getList();
        return [
            'fields' => [
                [
                    'title' => 'Tiêu đề',
                    'field' => 'theme_title',
                    'column' => FieldSize::Col12
                ],
                [
                    'title' => 'Mô tả',
                    'field' => 'theme_description',
                    'fieldType' => FieldType::Quill,
                    'column' => FieldSize::Col12
                ],
                [
                    'title' => 'Từ khóa',
                    'field' => 'theme_keyword',
                    'fieldType' => FieldType::Tag,
                    'column' => FieldSize::Col12
                ],
                [
                    'title' => 'Theme Admin',
                    'field' => 'theme_admin',
                    'fieldType' => FieldType::Dropdown,
                    'column' => FieldSize::Col12,
                    'funcData' => function () use ($themes) {
                        return $themes;
                    }
                ],
                [
                    'title' => 'Theme Site',
                    'field' => 'theme_site',
                    'fieldType' => FieldType::Dropdown,
                    'column' => FieldSize::Col12,
                    'funcData' => function () use ($themes) {
                        return $themes;
                    }
                ]
            ]
        ];
    }
}
