<?php
namespace frontend\controllers\actions;
use common\models\AddressBook;
use common\models\Configuration;
use common\models\Coupons;
use common\models\Customers;
use common\models\Orders;
use common\models\PartnersOrders;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
trait ActionCart
{
    public function actionCart()
    {
        $act = (integer)Yii::$app->request->getQueryParam('action');
        $render_coupon_page = Yii::$app->request->get('coupon');
        if(!empty($render_coupon_page)){
            $message = [];
            $couponFind = [];
            $coupon = Yii::$app->request->post('coupon');
            if(isset($coupon)){
                if(!empty($coupon)){
                    $couponFind = $this->findCoupon($coupon,Yii::$app->request->post('totalPrice'));
                    $message = $couponFind['message'];
                } else {
                    $message["error"] = "Введите промо-код";
                }
            } else {
                $coupon = '';
            }
            return $this->renderAjax('_cart-coupon',[
                'message'=>$message,
                'coupon'=>$coupon,
                'model'=>$couponFind['model'],
            ]);
        }
        switch ($act) {
            case 1: {
                if (!Yii::$app->user->isGuest) {
                    return $this->render('cartorderform');
                } else {
                    return $this->redirect('login');
                }
                break;
            }
            default:
                if(($userref = ReferralsUser::find()->where(['user_id'=>Yii::$app->user->getId()])->asArray()->one()) == TRUE){
                    $referral = Referrals::find()->where(['id'=>$userref['referral_id']])->asArray()->one();
                    $template = 'sp';
                    $wrapart = Configuration::find()->where(['configuration_key' => 'ORDERS_PACKAGING_OPTIONS'])->asArray()->one();
                    $wrap = PartnersProducts::find()->where(['products_model' => $wrapart['configuration_value']])->one();
                    $wrap = (integer)$wrap->products_price;
                     $userinfo = PartnersUsersInfo::find()->where(['id' => Yii::$app->user->getId()])->asArray()->one();
                       if( $userinfo && (!$lastorders = PartnersOrders::find()->select('partners_orders.create_date')->where(['user_id' => $userinfo['id']])->orderBy('partners_orders.id DESC')->asArray()->one()) == TRUE){
                        $lastorders = '-';
                    }elseif(isset($lastorders['create_date'])){
                        $lastorders = $lastorders['create_date'];
                    }
                }else{
                    $template = 'om';
                    $wrapart = Configuration::find()->where(['configuration_key' => 'ORDERS_PACKAGING_OPTIONS'])->asArray()->one();
                    $wrap = PartnersProducts::find()->where(['products_model' => $wrapart['configuration_value']])->one();
                    $wrap = (integer)$wrap->products_price;
                    $userinfo = PartnersUsersInfo::find()->where(['id' => Yii::$app->user->getId()])->asArray()->one();
                    $add = AddressBook::find()->where(['customers_id' => $userinfo['customers_id']])->asArray()->all();
                    $default = Customers::find()->select('delivery_adress_id as default')->where(['customers_id' => $userinfo['customers_id']])->asArray()->one();
                    // $plusorders=Orders::find()->select('orders_id')->where(['customers_id'=>$userinfo['customers_id'], 'orders_status'=>[1,2]])->asArray()->all();
                    $addr = [];
                    if( $userinfo['customers_id'] && (!$lastorders = Orders::find()->select('orders.date_purchased')->where(['customers_id' => $userinfo['customers_id']])->orderBy('orders.orders_id DESC')->asArray()->one()) == TRUE){
                        $lastorders = '-';
                    }elseif(isset($lastorders['date_purchased'])){
                        $lastorders = $lastorders['date_purchased'];
                    }
                    foreach ($add as $key => $value) {
                        $addr[$value['address_book_id']] = $value['entry_city'] . ', ' . $value['entry_street_address'];
                    }
                }


                return $this->render('cart', ['addr' => $addr, 'userinfo' =>$userinfo ,'default' => $default['default'], 'wrapprice' => $wrap, 'lastorders'=>$lastorders,'template'=>$template, 'refpercent'=>$referral['percent']]);
        }
    }
}