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
        if(Yii::$app->user->isGuest) {
            $model = new SignupForm();

            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        $ga =  Yii::$app->session->get('ga');
                        $ga[] = [
                            'event' => 'register'
                        ];
                        Yii::$app->session->set('ga', $ga);
                        return $this->goHome();
                    }
                }
            }
            return $this->render('signup', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect('/');
        }
    }
}