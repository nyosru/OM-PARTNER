<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use yii\caching\Cache;
use yii\filters\AccessControl;
use yii\web\User;
$this->title = $title;
    ?>

<script type='text/javascript'>
    jQuery(document).ready(function(){
        jQuery('#rev_slider_4').show().revolution({
            dottedOverlay: 'none',
            delay: 5000,
            startwidth: 1170,
            startheight: 600,

            hideThumbs: 200,
            thumbWidth: 200,
            thumbHeight: 50,
            thumbAmount: 2,

            navigationType: 'thumb',
            navigationArrows: 'solo',
            navigationStyle: 'round',

            touchenabled: 'on',
            onHoverStop: 'on',

            swipe_velocity: 0.7,
            swipe_min_touches: 1,
            swipe_max_touches: 1,
            drag_block_vertical: false,

            spinner: 'spinner0',
            keyboardNavigation: 'off',

            navigationHAlign: 'center',
            navigationVAlign: 'bottom',
            navigationHOffset: 0,
            navigationVOffset: 20,

            soloArrowLeftHalign: 'left',
            soloArrowLeftValign: 'center',
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,

            soloArrowRightHalign: 'right',
            soloArrowRightValign: 'center',
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,

            shadow: 0,
            fullWidth: 'on',
            fullScreen: 'off',

            stopLoop: 'off',
            stopAfterLoops: -1,
            stopAtSlide: -1,

            shuffle: 'off',

            autoHeight: 'off',
            forceFullWidth: 'on',
            fullScreenAlignForce: 'off',
            minFullScreenHeight: 0,
            hideNavDelayOnMobile: 1500,

            hideThumbsOnMobile: 'off',
            hideBulletsOnMobile: 'off',
            hideArrowsOnMobile: 'off',
            hideThumbsUnderResolution: 0,

            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0,
            fullScreenOffsetContainer: ''
        });
    });
</script>

<!-- layout: homepage-layout -->


<!-- header banner  -->
<div class="header-banner">
    <div class="assetBlock">
        <p><a href="#">Только сегодня <span>коньки</span> по супернизким ценам &gt; </a></p>
    </div>
    <div class="our-features-box">
        <div class="container">
            <ul>
                <li>
                    <div class="feature-box">
                        <div class="icon-truck"></div>
                        <div class="content">Самые низкие цены</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-support"></div>
                        <div class="content">Более 1,000,000 заказов</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="icon-money"></div>
                        <div class="content">Более 300,000 товаров</div>
                    </div>
                </li>
                <li class="last">
                    <div class="feature-box">
                        <div class="icon-return"></div>
                        <div class="content">Новинки каждый день</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end header banner -->

<!-- Slider -->
<div id="magik-slideshow" class="magik-slideshow">
    <div class="container">
        <div id='rev_slider_4_wrapper' class='rev_slider_wrapper fullwidthbanner-container' >
            <div id='rev_slider_4' class='rev_slider fullwidthabanner'>
                <ul>
                    <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='/images/new/slide-img1.jpg'><img src='/images/new/slide-img1.jpg'  data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat' alt="" />
                        <div class="info">
                            <div class='tp-caption ExtraLargeTitle sft  tp-resizeme ' data-x='0'  data-y='165'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;'><span>New Season</span></div>
                            <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='0'  data-y='220'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'><span>Summer Sale</span></div>
                            <div class='tp-caption sfb  tp-resizeme ' data-x='0'  data-y='410'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href='#' class="buy-btn">Shop Now</a></div>
                            <div class='tp-caption Title sft  tp-resizeme ' data-x='0'  data-y='320'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><h4 class="banner-text">In augue urna, nunc, tincidunt, augue, augue facilisis facilisis</h4></div>
                        </div>
                    </li>
                    <li data-transition='random' data-slotamount='7' data-masterspeed='1000' data-thumb='images/new/slide-img2.jpg'><img src='images/new/slide-img2.jpg'  data-bgposition='left top'  data-bgfit='cover' data-bgrepeat='no-repeat'  alt=""/>
                        <div class="info">
                            <div class='tp-caption ExtraLargeTitle sft slide2  tp-resizeme ' data-x='45'  data-y='165'  data-endspeed='500'  data-speed='500' data-start='1100' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:2;max-width:auto;max-height:auto;white-space:nowrap;padding-right:0px'>laptop Sale</div>
                            <div class='tp-caption LargeTitle sfl  tp-resizeme ' data-x='45'  data-y='220'  data-endspeed='500'  data-speed='500' data-start='1300' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:3;max-width:auto;max-height:auto;white-space:nowrap;'>Go Lightly</div>
                            <div class='tp-caption sfb  tp-resizeme ' data-x='45'  data-y='400'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Linear.easeNone' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><a href='#' class="buy-btn">Buy Now</a></div>
                            <div class='tp-caption Title sft  tp-resizeme ' data-x='45'  data-y='320'  data-endspeed='500'  data-speed='500' data-start='1500' data-easing='Power2.easeInOut' data-splitin='none' data-splitout='none' data-elementdelay='0.1' data-endelementdelay='0.1' style='z-index:4;max-width:auto;max-height:auto;white-space:nowrap;'><h4 class="banner-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h4></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- end Slider -->

