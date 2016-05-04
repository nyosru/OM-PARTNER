<?php
//echo '<pre>';
//print_r($pagination);
//echo '<pre>';
//die();

echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div><div style="overflow: hidden">';
if($_COOKIE['cardview']==1) {
    foreach ($orderedproducts as $val) {
        echo \frontend\widgets\ProductCard2::widget(['product' => $val, 'description' => $val->productsDescription, 'attrib' => $val->productsAttributes, 'attr_descr' => $val->productsAttributesDescr, 'catpath' => $catpath, 'man_time' => $man_time]);
    }
}else{
    foreach ($orderedproducts as $val) {
        echo \frontend\widgets\ProductCard::widget(['product' => $val, 'description' => $val->productsDescription, 'attrib' => $val->productsAttributes, 'attr_descr' => $val->productsAttributesDescr, 'catpath' => $catpath, 'man_time' => $man_time]);
    }
}
echo '</div><div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
?>

