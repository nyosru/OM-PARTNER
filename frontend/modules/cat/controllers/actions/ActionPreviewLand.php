<?php
namespace frontend\modules\cat\controllers\actions;

use Yii;
use \common\forms\Cat\CatLandConfigForm;

trait ActionPreviewLand
{

    public function actionPreviewLand()
    {
        if (!Yii::$app->request->isPost) {
            $this->redirect(Yii::$app->request->referrer);
        }

        $catLandConfigForm = new CatLandConfigForm();
        $catLandConfigForm->load(Yii::$app->request->post());

        if($catLandConfigForm->storeOrUpdateConfig()) {
            Yii::$app->session->setFlash('success', 'Удача! Лендинг изменен');
        } else {
            Yii::$app->session->setFlash('error', 'Произошла ошибка');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

}