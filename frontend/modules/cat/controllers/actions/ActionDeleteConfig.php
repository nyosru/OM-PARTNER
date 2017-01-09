<?php
namespace frontend\modules\cat\controllers\actions;

use common\forms\Cat\CatLandConfigForm;
use Yii;

trait ActionDeleteConfig
{

    public function actionDeleteConfig()
    {
        $config_name = Yii::$app->request->get('c');
        $config_file_extension = '.json';
        $config_name .= $config_file_extension;

        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.']);
        $scandir_cat_configs = array_values($scandir_cat_configs);

        if (in_array($config_name, $scandir_cat_configs)) {
            if (unlink(\Yii::getAlias('@runtime') . '/cat/'.$config_name)) {
                Yii::$app->session->setFlash('success', 'Конфигурационный файл удален');
            } else {
                Yii::$app->session->setFlash('success', 'Произошла ошибка');
            }

            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->session->setFlash('success', 'Такого файла нет');

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}