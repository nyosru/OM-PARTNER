<?php
namespace common\traits;
use common\models\ManufacturersDiapazon;
use Yii;
use yii\helpers\ArrayHelper;

Trait ManufacturersDiapazonData
{
    public function manufacturers_diapazon($id)
    {
     //  $key = Yii::$app->cache->buildKey('ManDiapazon');
     //   if(($data = Yii::$app->cache->get($key))==TRUE) {
        $diapazon = new ManufacturersDiapazon();
        $List = [];
        $HTML = '';
        $diapazon = $diapazon->find()->select(['start_time','stop_time','week_day'])->where(['manufacturers_id'=>$id])->orderBy('week_day')->asArray()->all();
        if (count($diapazon)>0) {
        foreach ($diapazon as $key => $val) {
            $List[$val['week_day']] = ['start_time' => $val['start_time'], 'stop_time' => $val['stop_time']];
        }
            $wD = ['0'=>'Понедельник','1'=>'Вторник','2'=>'Среда','3'=>'Четверг','4'=>'Пятница','5'=>'Суббота','6'=>'Воскресение'];
            $HTML = '<div style="border-bottom: 1px solid rgb(204, 204, 204);"><strong style="padding: 5px; display: inline;">Данный товар доступен к оформление в указаный ниже период. Он будет находится в корзине и Вы сможете его заказать в доступное для оформления время.</strong>
		<div style="padding: 5px; display: inline; color: red;" class="close-modal"><i class="fa fa-close"></i></div></div>';
            $HTML .=  '<div class="manDiapazon">';
            for ($i=0; $i<7; $i++) {
                $HTML .=  '<div>';
                $HTML .=  '<div style="display: inline;">'.$wD[$i].': </div>';
                $hS = floor($List[$i]['start_time']/(60*60));
                $mS = floor($List[$i]['start_time']/(60)) % 60;
                $IN = sprintf('%02d', $hS).':'.sprintf('%02d', $mS);
                $HTML .=  '<div style="display: inline;">с '.(isset($List[$i]['start_time']) ? $IN : '00:00').'</div>';
                $hS = floor($List[$i]['stop_time']/(60*60));
                $mS = floor($List[$i]['stop_time']/(60)) % 60;
                $IN = sprintf('%02d', $hS).':'.sprintf('%02d', $mS);
                $HTML .= '<div style="display: inline;"> по '.(isset($List[$i]['stop_time']) ? $IN : '24:00').'</div>';
                $HTML .=  '</div>';
            }
            $HTML .=  '</div>';

        }
      //  }
        return $HTML;
    }
    public function manufacturers_diapazon_id()
    {
        $diapazon = ManufacturersDiapazon::find()->select('manufacturers_id as time')->groupBy('manufacturers_id')->asArray()->all();
        $diapazon = ArrayHelper::index($diapazon, 'time');
        return $diapazon;
    }
}

?>