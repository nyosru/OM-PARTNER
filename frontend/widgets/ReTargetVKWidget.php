<?php

namespace frontend\widgets;

use Yii;

class ReTargetVKWidget extends \yii\bootstrap\Widget
{
    public function run()
    {
        parent::init();

        ?>
        <script>
            $(window).on('load', function(){
                if(window.Image){
                    if(new Image()){
                    var redirectvk = document.createElement('img');
                    redirectvk.src = location.protocol + '//vk.com/rtrg?r=m6iuhme/q3kSpJN3TA2OM*/0XAyV6bXgntQV/a0z/sVI0E1uC0ZM/nrXAHk2EqfAZPfYIY3F5PXWglr*y5o0UWLhNSqKi6no/mzUpKwofjsx5Gx2AbJgQR7EMFf1QLfxA8WANnW33yDTdZT2J9b9ttOF1MKHAB89SJHblCnMjWw-&pixel_id=1000054204';
                    document.documentElement.appendChild(redirectvk);
                    redirectvk.onload = redirectvk.onerror = function () {
                        if (!this.executed) { // выполнится только один раз
                            this.executed = true;
                        }
                    };
                    redirectvk.onreadystatechange = function () {
                        var self = this;
                        if (this.readyState == "complete" || this.readyState == "loaded") {
                            setTimeout(function () {
                                self.onload()
                            }, 0);
                        }
                    };
                }
            }
            });
            </script>
        <?php
    }


}