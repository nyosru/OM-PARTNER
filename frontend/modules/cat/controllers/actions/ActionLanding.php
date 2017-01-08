<?php
namespace frontend\modules\cat\controllers\actions;

use Yii;

trait ActionLanding
{

    public function actionLanding()
    {
        $header_tpl = Yii::$app->request->get('h');
        $content_tpl = Yii::$app->request->get('c');
        $footer_tpl = Yii::$app->request->get('f');

        if(!$header_tpl || !$content_tpl || !$footer_tpl) {
            echo 'ошибка';
            return;
        }

        $j = file_get_contents(Yii::getAlias('@frontend') . '/runtime/cat/config.json');
        $land_config = (array)json_decode($j, true);

        if(!empty($land_config) && count($land_config) > 0) {
            $land_config['header_tpl'] = $header_tpl;
            $land_config['content_tpl'] = $content_tpl;
            $land_config['footer_tpl'] = $footer_tpl;
        }

        return $this->render('landing', ['land_config' => $land_config]);
    }

}