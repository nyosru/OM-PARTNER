<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

trait ActionCatalog
{
    public function actionCatalog()
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
                'searchword' => $searchword,

            ],
            $options = [
                'allowcat'=> [0],
                'disallowcat'=>[327,1354],
                'studio' => false,
                'discont' => false,
                'ok' => $ok,
                'date' => 'param',
                'typeresponse' => $json,
                'maxtime' => $date_end,
                'offsettime' => $date_start,
                'cachelistkeyprefix' => 'catalog12' . $ok,
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