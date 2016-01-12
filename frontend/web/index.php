<?php
set_time_limit ( 800 );
//set_error_handler('err_handler');
//function err_handler($errno, $errmsg, $filename, $linenum) {
//    $date = date('Y-m-d H:i:s (T)');
//    $f = fopen('errors.txt', 'a');
//    if (!empty($f)) {
//        $filename  =str_replace($_SERVER['DOCUMENT_ROOT'],'',$filename);
//        $err  = "$errmsg = $filename = $linenum\r\n";
//        fwrite($f, $err);
//        fclose($f);
//    }
//}
//if ($_GET['adm'] == 'st') {
//
//} else {
//    echo '<div style="position: absolute; left: 50%; top: 50%; margin: -10px -10%;">САЙТ НА ТЕХНИЧЕСКОМ ОБСЛУЖИВАНИИ</div>';
//    die();
//}
ob_start("ob_gzhandler");
defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
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
$versions = require(__DIR__ . '/../config/versions.php');

$application = new yii\web\Application($config);

use common\models\Partners;


        $run = new Partners();
        $check = $run->GetId($_SERVER['HTTP_HOST']);
        if ($check == '') {
            // die;
        } else {

            $key = Yii::$app->cache->buildKey('constantapp-' . $check);
            if (($partner = Yii::$app->cache->get($key)) == FALSE && !isset($partner['APP_ID']) && !isset($partner['APP_CAT']) && !isset($partner['APP_NAME']) && !isset($partner['APP_THEMES'])) {
                $partner['APP_ID'] = $run->GetId($_SERVER['HTTP_HOST']);
                $partner['APP_CAT'] = $run->GetAllowCat($check);
                $partner['APP_NAME'] = $run->GetNamePartner($check);
                $partner['APP_THEMES'] = $run->GetTemplate($check);
                // echo 'Не Кэш';
                Yii::$app->cache->set($key, ['APP_ID' => $partner['APP_ID'], 'APP_CAT' => $partner['APP_CAT'], 'APP_NAME' => $partner['APP_NAME'], 'APP_THEMES' => $partner['APP_THEMES']]);
            } else {
                // echo 'Кэш';
            }



        }
//echo '<pre>';
//print_r($versions);
//echo '</pre>';
//die();
if (($versionnum = $partner['APP_VERSION']) == FALSE) {
    $version = $versions['0'];
} else {
    $version = $versions[$versionnum];
}

$config['controllerNamespace'] = 'frontend\controllers\versions' . $version['frontend'];
unset($version['frontend']);
foreach ($version as $key => $mvc) {
    $config['modules'][$key]['class'] = 'frontend\modules\\' . $key . '\versions' . $mvc . '\module';
}

$application = new yii\web\Application($config);
$application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
$application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
$application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
$application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];


use common\models\PartnersSettings;
class LoadTraitIndex
{
    use \common\traits\ThemeResources;
}
$temlate_key = Yii::$app->cache->buildKey('templatepartners-' . $partner['APP_ID']);
$template_data = Yii::$app->cache->get($temlate_key);
if(!$template_data){
    $partnersettings = new PartnersSettings();
    $partnerset = $partnersettings->LoadSet();
    Yii::$app->assetManager->appendTimestamp = true;
    if (isset($partnerset['template']['value'])) {
        $path = new LoadTraitIndex();
        $theme = $path->ThemeResourcesload($partnerset['template']['value'], 'site')['view'];
    } else {
        $theme = $application->params['constantapp']['APP_THEMES'];
    }
    $asset = new \frontend\assets\AppAsset();
    $assetsite = $asset->LoadAssets($partnerset['template']['value'], 'site');
    $asset = new \frontend\assets\AppAsset();
    $adminasset = $asset->LoadAssets($partnerset['template']['value'], 'back');
    Yii::$app->cache->set($temlate_key, ['data' => $assetsite, 'dataadmin' => $adminasset, 'theme' => $theme, 'partnerset' => $partnerset]);
}else {
    $assetsite = $template_data['data'];
    $adminasset = $template_data['dataadmin'];
    $theme = $template_data['theme'];
    $partnerset = $template_data['partnerset'];
}
$application->params['partnersset'] = $partnerset;
$application->setViewPath('@app/themes/resources/views/' . $theme);
$application->setLayoutPath('@app/themes/resources/views/' . $theme . '/layouts');
$application->params['assetsite'] = $assetsite;
$application->params['adminasset'] = $adminasset;
$application->run();
ob_end_flush();
