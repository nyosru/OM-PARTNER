<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$user=unserialize($user);
$order=unserialize($order);
unset($order[ship]);
?>
<div class="order" style="padding: 10px; background-color: rgb(241, 255, 243) ! important; border-radius: 2px; position: relative; display: block; margin-bottom: 20px; box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);">
    <h3 style="font-size: 20px; text-align: center; text-transform: uppercase; padding: 10px;">Здравствуйте <?= $user->lastname?> <?= $user->name?> <?= $user->secondname?>!</h3>
    <h4 style="line-height: 40px;">Спасибо за то что воспользовались нашими услугами</h4>
    <h4 style="line-height: 40px;">Ваш заказ №<?= $id?> принят в работу и ожидает проверки администратором</h4>
    <table>
        <thead>

        </thead>

        <tbody>
        <? foreach($order as $key => $value){?>

        <tr>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
                <?=$key?>
            </td>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
               <img src="http://odezhda-master.ru/images/<?=$value[5]?>" width="200" height="200" />
            </td>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
               Артикул: <?=$value[1]?>
            </td>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
               Размер: <?=$value[6]?>
            </td>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
               Количество: <?=$value[4]?>
            </td>
            <td style="width: 15%; border: 1px solid rgb(56, 56, 56); text-align: center;">
                <?=intval($value[3])?> Руб. за шт.
            </td>
        </tr>
        <?}?>
        </tbody>
    </table>
</div>
