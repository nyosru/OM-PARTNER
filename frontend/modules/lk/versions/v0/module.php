<?php

namespace frontend\modules\lk\versions\v0;

use common\models\ReferralsUser;
use common\patch\ModuleExt;

class module extends ModuleExt
{
    public function init()
    {

        if(!\Yii::$app->user->identity){
            \Yii::$app->session->setFlash('info', 'Необходимо зарегистрироваться');
            return \Yii::$app->runAction('index');
        }elseif(ReferralsUser::find()->where(['user_id'=>\Yii::$app->getUser()->id])->exists()){

            $this->controllersDir = 'vsp0';
            parent::init();
        }else{
            $this->controllersDir = basename(__DIR__);
            parent::init();
        }
    }
}
