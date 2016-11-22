<?php

namespace frontend\widgets;

use Yii;

class SlizaWidget extends \yii\bootstrap\Widget
{
    public function run()
    {
        parent::init();

        ?>

        <!-- Sliza.ru - Widget -->
        <script type="text/javascript" src="https://sliza.ru/widget.php?id=842&h=2a7bebeb9808e01a869c9f734db908e3&t=s"
                async defer></script>
        <!-- /// -->

        <?php
    }


}