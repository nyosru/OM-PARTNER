<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */


unset($order['ship']);
unset($order['discount']);
?>

<!--<html><head></head><body><div style="width: 100%; height: 100%;">-->
<!---->
<!---->
<!--    <div style="width: 100%; text-align: center; font-size: 30px; text-transform: uppercase; font-family: verdana;">-->
<!--        <a href="--><?//= $site?><!--">--><?//= $site_name?><!--</a>-->
<!--    </div>-->
<!--    <div style="width: 80%; margin: auto; border-radius: 15px; height: 55px; background: rgb(0, 0, 0) none repeat scroll 0% 0%; box-shadow: 3px 6px 8px -4px rgb(42, 42, 42);">-->
<!--        <ul style="text-decoration: none; height: 100%; padding: 10px;">-->
<!--            <li style="display: block; width: calc(18% - 4px); float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 5px; font-family: verdana; padding-bottom: 5px; border-right: 1px solid rgb(255, 255, 255);"><a style="color: white; text-decoration: none;" href="--><?//= $site?><!--/site/catalog#!cat=1632&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Женщинам</a></li>-->
<!--            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="--><?//= $site?><!--/site/catalog#!cat=1668&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Мужчинам</a></li>-->
<!--            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="--><?//= $site?><!--/site/catalog#!cat=1903&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Детям</a></li>-->
<!--            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana; border-right: 1px solid rgb(255, 255, 255); padding-bottom: 5px;"><a style="color: white; text-decoration: none;" href="--><?//= $site?><!--/site/catalog#!cat=2065&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">На дачу</a></li>-->
<!--            <li style="width: calc(18% - 4px); display: block; float: left; text-align: center; color: rgb(216, 216, 216); padding-top: 6px; font-family: verdana;"><a style="color: white; text-decoration: none;" href="--><?//= $site?><!--/site/catalog#!cat=932&count=20&start_price=0&end_price=1000000&prod_attr_query=&page=undefined&sort=10&searchword=">Аксесуары</a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!---->
<!--    <div style="margin-left: 12%; margin-top: 30px; font-size: 1.5em; font-family: verdana;">-->
<!--        Здравствуйте, --><?//= $order['delivery_name']?><!-- --><?//= $order['delivery_otchestvo']?>
<!--    </div>-->
<!--    <div style="margin-left: 12%; margin-top: 10px; font-family: verdana;">-->
<!--        Спасибо, за то что воспользовались услугами нашего магазина-->
<!--    </div>-->
<!---->
<!--    <div style="text-align: center; width: 80%; border-radius: 15px; border: 1px solid rgb(0, 255, 204); margin: 20px auto; height: 55px;">-->
<!--        <div style="width: calc(100% / 2 - 2px); float: left;">-->
<!--            <div style="height: 25px; font-family: verdana; font-size: 13px; font-weight: 600; color: rgb(0, 255, 204); border-right: 1px solid rgb(0, 255, 204); padding-top: 5px;">-->
<!--                Ваш заказ-->
<!--            </div>-->
<!--            <div style="border-right: 1px solid rgb(0, 255, 204); height: 25px;">-->
<!--                № --><?//= $id?><!--  от --><?//= $date_order?>
<!--            </div>-->
<!--        </div>-->
<!--        <div>-->
<!--            <div style="padding-top: 5px; height: 25px; font-family: verdana; font-size: 13px; font-weight: 600; color: rgb(0, 255, 204);">-->
<!--                Состояние-->
<!--            </div>-->
<!--            <div style="height: 25px;">-->
<!--                Ожидает платежа-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <table style="width: 80%; margin: auto;">-->
<!--        <tbody><tr style="border-bottom: 1px solid rgb(44, 44, 44);">-->
<!--            <td style="width: 50%; border-bottom: 1px solid rgb(44, 44, 44);">   </td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">Заказано</td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">В наличии</td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">Цена</td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">Сумма</td>-->
<!--        </tr>-->
<!--        --><?// foreach($order[''] as $value){?>
<?// if($value['first_quant'] == $value['products_quantity']){
//
//            $color = '#A2F5A2';
//
//            }elseif($value['products_quantity'] == 0){
//                $color = '#FC8686';
//            }else{
//                $color = '#F6F6A6';
//            }
//
//            ?>
<!--        <tr style="background: --><?//= $color?>/* none repeat scroll 0% 0%;">*/
/*            <td>*/
/*        */<?//  foreach(unserialize($model['order']) as $asvalue){
//            if($asvalue[0] == $value['products_id']){
//                $asvalue[5] = str_replace(')',']]]]', $asvalue[5]);
//                $asvalue[5] = str_replace(' ','[[[[]]]]', $asvalue[5]);
//                $asvalue[5] = str_replace('(','[[[[', $asvalue[5]);
//       ?><!--<img src="--><?//= $site?><!----><?//= '/site/imagepreview?src='.$asvalue[5]?><!--" width="200" height="200" />--><?//
//
//
//break;
//
//
//            }
//
//                }
//?>
<!--            </td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">-->
<!--             --><?//= $value['first_quant']?>
<!---->
<!--            </td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">-->
<!--                --><?//= $value['products_quantity']?>
<!---->
<!--            </td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">-->
<!--                --><?//= intval($value['final_price'])?><!-- Руб.-->
<!---->
<!--            </td>-->
<!--            <td style="text-align: center; border-bottom: 1px solid rgb(44, 44, 44);">-->
<!--                --><?//= intval($value['products_quantity'])*intval($value['final_price']) ?><!-- Руб.-->
<?// $orders_total = $orders_total+(intval($value['products_quantity'])*intval($value['final_price']) )?>
<!--            </td>-->
<!--        </tr>-->
<!---->
<!---->
<!--        --><?//}?>
<!--        <tr>-->
<!--        </tr>-->
<!---->
<!--        </tbody></table>-->
<!--    <div style="margin: auto; background: rgb(0, 255, 204) none repeat scroll 0% 0%; height: 40px; font-size: 25px; font-family: verdana; padding-top: 6px; text-align: right; width: calc(80% - 80px); padding-right: 80px; color: azure; font-weight: 600;">-->
<!--        Итого : --><?//= $orders_total?><!-- руб.-->
<!--    </div>-->
<!--    <div style="width: 80%; margin: auto;">-->
<!--        По доставке-->
<!--    </div>-->
<!--    <div style="width: 80%; margin: auto;">-->
<!--        Адрес доставки:  --><?//= $order['delivery_country']?><!--,  --><?//= $order['delivery_state']?><!--,  --><?//= $order['delivery_city']?><!--,  --><?//= $order['delivery_street_address']?><!--,  --><?//= $order['delivery_postcode']?>
<!--        <br>-->
<!--        Состояние заказа можно отслеживать в <a href="--><?//= $site.'/site/lk'?><!--">личном кабинете</a>-->
<!--        <br>-->
<!--    </div>-->
<!--    <hr style="width: 45%; float: left; margin: 10px 45%; color: rgb(0, 255, 204);">-->
<!--    <hr style="width: 45%; float: right; margin: 0px 45%; color: rgb(255, 191, 8);">-->
<!--    <div style="width: 80%; margin: auto;">-->
<!--        С уважением <a href="--><?//= $site?><!--">--><?//= $site_name?><!--</a>-->
<!--    </div>-->
<!--</div></body></html>-->

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