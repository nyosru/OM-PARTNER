<?php
namespace frontend\modules\adminsite\controllers\actions\cat;


use Yii;
use yii\data\ArrayDataProvider;

trait ActionConfigList
{

    public function actionConfigList()
    {

        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.','store']);
        $scandir_cat_configs = array_values($scandir_cat_configs);

        // удаляем папку для предпросмотра, чтобы не мозолил глаза
        foreach ($scandir_cat_configs as $key => $name) {
            $scandir_cat_data[$key]['url'] = stristr($name, '.', true);
            $j = json_decode(file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/' . $name), true);
            $scandir_cat_data[$key]['visible_name'] = $j['visible_name'];
        }
        $arrayDataProvider = new ArrayDataProvider([
            'allModels' => $scandir_cat_data,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('cat/config_list/index', ['arrayDataProvider' => $arrayDataProvider]);
    }

}