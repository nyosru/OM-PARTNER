<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\PartnersUserInfoForm;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;

trait ActionEditUserInfo
{
    public function actionEditUserInfo($id)
    {
        $referal = Referrals::find()->where(['user_id' => Yii::$app->user->getId()])->asArray()->one();

        $query_user = ReferralsUser::find()
            ->joinWith('user')
            ->joinWith('userinfo')
            ->where(['referral_id' => $referal['id']])
            ->andWhere(['user_id' => $id])
            ->limit(1)
            ->groupBy('user_id')
            ->one();

        if(!$query_user) {
            Yii::$app->session->setFlash('error', 'Этого пользователя нельзя редактировать');
            return $this->redirect(Yii::$app->request->referrer);
        }

        $model_form_partners_user_info = PartnersUserInfoForm::findOne($id);

        if(empty($model_form_partners_user_info)) {
            $model_form_partners_user_info = new PartnersUserInfoForm();
        }

        if ($model_form_partners_user_info->load(Yii::$app->request->post())) {

            if ($model_form_partners_user_info->save()) {
                Yii::$app->session->setFlash('success', 'Данные приняты');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}