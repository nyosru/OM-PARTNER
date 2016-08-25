<?php
namespace frontend\modules\sp\controllers\actions;

use Yii;


trait ActionIndex
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}