<?php
namespace frontend\controllers\actions;

use common\models\AddressBook;
use common\models\Customers;
use common\models\Orders;
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
                $userinfo=PartnersUsersInfo::find()->where(['id'=>Yii::$app->user->getId()])->asArray()->one();
                $add=AddressBook::find()->where(['customers_id'=>$userinfo['customers_id']])->asArray()->all();
                $default=Customers::find()->select('delivery_adress_id as default')->where(['customers_id'=>$userinfo['customers_id']])->asArray()->one();
                $plusorders=Orders::find()->select('orders_id')->where(['customers_id'=>$userinfo['customers_id'], 'orders_status'=>1])->asArray()->all();
                $addr=[];
                foreach($add as $key=>$value){
                    $addr[$value['address_book_id']]=$value['entry_city'].', '.$value['entry_street_address'];
                }
                return $this->render('cart',['addr'=>$addr, 'default'=>$default['default'], 'plusorders'=>$plusorders]);
        }
    }
}