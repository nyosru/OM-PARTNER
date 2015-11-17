<?php
namespace frontend\controllers\actions;

use Yii;

trait ActionContacts
{
    public function actionContacts()
    {

        return $this->render('contacts');
    }
}