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
<!--    <div class="assetBlock">-->
<!--        <p><a href="#">Только сегодня <span>коньки</span> по супернизким ценам &gt; </a></p>-->
<!--    </div>-->
    <div class="our-features-box">
        <div class="container">
            <ul>
                <li>
                    <div class="feature-box">
                        <div class="om-icon om-icon-minorder"></div>
                        <div class="content">Заказ всего от 5000 руб</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="om-icon om-icon-lowprice"></div>
                        <div class="content">Минимальная наценка</div>
                    </div>
                </li>
                <li>
                    <div class="feature-box">
                        <div class="om-icon om-icon-newgoods"></div>
                        <div class="content">До 2000 новинок ежедневно</div>
                    </div>
                </li>
                <li class="last">
                    <div class="feature-box">
                        <div class="om-icon om-icon-delivery"></div>
                        <div class="content">Доставка по России и СНГ</div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- end header banner -->

<!-- Slider -->
<?=\frontend\widgets\MainBanner::widget(['template'=>'top-slider']);?>
<!-- end Slider -->


<!-- banner -->
<div class="top-banner-section">
    <div class="container">
        <div class="row">
            <?=\frontend\widgets\MainBanner::widget(['template'=>'top-banner','path_image' => '/images/banners/']);?>
        </div>
    </div>
</div>
<!-- end banner -->

<!-- Featured Slider -->
<section class="featured-pro container">
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
<?=\frontend\widgets\MainBanner::widget(['template'=>'offer-slider']);?>
<!--Offer silder End-->


<!-- Featured Slider -->
<section class="featured-pro container">
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
<div class="brand-logo">
    <div class="container">
        <div class="new_title center">
            <h2>Брэнды</h2>
        </div>
        <div class="slider-items-products">
            <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col6">
                    <?php foreach ($brands as $brandkey=>$brandvalue){
                        if(($result = glob('images/brands/'.$brandvalue['specification_values_id'].'.{jpg,png,gif}', GLOB_BRACE )) == TRUE && $result[0]){ ?>
                        <div class="item"><a href="/catalog?sfilt[]=<?=$brandvalue['specification_values_id']?>"><img src="/<?=$result[0]?>" alt="<?=htmlentities($brandvalue['specification_value'])?>"></a> </div>
                    <?php }
                    } ?>
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
<?=\frontend\widgets\MainBanner::widget(['template'=>'social']);?>

<!--End Social -->

<!-- About -->
<section class="latest-blog">
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