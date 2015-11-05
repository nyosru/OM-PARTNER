<?php
namespace common\traits;
use frontend\assets\AppAsset;
use Yii;
trait ThemeResources
{
    private $paththemes = '@app/themes';
    private $resourcespath = '@app/themes/resources';
    public function ThemeResourcesload($identify = 'default2'){
        $path = Yii::getAlias($this->paththemes).'/'.$identify.'/template.xml';

        if(file_exists($path)) {
            $xmlinfo = simplexml_load_file($path)->resources;
            if($xmlinfo){
            $viewpath = $xmlinfo->views->name;
            $csspath = $xmlinfo->css->name;
            $jspath = $xmlinfo->js->name;
                if(!$csspath){
                    return ['exception' => 'Подключаемый ресурс css не существует'];
                }else{
                  $csspath =  Yii::$app->assetManager->publish($this->resourcespath.'/css');
                }
                if(!$jspath){
                    return ['exception' => 'Подключаемый ресурс js не существует'];
                }else{
                  $jspath =  Yii::$app->assetManager->publish($this->resourcespath.'/js');
                }
                if(!$viewpath){
                    return ['exception' => 'Подключаемый ресурс view не существует'];
                }else{

                }
                if($jspath && $viewpath && $csspath) {
                  Yii::$app->assetManager->publish($this->resourcespath.'/css');

                    return ['view' => (string)$viewpath, 'css' => (string)$csspath, 'js' => (string)$jspath];
                }
            }else{
                return ['exception' => 'Некоректный формат файла', 'data' => $path];
            }
        }else{
            return ['exception' => 'Тема не существует', 'data' => $path];
        }
    }
}