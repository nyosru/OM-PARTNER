<?php
namespace common\traits\Products;

use common\models\Featured;
use common\models\PartnersProductsToCategories;
use Yii;


trait FeaturedProducts
{
    public function FeaturedProducts($limit = 54, $cachekey = 'index_optional-1388', $cachetime = 300)
    {
        $key = Yii::$app->cache->buildKey($cachekey);
        $dataproducts = Yii::$app->cache->get($key);
        if (!$dataproducts) {
            $list = array();
            $hide_man = $this->hide_manufacturers_for_partners();
            foreach ($hide_man as $value) {
                $list[] = $value['manufacturers_id'];
            }
            $hide_man = implode(',', $list);
            $featured = Featured::find()->select('products_id')->limit($limit)->distinct()->createCommand()->queryAll();

            foreach ($featured as $featuredkey => $featuredvalue) {
                $featuredproduct[] = $featuredvalue['products_id'];

            }

            $cat = $this->RestrictedCatalog();
            $nocat = implode(',', $cat);
            $products = implode(',', $featuredproduct);
            $dataproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id NOT IN (' . $nocat . ') and products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ')  and products.products_id IN (' . $products . ')')->groupBy('products_to_categories.products_id')->JoinWith('productsDescription')->JoinWith('productsAttributes')->distinct()->limit((integer)$limit)->JoinWith('productsAttributesDescr')->asArray()->all();
            shuffle($dataproducts);
            Yii::$app->cache->set($key, $dataproducts, $cachetime);
        }
        return $dataproducts;
    }
}

?>