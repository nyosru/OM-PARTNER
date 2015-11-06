<?php
namespace frontend\controllers\actions;

use Yii;



trait CacheUserState
{
    public function actionUserstate()
    {
        $state = Yii::$app->request->post('state');
        if(($session = Yii::$app->session->set('state', serialize($state))) == false){
            return false;
        }else{
            return true;
        }

    }
    public function CasheUserStateGet()
    {
        if(($session = Yii::$app->session->get('state')) == false){
            return false;
        }else {
            return unserialize($session);
        }
    }
}
?>