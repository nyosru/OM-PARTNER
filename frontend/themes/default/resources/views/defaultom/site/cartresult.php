<?php
$this -> title = 'Обработка заказа';


if($result['code'] == 200 && $result['data']['paramorder']['number']){
?>

<div style="float:left; width:80%">
<div class="code<?=$result['code']?>"><?=$result['text']?></div>
    <div style="padding: 10px;float: left;  margin: 10px 0px;">
        Ваш заказ <font color="#007BC1">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </font>подтвержден автоматически.<br>
        В ближайшее время Вы получите уведомление на электронную почту.<br>
        Отслеживать состояние заказа можно в Вашем <font color="#007BC1"><a href="<?=BASEURL?>/lk">личном кабинете</a></font><br>
    </div>
    <div style="border-bottom: 1px solid rgb(204, 204, 204); border-top: 1px solid rgb(204, 204, 204); float: left; font-size: 24px; font-weight: 400; margin: 0px 10px; padding: 10px 0px; width: calc(100% - 20px);">
        Номер заказа <font color="#007BC1"><?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></font>
        </div>
    <?
    $pack['packages']=['name'=>'Полиэтиленовые пакеты', 'price'=>'0'];
    $pack['boxes']=['name'=>'Крафт-коробки', 'price'=>$wrapprice];
    if($result['data']['paramorder']['delivery']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Вариант упаковки: </span>'.$pack[$result['data']['paramorder']['wrap']]['name'].'</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Вариант доставки: </span>'.$result['data']['paramorder']['delivery'].'</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Итого: </span>'.((float)$result['data']['totalpricesaveproduct']-(float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Упаковка: </span>'.((float)$pack[$result['data']['paramorder']['wrap']]['price']).' Руб.</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Всего к оплате: </span>'.((float)$result['data']['totalpricesaveproduct']).' Руб.</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">ФИО: </span>'.$result['data']['paramorder']['name'].'</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Телефон: </span>'.$result['data']['paramorder']['telephone'].'</div>';
    }
    if($result['data']['totalpricesaveproduct']) {
        echo '<div style="width: 100%; padding: 5px 10px; float: left;"><span style="width: 20%; display: block; float: left; font-weight: 400;">Емейл: </span>'.$result['data']['paramorder']['email'].'</div>';
    }
    if($result['code']==200) {
    echo '<div style="width: 100%;padding: 10px; margin: 10px 0px; float: left;">'.
   'Заказанные товары будут Вам отправлены сразу же после проверки и поступления средств от Вас на расчетный счет Одежда-Мастер. <span>Счет будет Вам выслан</span> на указанный адрес электронной почты, а также Вы сможете скачать его в <a href="'.BASEURL.'/lk">личном кабинете</a>'.
   '</br>'.
   '<div class="code'.$result['code'].'" style="padding: 10px 0px;">'.
        'Благодарим вас за покупку!'.
        '</div>'.
        '</div>';
    }
    ?>
</div>
<div style="float:left; width:20%">
<?

if($result['data']['saveproduct']) {
    echo '<div style="border-radius: 4px 4px 0px 0px;padding: 10px; border: 1px solid rgb(204, 204, 204); border-bottom: none; text-align: center; font-weight: 400;">Товары в заказе</div>';
    foreach ($result['data']['saveproduct'] as $key => $value) {
        echo '<div style="width: 100%; float: left; border: 1px solid rgb(204, 204, 204);border-bottom: none; padding: 10px 0px;">';
        echo '<div style="float: left; text-align: center; width: calc(100% / 2);">' .'<img width="100" src="'.BASEURL.'/imagepreview?src='.$result['data']['origprod'][$value[0]['products_id']]['products_id'] . '" /></div>';
        echo '<div style="float: left; font-size: 12px;width: calc(100% / 2);">';
        echo '<div style="float: left; width: 100%;">Код товара:' . $value[0]['products_model'] . '</div>';
        echo '<div style="float: left; width: 100%;">' . $result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name']  . '</div>';
        echo '<div style="float: left; width: 100%;">Размер: ' . $value[1]['products_options_values'] . '</div>';
        echo '<div style="float: left; width: 100%;">Количество:' . $value[0]['products_quantity'] . ' шт.</div>';
        echo '<div style="float: left; width: 100%;">Цена: ' . round($value[0]['products_price'], 2)  . 'Руб.</div>';
        echo '</div>';
        echo '</div>';
        $delproductattr[$value[0]['products_id']][$value[1]['products_options_values']]= true;
    }
}
?>
    </div>

<script>
    $(document).on('ready', function(){
        $productattr = <?= json_encode($delproductattr)?>;
        $cart = JSON.parse(localStorage.getItem('cart-om')).cart;
        $itemcart = new Object()
        $itemcart.cart = [];
        $.each($cart, function(i, item){
          if(item['6'] != '' && $productattr[item['0']]){
              console.log('del-'+item['0']+'='+item['6']);

          }else if($productattr[item['0']] && (item['6'] == '' || item['6'] == 'undefined')){
              console.log('del-'+item['0']);
          }else{
              $itemcart.cart.push($cart[i]);

          }
            console.log(item);
        });
        if($itemcart.cart.length > 0 ){
            console.log($itemcart);
            $ilocal = JSON.stringify($itemcart);
            localStorage.setItem('cart-om', $ilocal);
        }else{
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }



    });

    </script>
<?
}elseif($result['code'] == 0 ){
   ?>
<div style="float:left; width:100%">
    <?
    echo '<pre>';
    print_r($result['text']);
    echo '</pre>';
    ?>
    </div>
<?
    }
?>
