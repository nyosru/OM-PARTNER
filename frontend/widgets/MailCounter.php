<?php

namespace frontend\widgets;

use Yii;

class MailCounter extends \yii\bootstrap\Widget
{
    public function run()
    {

        parent::init();

        ?>
        <!-- Rating@Mail.ru counter -->
        <script type="text/javascript">
            var _tmr = window._tmr || (window._tmr = []);
            _tmr.push({id: "2845429", type: "pageView", start: (new Date()).getTime()});
            (function (d, w, id) {
                if (d.getElementById(id)) return;
                var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
                ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
                var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
                if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
            })(document, window, "topmailru-code");
        </script>
        <noscript><div style="position:absolute;left:-10000px;">
            <img src="//top-fwz1.mail.ru/counter?id=2845429;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
        </div>
        </noscript>
        <!-- //Rating@Mail.ru counter -->
        <script>
            $(window).on('load', function(){
                var script = document.createElement('script');
                script.src = "https://sliza.ru/widget.php?id=842&h=2a7bebeb9808e01a869c9f734db908e3&t=s";
                document.documentElement.appendChild(script);
                script.onload = script.onerror = function() {
                    if (!this.executed) { // выполнится только один раз
                        this.executed = true;
                    }
                };
                script.onreadystatechange = function() {
                    var self = this;
                    if (this.readyState == "complete" || this.readyState == "loaded") {
                        setTimeout(function() {
                            self.onload()
                        }, 0);
                    }
                };
            });
        </script>
        <?php
    }


}