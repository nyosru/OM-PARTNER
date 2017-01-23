<?php foreach ($banners as $banner) { ?>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="col">
            <a  target="<?= $banner['out'] ? '_blank' : '_self' ?>"
                href="<?= $banner['out'] ? $banner['referal'] : BASEURL . $banner['referal'] ?>">
                <img src="<?= $path_image . $banner['image'] ?>" alt="<?= $banner['alttext'] ?>">
            </a>
        </div>
    </div>
<?php } ?>
