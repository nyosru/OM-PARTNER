<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\Orders;
use common\models\OrdersReports;
use common\models\OrdersReportsOrders;
use common\models\OrdersToPartners;
use common\models\PartnersCategories;
use common\models\PartnersProducts;
use common\models\PartnersToRegion;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\User;

trait ActionTestUnit
{
    public function actionTestunit()
    {
        
       if(Yii::$app->user->can('admin')){
        //   $user=\common\models\User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->one();
        //   $customer=Customers::find()->where(['customers_id'=>$user['userinfo']->customers_id])->one();
        $x = Orders::find()->where(['orders_id'=>656506])->asArray()->limit('80')->orderBy('orders_id DESC')->all();
          echo '<pre>';
           print_r($x);
         //  print_r($customer);
           echo '</pre>';
       }
        return '';
    }
}