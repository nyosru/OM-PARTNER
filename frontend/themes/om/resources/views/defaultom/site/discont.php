<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title='Распродажа';
$data[0] = $products;

if($_COOKIE['cardview']==1){
    foreach ($data[0] as $value) {
        echo \frontend\widgets\ProductCard2::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'category'=>$value['categories']['categories_id'], 'catpath'=>$catpath, 'man_time'=>$man_time, 'showdiscount'=>1]);
    }
}else {
    foreach ($data[0] as $value) {
        echo \frontend\widgets\ProductCard::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'category'=>$value['categories']['categories_id'],'catpath'=>$catpath, 'man_time'=>$man_time, 'showdiscount'=>1]);
    }
}
echo '<div class="col-md-12">'.\yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
    ]).'<div>';