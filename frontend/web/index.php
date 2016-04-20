<?php

use common\models\Partners;
use common\models\PartnersSettings;
set_time_limit ( 800 );
date_default_timezone_set('Europe/Moscow');


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



$key = Yii::$app->cache->buildKey('constantapp-' . $_SERVER['HTTP_HOST']);
if (($partner = Yii::$app->cache->get($key)) == FALSE  ) {
    $run = new Partners();
    $check = $run->GetId($_SERVER['HTTP_HOST']);
    if ($check == '') {
        die();
    } else {
        $partner['APP_ID'] = $run->GetId($_SERVER['HTTP_HOST']);
        $partner['APP_CAT'] = $run->GetAllowCat($check);
        $partner['APP_NAME'] = $run->GetNamePartner($check);
        $partner['APP_THEMES'] = $run->GetTemplate($check);
        // echo 'Не Кэш';
        Yii::$app->cache->set($key, ['APP_ID' => $partner['APP_ID'], 'APP_CAT' => $partner['APP_CAT'], 'APP_NAME' => $partner['APP_NAME'], 'APP_THEMES' => $partner['APP_THEMES']]);
    }


}else{

}
$partner['APP_VERSION'] = 'om';
if (($versionnum = $partner['APP_VERSION']) == FALSE) {
    $version = $versions['0'];
} else {
    $version = $versions[$versionnum];
}

$config['controllerNamespace'] = 'frontend\controllers\versions' . $version['frontend']['namespace'];
$application->defaultRoute = $version['frontend']['defroute'] . '/index';
$config['components']['errorHandler']['errorAction'] = $version['frontend']['erraction'] . '/error';
$catroute = $version['frontend']['defroute'] . '/catalog/<path:.*>';
$config['components']['urlManager']['rules'][$catroute] = $version['frontend']['defroute'] . '/catalog';
$config['components']['urlManager']['rules']['/site/<action>'] = '/' . $version['frontend']['defroute'] . '/<action>';
$config['components']['urlManager']['rules']['<action>'] = '' . $version['frontend']['defroute'] . '/<action>';
$config['components']['urlManager']['rules']['/'] = $version['frontend']['defroute'];

//define('BASEURL', '/' . $version['frontend']['defroute']);
define('BASEURL', '');

unset($version['frontend']);
foreach ($version as $key => $mvc) {
    $config['modules'][$key]['class'] = 'frontend\modules\\' . $key . '\versions' . $mvc . '\module';
}

$config['components']['log']['targets'][] = [
    'class' => 'yii\log\FileTarget',
    'logFile' => '@frontend/runtime/logs/request/requests.log',
    'maxFileSize' => 1024 * 2,
    'maxLogFiles' => 1000,
];
$config['components']['log']['targets'][] = [
    'class' => 'yii\log\FileTarget',
    'levels' => ['info'],
    'logFile' => '@frontend/runtime/logs/response/response.log',
    'maxFileSize' => 1024 * 2,
    'maxLogFiles' => 1000
];
$config['components']['log']['targets'][] = [
    'class' => 'yii\log\FileTarget',
    'levels' => ['error', 'warning'],
    'categories' => ['yii\swiftmailer\Logger::add'],
    'logFile' => '@frontend/runtime/logs/mail-err/mail-err.log',
    'maxFileSize' => 1024 * 2,
    'maxLogFiles' => 1000
];
$config['components']['log']['targets'][] = [
    'class' => 'yii\log\FileTarget',
    'levels' => ['error', 'warning'],
    'logFile' => '@frontend/runtime/logs/error/error.log',
    'maxFileSize' => 1024 * 2,
    'maxLogFiles' => 1000
];

$application = new yii\web\Application($config);
$application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
$application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
$application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
$application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];
$application->params['constantapp']['APP_VERSION'] = $version;


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
$theme = 'defaultom';
$application->params['partnersset'] = $partnerset;
$application->setViewPath('@app/themes/'.$version['themesversion'].'/resources/views/' . $theme);
$application->setLayoutPath('@app/themes/'.$version['themesversion'].'/resources/views/' . $theme . '/layouts');
$application->params['assetsite'] = $assetsite;
$application->params['adminasset'] = $adminasset;
$application->on(yii\web\Application::EVENT_BEFORE_REQUEST, function(yii\base\Event $event){
    $event->sender->response->on(yii\web\Response::EVENT_BEFORE_SEND, function($e){
        ob_start("ob_gzhandler");
    });
    $event->sender->response->on(yii\web\Response::EVENT_AFTER_SEND, function($e){
        ob_end_flush();
    });
});

$application->run();

