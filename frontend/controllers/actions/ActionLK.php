<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionLK
{
    public function actionLk()
    {
        $this->layout = 'lk';
        return $this->render('lk');
    }
}