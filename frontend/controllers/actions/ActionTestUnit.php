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
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\User;

trait ActionTestUnit
{
    public function actionTestunit()
    {
        
       if(Yii::$app->user->can('admin')){
           
           print_r($this->oksuppliers());
        //   $user=\common\models\User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->one();
        //   $customer=Customers::find()->where(['customers_id'=>$user['userinfo']->customers_id])->one();
        //$x = Orders::find()->where(['orders_id'=>656506])->asArray()->limit('80')->orderBy('orders_id DESC')->all();
          // Yii::$app->db->enableSlaves = FALSE;
        //  Yii::$app->db->enableSlaves = FALSE;
         //  Yii::$app->db->enableSlaves = FALSE;
//           $time_start = microtime(true);
//           $con=mysqli_connect("10.0.0.66","newodezhda","zuAmok23sa1","odezhda");
//
//// Check connection
//           if (mysqli_connect_errno())
//           {
//               echo "Failed to connect to MySQL: " . mysqli_connect_error();
//           }
//
//// Check if server is alive
//           if (mysqli_ping($con))
//           {
//               echo "Connection is ok!";
//           }
//           else
//           {
//               echo "Error: ". mysqli_error($con);
//           }
//
//           mysqli_close($con);
//           $time_end = microtime(true);
//           $time = $time_end - $time_start;
           $prod = PartnersProducts::find()->where(['products_id'=>'1670987'])->asArray()->one();

           $x = new Query();
           $x =  $x->select('*')->from('INFORMATION_SCHEMA.PROCESSLIST')->createCommand()->queryAll();
           Yii::$app->db->enableSlaves = FALSE;
           $y = new Query();
          $y =  $y->select('*')->from('INFORMATION_SCHEMA.PROCESSLIST')->createCommand()->queryAll();
          echo '<pre>';
           echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
           print_r($x);
           echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
           print_r($y);
         //  print_r($customer);
           echo '</pre>';
       }
        return '';
    }
}