<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="order" style="border-radius: 2px; display: block; width: 1024px; margin-left: auto; margin-right: auto; box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1); padding: 10px; margin-bottom: 20px;">
    <div style="text-align: center;"><h1><a href="http://<?=$sait?>"><?=$sait?></a></h1></div>
    <h3 style="font-size: 20px; text-transform: uppercase; padding: 20px 30px;">Здравствуйте!</h3>
    <h3 style="padding: 0px 30px;">Благодарим Вас за регистрацию на сайте интернет магазина модной одежды, обуви и аксессуаров <a href="http://<?=$sait?>"><?=$sait?></a></h3>
    <h3 style="padding: 0px 30px;">Мы рады, что Вы теперь с нами!</h3>
    <h5 style="float: left; text-align: center; width: calc(50% - 2px);  border: 1px solid rgb(47, 47, 47); border-radius: 7px 0px 0px 7px;">Логин: <?= $username ?></h5>
    <h5 style="width: calc(50% - 2px); float: right; text-align: center; border: 1px solid rgb(47, 47, 47); border-radius: 0px 7px 7px 0px;">Пароль: <?= $password ?></h5>
    <h2 style="clear: both;">Приятных покупок на <a href="http://<?=$sait?>"><?=$sait?></a>!</h2>
</div>
<header style="top: 1px;" class="header">
    <hr style="width: 55%; border: 1px solid rgb(255, 191, 8); position: absolute; right: 1px; top: 15px;">
    <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid rgb(2, 243, 200);">
</header>
<footer style="bottom: 1px; position: relative;" class="footer">
    <hr style="width: 55%; border: 1px solid rgb(255, 191, 8); position: absolute; right: 1px; top: 15px;">
    <hr style="width: 55%; position: absolute; left: 1px; top: 1px; border: 1px solid rgb(2, 243, 200);">
</footer>