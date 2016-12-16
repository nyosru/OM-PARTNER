<?php
namespace frontend\modules\lk\controllers\actions\sp;

use common\models\PartnersUserInfoForm;
use common\models\PartnersUsersInfo;
use common\models\Profile;
use common\models\Referrals;
use common\models\ReferralsUser;
use common\models\User;
use common\models\Orders;
use yii;


trait ActionIndex
{
    public function actionIndex()
    {

        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->one()) == FALSE) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;
        if(($customer = PartnersUsersInfo::find()->where(['id'=>$cust['id']])->one()) == FALSE){
            $customer = new PartnersUsersInfo();
        }
                    if (Yii::$app->request->post()) {
                        $customer->load(Yii::$app->request->post());
                        $customer->id = $cust['id'];
                        $customer->validate();
                        $customer->save();
                    }

                    return $this->render('lksp', ['cust' => $cust, 'profile' => $customer]);
            }
}
