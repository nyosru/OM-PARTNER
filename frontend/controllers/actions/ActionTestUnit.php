<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\Orders;
use common\models\OrdersToPartners;
use common\models\PartnersCategories;
use common\models\PartnersProducts;
use common\models\PartnersToRegion;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

trait ActionTestUnit
{
    public function actionTestunit()
    {
        
       if(Yii::$app->user->can('admin')){
           $x = Orders::find()->where(['orders_id'=>'638465'])->joinWith('products');

       }
        return '';
    }
}