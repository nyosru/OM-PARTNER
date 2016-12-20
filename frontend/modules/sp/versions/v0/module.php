<?php

namespace frontend\modules\sp\versions\v0;

use common\patch\ModuleExt;

class module extends ModuleExt
{
    public function init()
    {
        if(\Yii::$app->user->isGuest == FALSE && (\Yii::$app->user->getIdentity()->getReferral()['id']) == TRUE){
            parent::init();
        }else{
            return \Yii::$app->runAction('index');
        }

    }
}
