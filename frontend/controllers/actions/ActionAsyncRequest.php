<?
namespace frontend\controllers\actions;

use common\models\PartnersProductsToCategories;
use Yii;

trait ActionAsyncRequest
{
    public function actionAsyncproductppdate()
    {
        $sort = Yii::$app->request->post('sort');
        $start_price = Yii::$app->request->post('start_price');
        $end_price = Yii::$app->request->post('end_price');
        $prod_attr_query = Yii::$app->request->post('prod_attr_query');
        $searchword = Yii::$app->request->post('searchword');
        $cat = Yii::$app->request->post('cat');
        $init_key_static = Yii::$app->request->post('init_key_static');
        $key = Yii::$app->request->post('key');
        $start_arr = Yii::$app->request->post('start_arr');
        $checkcache = Yii::$app->request->post('checkcache');
        $count = Yii::$app->request->post('count');
        if ($async = true) {
            fastcgi_finish_request();
        }
        switch ($sort) {
            case 0:
                $order = ['products_date_added' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                break;
            case 1:
                $order = ['products_price' => SORT_ASC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
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
                $order = ['products_date_added' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
                break;
            case 11:
                $order = ['products_price' => SORT_DESC, 'products.products_id' => SORT_ASC, 'products_options_values_name' => SORT_ASC];
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
            $prod_attr_query_filt = ' and options_values_id = :prod_attr_query ';
            $arfilt[':prod_attr_query'] = $prod_attr_query;
            $arfilt_pricemax[':prod_attr_query'] = $prod_attr_query;
        } else {
            $prod_search_query_filt = '';
        }
        if ($searchword != '') {
            if (preg_match('/^[0-9]+$/', $searchword)) {
                $arfilt[':searchword'] = $searchword;
                $arfilt_pricemax[':searchword'] = $searchword;
                $prod_search_query_filt = '  and products.products_model=:searchword ';
            } elseif (preg_match('/^[a-z�-� ]+$/iu', $searchword)) {
                $patternkey = 'pattern-' . urlencode($searchword);
                $patterndata = Yii::$app->cache->get($patternkey);
                if (!$patterndata) {
                    $valsearchin = explode(' ', $searchword);
                    if (count($valsearchin) > 1) {
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
                    $searchword = $patterndata['data'];
                }

                $arfilt[':searchword'] = $arfilt_pricemax[':searchword'] = '([\ \_\(\)\,\-\.\'\\\;\:\+\/\"?]|^)+(' . $searchword . ')(���|���|��|��|��|��|��|��|��|��|��|��|��|�|�|�|�|�|�|�|�)*[\ \_\(\)\,\-\.\'\\\;\:\+\/\"]*';
                $prod_search_query_filt = ' and  LOWER(products_description.products_name) RLIKE :searchword ';
            }
        } else {
            $prod_search_query_filt = '';
        }


        $prod = PartnersProductsToCategories::find()->select('products.products_id as prod,  products.products_last_modified as last ')->JoinWith('products')->where('  categories_id IN (' . $cat . ') and (products_status = 1) ' . $prod_search_query_filt . $prod_attr_query_filt . ' and (products_image IS NOT NULL) and (products_description IS NOT NULL) and ( products.products_quantity > 0 )  and (products_price <= :end_price) and (products_price >= :start_price)  and (products.manufacturers_id NOT IN (' . $hide_man . '))', $arfilt)->limit($count)->offset($start_arr)->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->distinct()->orderBy($order)->asArray()->all();
        foreach ($prod as $values) {
            $keyprod = Yii::$app->cache->buildKey('product-' . $values['prod']);
            $dataprod = Yii::$app->cache->get($keyprod);
            $d1 = new \DateTime();
            $d1->setTimestamp(strtotime(trim($values['last'])));
            $d2 = new \DateTime();
            $d2->setTimestamp(strtotime(trim($dataprod['last'])));
            $diff = $d2->diff($d1);
            $marker = $diff->y + $diff->m + $diff->d + $diff->h;
            if (isset($dataprod['data']) && $marker == 0 && $diff->i < 30) {
                $data[] = $dataprod['data'];
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
                $data[] = $valuesr;
            }

        }
        $statickey = Yii::$app->cache->buildKey('static' . $init_key_static);
        $stats = Yii::$app->cache->get($statickey);
        if (!isset($stats['data'])) {
            $productattrib = PartnersProductsToCategories::find()->select(['products_options_values.products_options_values_id', 'products_options_values.products_options_values_name'])->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')    and products.products_quantity > 0 and (products_image IS NOT NULL)  and products_status=1  and products_price <= :end_price and products_price >= :start_price  and products.manufacturers_id NOT IN (' . $hide_man . ')  ', $arfilt_attr)->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
            $count_arrs = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id IN (' . $cat . ') and products_status=1  and products.products_quantity > 0 ' . $prod_search_query_filt . $prod_attr_query_filt . '  and products_price <= :end_price  and (products_image IS NOT NULL)  and (products_description IS NOT NULL)  and products_price >= :start_price  and products.manufacturers_id NOT IN (' . $hide_man . ')', $arfilt)->groupBy(['products.`products_id` DESC'])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsDescription')->count();
            $price_max = PartnersProductsToCategories::find()->select('MAX(`products_price`) as maxprice')->distinct()->JoinWith('products')->where('categories_id IN (' . $cat . ')  ' . $prod_search_query_filt . $prod_attr_query_filt . '  and products.products_quantity > 0     and (products_image IS NOT NULL)   and (products_description IS NOT NULL)  and products_status=1 and products.manufacturers_id NOT IN (' . $hide_man . ') ', $arfilt_pricemax)->JoinWith('productsAttributes')->JoinWith('productsDescription')->asArray()->one();
            Yii::$app->cache->set($statickey, ['data' => ['productattrib' => $productattrib, 'count_arrs' => $count_arrs, 'price_max' => $price_max]], 86400);
        } else {
            $productattrib = $stats['data']['productattrib'];
            $count_arrs = $stats['data']['count_arrs'];
            $price_max = $stats['data']['price_max'];
        }
        Yii::$app->cache->set($key, ['productattrib' => $productattrib, 'data' => $data, 'count_arrs' => $count_arrs, 'price_max' => $price_max, 'checkcache' => $checkcache]);

        return [$data, $productattrib, $count_arrs, $price_max];
    }
}


?>