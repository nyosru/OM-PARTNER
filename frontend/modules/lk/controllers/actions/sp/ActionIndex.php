<?php
namespace frontend\modules\lk\controllers\actions\sp;

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

        if (Yii::$app->user->isGuest || ($cust = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->one()) == FALSE) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        \Yii::$app->params['modules']['lk']['menu'] = $this->actionMenu() ;
        $model = \common\models\PartnersOrders::find()->where(['user_id' => $cust['id']]);
            $sort = new yii\data\Sort([
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                        'default' => SORT_DESC,

                    ],
                ],
            ]);
                    if (Yii::$app->request->post()) {
                        $customer = new Profile();
                        $customer->load(Yii::$app->request->post());
                        $customer->scenario = 'referalsuser';
                        if (Yii::$app->request->post()['save_user']) {
                            $customer->saveUser();
                        }
                    } else {
                        $customer = new Profile();
                        $customer->scenario = 'referalsuser';
                    }
                    $customer->loadUserProfile();
                    $customer->scenario = 'referalsuser';
                    return $this->render('lksp', ['cust' => $cust, 'profile' => $customer]);
            }
}
