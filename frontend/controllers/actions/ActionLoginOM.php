<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\LoginFormOM;

trait ActionLoginOM
{
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginFormOM();
        if ($model->load(Yii::$app->request->post()) && ($model->login() || $model->loginreferral())) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}