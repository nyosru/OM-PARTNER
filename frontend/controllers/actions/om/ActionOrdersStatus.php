<?php
namespace frontend\controllers\actions\om;

use yii;
use common\traits\OrdersStatusData;

trait ActionOrdersStatus
{
    public function actionOrdersStatus()
    {
        if (Yii::$app->request->post('status')) {
            return $this->statusData();
        }
    }
}