<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\Referrals;
use common\models\ReferralsUser;
use frontend\models\MailToUserForm;
use Yii;


trait ActionMailToUser
{
    public function actionMailToUser()
    {
        $view = 'modals/email_to_user.php';
        if (!Yii::$app->request->post()) {
            return $this->render($view);
        }

        $referral = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        if(!$referral) {
            \Yii::$app->getSession()->setFlash('error', 'Вы не являетесь реферралом');
            return $this->render($view);
        }

        $formMailToUserForm = new MailToUserForm();
        $formMailToUserForm->load(Yii::$app->request->post());

        $user = ReferralsUser::find()
            ->joinWith('user')
            ->where(['referral_id' => $referral['id']])
            ->andWhere(['user_id' => (integer)Yii::$app->request->post('recipient_id')])
            ->limit(1)
            ->one()
        ;

        if(!$user) {
            \Yii::$app->getSession()->setFlash('error', 'Такого получателя нет');
            return $this->render($view);
        }

        $formMailToUserForm->email = $user->user->username;
        $formMailToUserForm->name = 'odezhdamaster@gmail.com';

        if (!$formMailToUserForm->validate()) {

            if ($formMailToUserForm->errors) {

                foreach ($formMailToUserForm->errors as $err) {
                    \Yii::$app->getSession()->setFlash('error', $err);
                }

                return $this->render($view);
            }
        }

        if ($formMailToUserForm->sendEmail()) {
            \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');

        } else {
            \Yii::$app->getSession()->setFlash('error', 'Произошла ошибка в отправлении');
        }


        return $this->render($view);
    }

}