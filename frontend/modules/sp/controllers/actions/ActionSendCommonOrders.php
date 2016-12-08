<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\CommonOrders;
use common\models\Referrals;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\validators\DateValidator;


trait ActionSendCommonOrders
{
    public function actionSendCommonOrders()
    {
       return $this->CommonOrdersToOm();
    }
}