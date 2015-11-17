<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\Zones;

trait ActionZonesrequest
{
    public function actionZonesrequest($id)
    {

        $data = Yii::$app->cache->get(urlencode('zones_data-' . $id));
        if ($data === false) {
            $zones_data = new Zones();
            $data = $zones_data->find()->select('zone_id as id, zone_name as title')->where(['zone_country_id' => intval($id)])->asArray()->all();
            Yii::$app->cache->set(urlencode('zones_data-' . $id), ['zones_data' => $data], 86400);
        } else {
            $data = $data['zones_data'];
        }
        $result['response'] = ['count' => count($data), 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }
}