<?php
namespace frontend\controllers\actions\om;

use common\models\SignupFormOM;
use Yii;


trait ActionSignup
{
    public function actionSignup()
    {
        $model = new SignupFormOM();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}