
<div style="float:left; width:80%">
    <div class="code<?=$result['code']?>"><?=$result['text']?></div>
    <div style="padding: 10px;float: left;  margin: 10px 0px;">
        Ваш заказ <font color="#007BC1">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </font>принят и ожидает проверки администратором. <br>
         Отслеживать состояние заказа можно в Вашем <font color="#007BC1"><a href="http://new.odezhda-master.ru/lk">личном кабинете</a></font><br>
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
            'После проверки заказа Вам будет выслан счет, который Вы также сможете скачать в <a href="http://new.odezhda-maste.ru">личном кабинете</a>. Заказанные товары будут Вам отправлены сразу же после проверки и поступления средств от Вас на расчетный счет Одежда-Мастер. '.
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
//    echo '<pre>';
//    print_r($result['data']);
//    echo '</pre>';
    if($result['data']['saveproduct']) {
        echo '<div style="border-radius: 4px 4px 0px 0px;padding: 10px; border: 1px solid rgb(204, 204, 204); border-bottom: none; text-align: center; font-weight: 400;">Товары в заказе</div>';
        foreach ($result['data']['saveproduct'] as $key => $value) {
            echo '<div style="width: 100%; float: left; border: 1px solid rgb(204, 204, 204);border-bottom: none; padding: 10px 0px;">';
            echo '<div style="float: left; text-align: center; width: calc(100% / 2);">' .'<img width="100" src="http://odezhda-master.ru/images/'.$result['data']['origprod'][$value[0]['products_id']]['products_image'] . '" /></div>';
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
