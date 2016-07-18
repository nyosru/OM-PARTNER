<?php
\frontend\assets\AppAsset::register($this);
use yii\helpers\Html;
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();

    //    $this->registerCssFile('/themes/' . Yii::$app->params['constantapp']['APP_THEMES'] . '/css/site.css', ['depends' => ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    ?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Auto-height - fullPage.js</title>
        <meta name="author" content="Alvaro Trigo Lopez" />
        <meta name="description" content="fullPage auto-height example." />
        <meta name="keywords"  content="fullpage,jquery,demo,screen,fullscreen,auto-height,full-screen" />
        <meta name="Resource-type" content="Document" />


        <link rel="stylesheet" type="text/css" href="../jquery.fullPage.css" />
        <link rel="stylesheet" type="text/css" href="examples.css" />

        <!--[if IE]>
        <script type="text/javascript">
            var console = { log: function() {} };
        </script>
        <![endif]-->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>

        <script type="text/javascript" src="../jquery.fullPage.js"></script>
        <script type="text/javascript" src="examples.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#fullpage').fullpage({
                    verticalCentered: true,
                    anchors: ['anchor1', 'anchor2', 'anchor3'],
                    sectionsColor: ['#1bbc9b', '#4BBFC3', '#7BAABE']
                });
            });
        </script>

        <style>
            .myContent{
                height: 300px;
            }
        </style>

    </head>
</head>
<body  style="font-family: Open Sans,Helvetica Neue,sans-serif, sans-serif; font-style: normal; font-weight: 300; ">
<?php $this->beginBody(); ?>
<?= $content ?>
<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);

?>
</body>
</html>
<?php $this->endPage() ?>

