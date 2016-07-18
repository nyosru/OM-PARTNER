<?php
namespace common\traits\Products;

use common\models\PartnersProductsToCategories;
use Yii;


trait RelatedProducts
{
    public function RelatedProducts($categories = 0, $count = 180,$cachekey='related', $cachetime = 7200)
    {

        $key = Yii::$app->cache->buildKey($cachekey.'-'.$categories);
        $relroducts = Yii::$app->cache->get($key);
        if (!$relroducts) {

            $list = array();
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $hide_man = implode(',', $list);
        $now = date('Y-m-d H:i:s');

        $relProd = PartnersProductsToCategories::find()->where('products_to_categories.categories_id = :categories  and products_date_added < :now and products_last_modified < :now  and products.products_quantity > 0  and products.products_price != 0   and products_status=1 ', [':categories' => $categories, ':now' => $now])->joinWith('products')->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ')')->limit(180)->asArray()->all();

        if ($relProd) {
            $relnum = array_rand($relProd, min(60, count($relProd)));

            $relProd1 = array();
            if (is_array($relnum)) {
                foreach ($relnum as $item) {
                    $relProd1[] = $relProd[$item]['products_id'];
                }
                $relstring = implode(',', $relProd1);
            } else {
                $relstring = $relProd[$relnum]['products_id'];
            }
            $dataproducts = PartnersProductsToCategories::find()
                ->joinWith('products')->joinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where('products.manufacturers_id NOT IN (' . $hide_man . ') and products_status=1  and products.products_quantity > 0 AND products_to_categories.products_id IN (' . $relstring . ')')->limit($count)->asArray()->all();
            $relProd = [];
            foreach ($dataproducts as $key => $value) {

                $relProd[$key]['products_name'] = $value['productsDescription']['products_name'];
                $relProd[$key]['products_price'] = $value['products']['products_price'];
                $relProd[$key]['products_image'] = $value['products']['products_image'];
                $relProd[$key]['products_id'] = $value['products_id'];
            }
            $dataproducts = $relProd;
        }
            Yii::$app->cache->set($key, $relProd, $cachetime);
        }
        return $dataproducts;
    }

}

?>