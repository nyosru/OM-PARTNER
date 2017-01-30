<?php
namespace frontend\modules\cat\controllers\actions;

use Yii;

trait ActionLanding
{

    public function actionLanding()
    {
        $this->layout = 'main_land';
        $config_file_name = Yii::$app->request->get('c');
        $scandir_cat_configs = array_diff(scandir(\Yii::getAlias('@runtime') . '/cat/'), ['..', '.']);

        if(!$config_file_name) {
            throw new \yii\web\NotFoundHttpException(404);
        }

        $config_file_extension = '.json';
        if(in_array($config_file_name . $config_file_extension, $scandir_cat_configs)) {

            $j = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/'.$config_file_name.$config_file_extension);
            $land_config = (array)json_decode($j, true);
        } else {
            throw new \yii\web\NotFoundHttpException(404);
        }
        return $this->render('landing', ['land_config' => $land_config]);
    }

}