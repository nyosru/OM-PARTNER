<?php
namespace frontend\controllers\actions\om;


use common\models\Featured;
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
        $featured = Featured::find()->select('products_id')->limit(60)->createCommand()->queryAll();
        foreach($featured as $featuredkey => $featuredvalue){
            $featuredproduct[] = $featuredvalue['products_id'];

        }
         $man_time = $this->manufacturers_diapazon_id();
        $catpath = ['num'=>['0' => 0], 'name'=>['0' =>'Каталог']];
        $products = implode(',',$featuredproduct);
        $key = Yii::$app->cache->buildKey('index_optional-1534562344567');
        $dataproducts = Yii::$app->cache->get($key);
        if (!$dataproducts) {
            $dataproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ')  and products.products_id IN (' . $products . ')')->JoinWith('productsDescription')->JoinWith('productsAttributes')->limit(60)->distinct()->JoinWith('productsAttributesDescr')->asArray()->all();
            Yii::$app->cache->set($key, $dataproducts, 7200);
        }

        $key = Yii::$app->cache->buildKey('index_new-34532445');
        $newproducts = Yii::$app->cache->get($key);
        if (!$newproducts) {
            $newproducts = PartnersProductsToCategories::find()->JoinWith('products')->where('products_status=1  and products.products_quantity > 0    and products.manufacturers_id NOT IN (' . $hide_man . ') ')->JoinWith('productsDescription')->JoinWith('productsAttributes')->distinct()->limit(60)->JoinWith('productsAttributesDescr')->orderBy('`products_date_added` DESC')->asArray()->all();
            Yii::$app->cache->set($key, $newproducts, 7200);
        }
        if(isset(Yii::$app->params['partnersset']['slogan']['value']) && Yii::$app->params['partnersset']['slogan']['active'] == 1){
            $title = $this->trim_tags_text(Yii::$app->params['partnersset']['slogan']['value']);
        }else{
            $title = Yii::$app->params['constantapp']['APP_NAME'];
        }
        return $this->render('indexpage', ['dataproducts' => $dataproducts, 'newproducts' => $newproducts, 'title'=>$title, 'man_time'=>$man_time, 'catpath'=>$catpath]);
    }
}
?>