<?php
set_time_limit ( 800 );
ob_start("ob_gzhandler");

defined('YII_DEBUG') or define('YII_DEBUG', false);
defined('YII_ENV') or define('YII_ENV', 'prod');


require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/bootstrap.php');
require(__DIR__ . '/../config/bootstrap.php');




$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../../common/config/main-local.php'),
    require(__DIR__ . '/../config/main.php'),
    require(__DIR__ . '/../config/main-local.php')
);

$application = new yii\web\Application($config);


use common\models\Partners;
    $partner = Yii::$app->db->cache(
        function ($db) {
            $run = new Partners();
            $check = $run->GetId($_SERVER['HTTP_HOST']);
            if($check == ''){
                die;
            }else{
              return['APP_CAT' => $run -> GetAllowCat($check), 'APP_NAME' =>  $run->GetNamePartner($check), 'APP_ID' =>  $run -> GetId($_SERVER['HTTP_HOST']), 'APP_THEMES' =>  $run->GetTemplate($check)];

            }    }, 3600
    );
$application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
$application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
$application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
$application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];
$application->setViewPath('@app/themes/'.$application->params['constantapp']['APP_THEMES'].'/views');
$application->setLayoutPath('@app/themes/'.$application->params['constantapp']['APP_THEMES'].'/views/layouts');


$application->run();
echo round(memory_get_usage()/1024/1024,2);
ob_end_flush();