<?php
namespace frontend\modules\sp\controllers\actions;

use Yii;


trait ActionMailToUser
{
    public function actionMailToUser()
    {
        return $this->render('index');
    }
}