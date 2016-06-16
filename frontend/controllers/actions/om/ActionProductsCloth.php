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

trait ActionProductsCloth
{
    public function actionProductscloth()
    {


        if (Yii::$app->request->isGet) {
            $cat_start = (integer)(Yii::$app->request->getQueryParam('cat'));
            $start_price = (integer)(Yii::$app->request->getQueryParam('start_price'));
            $end_price = (integer)(Yii::$app->request->getQueryParam('end_price'));
            $prod_attr_query = (integer)(Yii::$app->request->getQueryParam('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->getQueryParam('count', 60));
            $page = (integer)(Yii::$app->request->getQueryParam('page', 0));
            $sort = (integer)(Yii::$app->request->getQueryParam('sort'));
            $date_start = Yii::$app->request->getQueryParam('date_start');
            $ok = (integer)Yii::$app->request->getQueryParam('ok');
            $sfilt = Yii::$app->request->getQueryParam('sfilt');
            if (($date_end = Yii::$app->request->getQueryParam('date_end')) == FALSE) {
                $date_end = date('Y-m-d H:i:s');
            }
            $searchword = Yii::$app->request->getQueryParam('searchword', '');
            $json = Yii::$app->request->post('json');
        } elseif (Yii::$app->request->isPost) {
            $cat_start = (integer)(Yii::$app->request->post('cat'));
            $start_price = (integer)(Yii::$app->request->post('start_price', 0));
            $end_price = (integer)(Yii::$app->request->post('end_price', 1000000));
            $prod_attr_query = (integer)(Yii::$app->request->post('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->post('count', 60));
            $page = (integer)(Yii::$app->request->post('page', 0));
            $sort = (integer)(Yii::$app->request->post('sort', 10));
            $searchword = urldecode(Yii::$app->request->post('searchword', ''));
            $date_start = Yii::$app->request->post('date_start');
            $sfilt = Yii::$app->request->post('sfilt');
            $ok = (integer)Yii::$app->request->post('ok');
            if (($date_end = Yii::$app->request->post('date_end')) == FALSE) {
                $date_end = date('Y-m-d H:i:s');
            }
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
                'allowcat' => [1350, 1397, 1632, 1668, 1805, 1815, 1904, 1905, 712, 1344, 1422, 1443, 1538, 1908, 1909, 1910, 1996, 2008, 2114, 2122, 2123, 2113, 1976, 3239],
                'ok' => $ok,
                'date' => 'offset',
                'typeresponse' => $json,
                'maxtime' => date('Y-m-d H:i:s'),
                'offsettime' => '-1 month',
                'cachelistkeyprefix' => 'clothzmonth121' . $ok,
                'cacheproductkey' => 'product',
                'sfilt'=>$sfilt
            ]);

        if ($json) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->render('cataloggibrid', $data);
        }
    }

}