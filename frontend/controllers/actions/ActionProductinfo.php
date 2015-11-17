<?php
namespace frontend\controllers\actions;

use Yii;
use common\models\PartnersProductsToCategories;

trait ActionProductinfo
{
    public function actionProductinfo()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
        } else {
            $id = Yii::$app->request->getQueryParam('id');
        }
        $keyprod = Yii::$app->cache->buildKey('product-' . $id);
        $data = Yii::$app->cache->get($keyprod);
        if (!$data) {
            $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
        } else {
            $data = $data['data'];
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

            $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

        }
        return $data;

    }
}