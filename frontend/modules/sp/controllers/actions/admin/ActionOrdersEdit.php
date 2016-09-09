<?php
namespace frontend\modules\sp\controllers\actions\admin;

use Yii;


trait ActionOrdersEdit
{
    public function actionOrdersEdit()
    {
        return $this->render('ordersedit');
    }
}