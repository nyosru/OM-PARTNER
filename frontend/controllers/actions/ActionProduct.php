<?php
namespace frontend\controllers\actions;

use common\models\ProductsSpecifications;
use yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;

trait ActionProduct
{
    public function actionProduct()
    {
        $id = (integer)Yii::$app->request->get('id');

        if ($id > 0) {
            $x = PartnersProducts::find()->select('MAX(`products_last_modified`) as last_modified ')->where(['products_id' => $id])->asArray()->One();
            if ($x['last_modified']) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $id);
                $data = Yii::$app->cache->get($keyprod);
                if (!$data || ($x['last_modified'] != $data['last'])) {
                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->one();
                    Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $x['last_modified']]);
                } else {
                    $data = $data['data'];
                }
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                    $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

                }
                echo $spec->specifications_id;
                return $this->render('product', ['product' => $data, 'spec'=>$spec]);
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }
}
