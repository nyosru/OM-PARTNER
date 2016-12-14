<li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">
    <div class="item-inner">
        <div class="item-img">
            <div class="item-img-info">
                <a class="product-image" title="<?=$name?>" href="<?=$product_link?>">
                    <div style="display: block;width: 100%;height: 386px;background: center no-repeat  /contain url('<?=$main_image?>')"></div>
                </a>
                <div class="new-label new-top-left">new</div>
                <div class="sale-label">Sale</div>
                <a class="quickview-btn" href=""><span>Quick View</span></a>
            </div>
        </div>
        <div class="item-info">
            <div class="info-inner">
                <div class="item-title"> <a title="<?=$name?>" href="<?=$product_link?>"><?=$name?></a> </div>
                <div class="item-content">
                    <div class="rating">
                        <div class="ratings">
                            <div class="rating-box">
                                <div class="rating"></div>
                            </div>
                            <p class="rating-links"> <a href="#">1 Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
                        </div>
                    </div>
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
                    <div class="actions"><a href="wishlist.html" class="link-wishlist" title="Add to Wishlist"></a>
                        <div class="add_cart">
                            <button class="button btn-cart" type="button"><span>Add to Cart</span></button>
                        </div>
                        <a href="compare.html" class="link-compare" title="Add to Compare"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>