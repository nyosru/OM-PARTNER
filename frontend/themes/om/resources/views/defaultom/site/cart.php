<?php
$this -> title = 'Корзина';
?>

<script>
$(document).on('ready', function () {
    //var curPos = $(document).scrollTop();
    //var scrollTime = curPos / 3.73;
    //$("body,html").animate({"scrollTop": 0}, scrollTime);
    $amount_prod = 0;
    $cart_price = 0;
    $innerhtml = '<div class="cart-top" style="width: 100%;height:40px;"><form>Товары в моей корзине</div><div class="cart-column1" style="width: 50%;min-width: 500px;float:left">';
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        $c = 0;
        $.each($i, function () {
            if (this[6] == 'undefined') {
                this[6] = 'Без размера'
            } else {
                this[6] = this[6] + ' размер';
            }
            console.log(this);
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row" style="height: 200px; width:97%; border:1px solid #ccc;margin:0;margin-top:-1px;padding:10px 0 10px 10px;">' +
                '<div class="cart-image" style="float: left; width:120px;"><img style="width: 100%; max-height:100%;" src="<?=BASEURL;?>/imagepreview?src=' + this[5] + '"/></div>' +
                '<div style="overflow:hidden; height:100%;float:left;width:70%;min-width:350px;"><div style="width: 95%; margin-left: 5px; float: left; height: 30%;">' +
                '  <div class="cart-model" style="width: 100%; height:100%; font-size:16px;font-weight:300; margin:0; min-width:200px;"><span class="artik" style="color:#399ee4;font-size:12px;">Код: '+this[1] +' </span>| '+this[7]+'</div>' +
                    '</div><div style="width:100%; height:30%; margin:0;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div>' +
                '<div class="cart-amount" style="float: left;width: 100%; margin:0;height:40%; position:relative;">' +
                '<div class="cart-prod-price" style="float: left; height: 100%; width:85px; font-size:18px; font-weight:400;margin-right:60px;">' + parseInt(this[3]) + ' руб.</div>'+
                '   <div style="position:relative;top:7px;overflow:hidden;"><div id="del-count" style=" line-height:1.5;" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-id="'+$c+'">-</div>' +
                '   <input id="input-c" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center; border:none; background-color:#f5f5f5;" data-id="'+$c+'" value="' + this[4] + '">' +
                '   <div id="add-count" style="float: left; line-height:1.5;"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'"  data-id="'+$c+'">+</div></div>' +
                '</div></div>' +
                '<div class="del-product" style="width: 12px; margin-left:5px; float: left; position:relative; top:35%;color:#ea516d;"><i class="fa fa-times"></i></div></div>';
        });
        $innerhtml+='</div><div class="cart-column2" style="border:1px solid #ccc; float: left; width: 49%;">' +
                        '<div class="wrap-cart" style="height:150px; border-bottom: 1px solid #ccc; padding:10px; display: none;">Я выбираю способ упаковки моего заказа:</div>' +
                        '<div class="deliv-cart" style="height:150px; border-bottom: 1px solid #ccc; padding:10px;">Я выбираю бесплатную доставку до компании:</div>' +
                        '<div class="total-cart" style="padding:10px; overflow: hidden;">' +
                            '<div class="total-top" style="height: 25px;">Итого: </div>' +
                            '<div class="total-cost"><div style="width: 70%; float: left">Стоимость</div><div style="width: 30%; float: right">5676 руб.</div></div>' +
                            '<div class="total-wrap"><div style="width: 70%; float: left">Упаковка</div><div style="width: 30%; float: right">100 руб.</div></div>' +
                            '<div class="total-deliv"><div style="width: 70%; float: left">Доставка</div><div style="width: 30%; float: right">200 руб.</div></div>' +
                            '<div class="total-price"><div style="width: 55%; float: left">Всего к оплате</div><div style="width: 45%; float: right"><span style="font-size: 26px; font-weight: 600;">10234</span> руб.</div></div>' +
                        '</div>';
        if($i.length>0){
            <?php
            if(!Yii::$app->user->isGuest){?>
            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +
                '<a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a>/ +
                '</span></form></div>';
            <? }else { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?}?>

        }
        else {
            $innerhtml='<div style="text-align: center; padding: calc(100% / 4);">Ваша корзина пуста</div>';
        }
        $('.bside').html($innerhtml);
    }

//    if (JSON.parse(localStorage.getItem('cart-om'))) {
//    <?php
//    if(!Yii::$app->user->isGuest){?>
//        $(".bside").append('<span class="cart-auth" style="display: block; overflow: hidden;"><a class="save-order" style="display: block;position: relative" href="<?//=BASEURL;?>///cart?action=1">Оформить заказ</a></span>');
//    <?// }else { ?>
//        $(".bside").append('<span class="cart-auth"  style="display: block; overflow: hidden;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span>');
//    <?//}?>
//    }
});
</script>
