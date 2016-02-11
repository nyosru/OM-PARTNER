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
    $innerhtml = '<div class="cart-column1" style="width: 50%;min-width: 500px;">';
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
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row" style="height: 200px;">' +
                '<div class="del-product" style="width: 15px; margin-left:5px; float: left; position:relative; top:35%;"><i class="fa fa-times"></i></div><div class="cart-image" style="float: left; width:120px;"><img style="width: 100%; max-height:100%;" src="<?=BASEURL;?>/imagepreview?src=' + this[5] + '"/></div>' +
                '<div style="width: 25%; margin-left: 5px; float: left; height: 100%;"><div class="cart-model" style="width: 100%; font-size:10px; margin:0; min-width:200px;">Код товара: ' + this[1] + '</div>' +
                    '<div class="cart-item-name">'+this[7]+'</div>'+
                '<div style="min-width:130px;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div></div>' +
                '<div class="cart-prod-price" style="width: 10%; float: left; height: 100%;">' + parseInt(this[3]) + 'руб.</div>' +
                '<div class="cart-amount" style="float: left;min-width: 140px;">' +
                '   <div id="del-count" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-id="'+$c+'">-</div>' +
                '   <input id="input-c" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center;" data-id="'+$c+'" value="' + this[4] + '">' +
                '   <div id="add-count" style="float: left;"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'"  data-id="'+$c+'">+</div>' +
                '   <div style="float: left;margin-left: 3px; line-height: 2"> шт.</div>' +
                '</div>' + '</div>';
        });
        $innerhtml+='</div>';
        if($i.length>0){
            <?php
            if(!Yii::$app->user->isGuest){?>
            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;"><a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a></span>';
            <? }else { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span>';
            <?}?>
        }
        else {
            $innerhtml+='<div style="text-align: center; padding: calc(100% / 4);">Ваша корзина пуста</div>';
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
