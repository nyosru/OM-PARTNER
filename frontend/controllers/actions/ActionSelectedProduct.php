<?php
namespace frontend\controllers\actions;

use common\models\AddressBook;
use common\models\Configuration;
use common\models\Customers;
use common\models\Orders;
use common\models\PartnersProducts;
use common\models\PartnersProductsToCategories;
use common\models\PartnersUsersInfo;
use Yii;
use yii\helpers\ArrayHelper;

trait ActionSelectedProduct
{
    public function actionSelectedproduct()
    {
        if (($products = Yii::$app->request->post('products')) == TRUE && is_array($products)) {
            foreach ($products as $products_key => $products_value) {
                $products[$products_key] = (int)$products_value;
            }
            $prod = PartnersProducts::find()->select('products.products_id as prod, products.products_price as price, products.products_last_modified as last, products_date_added as add_date,products_quantity as quantity ')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where(['products.products_id' => $products])->distinct()->orderBy('products_date_added')->asArray()->all();
            $ifht = 0;
            foreach ($prod as $values) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $values['prod']);
                $dataprod = Yii::$app->cache->get($keyprod);
                if (!$values['last']) {
                    $values['last'] = $values['add_date'];
                }

                $d2 = trim($values['last']);
                $d1 = trim($dataprod['last']);

                if ($dataprod['data'] && $d1 === $d2 || $values['quantity'] == $dataprod['quantity']) {
                } else {
                    $nodata[] = $values['prod'];
                    $cache = $ifht++;
                }
            }
            if (count($nodata) > 0) {
                $prodarr = implode(',', $nodata);
                $datar = PartnersProductsToCategories::find()->where('products.products_id IN (' . $prodarr . ')')->joinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->asArray()->all();
                foreach ($datar as $valuesr) {
                    $keyprod = Yii::$app->cache->buildKey('product-' . $valuesr['products_id']);
                    Yii::$app->cache->set($keyprod, ['data' => $valuesr, 'last' => $valuesr['products']['products_last_modified'], 'quantity' => $valuesr['products']['products_quantity']]);
                }
            }
            foreach ($prod as $keyin => $values) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $values['prod']);
                $dataprod = Yii::$app->cache->get($keyprod);
                $data[] = $dataprod['data'];
            }
            if (is_array($data)) {
                foreach ($data as $key => $dataval) {
                    if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                        $data[$key]['products']['products_price'] = intval($data[$key]['products']['products_price']) + (intval($data[$key]['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                    }
                    $data[$key]['catpath'] = $this->Catpath($data[$key]['categories_id'], 'namenum');
                    unset(
                        $data[$key]['old_categories_id'],
                        $data[$key]['products']['country_id'],
                        $data[$key]['products']['date_checked'],
                        $data[$key]['products']['imagenew'],
                        $data[$key]['products']['products_image_lrg'],
                        $data[$key]['products']['products_image_med'],
                        $data[$key]['products']['products_image_sm_1'],
                        $data[$key]['products']['products_image_sm_2'],
                        $data[$key]['products']['products_image_sm_3'],
                        $data[$key]['products']['products_image_sm_4'],
                        $data[$key]['products']['products_image_sm_5'],
                        $data[$key]['products']['products_image_sm_6'],
                        $data[$key]['products']['products_image_xl_1'],
                        $data[$key]['products']['products_image_xl_2'],
                        $data[$key]['products']['products_image_xl_3'],
                        $data[$key]['products']['products_image_xl_4'],
                        $data[$key]['products']['products_image_xl_5'],
                        $data[$key]['products']['products_image_xl_6'],
                        //$data[$key]['products']['products_old_price'],
                        $data[$key]['products']['products_ordered'],
                        $data[$key]['products']['price_coll'],
                        $data[$key]['products']['products_sort_order'],
                        $data[$key]['products']['products_tax_class_id'],
                        $data[$key]['products']['products_to_xml'],
                        $data[$key]['products']['products_weight'],
                        $data[$key]['products']['raschet_pribil'],
                        $data[$key]['products']['removable'],
                        $data[$key]['products']['products_date_available'],
                        $data[$key]['products']['products_date_view']
                    );
                    foreach ($data[$key]['productsAttributes'] as $keyattr => $valueattr) {
                        unset(
                            $data[$key]['productsAttributes'][$keyattr]['options_id'],
                            $data[$key]['productsAttributes'][$keyattr]['options_values_price'],
                            $data[$key]['productsAttributes'][$keyattr]['price_prefix'],
                            $data[$key]['productsAttributes'][$keyattr]['product_attributes_one_time'],
                            $data[$key]['productsAttributes'][$keyattr]['products_attributes_id'],
                            $data[$key]['productsAttributes'][$keyattr]['products_attributes_units'],
                            $data[$key]['productsAttributes'][$keyattr]['products_attributes_units_price'],
                            $data[$key]['productsAttributes'][$keyattr]['products_attributes_weight'],
                            $data[$key]['productsAttributes'][$keyattr]['products_attributes_weight_prefix'],
                            $data[$key]['productsAttributes'][$keyattr]['products_options_sort_order'],
                            $data[$key]['productsAttributes'][$keyattr]['sub_options_values_id']
                        );
                    }
                    foreach ($data[$key]['productsAttributesDescr'] as $keyattrdesc => $valueattrdesc) {
                        unset(
                            $data[$key]['productsAttributesDescr'][$keyattrdesc]['language_id'],
                            $data[$key]['productsAttributesDescr'][$keyattrdesc]['products_options_values_thumbnail']
                        );
                    }
                    unset(
                        $data[$key]['productsDescription']['language_id'],
                        $data[$key]['productsDescription']['products_head_desc_tag'],
                        $data[$key]['productsDescription']['products_head_keywords_tag'],
                        $data[$key]['productsDescription']['products_head_title_tag'],
                        $data[$key]['productsDescription']['products_tab_1'],
                        $data[$key]['productsDescription']['products_tab_2'],
                        $data[$key]['productsDescription']['products_tab_3'],
                        $data[$key]['productsDescription']['products_tab_4'],
                        $data[$key]['productsDescription']['products_tab_5'],
                        $data[$key]['productsDescription']['products_tab_6'],
                        $data[$key]['productsDescription']['products_url'],
                        $data[$key]['productsDescription']['products_viewed']
                    );
                    $data[$key]['productsAttributes'] = ArrayHelper::index($data[$key]['productsAttributes'], 'options_values_id');
                }
            } else {
                $data = 'Не найдено!';
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $data;
        } else {
            return $this->render('selectedproduct');
        }

    }
}