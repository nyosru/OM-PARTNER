<?php
use yii\bootstrap\Html;
?>
<li class="item even">
    <div class="product-image"> <a href="product_detail.html" title="<?=$name?>">
            <div style="display: block;width: 100%;height: 300px;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
    </div>
    <div class="product-shop">
        <h2 class="product-name"><a href="<?=$product_link?>" title="<?=$name?>"><?=$name?></a></h2>
        <div class="desc std"><?=Html::encode($description['products_description'])?></div>
        <?php if((integer)($product['products_old_price'])){ ?>
            <div class="price-box">
                <p class="old-price">
                    <span class="price-label"></span>
                    <span class="price"><?=round($product['products_price'])?> р.</span>
                </p>
                <p class="special-price">
                    <span class="price-label"></span>
                    <span class="price"><?=round($product['products_old_price'])?> р.</span>
                </p>
            </div>
        <?php } else { ?>
            <div class="price-box">
            <span class="regular-price">
                <span class="price"><?=round($product['products_price'])?> р.</span>
            </span>
            </div>
        <?php } ?>
        <div class="actions">
            <button class="button btn-cart ajx-cart" title="Add to Cart" type="button"><span>Add to Cart</span></button>
            <span class="add-to-links"> <a title="Add to Wishlist" class="button link-wishlist" href="wishlist.html"><span>Add to Wishlist</span></a> <a title="Add to Compare" class="button link-compare" href="compare.html"><span>Add to Compare</span></a> </span> </div>
    </div>
</li>