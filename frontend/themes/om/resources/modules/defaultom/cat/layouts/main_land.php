<?php

/* @var $this \yii\web\View */
/* @var $content string */
\frontend\assets\AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();
?>
<!DOCTYPE html >
<html lang="en" class="o-cat-main">
<head>
    <meta charset="UTF-8">
    <?= \yii\helpers\Html::csrfMetaTags() ?>
    <title><?= \yii\helpers\Html::encode($this->title) ?></title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <?php $this->head(); ?>
    <?=\frontend\widgets\Metrics::widget();?>
</head>
<body class="o-cat-main">
<?php $this->beginBody(); ?>
<?= \frontend\widgets\Alert::widget(); ?>

<div class="wrapper">
    <?= $content; ?>
</div>

<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);

if(($ga = Yii::$app->session->get('ga'))){
    foreach ($ga as $gakey=>$gavalue){
        ?>
        <script>
            $(window).load(function () {
                if(typeof(ga) != 'undefined') {
                    ga('send', 'event', '<?=$gavalue['event']?>', '<?=$gavalue['location']?>')
                }
            });
        </script>
        <?php
    }
    $ga = Yii::$app->session->set('ga', []);
}
echo \frontend\widgets\StatWidget::widget();
echo \frontend\widgets\MailCounter::widget();
echo  \frontend\widgets\ReTargetVKWidget::widget();
echo  \frontend\widgets\SlizaWidget::widget();
?>

</body>
</html>
<?php $this->endPage() ?>
