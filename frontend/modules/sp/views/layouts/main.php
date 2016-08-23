<?php

/* @var $this \yii\web\View */
/* @var $content string */
\frontend\assets\AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900italic,900"
        rel="stylesheet" type="text/css">
    <link rel="search"
          type="application/opensearchdescription+xml"
          title="Поиск по товарам"
          href="<?= BASEURL ?>/addsearch">

    <?= \yii\helpers\Html::csrfMetaTags() ?>
    <title><?= \yii\helpers\Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>

<style>
    .lksp-main-menu{
        display: inline-block;
        margin-right: 16px;
    }
    .lksp-main-menu:active, .lksp-main-menu:focus, .lksp-main-menu:hover{
        border-bottom: 2px solid #009f9c;
    }
    .lksp-main-menu:hover{
        border-bottom: 2px solid #009f9c;
    }
</style>

<body
    style="background:#FFF;font-family: Roboto,Helvetica Neue,sans-serif;font-style: normal;font-weight: 300;ьшт-width: 1440px;color:#333;margin-left: auto;margin-right: auto;height: 100%;">
<?php $this->beginBody(); ?>
<div class="wrap">
    <?php
    if (
        ($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE
        && Yii::$app->params['partnersset']['logotype']['active'] == 1
    ) {
        $name = $namecustom;
    } else {
        $name = Yii::$app->params['constantapp']['APP_NAME'];
    }
    ?>
    <div class="">
        <div class="partners-main-left-cont" style="height: 100px;">
            <div style="border-bottom: 1px solid #CCC;background: #FFF;position: relative;height: 100%;width: 100%;padding: 20px;">
                <div
                    style="text-align:center; position: absolute;top: 0px;bottom: 0px;right: 0px;left: 0px;margin: auto;display: inline-block;width: 97%;height: 80%;">
                    <div style="width: 33%;position: relative;display: inline-block;height: 100%;">
                        <div
                            style="margin: 25px;position: absolute;bottom: 0px;top: 0px;right: 0px;left: 0px;font-size: 18px;font-weight: 400;text-align: left;line-height: 32px;">
                            <a class="lksp-main-menu" href="/sp/default/orders">Заказы</a>
                            <a class="lksp-main-menu" href="/sp/default/index">Клиенты</a>
                            <a class="lksp-main-menu" href="/sp/default/all-clients">Все клиенты</a>
                        </div>
                    </div>
                    <div style="width: 33%;position: relative;display: inline-block;height: 100%;">
                        <div
                            style="margin: 12px;position: absolute;bottom: 0px;top: 0px;right: 0px;left: 0px;font-size: 18px;font-weight: 400;text-align: center;">
                            <div>
                                <?php if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                                    echo '<span>' . str_replace('</p>', '', str_replace('<p>', '', $logotype)) . '</span>';
                                } else {
                                    $logotype = '';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div style="width: 33%;position: relative;display: inline-block;height: 100%;">
                        <div
                            style="margin: 24px 4px;position: absolute;bottom: 0px;top: 0px;right: 0px;left: 0px;font-size: 14px;font-weight: 400;text-align: right;line-height: 32px;">
                            <div>
                                Выйти <img style="padding: 0px 10px;"
                                           src="/images/lksp/logout.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $content ?>
    </div>
    <footer class="footer" style="background:#FFF">
        <hr class="linebottom1">
        <hr class="linebottom2">
        <div class="" style="margin: 0px 25px;">
            <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
            <div style="margin: 0% 25%; float: left;">
                <?= \frontend\widgets\Metrics::widget(); ?>
            </div>
        </div>
    </footer>
</div>

<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);

?>
</div>
</body>
</html>
<?php $this->endPage() ?>


