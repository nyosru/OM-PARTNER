<?php
namespace frontend\modules\adminsite\controllers\actions\cat;

use common\forms\Cat\CatLandConfigForm;
use Yii;

trait ActionCopyConfig
{
    public function actionCopyConfig()
    {
        $config_name = Yii::$app->request->get('c');
        $config_file_extension = '.json';
        $config_name .= $config_file_extension;

        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.', 'store']);
        $scandir_cat_configs = array_values($scandir_cat_configs);

        if (in_array($config_name, $scandir_cat_configs)) {
            $is = 0;
            $name = stristr($config_name, '.', true);
            $newconfig = $name.'-copy';
            while(file_exists(\Yii::getAlias('@runtime') . '/cat/'.$newconfig.$is.'.json') && $is < 1000){
               $is++;
            }
            if($is >= 1000){
                Yii::$app->session->setFlash('success', 'Превышен лимит автоматических копий');
                return $this->redirect(Yii::$app->request->referrer);
            }
            $path = \Yii::getAlias('@runtime') . '/cat/';
            if (!copy($path.$config_name, $path.$newconfig.$is.'.json')) {
                Yii::$app->session->setFlash('success', 'Не удалось скопировать');
            }else{
                Yii::$app->session->setFlash('success', 'Файл скопирован');
            }
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->session->setFlash('success', 'Такого файла нет');

            return $this->redirect(Yii::$app->request->referrer);
        }
    }

}