<?php
namespace frontend\modules\sp\controllers\actions;

use common\forms\PartnersOrders\CommonOrderForm;
use common\models\CommonOrders;
use common\models\PartnersOrders;
use common\models\Referrals;
use common\models\ReferralsUser;
use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\data\Sort;
use yii\validators\DateValidator;
use yii\web\HttpException;


trait ActionAddCommon
{
    public function actionAddCommon()
    {

        if (!Yii::$app->request->post()) {
            return false;
        }

        $newCommonOrderForm = new CommonOrderForm();
        $newCommonOrderForm->load(Yii::$app->request->post());

        return $newCommonOrderForm->createCommonOrder();
    }
}
