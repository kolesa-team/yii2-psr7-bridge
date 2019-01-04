<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$logger = new Logger('name');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../runtime/test.log'));

return [
    'id' => 'yii2-psr7-bridge-test-app',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => '\yii\Psr7\tests\controllers',
    'components' => [
        'request' => [
            'class' => \yii\Psr7\web\Request::class,
            'request' => null,
            'enableCookieValidation' => false
        ],
        'response' => [
            'class' => \yii\Psr7\web\Response::class,
            'charset' => 'UTF-8'
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \samdark\log\PsrTarget::class,
                    'logger' => $logger,
                    'levels' => ['info', 'warning', 'error'],
                    'logVars' => []
                ],
            ],
        ],
        'urlManager' => [
            'class'                 => \yii\web\UrlManager::class,
            'showScriptName'        => false,
            'enableStrictParsing'   => false,
            'enablePrettyUrl'       => true,
            'rules' => [
                [
                    'pattern'   => '/<controller>/<action>',
                    'route'     => '<controller>/<action>'
                ]
            ]
        ]
    ],
];