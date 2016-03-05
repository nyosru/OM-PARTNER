<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\Partners;
use common\models\User;
use Yii;
use frontend\models\SignupForm;

trait ActionSignup
{
    public function actionSignup()
    {
        $model = new SignupForm();

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