<?php
namespace common\traits\Products;

use common\models\PartnersProductsToCategories;
use Yii;


trait NewProducts
{
    public function NewProducts($limit = 60, $cachekey = 'index_new-35', $cachetime = 7200)
    {
        $key = Yii::$app->cache->buildKey($cachekey);
        $newproducts = Yii::$app->cache->get($key);
        if (!$newproducts) {
        $list = array();
        $hide_man = $this->hide_manufacturers_for_partners();
        foreach ($hide_man as $value) {
            $list[] = $value['manufacturers_id'];
        }
        $hide_man = implode(',', $list);
        $cat = $this->RestrictedCatalog();
        $nocat = implode(',', $cat);

            $newproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('categories_id NOT IN (' . $nocat . ') and products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ') ')->JoinWith('productsDescription')->JoinWith('productsAttributes')->distinct()->limit($limit)->JoinWith('productsAttributesDescr')->orderBy('`products_date_added` DESC')->asArray()->all();
            Yii::$app->cache->set($key, $newproducts, $cachetime);
        }
        return $newproducts;
    }
}

?>