<?php
namespace frontend\controllers\actions;

use common\models\AddressBook;
use common\models\PartnersUsersInfo;
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
                $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->one();
                $add=AddressBook::find()->where(['customers_id'=>$userinfo->customers_id])->all();
                $addr=[];
                foreach($add as $key=>$value){
                    $text=$value['entry_city'].', '.$value['entry_street_address'];
                    $addr[$value['address_book_id']]=$text;
                }
                return $this->render('cart',['addr'=>$addr]);
        }
    }
}