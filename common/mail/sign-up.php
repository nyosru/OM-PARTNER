<?php
use yii\helpers\Html;
use Yii;
/* @var $this yii\web\View */
/* @var $user common\models\User */
$user=unserialize($user);
$order=unserialize($order);
unset($order['ship']);
unset($order['discount']);
unset($order['discounttotalprice']);
?>


<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<table width="800" bgcolor="#EBE8E1" border="0" celpadding="0" cellspacing="0" align="center"
       style="font-family:arial,sans-serif;background-color:#EEEAE5;">

    <tbody>

    <tr>
        <td style="padding:0;">
            <table bgcolor="#fff;" width="800" border="0" celpadding="0" cellspacing="0" align="center"
                   style="font-family:arial,sans-serif;background-color:#fff;">
                <tbody>
                <tr>
                    <td style="padding:10px 207px 10px 100px;width:100px; background-color: #00ca6d;">
                        <h1><a style="color:black; text-align: center" target=" _blank" href="http://<?= $sait ?>"><?= $sait ?></a></h1>
                    </td>
                    <td style="background-color: #00ca6d;">
                        <p style="padding-left:35px;">
                            <?
                            if (Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1) {
                                $tel = Yii::$app->params['partnersset']['contacts']['telephone']['value'];
                                echo '<span class="wmi-callto">' . $tel . '</span>';
                            } ?>
                        </p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>

    <tr style="text-align:center;height:30px;">
        <td style="font-size:14px;font-family:officinaserifcBook,sans-serif;">
            <a style="margin-left:0px;color:#282828;"
               href="http://<?= $sait ?>/site/news">Новости</a>
            <a style="margin-left:8px;color:#282828;"
               href="http://<?= $sait ?>/site/delivery">Доставка</a>
            <a style="margin-left:8px;color:#282828;"
               href="http://<?= $sait ?>/site/contacts">Контакты</a>
            <a style="margin-left:8px;color:#282828;"
               href="http://<?= $sait ?>/site/lk">Личный кабинет</a>
            <a style="margin-left:8px;color:#282828;"
               href="http://<?= $sait ?>/site/requestorders">Ваши заказы</a>

        </td>
    </tr>

    <tr>
        <td></td>
    </tr>
    <tr>
        <td style="padding-left:87px;padding-right:87px;padding-top:0;">
            <table bgcolor="#FFFFFF;" width="600" border="0" cellpadding="0" cellspacing="0" align="center"
                   style="font-family:arial,sans-serif;background-color:#EEEAE5;">
                <tbody>
                <tr>
                    <td style="padding-left:18px;padding-right:18px;padding:0;">
                        <table bgcolor="#FFFFFF;" width="600" border="0" cellpadding="30" cellspacing="0" align="center"
                               style="font-family:arial,sans-serif;background-color:#FFFFFF;border:1px solid #bababa;border-top:0;border-bottom-left-radius:4px;border-bottom-right-radius:4px;">
                            <tbody>
                            <tr>
                                <td colspan="2" style="padding-top:20px;padding-bottom:0;">
                                    <p style="font-size:28px;font-family:officinaserifcBook,sans-serif;">
                                        Здравствуйте ?></p>

                                    <p>Благодарим Вас за регистрацию на сайте интернет магазина модной одежды, обуви и аксессуаров<br>
                                    <a href="http://<?= $sait ?>"><?= $sait ?></a> Мы рады, что Вы теперь с нами!<br></p>
                                    <p>Ваш логин: <?= $username ?></p>
                                    <p>Ваш пароль: <?= $password ?></p>
                                    <p>Приятных и выгодных покупок на <a href="http://<?= $sait ?>"><?= $sait ?></a></p>
                                </td>
                            </tr>


                            <tr>
                                <td style="padding-top:0;padding-bottom:0;" colspan="2">
                                    <p style="font-size:15px;">

                                    </p>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>