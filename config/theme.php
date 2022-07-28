<?php

return [
    'admin' => [
        'title' => 'ERP System',
        'admin' => true,
        'body-class' => 'sidebar-mini',
        'brand' => [
            'none' => 'ERP System',
            'mini' => 'ERP'
        ],
        'sidebar' => [
            'before' => [
                'devhau-module::common.brand'
            ],
            'after' => []
        ],
        'header' => [
            'left' => [],
            'center' => [],
            'right' => []
        ],
        'description' => '',
        'layout' => 'devhau-module::layout.admin',
        'is-turbo' => false,
        'js' => ['devhau-admin.js'],
        'css' => [
            'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css',
            'devhau-admin.css'
        ],
    ],
    'home' => [
        'title' => 'Page Home',
        'description' => '',
        'layout' =>  'devhau-module::layout.home',
        'is-turbo' => true,
        'js' => [],
        'css' => ['https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css'],
    ],
    'none' => [
        'title' => '',
        'description' => '',
        'layout' => 'devhau-module::layout.none',
        'is-turbo' => true,
        'js' => [],
        'css' => [],
    ]
];
