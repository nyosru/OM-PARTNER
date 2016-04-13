<?php
$this->title = $product['productsDescription']['products_name'];
$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
$prodinfoattr='';
//if (count($product['productsAttributesDescr']) > 0) {
//    foreach ($product['productsAttributesDescr'] as $item) {
//        $date = $product['products.products_date_added'];
//        $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px;"><div>' . $item['products_options_values_name'] . '</div><input id="input-count" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
//            $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $item['products_options_values_name'] . '" data-attr="' . $item['products_options_values_id'] .
//            '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
//    }
//    $prodinfoattr .= '<div class="cart-lable" style="bottom: auto; right: 50px; left: 70%;">В корзину</div>';
//} else {
//    $date = $product['products']['products_date_added'];
//    $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px;"><input id="input-count" data-prod="' . $product['products.products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
//        $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $products['products_attribute_description']['products_options_values_name'] .
//        '" data-attr="' . $products['products_attribute_description']['products_options_values_id'] . '" type="text" placeholder="Количество" /><div id="add-count">+</div><div id="del-count">-</div></div>';
//    $prodinfoattr .= '<div class="cart-lable" style="bottom: auto; right: 50px; left: 70%;">В корзину</div>';
//}
$prodinfoattr2='';
if (count($product['productsAttributesDescr']) > 0) {
    foreach ($product['productsAttributesDescr'] as $item) {
        $date = $product['products.products_date_added'];
        $prodinfoattr2 .= '<div class="size-desc"><div><div class="lable-item" id="input-count" data-prod="' . $product['products']['products_id'] .
            '" data-model="' . $product['products']['products_model'] .
            '" data-price="' . $product['products']['products_price'] .
            '" data-image="' . $product['products']['products_image'] .
            '" data-attrname="' . $item['products_options_values_name'] .
            '" data-attr="' . $item['products_options_values_id'] .'">'. $item['products_options_values_name'] . '</div></div></div>';
    }
} else {
    $date = $product['products']['products_date_added'];
    $prodinfoattr2 .= '<div class="size-desc"><div><div class="lable-item" id="input-count" data-prod="' . $product['products.products_id'] .
        '" data-model="' . $product['products']['products_model'] .
        '" data-price="' . $product['products']['products_price'] .
        '" data-image="' . $product['products']['products_image'] .
        '" data-attrname="' . $products['products_attribute_description']['products_options_values_name'] .
        '" data-attr="' . $products['products_attribute_description']['products_options_values_id'] . '" >В корзину</div></div></div>';

}
?>
<div class="cart-image"
     style="float: left; max-height: 300px; max-width: 300px; min-height: 300px; min-width: 300px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=<?= $product['products']['products_image'] ?>);"></div>
<div class="prod-info-name"> <?= $product['productsDescription']['products_name'] ?></div>
<div class="prod-info-price"><b><?= (integer)($product['products']['products_price']) ?></b> Руб.</div>
<div class="prod-info-model">Артикул: <?= $product['products']['products_model'] ?></div>
<div class="prod-info-date">Добавлен:<?= $product['products']['products_date_added'] ?></div>
<div class="prod-info-desc">Описание: <?= $product['productsDescription']['products_description'] ?></div>

<div class="prod-info-size"><?= str_replace('нет','В корзину',$prodinfoattr2)  ?>
</div>
<div class="prod-info-soc-but" style="display: none">Поделиться</div>
<div style="z-index: 1060" class="modal bs-example-modal-lg image" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="text-align: center;"><img id="image-img" src="http://odezhda-master.ru/images/<?= $product['products']['products_image'] ?>"/>
        </div>
    </div>
</div>
<div class="col-md-12"
     style="margin-top:40px"><?= \frontend\widgets\CommentsBlock::widget(['category' => 1, 'relateID' => $product['products']['products_id']]) ?></div>