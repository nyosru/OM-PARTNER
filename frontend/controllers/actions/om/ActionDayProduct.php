<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersPage;
use common\models\PartnersProducts;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use yii\bootstrap\Tabs;
use Faker\Provider\zh_TW\DateTime;
use Yii;
use common\models\PartnersConfig;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

trait ActionDayProduct
{
    public function actionDayproduct()
    {

        if (Yii::$app->request->isGet) {
            $cat_start = (integer)(Yii::$app->request->getQueryParam('cat'));
            $start_price = (integer)(Yii::$app->request->getQueryParam('start_price'));
            $end_price = (integer)(Yii::$app->request->getQueryParam('end_price'));
            $prod_attr_query = (integer)(Yii::$app->request->getQueryParam('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->getQueryParam('count', 60));
            $page = (integer)(Yii::$app->request->getQueryParam('page', 0));
            $sort = (integer)(Yii::$app->request->getQueryParam('sort'));
            $ok = (integer)Yii::$app->request->getQueryParam('ok');
            $searchword = Yii::$app->request->getQueryParam('searchword', '');
            $json = Yii::$app->request->getQueryParam('json');
        } elseif (Yii::$app->request->isPost) {
            $cat_start = (integer)(Yii::$app->request->post('cat'));
            $start_price = (integer)(Yii::$app->request->post('start_price', 0));
            $end_price = (integer)(Yii::$app->request->post('end_price', 1000000));
            $prod_attr_query = (integer)(Yii::$app->request->post('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->post('count', 60));
            $page = (integer)(Yii::$app->request->post('page', 0));
            $sort = (integer)(Yii::$app->request->post('sort', 10));
            $ok = (integer)Yii::$app->request->post('ok');
            $searchword = urldecode(Yii::$app->request->post('searchword', ''));
            $json = Yii::$app->request->post('json');
        }
        $data = $this->AggregateCatalogData(
            $params = [
                'cat_start' => $cat_start,
                'start_price' => $start_price,
                'end_price' => $end_price,
                'prod_attr_query' => $prod_attr_query,
                'count' => $count,
                'page' => $page,
                'sort' => $sort,
                'searchword' => $searchword
            ],
            $options = [
                'ok' => $ok,
                'date' => 'offset',
                'typeresponse' => $json,
                'maxtime' => date('Y-m-d H:i:s'),
                'offsettime' => '-1 day',
                'cachelistkeyprefix' => 'day-day1-' . $ok,
                'cacheproductkey' => 'product'
            ]);

        if ($json) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->render('cataloggibrid', $data);
        }
    }
}