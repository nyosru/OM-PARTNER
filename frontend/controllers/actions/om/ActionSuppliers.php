<?php

namespace frontend\controllers\actions\om;

use yii;
use common\traits\GetSuppliers;

trait ActionSuppliers{
    public function actionSuppliers(){
        if(Yii::$app->request->post('suppliers')){
            return $this->oksuppliers();
        }
    }
}