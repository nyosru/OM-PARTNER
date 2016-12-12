<?php
namespace frontend\controllers\actions;

use Yii;
use yii\web\Response;

trait ActionSuppliersLux
{
    public function actionSuppliersLux()
    {
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $data = $this->LuxSuppliers();
            return $data;
        }
        return false;
    }

}