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
    <div id="main-index">
        <div id="index-card-5" class="data-j index-card banner-card" data-cat="1720"><a
                href="<?= BASEURL ?>/catalog?cat=1734&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;" src="/images/banners/13052016_1.png"></a></div>
        <div id="index-card-6" class="data-j index-card banner-card" data-cat="2008"><a
                href="<?= BASEURL ?>/catalog?cat=1983&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"    src="/images/banners/13052016_3.png"></a></div>
        <div id="index-card-3" class="sort data-j index-sort banner-card" data-cat="0"><a
                href="<?= BASEURL ?>/catalog?cat=1720&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/13052016_5.gif"></a></div>
        <div id="index-card-5" style="float:right" class="data-j index-card banner-card" data-cat="2047"><a
                href="<?= BASEURL ?>/catalog?cat=1775&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/13052016_2.png"></a></div>
        <div id="index-card-6" class="data-j index-card banner-card" data-cat="1762"><a
                href="<?= BASEURL ?>/catalog?cat=2047&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/13052016_4.png"></a></div>
        <div id="index-card-6" style="width: calc(100% - 10px);"class="data-j index-card banner-card" data-cat="1836"><a
                href="<?= BASEURL ?>/catalog?cat=1523&count=60&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;" src="/images/banners/13052016_6.gif"></a></div>
    </div>


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
        <?php
        if(is_array($dataproducts)) {
            $specitems=array();
            $num=0;
            $it=0;
            $specitems[$it]['content']='';
            foreach ($dataproducts as $k1=>$val) {
                if($num<10){
                    $specitems[$it]['content'].=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'],'category'=>$value['categories_id'], 'catpath' => $catpath, 'man_time' => $man_time,'showdiscount'=>1]);
                    $num++;
                }
                else{
                    $num=0;
                    $it++;
                    $specitems[$it]['content']=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'],'category'=>$value['categories_id'], 'catpath' => $catpath, 'man_time' => $man_time]);
                    $num++;
                }
            }
            echo Carousel::widget([
                'items'=>$specitems,'id'=>'slid3','clientOptions'=>['interval'=>10000000]
            ]);
        }
        ?>
    </div>
    <div id="main-new" style="clear: both;">
        <div id="index-card-4">Новые поступления</div>
        <?php
        if(is_array($newproducts)) {
            $specitems=array();
            $num=0;
            $it=0;
            $specitems[$it]['content']='';
            foreach ($newproducts as $k1=>$val) {
                if($num<10){
                    $specitems[$it]['content'].=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time]);
                    $num++;
                }
                else{
                    $num=0;
                    $it++;
                    $specitems[$it]['content']=\frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time]);
                    $num++;
                }
            }
            echo Carousel::widget([
                'items'=>$specitems,'id'=>'slid4','clientOptions'=>['interval'=>10000]
            ]);
        }

        ?>
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
        </div>
    </div>