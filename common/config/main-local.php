<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=10.0.0.6;dbname=odezhdaegorov',
            'username' => 'odezhdaegorov',
            'password' => 'Sda23hGRT',
            'charset' => 'utf8',
        ],
        'urlManager' =>[
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
          //  ВАЖНО!! - определение правил для options должный идти в самом конце, иначе перекрывают
            'rules' => [

                'POST <controller:\w+>s' => '<controller>/create?',
                '<controller:\w+>s' => '<controller>/index?',
                'PUT <controller:\w+>/<id:\d+>'    => '<controller>/update?',
                'DELETE <controller:\w+>/<id:\d+>' => '<controller>/delete?',
                '<controller:\w+>/<id:\d+>'        => '<controller>/view?',

            ],






        ],
    ],
];
