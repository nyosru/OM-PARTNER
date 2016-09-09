<?php
namespace frontend\modules\sp\controllers\actions\admin;

use Yii;


trait ActionIndex
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}