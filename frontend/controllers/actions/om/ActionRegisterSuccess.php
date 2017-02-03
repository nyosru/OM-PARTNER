<?php

namespace frontend\controllers\actions\om;

trait ActionRegisterSuccess
{
    public function actionRegisterSuccess()
    {
        $this->layout = 'main';
        return $this->render('registersuccess');
    }
}