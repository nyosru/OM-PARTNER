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
    <html lang="<?= Yii::$app->language ?>">
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
    <body style="font-family: 'Roboto', sans-serif; font-style: normal; font-weight: 300; min-width: 1280px; margin-left: auto; margin-right: auto; height: 100%; border-left:  1px  solid #CCC; border-right:  1px  solid #CCC;">
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
        <div class="container-fluid" id="partners-main">
            <div class="container" id="partners-main-left-back">

                <div id="partners-main-left-cont">
                    <div id="partners-main-left-cont" class="suplogo" style="height: 55px;background: #F5F5F5; position: fixed; width: 16.5%; z-index: 100; min-width: 211px; border-bottom: #CCC 1px solid;">
                        <? if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                            echo '<span  class="supspan">' . str_replace('</p>', '', str_replace('<p>', '', $logotype)) . '</span>';
                        } else {
                            $logotype = '';
                        }
                        ?>
                        <a id="partners-main-left-cont" href="/" class="sublogo" >
                      <i class="fa fa-chevron-left" ></i> На главную
                    </a>
                    </div>

                    <div id="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);"></div>
                    <div id="partners-main-left-cont" class="suplogo" style="height: 20px; background: rgb(245, 245, 245) none repeat scroll 0% 0%; position: fixed; width: 16.5%; z-index: 100; min-width: 211px; border-bottom: 1px solid rgb(204, 204, 204); bottom: 0px;">
                        <span class="supspan">
                            <a href="#" id="up" style="display: block; height: 100%; float: left; width: calc(100% / 3); text-align: center;">
                                <i class="fa fa-arrow-up"></i>
                            </a>
                            <a id="down" href="#" style="display: block; height: 100%; float: left; width: calc(100% / 3); text-align: center;">
                                <i class="fa fa-arrow-down"></i>
                            </a>
                           <a href="#" id="catalog-mode" style="display: block; height: 100%; float: left; width: calc(100% / 3); text-align: center;">
                               <i class="fa fa-arrow-left"></i>
                           </a>
                        </span>
                    </div>
                </div>
                <div id="partners-main-left" class="target jb-shortscroll-target" style="position: fixed; width: 16.5%;  min-width: 211px; z-index: 99; height: calc(100% - 75px);">
                    <div id="partners-main-left-cont">
                        <?=  Menuom::widget(['property' => ['target'=>0, 'opencat' =>  Yii::$app->params['layoutset']['opencat']]]);?>
                    </div>

                </div>
                <div id="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">

                </div>
            </div>
            <div class="container-fluid" id="partners-main-right-back">
                <div id="partners-main-right" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">
                    <div>
                        <div class="top-link-cont" style="width: calc(100% / 6.9);"><a class="top-link" href="/faq">Как сделать заказ</a></div>
                        <div class="top-link-cont" style="width: calc(100% / 13);"><a class="top-link red" href="/glavnaya/faq">Акции</a></div>
                        <div class="top-link-cont" style="width: calc(100% / 5.1);"><a class="top-link" href="/glavnaya/paying">Условия сотрудничества</a></div>
                        <div class="" style="float: left; background: rgb(245, 245, 245) none repeat scroll 0% 0%; text-align: center; width: calc(100% / 6.5);"><img src="/images/logo/OM_code.png"></div>
                        <?
                        if (isset(Yii::$app->params['partnersset']['contacts']['telephone']['value']) && Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1) {
                            echo '<div style="float: left; padding: 15px 0px; font-size: 16px; font-family: Roboto Regular,sans serif; text-align: center; width: calc(100% / 7);">+7-495-204-15-83</div>';
                        }
                        ?>
                        <a class="top-link-cont-back" style="float: left; font-size: 13px; padding: 17px 0px; width: calc(100% / 6);" class="top-link-back" href="http://odezhda-master.ru">На старую версию сайта</a></a>
                        <div class="top-link-cont" style="float: right; padding: 12px 6px; text-align: right; width: calc(100% / 9);"><a class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart" style="font-size: 28px; color: rgb(0, 165, 161); margin-right: 10px;"></i>Корзина</a></div>
                    </div>
                </div>
                <div id="partners-main-right">
                    <div style="width: 100%; display: block; height: 72px; padding: 16px 10px 10px; border-bottom: 1px solid rgb(204, 204, 204);">
                        <input id="search" class="no-shadow-form-control" placeholder="Введите артикул или название" style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="text">
                        <div class="btn btn-default data-j" style="width: 10%; height: 40px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; font-size: 1.2pc; left: -5px; margin-right: 0px; float: left;">
                            Найти
                        </div>
                        <div class="" style="float: right; width: 25%; padding: 8px 0px; font-weight: 400;">
                            <?
                            if(Yii::$app->user->isGuest){
                                echo '<div style="float: right;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i>';
                                $model = new \common\models\LoginFormOM();
                                Modal::begin([
                                    'id'=> 'authform',
                                    'header' => 'Вход на Одежда-Мастер',
                                    'toggleButton' => ['label' => 'Вход', 'tag'=> 'a', 'style'=> 'float: left; margin: 4px; cursor:pointer;'],
                                ]);
                                $form = \yii\bootstrap\ActiveForm::begin(['id' => 'login-form']);
                                echo $form->field($model, 'username', ['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->label('Электронная почта');
                                echo $form->field($model, 'password',['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->passwordInput()->label('<span style="float: left;">Пароль</span><span style="float: right; text-decoration: underline;">'.Html::a('Забыли пароль?', [BASEURL . '/request-password-reset']).'</span>') ;
                                echo $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
                                    'template' => '{input}{image}',
                                    'options' =>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']
                                ])->label('Введите текст на картинке');
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
                        <div class="result_search_word" style="position: absolute; background: rgba(245, 245, 245, 0.84) none repeat scroll 0% 0%; width: 90%; z-index: 5000; overflow-y: auto; max-height: 300px;"></div>

                    </div>


                    <!--                    <ul class="nav navbar-nav navbar-left cart"><i class="fa fa-cart-arrow-down fa-3x"></i><span-->
                    <!--                            class="cart-count"></span><span class="cart-price"></span></ul>-->
                </div>

                <div id="partners-main-right" class="bside">

                    <?= $content ?>
                </div>


                <div style="clear: both;">
                    <div id="index-card-4">Сео текст категории</div>
                    <div style="margin: 0px 15px;">
                    <?
                    if(Yii::$app->user->can('admin')){\dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'standart']);}
                    $data = new \common\models\PartnersConfig();
                    $check = Yii::$app->params['constantapp']['APP_ID'];
                    $cat = end(Yii::$app->params['layoutset']['opencat']);
                    $page = 'seocat-'.$cat;
                    $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
                    if($data){
                        echo stripcslashes($data->value);
                    }else{?>


                        НАЖМИТЕ ТУТ ЧТО БЫ ИЗМЕНИТЬ ОПИСАНИЕ
                    <?}?>
                    <?php if(Yii::$app->user->can('admin')){\dosamigos\ckeditor\CKEditorInline::end(); ?>

                        <button class="savehtml">Сохранить</button>
                        <script>
                            $(document).on('click', '.savehtml', function() {
                                $html = $('.cke_editable').html();
                                $.post(
                                    '/site/savehtml',
                                    { html: $html,
                                        page: 'seocat-<?= $cat?>'
                                    }
                                );
                                alert('Изменения сохранены');

                            });
                        </script>
                    <?}?>
<?// if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-40', ['duration' => 10])) {
//    ?>
                        </div>
                </div>







        <div class="modal-cart" id="modal-cart" style="display: none;"></div>
        <footer class="footer">
            <hr class="linebottom1">
            <hr class="linebottom2">
            <div class="container">
                <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
<!--    --><?// $this->endCache();
//}
//?>
                <div style="margin: 0% 25%; float: left;">
                    <?
                    if (isset(Yii::$app->params['partnersset']['mailcounter']['value']) && Yii::$app->params['partnersset']['mailcounter']['active'] == 1) {
                        $mailcounter = Yii::$app->params['partnersset']['mailcounter']['value'];
                        ?>
                        <a href="http://top.mail.ru/jump?from=<?= $mailcounter ?>">
                            <img src="//top-fwz1.mail.ru/counter?id=<?= $mailcounter ?>;t=502;l=1"
                                 style="border:0;" height="31" width="88" alt="Рейтинг@Mail.ru"/></a>
                        <script type="text/javascript">
                            var _tmr = _tmr || [];
                            _tmr.push({id: <?= $mailcounter ?>, type: "pageView", start: (new Date()).getTime()});
                            (function (d, w, id) {
                                if (d.getElementById(id)) return;
                                var
                                    ts = d.createElement("script");
                                ts.type = "text/javascript";
                                ts.async = true;
                                ts.id = id;
                                ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                                var
                                    f = function () {
                                        var
                                            s = d.getElementsByTagName("script")[0];
                                        s.parentNode.insertBefore(ts, s);
                                    };
                                if (w.opera == "[object Opera]") {
                                    d.addEventListener("DOMContentLoaded", f, false);
                                } else {
                                    f();
                                }
                            })(document, window, "topmailru-code");
                        </script>
                        <noscript>
                            <div style="position:absolute;left:-10000px;">
                                <img src="//top-fwz1.mail.ru/counter?id=' . $mailcounter . ';js=na" style="border:0;"
                                     height="1" width="1" alt="Рейтинг@Mail.ru"/>
                            </div>
                        </noscript>
                    <? } ?>

                    <?
                    if (isset(Yii::$app->params['partnersset']['yandexcounter']['value']) && Yii::$app->params['partnersset']['yandexcounter']['active'] == 1) {
                        $yandexcounter = Yii::$app->params['partnersset']['yandexcounter']['value'];
                        ?>
                        <!-- Yandex.Metrika informer -->
                        <a href="https://metrika.yandex.ru/stat/?id=<?= $yandexcounter ?>&amp;from=informer"
                           target="_blank" rel="nofollow"><img
                                src="https://informer.yandex.ru/informer/<?= $yandexcounter ?>/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика"
                                title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)"
                                onclick="try{Ya.Metrika.informer({i:this,id:<?= $yandexcounter ?>,lang:'ru'});return false}catch(e){}"/></a>
                        <!-- /Yandex.Metrika informer -->

                        <!-- Yandex.Metrika counter -->
                        <script type="text/javascript">
                            (function (d, w, c) {
                                (w[c] = w[c] || []).push(function () {
                                    try {
                                        w.yaCounter<?=$yandexcounter?> = new Ya.Metrika({
                                            id:<?=$yandexcounter?>,
                                            clickmap: true,
                                            trackLinks: true,
                                            accurateTrackBounce: true
                                        });
                                    } catch (e) {
                                    }
                                });

                                var n = d.getElementsByTagName("script")[0],
                                    s = d.createElement("script"),
                                    f = function () {
                                        n.parentNode.insertBefore(s, n);
                                    };
                                s.type = "text/javascript";
                                s.async = true;
                                s.src = "https://mc.yandex.ru/metrika/watch.js";

                                if (w.opera == "[object Opera]") {
                                    d.addEventListener("DOMContentLoaded", f, false);
                                } else {
                                    f();
                                }
                            })(document, window, "yandex_metrika_callbacks");
                        </script>
                        <noscript>
                            <div><img src="https://mc.yandex.ru/watch/<?= $yandexcounter ?>"
                                      style="position:absolute; left:-9999px;" alt=""/></div>
                        </noscript>
                        <!-- /Yandex.Metrika counter -->
                    <? } ?>
                </div>
                <p class="pull-right"><a href="<?= BASEURL ?>/offerta">Оферта</a> <a
                        href="<?= BASEURL ?>/paying">Оплата</a> <a
                        href="<?= BASEURL ?>/delivery">Доставка</a> <a href="<?= BASEURL ?>/contacts">Контакты</a></p>
            </div>
        </footer>
    </div>
    </div>
        <?php
        //  $this->registerJsFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/js/script.js', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
        $this->endBody();
        Yii::$app->params['assetsite']->registerAssetFiles($this);

        ?>
</div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.target').shortscroll();
        });
//        $(document).on('ready', function(){
//           console.log($('*').length);
//            $('div').attr('style','border:1px solid red;')
//        });
    </script>
    </body>
    </html>
<?php $this->endPage() ?>