<!-- banner -->
<div class="top-banner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow bounceup animated">
                <div class="col"><a href="#"><img src="/images/new/block1.jpg" alt="offer banner3"></a></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow bounceup animated">
                <div class="col"><a href="#"><img src="/images/new/block1.jpg" alt="offer banner3"></a></div>
            </div>
            <div class="ccol-lg-4 col-md-4 col-sm-4 col-xs-12 wow bounceup animated">
                <div class="col"><a href="#"><img src="/images/new/block1.jpg" alt="offer banner3"></a></div>
            </div>
        </div>
    </div>
</div>
<!-- end banner -->

<!-- Featured Slider -->
<section class="featured-pro container wow bounceInUp animated">
    <div class="slider-items-products">
        <div class="new_title center">
            <h2>СПЕЦИАЛЬНЫЕ ПРЕДЛОЖЕНИЯ</h2>
        </div>
        <div id="best-seller-slider" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php
                if(is_array($dataproducts)) {
                    foreach ($dataproducts as $k1=>$val) {
                        echo '<div class="item">';
                        echo \frontend\widgets\ProductCardFabia::widget(['template'=>'grid','product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'],'category'=>$value['categories_id'], 'catpath' => $catpath, 'man_time' => $man_time,'showdiscount'=>1]);
                        echo '</div>';
                    }
                }
                ?>

            </div>
        </div>
    </div>
</section>

<!--Offer Start-->
<div class="offer-slider wow animated parallax parallax-2">
    <div class="container">
        <ul class="bxslider">
            <li>
                <h2>NEW ARRIVALS</h2>
                <h1>Sale up to 30% off</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. </p>
                <a class="shop-now" href="#">Shop now</a> </li>
            <li>
                <h2>Hello hotness!</h2>
                <h1>Summer collection</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna. Sed et quam lacus. Fusce condimentum eleifend enim a feugiat. </p>
                <a class="shop-now" href="#">View More</a> </li>
            <li>
                <h2>New launch</h2>
                <h1>Designer dresses on sale</h1>
                <p>Fusce condimentum eleifend enim a feugiat. Pellentesque viverra vehicula sem ut volutpat. Integer sed arcu massa. </p>
                <a class="shop-now" href="#">Learn More</a> </li>
        </ul>
    </div>
</div>
<!--Offer silder End-->


