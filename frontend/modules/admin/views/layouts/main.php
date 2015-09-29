<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use common\models\Partners;
use rmrevin\yii\fontawesome;
/* @var $this \yii\web\View */
/* @var $content string */

$check = Yii::$app->params[constantapp]['APP_ID'];



if($check == ''){
    die;
}
$name = Yii::$app->params[constantapp]['APP_NAME'];
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();
    $this -> registerCssFile('/themes/'.Yii::$app->params[constantapp]['APP_THEMES'].'/css/site.css', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    $this -> registerJsFile('/themes/'.Yii::$app->params[constantapp]['APP_THEMES'].'/js/adminscript.js', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);


    ?>

</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">

    <?php
    NavBar::begin([
        'brandLabel' =>  Yii::$app->params[constantapp]['APP_NAME'],
        'brandUrl' => '/',
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
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
