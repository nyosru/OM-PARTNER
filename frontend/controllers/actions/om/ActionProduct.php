<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersCatDescription;
use common\models\ProductsSpecifications;
use Yii;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use yii\helpers\ArrayHelper;

trait ActionProduct
{
    public function actionProduct()
    {
        Yii::$app->params['paramset']['relproducts']['active'] = 1;
        Yii::$app->params['paramset']['relproducts']['value'] = 10;
        $relProd = [];

        // Если запрос пришел через GET
        if (Yii::$app->request->isGet) {
            $id = (integer)Yii::$app->request->getQueryParam('id');
        }else{
            $id = (integer)Yii::$app->request->post('id');
        }


            if ($id > 0 && ($x = PartnersProducts::find()->select('MAX(products.`products_last_modified`) as products_last_modified, MAX(products_date_added) as add_date ')->where(['products_id' => trim($id)])->createCommand()->queryOne()) == TRUE) {

                $spec = PartnersProductsToCategories::find()
                    ->where(['products_to_categories.products_id' => $id])
                    ->joinWith('productsSpecification')
                    ->joinWith('specificationValuesDescription')
                    ->joinWith('specificationDescription')
                    ->asArray()->groupBy('products_specifications.products_id')->asArray()->one();
                if ($spec) {
                    $spec['specificationDescription'] = ArrayHelper::index($spec['specificationDescription'], 'specifications_id');
                    $spec['specificationValuesDescription'] = ArrayHelper::index($spec['specificationValuesDescription'], 'specification_values_id');
                }


                if (strtotime($x['products_last_modified']) < strtotime($x['add_date']))
                    $x['products_last_modified'] = $x['add_date'];
                $checkcache = $x['products_last_modified'];

                $keyprod = Yii::$app->cache->buildKey('product-' . $id);
                $data = Yii::$app->cache->get($keyprod);
                $d1 = trim($checkcache);
                $d2 = trim($data['last']);
                if (!$data || ($d1 !== $d2)) {

                    $data = PartnersProductsToCategories::find()->JoinWith('products')->where('products.`products_id` =:id', [':id' => $id])->JoinWith('productsDescription')->JoinWith('productsAttributes')->groupBy(['products.`products_id` DESC'])->JoinWith('productsAttributesDescr')->asArray()->all();
                    $data = end($data);
                    unset(
                        $data['old_categories_id'],
                        $data['products']['country_id'],
                        $data['products']['date_checked'],
                        $data['products']['imagenew'],
                        $data['products']['products_image_lrg'],
                        $data['products']['products_image_med'],
                        $data['products']['products_image_sm_1'],
                        $data['products']['products_image_sm_2'],
                        $data['products']['products_image_sm_3'],
                        $data['products']['products_image_sm_4'],
                        $data['products']['products_image_sm_5'],
                        $data['products']['products_image_sm_6'],
                        $data['products']['products_image_xl_1'],
                        $data['products']['products_image_xl_2'],
                        $data['products']['products_image_xl_3'],
                        $data['products']['products_image_xl_4'],
                        $data['products']['products_image_xl_5'],
                        $data['products']['products_image_xl_6'],
                        $data['products']['products_ordered'],
                        $data['products']['price_coll'],
                        $data['products']['products_sort_order'],
                        $data['products']['products_tax_class_id'],
                        $data['products']['products_to_xml'],
                        $data['products']['products_weight'],
                        $data['products']['raschet_pribil'],
                        $data['products']['removable'],
                        $data['products']['products_date_available'],
                        $data['products']['products_date_view'],
                        $data['productsDescription']['language_id'],
                        $data['productsDescription']['products_head_desc_tag'],
                        $data['productsDescription']['products_head_keywords_tag'],
                        $data['productsDescription']['products_head_title_tag'],
                        $data['productsDescription']['products_tab_1'],
                        $data['productsDescription']['products_tab_2'],
                        $data['productsDescription']['products_tab_3'],
                        $data['productsDescription']['products_tab_4'],
                        $data['productsDescription']['products_tab_5'],
                        $data['productsDescription']['products_tab_6'],
                        $data['productsDescription']['products_url'],
                        $data['productsDescription']['products_viewed']
                    );
                    foreach ($data['productsAttributes'] as $keyattr => $valueattr) {
                        unset(
                            $data['productsAttributes'][$keyattr]['options_id'],
                            $data['productsAttributes'][$keyattr]['options_values_price'],
                            $data['productsAttributes'][$keyattr]['price_prefix'],
                            $data['productsAttributes'][$keyattr]['product_attributes_one_time'],
                            $data['productsAttributes'][$keyattr]['products_attributes_id'],
                            $data['productsAttributes'][$keyattr]['products_attributes_units'],
                            $data['productsAttributes'][$keyattr]['products_attributes_units_price'],
                            $data['productsAttributes'][$keyattr]['products_attributes_weight'],
                            $data['productsAttributes'][$keyattr]['products_attributes_weight_prefix'],
                            $data['productsAttributes'][$keyattr]['products_options_sort_order'],
                            $data['productsAttributes'][$keyattr]['sub_options_values_id']
                        );
                    }
                    foreach ($data['productsAttributesDescr'] as $keyattrdesc => $valueattrdesc) {
                        unset(
                            $data['productsAttributesDescr'][$keyattrdesc]['language_id'],
                            $data['productsAttributesDescr'][$keyattrdesc]['products_options_values_thumbnail']
                        );
                    }
                    Yii::$app->cache->set($keyprod, ['data' => $data, 'last' => $checkcache]);
                } else {
                    $data = $data['data'];
                }
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {

                    $data['products']['products_price'] = intval($data['products']['products_price']) + (intval($data['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));

                }

                if ($data['categories_id'] == 0 || $data['categories_id'] == 327 || $data['categories_id'] == 1354) {
                    $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
                } else {
                    $catpath = $this->Catpath($data['categories_id'], 'namenum');
                }

                $list = array();
                $hide_man = $this->hide_manufacturers_for_partners();
                foreach ($hide_man as $value) {
                    $list[] = $value['manufacturers_id'];
                }
                $x = PartnersProducts::find()->select('products_status')->where(['products_id' => $data['products']['products_id']])->asArray()->one();
                if (in_array($data['products']['manufacturers_id'], $list) || $x['products_status'] != 1) {
                    $data['products']['products_quantity'] = 0;
                    if ($data['productsAttributes']) {
                        foreach ($data['productsAttributes'] as $keyattr2 => $valueattr2) {
                            $data['productsAttributes'][$keyattr2]['quantity'] = 0;
                        }
                    }
                }
                $relProduct = $this->RelatedProducts($data['categories_id'] );

                if (Yii::$app->request->isPost) {
                    $data['productsAttributesDescr'] = ArrayHelper::index($data['productsAttributesDescr'], 'products_options_values_name');
                    $data['productsAttributes'] = ArrayHelper::index($data['productsAttributes'], 'options_values_id');
                    Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                    return ['product' => $data, 'spec' => $spec];
                } elseif (Yii::$app->request->isGet) {
                    $man_time = $this->manufacturers_diapazon_id();
                    return $this->render('product', ['product' => $data, 'catpath' => $catpath, 'spec' => $spec, 'relprod' => $relProduct, 'man_time' => $man_time]);

                } else {
                    return $this->redirect('/');
                }

            }



        }

}