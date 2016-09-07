<?php
namespace frontend\controllers\actions\om;


use common\models\Referrals;
use common\models\ReferralsUser;
use common\traits\Products\NewProducts;
use frontend\models\SignupForm;
use Yii;
use yii\validators\EmailValidator;

trait ActionInvite
{

    public function actionInvite()
    {
        $this->layout = 'lp';
        $model = new SignupForm();
        $model->load(Yii::$app->request->post());
        $check = FALSE;

        if(($referral_url = Yii::$app->request->getQueryParam('sp')) == FALSE){
            if(($referral_url = Yii::$app->session->get('referral')) == FALSE){
                if(($referral_url = Yii::$app->session->getCookieParams()['referral']) == FALSE){
                    \Yii::$app->getSession()->setFlash('error', 'Потерян реферал, попробуйте перейти по ссылке из письма');
                    return $this->render('sp', ['model'=>$model]);
                }
            }
        }else{
            Yii::$app->session->set('referral', $referral_url);
            Yii::$app->session->setCookieParams(['referral'=>$referral_url]);
        }

        if(
            $referral_url &&
            ($referral = Referrals::find()->where(['referral_url'=>$referral_url])->asArray()->one()) == TRUE
        ){
            $check = TRUE;
        }else{
            if(!$referral){
                \Yii::$app->getSession()->setFlash('error', 'Реферрал не существует или ссылка не корректна');
            }else{
                \Yii::$app->getSession()->setFlash('error', 'ЧО ТАМ7');
            }

        }
        if($check == TRUE && ($newuser = $model->signupOnlyEmail()) == TRUE){
            $newref = new ReferralsUser();
            $newref->user_id = $newuser->id;
            $newref->referral_id = $referral['id'];
            $newref->status = 1;
            $newref->save();
            \Yii::$app->getSession()->setFlash('success', 'Успешно отправлено');
        }
        if($model->errors){
            foreach ($model->errors as $err){
                \Yii::$app->getSession()->setFlash('error', $err);
            }
        }
        return $this->render('sp', ['model'=>$model]);
    }
}