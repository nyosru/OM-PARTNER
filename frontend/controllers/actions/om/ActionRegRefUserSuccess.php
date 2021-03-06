<?php

namespace frontend\controllers\actions\om;


use common\models\OrdersStatusHistory;
use Yii;
use common\models\PartnersOrders;
use common\models\User;
use common\models\PartnersUsersInfo;
use common\models\Countries;
use common\models\Zones;
use common\models\AddressBook;
use common\models\Customers;
use common\models\Partners;
use common\models\CustomersInfo;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\OrdersProductsAttributes;
use common\models\OrdersTotal;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

trait ActionRegRefUserSuccess
{
    public function actionRegRefUserSuccess()
    {
        $this->layout = 'main';
        if(($data = Yii::$app->session->get('messageset')) == TRUE){
            Yii::$app->session->remove('messageset');
            return $this->render('registerreferral',['data'=>$data]);
        }
        return $this->redirect('/');
    }
}