<?php
namespace frontend\controllers\actions\om;

use yii;

trait ActionChangeCardView
{
    public function actionChangecardview()
    {
        if ($_COOKIE['cardview'] != 1) {
            setcookie("cardview", 1, time() + 2700000, '/');
        } else {
            setcookie("cardview", 0, time() + 2700000, '/');
        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}