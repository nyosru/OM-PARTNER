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
echo \frontend\widgets\MainBanner::widget();
?>




<div id="main-spec">
    <div id="index-card-4" style=' border-bottom: 1px solid rgb(204, 204, 204); border-radius: 0px;'>
        <div class="index-icon-plate">
            <div class="index-icon-img">
                <img src="/images/logo/low_price.png">
            </div>
            <div class="index-icon-title">
                Пожалуй, самые низкие цены
            </div>
        </div>
        <div class="index-icon-plate">
            <div class="index-icon-img">
                <img src="/images/logo/orders.png">
            </div>
            <div class="index-icon-title">
                Нами выполненно более 1,000,000 заказов
            </div>
        </div >
        <div class="index-icon-plate">
            <div class="index-icon-img">
                <img src="/images/logo/vipolneno.png">
            </div>
            <div class="index-icon-title">
                Более 25,000 товаров для вашего выбора
            </div>
        </div>
        <div class="index-icon-plate">
            <div class="index-icon-img">
                <img src="/images/logo/novinki.png">
            </div>
            <div class="index-icon-title">
                Новинки каждый день
            </div>
        </div>
        <div class="index-icon-plate">
            <div class="index-icon-img">
                <img src="/images/logo/minorder.png">
            </div>
            <div class="index-icon-title">
                Минимальный заказ всего от 5000 рублей
            </div>
        </div>
    </div>
</div>
<div id="main-spec">
    <div id="index-card-4">Специальные предложения</div>
    <div id="slid3" style="width: 100%;">
        <div class="carousel-inner featured">
            <?php
            if (is_array($dataproducts))
                foreach ($dataproducts as $k=>$val){?>
                    <div class="item">
                        <?php
                        $analitics = '
                    <script>
                        ga("ec:addImpression", {
                            "id": "'.$val['products']['products_id'].'",
                            "name": "'.$val['productsDescription']['products_name'].'",
                            "category": "none",
                            "list": "main-special",
                            "brand": "'.$val['products']['manufacturers_id'].'",
                            "variant": "none",
                            "position": "'.$k1.'"});
                        ga("ec:setAction", "view");
                        ga("send", "event" , "view", "'.$_SERVER["REQUEST_URI"].'" );
                    </script>
                    ';
                        echo $analitics;
                        ?>
                        <?php
                        echo  \frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'],'category'=>$val['categories_id'], 'catpath' => $catpath, 'man_time' => $man_time,'showdiscount'=>1]);
                        ?>
                    </div>
                <?php }
            ?>
        </div>
    </div>
</div>
<div id="main-new" style="clear: both;">
    <div id="index-card-4">Новые поступления</div>

    <div id="slid4" style="width: 100%;">
        <div class="carousel-inner sliderNew">
            <?php
            if (is_array($newproducts))
                foreach ($newproducts as $k1=>$val){ ?>
                    <div class="item">
                        <?php
                        $analitics = '
                         <script>
                            ga( "ec:addImpression", {
                                "id": "'.$val['products']['products_id'].'",
                                "name": "'.$val['productsDescription']['products_name'].'",
                                "category": "none",
                                "list": "main-new",
                                "brand": "'.$val['products']['manufacturers_id'].'",
                                "variant": "none",
                                "position": "'.$k1.'"});
                            ga("ec:setAction", "view");
                            ga("send", "event" , "view", "'.$_SERVER["REQUEST_URI"].'" );
                         </script>
                        ';
                        echo $analitics;
                        echo  \frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time,'category'=>$val['categories_id'],'showdiscount'=>1]);
                        ?>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>
<div id="main-new" style="clear: both;">
    <div class="main-news" style="float: left; width: 31%;">
        <div id="" style="font-size: 20px; font-weight: 400; float: left; margin: 5px;">Новости</div>
        <a id="" href="<?= BASEURL . '/news' ?>"
           style="display: block; font-size: 14px; font-weight: 400; float: right; color: rgb(0, 165, 161); margin: 0px 20px; padding: 10px;">Все
            Новости</a>

        <div style="margin: 0px 5px; float: left; width: 100%;">
            <?= \frontend\widgets\NewsBlockOM::widget() ?>
        </div>
    </div>
    <div class="main-soc" style="float: left; width: 23%;">
        <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">
            <a href="http://vk.com/odezdamast_shop" target="_blank" style="display:block; cursor:pointer;" class="circular-vk"><i class="fa fa-vk"></i>

            </a>
            <a href="http://vk.com/odezdamast_shop" target="_blank"  class="circular-title">
                Одежда-Мастер<br/>в Вконтакте
            </a>
            <a href="http://vk.com/odezdamast_shop" target="_blank"  class="circular-link">
                следить за новостями >>
            </a>
        </div>
    </div>
    <div class="main-soc" style="float: left; width: 23%;">
        <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">
            <a href="http://ok.ru/odezhda.master" target="_blank"  style="display:block; cursor:pointer;" class="circular-ok"><i class="fa fa-odnoklassniki "></i>

            </a>
            <a href="http://ok.ru/odezhda.master" target="_blank"  class="circular-title">
                Одежда-Мастер<br/>в Одноклассниках
            </a>
            <a href="http://ok.ru/odezhda.master" target="_blank"  class="circular-link">
                следить за новостями >>
            </a>
        </div>
    </div>
    <div class="main-soc" style="float: left; width: 23%;">
        <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">
            <a href="https://www.instagram.com/odezhda_master/" target="_blank" style="display:block; cursor:pointer;" class="circular-instagramm"><i class="fa fa-instagram"></i>

            </a>
            <a href="https://www.instagram.com/odezhda_master/" target="_blank"  class="circular-title">
                Одежда-Мастер<br/>в Инстаграм
            </a>
            <a href="https://www.instagram.com/odezhda_master/" target="_blank"  class="circular-link">
                следить за новостями >>
            </a>
        </div>
    </div>
</div>

<div style="clear: both;">

    <div style="margin: 0px 15px;float: left;margin-top:30px;">
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
        <script>
            $(window).on('load',function () {

                $('.featured').owlCarousel({
                    loop:true,
                    margin:2,
                    nav:true,
                    items: 6,
                    autoplay:true,
                    navText: ['<a class="left carousel-control" data-slide="prev">‹</a>','<a class="right carousel-control" data-slide="next">›</a>'],
                    dots:false,
                    responsive:{
                        0:{
                            items:4
                        },
                        1024:{
                            items:3
                        },
                        1280:{
                            items:4
                        },
                        1560:{
                            items:5
                        },
                        1900:{
                            items:6
                        },
                    }
                })
                $('.sliderNew').owlCarousel({
                    loop:true,
                    margin:2,
                    nav:true,
                    items: 6,
                    autoplay:true,
                    dots:false,
                    navText: ['<a class="left carousel-control" data-slide="prev">‹</a>','<a class="right carousel-control" data-slide="next">›</a>'],
                    responsive:{
                        0:{
                            items:4
                        },
                        1024:{
                            items:3
                        },
                        1280:{
                            items:4
                        },
                        1560:{
                            items:5
                        },
                        1900:{
                            items:6
                        },
                    }
                })  });
        </script>
    </div>

</div>