<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$user=unserialize($user);
$order=unserialize($order);
unset($order['ship']);
unset($order['discount']);
unset($order['discounttotalprice']);
unset($order['paymentmethod']);
?>

<html><head></head><body><div style="width: 100%; height: 100%;">


    <div style="width: 100%; text-align: center; font-size: 30px; text-transform: uppercase; font-family: verdana;">
        <a href="<?= $site?>"><?= $site_name?></a>
    </div>
    <div style="width: 80%; margin: auto; border-radius: 15px; height: 55px; background: rgb(0, 0, 0) none repeat scroll 0% 0%; box-shadow: 3px 6px 8px -4px rgb(42, 42, 42);">
        <ul style="text-decoration: none; height: 100%; padding: 10px;">
            <li style="display: block; width: calc(18% - 4px); float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 5px; font-family: verdana; padding-bottom: 5px; border-right: 1px solid rgb(255, 255, 255);"><a style="color: white; text-decoration: none;" href="<?= $site?>/site/catalog#!cat=1632&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Женщинам</a></li>
            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="<?= $site?>/site/catalog#!cat=1668&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Мужчинам</a></li>
            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="<?= $site?>/site/catalog#!cat=1903&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Детям</a></li>
            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="<?= $site?>/site/catalog#!cat=2065&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">На дачу</a></li>
            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana;"><a style="color: white; text-decoration: none;" href="<?= $site?>/site/catalog#!cat=932&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Аксесуары</a></li>

        </ul>
    </div>

    <div style="margin-left: 12%; margin-top: 30px; font-size: 1.5em; font-family: verdana;">
        Здравствуйте, <?= $user->name?>  <?= $user->secondname?>
    </div>
    <div style="margin-left: 12%; margin-top: 10px; font-family: verdana;">
        Спасибо, за то что воспользовались услугами нашего магазина
    </div>

    <div style="text-align: center; width: 80%; border-radius: 15px; border: 1px solid rgb(0, 255, 204); margin: 20px auto; height: 55px;">
        <div style="width: calc(100% / 2 - 2px); float: left;">
            <div style="height: 25px; font-family: verdana; font-size: 13px; font-weight: 600; color: rgb(0, 255, 204); border-right: 1px solid rgb(0, 255, 204); padding-top: 5px;">
                Ваш заказ
            </div>
            <div style="border-right: 1px solid rgb(0, 255, 204); height: 25px;">
               № <?= $id?>  от <?= $date_order?>
            </div>
        </div>
        <div>
            <div style="padding-top: 5px; height: 25px; font-family: verdana; font-size: 13px; font-weight: 600; color: rgb(0, 255, 204);">
                Состояние
            </div>
            <div style="height: 25px;">
                Отменен
            </div>
        </div>
    </div>
    <hr style="width: 45%; float: left; margin: 10px 45%; color: rgb(0, 255, 204);">
    <hr style="width: 45%; float: right; margin: 0px 45%; color: rgb(255, 191, 8);">
    <div style="width: 80%; margin: auto;">
        С уважением <a href="<?= $site?>"><?= $site_name?></a>
    </div>
</div></body></html>
