<?php
namespace frontend\controllers\actions\om;


use Yii;
use common\models\PartnersProductsToCategories;

trait ActionSiteIndex
{
    public function actionIndex()
    {
        $list = array();
        $hide_man = $this->hide_manufacturers_for_partners();
        foreach ($hide_man as $value) {
            $list[] = $value['manufacturers_id'];
        }
        $hide_man = implode(',', $list);
        $products = '960192894,95833167,95848445,960505788,960503142,960511458';
        $key = Yii::$app->cache->buildKey('index_optional-1');
        $dataproducts = Yii::$app->cache->get($key);
        if (!$dataproducts) {
            $dataproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ')  and products.products_model IN (' . $products . ')')->JoinWith('productsDescription')->JoinWith('productsAttributes')->limit(10)->distinct()->JoinWith('productsAttributesDescr')->asArray()->all();
            Yii::$app->cache->set($key, $dataproducts, 400);
        }

        $key = Yii::$app->cache->buildKey('index_new');
        $newproducts = Yii::$app->cache->get($key);
        if (!$newproducts) {
            $newproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ') ')->JoinWith('productsDescription')->JoinWith('productsAttributes')->distinct()->limit(6)->JoinWith('productsAttributesDescr')->orderBy('`products_date_added` DESC')->asArray()->all();
            Yii::$app->cache->set($key, $newproducts, 400);
        }
        if(isset(Yii::$app->params['partnersset']['slogan']['value']) && Yii::$app->params['partnersset']['slogan']['active'] == 1){
            $title = $this->trim_tags_text(Yii::$app->params['partnersset']['slogan']['value']);
        }else{
            $title = Yii::$app->params['constantapp']['APP_NAME'];
        }
        return $this->render('indexpage', ['dataproducts' => $dataproducts, 'newproducts' => $newproducts, 'title'=>$title]);
    }
}
?>