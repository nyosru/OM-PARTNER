<?php
namespace frontend\modules\sp\controllers\actions;

use common\forms\CommonOrders\SendToOMForm;
use common\models\AddressBook;
use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\helpers\BaseHtmlPurifier;
use yii\helpers\Json;
use yii\validators\DateValidator;


trait ActionSendCommonOrders
{
    public function actionSendCommonOrders()
    {
        $this->layout = 'empty';
        $formmodel = new SendToOMForm();
        $shipping_fields = [];
        $shipping = $this->shippingMethod();
        foreach ($shipping as $ship_key=>$ship_value){
            $shipping_fields[$ship_key] = $ship_value['value'];
        }
        $wrap_fields = [];
        $wrap_data = $this->wrapMethod();
        foreach ($wrap_data as $wrap_key=>$wrap_value){
            $wrap_fields[$wrap_key] = $wrap_value['name'];
        }
        $address_fields = [];
        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();
        $address_data = AddressBook::find()->where('customers_id = :customersid',[':customersid'=>$referal['customer_id']])->asArray()->all();
        foreach ($address_data as $address_data_key => $address_data_value){
            $address_fields[$address_data_value['address_book_id']] =  $address_data_value['entry_city'].','.$address_data_value['entry_street_address'];
        }
        $formmodel->shipping_fields =  $shipping_fields;
        $formmodel->address_fields =  $address_fields;
        $formmodel->wrap_fields =  $wrap_fields;
        $formmodel->load(Yii::$app->request->getBodyParams());
        if(Yii::$app->request->post('form')){
            $formmodel->idorder = (integer)Yii::$app->request->post('form');
           $formmodel->renderForm();
           return;
       }elseif(Yii::$app->request->isPjax && !$formmodel->validate()){
            $formmodel->renderForm();
           return;
       }elseif(Yii::$app->request->isPjax && $formmodel->validate()){
            $x = $this->CommonOrdersToOm(
                $formmodel->idorder,
                $formmodel->address,
                $formmodel->shipping_method,
                $formmodel->wrap,
                $formmodel->comment);


$script = <<< JS
            console.log($x);
            var client_status_block = $('[data-detail="'+$formmodel->idorder+'"]').find('.client-order-status');
            client_status_block.removeClass("status-new");
            client_status_block.addClass("status-proceed");
             var orders_status_blocks = $(".client-order-status");
            orders_status_blocks.removeClass("status-new");
            orders_status_blocks.addClass("status-proceed");
JS;
            $x = Json::decode($x);
            if($x['result']['code'] == 200 && $x['result']['data']['paramorder']['number']) {
                echo '<script>';
                echo $script;
                echo '</script>';
            }


            $x  = $this->render('cartresult', $x);
            echo BaseHtmlPurifier::process($x);
       }else{
            $formmodel->renderForm();
            return;
       }

    }
}