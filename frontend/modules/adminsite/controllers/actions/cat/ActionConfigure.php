<?php
namespace frontend\modules\adminsite\controllers\actions\cat;

use common\forms\Cat\CatLandConfigForm;
use common\models\Referrals;
use Yii;

trait ActionConfigure
{

    public function actionConfigure()
    {
        $this->layout = 'cat_configure';
        $preview_toggle = Yii::$app->request->get('preview_toggle');
        $config_name = Yii::$app->request->get('c');

        $j = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/' . $config_name . '.json');

        if ($preview_toggle) {
            $j_prev = Yii::$app->cache->get('preview_config' . $config_name);
            if ($j_prev) {
                $j = $j_prev;
            }
        }

        $land_config = [];
        if (isset($j) && $j) {
            $land_config = (array)json_decode($j, true);
        }
        $special_offer = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/store/special_offer' . '.json');
        $special_offer = (array)json_decode($special_offer, true);
        if (count($special_offer) == 0) {
            $special_offer = [];
        }

        $model = new CatLandConfigForm();

        if (!empty($land_config) && count($land_config) > 0) {
            $model = new CatLandConfigForm([
                'config_name'           => $config_name,
                'header_tpl'            => $land_config['header_tpl'],
                'header_title'          => $land_config['header_config']['header_title'],
                'banners_tpl'           => $land_config['header_config']['banner_config']['template'],
                'images_cfg'            => json_encode($land_config['header_config']['banner_config']['images']),
                'content_tpl'           => $land_config['content_tpl'],
                'content_list_products' => $land_config['content_config']['content_list_products'],
                'special_offer'         => $land_config['content_config']['special_offer'],
                'footer_tpl'            => $land_config['footer_tpl'],
            ]);
        }

        return $this->render('cat/configure/index',
            ['model' => $model, 'land_config' => $land_config, 'special_offer' => $special_offer]);
    }

}