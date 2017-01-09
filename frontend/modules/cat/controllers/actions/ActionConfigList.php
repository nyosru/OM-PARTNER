<?php
namespace frontend\modules\cat\controllers\actions;

use Yii;
use yii\data\ArrayDataProvider;

trait ActionConfigList
{

    public function actionConfigList()
    {

        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.']);
        $scandir_cat_configs = array_values($scandir_cat_configs);

        // удаляем файл для предпросмотра, чтобы не мозолил глаза
        $preview_key = array_search('preview_config.json', $scandir_cat_configs);
        unset($scandir_cat_configs[$preview_key]);

        foreach ($scandir_cat_configs as $key => $name) {
            $scandir_cat_configs[$key] = stristr($name, '.', true);
        }

        $arrayDataProvider = new ArrayDataProvider([
            'allModels' => $scandir_cat_configs,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('config_list/index', ['arrayDataProvider' => $arrayDataProvider]);
    }

}