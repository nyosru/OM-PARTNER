
    <div class="item-inner">
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
                            <button class="button btn-cart" type="button"><span>В корзину</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
