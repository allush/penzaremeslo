<?php
return [
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Ремесленная палата Пензенской области',
    'defaultController' => 'site',
    'preload' => ['log'],
    'import' => [
        'application.models.*',
        'application.components.*',
    ],
    'modules' => [
        'admin',
    ],
    'components' => [
        'db' => require(dirname(__FILE__) . '/db.php'),
        'request' => [
            'enableCsrfValidation' => true,
            'enableCookieValidation' => true,
        ],
        'user' => [
            'allowAutoLogin' => true,
        ],
        'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => [
                '/signIn' => '/site/signIn',
                '/signOut' => '/site/signOut',
                '/signUp' => '/site/signUp',
                '/about' => '/site/about',
                '/remind' => '/site/remind',
                '/contacts' => '/site/contacts',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<news:\w+>/<id:\d+>' => '<controller>/<news>',
                '<controller:\w+>/<news:\w+>' => '<controller>/<news>',
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
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
    'params' => [
        'adminEmail' => 'webmaster@example.com',
    ],
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
];