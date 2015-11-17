<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionPaying
{
    public function actionPaying()
    {
        return $this->render('paying');
    }
}