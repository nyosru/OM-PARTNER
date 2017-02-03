<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionSetPercent
{
    public function actionSetPercent()
    {
        if(($percent = (integer)Yii::$app->request->post('percent')) == TRUE && $percent >= 0 && $percent <= 50){
            $referal = Referrals::find()->where(['user_id'=>Yii::$app->user->id])->one();
            $referal->percent = $percent;
            if($referal->save()){
                return 'Значение сохранено';
            }else{
                return 'Не удалось задать значение';
            }

        }else{
            return 'Значение должно быть от 0до 50';
        }
    }
}