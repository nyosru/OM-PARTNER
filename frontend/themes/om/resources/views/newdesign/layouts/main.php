<?php
use frontend\assets\AppAsset;
use yii\helpers\Html;
use frontend\widgets\SlizaWidget;
/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="ru-RU">
    <head>
        <meta charset="<?=Yii::$app->charset; ?>"/>
        <meta name='yandex-verification' content='6af7ec36af3406db'/>
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Favicons Icon -->
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

        <link rel="search" type="application/opensearchdescription+xml" title="Поиск по товарам" href="<?=BASEURL ;?>/addsearch">

        <?=Html::csrfMetaTags(); ?>

        <title><?=Html::encode($this->title);?></title>
        <?php $this->head();

        ?>
        <?=\frontend\widgets\Alert::widget();?>
        <?=\frontend\widgets\Metrics::widget();?>
        
        <!-- Mobile Specific -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200italic,300,300italic,400,400italic,600,600italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300,700,900' rel='stylesheet' type='text/css'>
    </head>
    <?php $this->beginBody(); ?>
    <body class="cms-index-index cms-home-page">
    <div id="page">


        <?php echo $this->render('part/_header.php') ?>
        <?php echo $this->render('part/_navbar.php') ?>
        

        <?php  echo $content ;?>
        <?php //todo: import content ?>

        <?php echo $this->render('part/_features.php') ?>
        <?php echo $this->render('part/_footer.php') ?>

    </div>
    <?php echo $this->render('part/_mobile-navbar.php') ?>
    <?php
    $this->endBody();
    Yii::$app->params['assetsite']->registerAssetFiles($this);
    ?>

    <?=SlizaWidget::widget(['id'=>123,'hash'=>'test'])?>
    </body>
    </html>
<?php $this->endPage() ?>