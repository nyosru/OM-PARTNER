<?php

namespace frontend\widgets;

use Yii;

class Metrics extends \yii\bootstrap\Widget
{
    public function run()
    {
        if (Yii::$app->params['metrics'] === TRUE) {
            parent::init();

        /** Счетчик майл Begin**/

            if (Yii::$app->params['partnersset']['mailcounter']['value']
                && Yii::$app->params['partnersset']['mailcounter']['active'] == 1
            ) {

                $mailcounter = Yii::$app->params['partnersset']['mailcounter']['value'];
                ?>
                <a
                    href="http://top.mail.ru/jump?from=<?= $mailcounter ?>">
                    <img
                        src="//top-fwz1.mail.ru/counter?id=<?= $mailcounter ?>;t=502;l=1"
                        style="border:0;" height="31"
                        width="88" alt="Рейтинг@Mail.ru"/>
                </a>
                <script type="text/javascript">
                    var _tmr = _tmr || [];
                    _tmr.push({
                        id: <?= $mailcounter ?>,
                        type: "pageView",
                        start: (new Date()).getTime()
                    });
                    (function (d, w, id) {
                        if (d.getElementById(id)) return;
                        var ts = d.createElement("script");
                        ts.type = "text/javascript";
                        ts.async = true;
                        ts.id = id;
                        ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                        var f = function () {
                            var s = d.getElementsByTagName("script")[0];
                            s.parentNode.insertBefore(ts, s);
                        };
                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else {
                            f();
                        }
                    })(document, window, "topmailru-code");
                </script>

            <?php }

            /** Счетчик майл End**/

            /** Счетчик Google Analitics Begin**/
//
//        if (   Yii::$app->params['partnersset']['googleanalitycs']['value']
//            && Yii::$app->params['partnersset']['googleanalitycs']['active'] == 1){
            if (true) {
                //      $googleanalitycs = Yii::$app->params['partnersset']['googleanalitycs']['value'];
                $googleanalitycs = 'UA-75056446-1';
                ?>
                <script>
                    (function (i, s, o, g, r, a, m) {
                        i['GoogleAnalyticsObject'] = r;
                        i[r] = i[r] || function () {
                                (i[r].q = i[r].q || []).push(arguments)
                            }, i[r].l = 1 * new Date();
                        a = s.createElement(o),
                            m = s.getElementsByTagName(o)[0];
                        a.async = 1;
                        a.src = g;
                        m.parentNode.insertBefore(a, m)
                    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
                    if(typeof(ga) != 'undefined') {
                        ga('create', '<?=$googleanalitycs?>', 'auto');
                        ga('send', 'pageview');
                        ga('require', 'ec');
                        ga('set', '&cu', 'RUB');
                    }
                </script>
            <?php }

            /** Счетчик Google Analitics End**/

            /** Счетчик Yandex Metrix Begin**/


//        if (   Yii::$app->params['partnersset']['yandexcounter']['value']
//            && Yii::$app->params['partnersset']['yandexcounter']['active'] == 1){
            if (true) {
                //  $yandexcounter = Yii::$app->params['partnersset']['yandexcounter']['value'];
                $yandexcounter = '36825930';
                ?>
                <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function () {
                            try {
                                w.yaCounter<?=$yandexcounter?> = new Ya.Metrika({
                                    id:<?=$yandexcounter?>,
                                    clickmap: true,
                                    trackLinks: true,
                                    accurateTrackBounce: true,
                                    webvisor: true,
                                    trackHash: true,
                                    ecommerce: "container-fluid float"
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
            <?php }

            /** Счетчик Yandex Metrix End**/

        }else{
            return FALSE;
        }
        }


}