<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\Orders;
use common\models\OrdersStatus;
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
        $x = Customers::find()->where(['customers_email_address'=>'Nusha7688@gmail.com'])->asArray()->all();
          echo '<pre>';
           print_r($x);
         //  print_r($customer);
           echo '</pre>';
       }
        return '';
    }
}