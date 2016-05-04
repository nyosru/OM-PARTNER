
<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap\Alert;
use rmrevin\yii\fontawesome;
use dosamigos\ckeditor\CKEditorInline;
use frontend\widgets\Menuom;



/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage();
//if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-10', ['duration' => 10])) {
// ?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!--        <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name='yandex-verification' content='6af7ec36af3406db'/>
    <link rel="search" type="application/opensearchdescription+xml" title="Поиск по товарам"
          href="<?= BASEURL ?>/addsearch">
    <!--       --><?// $this->endCache();
    //        }
    //?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!--   --><?// if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-5', ['duration' => 10])) {
    //    ?>
    <?php $this->head();

    //    $this->registerCssFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/css/site.css', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    ?>
</head>
<body style="font-family: Open Sans,Helvetica Neue,sans-serif, sans-serif; font-style: normal; font-weight: 300; min-width: 1280px; margin-left: auto; margin-right: auto; height: 100%; ">
<?php $this->beginBody(); ?>
<div class="wrap" >
    <?php
    if (($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
        $name = $namecustom;
    } else {
        $name = Yii::$app->params['constantapp']['APP_NAME'];
    }
    ?>
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <div class="partners-main">
        <div id="modal-product" style="border:none; min-height: 300px;">
            <span id="modal-close"><i class="fa fa-times"></i></span>
        </div>
        <div id="overlay"></div>
        <div class="partners-main-left-back">

            <div>
                <div  class="partners-main-left suplogo" style="height: 55px;background: #F5F5F5; position: fixed; width: 16.5%; z-index: 100; min-width: 211px;">
                    <? if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                        echo '<span style="" class="supspan">' . str_replace('</p>', '', str_replace('<p>', '', $logotype)) . '</span>';
                    } else {
                        $logotype = '';
                    }
                    ?>
                    <a  href="/" class="partners-main-left sublogo" >
                        <i class="fa fa-chevron-left" ></i> На главную
                    </a>
                </div>

                <div class="partners-main-left" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);"></div>
            </div>

                <div class="partners-main-left-cont" style="position: fixed; width: 16.5%;  min-width: 211px; z-index: 99; height: calc(100% - 75px);">
                    <div class="partners-main-left">
                        <div class="partners-main-left">
                            <ul id="accordion" class="accordion">
                                <li class="">
                                    <div id="profile-orders" class="link profile-orders">
                                        <a href="<?= BASEURL ?>/lk?view=myorder">
                                            Мои заказы
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <ul id="accordion" class="accordion">
                                <li class="">
                                    <div id="profile-orders" class="link profile-orders">
                                        <a href="<?= BASEURL ?>/lk?view=orderedproducts">
                                            Мои товары
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <ul id="accordion" class="accordion">
                                <li class="">
                                    <div id="profile-orders" class="link profile-orders">
                                        <a href="<?= BASEURL ?>/lk?view=userinfo">
                                            Мои данные
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <ul id="accordion" class="accordion">
                                <li class="">
                                    <div id="profile-orders" class="link profile-orders">
                                        <a href="<?= BASEURL ?>/contactform">
                                            Связь с администрацией
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <ul id="accordion" class="accordion">
                                <li class="">
                                    <div id="profile-call" class="link">Продолжить покупки</div>
                                </li>
                            </ul>
                        </div>       </div>

                </div>
                <div class="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);"></div>
                <div  class="partners-main-left-cont suplogo" style=" background: rgb(245, 245, 245) none repeat scroll 0% 0%; position: fixed; width: 16.5%; z-index: 100; min-width: 211px; border-bottom: 1px solid rgb(204, 204, 204); bottom: 0px;">
                                   </div>
            </div>
            <div class="partners-main-right-back">
                <div class="partners-main-right" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">
                    <div>
                        <div class="top-link-cont large" style="width: calc(100% / 6.9);"><a class="top-link" href="<?=BASEURL?>/page?article=howorders">Как сделать заказ</a></div>
                        <div class="top-link-cont large" style="width: calc(100% / 13);"><a class="top-link red" href="<?=BASEURL?>/discont">Акции</a></div>
                        <div class="top-link-cont large" style="width: calc(100% / 5.1);"><a class="top-link" href="<?=BASEURL?>/page?article=contributionrules">Условия сотрудничества</a></div>

                        <div class="om-code" style="float: left; background: rgb(245, 245, 245) none repeat scroll 0% 0%; text-align: center; width: calc(100% / 6.5);"><img src="/images/logo/OM_code.png"></div>
                        <?
                        if (isset(Yii::$app->params['partnersset']['contacts']['telephone']['value']) && Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1) {
                            echo '<div style="float: left; padding: 15px 0px; font-size: 16px; font-weight: 500; text-align: center; width: calc(100% / 7);min-width: 155px;">+7-495-204-15-83</div>';
                        }
                        ?>
                        <a class="top-link-cont-back large" style="float: left; font-size: 13px; padding: 17px 0px; width: calc(100% / 6);" class="top-link-back" href="http://odezhda-master.ru">На старую версию сайта</a>
                        <div class="top-link-cont" style="float: right; padding: 12px; text-align: right; width: calc(100% / 9);min-width: 115px;"><div style="background: #FFBF08;font-size: 12px; right: 65px; position: absolute;" class="cart-count badge"></div><a class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart" style="font-size: 28px; color: rgb(0, 165, 161); margin-right: 10px;"></i>Корзина</a></div>
                        <div class="top-link-cont alk" style="width: calc(100% / 6);display: none; float: right;"><a class="top-link" href="#">Показать меню</a></div>
                    </div>
                </div>
                <div class="partners-main-right">
                    <div style="width: 100%; display: block; height: 72px; padding: 16px 10px 10px; border-bottom: 1px solid rgb(204, 204, 204);">
                        <form action="<?= BASEURL?>/catalog">
                            <input  name="cat" value="0"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="count" value="<?=(integer)Yii::$app->request->getQueryParam('count')?>"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="start_price" value="<?=(integer)Yii::$app->request->getQueryParam('start_price')?>"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="end_price" value="<?=(integer)Yii::$app->request->getQueryParam('end_price')?>"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="prod_attr_query" value="<?=(integer)Yii::$app->request->getQueryParam('prod_attr_query')?>"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input autocomplete="off" id="" name="searchword" class="search no-shadow-form-control" placeholder="Введите артикул или название" style="height: 40px; float: left; width: 65%; color: rgb(119, 119, 119); background: transparent none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; margin-top: 0px;" type="text">
                            <button class="btn btn-default data-j" type="submit" style="width: 10%; height: 40px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; font-size: 1.2pc; left: -5px; margin-right: 0px; float: left;">
                                Найти
                            </button>
                        </form>
                        <div class="logindiv" style="float: right; width: 25%; padding: 8px 0px; font-weight: 400;">
                            <?
                            if(Yii::$app->user->isGuest){
                                echo '<div style="float: right;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i>';
                                $model = new \common\models\LoginFormOM();
                                Modal::begin([
                                    'id'=> 'authform',
                                    'header' => 'Вход на Одежда-Мастер',
                                    'toggleButton' => ['label' => 'Вход', 'tag'=> 'a', 'style'=> 'float: left; margin: 4px; cursor:pointer;'],
                                ]);
                                $form = \yii\bootstrap\ActiveForm::begin([
                                    'action' => BASEURL.'/login',
                                    'id' => 'login-form'
                                ]);
                                echo $form->field($model, 'username', ['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->label('Электронная почта');
                                echo $form->field($model, 'password',['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->passwordInput()->label('<span style="float: left;">Пароль</span><span style="float: right; text-decoration: underline;">'.Html::a('Забыли пароль?', [BASEURL . '/request-password-reset']).'</span>') ;
//                                echo $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
//                                    'template' => '{input}{image}',
//                                    'options' =>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']
//                                ])->label('Введите текст на картинке');
                                echo' <div style="color:#999;margin:1em 0">';
                                echo    Html::a('Зарегистрироваться', [BASEURL . '/signup'],  ['class'=>'btn' , 'style'=>'height: 36px; color: rgb(0, 0, 0); position: absolute; right: 30px; text-decoration: underline;' ]) ;
                                echo    Html::submitButton('Вход', ['class' => 'btn', 'name' => 'partners-settings-button', 'style'=>'height: 36px; color: rgb(255, 255, 255); position: absolute; left: 30px; background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
                                echo'</div>';
                                echo $form->field($model, 'rememberMe', ['options'=>['style'=>'margin-top:80px']])->checkbox()->label('Запомнить меня');

                                \yii\bootstrap\ActiveForm::end();

                                Modal::end();


                                echo '</div>';
                                echo '<div style="float: right;"><a href="'.BASEURL.'/signup"><span style="float: left; margin: 4px;">Регистрация</span></a></div>';
                            }else{
                                echo '<div style="float: right;"><a href="'.BASEURL.'/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
                                echo '<div style="float: right;"><a href="'.BASEURL.'/lk"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
                            }
                            ?>
                        </div>
                        <div class="result_search_word" style="background: rgba(245, 245, 245, 0.84) none repeat scroll 0% 0%; z-index: 5000; overflow-y: auto; max-height: 300px; position: relative; width: 65%;"></div>

                    </div>


                    <!--                    <ul class="nav navbar-nav navbar-left cart"><i class="fa fa-cart-arrow-down fa-3x"></i><span-->
                    <!--                            class="cart-count"></span><span class="cart-price"></span></ul>-->
                </div>

                <div class="partners-main-right bside">
                    <?= $content ?>




                </div>
                <div class="modal-cart" id="modal-cart" style="display: none;"></div>
                <div style="clear:both;"></div>
                <footer class="footer">
                    <hr class="linebottom1">
                    <hr class="linebottom2">
                    <div class="" style="margin: 0px 25px;">
                        <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
                        <div style="margin: 0% 25%; float: left;">
                        <?=\frontend\widgets\Metrics::widget();?>
                        </div>
                        <p class="pull-right"></p>
                    </div>
                </footer>
            </div>
        </div>
        <?php
         $this->endBody();
        Yii::$app->params['assetsite']->registerAssetFiles($this);

        ?>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.target').shortscroll();
        });

    </script>
    </body>
</html>
<?php $this->endPage() ?>