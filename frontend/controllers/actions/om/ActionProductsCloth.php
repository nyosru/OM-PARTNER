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
            $lux = (integer)Yii::$app->request->getQueryParam('lux');
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
            $lux = (integer)Yii::$app->request->post('lux');
            if (($date_end = Yii::$app->request->post('date_end')) == FALSE) {
                $date_end = date('Y-m-d H:i:s');
            }
            $json = Yii::$app->request->post('json');
        }
        if($lux){
            $start_price = max(1000, $start_price);
        }
        $data = $this->AggregateCatalogData(
            $params = [
                'cat_start' => 0,
                'start_price' => $start_price,
                'end_price' => $end_price,
                'prod_attr_query' => $prod_attr_query,
                'count' => $count,
                'page' => $page,
                'sort' => $sort,
                'searchword' => $searchword,

            ],
            $options = [
                'allowcat'=>[0],
                'disallowcat'=> [327 , 932, 1354, 3014, 1111,  1562, 1609, 1681, 2047, 2714, 3009, 3201,  3014, 2884, 2873, 2222, 2181, 2155, 2130, 2065, 2048, 2040, 1549],
                'studio' => false,
                'discont' => false,
                'ok' => $ok,
                'lux' => $lux,
                'date' => 'param',
                'typeresponse' => $json,
                'maxtime' => $date_end,
                'offsettime' => '-1 week',
                'cachelistkeyprefix' => 'dru5gserf5gge11' . $ok.'-'.$lux,
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