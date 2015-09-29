<?php


defined('YII_DEBUG') or define('YII_DEBUG', true);
//defined('YII_ENV') or define('YII_ENV', 'dev');

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
$run = new Partners();
$check = $run->GetId($_SERVER['HTTP_HOST']);
if($check == ''){
    die;
}else{
    $application->params[constantapp]['APP_CAT'] =  $run -> GetAllowCat($check);
    $application->params[constantapp]['APP_NAME'] =   $run->GetNamePartner($check);
    $application->params[constantapp]['APP_ID'] =  $run -> GetId($_SERVER['HTTP_HOST']);
    $application->params[constantapp]['APP_THEMES'] =  $run->GetTemplate($check);
}
$application->setViewPath('@app/themes/'.$application->params[constantapp]['APP_THEMES'].'/views');
$application->setLayoutPath('@app/themes/'.$application->params[constantapp]['APP_THEMES'].'/views/layouts');


$application->run();
