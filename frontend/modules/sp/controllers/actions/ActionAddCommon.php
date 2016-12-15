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

        if ($newCommonOrderForm->createCommonOrder()) {

            \Yii::$app->getSession()->setFlash('success', 'Новый объединенный заказ создан');
        } else {

            \Yii::$app->getSession()->setFlash('error', 'Произошла ошибка, объединенный заказ не был создан');
        }

        return $this->render('modals/add_new_commonorder.php');
    }
}
