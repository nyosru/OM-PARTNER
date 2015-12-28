<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionPayOrders
{
    public function actionPayOrders()
    {
        return $this->render('payorders');
    }
}