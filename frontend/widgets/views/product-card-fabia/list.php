<?php
use yii\bootstrap\Html;
?>
    <div class="product-image">
        <a href="product_detail.html" title="<?=$name?>">
            <div style="display: block;width: 100%;height: <?=$css['imageHeight']?>;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
        </a>
    </div>
    <div class="product-shop">
        <h2 class="product-name"><a href="<?=$product_link?>" title="<?=$name?>"><?=$name?></a></h2>
        <div class="desc std"><?=Html::encode($description['products_description'])?></div>
        <?=$this->render('_price',[
            'price' => $product['products_price'],
            'old_price' => $product['products_old_price'],
        ])?>
        <div class="actions">
            <button class="button btn-cart ajx-cart" title="В корзину" type="button"><span>В корзину</span></button>
            <span class="add-to-links">
                <a title="В избранное" class="button link-wishlist" href="wishlist.html"><span>В избранное</span></a>
            </span>
        </div>
    </div>
