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
                    return ['exception' => '1'];
                }
            } else {
                return ['exception' => '2'];
            }
        } else {
            if (($id = (integer)Yii::$app->request->getQueryParam('id')) == FALSE) {
                if (($model = (integer)Yii::$app->request->getQueryParam('model')) == TRUE) {
                    $idstack = PartnersProducts::findAll(['products_model' => $model]);
                } else {
                    return ['exception' => 'Не указан артикул модели'];
                }
            } else {
                return ['exception' => 'Не указан id модели'];
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
                $data['products']['products_price'] = (integer)($data['products']['products_price']) + ((integer)($data['products']['products_price']) / 100 * (integer)(Yii::$app->params['partnersset']['discount']['value']));
            }
            if ($data) {
                return $data;
            } else {
                return ['exception' => 'Артикул не найден'];
            }
        } else {
            $stackdata = [];

            foreach ($idstack as $key => $value) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $value->products_id);
                $data = Yii::$app->cache->get($keyprod);
                if (!$data) {
                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_model` =:id', [':id' => $value->products_id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
                } else {
                    $data = $data['data'];
                }

                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1 && $data) {
                    $data['products']['products_price'] = (integer)($data['products']['products_price']) + ((integer)($data['products']['products_price']) / 100 * (integer)(Yii::$app->params['partnersset']['discount']['value']));
                }
                $stackdata[] = $data;
            }
            if ($stackdata) {
                return $stackdata;
            } else {
                return ['exception' => 'Артикул не найден'];
            }
        }

    }
}