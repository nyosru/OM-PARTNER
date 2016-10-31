<?php
namespace frontend\controllers\actions\om;

use common\models\SignupFormOM;
use Yii;


trait ActionSignup
{
    public function actionSignup()
    {
        if(Yii::$app->user->isGuest) {
            $model = new SignupFormOM();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validuser()) {
                    if ($model->validcountryregion()) {

                        if ($user = $model->signup()) {
                            if (Yii::$app->getUser()->login($user)) {
                                $ga =  Yii::$app->session->get('ga');
                                $ga[] = [
                                    'event' => 'register'
                                ];
                                Yii::$app->session->set('ga', $ga);
                                return  $this->redirect('/register-success');
                            }
                        } else {
                            return $this->render('signup', ['model' => $model]);
                        }
                    } else {
                        return $this->render('signup', ['model' => $model]);
                    }
                } else {
                    return $this->render('signup', ['model' => $model]);
                }
            }
            return $this->render('signup', ['model' => $model]);
        }else{
            return $this->redirect('/');
        }
    }

}