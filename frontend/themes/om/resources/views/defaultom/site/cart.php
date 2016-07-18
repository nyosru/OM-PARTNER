<?php

$this -> title = 'Корзина';

$del_add='<select id="shipaddr" name="address">';
foreach($addr as $key=>$value){
    if($key != $default) {
        $options .= '<option value="' . $key . '">' . $value . '</option>';
    }else{
        $first .= '<option value="' . $key . '">' . $value . '</option>';
    }
}



$del_add .= $first;
$del_add .= $options;
$del_add .= '</select>';

?>

<script>
$(document).on('ready', function () {
    $('.bside').html('<div style="text-align: center; padding: calc(100% / 4);">...</div>');
    //var curPos = $(document).scrollTop();
    //var scrollTime = curPos / 3.73;
    //$("body,html").animate({"scrollTop": 0}, scrollTime);
    $amount_prod = 0;
    $cart_price = 0;
    $modalsaveset='<div style="height:40px;background-color: #E1F5E1;text-align: center;font-size: 24px;line-height: 1.7;">Сохранение корзины<div style="width:30px;float: right"><i style="cursor:pointer; color:#ea516d;" id="close-cart-save" class="fa fa-times" aria-hidden="true"></i></div></div><div><div style="width:90%;margin-left: 5%; height:40px;line-height:4;">Введите комментарий для сохраняемой корзины:</div><input id="comment-cart-save" class="no-shadow-form-control" style="width:90%; margin-left:5%;"></div><div style="width:90%; margin-left:5%; line-height: 4; height: 40px;">Сделать корзину публичной (вы сможете давать ссылки на нее другим)<i class="checkbox-overlay fa fa-check chk-unchecked" id="save-chk" style="margin-top:15px;margin-right:15px;"></i></div><div id="save-set-btn">Сохранить</div>'
    $innerhtml = '<div id="modal-save-set" style="display:none">'+$modalsaveset+'</div><div id="overlay-save-cart"></div><form action="<?= BASEURL;?>/saveorder" method="post"><input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" /><div class="cart-top" style="width: 100%;height:40px;">Товары в моей корзине<div id="save-set">Сохранить корзину</div></div><div class="cart-column1" style="width: 48%;float:left;border:1px solid #ccc; border-radius: 4px; margin-right: 5px;">';
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        if(typeof ($i)== 'undefined'){
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
        $c = 0;



        $.each($i, function () {
            var mandata = [];
            var requestdata = [];

            requestdata = $.ajax({
                method:'post',
                url: "/site/product",
                async: false,
                data: {id: this[0]}
            });

            mandata = $.ajax({
                method:'post',
                url: "/site/manlist",
                async: false,
                data: {data: requestdata.responseJSON.product.products.manufacturers_id}
            });
            if((typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined' && requestdata.responseJSON.product.productsAttributes[this[2]].quantity == 0) || requestdata.responseJSON.product.products.products_quantity == 0){
                $access = 'В данный момент товар отсутствует' ;
                $identypay = false;
            }else if(JSON.parse(mandata.responseText).answer == false){
                $access = 'К сожалению, товар в данный момент недоступен для оформления. Он останется в вашей корзине. Время оформления для данного товара вы можете посмотреть <a data-ajax=time data-href="'+requestdata.responseJSON.product.products.manufacturers_id+'">тут</a>';
                $identypay = false;
                }else{
                $access = 'Данный товар доступен для заказа';
                $identypay = true;
            }
            if(requestdata.responseJSON.product.products.products_quantity_order_min === '1'  || requestdata.responseJSON.product.products.products_quantity_order_units === '1'){
                $disable_for_stepping = '';
            }else{
                $disable_for_stepping = 'readonly';
            }
            $innerhtml += '<div data-calc="'+$identypay+'" data-raw="' + ($c) + '" class="cart-row" style="float: left; height: auto; margin: 0px; border-bottom: 1px solid rgb(204, 204, 204); width: 100%; padding: 5px;">' +
                '<div class = "access '+$identypay+'" >'+$access+'</div>'+
                '<a target="_blank" href="<?=BASEURL;?>/product?id='+requestdata.responseJSON.product.products.products_id+'" class="cart-image" style="float: left; width:120px;"><img style="width: 100%; max-height:100%;" src="<?=BASEURL;?>/imagepreview?src=' + requestdata.responseJSON.product.products.products_id + '"/></a>' +
                '<div class="cart-row-content" style="overflow:hidden; height:100%;float:left;width:70%;"><div style="width: 95%; margin-left: 5px; float: left; height: 30%;">' +
                '  <div class="cart-model" style="width: 100%; height:100%; font-size:16px;font-weight:300; margin:0; min-width:200px;"><span class="artik" style="color:#399ee4;font-size:12px;">Код: '+requestdata.responseJSON.product.products.products_model +' </span>| <span id="gods-name">'+requestdata.responseJSON.product.productsDescription.products_name+'</span></div>' +
                '</div><div style="width:100%; height:30%; margin:0;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div>' +
                '<div class="cart-amount" style="float: left;width: 100%; margin:0;height:40%; position:relative;">' +
                '<div class="cart-prod-price" style="float: left; height: 100%; width:85px; font-size:18px; font-weight:400;margin-right:60px;">' + parseInt(requestdata.responseJSON.product.products.products_price) + ' руб.</div>'+
                '   <div class="num-of-items" data-raw="' + ($c++) + '" style="position:relative;top:7px;overflow:hidden;"><div id="del-count" class="del-count" style=" line-height:1.5;">-</div>' +
                '   <input '+ $disable_for_stepping +' id="input-count" class="input-count" name="product['+this[0]+']['+this[2]+']" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center; border:none; background-color:#f5f5f5;" ' +
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
                '   <div id="add-count" class="add-count" style="float: left; line-height:1.5;">+</div></div>' +
                '</div></div>' +
                '<div class="del-product" style="width: 12px; margin-left:5px; float: left; top:35%;color:#ea516d;"><i class="fa fa-times"></i></div>' +
                '</div>'+
                '<div style="float: left; width: 100%;border-bottom: 1px solid #CCC;">' +
                '<div class="panel panel-default" style="border: medium none; border-radius: 0px; margin: 0px;">'+
                '<a class="collapsed" role="button" data-toggle="collapse'+$c+'" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">' +
                '<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
                '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
                'Добавить комментарий к этому товару <i class="fa fa-caret-down"></i>' +
                '</div>' +
                ' </div>' +
                '</a>'+
                '<div style=" position: relative;    z-index: 999;" aria-expanded="false" id="" class="filter-cont panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">'+
                '<div class="panel-body" style="padding: 0px 5px;">' +
                '<div style="padding: 10px 0px;">';

            if(typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined'){
                $innerhtml += '<textarea name="comments['+requestdata.responseJSON.product.products.products_id+']['+requestdata.responseJSON.product.productsAttributesDescr[this[6]].products_options_values_id+']" style="width: 100%;" ></textarea>';

            }else{
                $innerhtml += '<textarea name="comments['+requestdata.responseJSON.product.products.products_id+'][all]" style="width: 100%;" ></textarea>';

            }
            $innerhtml +=    '</div>' +
                '</div>' +
                '</div>' +
                '</div>'+
                '</div>';
        });
        $innerhtml+='</div><div class="cart-column2" style="border:1px solid #ccc; float: left; width: 49%; border-radius: 4px;">' +
                        '<div class="wrap-cart" style=" border-bottom: 1px solid #ccc; padding:10px;">Я выбираю способ упаковки моего заказа:' +
            '<div class=wrap-select ><input id="pack" name="wrap" type="radio" value="packages" checked="checked"/>Полиэтиленовые пакеты<br/><input id="box" name="wrap" type="radio" value="boxes" />Крафт-коробки</div></div>';

        <?php
           if(!Yii::$app->user->isGuest){?>
        $innerhtml+=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;">Адрес доставки:<div class="shipaddr" style=""><?=$del_add?></div></div>';
        <?php }else { ?>
        $innerhtml+=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;"><a href="<?=BASEURL?>/lk" class="shipaddr" style="">Необходимо авторизоваться</a></div>';
        <?php }?>
        $innerhtml+=               '<div class="deliv-cart" style="border-bottom: 1px solid #ccc; padding:10px;">Я выбираю бесплатную доставку до компании:<div class="ship" style=""></div></div>' +
                        '<div class="total-cart" style="padding:10px; overflow: hidden;">' +
                            '<div class="total-top" style="height: 25px;">Итого: </div>' +
                            '<div class="total-cost"><div style="width: 70%; float: left">Стоимость</div><div id="gods-price" style="width: 30%; float: right"></div></div>' +
                             '<div class="total-wrap"><div style="width: 70%; float: left">Упаковка(указана минимальная стоимость.Необходимое количество и размеры определит комплектовщик)</div><div id="wrap-price" style="width: 30%; float: right"></div></div>' +
                         //   '<div class="total-deliv"><div style="width: 70%; float: left">Доставка</div><div id="deliv-price" style="width: 30%; float: right">0 руб.</div></div>' +
            '<div class="total-price"><div style="width: 55%; float: left">Всего к оплате</div><div id="total-price" style="width: 45%; float: right"><span style="font-size: 26px; font-weight: 600;"></span> руб.</div></div>' +

                        '</div>';
        $innerhtml+=  '<div style="float: left; width: 100%;border-bottom: 1px solid #CCC;">' +
        '<div class="panel panel-default" style="border: medium none; border-radius: 0px; margin: 0px;">'+
        '<a class="collapsed" role="button" data-toggle="collapse'+$c+'" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">' +
        '<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий к этому заказу <i class="fa fa-caret-down"></i>' +
        '</div>' +
        ' </div>' +
        '</a>'+
        '<div style=" position: relative;    z-index: 999;" aria-expanded="false" id="" class="filter-cont panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">'+
        '<div class="panel-body" style="padding: 0px 5px;">' +
        '<div style="padding: 10px 0px;">' +
        '<textarea name="ordercomments" style="width: 100%;" ></textarea>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

        if($i.length>0){
            <?php
            if(!Yii::$app->user->isGuest){?>
            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +

                '<a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a>' +
                '</span></form></div>';
            <?php }else { ?>
            $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?php }?>
            $.post(
                "/site/shipping",
                function (shipdata) {
                    $inht = '';
                    $.each(shipdata, function (index) {
                        if (this.active == '1') {
                            $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
                        }
                    });
                    $('.ship').html('<div class="shipping">Cпособ доставки <select name="ship" class="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
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
//    <?php// }else { ?>
//        $(".bside").append('<span class="cart-auth"  style="display: block; overflow: hidden;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span>');
//    <?php//}?>
//    }
});
$(document).ready(function () {

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
var wrap=<?=$wrapprice?>;
$(document).on('change click','.num-of-items',function () {
    var godsprice=0;
    var wrapprice=0;
    
    var check = $("[name='wrap']").filter(':checked').first();
    if(check.val()=="boxes") wrapprice=wrap;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        $(this).attr('');
        if($(this).attr('data-calc') == "true") {
            var c = ((parseFloat($(this).find('#input-count').val())) * (parseFloat($(this).find('.cart-prod-price').html())));
            godsprice += c;
        }
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice);
});
$(document).on('ready', function () {
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
    if(check.val()=="boxes") wrapprice=28;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        if($(this).attr('data-calc') == "true") {
            var c = ((parseInt($(this).find('#input-count').val())) * (parseInt($(this).find('.cart-prod-price').html())));
            godsprice += c;
        }
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
});
$(document).on('click','.wrap-select', function () {
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
    if(check.val()=="boxes") wrapprice=wrap;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        if(parseInt($(this).find('#input-count').val())<parseInt($(this).find('#input-count').attr('data-min'))){
//            alert('Количество товара '+$(this).find('#gods-name').text()+', '+$(this).find('.artik').text()+' '+$(this).find('.cart-attr').text()+ ' меньше минимума. Минимальная партия - '+$(this).find('#add-count').attr('data-min')+' шт.')
            $(this).find('#input-count').val($(this).find('#input-count').attr('data-min'));
        }
        if($(this).attr('data-calc') == "true") {
            var c = ((parseInt($(this).find('#input-count').val())) * (parseInt($(this).find('.cart-prod-price').html())));
            godsprice += c;
        }
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
});

$(document).on('change', '.shipping-confirm, #shipaddr', function () {
    $('.shipping-confirm option').filter(function (index) {
        if ($(this).val() == '') {
            return $(this)
        }
    }).remove();
    $.post(
        "/site/requestadress",
        {ship: $('.shipping-confirm option:selected')[0].getAttribute('data-pasp'),
            id:$('#shipaddr option:selected')[0].getAttribute('value')},
        onAjaxSuccessinfo
    );
});
$(document).on('click', '.panel  > a',  function(){
    if($(this).siblings().filter('.filter-cont').attr('class').indexOf('collapse in')+1) {
        $(this).html('<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий <i class="fa fa-caret-down"></i>' +
        '</div>' +
        ' </div>');
        $(this).siblings().filter('.filter-cont').removeClass('in');
    }else{
        $(this).html('<div class="panel-heading no-border-bottom-rad" role="tab" id="headingOne" style="padding: 0px 10px;">' +
        '<div class="panel-title no-border-bottom-rad" style="font-size: 12px;">' +
        'Добавить комментарий <i class="fa fa-caret-up"></i>' +
        '</div>' +
        ' </div>');
        $(this).find(':first-child').addClass('no-border-bottom-rad');
        $(this).siblings().filter('.filter-cont').addClass('in');
    }
});
</script>

