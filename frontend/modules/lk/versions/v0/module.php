<?php

namespace frontend\modules\lk\versions\v0;

use common\models\ReferralsUser;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\lk\controllers\v0';

    public function init()
    {
        if(\Yii::$app->getUser()->isGuest){
            \Yii::$app->session->setFlash('info', 'Необходимо зарегистрироваться');
            return \Yii::$app->runAction('index');
        }elseif(ReferralsUser::find()->where(['user_id'=>\Yii::$app->getUser()->id])->exists()){
            $this->controllerNamespace = 'frontend\modules\lk\controllers\vsp0';
        }
        parent::init();
        $this->setLayoutPath('@frontend/modules/lk/views/layouts');
        $this->setViewPath('@frontend/modules/lk/views');
    }
}
