<?php
$this -> title = 'Обработка заказа';



if($result['code'] == 200 && $result['data']['paramorder']['number']){
    ?>

    <div>
        <div style="padding: 10px;  margin: 10px 0px;">
            Ваш заказ <font color="#007BC1">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </font>подтвержден автоматически.<br>
            В ближайшее время Вы получите уведомление на электронную почту.<br>
            Отслеживать состояние заказа можно в Вашем <font color="#007BC1"><a href="<?=BASEURL?>/lk/">личном кабинете</a></font><br>
        </div>
        <div style="border-bottom: 1px solid rgb(204, 204, 204); border-top: 1px solid rgb(204, 204, 204); font-size: 24px; font-weight: 400; margin: 0px 10px; padding: 10px 0px; width: calc(100% - 20px);">
            Номер заказа <font color="#007BC1"><?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></font>
        </div>
        <?php
        $pack['packages']=['name'=>'Полиэтиленовые пакеты', 'price'=>'0'];
        $pack['boxes']=['name'=>'Крафт-коробки', 'price'=>$wrapprice];
        if($result['data']['paramorder']['delivery']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block;  font-weight: 400;">Вариант упаковки: </span>'.$pack[$result['data']['paramorder']['wrap']]['name'].'</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block; font-weight: 400;">Вариант доставки: </span>'.$result['data']['paramorder']['delivery'].'</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block; font-weight: 400;">Итого: </span>'.((float)$result['data']['totalpricesaveproduct']-(float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
        }
        if($result['data']['coupon_sum']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block;  font-weight: 400;">Скидка: </span>'.(float)$result['data']['coupon_sum'].' Руб.</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block;  font-weight: 400;">Упаковка: </span>'.((float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block;  font-weight: 400;">Всего к оплате: </span>'.((float)$result['data']['totalpricesaveproduct'] - (float)$result['data']['coupon_sum']).' Руб.</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block; font-weight: 400;">ФИО: </span>'.$result['data']['paramorder']['name'].'</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block;  font-weight: 400;">Телефон: </span>'.$result['data']['paramorder']['telephone'].'</div>';
        }
        if($result['data']['totalpricesaveproduct']) {
            echo '<div style="width: 100%; padding: 5px 10px;"><span style="display: block; font-weight: 400;">Емейл: </span>'.$result['data']['paramorder']['email'].'</div>';
        }
        if($result['code']==200) {
            echo '<div style="width: 100%;padding: 10px;">'.
                'Заказанные товары будут Вам отправлены сразу же после проверки и поступления средств от Вас на расчетный счет Одежда-Мастер. <span>Счет будет Вам выслан</span> на указанный адрес электронной почты, а также Вы сможете скачать его в <a href="'.BASEURL.'/lk/">личном кабинете</a>'.
                '</br>'.
                '<div class="code'.$result['code'].'" style="padding: 10px 0px;">'.
                'Благодарим вас за покупку!'.
                '</div>'.
                '</div>';
        }
        ?>
    </div>
    <div>
        <?php

        if($result['data']['saveproduct']) {
            echo '<p style="padding: 0px 10px;margin: -10px 0px 10px 0px;text-align:left;font-family:Roboto, Arial;font-size:21px;">
				Товары в вашем заказе:
			</p><ul style="list-style:none;width:100%;text-align:center;padding:0px;">';
            foreach ($result['data']['saveproduct'] as $order_key => $order_value) {
                foreach ($order_value as $key => $value) {
                    echo   '<li style="display:inline-block;border-radius:4px;width:100%;-moz-border-radius:4px;-webkit-border-radius:4px;padding:8px;border:1px solid #e4e4e4;min-width:340px;">
					<table style="border:0;width:100%;" border="0">
						<tr>
							<td rowspan="5" style="padding-right: 15px;width:50%;text-align:center;vertical-align:top;">
								<div style="margin: 0 5px 0 0;  width: 100%">
								<img class="imageinorder" src="http://'.$_SERVER['HTTP_HOST'].BASEURL.'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_id'].'" /></div>
							</td>
						</tr>
						<tr>
							<td style="text-align:left;font-family:Roboto, Arial;color:#404040;"><span style="color:#429cd1;font-size:12px;">Код: '.$value[0]['products_model'].'</span> | '.$result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name'].'</td>
						</tr>
						<tr>
							<td style="text-align:left;font-family:Roboto, Arial;color:#303030;font-size:14px;">'.$value[1]['products_options_values'].'</td>
						</tr>
						<tr>
							<td style="text-align:left;font-family:Roboto, Arial;color:#303030;font-size:14px;">Сумма: <b style="font-size:24px;color:#000000;">'.($value[0]['products_quantity']*round($value[0]['products_price'], 1)).'</b> <span style="font-size:18px;color:#000000;">руб.</span></td>
						</tr>
						<tr>
							<td style="text-align:left;font-family:Roboto, Arial;color:#303030;font-size:14px;">Кол-во: '.$value[0]['products_quantity'] .'шт. x '.round($value[0]['products_price'], 1).' руб.</td>
						</tr>
					</table>
				</li>';
                    $delproductattr[$value[0]['products_id']][$value[1]['products_options_values']]= true;
                }
            }
            echo '</ul>';
        }
        ?>
    </div>
    <?php
}elseif($result['code'] == 0 ){
    ?>
    <div style="float:left; width:100%">
        <?php
        echo '<pre>';
        print_r($result['text']);
        echo '</pre>';
        ?>
    </div>
    <?php
}
?>
