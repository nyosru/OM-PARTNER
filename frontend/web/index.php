<?php

set_error_handler('err_handler');
function err_handler($errno, $errmsg, $filename, $linenum)
{
    $date = date('Y-m-d H:i:s (T)');
    $f = fopen('errors.txt', 'a');
    if (!empty($f)) {
        $filename = str_replace('../', '', $filename);
        $err = "$errmsg = $filename = $linenum\r\n";
        fwrite($f, $err);
        fclose($f);
    }
}
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
ob_end_flush();