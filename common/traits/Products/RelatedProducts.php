<?php
namespace common\traits\Products;

use common\models\PartnersProductsToCategories;
use Yii;


trait RelatedProducts
{
    public function RelatedProducts($categories = 0, $count = 18 ,$cachekey='related-2377', $cachetime = 43200)
    {

        $key = Yii::$app->cache->buildKey($cachekey.'-'.$categories);
        $dataproducts = Yii::$app->cache->get($key);
        if (!$dataproducts) {
            $list = array();
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $hide_man = implode(',', $list);
        $now = date('Y-m-d H:i:s');

        $relProd = PartnersProductsToCategories::find()->where('products_to_categories.categories_id = :categories  and products_date_added < :now and products_last_modified < :now  and products.products_quantity > 0  and products.products_price != 0   and products_status=1 ', [':categories' => $categories, ':now' => $now])->joinWith('products')->groupBy('products_to_categories.products_id')->andWhere('products.manufacturers_id NOT IN (' . $hide_man . ')')->limit($count*3)->distinct()->asArray()->all();


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
                ->joinWith('products')->joinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->where('products.manufacturers_id NOT IN (' . $hide_man . ') and products_status=1  and products.products_quantity > 0 AND products_to_categories.products_id IN (' . $relstring . ')')->groupBy('products_to_categories.products_id')->limit($count)->distinct()->asArray()->all();
        }
            Yii::$app->cache->set($key, $dataproducts, $cachetime);
        }
        return $dataproducts;
    }

}

?>