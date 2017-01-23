<?php
namespace frontend\modules\adminsite\controllers\actions\cat;


use Yii;
use yii\data\ArrayDataProvider;

trait ActionConfigList
{

    public function actionConfigList()
    {

        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.']);
        $scandir_cat_configs = array_values($scandir_cat_configs);

        foreach ($scandir_cat_configs as $key => $name) {
            $scandir_cat_configs[$key] = stristr($name, '.', true);
        }

        $arrayDataProvider = new ArrayDataProvider([
            'allModels' => $scandir_cat_configs,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('cat/config_list/index', ['arrayDataProvider' => $arrayDataProvider]);
    }

}