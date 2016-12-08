<?php
namespace frontend\controllers\actions\om;

use Yii;
use yii\web\Response;

trait ActionSuppliersOk
{
    public function actionSuppliersOk()
    {
        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $data = $this->OkSuppliers();
            return $data;
        }
        return false;
    }

}