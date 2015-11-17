<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionAbout
{
    public function actionAbout()
    {
        return $this->render('about');
    }
}