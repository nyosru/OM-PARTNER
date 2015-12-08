<?php
use yii\helpers\Html;
use Yii;
use common\traits\Imagepreviewfile;
/* @var $this yii\web\View */
/* @var $user common\models\User */

$user=unserialize($user);
$order=unserialize($order);
unset($order['ship']);
unset($order['discount']);
unset($order['discounttotalprice']);
unset($order['paymentmethod']);
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
        <td style="height:44px;background:#282828;">

        </td>
    </tr>
    <tr>
        <td style="padding:0;">
            <table bgcolor="#fff;" width="800" border="0" celpadding="0" cellspacing="0" align="center"
                   style="font-family:arial,sans-serif;background-color:#fff;">
                <tbody>
                <tr>
                    <td style="padding:10px 207px 10px 100px;width:100px;">
                        <a href=<?= $site ?>" target=" _blank"><?= $site_name ?></a>
                    </td>
                    <td style="">
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
        <td style=""></td>
    </tr>

    <tr style="text-align:center;height:30px;">
        <td style="font-size:14px;font-family:officinaserifcBook,sans-serif;">
            <a style="margin-left:0px;color:#282828;"
               href="<?= $site ?>/site/catalog#!cat=1632&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword="
               target="_blank">Женщинам</a>
            <a style="margin-left:8px;color:#282828;"
               href="<?= $site ?>/site/catalog#!cat=1668&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword="
               target="_blank">Мужчинам</a>
            <a style="margin-left:8px;color:#282828;"
               href="<?= $site ?>/site/catalog#!cat=1903&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword="
               target="_blank">Детям</a>
            <a style="margin-left:8px;color:#282828;"
               href="<?= $site ?>/site/catalog#!cat=2065&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword="
               target="_blank">На дачу</a>
            <a style="margin-left:8px;color:#282828;"
               href="<?= $site ?>/site/catalog#!cat=932&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword="
               target="_blank">Аксесуары</a>

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
                                    <p style="font-family:officinaserifcBook,sans-serif;font-size:20px;">Ваш заказ
                                        № <?= $id ?> от <?= $date_order ?> принят и ожидает проверки администратором</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top:0;padding-bottom:0;" colspan="2">
                                    <p style="font-size:15px;">

                                    </p>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" style="padding-top:20px;padding-bottom:0;">
                                    <p style="font-size:22px;font-family:officinaserifcBook,sans-serif;padding-top:10px;">
                                        Подробности заказа</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-bottom:15px;padding-top:0;">
                                    <table bgcolor="#FFFFFF;" width="538" border="0" celpadding="0" cellspacing="0"
                                           align="center"
                                           style="font-family:arial,sans-serif;background-color:#FFFFFF;border:1px solid #bababa;border-radius:4px;">
                                        <tbody>
                                        <tr>
                                            <td style="color:#757575;padding:20px;border-bottom:1px solid #bababa;"
                                                valign="middle">
                                                Контактное лицо
                                            </td>
                                            <td style="font-family:officinaserifcBook,sans-serif;padding:20px;border-bottom:1px solid #bababa;">
                                                <?= $user->lastname ?> <?= $user->name ?> <?= $user->secondname ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color:#757575;padding:20px;border-bottom:1px solid #bababa;"
                                                valign="middle">
                                                Телефон
                                            </td>
                                            <td style="font-family:officinaserifcBook,sans-serif;padding:20px;border-bottom:1px solid #bababa;">
                                                <span class="wmi-callto"><?= $user->telephone ?></span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:25px;padding-bottom:15px;">
                                    <p style="font-size:22px;font-family:officinaserifcBook,sans-serif;">Вы заказали</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding-top:0;padding-bottom:0;">
                                    <table style="width: 80%; margin: auto;">
                                        <tbody>
                                        <tr style="border-bottom: 1px solid rgb(44, 44, 44);">
                                            <td style="width: 60%; border-bottom: 1px solid rgb(44, 44, 44);"></td>
                                            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">
                                                Кол-во
                                            </td>
                                            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">
                                                Цена
                                            </td>
                                            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">
                                                Сумма
                                            </td>
                                        </tr>
                                        <? foreach ($order as $key => $value) {
                                            $value[5] = str_replace(')', ']]]]', $value[5]);
                                            $value[5] = str_replace(' ', '[[[[]]]]', $value[5]);
                                            $value[5] = str_replace('(', '[[[[', $value[5]);


                                            ?>

                                            <tr>
                                                <td style="width: 60%;">
                                                    <? $prew = new Imagepreviewfile(); ?>
                                                    <img style="width:70%"
                                                         src="<?php echo $prew->viewpreviewfile('http://odezhda-master.ru/images/', $value[5], '@webroot/images/'); ?>"/>
                                                </td>

                                                <td style="text-align: center;">
                                                    <?= $value[4] ?>
                                                </td>

                                                <td style="text-align: center;">
                                                    <?= $value[3] ?>
                                                </td>

                                                <td style="text-align: center;">
                                                    <?= (intval($value[4]) * intval($value[3])) ?> Руб.
                                                    <?php
                                                    $orders_total = $orders_total + (intval($value[4]) * intval($value[3]));
                                                    ?>
                                                </td>
                                            </tr>
                                        <? } ?>
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
        </td>
    </tr>
    </tbody>
</table>

</body>
</html>

