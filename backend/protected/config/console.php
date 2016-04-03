<?php return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    'preload' => ['log'],
    'components' => [
        'db' => require(dirname(__FILE__) . '/db.php'),
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
            ],
        ],
    ],
    'timeZone' => 'Europe/Moscow',
];