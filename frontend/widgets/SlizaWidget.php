<?php

namespace frontend\widgets;

use Yii;

class SlizaWidget extends \yii\bootstrap\Widget
{
    public $id = 842;
    public $hash = '2a7bebeb9808e01a869c9f734db908e3';

    public function run()
    {
        parent::init();

        ?>

        <script>
            $(window).on('load', function(){
                var script = document.createElement('script');
            script.src = "https://sliza.ru/widget.php?id=<?=$this->id?>&h=<?=$this->hash?>&t=s";
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