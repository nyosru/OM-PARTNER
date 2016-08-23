<?php
namespace frontend\modules\sp\controllers\actions;

use Yii;


trait ActionOrdersEdit
{
    public function actionOrdersEdit()
    {
        return $this->render('ordersedit');
    }
}