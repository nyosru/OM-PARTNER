<?php

namespace frontend\modules\lk\versions\v0;

use common\models\ReferralsUser;
use common\patch\ModuleExt;

class module extends ModuleExt
{
    public $controllerNamespace = 'frontend\modules\lk\controllers\v0';

    public function init()
    {
        $this->controllersDir = basename(__DIR__);
        parent::init();
        if(\Yii::$app->getUser()->isGuest){
            \Yii::$app->session->setFlash('info', 'Необходимо зарегистрироваться');
            return \Yii::$app->runAction('index');
        }elseif(ReferralsUser::find()->where(['user_id'=>\Yii::$app->getUser()->id])->exists()){
            $this->controllersDir = 'vsp0';
        }
    }
}
