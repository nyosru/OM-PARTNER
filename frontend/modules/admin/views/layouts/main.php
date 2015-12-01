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

$check = Yii::$app->params['constantapp']['APP_ID'];
\dmstr\web\AdminLteAsset::register($this);
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);

if($check == ''){
    die;
}
$name = Yii::$app->params['constantapp']['APP_NAME'];


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
    //    $this -> registerCssFile('/themes/'.Yii::$app->params['constantapp']['APP_THEMES'].'/css/site.css', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    //    $this -> registerJsFile('/themes/'.Yii::$app->params['constantapp']['APP_THEMES'].'/js/adminscript.js', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);


    ?>

</head>
<body>
<?php $this->beginBody() ?>
<div class="container" style="position: relative; display: block; padding: 10px 0px 0px;"></div>
<div class="wrap">

    <?php
    if (($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
        $name = $namecustom;
    }
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
    <div class="container" id="partners-main">
        <div class="container" id="partners-main-left-back-admin">
            <div id="partners-main-left">
                <div id="partners-main-left-cont">
                    <div class="header-catalog"><i class="fa fa-bars"></i> МЕНЮ
                    </div>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link users"><a href="/admin">Настройки</a></div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link users"><a href="/admin/default/requestusers">100%100Пользователи</a></div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link users"><a href="/admin/default/requestorders">Заказы</a></div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link news"><a href="/admin/default/newspage">Новости</a></div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link news"><a href="/admin/default/commentspage">Комментарии</a></div>
                        </li>
                    </ul>
                    <ul id="accordion" class="accordion">
                        <li class="">
                            <div class="link news"><a href="/admin/default/requestpage">Заявки</a></div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container-fluid" id="partners-main-right-back-admin">
            <div id="partners-main-right" class="bside">
                <?= $content ?>
            </div>
        </div>
</div>
<div style="height: 60px"></div>
<footer class="footer">
    <hr style="width: 55%; border: 1px solid rgb(255, 191, 8); position: absolute; right: 1px; top: 15px;">
    <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid rgb(2, 243, 200);">
    <div class="container">
        <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody();
Yii::$app->params['adminasset']->registerAssetFiles($this); ?>

</body>
</html>
<?php $this->endPage() ?>
