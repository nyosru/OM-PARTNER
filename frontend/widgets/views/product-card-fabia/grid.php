<?php
use yii\helpers\ArrayHelper;
?>
    <div class="item-inner catalog-product-item" data-id="<?=$product['products_id']?>">
        <div class="item-img">
            <div class="item-img-info">
                <a class="product-image" title="<?=$name?>" href="<?=$product_link?>">
                    <div style="display: block;width: 100%;height: <?=$css['imageHeight']?>;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
                </a>
                <a class="quickview-btn" href=""><span>Quick View</span></a>
            </div>
        </div>
        <div class="item-info">
            <div class="info-inner">
                <div class="item-title"> <a title="<?=$name?>" href="<?=$product_link?>"><?=$name?></a> </div>
                <div class="item-content">
                    <?php if($sizes['isset_variants']){ ?>
                        <div class="product-sizes">
                            <span>Доступные размеры</span>
                            <div class="product-sizes-list"><?=implode('&nbsp;&nbsp;',ArrayHelper::getColumn($sizes['sizes'],'label'))?></div>
                        </div>
                    <?php } ?>
                    <?=$this->render('_price',[
                        'price' => $product['products_price'],
                        'old_price' => $product['products_old_price'],
                    ])?>
                    <div class="actions">
                        <?php if($favorites){ ?>
                            <a class="glyphicon glyphicon-remove del-products" title="Удалить" data-product="<?=$product['products_id']?>" href="#"></a>
                        <?php } else { ?>
                            <a class="link-wishlist selected-product" title="В избранное" data-product="<?=$product['products_id']?>" href="#"></a>
                        <?php } ?>
                        <div class="add_cart">
                            <button class="button btn-cart" data-sale="<?=$product['products_id']?>" type="button"><span>В корзину</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hover-variants">
            <?=$this->render('_variants',['sizes'=>$sizes])?>
            <div class="catalog-price"><span>0</span> р.</div>
        </div>
    </div>
