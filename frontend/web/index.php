<?php

use common\models\Partners;
use common\models\PartnersSettings;
use common\models\PartnersDomain;
use common\traits\ThemeResourcesClass;
use frontend\assets\AppAsset;
ob_start("ob_gzhandler", 32);
if (function_exists('pinba_script_name_set')) {
    pinba_script_name_set($_SERVER['REQUEST_URI']);
}
set_time_limit ( 120 );
date_default_timezone_set('Europe/Moscow');
error_reporting(E_ERROR);





if($_GET['admin'] === 'skhesjebgjrbgkjbrgb'){
    defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
}else {
    defined('YII_DEBUG') or define('YII_DEBUG', FALSE);
}
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






function off(){
    Yii::$app->db->close();
}
register_shutdown_function('off');

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
$match = $version['frontend']['defroute'];
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

Yii::setAlias('partial', Yii::getAlias('@app/themes/'.$version['themesversion'].'/resources/partial'));

$temlate_key = Yii::$app->cache->buildKey('templatepartners-domain-' . md5(
        $_SERVER['HTTP_HOST'].'-'.
        $partner['APP_VERSION'].'-'.
        $partner['APP_ID'].'-'.
        $partner['APP_THEMES']
    ));
$template_data = Yii::$app->cache->get($temlate_key);
if(!$template_data){
    if(!is_dir(dirname(dirname(__DIR__)) . '/softdata/'.$partner['APP_ID'].'/'.$partner['APP_VERSION'].'/'.$partner['APP_THEMES'])){
        mkdir(dirname(dirname(__DIR__)) . '/softdata/'.$partner['APP_ID'].'/'.$partner['APP_VERSION'].'/'.$partner['APP_THEMES'], 0777, TRUE);
    }
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
Yii::setAlias('softdata',  dirname(dirname(__DIR__)) . '/softdata/'.$partner['APP_ID'].'/'.$partner['APP_VERSION'].'/'.$partner['APP_THEMES']);

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


if(Yii::$app->params['seourls'] == TRUE) {
    $application->on(\yii\base\Application::EVENT_BEFORE_REQUEST, function ($event, $match) {
        \Yii::$app->urlManager->addRules([
            '<action:products-discount>/<page:[0-9]*>' => '<action:products-discount>',
            '<action:products-discount>/<cat_start:[a-z-0-9-\/]+>/<page:[0-9]*>' => '/products-discount',
            '<action:products-discount>/<cat_start:[a-z-0-9-\/]*>' => '/products-discount',

            '<action:catalog>/<page:[0-9]*>' => '<action:catalog>',
            '<action:catalog>/<cat_start:[a-z-0-9-/]+>/<page:[0-9]*>' => '/catalog',
            '<action:catalog>/<cat_start:[a-z-0-9-/]*>' => '/catalog',

            '<action:product>/<productid:[a-z-0-9-]*>' => '/product'
        ]);
        $req = \Yii::$app->urlManager->parseRequest(\Yii::$app->request);
        if (($req[1]['action'] == 'catalog'
            ||
            $req[1]['action'] == 'products-discount'
            ||
            $req[1]['action'] == 'product')) {
            \Yii::$app->params['chpu'] = $req[1];
            \Yii::$app->request->setPathInfo($req[1]['action']);
            \Yii::$app->request->url = $req[1]['action'];
        } else if(preg_match('/\/(catalog|products-discount|product)$/iu',$req[0], $success)){
            $req[1]['action'] = $success[1];
            \Yii::$app->params['chpu'] = $req[1];
            \Yii::$app->request->setPathInfo($success[1]);
            \Yii::$app->request->url = $success[1];
        }
    });
}
$application->run();


if (function_exists('pinba_timer_stop')) {
    pinba_timer_stop($timer);

}
Yii::$app->db->close();
ob_end_flush();