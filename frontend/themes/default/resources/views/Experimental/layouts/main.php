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
use frontend\widgets\Menu;



/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name='yandex-verification' content='6af7ec36af3406db'/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head();

        //    $this->registerCssFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/css/site.css', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
        ?>
    </head>
    <body>
    <?php $this->beginBody(); ?>
    <div class="page">
        <header class="header-container">
            <div class="header container-width">
                <div class="header-bottom">
                    <div class="header-left header-width">
                        <a href="/" title="" class="logo"><strong>
                                <? if (($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                                    $name = $namecustom;
                                } else {
                                    $name = Yii::$app->params['constantapp']['APP_NAME'];
                                }
                                ?>
                            </strong><?= $name ?></a>
                        <div class="slogan">
                            <? if (($slogan = Yii::$app->params['partnersset']['slogan']['value']) !== FALSE && Yii::$app->params['partnersset']['slogan']['active'] == 1) {
                                echo str_replace('</p>', '', str_replace('<p>', '', $slogan));
                            } else {
                                $slogan = '';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="header-right">

                        <div class="searchicon"
                             style="float: left; position: relative; z-index: 9; margin: 30px 5px; color: white;">

                        </div>

                        <div class="usericon" title="Управление профайлом"
                             style="float: left; position: relative; z-index: 9; margin: 31px 5px; color: white;">
                            <div class="header-left-link" style="display: none;">

                                <div class="menu_content"> <div class="welcome-msg">Управление профайлом</div>
                                    <ul class="links">
                                        <?
                                        if (Yii::$app->user->can('admin')) echo '<li><a href="/admin">Админка</a></li>';
                                        if(Yii::$app->user->isGuest){
                                            echo '<li><a href="'.BASEURL.'/signup">Регистрация</a></li>';
                                            echo '<li><a href="'.BASEURL.'/login">Вход</a></li>';
                                        }
                                        else{
                                            echo '<li><a data-method="post" href="'.BASEURL.'/lk">Профайл</a></li>';
                                            echo '<li><a href="'.BASEURL.'/requestorders">Заказы</a></li>';
                                            echo '<li><a href="'.BASEURL.'/logout" data-method="post">Выход</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="carticon cart"
                             style="float: left; position: relative; z-index: 9; margin: 31px 5px; color: white;">
                            <div class="cart-count"></div>
                        </div>


                    </div>


                    <nav class="nav-container">
                        <div class="nav-inner" style="float: left; margin-top: 45px; position: relative; z-index: 9;">
                            <div style="display: block;" id="advancedmenu">
                                <div class="menu" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/">
                                            <span>Главная</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="menu1" class="menu menu-arrow" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/site/news">
                                            <span data-hover="Новости">Новости</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="menu2" class="menu" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/site/faq">
                                            <span data-hover="FAQ">FAQ</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="menu338" class="menu act" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/site/paying">
                                            <span data-hover="Оплата">Оплата</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="menu340" class="menu" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/site/delivery">
                                            <span data-hover="Доставка">Доставка</span>
                                        </a>
                                    </div>
                                </div>
                                <div id="menu343" class="menu" style="float: left; margin: 0px 10px;">
                                    <div class="parentMenu">
                                        <a href="/site/contacts">
                                            <span data-hover="Контакты">Контакты</span>
                                        </a>
                                    </div>
                                </div>


                                <div class="clearBoth"></div>
                            </div>


                    </nav>
                    <script type="text/javascript">
                        //<![CDATA[
                        var CUSTOMMENU_POPUP_WIDTH = 0;
                        var CUSTOMMENU_POPUP_TOP_OFFSET = 0;
                        var CUSTOMMENU_POPUP_RIGHT_OFFSET_MIN = 0;
                        var CUSTOMMENU_POPUP_DELAY_BEFORE_DISPLAYING = 0;
                        var CUSTOMMENU_POPUP_DELAY_BEFORE_HIDING = 0;
                        var megnorCustommenuTimerShow = {};
                        var megnorCustommenuTimerHide = {};
                        //]]>
                    </script>
                </div>
            </div>


        </header>

        <div class="main-container col2-left-layout" style="margin-bottom: 60px;padding-top: 180px;">
            <div class="header container-width" id="partners-main">
                <div class="container" id="partners-main-left-back">
                    <div id="partners-main-left">
                        <div id="partners-main-left-cont" class="block block-side-nav-container">
                            <div class="block-title">
                                <strong><span>Каталог товаров</span></strong>
                            </div><?= \frontend\widgets\Menu2::widget(); ?>
                        </div>
                        <div id="filters">
                            <div id="price-lable" style="display:none;">
                                Цена
                            </div>

                            <div id="min-price" class="btn" style="display:none">0</div>
                            <div style="display:none" id="max-price" class="btn">10000</div>
                        </div>
                        <? if (isset(Yii::$app->params['partnersset']['newsonindex']['value']) && Yii::$app->params['partnersset']['newsonindex']['active'] == 1) { ?>
                            <?= \frontend\widgets\NewsBlock::widget(); ?>
                        <? } ?>
                        <? if (isset(Yii::$app->params['partnersset']['commentsonindex']['value']) && Yii::$app->params['partnersset']['commentsonindex']['active'] == 1) { ?>
                            <?= \frontend\widgets\CommentsBlock::widget(['category' => '0', 'relateID' => NULL]); ?>
                        <? } ?>
                    </div>
                </div>
                <div class="container-fluid" id="partners-main-right-back">
                    <div id="partners-main-right" class="bside">
                        <?= $content ?>
                    </div>
                </div>


            </div>
            <div style="height: 60px"></div>
            <div class="modal-cart" id="modal-cart" style="display: none;"></div>
        </div>
        <footer class="footer">
            <hr class="linebottom1">
            <hr class="linebottom2">
            <div class="container">
                <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>

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
                <p class="pull-right"><a href="/site/offerta">Оферта</a> <a href="/site/paying">Оплата</a> <a
                        href="/site/delivery">Доставка</a> <a href="/site/contacts">Контакты</a></p>
            </div>
        </footer>
        <?php
        //  $this->registerJsFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/js/script.js', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
        $this->endBody();
        Yii::$app->params['assetsite']->registerAssetFiles($this);

        ?>
    </body>
    </html>
<?php $this->endPage() ?>