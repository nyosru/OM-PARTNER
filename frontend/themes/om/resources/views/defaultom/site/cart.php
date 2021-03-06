<?php
use yii\helpers\Html;
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
    $(window).on('load', function () {
        $('.bside').html('<div style="text-align: center; padding: calc(100% / 4);">...</div>');
        //var curPos = $(document).scrollTop();
        //var scrollTime = curPos / 3.73;
        //$("body,html").animate({"scrollTop": 0}, scrollTime);
        $amount_prod = 0;
        $cart_price = 0;
        $modalsaveset='<div style="height:40px;background-color: #E1F5E1;text-align: center;font-size: 24px;line-height: 1.7;">Сохранение корзины<div style="width:30px;float: right"><i style="cursor:pointer; color:#ea516d;" id="close-cart-save" class="fa fa-times" aria-hidden="true"></i></div></div><div><div style="width:90%;margin-left: 5%; height:40px;line-height:4;">Введите комментарий для сохраняемой корзины:</div><input id="comment-cart-save" class="no-shadow-form-control" style="width:90%; margin-left:5%;"></div><div style="width:90%; margin-left:5%; line-height: 4; height: 40px;">Сделать корзину публичной (вы сможете давать ссылки на нее другим)<i class="checkbox-overlay fa fa-check chk-unchecked" id="save-chk" style="margin-top:15px;margin-right:15px;"></i></div><div id="save-set-btn">Сохранить</div>'
        $innerhtml = '<div id="modal-save-set" style="display:none">'+$modalsaveset+'</div><div id="overlay-save-cart"></div><form action="<?= BASEURL;?>/saveorder" method="post"><input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" /><div style="padding: 10px;font-size: 20px;text-align: center;">Последний раз вы заказывали: <?=$lastorders?></div><div class="cart-top" style="width: 100%;height:40px;">Товары в моей корзине<div id="save-set">Сохранить корзину</div></div><div class="cart-column1" style="width: 48%;float:left;border:1px solid #ccc; border-radius: 4px; margin-right: 5px;">';
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
                    data: {id: this[0],_csrf: yii.getCsrfToken()}
                });

                mandata = $.ajax({
                    method:'post',
                    url: "/site/pre-check-product-to-orders",
                    async: false,
                    data: {
                        product: requestdata.responseJSON.product.products_id,
                        category :requestdata.responseJSON.categories_id,
                        attr :this[2],
                        count : this[4],
                        _csrf: yii.getCsrfToken()
                    }
                });
                if((typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined' && requestdata.responseJSON.product.productsAttributes[this[2]].quantity == 0) || requestdata.responseJSON.product.products.products_quantity == 0){
                    $access = mandata.responseJSON.message ;
                    $identypay = false;
                }else if(mandata.responseJSON.result == false){
                    $access = mandata.responseJSON.message;
                    $identypay = false;
                }else{
                    $access = mandata.responseJSON.message;
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
            $innerhtml+='</div><div class="cart-column2" style="border:1px solid #ccc; float: left; width: 49%; border-radius: 4px;">';

            <?php
            if(!Yii::$app->user->isGuest && $template == 'om' ){
            ?>
            $innerhtml+= '<div class="wrap-cart" style=" border-bottom: 1px solid #ccc; padding:10px;">Я выбираю способ упаковки моего заказа:';
            $innerhtml+=  '<div class=wrap-select ><input id="pack" name="wrap" type="radio" value="packages" checked="checked"/>Полиэтиленовые пакеты<br/><input id="box" name="wrap" type="radio" value="boxes" />Крафт-коробки</div></div>';
            $innerhtml+=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;">Адрес доставки:<div class="shipaddr" style=""><?=$del_add?></div></div>';
            $innerhtml+=   '<div class="deliv-cart" style="border-bottom: 1px solid #ccc; padding:10px;">Я выбираю бесплатную доставку до компании:<div class="ship" style=""></div></div>';
            $innerhtml+=   '<div class="deliv-code" style="border-bottom: 1px solid #ccc; padding:10px;"></div>';
            $innerhtml += '<button class="btn btn-lg btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-top: 5px;" id="check-confirm" type="submit">' +
                'Подтвердить заказ' +
                '</button>';
            <?php
            }else if($template == 'sp')
            {
            ?>
            $innerhtml +=    '' +
                '<div class="address" style="padding: 0px 10px;">' +
                    '<div class="name-item lable-info-item">' +
                        'Имя: ' +
                        '<input disabled="" name="[userinfo]name" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="name" class="info-item" value="<?=htmlentities($userinfo['name']);?>">' +
                    '</div>' +
                '<div class="secondname-item lable-info-item">' +
                        'Отчество: ' +
                        '<input disabled="" name="[userinfo]secondname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="secondname" class="info-item" value="<?=htmlentities($userinfo['secondname']);?>">' +
                '</div>' +
                '<div class="lastname-item lable-info-item">' +
                        'Фамилия: ' +
                        '<input disabled="" name="[userinfo]lastname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="lastname" class="info-item" value="<?=htmlentities($userinfo['lastname']);?>">' +
                        '</div>' +
                '<div class="country-item lable-info-item">' +
                        'Страна: ' +
                        '<input autocomplete="off" disabled="" name="[userinfo]country" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="country" class="info-item" value="<?=htmlentities($userinfo['country']);?>">' +
                        '<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">' +
                        '</ul>' +
                '</div>' +
                '<div class="state-item lable-info-item">' +
                'Область: ' +
                '<input autocomplete="off" disabled="" name="[userinfo]state" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="state" class="info-item" value="<?=htmlentities($userinfo['state']);?>">' +
                '<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' +
                '</ul>' +
                '</div>' +
                '<div class="city-item lable-info-item">' +
                'Город: ' +
                '<input disabled="" name="[userinfo]city" title="Допустимые символы а-я,a-z,0-9,-,пробел" data-placement="top" data-toggle="tooltip" data-name="city" class="info-item" value="<?=htmlentities($userinfo['city']);?>">' +
                '</div>' +
                '<div class="adress-item lable-info-item">' +
                'Адрес: ' +
                '<input disabled="" name="[userinfo]adress" title="Допустимые символы а-я,a-z,0-9,-,пробел,.,," data-placement="top" data-toggle="tooltip" data-name="adress" class="info-item" value="<?=htmlentities($userinfo['country']);?>">' +
                '</div>' +
                '<div class="postcode-item lable-info-item">' +
                'Почтовый индекс: ' +
                '<input disabled="" name="[userinfo]postcode" title="Допустимые символы 0-9, пробел" data-placement="top" data-toggle="tooltip" data-name="postcode" class="info-item" value="124124"></div>' +
                '<div class="telephone-item lable-info-item">Телефон: <input disabled="" name="[userinfo]telephone" title="Допустимые символы 0-9,-,пробел,),(,+" data-placement="top" data-toggle="tooltip" data-name="telephone" class="info-item" value="<?=htmlentities($userinfo['telephone']);?>"></div>' +
                '<div data-js="refpercent" data-value="<?=$refpercent?>" ><b>Организационный сбор вашего СП: <?=$refpercent?>%</b></div>'+
                '<div class="order-accept"><strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе! ' +
                '</strong>' +
                '<br>' +
                'Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных, а также соглашаетесь с ' +
                '<a target="_blank" href="/page?article=offerta">' +
                'договором оферты' +
                '</a>.' +
                '</div>' +
                '<button class=" btn btn-lg btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-bottom: 5px;"type="submit">' +
                'Подтвердить заказ' +
                '</button>' +
                '</div>';
            <?php
            }else{
            ?>
            $innerhtml +=   '<div class="deliv-addr" style="border-bottom: 1px solid #ccc; padding:10px;"><a href="<?=BASEURL?>/login" class="shipaddr" style="">Необходимо авторизоваться</a></div>';
            <?php
            }
            ?>
            $innerhtml+= '<div class="total-cart" style="padding:10px; overflow: hidden;">' +
                '<div class="total-top" style="height: 25px;">Итого: </div>' +
                '<div class="total-cost"><div style="width: 70%; float: left">Стоимость</div><div id="gods-price" style="width: 30%; float: right"></div></div>' +
                '<div class="total-cost"><div style="width: 70%; float: left">Скидка</div><div id="coupon-price" style="width: 30%; float: right">0 руб</div></div>' +
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
                '</div>' +
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
                if($template){?>
                $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +
                    '<a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a>' +
                    '</span></form></div>';
                <?php }elseif(!Yii::$app->user->isGuest) { ?>
                $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
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

        getCoupon();
        function getCoupon() {
            $.ajax({
                type: "POST",
                url: "/glavnaya/cart?coupon=1",
                data: {_csrf: yii.getCsrfToken()}
            }).done(function (html) {
                $('.deliv-code').html(html);
            });
        }

	    changeDisableSubmit();
    });

    $('body').on('click', '#check-confirm', function() {
	    $('#check-confirm + .btn-tk-error').remove();

    	if ($(this).hasClass('disabled')) {
		    $(this).after('<div class="btn-tk-error" style="color: #f00;">Пожалуйста выберите транспортную компанию.</div>');
    		return false;
	    }
    	else {
    		$('.btn-tk-error').remove();
    		check();
    		return true;
	    }
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
        countPrice();
    });
    $(window).on('load', function () {
        countPrice();
    });
    $(window).on('load','.wrap-select', function () {
        countPrice();
    });

    $('.input-count').on('change',function(){
        countPrice();
    });
    /*
    Сумма заказа
     */
    function countPrice(){
        var godsprice=0;
        var wrapprice=0;
        var couponprice=0;

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

        var totalPrice;

        // Учитываем купон
        var couponType = $('#promo-code-type').val(),
            couponValue = parseInt($('#promo-code-amount').val());
        if(couponType=='F'){ // если тип купона денежный
            couponprice = couponValue+' руб';
            totalPrice = godsprice+wrapprice-couponValue;
            $('#promo-code-sum').val(couponValue);
        } else if(couponType=='P') { // если тип купона процентный
            couponprice = couponValue+'%';
            var couponSum = couponValue*godsprice/100;
            totalPrice = godsprice-couponSum+wrapprice;
            $('#promo-code-sum').val(couponSum);
        } else {
            couponprice = '0 руб';
            totalPrice = godsprice+wrapprice;
        }

        $('#gods-price').html(godsprice+' руб');
        $('#coupon-price').html(couponprice);
        $('#total-price').html(totalPrice+' руб');
        $('#wrap-price').html(wrapprice+' руб');
    }

    $(document).on('change', '.shipping-confirm, #shipaddr', function () {
        if($('.shipping-confirm option:selected')[0].getAttribute('value') == 'flat12_flat12'){
            $('.deliv-hint').remove();
            $('.deliv-cart').append('<div class="deliv-hint" data-hint="'+$('.shipping-confirm option:selected')[0].getAttribute('value')+'">' +
                '<b>При отправке ТК Энергия, рекомендуем Вам выбирать способ упаковки "коробка", т.к по правилам перевозки ТК сборного груза, упаковка должна быть жесткая, в противном случае за повреждение груза ответсвенность ТК Энергия не несет.</b>' +
                '</div>');
        }else if($('.shipping-confirm option:selected')[0].getAttribute('value') == 'russianpostpf_russianpostpf'){
            $('.deliv-hint').remove();
            $('.deliv-cart').append('<div class="deliv-hint" data-hint="'+$('.shipping-confirm option:selected')[0].getAttribute('value')+'">' +
                '<b>На данный момент со стороны Почты России происходит задержка в отправке заказа в 2 дня</b>' +
                '</div>');
        }else{
            $('.deliv-hint').remove();
        }
        $('.shipping-confirm option').filter(function (index) {
            if ($(this).val() == '') {
                return $(this)
            }
        }).remove();
        $.post(
            "/site/requestadress",
            {ship: $('.shipping-confirm option:selected')[0].getAttribute('data-pasp'),
                id:$('#shipaddr option:selected')[0].getAttribute('value'),
                _csrf: yii.getCsrfToken()},
            onAjaxSuccessinfo
        );

        changeDisableSubmit();
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

    function changeDisableSubmit() {
	    if ($('.shipping-confirm').val() === undefined)
		    $('#check-confirm').addClass('disabled');
	    else {
		    $('#check-confirm').removeClass('disabled');
		    $('#check-confirm + .btn-tk-error').remove();
	    }
    }
</script>

