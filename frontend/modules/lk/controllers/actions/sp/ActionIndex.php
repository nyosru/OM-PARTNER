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
        //    return $this->redirect(Yii::$app->request->referrer);
        }

        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;
        if(($customer = PartnersUsersInfo::find()->where(['id'=>$cust['id']])->one()) == FALSE){
            $customer = new PartnersUsersInfo();
        }


                    if (($user_data = Yii::$app->request->post('PartnersUsersInfo')) == TRUE) {
                        $customer->id = Yii::$app->user->getId();
                        $customer->name = $user_data['name'];
                        $customer->secondname =  $user_data['secondname'];
                        if ($user_data['secondname'] == '') {
                            $customer->secondname = 'Не указано';
                            $customer->save();
                        }
                        $customer->lastname =  $user_data['lastname'];
                        $customer->telephone = $user_data['telephone'];
                        $customer->adress =  $user_data['adress'];
                        $customer->city = $user_data['city'];
                        $customer->state = $user_data['state'];
                        $customer->country = $user_data['country'];
                        $customer->postcode = $user_data['postcode'];
                        $customer->pasportser = $user_data['pasportser'];
                        $customer->pasportnum = $user_data['pasportnum'];
                        $customer->pasportdate = $user_data['pasportdate'];
                        $customer->pasportwhere = $user_data['pasportwhere'];
                        if ($customer->save()) {
                        }else{
                        }
                    }


                    return $this->render('lksp', ['cust' => $cust, 'profile' => $customer]);
            }
}
