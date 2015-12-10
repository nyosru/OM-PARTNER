<?php
namespace frontend\controllers\actions;

use common\models\PartnersProducts;
use Yii;
use common\models\PartnersProductsToCategories;

trait ActionProductinfobymodel
{
    public function actionProductinfobymodel()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (Yii::$app->request->isPost) {
            if (($id = (integer)Yii::$app->request->post('id')) == FALSE) {
                if (($model = (integer)Yii::$app->request->post('model')) == TRUE) {
                    $idstack = PartnersProducts::findAll(['products_model' => $model]);
                } else {
                    return ['1'];
                }
            } else {
                return ['2'];
            }
        } else {
            if (($id = (integer)Yii::$app->request->getQueryParam('id')) == FALSE) {
                if (($model = (integer)Yii::$app->request->getQueryParam('model')) == TRUE) {
                    $idstack = PartnersProducts::findAll(['products_model' => $model]);
                } else {
                    return ['3'];
                }
            } else {
                return ['4'];
            }
        }

        if (!isset($idstack)) {
            $keyprod = Yii::$app->cache->buildKey('product-' . $id);
            $data = Yii::$app->cache->get($keyprod);
            if (!$data) {
                $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_model` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
            } else {
                $data = $data['data'];
            }

            if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
            }
            return $data;
        } else {
            foreach ($idstack as $key => $value) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $value);
                $data = Yii::$app->cache->get($keyprod);
                if (!$data) {
                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_model` =:id', [':id' => $value])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
                } else {
                    $data = $data['data'];
                }

                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                    $data['products']['products_price'] = (integer)($data['products']['products_price']) + ((integer)($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                }
                $stackdata[] = $data;
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $stackdata;
        }

    }
}