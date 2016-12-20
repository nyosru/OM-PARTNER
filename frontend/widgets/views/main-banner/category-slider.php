<div class="category-description std">
    <div class="container">
        <div class="slider-items-products">
            <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col1 owl-carousel owl-theme">
                    <?php foreach ($banners as $banner) { ?>
                        <div class="item">
                            <a target="<?= $banner['out'] ? '_blank' : '_self' ?>"
                               href="<?= $banner['out'] ? $banner['referal'] : BASEURL . $banner['referal'] ?>">
                                <img src="/images/banners/<?= $banner['image'] ?>" alt="<?= $banner['alttext'] ?>">
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>