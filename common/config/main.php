<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
         'dsn' => '',
          'username' => '',
         'password' => '',
         'charset' => 'utf8',
       // 'dsn' => 'mysql:host=localhost;dbname=1214',     //
      //  'username' => 'root',
      //  'password' => 'mysql',
      //  'charset' => 'utf8',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
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
        'cache' => [
            'class' => 'yii\caching\ApcCache',
        ],
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/default2',
                'baseUrl' => '@web/themes/default2',
            ],
        ],
    ],
];
