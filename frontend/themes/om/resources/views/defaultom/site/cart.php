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
    $innerhtml = '';
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        $c = 0;
        $('#modal-cart').html('');
        $.each($i, function () {
            if (this[6] == 'undefined') {
                this[6] = 'Без размера'
            } else {
                this[6] = this[6] + ' размер';
            }
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row" style="height: 250px;">' +
                '<div class="cart-image" style="float: left; #D2672D inset; height: 230px; max-width: 200px; margin-left: 30px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div>' +
                '<div style="overflow: hidden; position: relative;top:15%;"><div style="width: 25%; margin-left: 30px; float: left; height: 100%;"><div class="cart-model" style="width: 100%">Арт.: ' + this[1] + '</div>' +
                '<div style="min-width:130px;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div></div>' +
                '<div class="cart-prod-price" style="width: 10%; float: left; height: 100%;">' + parseInt(this[3]) + 'руб.</div>' +
                '<div class="cart-amount" style="float: left;min-width: 140px;">' +
                '   <div id="del-count" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-id="'+$c+'">-</div>' +
                '   <input id="input-c" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center;" data-id="'+$c+'" value="' + this[4] + '">' +
                '   <div id="add-count" style="float: left;"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'"  data-id="'+$c+'">+</div>' +
                '   <div style="float: left;margin-left: 3px; line-height: 2"> шт.</div>' +
                '</div><div class="del-product" style="width: 10%; margin-left:30px; float: left">Удалить</div></div>' + '</div>';
        });
        $('.bside').html($innerhtml);
    } else {
        $('.bside').html('<div style="text-align: center; padding: calc(100% / 4);">Пусто</div>');
    }
    if (JSON.parse(localStorage.getItem('cart-om'))) {
    <?php
    if(!Yii::$app->user->isGuest){?>
        $(".bside").append('<span class="cart-auth" style="display: block; overflow: hidden;"><a class="save-order" style="display: block;position: relative" href="#">Оформить заказ</a></span>');
    <? }else { ?>
    $(".bside").append('.<span class="cart-auth"><a class="auth-order" href="/site/login">Купить</a></span>');
    <?}?>
    }
});
</script>
<?php
echo $innerhtml;
?>