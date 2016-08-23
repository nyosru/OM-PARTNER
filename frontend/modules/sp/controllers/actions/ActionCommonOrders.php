<?php
namespace frontend\modules\sp\controllers\actions;

use Yii;


trait ActionCommonOrders
{
    public function actionCommonOrders()
    {
        return $this->render('orderscommon');
    }
}