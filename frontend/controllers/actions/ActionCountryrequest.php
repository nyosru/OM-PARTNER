<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\Countries;

trait ActionCountryrequest
{
    public function actionCountryrequest()
    {

        $data = Yii::$app->cache->get(urlencode('data_country-' . Yii::$app->params['constantapp']['APP_ID']));
        $countryfirst = ['Российская Федерация'];
        if ($data === false) {
            $country_data = new Countries();
            $data = $country_data->find()->select('countries_id as id, countries_name as title')->asArray()->all();

            Yii::$app->cache->set(urlencode('data_country-' . Yii::$app->params['constantapp']['APP_ID']), ['data_country' => $data], 86400);

        } else {
            $data = $data['data_country'];
        }
        foreach ($data as $key => $val) {
            if (in_array($val['title'], $countryfirst)) {
                $tmp = $data[$key];
                unset($data[$key]);
                array_unshift($data, $tmp);
            }
        }
        $result['response'] = ['count' => count($data), 'items' => $data];
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return $result;
    }
}