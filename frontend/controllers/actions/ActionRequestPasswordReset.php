<?php
namespace frontend\controllers\actions;

use Yii;
use frontend\models\PasswordResetRequestForm;

trait ActionRequestPasswordReset
{
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            \Yii::$app->params['params']['products_mail'] =  $this->NewProducts(6,'mail_new-34', 7200);
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'На ваш электронный адрес было отправлено письмо. Следуйте инструкциям в нем.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Восстановление пароля временно не работает.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
}