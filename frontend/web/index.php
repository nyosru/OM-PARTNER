<?php

use common\models\Partners;
use common\models\PartnersSettings;
use common\models\PartnersDomain;
use common\traits\ThemeResourcesClass;
use frontend\assets\AppAsset;


set_time_limit ( 120 );
date_default_timezone_set('Europe/Moscow');
error_reporting(E_ERROR);


defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
defined('YII_ENV') or define('YII_ENV', 'dev');

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


function off($application){
    $application->db->close();
}
register_shutdown_function('off', $application);

if($application->params['construct'] == TRUE){
    echo '<html><body>';
    echo '<img style="margin: auto;position: absolute; top: 0; bottom: 0; right: 0;left: 0;" src="http://'.$_SERVER['HTTP_HOST'].'/images/logo/tz.png">';
    echo '</body></html>';
    die();
}

$key = Yii::$app->cache->buildKey('domain-constants-' . md5($_SERVER['HTTP_HOST']));
if (($partner = Yii::$app->cache->get($key)) == FALSE  ) {
    if((
        $partners_data = PartnersDomain::find()
        ->select([
         Partners::tableName().'.*',
         PartnersDomain::tableName().'.*'
        ])
        ->where(PartnersDomain::tableName().'.domain = :domain',[':domain'=>$_SERVER['HTTP_HOST']])
        ->joinWith('partner')
        ->asArray()->one()
        ) == TRUE
    ){
        $partner['APP_ID'] = $partners_data['partner_id'];
        $partner['APP_CAT'] = $partners_data['allow_cat'];
        $partner['APP_NAME'] = $partners_data['name'];
        $partner['APP_THEMES'] = $partners_data['template'];
        $partner['APP_VERSION'] = $partners_data['version'];
        Yii::$app->cache->set($key, [
            'APP_ID' => $partner['APP_ID'],
            'APP_CAT' => $partner['APP_CAT'],
            'APP_NAME' => $partner['APP_NAME'],
            'APP_THEMES' => $partner['APP_THEMES'],
            'APP_VERSION'=> $partner['APP_VERSION']
        ]);
    }else{
        exit('В данный момент домен не активен');
    }

}

if (!isset($versions[$partner['APP_VERSION']])) {
    $version = $versions['0'];
} else {
    $version = $versions[$partner['APP_VERSION']];
}

$config['controllerNamespace'] = 'frontend\controllers\versions' . $version['frontend']['namespace'];
$application->defaultRoute = $version['frontend']['defroute'] . '/index';
$config['components']['errorHandler']['errorAction'] = $version['frontend']['erraction'] . '/error';
//$catroute = $version['frontend']['defroute'] . '/catalog/<path:.*>';
//$config['components']['urlManager']['rules'][$catroute] = $version['frontend']['defroute'] . '/catalog';
$config['components']['urlManager']['rules']['/site/<action>'] = '/' . $version['frontend']['defroute'] . '/<action>';
$config['components']['urlManager']['rules']['<action>'] = '' . $version['frontend']['defroute'] . '/<action>';
$config['components']['urlManager']['rules']['/'] = $version['frontend']['defroute'];

//define('BASEURL', '/' . $version['frontend']['defroute']);
define('BASEURL', '');
unset($version['frontend']);
foreach ($version as $key => $mvc) {
    $config['modules'][$key]['class'] = 'frontend\modules\\' . $key . '\versions' . $mvc . '\module';
    $config['components']['urlManager']['rules']['<module:'.$key.'>/<action>'] = $key.'/default/<action>';
}

$application = new yii\web\Application($config);
if (function_exists('pinba_timer_stop')) {
    pinba_timer_stop($timer);

}
if (function_exists('pinba_timer_start')) {
    $timer =  pinba_timer_start(array('Tочка'=>'Вторичная настройка'));
}
if (function_exists('pinba_tag_set')) {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    pinba_tag_set('IP', $ipaddress);
    if(TRUE == ($user_id = $application->getUser()->getId()) ){
        pinba_tag_set('USER', $user_id);
    }
}

$application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
$application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
$application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
$application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];
$application->params['constantapp']['APP_VERSION'] = $version;


$temlate_key = Yii::$app->cache->buildKey('templatepartners-domain-' . md5(
        $_SERVER['HTTP_HOST'].'-'.
        $partner['APP_VERSION'].'-'.
        $partner['APP_ID'].'-'.
        $partner['APP_THEMES']
    ));
$template_data = Yii::$app->cache->get($temlate_key);
if(!$template_data){
    $partnersettings = new PartnersSettings();
    $partnerset = $partnersettings->LoadSet();
    Yii::$app->assetManager->appendTimestamp = true;
    if (isset($partnerset['template']['value'])) {
        $path = new ThemeResourcesClass();
        $theme = $path->ThemeResourcesload($partner['APP_THEMES'], 'site')['view'];
    } else {
        $theme = $application->params['constantapp']['APP_THEMES'];
    }
    $asset = new AppAsset();
    $assetsite = $asset->LoadAssets($partner['APP_THEMES'], 'site');
    $asset = new AppAsset();
    $adminasset = $asset->LoadAssets($partner['APP_THEMES'], 'back');
    Yii::$app->cache->set($temlate_key, ['data' => $assetsite, 'dataadmin' => $adminasset, 'theme' => $theme, 'partnerset' => $partnerset]);
}else {
    $assetsite = $template_data['data'];
    $adminasset = $template_data['dataadmin'];
    $theme = $template_data['theme'];
    $partnerset = $template_data['partnerset'];
}
$application->params['partnersset'] = $partnerset;
$application->setViewPath('@app/themes/'.$version['themesversion'].'/resources/views/' . $theme);
$application->setLayoutPath('@app/themes/'.$version['themesversion'].'/resources/views/' . $theme . '/layouts');
$application->params['assetsite'] = $assetsite;
$application->params['adminasset'] = $adminasset;
if (function_exists('pinba_timer_stop')) {
    pinba_timer_stop($timer);

}
if (function_exists('pinba_timer_start')) {
    $timer = pinba_timer_start(array('Tочка'=>'Работа'));
}


\Yii::$app->urlManager->addRules([
    '<action:catalog>/<cat_start:[a-z-\/]+>'=>'/catalog',
]);
\Yii::$app->urlManager->addRules([
    '<action:catalog>/<cat_start:[a-z-\/]+>/<page:[0-9]*>'=>'/catalog',
]);
$application->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function ($event) {
    $req = \Yii::$app->urlManager->parseRequest(\Yii::$app->request);
    if($req[1]['action'] == 'catalog' && $req[1]['cat_start']){
        \Yii::$app->params['chpu'] = $req[1];
        \Yii::$app->request->setPathInfo('catalog');
        \Yii::$app->request->url = 'catalog';
    }
});
$application->run();


if (function_exists('pinba_timer_stop')) {
    pinba_timer_stop($timer);

}
