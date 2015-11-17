<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersUsersInfo;

trait ActionShippingfields
{
    public function actionShippingfields($id)
    {
        $model = new PartnersUsersInfo();
        $result = $model->getScenario($id);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }
}