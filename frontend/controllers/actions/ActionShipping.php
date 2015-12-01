<?php
namespace frontend\controllers\actions;

use Yii;


trait ActionShipping
{
    public function actionShipping()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->params['partnersset']['transport']['active']) {
            return Yii::$app->params['partnersset']['transport']['value'];
        } else {
            return ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'], 'flat7_flat7' => ['value' => 'Почта ЕМС России']];
        }
    }
}