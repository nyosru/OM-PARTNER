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
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic,100,100italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'> <?= Html::csrfMetaTags() ?>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700,300italic,400italic,700italic&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>
<!--       --><?// $this->endCache();
//        }
//?>
        <title><?= Html::encode($this->title) ?></title>
<!--   --><?// if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-5', ['duration' => 10])) {
//    ?>
        <?php $this->head();

        //    $this->registerCssFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/css/site.css', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
        ?>
    </head>
    <body style='font-family: "Roboto",sans-serif; min-width: 1280px; margin-left: auto; margin-right: auto; height: auto; border-left:  1px  solid #CCC; border-right:  1px  solid #CCC;'>
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

                <div id="partners-main-left" style="position: fixed; width: 16.5%; overflow: auto; height: 100%; min-width: 211px; z-index: 9999999">
                    <div id="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">
                        <? if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                            echo '<span>' . str_replace('</p>', '', str_replace('<p>', '', $logotype)) . '</span>';
                        } else {
                            $logotype = '';
                        }
                        ?>
                    </div>
                        <div id="partners-main-left-cont">
                            <div id="catalog-mode" class="catalog-mode" style="float: right; width: 24px; height: 24px; text-align: center; color: rgb(204, 204, 204); border-bottom: 1px solid rgb(204, 204, 204); border-left: 1px solid rgb(204, 204, 204); font-size: 20px; line-height: 1.1;">
                                <i class="fa fa-angle-left"></i>
                            </div>
                        </div>
<!--    --><?// $this->endCache();
//}
//?>
                    <div id="partners-main-left-cont">
                        <?= Menuom::widget(['opencat' => Yii::$app->params['layoutset']['opencat']]); ?>
                    </div>
 <? if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-30', ['duration' => 10])) {
    ?>
                </div>
                </div>
            </div>
            <div class="container-fluid" id="partners-main-right-back">
                <div id="partners-main-right" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">
                    <div>
                        <a class="top-link" href="--><?//= BASEURL ?>/news">Новости</a>
                        <a class="top-link" href="<?= BASEURL ?>/faq">FAQ</a>
                        <a class="top-link" href="<?= BASEURL ?>/paying">Оплата</a>
                        <a class="top-link" href="<?= BASEURL ?>/delivery">Доставка</a>
                        <a class="top-link" href="<?= BASEURL ?>/contacts">Контакты</a>
                    </div>
                </div>
                <div id="partners-main-right">
                    <div style="width: 100%; display: block; height: 72px; padding: 16px 10px 10px; border-bottom: 1px solid rgb(204, 204, 204);">
                        <input id="search" class="form-control" placeholder="Введите артикул или название" style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="text">
                        <div class="btn btn-default data-j" style="width: 10%; height: 40px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; font-size: 1.2pc; left: -5px; margin-right: 0px; float: left;">
                            Найти
                        </div>
                        <div class="" style="padding: 16px 10px 10px; display: inline-block; float: right;">
                            Логин|Профиль
                        </div>
                        <div class="result_search_word" style="position: absolute; background: rgba(245, 245, 245, 0.84) none repeat scroll 0% 0%; width: 90%; z-index: 5000; overflow-y: auto; max-height: 300px;"></div>

                    </div>


                    <!--                    <ul class="nav navbar-nav navbar-left cart"><i class="fa fa-cart-arrow-down fa-3x"></i><span-->
                    <!--                            class="cart-count"></span><span class="cart-price"></span></ul>-->
                </div>
    <? $this->endCache();
}
?>
                <div id="partners-main-right" class="bside">

                    <?= $content ?>
                </div>


                <div style="clear: both;">
                    <div id="index-card-4">СЕО ТЕКСТ КАТЕГОРИИ</div>
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
                                        page: 'seocat-<?= $cat?>'}
                                );
                                alert('Изменения сохранены');

                            });
                        </script>
                    <?}?>
<?// if ($this->beginCache(Yii::$app->params['constantapp'].'catalog-static-40', ['duration' => 10])) {
//    ?>
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
        <style>
            #up {
                width: 40px;
                height: 40%;
                position: fixed;
                left: 0px;

                top: 0px;
            }

            #down {
                width: 40px;
                height: 40%;
                position: fixed;
                left: 0px;

                bottom: 0px;
            }

            .catalog-mode {
               cursor:pointer;
            }
        </style>
        <div class="navigate-catalog" style="position: fixed; left: 0px; width: 40px; height: 100%; top: 0px;">
            <div id="up"><i class="fa fa-arrow-circle-o-up fa-3x"
                            style="position: absolute;padding: 1px; bottom: 10%;"></i></div>
            <div id="down"><i class="fa fa-arrow-circle-o-down fa-3x"
                              style="position: absolute;padding: 1px; top: 10%;"></i></div>
        </div>
</div>
    </body>
    </html>
<?php $this->endPage() ?>