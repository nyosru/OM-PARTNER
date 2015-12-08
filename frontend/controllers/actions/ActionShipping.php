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
            return ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция', 'active' => '1', 'wantpasport' => '0'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии', 'active' => '1', 'wantpasport' => '1'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК', 'active' => '1', 'wantpasport' => '0'], 'flat7_flat7' => ['value' => 'Почта ЕМС России', 'active' => '1', 'wantpasport' => '0']];
        }
    }
}