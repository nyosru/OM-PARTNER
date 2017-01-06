<?php
$class = (int)$_COOKIE['cardview'] == 1 ? 'item even':'item col-lg-4 col-md-3 col-sm-4 col-xs-6';

echo '<li class="'.$class.'" data-product="'.$model['products']["products_id"].'">';
echo \frontend\widgets\ProductCardFabia::widget([
    'template'=>(int)$_COOKIE['cardview'] == 1?'list':'grid',
    'product'=>$model['products'],
    'description'=>$model['productsDescription'],
    'attrib'=>$model['productsAttributes'],
    'attr_descr'=>$model['productsAttributesDescr'],
    'catpath'=>$catpath,
    'man_time'=>$man_time,
    'category'=>$model['categories_id'],
    'favorites'=> 1,
]);
echo '</li>';

?>