<!-- Featured Slider -->
<section class="featured-pro container wow bounceInUp animated">
    <div class="slider-items-products">
        <div class="new_title center">
            <h2>Новинки</h2>
        </div>
        <div id="featured-slider" class="product-flexslider hidden-buttons">
            <div class="slider-items slider-width-col4 products-grid">
                <?php
                if(is_array($newproducts)) {
                    foreach ($newproducts as $k1=>$val) {
                        echo '<div class="item">';
                        echo \frontend\widgets\ProductCardFabia::widget(['template'=>'grid','css'=>['imageHeight'=>'205px'],'product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'],'category'=>$value['categories_id'], 'catpath' => $catpath, 'man_time' => $man_time,'showdiscount'=>1]);
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>

<!-- End Featured Slider -->

<!-- brand logo -->
<div class="brand-logo wow bounceInUp animated">
    <div class="container">
        <div class="new_title center">
            <h2>Брэнды</h2>
        </div>
        <div class="slider-items-products">
            <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col6">

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo3.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo2.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo1.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo4.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo5.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo6.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo1.png" alt="Image"></a> </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="item"><a href="#"><img src="/images/new/b-logo4.png" alt="Image"></a> </div>
                    <!-- End Item -->

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end brand logo -->

<!-- Latest Blog -->
<?=\frontend\widgets\NewsBlockFabia::widget()?>
<!-- End Latest Blog -->

<!-- Social -->
<section class="latest-blog wow bounceInUp animated">
    <div class="container">
        <div class="new_title center">
            <h2>Мы в социальных сетях</h2>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <div class="blog_inner">
                    <div class="blog-img"> <img src="/images/new/blog-img1.jpg" alt="Blog image">
                        <div class="mask"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <div class="blog_inner">
                    <div class="blog-img"> <img src="/images/new/blog-img1.jpg" alt="Blog image">
                        <div class="mask"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <div class="blog_inner">
                    <div class="blog-img"> <img src="/images/new/blog-img1.jpg" alt="Blog image">
                        <div class="mask"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-12 col-sm-3">
                <div class="blog_inner">
                    <div class="blog-img"> <img src="/images/new/blog-img1.jpg" alt="Blog image">
                        <div class="mask"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Social -->

<!-- About -->
<section class="latest-blog wow bounceInUp animated">
    <div class="container">
        <div class="new_title center">
            <h2>Коротко о нас</h2>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <?php
                            if (Yii::$app->user->can('admin')) {
                            }
                            $page = 'seoindex';
                            $data = \common\models\PartnersPage::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'type'=>'stringpost','name' => $page])->one();
                            if ($data) {
                                echo '<div id="my-textarea-id">';
                                echo stripcslashes($data->content);
                                 echo '</div>';
                            } else {
                                ?>
                            <div id="my-textarea-id"></div>

                            <?php } ?>
                            <?php if (Yii::$app->user->can('admin')) {

                                echo \vova07\imperavi\Widget::widget([
                                    'selector' => '#my-textarea-id',
                                    'settings' => [
                                        'lang' => 'ru',
                                        'minHeight' => 200,
                                        'plugins' => ['fontsize','fontcolor']
                                    ]

                                ]); ?>
                                <button class="savehtml">Сохранить</button>
                                <script>
                                    $(document).on('click', '.savehtml', function() {
                                        $html = $('#my-textarea-id').html();


                                        $.post(
                                            '/site/savepage',
                                            { html: $html,
                                                article: 'seoindex'}
                                        );
                                        alert('Изменения сохранены');
                                    });
                                </script>
                            <?php } ?>
            </div>
        </div>
    </div>
</section>
<!--End About -->

