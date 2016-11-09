<?php
namespace frontend\modules\sp\controllers\actions\admin;

use Yii;


trait ActionMailToUser
{
    public function actionMailToUser()
    {
        return $this->render('index');
    }
}