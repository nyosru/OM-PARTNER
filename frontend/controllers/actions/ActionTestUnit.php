<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\LastPartnersIds;
use common\models\Orders;
use common\models\OrdersReports;
use common\models\OrdersReportsOrders;
use common\models\OrdersToPartners;
use common\models\OrdersTotal;
use common\models\PartnersCategories;
use common\models\PartnersProducts;
use common\models\PartnersToRegion;
use frontend\widgets\SeasonPicture;
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

           // print_r($this->oksuppliers());
            //   $user=\common\models\User::find()->where(['partners_users.id'=>Yii::$app->user->getId()])->joinWith('userinfo')->one();
            //   $customer=Customers::find()->where(['customers_id'=>$user['userinfo']->customers_id])->one();
            //$x = Orders::find()->where(['orders_id'=>739825])->asArray()->limit('80')->orderBy('orders_id DESC')->all();
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
           // $orders = OrdersTotal::find()->where(['orders_id'=>731364])->asArray()->all();
          //  $order = OrdersToPartners::find()->where(['partner_id'=>'15'])->asArray()->all();


         //   $cat = 1781;

          //  $key = Yii::$app->cache->buildKey('chpus-api-key-' . $cat);
          //  if (($chpu = Yii::$app->cache->get($key)) == TRUE) {
//
          //  } else {
//                $catdataarr = $this->categories_for_partners();
//                $catdata = $catdataarr[0];
//                $categories = $catdataarr[1];
//                foreach ($categories as $value) {
//                    $catnamearr[$value['categories_id']] = $value['categories_name'];
//                }
//                foreach ($catdata as $value) {
//                    $catdatas[$value['categories_id']] = $value['parent_id'];
//                }
                // Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
          //      $chpu = $this->Requrscat($catdatas, $cat, $catnamearr);
          //      Yii::$app->cache->set($key, $chpu, 3600);
         //   }

//            echo SeasonPicture::widget([
//                'season'=>'Весна-Осеньзима лето'
//            ]);

         //   $x = PartnersProducts::find()->where(['products_id'=>1807212])->asArray()->one();
          //  $x = new Query();
           // $x =  $x->select('*')->from('INFORMATION_SCHEMA.PROCESSLIST')->createCommand()->queryAll();


            $stat_set = Yii::$app->cache->buildKey('statistics_bd');
            $stat_codes = Yii::$app->cache->get($stat_set);
            $s = $stat_codes;
            $l = 0;
            foreach ($stat_codes as $key=>$value){
                $url_set_key = Yii::$app->cache->buildKey($value['seed']);
                $url_set = Yii::$app->cache->get($url_set_key);
                $sour[$value['sources']][] = $value['seed'];
                echo '<pre>';
               // print_r($value);
                if(count($url_set) > 1){
                    $l += count($url_set);
                    if($value['sources'] !== 'none'){
                        $check_cart = TRUE;
                    }
                    $check_sources = FALSE;
                    foreach ($url_set as $url_set_key=>$url_set_value){
                        if(isset($url_set_value['sources'])){
                            $check_sources = TRUE;
                            $sour[$url_set_value['sources']][] = $value['seed'];
                        }
                    }
                 //   print_r($url_set);
                }else{
                    $datetime1 = new \DateTime(date('Y-m-d H:i:s'));
                    $datetime2 = new \DateTime($value['time']);
                    $interval = $datetime1->diff($datetime2);
                    if($interval->format('%a') > 1){
                        Yii::$app->cache->delete($url_set_key);
                        unset($s[$key]);
                        Yii::$app->cache->set($stat_set,$s);
                    }
                }
                echo '</pre>';
            }

            echo 'Сидов: '.count($s).' Записей:' .$l. ' Источников: '. count($sour);
            echo '<pre>';

            Yii::$app->db->enableSlaves = FALSE;
          //  $y = new Query();
             echo '<pre>';
          //  print_r($this->Catpath($_GET['id']));
        //    print_r($this->categoryChpu($_GET['id']));
                echo '</pre>';
           // $y =  $y->select('*')->from('INFORMATION_SCHEMA.PROCESSLIST')->createCommand()->queryAll();
            echo '<pre>';
            echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
         //   print_r($x);
            //print_r($result);
            echo '+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++'.PHP_EOL;
         //   print_r($y);
         //   print_r($order);
            echo '</pre>';
        }
        return '';
    }
}