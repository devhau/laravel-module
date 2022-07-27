<?php

use DevHau\Modules\Builder\Modal\ModalSize;

return [
    'model' => \DevHau\Modules\Models\Schedule::class,
    'poll' => '10s',
    'DisableModule' => true,
    'title' => 'Schedule',
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
                'title' => 'Run now',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'update',
                'action' => function ($id) {
                    return 'wire:click="RunNow(\'' . $id . '\')"';
                }
            ], [
                'title' => 'Lịch sử bot chạy',
                'icon' => '<i class="bi bi-magic"></i>',
                'type' => 'new',
                'action' => function () {
                    return 'wire:openmodal=\'devhau-module::admin.schedule.history()\'';
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
            'field' => 'command_custom',
            'title' => 'Lệnh mở rộng chạy'
        ],
        [
            'field' => 'options',
            'title' => 'Lệnh mở rộng chạy'
        ],
        [
            'field' => 'expression',
            'title' => 'Chạy tiếp theo vào lúc',
            'funcCell' => function ($row, $column) {
                return CronNextRunDate($row['expression']);
            }
        ],
    ]
];
