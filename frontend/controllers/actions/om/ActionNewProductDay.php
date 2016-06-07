<?php
namespace frontend\controllers\actions\om;

use common\models\PartnersProductsAttributes;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;

trait ActionNewProductDay
{
    public function actionActionNewProductDay()
    {
        if (Yii::$app->request->isGet) {
            $cat_start = (integer)(Yii::$app->request->getQueryParam('cat'));
            $check = Yii::$app->params['constantapp']['APP_ID'];
            $checks = Yii::$app->params['constantapp']['APP_CAT'];
            $start_price = (integer)(Yii::$app->request->getQueryParam('start_price'));
            $end_price = (integer)(Yii::$app->request->getQueryParam('end_price'));
            $prod_attr_query = (integer)(Yii::$app->request->getQueryParam('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->getQueryParam('count', 48));
            $page = (integer)(Yii::$app->request->getQueryParam('page', 0));
            $start_arr = (integer)($page * $count);
            $sort = (integer)(Yii::$app->request->getQueryParam('sort'));
            $searchword = Yii::$app->request->getQueryParam('searchword', '');
        } elseif (Yii::$app->request->isPost) {
            $cat_start = (integer)(Yii::$app->request->post('cat'));
            $check = Yii::$app->params['constantapp']['APP_ID'];
            $checks = Yii::$app->params['constantapp']['APP_CAT'];
            $start_price = (integer)(Yii::$app->request->post('start_price', 0));
            $end_price = (integer)(Yii::$app->request->post('end_price', 1000000));
            $prod_attr_query = (integer)(Yii::$app->request->post('prod_attr_query', ''));
            $count = (integer)(Yii::$app->request->post('count', 48));
            $page = (integer)(Yii::$app->request->post('page', 0));
            $start_arr = (integer)($page * $count);
            $sort = (integer)(Yii::$app->request->post('sort', 10));
            $searchword = Yii::$app->request->post('searchword', '');
        }
        if ($sort == 'undefined' || !isset($sort) || $sort == '') {
            $sort = 0;
        }
        if ($page == 'undefined' || !isset($page) || $page == '') {
            $page = 0;
        }

        if ($end_price == 'undefined' || !isset($end_price) || $end_price == '' || $end_price == 0) {
            $end_price = 1000000;
        } else {
            $end_price++;
        }
        if ($start_price == 'undefined' || !isset($start_price) || $start_price == '') {
            $start_price = 0;
        }
        $man_time = $this->manufacturers_diapazon_id();
        $categoriesarr = $this->full_op_cat();
        $cat = implode(',', $this->load_cat($categoriesarr['cat'], $cat_start, $categoriesarr['name'], $checks));
        // $this->chpu = Requrscat($categoriesarr['cat'], $cat_start ,$categoriesarr['name']);

        $x = PartnersProductsToCategories::find()->select('MAX(products.`products_last_modified`) as products_last_modified, products_date_added as add_date')->JoinWith('products')->where('categories_id IN (' . $cat . ')')->createCommand()->queryAll();
        if (!$x['products_last_modified']) {
            $x['products_last_modified'] = $x['add_date'];
        }
        $checkcache = $x['products_last_modified'];
        $init_key = $cat . '-' . $start_price . '-' . $end_price . '-' . $count . '-' . $page . '-' . $sort . '-' . $prod_attr_query . '-' . $searchword;
        $init_key_static = $cat . '-' . $start_price . '-' . $end_price . '-' . $count . '-' . $prod_attr_query . '-' . $searchword;
        $key = Yii::$app->cache->buildKey($init_key);
        $dataque = Yii::$app->cache->get($key);
        $d1 = strtotime(trim($checkcache));
        $d2 = strtotime(trim($dataque['checkcache']));
        Yii::$app->params['log']['date']['dt'][][1] = $d1;
        Yii::$app->params['log']['date']['dt'][][2] = $d2;
        $markers = $d2 - $d1;
        Yii::$app->params['log']['date']['dt'][]['c'] = $markers;
        if (!isset($dataque['checkcache']) || $markers !== 0) {
            switch ($sort) {
                case 0:
                    $order = ['products_date_added' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 1:
                    $order = ['products.products_price' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 2:
                    $order = ['products_name' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 3:
                    $order = ['products_model' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 4:
                    $order = ['products_ordered' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 10:
                    $order = ['products_date_added' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 11:
                    $order = ['products.products_price' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 12:
                    $order = ['products_name' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 13:
                    $order = ['products_model' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
                case 14:
                    $order = ['products_ordered' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                    break;
            }
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $type = '';
            $arfilt = $arfilt_attr = [':start_price' => $start_price, ':end_price' => $end_price];
            $arfilt_pricemax = array();
            $hide_man = implode(',', $list);
            if ($prod_attr_query != '') {
                $finderkey = Yii::$app->cache->buildKey('productattrfinder-' . $prod_attr_query);
                if (($findue = Yii::$app->cache->get($finderkey)) == TRUE) {

                } else {
                    $prod_attr_querys = PartnersProductsOptionVal::find()->where(['products_options_values_id' => (int)$prod_attr_query])->createCommand()->queryOne()['products_options_values_name'];
                    $prodfilt = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $prod_attr_querys . ')[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';
                    $finder = PartnersProductsOptionVal::find()->where('LOWER(products_options_values_name) RLIKE :prod_attr_query ', [':prod_attr_query' => $prodfilt])->createCommand()->queryAll();
                    if (!$finder) {
                        $findue[] = $prod_attr_query;
                    }
                    foreach ($finder as $finderkey => $findervalue) {
                        $findue[] = $findervalue['products_options_values_id'];
                    }
                    foreach ($finder as $finderkey => $findervalue) {
                        Yii::$app->cache->set($findervalue['products_options_values_id'], $findue, 3600);
                    }

                }
                $prod_attr_query_filt = ' and options_values_id IN (' . implode(',', $findue) . ')  ';
                // $arfilt[':prod_attr_query'] = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $prod_attr_query . ')[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';

                // $arfilt_pricemax[':prod_attr_query'] = $prod_attr_query;


            } else {
                $prod_search_query_filt = '';
            }
            if ($searchword != '') {
                if (preg_match('/^[0-9 ]+$/', $searchword)) {
                    $arfilt[':searchword'] = trim(str_replace(' ', '', $searchword));
                    $arfilt_pricemax[':searchword'] = trim(str_replace(' ', '', $searchword));
                    $prod_search_query_filt = '  and products.products_model=:searchword ';
                } elseif (preg_match('/^[0-9a-zа-я ]+$/iu', $searchword)) {
                    $patternkey = 'patternsearch-' . urlencode($searchword);
                    $patterndata = Yii::$app->cache->get($patternkey);
                    if (!$patterndata) {
                        $valsearchin = explode('+', $searchword);
                        if (is_array($valsearchin)) {
                            foreach ($valsearchin as $search) {
                                if ($search != '') {
                                    $valsearch[] = $this->sklonenie(trim($search));
                                }
                            }
                            $searchword = implode('|', $valsearch);

                        } else {
                            $searchword = $this->sklonenie(trim($searchword));
                        }
                        Yii::$app->cache->set($patternkey, ['data' => $searchword], 86400);
                    } else {
                        if (is_array($patterndata['data'])) {
                            $searchword = implode('|', $searchword['data']);
                        } else {
                            $searchword = explode(' ', $patterndata['data']);
                            $searchword = implode('|', $searchword);
                        }
                    }
                    $arfilt[':searchword'] = $arfilt_pricemax[':searchword'] = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $searchword . ')(ами|ями|ов|ев|ей|ам|ям|ах|ях|ою|ею|ом|ем|а|я|о|е|ы|и|у|ю)*[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';
                    $prod_search_query_filt = ' and  LOWER(products_description.products_name) RLIKE :searchword ';
                }
            } else {
                $prod_search_query_filt = '';
            }
            $prod = PartnersProductsToCategories::find()->select('products.products_id as prod, products.products_price as price, products.products_last_modified as last, products_date_added as add_date ')->JoinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where('  categories_id IN (' . $cat . ') and (products_status = 1) ' . $prod_search_query_filt . $prod_attr_query_filt . ' and (products_image IS NOT NULL) and products_image != "/" and (products_description IS NOT NULL) and ( products.products_quantity > 0 ) and ( products.price_coll != 0 )  and (products.products_price <= :end_price) and (products.products_price >= :start_price)  and (products.manufacturers_id NOT IN (' . $hide_man . '))', $arfilt)->limit($count)->offset($start_arr)->distinct()->orderBy($order)->asArray()->all();
            foreach ($prod as $values) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $values['prod']);
                $dataprod = Yii::$app->cache->get($keyprod);
                if (!$values['last']) {
                    $values['last'] = $values['add_date'];
                }
                $d2 = strtotime(trim($values['last']));
                $d1 = strtotime(trim($dataprod['last']));
                $marker = $d2 - $d1;
                Yii::$app->params['log']['date']['dt'][][1] = $d1;
                Yii::$app->params['log']['date']['dt'][][2] = $d2;
                Yii::$app->params['log']['date']['dt'][]['c'] = $marker;
                if (isset($dataprod['data']) && $marker !== 0) {
                } else {
                    $nodata[] = $values['prod'];
                }
            }
            if (isset($nodata) && count($nodata) > 0) {
                $prodarr = implode(',', $nodata);
                $datar = PartnersProductsToCategories::find()->JoinWith('products')->where('products.products_id IN (' . $prodarr . ')')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy(['products.`products_id` DESC'])->asArray()->all();
                foreach ($datar as $valuesr) {
                    $keyprod = Yii::$app->cache->buildKey('product-' . $valuesr['products_id']);
                    Yii::$app->cache->set($keyprod, ['data' => $valuesr, 'last' => $valuesr['products']['products_last_modified']]);
                }
            }
            foreach ($prod as $key => $values) {
                $keyprod = Yii::$app->cache->buildKey('product-' . $values['prod']);
                $dataprod = Yii::$app->cache->get($keyprod);
                $data[] = $dataprod['data'];
            }
            $statickey = Yii::$app->cache->buildKey('static' . $init_key_static);
            $stats = Yii::$app->cache->get($statickey);
            if (!$stats['data']) {
                $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id', 'products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')    and products.products_quantity > 0 and (products_image IS NOT NULL) and products_image != "/"  and products_status=1  and products_price <= :end_price and products_price >= :start_price  and products.manufacturers_id NOT IN (' . $hide_man . ')  ', $arfilt_attr)->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
                $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN (' . $cat . ') and products_status=1  and products.products_quantity > 0 ' . $prod_search_query_filt . $prod_attr_query_filt . '  and products_price <= :end_price  and (products_image IS NOT NULL) and products_image != "/"  and (products_description IS NOT NULL)  and products_price >= :start_price  and products.manufacturers_id NOT IN (' . $hide_man . ')', $arfilt)->groupBy(['products.`products_id` DESC'])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsDescription')->count();
                $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')  ' . $prod_search_query_filt . $prod_attr_query_filt . '  and products.products_quantity > 0     and (products_image IS NOT NULL) and products_image != "/"   and (products_description IS NOT NULL)  and products_status=1 and products.manufacturers_id NOT IN (' . $hide_man . ') ', $arfilt_pricemax)->JoinWith('productsAttributes')->JoinWith('productsDescription')->asArray()->one();
                $productattrib = ArrayHelper::index($productattrib, 'products_options_values_name');
                Yii::$app->cache->set($statickey, ['data' => ['productattrib' => $productattrib, 'count_arrs' => $count_arrs, 'price_max' => $price_max]], 86400);
            } else {
                $productattrib = $stats['data']['productattrib'];
                $count_arrs = $stats['data']['count_arrs'];
                $price_max = $stats['data']['price_max'];
            }
            Yii::$app->cache->set($key, ['productattrib' => $productattrib, 'data' => $data, 'count_arrs' => $count_arrs, 'price_max' => $price_max, 'checkcache' => $checkcache]);
        } else {
            $productattrib = $dataque['productattrib'];
            $count_arrs = $dataque['count_arrs'];
            $price_max = $dataque['price_max'];
            $data = $dataque['data'];
        }
        $count_arr = count($data);
        if ($start_arr + $count <= $count_arr) {
            $end_arr = $start_arr + $count;
        } else {
            $end_arr = $start_arr + $count_arr;
        }
        if (count($productattrib) > 0) {
        } else {
            $productattrib = 'none';
        }
        if ($price_max > 0) {
        } else {
            $price_max = 'none';
        }
        if (isset($data[0])) {
            if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                foreach ($data as $key => $dataval) {
                    $data[$key]['products']['products_price'] = intval($data[$key]['products']['products_price']) + (intval($data[$key]['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                }
            }
        } else {
            $data = 'Не найдено!';
        }
        $countfilt = count($data);
        $start = $start_arr;
        if (($json = intval(Yii::$app->request->post('json'))) == TRUE && $json == 1) {
            if (isset($data[0])) {
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                    foreach ($data as $key => $dataval) {
                        $data[$key]['products']['products_price'] = intval($data[$key]['products']['products_price']) + (intval($data[$key]['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                    }
                }

            } else {
                $data = 'Не найдено!';
            }
            if (isset($data[0])) {
                foreach ($data as $key => $dataval) {
                    if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                        $data[$key]['products']['products_price'] = intval($data[$key]['products']['products_price']) + (intval($data[$key]['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                    }
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

            $countfilt = count($data);
            $start = $start_arr;
            if ($count_arrs <= $count) {
                $data = 'Не найдено!';
            }
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [$data, $count_arrs, $price_max, $productattrib, $start, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword, $man_time];
        } else {
            $this->layout = 'catalog';
            if ($cat_start == 0) {
                $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
            } else {
                $catpath = $this->Catpath($cat_start, 'namenum');
            }
            //ksort($productattrib,'SORT_NATURAL' );
            Yii::$app->params['layoutset']['opencat'] = $catpath['num'];
            return $this->render('cataloggibrid', ['data' => [$data, $count_arrs, $price_max, $productattrib, $start, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword], 'catpath' => $catpath, 'man_time' => $man_time]);
        }
    }
}