<?php
use common\models\Partners;
use common\models\PartnersSettings;
set_time_limit ( 800 );
date_default_timezone_set('Europe/Moscow');
error_reporting(E_ERROR | E_STRICT);
defined('YII_DEBUG') or define('YII_DEBUG', TRUE);
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
                $application = new yii\web\Application($config);
                $application->params['constantapp']['APP_CAT'] = $partner['APP_CAT'];
                $application->params['constantapp']['APP_NAME'] = $partner['APP_NAME'];
                $application->params['constantapp']['APP_ID'] = $partner['APP_ID'];
                $application->params['constantapp']['APP_THEMES'] = $partner['APP_THEMES'];
                $application->params['constantapp']['APP_VERSION'] = $version;
                class LoadTraitIndex
                {
                use \common\traits\ThemeResources;
                    use \common\traits\Categories\RestrictedCatalog;
                    use \common\traits\Manufacturers\HideMan;
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
                $application->layout = false;





          //      if(($cachesitemap == $application->cache->get('sitemap')) == FALSE) {

        $path = new LoadTraitIndex();
        $cat = implode(',', $path->RestrictedCatalog());
        $hide_man = implode(',', $path->HideMan());
        $count = \common\models\PartnersProductsToCategories::find()->select('products.products_id as prod')->innerJoinWith('products')->where('  categories_id NOT IN (' . $cat . ') and products_status = 1  and  products.products_quantity > 0  and  products.products_price != 0  and products.manufacturers_id NOT IN (' . $hide_man . ')')->distinct()->orderBy('products_to_categories.products_id DESC')->count();
        $c = 0;
        for($i = 0; $i<$count; $i+=25000){
            $cachesitemap  = '<?xml version="1.0" encoding="UTF-8"?>';
            $cachesitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
            $x = \common\models\PartnersProductsToCategories::find()->select('products.products_id as prod')->innerJoinWith('products')->where('  categories_id NOT IN (' . $cat . ') and products_status = 1  and  products.products_quantity > 0  and  products.products_price != 0  and products.manufacturers_id NOT IN (' . $hide_man . ')')->offset($i)->limit(25000)->distinct()->orderBy('products_to_categories.products_id DESC')->asArray()->all();
            foreach ($x as $keyx => $valuex) {
                  $url = 'http://' . $_SERVER['HTTP_HOST'] . BASEURL.'/product?id=' . $valuex['prod'];
                $cachesitemap .=  '<url>';
                $cachesitemap .=  '   <loc>' . $url . '</loc>';
                $cachesitemap .=  '  <changefreq>hourly</changefreq>';
                $cachesitemap .=  ' </url>';
            }
            $cachesitemap .= '</urlset>';
            file_put_contents('sitemap'.$c++.'.xml', $cachesitemap, 0777);
        }

        $cachecatsitemap  = '<?xml version="1.0" encoding="UTF-8"?>';
        $cachecatsitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
        $categoriess = new \common\models\PartnersCategories();
        $f = $categoriess->find()->select(['categories.categories_id'])->where('categories_status != 0')->innerJoinWith('categoriesDescription')->asArray()->all();
        foreach ($f as $key => $value) {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . BASEURL.'/catalog?cat=' . $value['categories_id'] . '&amp;count=60';
            $cachecatsitemap .=  '<url>';
            $cachecatsitemap .=  '   <loc>' . $url . '</loc>';
            $cachecatsitemap .=  '  <changefreq>hourly</changefreq>';
            $cachecatsitemap .=  ' </url>';
        }
         $cachecatsitemap .= '</urlset>';
         file_put_contents('sitemap.xml', $cachecatsitemap, 0777);

?>