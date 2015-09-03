<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
         'dsn' => '',
          'username' => '',
         'password' => '',
         'charset' => '',
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            //ВАЖНО!! - определение правил для options должный идти в самом конце, иначе перекрывают
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

    ],
];
