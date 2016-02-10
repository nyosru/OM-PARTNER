<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;

trait ActionProduct
{
    public function actionProduct()
    {
        $id = (integer)Yii::$app->request->getQueryParam('id');
        $spec=PartnersProductsToCategories::find()
            ->where(['products_to_categories.products_id'=>$id])
            ->joinWith('productsSpecification')
            ->joinWith('specificationValuesDescription')
            ->joinWith('specificationDescription')
            ->asArray()->groupBy('products_specifications.products_id')->all();
        if ($id > 0) {
            $x = PartnersProducts::find()->select('`products_last_modified` as last_modified, products_date_added as add_date')->where(['products_id' => trim($id)])->asArray()->One();
            if(!$x['last_modified']){
                $x['last_modified'] = $x['add_date'] ;
            }
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
                $catpath = json_decode(file_get_contents('http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/catpath?cat=' . $data['categories_id'] . '&action=namenum'));
                    return $this->render('product', ['product' => $data, 'catpath'=>$catpath, 'spec'=>$spec]);
            } else {
                return $this->redirect('/');
            }
        } else {
            return $this->redirect('/');
        }
    }
}
