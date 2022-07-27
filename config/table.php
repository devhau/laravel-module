<?php

/*
 * You can place your custom package configuration in here.
 */

return [
    'user' => loadFileReturn(__DIR__ . '/tables/user.php'),
    'role' => loadFileReturn(__DIR__ . '/tables/role.php'),
    'permission' => loadFileReturn(__DIR__ . '/tables/permission.php'),
    'schedule' => loadFileReturn(__DIR__ . '/tables/schedule.php'),
    'schedule_history' => loadFileReturn(__DIR__ . '/tables/schedule_history.php'),
    'module' => loadFileReturn(__DIR__ . '/tables/module.php'),
];
