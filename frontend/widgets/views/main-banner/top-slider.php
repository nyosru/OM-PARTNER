<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
        <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container'>
            <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                <ul>
                    <?php foreach ($banners as $banner) { ?>
                    <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='/images/banners/<?= $banner['image'] ?>'>
                        <img src="/images/banners/<?= $banner['image'] ?>" alt="<?= $banner['alttext'] ?>"  data-bgposition='left top' data-bgfit='cover' data-bgrepeat='no-repeat'>
                        <a href="<?=$banner['referal']?>">
                        </a>
                        <!--
                        <div class="info">
                            <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0' data-y='165'
                                 data-endspeed='500' data-speed='500' data-start='1100' data-easing='Linear.easeNone'
                                 data-splitin='none' data-splitout='none' data-elementdelay='0.1'
                                 data-endelementdelay='0.1'
                                 style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;'>
                                <span>New Season</span></div>
                            <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0' data-y='220'
                                 data-endspeed='500' data-speed='500' data-start='1300' data-easing='Linear.easeNone'
                                 data-splitin='none' data-splitout='none' data-elementdelay='0.1'
                                 data-endelementdelay='0.1'
                                 style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'>
                                <span>Summer Sale</span></div>
                            <div class='tp-caption sfb  tp-resizeme ' data-x='0' data-y='410' data-endspeed='500'
                                 data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none'
                                 data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'
                                 style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href='#'
                                                                                                         class="buy-btn">Shop
                                    Now</a></div>
                            <div class='tp-caption Title sft  tp-resizeme ' data-x='0' data-y='320' data-endspeed='500'
                                 data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none'
                                 data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1'
                                 style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><h4
                                    class="banner-text">In augue urna, nunc, tincidunt, augue, augue facilisis
                                    facilisis</h4></div>
                        </div>
                        -->
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>