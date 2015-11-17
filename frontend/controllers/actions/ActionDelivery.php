<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionDelivery
{
    public function actionDelivery()
    {
        return $this->render('delivery');
    }
}