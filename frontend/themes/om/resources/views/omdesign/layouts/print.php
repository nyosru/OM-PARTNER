<?php
\frontend\assets\AppAsset::register($this);
use yii\helpers\Html;

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
</head>
<body>
<?php $this->beginBody(); ?>
<?= $content ?>
<?php
$this->endBody();
Yii::$app->params['assetsite']->registerAssetFiles($this);

?>
</body>
</html>
<?php $this->endPage() ?>

