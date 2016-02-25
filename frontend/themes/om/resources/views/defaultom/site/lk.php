<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use \common\models\UserProfile;


$this -> title = 'Личный кабинет';



?>
<div class="circular"><i class="mdi mdi-perm-identity"></i></div>
<div class="" style="float: left; font-size: 20px; font-weight: 500; padding: 20px;">
<?=$cust['userinfo']['name'];?> <?= $cust['userinfo']['name'];?><br/><?= $cust['email'];?></div>
<div class="col-md-12 orders-metro">
    <div class="lk-order-status col-md-3">
        <div class="item">ТИ</div>
        <div class="item">100</div>
        <div class="title">Ожидает проверки</div>
        </div>
    <div class="lk-order-status col-md-3"><div class="item">ТИ</div>
        <div class="item">100</div>
        <div class="title">Ожидает оплаты</div></div>
    <div class="lk-order-status col-md-3"><div class="item">ТИ</div>
        <div class="item">100</div>
        <div class="title">Ожидает сборки</div></div>
    <div class="lk-order-status col-md-3"><div class="item">ТИ</div>
        <div class="item">100</div>
        <div class="title">Ожидает доставки</div></div>
</div>
