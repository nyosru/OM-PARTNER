<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersConfig;

trait ActionSavehtml
{
    public function actionSavehtml()
    {
        if (isset($_POST['html']) && isset($_POST['page'])) {
            $html = addslashes($_POST['html']);
            $page = addslashes($_POST['page']);
            $data = new PartnersConfig();
            $check = Yii::$app->params['constantapp']['APP_ID'];

            $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
            if ($data) {
                $data->partners_id = $check;
                $data->type = $page;
                $data->value = $html;
                $data->active = 1;
            } else {
                $data = new PartnersConfig();
                $data->partners_id = $check;
                $data->type = $page;
                $data->value = $html;
                $data->active = 1;
            }
            if ($data->save()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}