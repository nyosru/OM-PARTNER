<?php
namespace frontend\modules\sp\controllers\actions;

use common\forms\PartnersOrders\CommonOrderForm;
use Yii;


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
