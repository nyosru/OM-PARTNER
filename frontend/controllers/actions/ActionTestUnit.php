<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\PartnersCategories;
use common\models\PartnersProducts;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

trait ActionTestUnit
{
    public function actionTestunit()
    {
       if(Yii::$app->user->can('admin')){
           $manid = 3418;
       //  $x =  PartnersProducts::find()->where(['products_id'=>[1451992,1451993]])->all();

//           $thisweeekday = date('N')-1;
//           $timstamp_now = (integer)mktime(date('H'),date('i'), date('s'), 1, 1, 1970);
//           if(array_key_exists($id,$man) && $man[$id][$thisweeekday]){
//               $stop_time = (int)$man[$id][$thisweeekday]['stop_time'];
//               $start_time = (int)$man[$id][$thisweeekday]['start_time'];
//
//               if(isset($start_time) && isset($stop_time) && ($start_time <= $timstamp_now) && ($timstamp_now <= $stop_time)){
//                   return ['answer'=>true];
//               }else{
//                   return ['answer'=>false];
//               }
//           }else{
//               return ['answer'=>true];
//           }
//
//
//
//
//           $man = $this->manufacturers_diapazon_id();
//           $thisweeekday = date('N')-1;
//           $timstamp_now = (integer)mktime(date('H'),date('i'), date('s'), 1, 1, 1970);
//           if(array_key_exists($manid,$man) && $man[$manid][$thisweeekday]){
//               $stop_time = (int)$man[$manid][$thisweeekday]['stop_time'];
//               $start_time = (int)$man[$manid][$thisweeekday]['start_time'];
//               if(isset($start_time) && isset($stop_time) && ($start_time <= $timstamp_now) && ($timstamp_now <= $stop_time)){
//                   $validprice += ((float)$valuerequest['products_price']*(int)$quant[$valuerequest['products_id']]);
//                   $origprod[$valuerequest['products_id']] = $valuerequest;
//               }else{
//                   unset($proddata[$keyrequest]);
//                   $related[]=$valuerequest;
//               }
//           }else{
//               echo 'no set';
//               $validprice += ((float)$valuerequest['products_price']*(int)$quant[$valuerequest['products_id']]);
//               $origprod[$valuerequest['products_id']] = $valuerequest;
//           }
           $timstamp_now = (integer)mktime(date('H'),date('i'), date('s'), 1, 1, 1970);
           echo '<pre>';
           date_default_timezone_set('Europe/Moscow');
         //  echo  $thisweeekday = date('N')-1;
           print_r($timstamp_now);

           echo '</pre>';

       }
        return '';
    }
}