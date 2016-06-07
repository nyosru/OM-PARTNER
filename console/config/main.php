<?php

return [
    'homeUrl' => '/',
    'id' => 'app-test',
    'basePath' => dirname(__DIR__),
 //   'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'adminsite' => [
            'class' => 'frontend\modules\adminsite\module',
        ],
    ],
    'timeZone' => 'Europe/Moscow',
    'bootstrap'    => ['assetsAutoCompress'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'request' => [
            'baseUrl' => '',
        ],
        'assetsAutoCompress' =>
            [
                'class'             => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
                'enabled'           => true,
                'jsCompress'        => true,
                'cssFileCompile'    => true,
                'jsFileCompile'     => true,
                'cssFileBottomLoadOnJs' => false,
                'jsCompressFlaggedComments' => true,
                'cssFileBottom' => false,
                'jsFileCompressFlaggedComments' => true
            ],
        'fileCache' => [
            'class' => 'yii\caching\FileCache'
        ],
        'cache' => [
         //   'class' => 'yii\redis\Cache',
         //   'class' => 'yii\caching\ApcCache',
            'useApcu' => true
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'smtp.yandex.ru',
//                'username' => 'mail.odezhda.master',
//                'password' => 'Oleinum85',
//                'port' => '465',
//                'encryption' => 'ssl',
//            ],


        ],

        
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller:\w+>/<id:\d+>'        => '<controller>/view',
            ],
        ],
//        'view' => [
//            'class' => '\rmrevin\yii\minify\View',
//            'enableMinify' => true,
//            'web_path' => '@webroot', // path alias to web base
//            'base_path' => '@webroot', // path alias to web base
//            'minify_path' => '@webroot/assets/minify', // path alias to save minify result
//            'js_position' => [ \yii\web\View::POS_HEAD ], // positions of js files to be minified
//            'force_charset' => 'UTF-8', // charset forcibly assign, otherwise will use all of the files found charset
//            'expand_imports' => true, // whether to change @import on content
//            'compress_output' => true, // compress result html page
         //   'compress_options' => ['extra' => true], // options for compress
       // ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'],

        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname'     => '10.0.0.66',
            'port'     => '6379',
            'password' => 'zuAmok23sa',
            'database' => 1,
        ],
    ],
];
