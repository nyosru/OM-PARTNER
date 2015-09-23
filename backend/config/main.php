<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'homeUrl' => '',
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'partners' => [
            'class' => 'app\modules\partners\Partners',
        ],
        'orders' => [
            'class' => 'app\modules\orders\Orders',
        ],
        'calendar' => [
            'class' => 'app\modules\calendar\Calendar',
        ],
        'users' => [
            'class' => 'app\modules\users\Users',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'],
        'assetManager' => [
            'bundles' => [
                'backend\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

    ],
    'params' => $params,


];
