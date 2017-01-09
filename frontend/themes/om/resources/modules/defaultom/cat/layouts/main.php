<?php

/* @var $this \yii\web\View */
/* @var $content string */
\frontend\assets\AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
    <?php $this->head(); ?>
</head>

<style>
    /* imports */
    @import url(http://fonts.googleapis.com/css?family=Lobster);

    /* resets */
    *,
    *:before,
    *:after {
        box-sizing: border-box;
    }
    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    /* global */
    body {
        font-family: sans-serif;
        font-size: 14px;
        line-height: 1.3;
        margin: 0;
        background-color: #F5F5F5;
    }

    .container_95 {
        max-width: 95%;
        margin: 0 auto;
    }
    .wrapper {
        margin: 0 auto;
        /*padding: 20px;*/
        /*max-width: 95%;*/
        background-color: #F5F5F5;
    }
    h1 {
        font-family: "Lobster", cursive;
        font-size: 2em;
        margin-bottom: 10px;
    }
    h2 {
        font-weight: 700;
    }

    /* grid */
    .row {
        display: flex;
        flex-flow: row wrap;
        margin: 0 auto;
    }
    .row > [class*="col-"]:first-child {
        padding-left: 0px !important;
    }

    .row > [class*="col-"]:last-child {
        padding-right: 0px !important;
    }

    [class*="col-"] {
        padding: 0px 2.5px;
        width: 100%;
    }

    .center {margin: 0 auto; text-align: center}
    .preview_window_box .preview_window { box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, .5);}
    /*widow*/
    .header_bar {margin-bottom: 20px;z-index: 1; text-align: center;  height: 55px;border-bottom: 1px solid rgb(204, 204, 204);}
    .header_bar_img { margin: 0 auto; background-color: #F5F5F5;  text-align: center; z-index: 2; width: 190px}
    .special_header {display: flex; text-align: center; margin-bottom: 20px}
    .about_text { font-size: 16px;}

    #owl_lend_products {
        display: flex;
    }
    #owl_lend_products .item{
        display: flex;
        background: #F5F5F5;
        margin: 10px;
        color: #FFF;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        text-align: center;
        border: 1px solid #e3e3e3;
        min-height: 450px;
        border-radius: 2px;
        min-width: 245px;
        max-width: 300px;
        padding: 20px;
    }
    #owl_lend_products .item .product-photo{
        display: flex;
        min-height: 350px;
    }
    #owl_lend_products .item .product-photo .img-block{
        margin: auto 0;
    }
    #owl_lend_products .item .price-product-cat {
        margin-top: 25px;
        display: block;
    }
    #owl_lend_products .item .price-product-cat .strike{
        font-size: 18px;
        color: #9e9e9e;
        font-weight: 300;
        text-decoration: line-through;
    }
    #owl_lend_products .item .price-product-cat .new-price{
        font-size: 18px;
        font-weight: 500;
        /*margin: -5px 5px;*/
        color: black;
    }

    #owl_lend_products .item:hover {box-shadow: 0px 0px 20px -6px rgba(0,0,0,1);  }

    .action_grid {
        padding: 0px 10px;
    }
    @media all and ( min-width: 600px ) {

        /* set col widths */
        .col-1 {
            width: 100%;
        }
        .col-2-3 {
            width: 66.66%;
        }
        .col-1-2 {
            width: 50%;
        }
        .col-1-3 {
            width: 33.33%;
        }
        .col-1-4 {
            width: 25%;
        }
        .col-1-5 {
            width: 20%;
        }
        .col-1-8 {
            width: 12.5%;
        }
        .col-9-10 {
            width: 90%;
        }
        .preview_zoom {
            zoom: 50%;
        }

    }
</style>
<body>
<?php $this->beginBody(); ?>
<?= \frontend\widgets\Alert::widget(); ?>

<div class="wrapper">
    <div class="row">
        <div class="col-1">
            <div class="header_bar" style="height: 55px;border-bottom: 1px solid rgb(204, 204, 204);">
                <div class="header_bar_img">
                    <img src="/images/logo/OM_code.png">
                </div>
            </div>
        </div>
    </div>

    <?= $content; ?>
</div>

<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);
?>
</body>
</html>
<?php $this->endPage() ?>
