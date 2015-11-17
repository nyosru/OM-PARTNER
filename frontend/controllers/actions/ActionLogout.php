<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionLogout
{
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}