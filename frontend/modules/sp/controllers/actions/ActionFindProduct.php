<?php
namespace frontend\modules\sp\controllers\actions;

use common\models\ProductsSpecifications;
use yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
// DEPRECATED
trait ActionFindProduct {
    public function actionFindProduct() {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        }

        if (!Yii::$app->request->isPost) {
            return false;
        }

        $model = (integer)Yii::$app->request->post('model');

        $x = PartnersProducts::find()->select('MAX(`products_last_modified`) as last_modified ');
        if ($model > 0) {
            $x = $x->orWhere(['products_model' => $model]);
        } else {
            return [];
        }
        $x = $x->asArray()->One();

        if ($x['last_modified']) {
            $keyprod = Yii::$app->cache->buildKey('product_model-' . $model);
            $data = Yii::$app->cache->get($keyprod);
            if (!$data || ($x['last_modified'] != $data['last'])) {
                $data = PartnersProductsToCategories::find()->JoinWith('products')
                    ->where('products.`products_model` =:model', [':model' => $model])->JoinWith('productsDescription')
                    ->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])
                    ->JoinWith('productsAttributesDescr')->asArray()->one()
                ;
                Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $x['last_modified']]);
            } else {
                $data = $data['data'];
            }

            if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                $data['products']['products_price'] =
                    intval($data['products']['products_price']) +
                    (intval($data['products']['products_price']) /
                        100 *
                        intval(Yii::$app->params['partnersset']['discount']['value']));

            }

            return $data;
        }

        return [];
    }
}
