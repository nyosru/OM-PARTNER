<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 12.05.16
 * Time: 11:31
 */

namespace common\traits;

use common\models\PartnersProducts;
use common\models\PartnersProductsOptionVal;
use common\models\PartnersProductsToCategories;
use common\traits\Categories\CategoryChpu;
use php_rutils\RUtils;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseHtmlPurifier;
use yii\helpers\FileHelper;

trait AggregateCatalogData
{


    use CategoryChpu;
    public function AggregateCatalogData(
        $params = [
            'cat_start' => '',
            'start_price' => '',
            'end_price' => '',
            'prod_attr_query' => '',
            'count' => '',
            'page' => '',
            'sort' => '',
            'searchword' => '',
        ],
        $options = [
            'studio' => '',
            'sort_order' =>'',
            'disallowcat' => '',
            'allowcat' => [0],
            'discont' =>'',
            'ok' => '',
            'lux' => '',
            'date' => '',
            'typeresponse' => 'array',
            'maxtime' => '',
            'offsettime' => '',
            'cachelistkeyprefix' => 'catalog',
            'cacheproductkey' => 'productnew',
            'sfilt'=>[]
        ])
    {

        // init
        $cat_start = (integer)$params['cat_start'];
        if(isset(\Yii::$app->params['chpu']['cat_start']) && !Yii::$app->request->isAjax){
            $params['cat_start'] = $this->categoryChpu(\Yii::$app->params['chpu']['cat_start']);
        }
        if(isset(\Yii::$app->params['chpu']['page'])){
            $params['page'] = Yii::$app->params['chpu']['page'];
        }
        $integer = function($value) {
            return (integer)$value;
        };
        $cat_start = $params['cat_start'];
        $start_price = (integer)$params['start_price'];
        $end_price = (integer)$params['end_price'];
        $prod_attr_query = (integer)$params['prod_attr_query'];
        $count = (integer)$params['count'];
        $page = max(0,(integer)$params['page']-1);
        $sort = (integer)$params['sort'];
        $ok = (integer)$options['ok'];
        $lux = (integer)$options['lux'];
        $sfilt = array_map($integer, $options['sfilt']);
        $studio = $options['studio'];
        $discont = $options['discont'];
        $sort_order = FALSE;
        if($sfilt){
            $sfilt_part_key = '-'.md5(implode('',$sfilt));
            $sfilt = implode(',',$sfilt);
            $sfilt_query_filt = ' and products_specifications.specification_values_id IN ('.$sfilt.')';

        }else{
            $sfilt_part_key = '';
            $sfilt_query_filt = '';
        }
        $date = $options['date'];
        $maxtime = $options['maxtime'];
        $offsettime = $options['offsettime'];
        $searchword = BaseHtmlPurifier::process(urldecode(($params['searchword'])));
        if($cat_start == 0){
            $disallkey = '';
            $allowcat = $options['allowcat'];
            $disallowcat = $options['disallowcat'];

            if(is_array($allowcat)){
                $disallkey .= '-allow-'.implode(',', $allowcat);
            }
            if(is_array($disallowcat)){
                $disallkey .= '-disallow-'.implode(',', $disallowcat);
            }
            if($disallkey != ''){
                $disallkey = 'catcheck-'.md5($disallkey);
            }
        }else{
            $allowcat[] = $cat_start;
            $disallowcat = $options['disallowcat'];
        }

        $json = (integer)($options['typeresponse']);

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


        $count = min(200, $count);
        $count = max(20, $count);

        $start_arr = (integer)($page * $count);

        switch ($date) {
            case 'offset' :
                $now = date('Y-m-d H:i:s');
                $arfilt[':now'] = $now;
                $arfilt_pricemax[':now'] = $now;
                $arfilt_attr[':now'] = $now;
                $day = date('Y-m-d H:i:s');
                $d = new \DateTime($day);
                $d->modify($offsettime);
                $day = $d->format("Y-m-d H:i:s");
                $arfilt[':day'] = $day;
                $arfilt_pricemax[':day'] = $day;
                $arfilt_attr[':day'] = $day;
                $prod_day_query_filt = ' and products_date_added > :day';
                break;
            case 'param':
                $now = date('Y-m-d H:i:s', strtotime($maxtime));
                $arfilt[':now'] = $now;
                $arfilt_pricemax[':now'] = $now;
                $arfilt_attr[':now'] = $now;
                $day = date('Y-m-d H:i:s', strtotime($offsettime));
                $arfilt[':day'] = $day;
                $arfilt_pricemax[':day'] = $day;
                $arfilt_attr[':day'] = $day;
                $prod_day_query_filt = ' and products_date_added > :day';
                break;
            default:
                $now = date('Y-m-d H:i:s');
                $arfilt[':now'] = $now;
                $arfilt_pricemax[':now'] = $now;
                $arfilt_attr[':now'] = $now;
                $prod_day_query_filt = '';

        }

        $init_key = $options['cachelistkeyprefix'] . '3ty-' . Yii::$app->params['customcat'] .'-'. $cat_start . '-'  . '-' . $start_price . '-' . $end_price . '-' . $count . '-' . $page . '-' . $sort . '-' . $prod_attr_query . '-' . $searchword. $sfilt_part_key.'-'.$discont.'-'.$disallkey;
        $init_key_static = $options['cachelistkeyprefix'] . '3ty-' .Yii::$app->params['customcat'] .'-'. $cat_start . '-' . '-' . $start_price . '-' . $end_price . '-' . $prod_attr_query . '-' . $searchword. $sfilt_part_key.'-'.$discont.'-'.$disallkey;
        $key = Yii::$app->cache->buildKey($init_key);
        $dataque = Yii::$app->cache->get($key);
        // Отключаем пока таймаут проверки
//        if($dataque['checkcache']){
//            $datetime1 = new \DateTime($dataque['checkcache']);
//            $datetime2 = new \DateTime("now");
//            $interval = $datetime1->diff($datetime2);
//            $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
//        }else{
//            $minutes = 3;
//        }
        if(TRUE){//(!$dataque['checkcache']){ //|| $minutes >= 3){
            if (function_exists('pinba_tag_set')) {
                pinba_tag_set('cache-check', 'old');
            }

            //  print_r('с проверкой последнего апдейта');
            $static_cat_key = Yii::$app->cache->buildKey('static-cat-4-' .Yii::$app->params['customcat'].'-'. $cat_start . '-' . $options['cachelistkeyprefix'].$disallkey);
            if (($cat = Yii::$app->cache->get($static_cat_key)) == TRUE) {
                if (function_exists('pinba_tag_set')) {
                    pinba_tag_set('static-cat', 'in cache');
                }
            } else {
                $categoriesarr = $this->full_op_cat();
                $cat = $this->load_cat($categoriesarr['cat'], $cat_start, $categoriesarr['name'], $allowcat , $disallowcat);
                $cat = implode(',', $cat);
                Yii::$app->cache->set($static_cat_key, $cat, 3600);
            }
            if(!$cat){
                $cat = '0';
            }
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $hide_man = implode(',', $list);

            $x = PartnersProductsToCategories::find()
                ->select('MAX(products.`products_last_modified`) as products_last_modified')
                ->where('categories_id IN (' . $cat . ')')
                ->JoinWith('products')
                ->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ') ')
                ->andWhere('products_status = 1')
                ->andWhere('death_reason = ""')
                ->andWhere('products.products_quantity > 0 ')
                ->andWhere('products.products_price != 0')
                ->createCommand()
                ->queryOne();
            $checkcache = $x['products_last_modified'];
            $d1 = trim($checkcache);
            $d2 = trim($dataque['checkcache']);
            if (!$dataque['checkcache'] || $d1 !== $d2 ||$_GET['action'] == 'refresh') {
                if (function_exists('pinba_tag_set')) {
                    pinba_tag_set('cache-reload', $d1.'/'.$d2.'/'.$checkcache);
                }
                // date param


                // ok & lux params
                if($ok == TRUE || $lux == TRUE) {
                    $suppliers = [];
                    $luxsuppliers = [];
                    if ($ok == TRUE && $suppliers = $this->oksuppliers()) {
                        $manufacturers_query_filt = ' and products.manufacturers_id IN(' . implode(',', $suppliers) . ')';
                    }
                    if ($lux == TRUE &&  $luxsuppliers = $this->LuxSuppliers()) {
                        $manufacturers_query_filt = ' and products.manufacturers_id IN(' . implode(',', $luxsuppliers) . ')';
                    }
                    if ($ok == TRUE && $lux == TRUE && array_intersect($luxsuppliers, $suppliers)) {
                        $manufacturers_query_filt = ' and products.manufacturers_id IN(' . implode(',',array_intersect($luxsuppliers, $suppliers)) . ')';
                    }
                }else{
                    $manufacturers_query_filt = '';
                }


                //studio param
                if ($studio == TRUE) {
                    $studio_query_filt = ' and products.where_added = 1';
                } else {
                    $studio_query_filt = '';
                }

                //discont param
                if ($discont == TRUE) {
                    $discont_query_filt = ' and  products.products_old_price > 0  and  products.products_old_price > products.products_price ';
                } else {
                    $discont_query_filt = '';
                }

                if($sort_order == TRUE){
                    $default_order = ['products.sort_order'=> SORT_DESC, 'products_date_added' => SORT_DESC, 'products.products_id' => SORT_DESC];
                }else{
                    $default_order = ['products_date_added' => SORT_DESC, 'products.products_id' => SORT_DESC];
                }
                switch ($sort) {
                    case 0:
                        $order = $default_order;
                        break;
                    case 1:
                        $order = ['products.products_price' => SORT_ASC, 'products.products_id' => SORT_DESC];
                        break;
                    case 2:
                        $order = ['products_name' => SORT_ASC, 'products.products_id' => SORT_DESC];
                        break;
                    case 3:
                        $order = ['products_model' => SORT_ASC, 'products.products_id' => SORT_DESC];
                        break;
                    case 4:
                        $order = ['products_ordered' => SORT_ASC, 'products.products_id' => SORT_DESC];
                        break;
                    case 5:
                        $order = ['products_date_added' => SORT_DESC, 'products.products_id' => SORT_DESC];
                        break;
                    case 15:
                        $order = ['products_date_added' => SORT_ASC, 'products.products_id' => SORT_DESC];
                        break;
                    case 11:
                        $order = ['products.products_price' => SORT_DESC, 'products.products_id' => SORT_DESC];
                        break;
                    case 12:
                        $order = ['products_name' => SORT_DESC, 'products.products_id' => SORT_DESC];
                        break;
                    case 13:
                        $order = ['products_model' => SORT_DESC, 'products.products_id' => SORT_DESC];
                        break;
                    case 14:
                        $order = ['products_ordered' => SORT_DESC, 'products.products_id' => SORT_DESC];
                        break;
                }
                $hide_man = $this->hide_manufacturers_for_partners();
                foreach ($hide_man as $value) {
                    $list[] = $value['manufacturers_id'];
                }
                $hide_man = implode(',', $list);
                if ($prod_attr_query != '') {
                    $finderkey = Yii::$app->cache->buildKey('productattrfinder-' . $prod_attr_query);
                    if (($findue = Yii::$app->cache->get($finderkey)) == TRUE) {

                    } else {
                        $prod_attr_querys = PartnersProductsOptionVal::find()->where(['products_options_values_id' => (int)$prod_attr_query])->createCommand()->queryOne()['products_options_values_name'];
                        if (strlen($prod_attr_querys) == 2) {
                            $prodfilt = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $prod_attr_querys . ')[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';
                            $finder = PartnersProductsOptionVal::find()->where('LOWER(products_options_values_name) RLIKE :prod_attr_query ', [':prod_attr_query' => $prodfilt])->createCommand()->queryAll();
                            if (!$finder) {
                                $findue[] = $prod_attr_query;
                            }
                            foreach ($finder as $finderkey => $findervalue) {
                                $findue[] = $findervalue['products_options_values_id'];
                            }
                            foreach ($finder as $finderkey => $findervalue) {
                                Yii::$app->cache->set($findervalue['products_options_values_id'], $findue, 86400);
                            }
                        } else {
                            $findue[] = (int)$prod_attr_query;
                            Yii::$app->cache->set((int)$prod_attr_query, $findue, 86400);
                        }

                    }
                    $prod_attr_query_filt = ' and options_values_id IN (' . implode(',', $findue) . ')  and quantity > 0  IN (' . implode(',', $findue) . ') ';
                    // $arfilt[':prod_attr_query'] = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $prod_attr_query . ')[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';

                    // $arfilt_pricemax[':prod_attr_query'] = $prod_attr_query;


                } else {
                    $prod_search_query_filt = '';
                }
                if ($start_price > 0) {

                    $arfilt[':start_price'] = (int)$start_price;
                    $arfilt_pricemax[':start_price'] = (int)$start_price;
                    $arfilt_attr[':start_price'] = (int)$start_price;
                    $start_price_query_filt = '  and products.products_price > :start_price ';
                } else {
                    $start_price_query_filt = '';
                }
                if ($end_price < 1000001) {
                    $arfilt[':end_price'] = (int)$end_price;
                    $arfilt_pricemax[':end_price'] = (int)$end_price;
                    $arfilt_attr[':end_price'] = (int)$end_price;
                    $end_price_query_filt = '  and products.products_price <= :end_price ';
                } else {
                    $end_price_query_filt = '';
                }
                if ($searchword != '') {
                    if (preg_match('/^([\s]*([0-9]+[\s]*)+[\s]*)$/iu', $searchword)) {
                        $arfilt[':searchword'] = $arfilt_pricemax[':searchword'] = '%' . trim(str_replace(' ', '', $searchword)) . '%';
                        $prod_search_query_filt = '  and products.products_model LIKE :searchword ';
                        $nostat = true;
                        $nosfilt = true;
                    } elseif (preg_match('/^([\s]*([0-9a-zа-я\-\+\_]+[\s]*)+[\s]*)$/iu', $searchword)) {
                        $patternkey = 'patternsearch89-' . urlencode(trim($searchword));
                        $patterndata = Yii::$app->cache->get($patternkey);
                        if (!$patterndata) {
                            $valsearchin = explode(' ', $searchword);
                            $valsearchin = array_diff($valsearchin, array(''));
                            if (is_array($valsearchin)) {
                                foreach ($valsearchin as $search) {
                                    if ($search != '') {
                                        $valsearch[] = $this->sklonenie(trim($search));
                                    }
                                }
                                $valsearch = array_diff($valsearch, array(''));
                                $searchword = implode('|', $valsearch);

                            } else {
                                $searchword = $this->sklonenie(trim($searchword));
                            }
                            Yii::$app->cache->set($patternkey, ['data' => $searchword], 86400);
                        } else {
                            if (is_array($patterndata['data'])) {
                                $searchword = array_diff($patterndata['data'], array(''));
                                $searchword = implode('|', $searchword);
                            } else {
                                $searchword = explode(' ', $patterndata['data']);
                                $searchword = array_diff($searchword, array(''));
                                $searchword = implode('|', $searchword);
                            }
                        }
                        $arfilt[':searchword'] = $arfilt_pricemax[':searchword'] = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $searchword . ')[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';
                        $prod_search_query_filt = ' and (LOWER(products_description.products_name) RLIKE :searchword )';
                    }else{
                        $data = 'Не найдено!';
                        return ['data' => [$data]];
                    }
                    $nosfilt = true;
                } else {
                    $prod_search_query_filt = '';
                }
                $prod = PartnersProductsToCategories::find()->select('products.products_id as prod, products.products_price as price, products.products_last_modified as last, products_date_added as add_date,products_quantity as quantity ,products_model as model')->JoinWith('products')->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->joinWith('productsSpecification')->where('  categories_id IN (' . $cat . ') and products_status = 1  and  death_reason = "" ' . $prod_search_query_filt . $prod_attr_query_filt . $start_price_query_filt . $end_price_query_filt .  $studio_query_filt.$discont_query_filt. '  and  products.products_quantity > 0  and  products.products_price != 0  and products.manufacturers_id NOT IN (' . $hide_man . ') and products_date_added < :now and products_last_modified < :now' . $manufacturers_query_filt . $prod_day_query_filt . $sfilt_query_filt, $arfilt)->limit($count)->offset($start_arr)->distinct()->orderBy($order)->asArray()->all();
                $for_int = 0;
                foreach ($prod as $values) {
                    $keyprod = Yii::$app->cache->buildKey('productn-' . $values['prod']);
                    $dataprod = Yii::$app->cache->get($keyprod);
                    if($values['last'] != FALSE){
                        $lastset = $values['last'];
                    }else{
                        $lastset = $values['add_date'];
                    }
                    if ( $dataprod['data'] && $lastset == $dataprod['last'] && $values['quantity'] == $dataprod['quantity'] && $values['price'] == $dataprod['price']  && $values['model'] == $dataprod['model']) {
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

                        $valuesr['products']['season_code'] =  $spec_code;
                        $keyprod = Yii::$app->cache->buildKey('productn-' . $valuesr['products_id']);
                        Yii::$app->cache->set($keyprod, ['data' => $valuesr, 'last' => $last, 'quantity' => $valuesr['products']['products_quantity'], 'price' => $valuesr['products']['products_price'], 'model' => $valuesr['products']['products_model']], 86400);
                    }
                }
                foreach ($prod as $keyin => $values) {
                    $keyprod = Yii::$app->cache->buildKey('productn-' . $values['prod']);
                    $dataprod = Yii::$app->cache->get($keyprod);
                    $data[] = $dataprod['data'];
                }
                $statickey = Yii::$app->cache->buildKey('static2' . $init_key_static);
                $stats = Yii::$app->cache->get($statickey);
                $statickeyspec = Yii::$app->cache->buildKey('specification3554545sa-' . $cat_start);
                $statsspec = Yii::$app->cache->get($statickeyspec);
                if(!$statsspec) {
                    $spec = PartnersProductsToCategories::find()->select(['specification_values_description.specification_value', 'specification_values_description.specification_values_id', 'specification_description.specification_name', 'specification_description.specifications_id'])->where('categories_id IN (' . $cat . ')    and products.products_quantity > 0  and products.products_price != 0   and products_status=1 and  death_reason = "" and products.manufacturers_id NOT IN (' . $hide_man . ')  and specification_description.specifications_id IN (77,74,4119) ' )->joinWith('products')->joinWith('productsSpecification')->joinWith('specificationValuesDescription')->joinWith('specificationDescription')->groupBy('products_specifications.products_id')->distinct()->asArray()->all();
                    $spectotal = [];
                    foreach ($spec as $speckey => $specval) {
                        if (!$spectotal[$specval['specifications_id']]) {
                            $spectotal[$specval['specifications_id']]['name'] = $specval['specification_name'];
                        }
                        if (!$spectotal[$specval['specifications_id']]['dataset'][$specval['specification_values_id']]) {
                            $spectotal[$specval['specifications_id']]['dataset'][$specval['specification_values_id']] = $specval['specification_value'];
                        }
                    }
                    Yii::$app->cache->set($statickeyspec, ['data'=>$spectotal], 86400);
                    $spec = $spectotal;
                }else{
                    $spec = $statsspec['data'];
                }

                if (function_exists('pinba_tag_set')) {
                    pinba_tag_set('static-query', $nostat);
                }

                if (!is_array($stats['data']) && !$nostat ) {

                    if (function_exists('pinba_tag_set')) {
                        pinba_tag_set('static-reload', 'true');
                    }
                    $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id', 'products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')    and products.products_quantity > 0 and products.products_price != 0   and products_status=1 and  death_reason = "" ' . $start_price_query_filt . $end_price_query_filt . ' and products.manufacturers_id NOT IN (' . $hide_man . ')  and products_date_added < :now and products_last_modified < :now' . $manufacturers_query_filt . $studio_query_filt.$discont_query_filt. $prod_day_query_filt.$sfilt_query_filt, $arfilt_attr)->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->joinWith('productsSpecification')->asArray()->all();
                    $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN (' . $cat . ')  and products_status=1 and  death_reason = "" and products.products_price != 0  and products.products_quantity > 0 ' . $prod_search_query_filt . $prod_attr_query_filt . $start_price_query_filt . $end_price_query_filt . '  and products.manufacturers_id NOT IN (' . $hide_man . ') and products_date_added < :now and products_last_modified < :now' . $manufacturers_query_filt . $studio_query_filt.$discont_query_filt . $prod_day_query_filt.$sfilt_query_filt, $arfilt)->groupBy(['products.`products_id` DESC'])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsDescription')->joinWith('productsSpecification')->distinct()->count();
                    $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')  ' . $prod_search_query_filt . $prod_attr_query_filt . $start_price_query_filt . $end_price_query_filt . '  and products.products_quantity > 0  and products.products_price != 0     and products_status=1 and  death_reason = "" and products.manufacturers_id NOT IN (' . $hide_man . ')  and products_date_added < :now and products_last_modified < :now' . $manufacturers_query_filt . $studio_query_filt.$discont_query_filt . $prod_day_query_filt.$sfilt_query_filt, $arfilt_pricemax)->JoinWith('productsAttributes')->JoinWith('productsDescription')->joinWith('productsSpecification')->asArray()->one();
                    $productattrib = ArrayHelper::index($productattrib, 'products_options_values_name');
                    Yii::$app->cache->set($statickey, ['data' => ['productattrib' => $productattrib, 'spec'=>$spectotal, 'count_arrs' => $count_arrs, 'price_max' => $price_max]], 86400);
                } else {
                    $productattrib = $stats['data']['productattrib'];
                    $count_arrs = $stats['data']['count_arrs'];
                    $price_max = $stats['data']['price_max'];
                }
                Yii::$app->cache->set($key, ['productattrib' => $productattrib, 'data' => $data, 'spec'=>$spec,  'count_arrs' => $count_arrs, 'price_max' => $price_max, 'checkcache' => $checkcache], 86400);
            } else {
                //  print_r('с проверкой последнего апдейта из кэша');
                $cache = 'Kэш';
                $productattrib = $dataque['productattrib'];
                $count_arrs = $dataque['count_arrs'];
                $price_max = $dataque['price_max'];
                $data = $dataque['data'];
                $spec = $dataque['spec'];
            }
        }else{
            //  print_r('сквозной');
            $cache = 'Kэш';
            $productattrib = $dataque['productattrib'];
            $count_arrs = $dataque['count_arrs'];
            $price_max = $dataque['price_max'];
            $data = $dataque['data'];
            $spec = $dataque['spec'];
        }
        $man_time = $this->manufacturers_diapazon_id();

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
        if ($json == 1) {
            if (isset($data[0])) {
                if (isset(Yii::$app->params['partnersset']['discount']['value']) && Yii::$app->params['partnersset']['discount']['active'] == 1) {
                    foreach ($data as $key => $dataval) {
                        $data[$key]['products']['products_price'] = intval($data[$key]['products']['products_price']) + (intval($data[$key]['products']['products_price']) / 100 * intval(Yii::$app->params['partnersset']['discount']['value']));
                    }
                }
            } else {
                $data = 'Не найдено!';
            }
            if (is_array($data[0])) {
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
                            // $data[$key]['productsAttributes'][$keyattr]['options_values_price'],
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
            if ($count_arrs <= $count) {
                $data = 'Не найдено!';
            }
            return [$data, $count_arrs, $price_max, $productattrib, $start_arr, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword, $man_time, $spec];
        } else {
            $this->layout = 'catalog';
            if ($cat_start == 0) {
                $catpath = ['num' => ['0' => 0], 'name' => ['0' => 'Каталог']];
            } else {
                $catpath = $this->Catpath($cat_start, 'namenum');
            }
            //ksort($productattrib,'SORT_NATURAL' );
            Yii::$app->params['layoutset']['opencat'] = $catpath['num'];
            $page = $page+1;
            return ['data' => [$data, $count_arrs, $price_max, $productattrib, $start_arr, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword], 'catpath' => $catpath, 'man_time' => $man_time, 'spec'=>$spec, 'params'=>array_merge($options,$params)];
        }
    }
}
