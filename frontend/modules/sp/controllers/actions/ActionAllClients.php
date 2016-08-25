<?php
namespace frontend\modules\sp\controllers\actions;

use Yii;


trait ActionAllClients
{
    public function actionAllClients()
    {
        return $this->render('allclients');
    }
}