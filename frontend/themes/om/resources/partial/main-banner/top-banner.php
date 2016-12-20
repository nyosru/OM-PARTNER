<div class="top-banner-section">
    <div class="container">
        <div class="row">
            <?php foreach ($banners as $banner) { ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow bounceup animated">
                    <div class="col">
                        <a target="<?= $banner['out'] ? '_blank' : '_self' ?>"
                            href="<?= $banner['out'] ? $banner['referal'] : BASEURL . $banner['referal'] ?>">
                            <img src="/images/banners/<?= $banner['image'] ?>" alt="<?= $banner['alttext'] ?>">
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>