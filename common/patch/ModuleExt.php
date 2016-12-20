<?php
namespace common\patch;

use Yii;
use yii\base\Module;


Class ModuleExt extends Module
{
    public $controllersDir = '';
    public function init()
    {
        parent::init();
        if(!$this->controllersDir){
            $this->controllersDir = basename(__DIR__);
        }
        $this->controllerNamespace = 'frontend\modules\\' . $this->id . '\controllers\\' . $this->controllersDir;
        $this->setLayoutPath('@frontend/themes/'. Yii::$app->params['constantapp']['APP_VERSION']['themesversion'].'/resources/modules' .
            '/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/' . $this->id.'/layouts');
        $this->setViewPath('@frontend/themes/'. Yii::$app->params['constantapp']['APP_VERSION']['themesversion'].'/resources/modules' .
          //  Yii::$app->params['constantapp']['APP_VERSION']['themesversion'] .
            '/' . Yii::$app->params['constantapp']['APP_THEMES'] .
             '/' . $this->id);

    }
}
