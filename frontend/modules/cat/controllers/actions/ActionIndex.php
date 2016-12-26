<?php
namespace frontend\modules\cat\controllers\actions;

use common\forms\Cat\CatLandConfigForm;
use Yii;

trait ActionIndex
{

    public function actionIndex()
    {
        $j = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/config.json');
        $land_config = (array)json_decode($j, true);

        $model = new CatLandConfigForm();

        if(!empty($land_config) && count($land_config) > 0) {
            $model = new CatLandConfigForm([
                'header_tpl'            => $land_config['header_tpl'],
                'header_title'          => $land_config['header_config']['header_title'],
                'content_tpl'           => $land_config['content_tpl'],
                'content_list_products' => $land_config['content_config']['content_list_products'],
                'special_offer'         => $land_config['content_config']['special_offer'],
                'footer_tpl'            => $land_config['footer_tpl'],
            ]);
        }

        return $this->render('index', ['model' => $model, 'land_config' => $land_config]);
    }

}