<?php
namespace common\traits;

use yii;
use common\models\OrdersStatus;

trait OrdersStatusData{
    public function statusData(){
        $key='orders_status';
        if(($status=Yii::$app->cache->get($key))==false){
            $status=OrdersStatus::find()->asArray()->all();
            Yii::$app->cache->set($key,$status,86400);
        }
        return $status;
    }
}