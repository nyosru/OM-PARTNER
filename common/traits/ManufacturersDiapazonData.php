<?php
namespace common\traits;

use common\models\ManufacturersDiapazon;
use Yii;
use yii\helpers\ArrayHelper;

Trait ManufacturersDiapazonData
{
    public function manufacturers_diapazon($id)
    {
        $keys = Yii::$app->cache->buildKey('ManDiapazon2-' . $id);
        if (($data = Yii::$app->cache->get($keys)) == FALSE) {
            $diapazon = new ManufacturersDiapazon();
            $List = [];
            $HTML = '';
            $diapazon = $diapazon->find()->select(['start_time', 'stop_time', 'week_day'])->where(['manufacturers_id' => $id])->orderBy('week_day')->asArray()->all();
            if (count($diapazon) > 0) {
                foreach ($diapazon as $key => $val) {
                    $List[$val['week_day']] = ['start_time' => $val['start_time'], 'stop_time' => $val['stop_time']];
                }
                $wD = ['0' => 'Понедельник', '1' => 'Вторник', '2' => 'Среда', '3' => 'Четверг', '4' => 'Пятница', '5' => 'Суббота', '6' => 'Воскресение'];
                $HTML = '<div><strong style="display: inline;">Данный товар доступен к оформление в указаный ниже период. Он будет находится в корзине и Вы сможете его заказать в доступное для оформления время.</strong><div class="close-modal" style="display: inline; color: red; padding: 5px;"><i class="fa fa-close"></i></div>
		</div>';
                $HTML .= '<div class="manDiapazon">';
                $emptyDays = 0;
                for ($i = 0; $i < 7; $i++) {
                    $List[$i]['start_time'] = (isset($List[$i]['start_time']) ? $List[$i]['start_time'] : '0');
                    $List[$i]['stop_time'] = (isset($List[$i]['stop_time']) ? $List[$i]['stop_time'] : round(24 * 60 * 60));

                    $ret = '<div>';
                    $ret .= '<div style="display: inline;">' . $wD[$i] . ': </div>';
                    if ($List[$i]['start_time'] == $List[$i]['stop_time']) {
                        $emptyDays++;
                        $ret .= '<div style="display: inline;">заказы </div>';
                        $ret .= '<div style="display: inline;">не принимаются</div>';
                    } elseif ($List[$i]['start_time'] == 0 && $List[$i]['stop_time'] == round(24 * 60 * 60)) {
                        $ret .= '<div style="display: inline;">без </div>';
                        $ret .= '<div style="display: inline;">перерыва</div>';
                    } else {
                        $ret .= '<div style="display: inline;"> с ' . $this->sec2hmTime($List[$i]['start_time']) . '</div>';
                        $ret .= '<div style="display: inline;"> по ' . $this->sec2hmTime($List[$i]['stop_time']) . '</div>';
                    }
                    $ret .= '</div>';
                    $HTML .= $ret;
                }
                $HTML .= '</div>';
                if ($emptyDays !== 7) {
                    $data = $HTML;
                    Yii::$app->cache->set($keys, $HTML, 7200);
                    return $data;
                } else {
                    $data = '<div><span style="color: red"><strong>Данный товар не доступен для заказа . Приносим свои извинения за временные неудобства!</strong></span><div>';
                    Yii::$app->cache->set($keys, $data, 7200);
                    return $data;
                }
            }
        } else {

            return $data;
        }

    }

    public function manufacturers_diapazon_id()
    {
        $keys = Yii::$app->cache->buildKey('ManDiapazonAll');
        if (($data = Yii::$app->cache->get($keys)) == FALSE) {
            $diapazon = ManufacturersDiapazon::find()->select('manufacturers_id as time, week_day, start_time, stop_time')->asArray()->all();
            foreach ($diapazon as $key => $value) {
                $diapazons[$value['time']][$value['week_day']]['start_time'] = $value['start_time'];
                $diapazons[$value['time']][$value['week_day']]['stop_time'] = $value['stop_time'];
                $diapazons[$value['time']]['time'] = $value['time'];
            }


            Yii::$app->cache->set($keys, $diapazons, 7200);
            return $diapazons;

        } else {
            return $data;
        }
    }

    public function sec2hmTime($time)
    {
        $h = floor($time / (60 * 60));
        $m = floor($time / (60)) % 60;
        return sprintf('%02d', $h) . ':' . sprintf('%02d', $m);
    }
}

?>