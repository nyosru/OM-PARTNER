<?php
//echo '<pre>';
//print_r($pagination);
//echo '<pre>';
//die();

echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div><div style="overflow: hidden">';
foreach ($orderedproducts as $val) {
    echo \frontend\widgets\ProductCard::widget(['product' => $val, 'description' => $val->productsDescription, 'attrib' => $val->productsAttributes, 'attr_descr' => $val->productsAttributesDescr, 'catpath' => $catpath, 'man_time' => $man_time]);
}
echo '</div><div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
?>
<div id="modal-product" style="border:none; min-height: 300px;">
    <span id="modal-close"><i class="fa fa-times"></i></span>
</div>
<div id="overlay"></div>
