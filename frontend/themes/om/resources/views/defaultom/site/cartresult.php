<?php
$this -> title = 'Обработка заказа';


echo '<pre>';
print_r($result);
echo '</pre>';
?>
<div style="float:left; width:80%">
<div class="code<?=$result['code']?>"><?=$result['text']?></div>
    <div style="padding: 10px;float: left;  margin: 10px 0px;">
        Ваш заказ <font color="#007BC1">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </font>подтвержден автоматически.<br>
        В ближайшее время Вы получите уведомление на электронную почту.<br>
        Отслеживать состояние заказа можно в Вашем <font color="#007BC1"><a href="<?=BASEURL?>/lk">личном кабинете</a></font><br>
    </div>
    <div style="border-bottom: 1px solid rgb(204, 204, 204); border-top: 1px solid rgb(204, 204, 204); width: 100%; float: left; padding: 10px 0px; font-size: 24px; font-weight: 400;">
        Номер заказа <font color="#007BC1"><?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></font>
        </div>
    <?
    if($result['data']['paramorder']['delivery']) {
        echo '<div style="padding: 10px;float: left; border: 1px solid rgb(204, 204, 204); margin: 10px 0px; border-radius: 4px;">Выбранный вами способ доставки: '.$result['data']['paramorder']['delivery'].'</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
    echo '<div style="padding: 10px;float: left; border: 1px solid rgb(204, 204, 204); margin: 10px 0px; border-radius: 4px;">Сумма заказа: '.$result['data']['totalpricesaveproduct'].'</div>';
    }

    ?>
</div>
<div style="float:left; width:20%">
<?
if($result['data']['saveproduct']) {
    echo '<div style="padding: 10px; border: 1px solid rgb(204, 204, 204); border-radius: 4px;">Товары в заказе</div>';
    foreach ($result['data']['saveproduct'] as $key => $value) {
        echo '<div style="width: 100%; float: left; border-bottom: 1px solid rgb(204, 204, 204); padding: 10px 0px;">';
        echo '<div style="float: left; width: calc(100% / 6);">' . $key . '</div>';
        echo '<div style="float: left; width: calc(100% / 6);">' . $value[0]['products_model'] . '</div>';
        echo '<div style="float: left; width: calc(100% / 6);">' .'<img width="100" src="'.BASEURL.'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_image'] . '" /></div>';
        echo '<div style="float: left; width: calc(100% / 6);">' . $value[0]['products_quantity'] . '</div>';
        echo '<div style="float: left; width: calc(100% / 6);">' . $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name']  . '</div>';
        echo '<div style="float: left; width: calc(100% / 6);">' . $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_description']  . '</div>';
        echo '</div>';
    }
}

if($result['data']['timeproduct']) {
echo '<div style="padding: 10px; border: 1px solid rgb(204, 204, 204); margin: 10px 0px; border-radius: 4px;">Товары не доступные в данный момент для заказа</div>';
foreach ($result['data']['timeproduct'] as $key => $value) {
echo '<div style="width: 100%; float: left; border-bottom: 1px solid rgb(204, 204, 204); padding: 10px 0px;">';
    echo '<div style="float: left; width: calc(100% / 6);">' . $key . '</div>';
    echo '<div style="float: left; width: calc(100% / 6);">' . $value[0]['products_model'] . '</div>';
    echo '<div style="float: left; width: calc(100% / 6);">' .'<img width="100" src="'.BASEURL.'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_image'] . '" /></div>';
    echo '<div style="float: left; width: calc(100% / 6);">' . $value[0]['products_quantity'] . '</div>';
    echo '<div style="float: left; width: calc(100% / 6);">' . $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name']  . '</div>';
    echo '<div style="float: left; width: calc(100% / 6);">' . $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_description']  . '</div>';
    echo '</div>';
}
}




?>
    </div>
<script>
    $(document).on('ready', function(){

    });

    </script>

