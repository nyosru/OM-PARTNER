<?php
namespace frontend\controllers\actions;
use common\models\AddressBook;
use common\models\Configuration;
use common\models\Customers;
use common\models\Orders;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use Yii;
trait ActionCart
{
    public function actionCart()
    {
        $act = (integer)Yii::$app->request->getQueryParam('action');
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
                if(($id = ReferralsUser::find()->where(['user_id'=>Yii::$app->user->getId()])) == TRUE){
                    $template = 'sp';
                }else{
                    $template = 'om';
                }

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
                return $this->render('cart', ['addr' => $addr, 'default' => $default['default'], 'wrapprice' => $wrap, 'lastorders'=>$lastorders,'template'=>$template]);
        }
    }
}