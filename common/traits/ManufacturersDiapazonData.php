<?php
namespace common\traits;
use common\models\ManufacturersDiapazon;
use Yii;
use yii\helpers\ArrayHelper;

Trait ManufacturersDiapazonData
{
    public function manufacturers_diapazon()
    {
     //  $key = Yii::$app->cache->buildKey('ManDiapazon');
     //   if(($data = Yii::$app->cache->get($key))==TRUE) {
            $diapazon = new ManufacturersDiapazon();
           $diapazon = $diapazon->find()->asArray()->all();
           foreach($diapazon as $key => $value){
               $data['data'][$value['manufacturers_id']][$value['week_day']]['start'] = $value['start_time'];
                   $data['data'][$value['manufacturers_id']][$value['week_day']]['stop'] = $value['stop_time'];
           }
      //  }
        return $data['data'];
    }
}

?>