<?php
namespace frontend\controllers\actions;

use Yii;
trait ActionCart{
    public function actionCart(){
        $act=(integer)Yii::$app->request->getQueryParam('action');
        switch($act){
            case 1:{
                if(!Yii::$app->user->isGuest){
                    return $this->render('cartorderform');
                }
                else {
                    return $this->redirect('login');
                }
                break;
            }
            default:
                return $this->render('cart');
        }
    }
}