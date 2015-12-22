<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */


unset($order['ship']);
unset($order['discount']);
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
                            <h1><a style="color:black; text-align: center" target=" _blank" href="http://<?= $site ?>"><?= $site_name ?></a></h1>
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
                   href="http://<?= $site ?>/site/news">Новости</a>
                <a style="margin-left:8px;color:#282828;"
                   href="http://<?= $site ?>/site/delivery">Доставка</a>
                <a style="margin-left:8px;color:#282828;"
                   href="http://<?= $site ?>/site/contacts">Контакты</a>
                <a style="margin-left:8px;color:#282828;"
                   href="http://<?= $site ?>/site/lk">Личный кабинет</a>
                <a style="margin-left:8px;color:#282828;"
                   href="http://<?= $site ?>/site/requestorders">Ваши заказы</a>

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
                                            Здравствуйте, <?= $user->name ?></p>

                                        <p>Спасибо, что воспользовались услугами нашего магазина</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding-top:0;padding-bottom:0;" colspan="2">
                                        <p style="font-family:officinaserifcBook,sans-serif;font-size:20px;">Статус Вашего заказа
                                            № <?= $id ?> от <?= $date_order ?> изменился. Новый статус: <span style="font-weight: bold">Ожидает оплаты</span></p>
                                        <p>По данным заказа будет сформирован и отправлен Вам на почту счет для оплаты</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:0;padding-bottom:0;" colspan="2">
                                        <p style="font-size:15px;">

                                        </p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="2" style="padding-top:25px;padding-bottom:15px;">
                                        <p style="font-size:22px;font-family:officinaserifcBook,sans-serif;">Статус и состояние
                                            заказа вы можете посмотреть в <a
                                                href="http://<?= $site ?>/site/requestorders">личном
                                                кабинете:</a></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:0;padding-bottom:0;">

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