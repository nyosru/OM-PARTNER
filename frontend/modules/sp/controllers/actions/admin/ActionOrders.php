<?php
namespace frontend\modules\sp\controllers\actions\admin;

use Yii;


trait ActionOrders
{
    public function actionOrders()
    {
        return $this->render('orders');
    }
}