<?php
$pack['packages']=['name'=>'Полиэтиленовые пакеты', 'price'=>'0'];
$pack['boxes']=['name'=>'Крафт-коробки', 'price'=>$wrapprice];
$contentutm = \frontend\widgets\UtmLinker::widget(['param'=>Yii::$app->params['params']['utm']]);
?>
<div>

    <p style="font-family:'Roboto', Arial;padding:0px 15px;margin:20px 0px 10px 0px;font-weight:bold;color:#000000;text-align:left;font-size:22px;">
        Уважаемая (ый) <?=$result['data']['paramorder']['name']?>!
    </p>
    <p style="line-height:25px;padding:0px 15px;margin:0px 0px 10px 0px;color:#000000;text-align:left;font-family:'Roboto', Arial;font-size:16px;">
        Спасибо, что выбрали Одежда-Мастер!
    </p>
    <p style="line-height:25px;padding:0px 15px;margin:20px 0px 20px 0px;color:#000000;text-align:left;font-family:'Roboto', Arial;font-size:16px;">
        Ваш заказ <span style="color:#027BC2;font-weight:bold;font-family:'Roboto', Arial;font-size:18px;"><?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></span> принят и ждет дальнейшей обработки
    </p>
    <p style="line-height:25px;padding:0px 15px;margin:0px 0px 20px 0px;color:#000000;text-align:left;font-family:'Roboto', Arial;font-size:16px;">
        Состояние заказа можно отслеживать в <a href="http://<?=$_SERVER['HTTP_HOST'];?>/lk/?<?=$contentutm;?>" target="_blank" style="color:#027BC2;font-weight:bold;text-decoration:underline;font-family:'Roboto', Arial;font-size:14px;">личном кабинете</a>.
    </p>
    <table style="border:0;width:100%;padding:0px 15px;margin:0px 0px 40px 0px;" border="0">
        <tr>
            <td style="width:250px;text-align:left;font-family:'Roboto', Arial;font-weight:bold;font-size:16px;color:#000000;">Вариант упаковки заказа:</td>
            <td style="color:#3f3f3f;font-family:'Roboto', Arial;font-size:16px;"><?=$pack[$result['data']['paramorder']['wrap']]['name'];?></td>
        </tr>
        <tr>
            <td style="width:250px;text-align:left;font-family:'Roboto', Arial;font-weight:bold;font-size:16px;color:#000000;">Вариант доставки:</td>
            <td style="color:#3f3f3f;font-family:'Roboto', Arial;font-size:16px;line-height:25px;"><?=$result['data']['paramorder']['delivery']?></td>
        </tr>
        <?php if(!empty($result['data']['coupon_sum'])){ ?>
            <tr>
                <td style="width:250px;text-align:left;font-family:'Roboto', Arial;font-weight:bold;font-size:16px;color:#000000;">Скидка:</td>
                <td style="color:#3f3f3f;font-family:'Roboto', Arial;font-size:16px;line-height:25px;font-weight:bold;color:#000000;"><?=$coupon = $result['data']['coupon_sum']?> Руб.</td>
            </tr>
        <?php }  else {
            $coupon = 0;
        }
        ?>
        <tr>
            <td style="width:250px;text-align:left;font-family:'Roboto', Arial;font-weight:bold;font-size:16px;color:#000000;">Всего к оплате:</td>
            <td style="color:#3f3f3f;font-family:'Roboto', Arial;font-size:16px;line-height:25px;font-weight:bold;color:#000000;"><?=(round((float)$result['data']['totalpricesaveproduct']-$coupon, 0));?> Руб.</td>
        </tr>
    </table>
    <ul style="list-style:none;width:100%;text-align:center;padding: 0px;">
        <li style="padding:10px;width:210px;display:inline-block;border:1px solid #41BCBA;border-radius:6px;margin:0px 4px 10px 0px;color:#41BCBA;font-family:'Roboto', Arial;font-size:14px;">
            <b>ФИО клиента</b><br><?=$result['data']['paramorder']['name'];?>
        </li>
        <li style="padding:10px;width:210px;display:inline-block;border:1px solid #EA516D;border-radius:6px;margin:0px 4px 10px 0px;color:#EA516D;font-family:'Roboto', Arial;font-size:14px;">
            <b>телефон</b><br><?=$result['data']['paramorder']['telephone'];?>
        </li>
        <li style="padding:10px;width:210px;display:inline-block;border:1px solid #007BC1;border-radius:6px;margin:0px 4px 10px 0px;color:#007BC1;font-family:'Roboto', Arial;font-size:14px;">
            <b>емейл</b><br><?=$result['data']['paramorder']['email'];?>
        </li>
    </ul>
</div>
<div>
    <?php
    if($result['data']['saveproduct']) {
        echo '<p style="padding:0px 15px;margin:30px 0px 10px 0px;color:#00a5a3;text-align:left;font-family:\'Roboto\', Arial;font-size:21px;">
				Товары в вашем заказе:
			</p><ul style="list-style:none;width:100%;text-align:center;padding:0px;">';
        foreach ($result['data']['saveproduct'] as $order_key => $order_value) {
            foreach ($order_value as $key => $value) {
                echo   '<li style="display:inline-block;margin:10px 15px;border-radius:4px;width:44%;-moz-border-radius:4px;-webkit-border-radius:4px;padding:8px;border:1px solid #e4e4e4;min-width:340px;">
					<table style="border:0;width:100%;" border="0">
						<tr>
							<td rowspan="5" style="width:80px;text-align:center;vertical-align:top;">
								<div style="margin: 0 5px 0 0;"><img src="http://'.$_SERVER['HTTP_HOST'].BASEURL.'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_id'].'" style="max-width:80px;max-height:120px;"></div>
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
