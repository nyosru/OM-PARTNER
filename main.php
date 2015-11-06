<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'fileCache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=odezhdaegorov',
            'username' => 'odezhdaegorov',
            'password' => 'Sda23hGRT',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCache' => 'cache',
            'schemaCacheDuration' => 0
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,


        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'POST <controller:\w+>s' => '<controller>/create',
               '<controller:\w+>s' => '<controller>/index',
                'PUT <controller:\w+>/<id:\d+>'    => '<controller>/update',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete',
                '<controller:\w+>/<id:\d+>'        => '<controller>/view',
                'site/catalog/<path:.*>' => 'site/catalog',
            ],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager'],

        'view' => [
            'theme' => [
                'basePath' => '@app/themes/default2',
                'baseUrl' => '@web/themes/default2',
            ],
        ],
    ],
];
