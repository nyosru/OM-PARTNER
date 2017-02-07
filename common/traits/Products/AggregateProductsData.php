<?php
namespace common\traits\Products;

use common\models\PartnersProductsToCategories;
use php_rutils\RUtils;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


trait AggregateProductsData
{
    /**
     * Aggregate data for PartnersProductsToCategories
     * @param $products ActiveQuery.
     * @param $cachekey string.
     * @param $cachetime integer.
     * @return array
     */
    public function aggregateProductsData($products = [], $cachekey ='productn', $cachetime = 86400)
    {
        $data = [];
        $products = $products->asArray()->all();
        $for_int = 0;
        foreach ($products as $values) {
            $keyprod = Yii::$app->cache->buildKey('productn-' . $values['prod']);
            $dataprod = Yii::$app->cache->get($keyprod);
            if($values['last'] != FALSE){
                $lastset = $values['last'];
            }else{
                $lastset = $values['add_date'];
            }
            if ( $dataprod['data'] && $lastset == $dataprod['last'] && $values['quantity'] == $dataprod['quantity'] && $values['price'] == $dataprod['price']  && $values['model'] == $dataprod['model']) {
            $tmp[$dataprod['data']['products']['products_id']] = $dataprod['data'];
            } else {
                $for_int++;
                $nodata[] = $values['prod'];
            }
        }
        if (count($nodata) > 0) {
            if (function_exists('pinba_tag_set')) {
                pinba_tag_set('product-reload', $for_int);
            }
            $prodarr = implode(',', $nodata);
            $datar = PartnersProductsToCategories::find()
                ->where('products.products_id IN (' . $prodarr . ')')
                ->joinWith('products')
                ->joinWith('productsDescription')
                ->joinWith('productsAttributes')
                ->joinWith('productsAttributesDescr')
                ->joinWith('productsSpecification')
                ->joinWith('specificationValuesDescription')
                ->joinWith('specificationDescription')
                ->joinWith('subImage')
                ->groupBy(['products.`products_id` DESC'])->asArray()->all();
            foreach ($datar as $valuesr) {
                $d1 = strtotime($valuesr['products']['products_last_modified']);
                $d2 = strtotime($valuesr['products']['products_date_added']);

                if ($valuesr['products']['products_last_modified'] != FALSE) {
                    $last = $valuesr['products']['products_last_modified'];
                } else {
                    $last = $valuesr['products']['products_date_added'];
                }
                if($valuesr['productsSpecification']){
                    $valuesr['productsSpecification'] = ArrayHelper::index($valuesr['productsSpecification'], 'specifications_id');
                }
                if(isset($valuesr['specificationDescription'])) {
                    $valuesr['specificationDescription'] = ArrayHelper::index($valuesr['specificationDescription'], 'specifications_id');
                }
                if($valuesr['specificationValuesDescription']){
                    $valuesr['specificationValuesDescription'] = ArrayHelper::index($valuesr['specificationValuesDescription'], 'specification_values_id');
                }
                if($valuesr['productsSpecification']['74']['specification_values_id']){
                    $spec = $valuesr['productsSpecification']['74']['specification_values_id'];
                    $spec_code = $valuesr['specificationValuesDescription'][$spec]['specification_value'];
                }else{
                    $spec_code = '';
                }
                if(Yii::$app->params['seourls']== TRUE) {
                    $colorcache = '';
                    if ($valuesr['specificationValuesDescription'][$valuesr['productsSpecification']['4119']['specification_values_id']]['specification_value']) {
                        $colorcache = RUtils::translit()->slugify($valuesr['specificationValuesDescription'][$valuesr['productsSpecification']['4119']['specification_values_id']]['specification_value']);
                    }
                    $brandcache = '';
                    if ($valuesr['specificationValuesDescription'][$valuesr['productsSpecification']['77']['specification_values_id']]['specification_value']) {
                        $brandcache = RUtils::translit()->slugify($valuesr['specificationValuesDescription'][$valuesr['productsSpecification']['77']['specification_values_id']]['specification_value']);
                    }
                    $valuesr['products']['product_seo'] = $this->generateFileChpu($valuesr['productsDescription']['products_name'], $valuesr['products']['products_id'], $colorcache, $brandcache);
                }if (($orderedQuantity =  $valuesr['products']['products_ordered']) == 0) {
                    preg_match('/\d/', md5("{$valuesr['products']['products_id']}"), $matches);
                    if (empty($orderedQuantity = $matches[0])) {
                        $valuesr['products']['ordered_real'] = $valuesr['products']['products_ordered'];
                        $valuesr['products']['products_ordered'] = 5;
                    } else {
                        $valuesr['products']['ordered_real'] = $valuesr['products']['products_ordered'];
                        $valuesr['products']['products_ordered'] = (int)$orderedQuantity;
                    }
                }


                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                    $valuesr['products']['products_price'] = intval($valuesr['products']['products_price']) + (intval($valuesr['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                }
                $valuesr['catpath'] = $this->Catpath($valuesr['categories_id'], 'namenum');

                unset(
                    $valuesr['old_categories_id'],
                    $valuesr['products']['country_id'],
                    $valuesr['products']['date_checked'],
                    $valuesr['products']['imagenew'],
                    $valuesr['products']['products_image_lrg'],
                    $valuesr['products']['products_image_med'],
                    $valuesr['products']['products_image_sm_1'],
                    $valuesr['products']['products_image_sm_2'],
                    $valuesr['products']['products_image_sm_3'],
                    $valuesr['products']['products_image_sm_4'],
                    $valuesr['products']['products_image_sm_5'],
                    $valuesr['products']['products_image_sm_6'],
                    $valuesr['products']['products_image_xl_1'],
                    $valuesr['products']['products_image_xl_2'],
                    $valuesr['products']['products_image_xl_3'],
                    $valuesr['products']['products_image_xl_4'],
                    $valuesr['products']['products_image_xl_5'],
                    $valuesr['products']['products_image_xl_6'],
                    //$valuesr['products']['products_old_price'],

                    $valuesr['products']['price_coll'],
                    $valuesr['products']['products_sort_order'],
                    $valuesr['products']['products_tax_class_id'],
                    $valuesr['products']['products_to_xml'],
                    $valuesr['products']['products_weight'],
                    $valuesr['products']['raschet_pribil'],
                    $valuesr['products']['removable'],
                    $valuesr['products']['products_date_available'],
                    $valuesr['products']['products_date_view']
                );
                foreach ($valuesr['productsAttributes'] as $keyattr => $valueattr) {
                    unset(
                        $valuesr['productsAttributes'][$keyattr]['options_id'],
                        // $valuesr['productsAttributes'][$keyattr]['options_values_price'],
                        $valuesr['productsAttributes'][$keyattr]['price_prefix'],
                        $valuesr['productsAttributes'][$keyattr]['product_attributes_one_time'],
                        $valuesr['productsAttributes'][$keyattr]['products_attributes_id'],
                        $valuesr['productsAttributes'][$keyattr]['products_attributes_units'],
                        $valuesr['productsAttributes'][$keyattr]['products_attributes_units_price'],
                        $valuesr['productsAttributes'][$keyattr]['products_attributes_weight'],
                        $valuesr['productsAttributes'][$keyattr]['products_attributes_weight_prefix'],
                        $valuesr['productsAttributes'][$keyattr]['products_options_sort_order'],
                        $valuesr['productsAttributes'][$keyattr]['sub_options_values_id']
                    );
                }
                foreach ($valuesr['productsAttributesDescr'] as $keyattrdesc => $valueattrdesc) {
                    unset(
                        $valuesr['productsAttributesDescr'][$keyattrdesc]['language_id'],
                        $valuesr['productsAttributesDescr'][$keyattrdesc]['products_options_values_thumbnail']
                    );
                }
                unset(
                    $valuesr['productsDescription']['language_id'],
                    $valuesr['productsDescription']['products_head_desc_tag'],
                    $valuesr['productsDescription']['products_head_keywords_tag'],
                    $valuesr['productsDescription']['products_head_title_tag'],
                    $valuesr['productsDescription']['products_tab_1'],
                    $valuesr['productsDescription']['products_tab_2'],
                    $valuesr['productsDescription']['products_tab_3'],
                    $valuesr['productsDescription']['products_tab_4'],
                    $valuesr['productsDescription']['products_tab_5'],
                    $valuesr['productsDescription']['products_tab_6'],
                    $valuesr['productsDescription']['products_url'],
                    $valuesr['productsDescription']['products_viewed']
                );
                $valuesr['productsAttributes'] = ArrayHelper::index($valuesr['productsAttributes'], 'options_values_id');


                $valuesr['products']['season_code'] =  $spec_code;
                $keyprod = Yii::$app->cache->buildKey('productn-' . $valuesr['products_id']);
                Yii::$app->cache->set($keyprod, ['data' => $valuesr, 'last' => $last, 'quantity' => $valuesr['products']['products_quantity'], 'price' => $valuesr['products']['products_price'], 'model' => $valuesr['products']['products_model']], 86400);
                $tmp[$valuesr['products']['products_id']] = $valuesr;
            }
        }
        foreach ($products as $keyin => $values) {
            $data[] = $tmp[$values['prod']];
        }
        return $data;
    }
}

?>