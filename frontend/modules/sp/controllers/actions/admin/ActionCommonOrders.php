<?php
namespace frontend\modules\sp\controllers\actions\admin;

use Yii;


trait ActionCommonOrders
{
    public function actionCommonOrders()
    {
        return $this->render('orderscommon');
    }
}