<?php
//echo '<pre>';
//print_r($pagination);
//echo '<pre>';
//die();

$this->title=$title;

echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div><div style="overflow: hidden">';
if($_COOKIE['cardview']==1) {
    foreach ($orderedproducts as $val) {
        echo \frontend\widgets\ProductCard2::widget(['product' => $val, 'description' => $val->productsDescription, 'attrib' => $val->productsAttributes, 'attr_descr' => $val->productsAttributesDescr, 'catpath' => $catpath,'category'=>$value['categories_id'], 'man_time' => $man_time, 'showdiscount'=>1]);
    }
}else{
    foreach ($orderedproducts as $val) {
        echo \frontend\widgets\ProductCard::widget(['product' => $val, 'description' => $val->productsDescription, 'attrib' => $val->productsAttributes, 'attr_descr' => $val->productsAttributesDescr, 'catpath' => $catpath, 'category'=>$value['categories_id'], 'man_time' => $man_time, 'showdiscount'=>1]);
    }
}
echo '</div><div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
?>

