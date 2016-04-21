<?php


foreach ($orderedproducts as $key=>$val) {
    echo \frontend\widgets\ProductCard::widget(['product' => $val, 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time]);
}