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
    <meta name="viewport" content=" initial-scale=1.0">
    <meta charset="<?= Yii::$app->charset ?>"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.0/locale/ru.js"></script>
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
<body
        style="    position: fixed;background:#FFF;font-family: Roboto,Helvetica Neue,sans-serif;font-style: normal;font-weight: 300;min-width: 1440px;color:#333;margin-left: auto;margin-right: auto;height: 100%;">
<?php $this->beginBody(); ?>
<?= $content ?>
<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);

?>
</body>
</html>
<?php $this->endPage() ?>


