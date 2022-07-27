<?php

use DevHau\Modules\Builder\Modal\ModalSize;

return [
    'model' => \DevHau\Modules\Models\ScheduleHistory::class,
    'DisableModule' => true,
    'title' => 'Schedule History',
    'emptyData' => 'Không có dữ liệu',
    'enableAction' => false,
    'action' => [
        'title' => '#',
        'add' => false,
        'edit' => false,
        'delete' => false,
        'export' => true,
        'inport' => true,
        'append' => [
            [
                'title' => 'Xóa hết lịch sử',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'action' => function () {
                    return 'wire:click=\'clearData()\'';
                }
            ]
        ]
    ],
    'formSize' => ModalSize::ExtraLarge,
    'fields' => [
        [
            'field' => 'command',
            'title' => 'Lệnh chạy'
        ],
        [
            'field' => 'params',
            'title' => 'params'
        ],
        [
            'field' => 'options',
            'title' => 'options'
        ],
        [
            'field' => 'output',
            'title' => 'Kết quả'
        ],
        [
            'field' => 'created_at',
            'title' => 'Chạy lúc'
        ]
    ]
];
