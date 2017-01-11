<?php
use yii\helpers\Html;
$this -> title = 'Корзина';
?>

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
        <h3>Информация</h3>
        <div class="shipping-form">
            <?php if(!Yii::$app->user->isGuest && $template == 'om' ){ ?>
                <p>Я выбираю способ упаковки моего заказа:</p>
                <div class="checkbox">
                    <label>
                        <input id="pack" name="wrap" type="radio" value="packages" checked="checked"/>Полиэтиленовые пакеты
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input id="box" name="wrap" type="radio" value="boxes" />Крафт-коробки
                    </label>
                </div>
                <hr>
                <p>Адрес доставки:</p>
                <div class="shipaddr" style="">
                    <select id="shipaddr" name="address" class="form-control">
                        <?php
                        if(isset($addr[$default])){
                            echo '<option value="' . $default . '">' . $addr[$default] . '</option>';
                            unset($addr[$default]);
                        }
                        if(!empty($addr)){
                            foreach($addr as $key=>$value) {
                                echo '<option value="' . $key . '">' . $value . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <p>Я выбираю бесплатную доставку до компании:</p>
                <div class="ship" style=""></div>
<!--                <button class="button btn-lg lock-on" id="check-confirm" type="submit">Подтвердить заказ</button>-->
            <?php } else if($template == 'sp') { ?>
                <div class="address">
                    <div class="name-item lable-info-item">
                        Имя: <input disabled="" name="[userinfo]name" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="name" class="info-item" value="<?=htmlentities($userinfo['name']);?>">
                    </div>
                    <div class="secondname-item lable-info-item">
                        Отчество: <input disabled="" name="[userinfo]secondname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="secondname" class="info-item" value="<?=htmlentities($userinfo['secondname']);?>">
                    </div>
                    <div class="lastname-item lable-info-item">
                        Фамилия: <input disabled="" name="[userinfo]lastname" title="Допустимые символы а-я,a-z,-,пробел" data-placement="top" data-toggle="tooltip" data-name="lastname" class="info-item" value="<?=htmlentities($userinfo['lastname']);?>">
                    </div>
                    <div class="country-item lable-info-item">
                        Страна: <input autocomplete="off" disabled="" name="[userinfo]country" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="country" class="info-item" value="<?=htmlentities($userinfo['country']);?>">
                        <ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1"></ul>
                    </div>
                    <div class="state-item lable-info-item">
                        Область: <input autocomplete="off" disabled="" name="[userinfo]state" title="Выберите из списка" data-placement="top" data-toggle="tooltip" data-name="state" class="info-item" value="<?=htmlentities($userinfo['state']);?>">
                        <ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2"></ul>
                    </div>
                    <div class="city-item lable-info-item">
                        Город: <input disabled="" name="[userinfo]city" title="Допустимые символы а-я,a-z,0-9,-,пробел" data-placement="top" data-toggle="tooltip" data-name="city" class="info-item" value="<?=htmlentities($userinfo['city']);?>">
                    </div>
                    <div class="adress-item lable-info-item">
                        Адрес: <input disabled="" name="[userinfo]adress" title="Допустимые символы а-я,a-z,0-9,-,пробел,.,," data-placement="top" data-toggle="tooltip" data-name="adress" class="info-item" value="<?=htmlentities($userinfo['country']);?>">
                    </div>
                    <div class="postcode-item lable-info-item">
                        Почтовый индекс: <input disabled="" name="[userinfo]postcode" title="Допустимые символы 0-9, пробел" data-placement="top" data-toggle="tooltip" data-name="postcode" class="info-item" value="124124">
                    </div>
                    <div class="telephone-item lable-info-item">
                        Телефон: <input disabled="" name="[userinfo]telephone" title="Допустимые символы 0-9,-,пробел,),(,+" data-placement="top" data-toggle="tooltip" data-name="telephone" class="info-item" value="<?=htmlentities($userinfo['telephone']);?>">
                    </div>
                    <div class="order-accept">
                            <strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе!</strong><br>
                        Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных, а также соглашаетесь с <a target="_blank" href="/page?article=offerta">договором оферты</a>
                    </div>
                </div>
            <?php }else{ ?>
                <div class="deliv-addr"><a href="<?=BASEURL?>/login" class="shipaddr" style="">Необходимо авторизоваться</a></div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="discount">
        <h3>Промо-код на скидку</h3>
        <div class="deliv-code" id="discount-coupon-form"></div>
    </div>
</div>
<div class="col-sm-4">
    <div class="totals">
        <h3>Итог</h3>
        <div class="inner">
            <table class="table shopping-cart-table-total" id="shopping-cart-totals-table">
                <tbody>
                <tr>
                    <td>Стоимость</td>
                    <td class="a-right"><span class="price" id="gods-price"></span></td>
                </tr>
                <tr>
                    <td>Скидка</td>
                    <td class="a-right"><span class="price" id="coupon-price"></span></td>
                </tr>
                <tr>
                    <td>Упаковка(указана минимальная стоимость.Необходимое количество и размеры определит комплектовщик)</td>
                    <td class="a-right"><span class="price" id="wrap-price"></span></td>
                </tr>
                <tr>
                    <td>Доставка</td>
                    <td class="a-right"><span class="price" id="deliv-price">0 руб.</span></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td><strong>Всего к оплате</strong></td>
                    <td class="a-right"><strong><span class="price" id="total-price"></span></strong></td>
                </tr>
                </tfoot>
            </table>
            <textarea class="form-control" rows="3" name="ordercomments" placeholder="Добавить комментарий к этому заказу"></textarea>
            <ul class="checkout">
                <li>
                    <button class="button btn-proceed-checkout" title="Proceed to Checkout" type="button"><span>Подтвердить заказ</span></button>
                </li>
            </ul>
        </div>
    </div>
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
        '<tr data-calc="'+identypay+'" data-access="'+access+'" data-raw="'+i+'" class="cart-row">' +
            '<td class="image">' +
                '<a class="product-image" href="/product?id='+product.products.products_id+'" target="_blank">' +
                    '<img width="75"  alt="'+product.productsDescription.products_name+'" src="/imagepreview?src=' + product.products.products_id + '">' +
                '</a>' +
            '</td>' +
            '<td>' +
                '<h2 class="product-name"><a href="/product?id='+product.products.products_id+'">'+product.productsDescription.products_name+'</a></h2>' +
                '<span>Код: '+product.products.products_model+'</span>' + renderCommentsProduct(product,item,i) +
            '</td>' +
            '<td><div data-attr="' + item[2] + '" class="cart-attr">' + item[6] + '</div></td>' +
            '<td><span class="price cart-prod-price">' + parseInt(product.products.products_price) + ' руб.</span></td>' +
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
/*
РЕНДЕР ПОЛЯ ВВОДА КОММЕНТАРИЯ К ТОВАРУ
*/
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
        if($i.length>0){
            <?php
            if($template){?>
//            $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;">' +
//            '<a class="save-order" style="display: block;position: relative" href="<?//=BASEURL;?>///cart?action=1">Оформить заказ</a>' +
//            '</span></form></div>';
            <?php }elseif(!Yii::$app->user->isGuest) { ?>
           // $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
            <?php }else { ?>
           // $innerhtml+='<span class="cart-auth"  style="display: block; overflow: hidden; float: right;"><a class="auth-order" style="display: block;position: relative" href="/site/login">Купить</a></span></form></div>';
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
                    $('.ship').html('<select name="ship" class="shipping-confirm form-control"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select>');
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
                                $('.ship').append('<div class="shipping">Cпособ оплаты <select  name="ship" id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select>');
                            }
                        }
                    );
                }
            );
        }
        else {
            //$innerhtml='<div style="text-align: center; padding: calc(100% / 4);">Ваша корзина пуста</div>';
        }
        //$('.bside').html($innerhtml);
    }

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
        if($(this).attr('data-calc') == "true") {
            godsprice += ((parseFloat($(this).find('#input-count').val())) * (parseFloat($(this).find('.cart-prod-price').text())));
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

function changeDisableSubmit() {
    if ($('.shipping-confirm').val() === undefined)
        $('#check-confirm').addClass('disabled');
    else {
        $('#check-confirm').removeClass('disabled');
        $('#check-confirm + .btn-tk-error').remove();
    }
}
</script>

