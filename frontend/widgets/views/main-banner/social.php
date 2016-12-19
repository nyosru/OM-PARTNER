<section class="latest-blog">
    <div class="container">
        <div class="new_title center">
            <h2>Мы в социальных сетях</h2>
        </div>
        <div class="row">
            <?php foreach ($banners as $banner) { ?>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                    <div class="blog_inner">
                        <a class="blog-img" target="_blank" href="<?= $banner['referal'] ?>">
                            <img src="/images/banners/<?= $banner['image'] ?>" alt="<?= $banner['alttext'] ?>">
                            <div class="mask"></div>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>