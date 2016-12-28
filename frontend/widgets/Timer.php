<?php

namespace frontend\widgets;

use yii\helpers\Html;

class Timer extends \yii\bootstrap\Widget
{
    public $time = 60;

    public function init()
    {

        ?>
        <script type="text/javascript">
            function timer() {
                var obj = document.getElementById('RealButton');
                var regexp = /(\d+)/i;
                var RealTimer = regexp.exec(obj.innerHTML)[0];
                RealTimer = RealTimer - 1;
                if (RealTimer < 0) RealTimer = 0;
                obj.innerHTML =  RealTimer ;
                if (RealTimer == 0) {
//                    location.replace("#");
                    $('.loading').remove();
                    return true;
                }
                else {
                    setTimeout(timer, 1000);
                }
            }
            setTimeout(timer, 1000);
        </script>

        <style>
            .loading {
                position: absolute;
                left: 50%;
                top: 50%;
                margin: -60px 0px 0px -60px;
                background: #FFF none repeat scroll 0% 0%;
                width: 60px;
                height: 60px;
                margin-left: 20px;
                border-radius: 100%;
                border: 3px solid rgb(0, 165, 162);
            }
            .loading::after {
                content: "";
                height: 120%;
                position: absolute;
                border-radius: 100%;
                top: -10%;
                left: -10%;
                opacity: 0.7;
                box-shadow: -4px -5px 3px -5px rgb(255, 191, 8);
                animation: 2s linear 0s normal none infinite running rotate;
                width: 120%;
            }
            .loading::before {
                content: "";
                height: 80%;
                position: absolute;
                border-radius: 100%;
                top: 10%;
                left: 10%;
                opacity: 0.7;
                box-shadow: -4px -5px 3px -5px rgb(234, 81, 109);
                animation: 2s linear 0s normal none infinite running inversrotate;
                width: 80%;
            }
            @keyframes rotate {
                0% {
                    transform: rotateZ(0deg);
                }
                100% {
                    transform: rotateZ(360deg);
                }
            }
            @keyframes inversrotate {
                0% {
                    transform: rotateZ(360deg);
                }
                100% {
                    transform: rotateZ(0deg);
                }
            }
        </style>
        <div class="loading"><span style="top: 0px; position: absolute; bottom: 0px; height: 45%; margin: auto; left: 0px; right: 0px; width: 100%; font-weight: 400; font-size: 18px; text-align: center; color:#000;" id="RealButton" href="#">
               <?=$this->time?>
            </span></div>

        <?php
    }
}


