<?php
use yii\bootstrap\Html;
?>
<div class="product-image">
    <a href="product_detail.html" title="<?=$name?>">
        <div style="display: block;width: 100%;height: <?=$css['imageHeight']?>;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
    </a>
</div>
<div class="product-shop catalog-product-item">
    <h2 class="product-name"><a href="<?=$product_link?>" title="<?=$name?>"><?=$name?></a></h2>
    <div class="desc std"><?=Html::encode($description['products_description'])?></div>

    <div class="product-variants clearfix">
        <hr>
        <?=$this->render('_variants',['sizes'=>$sizes])?>
    </div>
    <?=$this->render('_price',[
        'price' => $product['products_price'],
        'old_price' => $product['products_old_price'],
    ])?>
    <div class="actions">
        <button class="button btn-cart ajx-cart cart-lable" data-sale="<?=$product['products_id']?>" title="В корзину" type="button"><span>В корзину</span></button>
            <span class="add-to-links">
                <?php if($favorites){ ?>
                    <a class="btn del-products" title="Удалить" data-product="<?=$product['products_id']?>" href="#" style="color: #ffffff;border-color: #ffffff;"><span>Удалить</span></a>
                <?php } else { ?>
                    <a title="В избранное" class="button link-wishlist selected-product" data-product="<?=$product['products_id']?>" href="#"><span>В избранное</span></a>
                <?php } ?>
            </span>
    </div>
</div>
