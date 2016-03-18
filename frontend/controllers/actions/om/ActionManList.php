<?php
namespace frontend\controllers\actions\om;

use common\models\Customers;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\User;
use common\models\Orders;
use yii;


trait ActionManList
{
    public function actionManlist()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        date_default_timezone_set('Europe/Moscow');
        $id = (integer)Yii::$app->request->post('data');
        $man = $this->manufacturers_diapazon_id();
            $thisweeekday = date('N')-1;
            $timstamp_now = (integer)mktime(date('H'),date('i'), date('s'), 1, 1, 1970);
            if(array_key_exists($id,$man) && $man[$id][$thisweeekday]){
                $stop_time = (int)$man[$id][$thisweeekday]['stop_time'];
                $start_time = (int)$man[$id][$thisweeekday]['start_time'];

                if(isset($start_time) && isset($stop_time) && ($start_time <= $timstamp_now) && ($timstamp_now <= $stop_time)){
                  return ['answer'=>true];
                }else{
                    return ['answer'=>false];
                }
            }else{
                return ['answer'=>true];
            }
        }


}