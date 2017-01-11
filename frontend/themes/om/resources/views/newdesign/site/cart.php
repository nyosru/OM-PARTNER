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
<!-- layout: main-layout -->


<!-- Main Container -->
<section class="main-container col1-layout">
<div class="main container">
<div class="col-main">
<div class="cart">
<div class="page-title">
    <h2>Товары в моей корзине</h2>
</div>
<div class="clearfix">
    <button class="button pull-right" id="save-set">Сохранить корзину</button>
</div>
<div class="table-responsive">
    <form method="post" action="#">
        <fieldset>
            <table class="data-table cart-table" id="shopping-cart-table">
                <thead>
                <tr class="first last">
                    <th></th>
                    <th style="width: 33%;"><span class="nobr">Наименование</span></th>
                    <th><span class="nobr">Размер</span></th>
                    <th><span class="nobr">Цена</span></th>
                    <th><span class="nobr">Количество</span></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </fieldset>
    </form>
</div>
<!-- BEGIN CART COLLATERALS -->
<div class="cart-collaterals row">
<div class="col-sm-4">
<div class="shipping">
<h3>Estimate Shipping and Tax</h3>
<div class="shipping-form">
<form id="shipping-zip-form" method="post" action="#">
<p>Enter your destination to get a shipping estimate.</p>
<ul class="form-list">
<li>
<label class="required" for="country"><em>*</em>Country</label>
<div class="input-box">
<select title="Country" class="validate-select" id="country" name="country_id">
<option value="Select">Select</option>
<option value="AF">Afghanistan</option>
<option selected="selected" value="US">United States</option>
</select>
</div>
</li>
<li>
    <label for="region_id">State/Province</label>
    <div class="input-box">
        <select title="State/Province" name="region_id" id="region_id">
            <option value="">Please select region, state or province</option>
            <option value="1" title="Alabama">Alabama</option>
            <option value="2" title="Alaska">Alaska</option>
            <option value="3" title="American Samoa">American Samoa</option>
            <option value="4" title="Arizona">Arizona</option>
        </select>
        <input type="text" class="input-text" title="State/Province" name="region" id="region">
    </div>
</li>
<li>
    <label for="postcode">Zip/Postal Code</label>
    <div class="input-box">
        <input type="text" name="estimate_postcode" id="postcode" class="input-text validate-postcode">
    </div>
</li>
</ul>
<div class="buttons-set11">
    <button class="button get-quote" title="Get a Quote" type="button"><span>Get a Quote</span></button>
</div>
<!--buttons-set11-->
</form>
</div>
</div>
</div>
<div class="col-sm-4">
    <div class="discount">
        <h3>Discount Codes</h3>
        <form method="post" action="#" id="discount-coupon-form">
            <label for="coupon_code">Enter your coupon code if you have one.</label>
            <input type="hidden" value="0" id="remove-coupone" name="remove">
            <input type="text" name="coupon_code" id="coupon_code" class="input-text fullwidth">
            <button value="Apply Coupon" class="button coupon " title="Apply Coupon" type="button"><span>Apply Coupon</span></button>
        </form>
    </div>
</div>
<div class="col-sm-4">
    <div class="totals">
        <h3>Shopping Cart Total</h3>
        <div class="inner">
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                <tfoot>
                <tr>
                    <td colspan="1" class="a-left"><strong>Grand Total</strong></td>
                    <td class="a-right"><strong><span class="price">$77.38</span></strong></td>
                </tr>
                </tfoot>
                <tbody>
                <tr>
                    <td colspan="1" class="a-left"> Subtotal </td>
                    <td class="a-right"><span class="price">$77.38</span></td>
                </tr>
                </tbody>
            </table>
            <ul class="checkout">
                <li>
                    <button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Proceed to Checkout</span></button>
                </li>
                <li><br>
                </li>
                <li><a title="Checkout with Multiple Addresses" href="multiple_addresses.html">Checkout with Multiple Addresses</a> </li>
                <li><br>
                </li>
            </ul>
        </div>
    </div>
    <!--inner-->

</div>
</div>

<!--cart-collaterals-->

</div>

</div>
</div>
</section>
<script>
/*
РЕНДЕР ТОВАРА В КОРЗИНЕ
 */
