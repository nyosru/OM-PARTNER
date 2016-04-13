<?php
use yii\helpers\Html;
use backend\assets\AdminLteAsset;
use dmstr\helpers\AdminLteHelper;
/* @var $this \yii\web\View */
/* @var $content string */

    if (class_exists('backend\assets\AdminLteAsset')) {
        backend\assets\AdminLteAsset::register($this);
    } else {
        backend\assets\AppAsset::register($this);
    }



    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="skin-black sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody();
    $this->registerJsFile('/js/'.$this->context->module->id.'/script.js');?>
    $this->registerJsFile('/js/'.$this->context->module->id.'/moment.js');?>
    </body>
    </html>
    <?php $this->endPage() ?>