<!--    <div id="main-spec">-->
<!--        <div id="index-card-4">Специальные предложения</div>-->
<!--        --><?php
//
//        ?>
<!--    </div>-->
<!--    <div id="main-new" style="clear: both;">-->
<!--        <div id="index-card-4">Новые поступления</div>-->
<!--        --><?php
//        if(is_array($newproducts)) {
//            $specitems=array();
//            $num=0;
//            $it=0;
//            $specitems[$it]['content']='';
//            foreach ($newproducts as $k1=>$val) {
//                if($num<10){
//                    $specitems[$it]['content'].=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time]);
//                    $num++;
//                }
//                else{
//                    $num=0;
//                    $it++;
//                    $specitems[$it]['content']=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time]);
//                    $num++;
//                }
//            }
//            echo Carousel::widget([
//                'items'=>$specitems,'id'=>'slid4','clientOptions'=>['interval'=>10000]
//            ]);
//        }
//
//        ?>
<!--    </div>-->
<!--    <div id="main-new" style="clear: both;">-->
<!--        <div class="main-news" style="float: left; width: 31%;">-->
<!--            <div id="" style="font-size: 20px; font-weight: 400; float: left; margin: 5px;">Новости</div>-->
<!--            <a id="" href="--><?//= BASEURL . '/news' ?><!--"-->
<!--               style="display: block; font-size: 14px; font-weight: 400; float: right; color: rgb(0, 165, 161); margin: 0px 20px; padding: 10px;">Все-->
<!--                Новости</a>-->
<!---->
<!--            <div style="margin: 0px 5px; float: left; width: 100%;">-->
<!--                --><?//= \frontend\widgets\NewsBlockOM::widget() ?>
<!--            </div>-->
<!--        </div>-->
<!--        <div class="main-soc" style="float: left; width: 23%;">-->
<!--            <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">-->
<!--                <a href="http://vk.com/odezdamast_shop" target="_blank" style="display:block; cursor:pointer;" class="circular-vk"><i class="fa fa-vk"></i>-->
<!---->
<!--                </a>-->
<!--                <a href="http://vk.com/odezdamast_shop" target="_blank"  class="circular-title">-->
<!--                    Одежда-Мастер<br/>в Вконтакте-->
<!--                </a>-->
<!--                <a href="http://vk.com/odezdamast_shop" target="_blank"  class="circular-link">-->
<!--                    следить за новостями >>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="main-soc" style="float: left; width: 23%;">-->
<!--            <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">-->
<!--                <a href="http://ok.ru/odezhda.master" target="_blank"  style="display:block; cursor:pointer;" class="circular-ok"><i class="fa fa-odnoklassniki "></i>-->
<!---->
<!--                </a>-->
<!--                <a href="http://ok.ru/odezhda.master" target="_blank"  class="circular-title">-->
<!--                    Одежда-Мастер<br/>в Одноклассниках-->
<!--                </a>-->
<!--                <a href="http://ok.ru/odezhda.master" target="_blank"  class="circular-link">-->
<!--                    следить за новостями >>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="main-soc" style="float: left; width: 23%;">-->
<!--            <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">-->
<!--                <a href="https://www.instagram.com/odezhda_master/" target="_blank" style="display:block; cursor:pointer;" class="circular-instagramm"><i class="fa fa-instagram"></i>-->
<!---->
<!--                </a>-->
<!--                <a href="https://www.instagram.com/odezhda_master/" target="_blank"  class="circular-title">-->
<!--                    Одежда-Мастер<br/>в Инстаграм-->
<!--                </a>-->
<!--                <a href="https://www.instagram.com/odezhda_master/" target="_blank"  class="circular-link">-->
<!--                    следить за новостями >>-->
<!--                </a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div style="clear: both;">-->
<!---->
<!--        <div style="margin: 0px 15px;float: left;margin-top:30px;">-->
<!--            --><?php
//            if (Yii::$app->user->can('admin')) {
//            }
//            $page = 'seoindex';
//            $data = \common\models\PartnersPage::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'type'=>'stringpost','name' => $page])->one();
//            if ($data) {
//                echo '<div id="my-textarea-id">';
//                echo stripcslashes($data->content);
//                 echo '</div>';
//            } else {
//                ?>
<!--            <div id="my-textarea-id"></div>-->
<!---->
<!--            --><?php //} ?>
<!--            --><?php //if (Yii::$app->user->can('admin')) {
//
//                echo \vova07\imperavi\Widget::widget([
//                    'selector' => '#my-textarea-id',
//                    'settings' => [
//                        'lang' => 'ru',
//                        'minHeight' => 200,
//                        'plugins' => ['fontsize','fontcolor']
//                    ]
//
//                ]); ?>
<!--                <button class="savehtml">Сохранить</button>-->
<!--                <script>-->
<!--                    $(document).on('click', '.savehtml', function() {-->
<!--                        $html = $('#my-textarea-id').html();-->
<!---->
<!---->
<!--                        $.post(-->
<!--                            '/site/savepage',-->
<!--                            { html: $html,-->
<!--                                article: 'seoindex'}-->
<!--                        );-->
<!--                        alert('Изменения сохранены');-->
<!--                    });-->
<!--                </script>-->
<!--            --><?php //} ?>
<!--        </div>-->
<!--    </div>-->