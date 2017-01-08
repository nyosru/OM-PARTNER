<?php
namespace frontend\modules\cat\controllers\actions;

use Yii;
use \common\forms\Cat\CatLandConfigForm;

trait ActionUpdateConfig
{

    public function actionUpdateConfig()
    {
        if (!Yii::$app->request->isPost) {
            $this->redirect(Yii::$app->request->referrer);
        }

        $catLandConfigForm = new CatLandConfigForm();
        $catLandConfigForm->load(Yii::$app->request->post());

        if(Yii::$app->request->post('preview_toggle') == true) {

            if($catLandConfigForm->storeOrUpdatePreviewConfig()) {
                Yii::$app->session->setFlash('success', 'Режим предпросмотра');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }
        } else {

            if($catLandConfigForm->storeOrUpdateConfig()) {
                Yii::$app->session->setFlash('success', 'Удача! Лендинг изменен');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }

        }

        return $this->redirect(['index', 'preview_toggle' => Yii::$app->request->post('preview_toggle')]);
    }

}