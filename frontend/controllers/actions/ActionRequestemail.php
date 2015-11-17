<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionRequestemail
{
    public function actionRequestemail()
    {
        return Yii::$app->user->identity->username;
    }
}