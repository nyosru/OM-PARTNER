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
    <div class="container" style="position: relative; display: block; padding: 10px 0px 0px;"><p class="pull-left"><span class = "navbred"></span>
            <?
            if(isset(Yii::$app->params['partnersset']['contacts']['telephone']['value']) && Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1){
                echo '<span>Телефон горячей линии: '.Yii::$app->params['partnersset']['contacts']['telephone']['value'].'</span>';
            }
            ?>
        </p><p class="pull-right"><a
                class="top-link" href="/site/faq">FAQ</a> <a class="top-link" href="/site/paying">Оплата</a> <a
                class="top-link" href="/site/delivery">Доставка</a> <a class="top-link"
                                                                       href="/site/contacts">Контакты</a></p></div>
    <div class="wrap">
        <?php

        NavBar::begin([
            'brandLabel' => Yii::$app->params['constantapp']['APP_NAME'],
            'brandUrl' => '/',
            'options' => [
                'class' => 'navbar-inverse',
                'style' => 'margin-top:0px; position: relative;'
            ],
        ]);
        ?>
        <div class="col-lg-5 navbar-form navbar-left" role="search" style="width: 26%;">
            <div class="form-group" style="width: 100%; display: table;">
                <input type="text" id="search" class="form-control" placeholder="Введите артикул или название"
                       style="width: 100%; background: rgb(89, 89, 89) none repeat scroll 0% 0%; border: 1px solid rgb(89, 89, 89);color: #fff;">

                <div class="result_search_word"
                     style="position: absolute; background: rgba(245, 245, 245, 0.84) none repeat scroll 0% 0%; width: 90%; z-index: 5000; overflow-y: auto; max-height: 300px;"></div>
            </div>
            <div class="btn btn-default data-j"
                 style="right: 15px; position: absolute; top: 0px; background: rgb(89, 89, 89) none repeat scroll 0% 0%; border: 1px solid rgb(89, 89, 89);">
                <i class="fa fa-search"></i>
            </div>
        </div>
        <div class="modal-cart" id="modal-cart"></div>

        <ul class="nav navbar-nav navbar-left cart"><i class="fa fa-cart-arrow-down fa-3x"></i><span
                class="cart-count"></span><span class="cart-price"></span></ul>
        <?
        $menuItems = [];
        if (Yii::$app->user->can('admin')) {
            $menuItems[] = ['label' => 'Админ', 'url' => ['/admin']];
        }
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
            $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
        } else {
            $menuItems[] = [
                'label' => 'Профиль (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/lk'],
                'linkOptions' => ['data-method' => 'post']
            ];
            $menuItems[] = [
                'label' => 'Выход',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

    </div>
    <div style="height: 60px"></div>
    <footer class="footer">
        <hr style="width: 55%; border: 1px solid rgb(255, 191, 8); position: absolute; right: 1px; top: 15px;">
        <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid #00FFCC;">
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
                    <a href="https://metrika.yandex.ru/stat/?id=<?=$yandexcounter?>&amp;from=informer"
                       target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/<?=$yandexcounter?>/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                           style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:<?=$yandexcounter?>,lang:'ru'});return false}catch(e){}" /></a>
                    <!-- /Yandex.Metrika informer -->

                    <!-- Yandex.Metrika counter -->
                    <script type="text/javascript">
                        (function (d, w, c) {
                            (w[c] = w[c] || []).push(function() {
                                try {
                                    w.yaCounter<?=$yandexcounter?> = new Ya.Metrika({
                                        id:<?=$yandexcounter?>,
                                        clickmap:true,
                                        trackLinks:true,
                                        accurateTrackBounce:true
                                    });
                                } catch(e) { }
                            });

                            var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () { n.parentNode.insertBefore(s, n); };
                            s.type = "text/javascript";
                            s.async = true;
                            s.src = "https://mc.yandex.ru/metrika/watch.js";

                            if (w.opera == "[object Opera]") {
                                d.addEventListener("DOMContentLoaded", f, false);
                            } else { f(); }
                        })(document, window, "yandex_metrika_callbacks");
                    </script>
                    <noscript><div><img src="https://mc.yandex.ru/watch/<?=$yandexcounter?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
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
    Yii::$app->params['asset']->registerAssetFiles($this);

    ?>
    </body>
    </html>
<?php $this->endPage() ?>