<?php
namespace frontend\modules\admin\controllers\actions;

use common\models\Partners;
use common\models\PartnersSettings;
use frontend\assets\AppAsset;
use Yii;
trait ActionSavesettings{
    public function actionSavesettings()
    {
        $model = new PartnersSettings();
        $model->load($_POST);
        $model->SaveSet();
        $modelcat = Partners::findOne(Yii::$app->params['constantapp']['APP_ID']);
        $modelcat->allow_cat = implode(',', $_POST['categories_id']);
        $modelcat->save();
        $key = Yii::$app->cache->buildKey('categories');
        Yii::$app->cache->delete($key);
        $temlate_key = Yii::$app->cache->buildKey('templatepartners-' . Yii::$app->params['constantapp']['APP_ID']);
        $partnersettings = new PartnersSettings();
        $partnerset = $partnersettings->LoadSet();
        Yii::$app->assetManager->appendTimestamp = true;
        if (isset($partnerset['template']['value'])) {
            $theme = $this->ThemeResourcesload($partnerset['template']['value'], 'site')['view'];
        } else {
            $theme = Yii::$app->params['constantapp']['APP_THEMES'];
        }
        $asset = new AppAsset();
        $assetsite = $asset->LoadAssets($partnerset['template']['value'], 'site');
        $asset = new AppAsset();
        $adminasset = $asset->LoadAssets($partnerset['template']['value'], 'back');
        Yii::$app->cache->set($temlate_key, ['data' => $assetsite, 'dataadmin' => $adminasset, 'theme' => $theme, 'partnerset' => $partnerset]);
        return $this->render('index', ['model' => $model, 'exception' => '']);
    }
}