function renderCartProduct(product,params,item,i){
    var access, identypay, disable_for_stepping;
    if((typeof(product.productsAttributes[this[2]]) !=='undefined' && product.productsAttributes[this[2]].quantity == 0) || product.products.products_quantity == 0){
        access = params.message ;
        identypay = false;
    }else if(params.result == false){
        access = params.message;
        identypay = false;
    }else{
        access = params.message;
        identypay = true;
    }
    if(product.products.products_quantity_order_min === '1'  || product.products.products_quantity_order_units === '1'){
        disable_for_stepping = '';
    }else{
        disable_for_stepping = 'readonly';
    }
    var result =
        '<tr data-calc="'+identypay+'" data-access="'+access+'" data-raw="'+i+'">' +
            '<td class="image">' +
                '<a class="product-image" href="/product?id='+product.products.products_id+'" target="_blank">' +
                    '<img width="75"  alt="'+product.productsDescription.products_name+'" src="/imagepreview?src=' + product.products.products_id + '">' +
                '</a>' +
            '</td>' +
            '<td>' +
                '<h2 class="product-name"><a href="#">'+product.productsDescription.products_name+'</a></h2>' +
                '<span>Код: '+product.products.products_model+'</span>' + renderCommentsProduct(product,item,i) +
            '</td>' +
            '<td><div data-attr="' + item[2] + '" class="cart-attr">' + item[6] + '</div></td>' +
            '<td><span class="price">' + parseInt(product.products.products_price) + ' руб.</span></td>' +
            '<td class="num-of-items" data-raw="' + i + '">' +
                '<div class="custom">' +
                    '<button id="del-count" class="reduced items-count del-count" type="button"><i class="icon-minus">&nbsp;</i></button>' +
                    '<input '+ disable_for_stepping +' id="input-count" class="input-count input-text qty" name="product['+item[0]+']['+item[2]+']" '+renderDataInput(product,item,i)+'>' +
                    '<button id="add-count" class="increase items-count add-count" type="button"><i class="icon-plus">&nbsp;</i></button>' +
                '</div>' +
            '</td>' +
            '<td>' +
                '<a class="button remove-item del-product" title="Удалить" href="#"><span><span>Удалить</span></span></a>' +
            '</td>' +
        '</tr>';

    return result;
}
function renderCommentsProduct(product,item,i){
    var textareaName;
    if(typeof(product.productsAttributes[item[2]]) !=='undefined'){
        textareaName = 'comments['+product.products.products_id+']['+product.productsAttributesDescr[item[6]].products_options_values_id+']';

    }else{
        textareaName = 'comments['+product.products.products_id+'][all]';
    }
    var result =
        '<div class="panel panel-default">' +
            '<div class="panel-heading">' +
                '<div class="panel-title">' +
                    '<a data-toggle="collapse" data-parent="#accordion" href="#collapse-product-'+i+'">Добавить комментарий к этому товару</a> ' +
                '</div> ' +
            '</div> ' +
            '<div id="collapse-product-'+i+'" class="panel-collapse collapse"> ' +
                '<div class="panel-body">' +
                    '<textarea class="form-control" name="'+textareaName+'"></textarea>' +
                '</div> ' +
            '</div> ' +
        '</div>';
    return result;
}
/*
РЕНДЕР DATA АТРИБУТОВ ТОВАРА
 */
function renderDataInput(product,item,i){
    var result =
            'data-prod="'+item[0]+'" ' +
            'data-model="'+item[1]+'" ' +
            'data-price="'+parseFloat(product.products.products_price)+'" ' +
            'data-image="'+product.products.products_image+'" ' +
            'data-name="'+product.productsDescription.products_name+'" ' +
            'data-min="'+product.products.products_quantity_order_min+'" ' +
            'data-step="'+product.products.products_quantity_order_units+'"  ' +
            'data-id="'+i+'" ';
    if(typeof(product.productsAttributes[item[2]]) !=='undefined'){
        result +=
            'data-count="'+product.productsAttributes[item[2]].quantity+'" '+
            'data-attr="'+product.productsAttributesDescr[item[6]].products_options_values_id+'" ' +
            'data-attrname="'+product.productsAttributesDescr[item[6]].products_options_values_name+'" '+
            'value="' + Math.min(item[4],product.productsAttributes[item[2]].quantity) + '" ';
    }else{
        result +=
            'data-count="'+product.products.products_quantity+'"  ' +
            'data-attr="" ' +
            'data-attrname="" '+
            'value="' + Math.min(item[4],product.products.products_quantity) + '" ';
    }
    return result;
}
$(window).on('load', function () {
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        if(typeof ($i)== 'undefined'){
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
        $c = 0;

        $.each($i, function (i,item) {
            var requestdata = $.ajax({
                method: 'post',
                url: "/site/product",
                async: false,
                data: {id: item[0], _csrf: yii.getCsrfToken()}
            });

            var mandata = $.ajax({
                method: 'post',
                url: "/site/pre-check-product-to-orders",
                async: false,
                data: {
                    product: requestdata.responseJSON.product.products_id,
                    category: requestdata.responseJSON.categories_id,
                    attr: item[2],
                    count: item[4],
                    _csrf: yii.getCsrfToken()
                }
            });

            $('.cart-table tbody').append(renderCartProduct(requestdata.responseJSON.product, mandata.responseJSON,item,i));
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

