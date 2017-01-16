<?php
$this->title = 'Обработка заказа';

$pack['packages']=['name'=>'Полиэтиленовые пакеты', 'price'=>'0'];
$pack['boxes']=['name'=>'Крафт-коробки', 'price'=>$wrapprice];
?>

<?php if($result['code'] == 200 && $result['data']['paramorder']['number']) { ?>
<div class="container page-cartresult">
    <div style="margin: 15px 0;">
        <div class="page-title">
            <h2><?=$this->title?></h2>
        </div>
        <div class="col-sm-7">
            <p class="code<?=$result['code']?>"><strong><?=$result['text']?></strong></p>
            <p>Ваш заказ <span class="text-primary">№<?=$result['data']['paramorder']['number']?> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?> </span>подтвержден автоматически.</p>
            <p>В ближайшее время Вы получите уведомление на электронную почту.</p>
            <p>Отслеживать состояние заказа можно в Вашем <a href="<?=BASEURL?>/lk">личном кабинете</a></p>
            <div class="widget widget__sidebar">
                <h3 class="widget-title">Номер заказа <span class="text-primary"><?=$result['data']['paramorder']['number']?></span> от <?=date('d.m.Y',strtotime($result['data']['paramorder']['date']))?></h3>
                <table class="data-table" style="background-color: #f5f5f5;">
                    <tbody>
                        <?php if($result['data']['paramorder']['delivery']) { ?>
                        <tr>
                            <td>Вариант упаковки:</td>
                            <td><?=$pack[$result['data']['paramorder']['wrap']]['name']?></td>
                        </tr>
                        <?php } ?>
                        <?php if($result['data']['totalpricesaveproduct']) { ?>
                        <tr>
                            <td>Вариант доставки:</td>
                            <td><?=$result['data']['paramorder']['delivery']?></td>
                        </tr>
                        <tr>
                            <td>Итого:</td>
                            <td><?=(float)$result['data']['totalpricesaveproduct']-(float)$pack[$result['data']['paramorder']['wrap']]['price'];?> Руб.</td>
                        </tr>
                        <tr>
                            <td>Упаковка:</td>
                            <td><?=(float)$pack[$result['data']['paramorder']['wrap']]['price']?> Руб.</td>
                        </tr>
                        <tr>
                            <td>Всего к оплате:</td>
                            <td><?=(float)$result['data']['totalpricesaveproduct']?> Руб.</td>
                        </tr>
                        <tr>
                            <td>ФИО:</td>
                            <td><?=$result['data']['paramorder']['name']?></td>
                        </tr>
                        <tr>
                            <td>Телефон:</td>
                            <td><?=$result['data']['paramorder']['telephone']?></td>
                        </tr>
                        <tr>
                            <td>Емейл:</td>
                            <td><?=$result['data']['paramorder']['email']?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($result['code']==200) { ?>
                <p>
                    Заказанные товары будут Вам отправлены сразу же после проверки и поступления средств от Вас на расчетный
                    счет Одежда-Мастер. Счет будет Вам выслан на указанный адрес электронной почты, а также Вы сможете скачать его в
                    <a href="/lk">личном кабинете</a>
                </p>
               <p><strong>Благодарим вас за покупку!</strong></p>
           <?php }?>
        </div>
        <div class="col-sm-5">
            <?php if($result['data']['saveproduct']) { ?>
            <div class="widget widget__sidebar">
                <h3 class="widget-title">Товары в заказе</h3>
                <div class="widget-content product-cart">
                    <?php foreach ($result['data']['saveproduct'] as $key => $value) { ?>
                        <div class="row">
                            <div class="col-xs-4">
                                <img class="img-thumbnail" src="/imagepreview?src=<?=$result['data']['origprod'][$value[0]['products_id']]['products_id'];?>">
                            </div>
                            <div class="col-xs-8">
                                <table class="table table-condensed">
                                    <tbody>
                                    <tr>
                                        <td colspan="2" style="border: none;"><strong><?=$result['data']['origprod'][$value[0]['products_id']]['productsDescription']['products_name'] ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td>Код товара:</td>
                                        <td><?=$value[0]['products_model']?></td>
                                    </tr>
                                    <tr>
                                        <td>Размер:</td>
                                        <td><?=$value[1]['products_options_values']?></td>
                                    </tr>
                                    <tr>
                                        <td>Количество:</td>
                                        <td><?=$value[0]['products_quantity']?> шт.</td>
                                    </tr>
                                    <tr>
                                        <td>Цена:</td>
                                        <td><?=round($value[0]['products_price'], 2) ?> Руб.</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php $delproductattr[$value[0]['products_id']][$value[1]['products_options_values']]= true; ?>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    $(document).on('ready', function(){
        $productattr = <?= json_encode($delproductattr)?>;
        $cart = JSON.parse(localStorage.getItem('cart-om')).cart;
        $itemcart = new Object()
        $itemcart.cart = [];
        $.each($cart, function(i, item){
          if(item['6'] != '' && $productattr[item['0']]){
             

          }else if($productattr[item['0']] && (item['6'] == '' || item['6'] == 'undefined')){
             
          }else{
              $itemcart.cart.push($cart[i]);

          }
            
        });
        if($itemcart.cart.length > 0 ){
           
            $ilocal = JSON.stringify($itemcart);
            localStorage.setItem('cart-om', $ilocal);
        }else{
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
    });
</script>
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
