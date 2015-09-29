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
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name='yandex-verification' content='6af7ec36af3406db' />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head();
    $this -> registerCssFile('/themes/'.Yii::$app->params[constantapp]['APP_THEMES'].'/css/site.css', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="container" style="position: relative; display: block; padding: 10px 0px 0px;"><p class="pull-right"><a class="top-link" href="/site/paying">Оплата</a> <a class="top-link" href="/site/delivery">Доставка</a> <a class="top-link" href="/site/contacts">Контакты</a></p></div>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->params[constantapp]['APP_NAME'],
                'brandUrl' => '/',
                'options' => [
                    'class' => 'navbar-inverse',
                    'style' => 'margin-top:0px; position: relative;'
                ],
            ]);
        ?>
        <div class="col-lg-5 navbar-form navbar-left" role="search" style="width: 26%;">
            <div class="form-group" style="width: 100%; display: table;">
                <input type="text" id="search" class="form-control" placeholder="Введите артикул или название" style="width: 100%; background: rgb(89, 89, 89) none repeat scroll 0% 0%; border: 1px solid rgb(89, 89, 89);color: #fff;">
            </div>
            <div   class="btn btn-default data-j" style="right: 15px; position: absolute; top: 0px; background: rgb(89, 89, 89) none repeat scroll 0% 0%; border: 1px solid rgb(89, 89, 89);"><i class="fa fa-search"></i>
            </div>
        </div>
        <div class="modal-cart" id="modal-cart"> </div><<ul class="nav navbar-nav navbar-left cart" ><i class="fa fa-cart-arrow-down fa-3x"></i><span class="cart-count"></span><span class="cart-price"></span></ul>
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
                    'label' => 'Профиль (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/lk'],
                    'linkOptions' => ['data-method' => 'post']
                ];
                $menuItems[] = [
                    'label' => 'Выход',
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
        <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid #00FFCC;">
        <div class="container">
        <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
        <p class="pull-right"><a href="/site/paying">Оплата</a><a href="/site/delivery">Доставка</a> <a href="/site/contacts">Контакты</a></p>
        </div>
    </footer>
    <?php
    $this -> registerJsFile('/themes/'.Yii::$app->params[constantapp]['APP_THEMES'].'/js/script.js', ['depends'=> ['yii\web\JqueryAsset', 'yii\jui\JuiAsset']]);
    $this->endBody();
   ;?>
</body>
</html>
<?php $this->endPage() ?>