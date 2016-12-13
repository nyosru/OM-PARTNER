<?php
namespace common\traits;

use frontend\assets\AppAsset;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\AssetBundle;


trait ThemeResources
{
    private $paththemes = '';
    private $resourcespath = '';

    public function ThemeResourcesload($identify, $side)
    {
        $this->paththemes = '@app/themes/' . Yii::$app->params['constantapp']['APP_VERSION']['themesversion'];
        $this->resourcespath = '@app/themes/' . Yii::$app->params['constantapp']['APP_VERSION']['themesversion'] . '/resources/';
        Yii::$app->assetManager->appendTimestamp = true;
        // Yii::$app->assetManager->forceCopy = TRUE;
         Yii::$app->assetManager->linkAssets = true;
        $path = Yii::getAlias($this->paththemes) . '/' . $identify . '/template.xml';
        $resourcespath = Yii::getAlias($this->resourcespath);
        if (file_exists($path)) {
            $xmlinfo = simplexml_load_file($path)->resources;
            if ($xmlinfo) {
                $viewpath = $xmlinfo->views->name;
                $csspath = $xmlinfo->css->name;
                $jspath = $xmlinfo->js->name;
                if (!$csspath) {
                    return ['exception' => 'Подключаемый ресурс css не существует'];
                } else {
                    $csspathpub = Yii::$app->assetManager->publish($resourcespath . '/css/' . $csspath . '/' . $side);
                    $resdir = opendir($csspathpub[0]);
                    $css = Array();
                    if ($resdir) {
                        while (false !== ($file = readdir($resdir))) {
                            $cssar = explode('.', $file);
                            if (end($cssar) == 'css') {
                                $css[] = $csspathpub[1] . '/' . $file . '?v=' . filemtime($resourcespath . '/css/' . $csspath . '/' . $side . '/' . $file);
                            };
                        }
                    }
                }
                if (!$jspath) {
                    return ['exception' => 'Подключаемый ресурс js не существует'];
                } else {

                    $jspathpub = Yii::$app->assetManager->publish($resourcespath . '/js/' . $jspath . '/' . $side);
                    $resdir = opendir($jspathpub[0]);
                    $js = Array();
                    if ($resdir) {
                        while (false !== ($file = readdir($resdir))) {
                            $jsarr = explode('.', $file);
                            if (end($jsarr) == 'js') {
                                $js[] = $jspathpub[1] . '/' . $file . '?v=' . filemtime($resourcespath . '/js/' . $jspath . '/' . $side . '/' . $file);
                            };
                        }
                    }
                }
                if (!$viewpath) {
                    return ['exception' => 'Подключаемый ресурс view не существует'];
                } else {

                }
                if ($jspath && $viewpath && $csspath) {
                    return ['view' => (string)$viewpath, 'css' => $css, 'js' => $js];
                }
            } else {
                return ['exception' => 'Некоректный формат файла', 'data' => $path];
            }
        } else {
            return ['exception' => 'Тема не существует', 'data' => $path];
        }
    }

}