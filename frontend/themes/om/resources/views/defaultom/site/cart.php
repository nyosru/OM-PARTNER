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
    $innerhtml = '<form action="<?= BASEURL;?>/saveorder" method="post"><input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" /><div class="cart-top" style="width: 100%;height:40px;">Товары в моей корзине</div><div class="cart-column1" style="width: 48%;min-width: 500px;float:left;border:1px solid #ccc; border-radius: 4px; margin-right: 5px;">';
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        if(typeof ($i)== 'undefined'){
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
   //     console.log($i);
        $c = 0;
        $.each($i, function () {

            var requestdata = [];
            requestdata = $.ajax({
                method:'post',
                url: "/site/product",
                async: false,
                data: {id: this[0]}
            });
            console.log(requestdata.responseJSON);
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row" style="height: 200px; width:100%; border-bottom:1px solid #ccc;margin:0;padding:10px 0 10px 10px;">' +
                '<div class="cart-image" style="float: left; width:120px;"><img style="width: 100%; max-height:100%;" src="<?=BASEURL;?>/imagepreview?src=' + requestdata.responseJSON.product.products.products_id + '"/></div>' +
                '<div style="overflow:hidden; height:100%;float:left;width:70%;min-width:345px;"><div style="width: 95%; margin-left: 5px; float: left; height: 30%;">' +
                '  <div class="cart-model" style="width: 100%; height:100%; font-size:16px;font-weight:300; margin:0; min-width:200px;"><span class="artik" style="color:#399ee4;font-size:12px;">Код: '+requestdata.responseJSON.product.products.products_model +' </span>| <span id="gods-name">'+requestdata.responseJSON.product.productsDescription.products_name+'</span></div>' +
                    '</div><div style="width:100%; height:30%; margin:0;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div>' +
                '<div class="cart-amount" style="float: left;width: 100%; margin:0;height:40%; position:relative;">' +
                '<div class="cart-prod-price" style="float: left; height: 100%; width:85px; font-size:18px; font-weight:400;margin-right:60px;">' + parseInt(requestdata.responseJSON.product.products.products_price) + ' руб.</div>'+
                '   <div class="num-of-items" style="position:relative;top:7px;overflow:hidden;"><div id="del-count" style=" line-height:1.5;">-</div>' +
                '   <input id="input-count" name="product['+this[0]+']['+this[2]+']" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center; border:none; background-color:#f5f5f5;" ' +
                'data-prod="'+this[0]+'" ' +
                'data-model="'+this[1]+'" ' +

                'data-price="'+parseFloat(requestdata.responseJSON.product.products.products_price)+'" ' +
                'data-image="'+requestdata.responseJSON.product.products.products_image+'" ';

                if(typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined'){
                    $innerhtml +=   'data-count="'+requestdata.responseJSON.product.productsAttributes[this[2]].quantity+'" '+
                        'data-attr="'+requestdata.responseJSON.product.productsAttributesDescr[this[6]].products_options_values_id+'" ' +
                        'data-attrname="'+requestdata.responseJSON.product.productsAttributesDescr[this[6]].products_options_values_name+'" '+
                        'value="' + Math.min(this[4],requestdata.responseJSON.product.productsAttributes[this[2]].quantity) + '" ';
                }else{
                    $innerhtml +=   'data-count="'+requestdata.responseJSON.product.products.products_quantity+'"  data-attr="" data-attrname="" '+
                        'value="' + Math.min(this[4],requestdata.responseJSON.product.products.products_quantity) + '" ';
                }
            $innerhtml += 'data-name="'+requestdata.responseJSON.product.productsDescription.products_name+'" ' +
                'data-min="'+requestdata.responseJSON.product.products.products_quantity_order_min+'" ' +
                'data-step="'+requestdata.responseJSON.product.products.products_quantity_order_units+'"  ' +
                'data-id="'+$c+'">' +
                '   <div id="add-count" style="float: left; line-height:1.5;">+</div></div>' +
                '</div></div>' +
                '<div class="del-product" style="width: 12px; margin-left:5px; float: left; position:relative; top:35%;color:#ea516d;"><i class="fa fa-times"></i></div></div>';
        });
        $innerhtml+='</div><div class="cart-column2" style="border:1px solid #ccc; float: left; width: 49%; border-radius: 4px;">' +
                        '<div class="wrap-cart" style="height:150px; border-bottom: 1px solid #ccc; padding:10px;">Я выбираю способ упаковки моего заказа:' +
            '<div class=wrap-select ><input id="pack" name="wrap" type="radio" value="packages" checked="checked"/>Полиэтиленовые пакеты<br/><input id="box" name="wrap" type="radio" value="boxes" />Крафт-коробки</div></div>' +
                        '<div class="deliv-cart" style="border-bottom: 1px solid #ccc; padding:10px;">Я выбираю бесплатную доставку до компании:<div class="ship" style="min-width: 530px;"></div></div>' +
                        '<div class="total-cart" style="padding:10px; overflow: hidden;">' +
                            '<div class="total-top" style="height: 25px;">Итого: </div>' +
                            '<div class="total-cost"><div style="width: 70%; float: left">Стоимость</div><div id="gods-price" style="width: 30%; float: right"></div></div>' +
                            '<div class="total-wrap"><div style="width: 70%; float: left">Упаковка</div><div id="wrap-price" style="width: 30%; float: right"></div></div>' +
                            '<div class="total-deliv"><div style="width: 70%; float: left">Доставка</div><div id="deliv-price" style="width: 30%; float: right">0 руб.</div></div>' +
                            '<div class="total-price"><div style="width: 55%; float: left">Всего к оплате</div><div id="total-price" style="width: 45%; float: right"><span style="font-size: 26px; font-weight: 600;">10234</span> руб.</div></div>' +
                        '</div>';
        if($i.length>0){
            <?php
            if(!Yii::$app->user->isGuest){?>
            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +
                '<a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a>' +
                '</span></form></div>';
            <? }else { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?}?>
            $.post(
                "/site/shipping",
                function (shipdata) {
                    $inht = '';
                    //   console.log(shipdata);
                    $.each(shipdata, function (index) {
                        if (this.active == '1') {
                            $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
                        }
                    });
                    $('.ship').html('<div class="shipping">Cпособ доставки <select name="ship" id="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
                    $('.cart-auth').remove();
                    $.post(
                        "/site/paymentmethod",
                        function (data) {
                            if (data != 'false') {
                                $inht = '';
                                $.each(data, function (index) {
                                    if (this.active == '1') {
                                        $inht += '<option class="shipping-confirm-option" value="' + this.name + '">' + this.name + '</option>';
                                    }
                                });
                                $('.ship').append('<div class="shipping">Cпособ оплаты <select  name="ship" id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select></div><div class="userinfo"></div>');
                            } else {
                                $('.ship').append('<div class="userinfo"></div>');

                            }
                        }
                    );
                }
            );
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
$(document).ready(function () {

});


$(document).on('change', '#shipping-confirm', function () {
    $('#shipping-confirm option').filter(function (index) {
        if ($(this).val() == '') {
            return $(this)
        }
    }).remove();
    $.post(
        "/site/requestadress",
        {ship: $('#shipping-confirm option:selected')[0].getAttribute('data-pasp')},
        onAjaxSuccessinfo
    );
});

//$(document).on('load change click','.num-of-items', );
//$(document).on('ready', function () {
//    var overprice=0;
//    $indexes = $(".cart-row");
//    $.each($indexes, function () {
//        var c=((parseInt($(this).find('#input-c').val()))*(parseInt($(this).find('.cart-prod-price').html())));
//        overprice+=c;
//    });
//    $('#gods-price').html(overprice+' руб');
//    $('#total-price').html()
//});

$(document).on('change click','.num-of-items',function () {
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
    if(check.val()=="boxes") wrapprice=15;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        var c=((parseInt($(this).find('#input-count').val()))*(parseInt($(this).find('.cart-prod-price').html())));
        godsprice+=c;
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice);
});
$(document).on('ready', function () {
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
  //  console.log();
    if(check.val()=="boxes") wrapprice=28;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        var c=((parseInt($(this).find('#input-count').val()))*(parseInt($(this).find('.cart-prod-price').html())));
        godsprice+=c;
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
});
$(document).on('click','.wrap-select', function () {
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
 //   console.log();
    if(check.val()=="boxes") wrapprice=15;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
//            alert('Количество товара '+$(this).find('#gods-name').text()+', '+$(this).find('.artik').text()+' '+$(this).find('.cart-attr').text()+ ' меньше минимума. Минимальная партия - '+$(this).find('#add-count').attr('data-min')+' шт.')
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        var c=((parseInt($(this).find('#input-count').val()))*(parseInt($(this).find('.cart-prod-price').html())));
        godsprice+=c;
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
});

</script>
