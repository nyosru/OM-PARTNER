<?php
namespace frontend\controllers\actions;

use common\models\ReferralsUser;
use Yii;
use common\models\PartnersOrders;
use common\models\PartnersUsersInfo;
use common\models\AddressBook;
use common\models\Countries;
use common\models\Zones;
use common\models\User;

trait ActionSaveorder
{
    public function actionSaveorder()
    {

        if(ReferralsUser::find()->where(['user_id'=>(Yii::$app->getUser()->getId())])->exists()){
            $this->OrdersToReferrer();
        }else{
            $this->ordersToOm();
        }
    }
}