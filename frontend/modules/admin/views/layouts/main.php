<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use common\models\Partners;
/* @var $this \yii\web\View */
/* @var $content string */
$run = new Partners();
$check = $run->GetId($_SERVER['HTTP_HOST']);



if($check == ''){
    die;
}
$name = $run->GetNamePartner($check);
$template = $run->GetTemplate($check);
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <?php $this->head();
    $this -> registerCssFile('/themes/'.$template.'/css/site.css', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    $this -> registerJsFile('/themes/'.$template.'/js/adminscript.js', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);


    ?>

</head>
<body>
<?php $this->beginBody() ?>
<div class="container" style="position: relative; display: block; padding: 10px 0px 0px;"><p class="pull-right"><a href="#">Оплата</a> <a href="#">Доставка</a> <a href="#">Контакты</a></p></div>
<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' => $name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse',
            'style' => 'margin-top:0px; position: relative;'
        ],
    ]);

    ?>
      <?

    $menuItems = [];
    if(Yii::$app->user->can('admin')){
        $menuItems[] = ['label' => 'Админ', 'url' => ['/admin']];

    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
        $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
    }else{
        $menuItems[] = [
            'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
    }



    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
    ?>


    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>
    <?= $content ?>

</div>
<div style="height: 60px"></div>
<footer class="footer">
    <hr style="width: 55%; border: 1px solid rgb(255, 191, 8); position: absolute; right: 1px; top: 15px;">
    <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid rgb(2, 243, 200);">
    <div class="container">
        <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
        <p class="pull-right"><a href="#">Оплата</a> <a href="#">Доставка</a> <a href="#">Контакты</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
