<?php

return [
    'model' => \DevHau\Modules\Models\Permission::class,
    'DisableModule' => true,
    'title' => 'Quyền',
    'emptyData' => 'Không có dữ liệu',
    'enableAction' => true,

    'action' => [
        'title' => '#',
        'add' => true,
        'edit' => true,
        'delete' => true,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Cập nhật quyền',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'action' => function () {
                    return 'wire:click="updatePermission()"';
                }
            ]
        ]
    ],
    'fields' => [
        [
            'field' => 'group',
            'title' => 'Nhóm'
        ],
        [
            'field' => 'name',
            'title' => 'Tên Quyền'
        ],
    ]
];
