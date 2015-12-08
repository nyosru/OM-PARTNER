<?php
namespace frontend\controllers\actions;

use Yii;


trait ActionPaymentMethod
{
    public function actionPaymentmethod()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->params['partnersset']['paysystem']['active'] === '1') {
            return Yii::$app->params['partnersset']['paysystem']['value'];
        } else {
            return [false];
        }
    }
}