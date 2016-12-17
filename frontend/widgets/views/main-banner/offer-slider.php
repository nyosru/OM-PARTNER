<div class="offer-slider wow animated parallax parallax-2">
    <div class="container">
        <ul class="bxslider">
            <?php foreach ($banners as $banner) { ?>
                <li>
                    <h2><?=$banner['h2']?></h2>

                    <h1><?=$banner['h1']?></h1>

                    <p><?=$banner['p']?></p>
                    <a class="shop-now" target="<?= $banner['out'] ? '_blank' : '_self' ?>"
                       href="<?= $banner['out'] ? $banner['referal'] : BASEURL . $banner['referal'] ?>"><?=$banner['button']?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>