<?php
use yii\helpers\Html;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>

<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body style="font-family: Open Sans,Helvetica Neue,sans-serif, sans-serif;">
<?php $this->beginBody() ?>
<div class="wrapper" style="border:1px solid black; width:100%; margin:auto; padding:10px; box-sizing: border-box">
    <div class="logo" style=" width:100%; margin:auto; text-align:center ;box-sizing: border-box">
        <img src="/images/mailer/logo.png" alt="Интернет магазин Одежда Мастер" />
    </div>
    <div class="link-block" style="margin:auto; padding: 10px; width:100%;  text-align:center ;box-sizing: border-box">
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Распродажа</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Новинки сегодня</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Бренды</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Женщинам</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Мужчинам</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Детям</a>
        <a href="#" style="line-height:1.5; padding: 10px 10px;text-decoration: none; color: #333">Красота</a>
    </div>
    <div class="delimiter">
        <hr style="width:80%; border:1px solid rgb(234, 81, 109);"/>
        <hr style="width:75%; border:1px solid rgb(0, 165, 161);"/>
        <hr style="width:70%; border:1px solid rgb(254, 213, 23);"/>
    </div>


    <?= $content ?>


    <div class="new-products">
        <div class="new-product-wrap">
            <div class="head" style="text-align:center;line-height:1.5; padding: 10px 10px;text-decoration: none; color: black; font-size: 18px">
                Обратите внимание на наши новинки
            </div>
            <div class="products" style="text-align: center;">
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание ОписаниеОписаниеОписаниеОписаниеОписание ОписаниеОписание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
                <div class="product" style="margin: auto; display: inline-block; width: 15%;">
                    <img src="img.jpg" style="width:100%" />
                    <div style="overflow: hidden; max-height: 40px; min-height: 40px; font-size: 1vw">
                        Описание
                    </div>
                    <div>
                        Цена
                    </div>
                </div>
            </div>
            <div class="footer" style="margin:auto; padding: 30px ;text-align: center">
                <a href="#" style="color:#007BC1;">Все новинки за сегодня</a>
            </div>
        </div>
    </div>
    <div class="support-block" style="margin:auto ;text-align: center;font-size: 18px">
        <div class="header">
            Остались вопросы? Хотите пообщаться со специалистом?
            Выберите удобный способ связи
        </div>
        <div class="support-link">
            <div class="online" style="padding:5px; display: inline-block; color:rgb(0, 165, 161); width: 25%; min-width: 320px;height: 50px;border: 1px solid rgb(0, 165, 161); border-radius: 4px; margin: 17px;">
                Помощь<br/>онлайн
            </div>
            <div class="number" style="padding:5px; display: inline-block; width: 25%; color:rgb(234, 81, 109); min-width: 320px; height: 50px;border: 1px solid rgb(234, 81, 109); border-radius: 4px; margin: 17px;">
                Телефон<br/>+7 (495) 204-1583
            </div>
            <div class="mail" style="padding:5px; display: inline-block; width: 25%; min-width: 320px; color:#007BC1; height: 50px;border: 1px solid #007BC1; border-radius: 4px; margin: 17px;">
                емейл<br/>odezhda-master1
            </div>
        </div>
    </div>
    <div class="social" style="margin: auto; width: 90%; font-size: 18px; text-align: center; padding: 20px;">
        <div class="social-pretext" style="width: 70%; display: inline-block; text-align: left;">
            А еще мы доступны в соцсетях для вопросов, общения, дружбы
        </div>
        <div class="social-link" style="width: 25%; display: inline-block; text-align: right;">
            <div style="width: 30%; display: inline-block;">
                <img src="/images/mailer/vk.png"/>
            </div>
            <div style="width: 30%; display: inline-block;">
                <img src="/images/mailer/ok.png"/>
            </div>
            <div style="width: 30%; display: inline-block;">
                <img src="/images/mailer/inst.png"/>
            </div>
        </div>
    </div>
    <div class="mobile" style="margin: auto; width: 90%; font-size: 18px; text-align: center; padding: 20px;">
        <div class="pretext"  style="width: 70%; display: inline-block; text-align: left;">
            Хотите заказывать новинки где угодно одним из самых первых? Тогда скачайте наше приложение
        </div>
        <div class="playmarket-link"  style="width: 25%; display: inline-block; text-align: right;">
            <div class="play-market" style="width: 48%; display: inline-block;">
                <img src="/images/mailer/google.png" style="width: 75%;"/>
            </div>
            <div class="app-store" style="width: 48%; display: inline-block;">
                <img src="/images/mailer/app-store.png" style="width: 75%;"/>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="text" style="text-align: center">
            Хорошего настроения и приятных покупок на Одежда-Мастер! ОГРН 3127234234234234.
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
