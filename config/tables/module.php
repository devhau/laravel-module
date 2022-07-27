<?php

use DevHau\Modules\Builder\Form\FieldSize;
use DevHau\Modules\Builder\Form\FieldType;

return [
    'model' => \DevHau\Modules\Models\User::class,
    'modelkey' => 'name',
    'DisableModule' => true,
    'title' => 'Tài khoản',
    'emptyData' => 'Không có dữ liệu',
    'excel' => [
        'template' => '',
        'import' => \DevHau\Modules\Excel\ExcelInport::class,
        'export' => \DevHau\Modules\Excel\ExcelExport::class,
        'header' => ['id', 'Họ Tên', 'Trạng thái'],
        'mapdata' => function ($item) {
            return [
                $item->id,
                $item->name,
                $item->status
            ];
        }
    ],
    'action' => [
        'title' => '#',
        'add' => false,
        'edit' => false,
        'delete' => false,
        'export' => true,
        'inport' => false,
        'append' => [
            [
                'title' => 'Tạo mới module',
                'icon' => '<i class="bi bi-magic"></i>',
                'class' => 'btn-primary',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal="devhau-module::admin.permission.index()"';
                }
            ]
        ]
    ],
    'formEdit' => '',
    'formInclude' => '',
    'formClass' => 'p-1',
    'layoutForm' => [
        'common' => [
            [
                ['key' => 'row1_1', 'column' => FieldSize::Col6],
                ['key' => 'row1_2', 'column' => FieldSize::Col6],
            ],
            [
                ['key' => 'row2_1', 'column' => FieldSize::Col12],
            ]
        ]
    ],
    'fields' => [
        [
            'field' => 'name',
            'fieldType' => FieldType::Text,
            'title' => 'Module Name',
            'keyColumn' => 'row1_1'
        ],
        [
            'field' => 'email',
            'title' => 'Email',
            'view' => false,
            'keyColumn' => 'row1_2'
        ],
        [
            'field' => 'description',
            'title' => 'Thông tin',
            'keyColumn' => 'row1_1'
        ],
        [
            'fieldType' => FieldType::Dropdown,
            'funcData' => function () {
                return [
                    [
                        'id' => 0,
                        'text' => 'Chưa kích hoạt'
                    ],
                    [
                        'id' => 1,
                        'text' => 'Kích hoạt'
                    ]
                ];
            },
            'funcCell' => function ($row, $column) {
                if ($row[$column['field']] == 1) {
                    return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-primary btn-sm text-nowrap">Kích hoạt</button>';
                }
                return '<button wire:click="ChangeStatus(\'' . $row['name'] . '\')" class="btn btn-danger btn-sm text-nowrap">Chưa kích hoạt</button>';
            },
            'field' => 'status',
            
            'title' => '',
            'keyColumn' => 'row1_2',
        ]
    ]
];
