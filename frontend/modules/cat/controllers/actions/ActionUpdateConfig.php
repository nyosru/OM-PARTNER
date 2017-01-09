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
        $exist_cfg_name = Yii::$app->request->post('c');

        if(Yii::$app->request->post('preview_toggle') == true) {

            if($catLandConfigForm->storeOrUpdatePreviewConfig()) {
                Yii::$app->session->setFlash('success', 'Режим предпросмотра');
            } else {
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }
        } else {

            if(!$catLandConfigForm->storeOrUpdateConfig($exist_cfg_name)) {
                Yii::$app->session->setFlash('error', 'Произошла ошибка');
            }

        }

        return $this->redirect(['index','c' => $catLandConfigForm->config_name, 'preview_toggle' => Yii::$app->request->post('preview_toggle')]);
    }

}