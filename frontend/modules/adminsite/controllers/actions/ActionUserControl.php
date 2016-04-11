<?php
namespace frontend\modules\adminsite\controllers\actions;

use common\models\User;
use frontend\models\MailToUserForm;
use Yii;
use yii\helpers\BaseStringHelper;
use yii\helpers\Html;

trait ActionUserControl
{
    public function actionUsercontrol()
    {
        if (($post = Yii::$app->request->post()) == TRUE) {
            if (isset($post['percent'])) {
                $id = (integer)$post['id'];
                $user = User::findOne(['id' => $id, 'id_partners' => Yii::$app->params['constantapp']['APP_ID']]);
                $user->active_discount = (integer)$post['group'];
                $user->save();
                return $this->redirect(Yii::$app->request->referrer);
            } else if (isset($post['mailtouser'])) {
                $mailtouser = new MailToUserForm();
                $mailtouser->load($post);
                $mailtouser->sendEmail();
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return $this->goBack();
            }

        }
        return $this->redirect(Yii::$app->request->referrer);
    }
}