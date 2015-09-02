<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use common\models\Partners;
use yii\helpers\BaseUrl;

use yii\jui\Slider;
$this -> title = 'Личный кабинет';
?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
               <div class="header-catalog"><i class="fa fa-bars"></i> МЕНЮ
                </div>
                <ul id="accordion" class="accordion"><li class=""><div id="profile-info" class="link">Общая информация</div></li></ul>
                <ul id="accordion" class="accordion"><li class=""><div id="profile-orders" class="link">Мои заказы</div></li></ul>
                <ul id="accordion" class="accordion"><li class=""><div id="profile-call" class="link">ПРОДОЛЖИТЬ ПОКУПКИ</div></li></ul>
            </div>

        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">



        </div>
    </div>

