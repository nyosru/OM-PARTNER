$(document).on('click', '.size', function () {
    $('.size-checked').removeClass('size-checked');
    $check = [];
    $(this).addClass('size-checked');
});
$(document).on('click', '.addfilter', function () {
    $(".page-checked").removeClass('page-checked');
});
$(document).on('click', '.page', function () {
    $('.page-checked').removeClass('page-checked');
    $(this).addClass('page-checked');
});
$(document).on('click', '.sort', function () {
    $('.sort-checked').removeClass('sort-checked');
    $(this).addClass('sort-checked');
});
$(document).on('click', '#prod-info, #prod-data-img', function () {
    $.post(
        "/site/productinfo",
        {id: this.getAttribute('data-prod')},
        onAjaxSuccess
    );
    function onAjaxSuccess(proddata) {
        $product = proddata[0];
        $('#prod-card-info').remove();
        $('body').append('<div id="prod-card-info" class="modal">' + proddata + '</div>');
        $("#prod-card-info").dialog({
            position: {my: "center center-80", at: "center center-80", of: window},
            modal: true,
            dialogClass: "cart-dialog-info",
            closeText: "X",
            maxHeight: 600,
            width: 600,
        });
        $(".cart-dialog-info").children().filter(".ui-dialog-titlebar").hide();
        $prodinfoattr = '<div class="cart-lable">В корзину</div>';
        if ($product.productsAttributesDescr.length > 0) {
            $.each($product.productsAttributesDescr, function () {
                $date = $product.products.products_date_added;
                $prodinfoattr += '<div class="size-desc"><div>' + this.products_options_values_name + '</div><input id="input-count" data-prod="' + $product.products.products_id + '" data-model="' + $product.products.products_model + '" data-price="' + $product.products.products_price + '" data-image="' + $product.products.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
            });
            $prodinfoattr += '<div class="cart-lable">В корзину</div>';
        } else {
            $date = $product.products.products_date_added;
            $prodinfoattr += '<div class="size-desc">+<input id="input-count" data-prod="' + $product.products.products_id + '" data-model="' + $product.products.products_model + '" data-price="' + $product.products.products_price + '" data-image="' + $product.products.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" type="text" placeholder="Количество" /><div id="add-count">+</div><div id="del-count">-</div></div>';
            $prodinfoattr += '<div class="cart-lable">В корзину</div>';
        }
        $('#prod-card-info').html('<button class="close-descript" type="button"><i class="fa fa-times fa-3x"></i></button><div class="cart-image" style="float: left; max-height: 300px; max-width: 300px; min-height: 300px; min-width: 300px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + $product.products.products_image + ');"></div> <div class="prod-info-name">' + $product.productsDescription.products_name + '</div><div class="prod-info-price"><b>' + parseInt($product.products.products_price) + '</b> Руб.</div><div class="prod-info-model">Артикул: ' + $product.products.products_model + '</div><div class="prod-info-date">Добавлен: ' + $date + '</div><div class="prod-info-desc">Описание: ' + $product.productsDescription.products_description + '</div><div class="prod-info-size"><span class="prod-info-attr-lable"></span>' + $prodinfoattr + '</div><div class="prod-info-soc-but" style="display: none">Поделиться</div><div style="z-index: 1060" class="modal bs-example-modal-lg image" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"><div class="modal-dialog modal-lg"> <div class="modal-content" style="text-align: center;"><img id="image-img" src="http://odezhda-master.ru/images/' + $product.products.products_image + '" /></div></div></div></div>');
        $('#prod-card-info').dialog();
    }
});
$(document).on('click', '.cart-image', function () {
    $('.image').attr('style', 'display:block;');
});
$(document).on('click', '#image-img, .image', function () {
    $('.image').attr('style', 'display:none;');
});
$(document).on('click', '.close-descript', function () {
    $('#prod-card-info').dialog('close');
});
$(document).on('click', '.save-order', function () {
    $('#modal-cart').html('<div class="shipping">Cпособ доставки <select id="shipping-confirm"><option class="shipping-confirm-option" value="flat2_flat2">Бесплатная доставка до ТК ЖелДорЭкспедиция</option><option class="shipping-confirm-option" value="flat1_flat1">Бесплатная доставка до ТК Деловые Линии</option><option class="shipping-confirm-option"  value="flat3_flat3">Бесплатная доставка до ТК ПЭК</option><option class="shipping-confirm-option"  value="flat7_flat7">Почта ЕМС России</option></select></div><div class="userinfo"></div>');
    $.post(
        "/site/requestadress",
        {ship: $('#shipping-confirm option:selected').val()},
        onAjaxSuccessinfo
    );
});
$(document).on('change', '#shipping-confirm', function () {
    $.post(
        "/site/requestadress",
        {ship: $('#shipping-confirm option:selected').val()},
        onAjaxSuccessinfo
    );
});
$(document).on('click', '.save-order2', function () {
    var regname = /^[a-zа-яё\-\s]+$/i;
    var m;
    if ($('[data-name="name"]').val() != '' && $('[data-name="name"]').val() != undefined) {
        str = $('[data-name="name"]').val();
    } else {
        str = $('[data-name="name"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="name"]').removeClass('haserror');
        $('[data-name="name"]').addClass('hassucces');
    } else {
        $('[data-name="name"]').removeClass('hassucces');
        $('[data-name="name"]').addClass('haserror');
    }
    if ($('[data-name="secondname"]').val() != '' && $('[data-name="secondname"]').val() != undefined) {
        str = $('[data-name="secondname"]').val();
    } else {
        str = $('[data-name="secondname"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="secondname"]').removeClass('haserror');
        $('[data-name="secondname"]').addClass('hassucces');
    } else {
        $('[data-name="secondname"]').removeClass('hassucces');
        $('[data-name="secondname"]').addClass('haserror');
    }
    if ($('[data-name="lastname"]').val() != '' && $('[data-name="lastname"]').val() != undefined) {
        str = $('[data-name="lastname"]').val();
    } else {
        str = $('[data-name="lastname"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="lastname"]').removeClass('haserror');
        $('[data-name="lastname"]').addClass('hassucces');
    } else {
        $('[data-name="lastname"]').removeClass('hassucces');
        $('[data-name="lastname"]').addClass('haserror');
    }
    regname = /^[a-zа-яё0-9\-\s]+$/i;
    if ($('[data-name="city"]').val() != '' && $('[data-name="city"]').val() != undefined) {
        str = $('[data-name="city"]').val();
    } else {
        str = $('[data-name="city"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="city"]').removeClass('haserror');
        $('[data-name="city"]').addClass('hassucces');
    } else {
        $('[data-name="city"]').removeClass('hassucces');
        $('[data-name="city"]').addClass('haserror');
    }
    regname = /^[a-zа-яё0-9\-\,\.\s]+$/i;
    if ($('[data-name="adress"]').val() != '' && $('[data-name="adress"]').val() != undefined) {
        str = $('[data-name="adress"]').val();
    } else {
        str = $('[data-name="adress"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="adress"]').removeClass('haserror');
        $('[data-name="adress"]').addClass('hassucces');
    } else {
        $('[data-name="adress"]').removeClass('hassucces');
        $('[data-name="adress"]').addClass('haserror');
    }
    regname = /^[0-9\s]+$/i;
    if ($('[data-name="postcode"]').val() != '' && $('[data-name="postcode"]').val() != undefined) {
        str = $('[data-name="postcode"]').val();
    } else {
        str = $('[data-name="postcode"]').text();
    }
    if (m = regname.exec(str) !== null && str.length < 10) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="postcode"]').removeClass('haserror');
        $('[data-name="postcode"]').addClass('hassucces');
    } else {
        $('[data-name="postcode"]').addClass('haserror');
        $('[data-name="postcode"]').removeClass('hassucces');
    }
    regname = /^[0-9\)\(\-\+]+$/i;
    if ($('[data-name="telephone"]').val() != '' && $('[data-name="telephone"]').val() != undefined) {
        str = $('[data-name="telephone"]').val();
    } else {
        str = $('[data-name="telephone"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="telephone"]').removeClass('haserror');
        $('[data-name="telephone"]').addClass('hassucces');
    } else {
        $('[data-name="telephone"]').addClass('haserror');
        $('[data-name="telephone"]').removeClass('hassucces');
    }
    $check = 0;
    if ($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined) {
        str = $('[data-name="country"]').val();
    } else {
        str = $('[data-name="country"]').text();
    }
    $country = $("[data-country]");
    $.each($country, function () {
        if (str == $(this).html()) {
            $check = 1;
        }
    });
    if ($check == 1) {
        $('[data-name="country"]').removeClass('haserror');
        $('[data-name="country"]').addClass('hassucces');
    } else {
        $('[data-name="country"]').addClass('haserror');
        $('[data-name="country"]').removeClass('hassucces');
    }
    $check = 0;
    $errstate = $('[data-state]');
    if ($errstate.length > 1) {
        if ($('[data-name="state"]').val() != '' && $('[data-name="state"]').val() != undefined) {
            str = $('[data-name="state"]').val();
        } else {
            str = $('[data-name="state"]').text();
        }
        $state = $("[data-state]");
        $.each($state, function () {
            if (str == $(this).html()) {
                $check = 1;
            }
        });
        if ($check == 1) {
            $('[data-name="state"]').removeClass('haserror');
            $('[data-name="state"]').addClass('hassucces');
        } else {
            $('[data-name="state"]').addClass('haserror');
            $('[data-name="state"]').removeClass('hassucces');
        }
    }
    $error = $('.haserror');
    if ($error.length == 0) {
        $(this).remove();
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $userdata = $('.info-item');
        $userdataarr = new Object();
        $.each($userdata, function () {
            $name_attr = this.getAttribute('data-name');

            if ($userdataarr[$name_attr] = $(this).val() != '') {
                $userdataarr[$name_attr] = $(this).val();
            } else {
                $userdataarr[$name_attr] = $(this).text();
            }
        });
        $.post(
            "/site/saveorder",
            {
                order: $item.cart,
                ship: $('#shipping-confirm option:selected')[0].value,
                user: $userdataarr
            },
            onAjaxSuccess
        );
    }
    function onAjaxSuccess(data) {
        if (data != 0) {
            localStorage.removeItem('cart-om');
            $(".cart-count").html('0');
            $(".cart-price").html('0');
            $('#modal-cart').html('<div style="padding: 10px; text-align: center; height: 100%; line-height: 40px;"><div>Ваш заказ № ' + data.id + ' ожидает подтверждения менеджером магазина.</div><div> Статус  заказа вы можете проверить вашем личном кабинете. </div><div class="btn btn-info btn-end-order" style="background: rgb(0, 255, 204) none repeat scroll 0% 0%; color: rgb(68, 68, 68);">Продолжить покупки</div></div>');
        }
    }
});
$(document).on('click', '.save-user-profile', function () {
    var regname = /^[a-zа-яё\-\s]+$/i;
    var m;
    if ($('[data-name="name"]').val() != '' && $('[data-name="name"]').val() != undefined) {
        str = $('[data-name="name"]').val();
    } else {
        str = $('[data-name="name"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="name"]').removeClass('haserror');
        $('[data-name="name"]').addClass('hassucces');
    } else {
        $('[data-name="name"]').removeClass('hassucces');
        $('[data-name="name"]').addClass('haserror');
    }
    if ($('[data-name="secondname"]').val() != '' && $('[data-name="secondname"]').val() != undefined) {
        str = $('[data-name="secondname"]').val();
    } else {
        str = $('[data-name="secondname"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="secondname"]').removeClass('haserror');
        $('[data-name="secondname"]').addClass('hassucces');
    } else {
        $('[data-name="secondname"]').removeClass('hassucces');
        $('[data-name="secondname"]').addClass('haserror');
    }
    if ($('[data-name="lastname"]').val() != '' && $('[data-name="lastname"]').val() != undefined) {
        str = $('[data-name="lastname"]').val();
    } else {
        str = $('[data-name="lastname"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="lastname"]').removeClass('haserror');
        $('[data-name="lastname"]').addClass('hassucces');
    } else {
        $('[data-name="lastname"]').removeClass('hassucces');
        $('[data-name="lastname"]').addClass('haserror');
    }
    regname = /^[a-zа-яё0-9\-\s]+$/i;
    if ($('[data-name="city"]').val() != '' && $('[data-name="city"]').val() != undefined) {
        str = $('[data-name="city"]').val();
    } else {
        str = $('[data-name="city"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="city"]').removeClass('haserror');
        $('[data-name="city"]').addClass('hassucces');
    } else {
        $('[data-name="city"]').removeClass('hassucces');
        $('[data-name="city"]').addClass('haserror');
    }
    regname = /^[a-zа-яё0-9\-\,\.\s]+$/i;
    if ($('[data-name="adress"]').val() != '' && $('[data-name="adress"]').val() != undefined) {
        str = $('[data-name="adress"]').val();
    } else {
        str = $('[data-name="adress"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="adress"]').removeClass('haserror');
        $('[data-name="adress"]').addClass('hassucces');
    } else {
        $('[data-name="adress"]').removeClass('hassucces');
        $('[data-name="adress"]').addClass('haserror');
    }
    if ($('[data-name="pasportwhere"]').val() != '' && $('[data-name="pasportwhere"]').val() != undefined) {
        str = $('[data-name="pasportwhere"]').val();
    } else {
        str = $('[data-name="pasportwhere"]').text();
    }
    if (m = regname.exec(str) !== null || $('[data-name="pasportwhere"]').val() == '' || $('[data-name="pasportwhere"]').val() == undefined) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="pasportwhere"]').removeClass('haserror');
        $('[data-name="pasportwhere"]').addClass('hassucces');
    } else {
        $('[data-name="pasportwhere"]').addClass('haserror');
        $('[data-name="pasportwhere"]').removeClass('hassucces');
    }
    regname = /^[0-9\s]+$/i;
    if ($('[data-name="postcode"]').val() != '' && $('[data-name="postcode"]').val() != undefined) {
        str = $('[data-name="postcode"]').val();
    } else {
        str = $('[data-name="postcode"]').text();
    }
    if (m = regname.exec(str) !== null && str.length < 10) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="postcode"]').removeClass('haserror');
        $('[data-name="postcode"]').addClass('hassucces');
    } else {
        $('[data-name="postcode"]').addClass('haserror');
        $('[data-name="postcode"]').removeClass('hassucces');
    }
    if ($('[data-name="pasportser"]').val() != '' && $('[data-name="pasportser"]').val() != undefined) {
        str = $('[data-name="pasportser"]').val();
    } else {
        str = $('[data-name="pasportser"]').text();
    }
    if (m = regname.exec(str) !== null || $('[data-name="pasportser"]').val() == '' || $('[data-name="pasportser"]').val() == undefined) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="pasportser"]').removeClass('haserror');
        $('[data-name="pasportser"]').addClass('hassucces');
    } else {
        $('[data-name="pasportser"]').addClass('haserror');
        $('[data-name="pasportser"]').removeClass('hassucces');
    }
    if ($('[data-name="pasportnum"]').val() != '' && $('[data-name="pasportnum"]').val() != undefined) {
        str = $('[data-name="pasportnum"]').val();
    } else {
        str = $('[data-name="pasportnum"]').text();
    }
    if (m = regname.exec(str) !== null || $('[data-name="pasportnum"]').val() == '' || $('[data-name="pasportnum"]').val() == undefined) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="pasportnum"]').removeClass('haserror');
        $('[data-name="pasportnum"]').addClass('hassucces');
    } else {
        $('[data-name="pasportnum"]').addClass('haserror');
        $('[data-name="pasportnum"]').removeClass('hassucces');
    }
    regname = /^[0-9\)\(\-\+]+$/i;
    if ($('[data-name="telephone"]').val() != '' && $('[data-name="telephone"]').val() != undefined) {
        str = $('[data-name="telephone"]').val();
    } else {
        str = $('[data-name="telephone"]').text();
    }
    if (m = regname.exec(str) !== null) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="telephone"]').removeClass('haserror');
        $('[data-name="telephone"]').addClass('hassucces');
    } else {
        $('[data-name="telephone"]').addClass('haserror');
        $('[data-name="telephone"]').removeClass('hassucces');
    }
    regname = /^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/i;
    if ($('[data-name="pasportdate"]').val() != '' && $('[data-name="pasportdate"]').val() != undefined) {
        str = $('[data-name="pasportdate"]').val();
    } else {
        str = $('[data-name="pasportdate"]').text();
    }
    if (m = regname.exec(str) !== null || $('[data-name="pasportdate"]').val() == '' || $('[data-name="pasportdate"]').val() == undefined) {
        if (m.index === regname.lastIndex) {
            regname.lastIndex++;
        }
        $('[data-name="pasportdate"]').removeClass('haserror');
        $('[data-name="pasportdate"]').addClass('hassucces');
    } else {
        $('[data-name="pasportdate"]').addClass('haserror');
        $('[data-name="pasportdate"]').removeClass('hassucces');
    }
    $check = 0;
    if ($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined) {
        str = $('[data-name="country"]').val();
    } else {
        str = $('[data-name="country"]').text();
    }
    $country = $("[data-country]");
    $.each($country, function () {
        if (str == $(this).html()) {
            $check = 1;
        }
    });
    if ($check == 1) {
        $('[data-name="country"]').removeClass('haserror');
        $('[data-name="country"]').addClass('hassucces');
    } else {
        $('[data-name="country"]').addClass('haserror');
        $('[data-name="country"]').removeClass('hassucces');
    }
    $check = 0;
    $errstate = $('[data-state]');
    if ($errstate.length > 1) {
        if ($('[data-name="state"]').val() != '' && $('[data-name="state"]').val() != undefined) {
            str = $('[data-name="state"]').val();
        } else {
            str = $('[data-name="state"]').text();
        }
        $state = $("[data-state]");
        $.each($state, function () {
            if (str == $(this).html()) {
                $check = 1;
            }
        });
        if ($check == 1) {
            $('[data-name="state"]').removeClass('haserror');
            $('[data-name="state"]').addClass('hassucces');
        } else {
            $('[data-name="state"]').addClass('haserror');
            $('[data-name="state"]').removeClass('hassucces');
        }

    }
    $error = $('.haserror');
    if ($error.length == 0) {
        $userdata = $('.info-item');
        $userdataarr = new Object();
        $.each($userdata, function () {
            $name_attr = this.getAttribute('data-name');
            if ($userdataarr[$name_attr] = $(this).val() != '') {
                $userdataarr[$name_attr] = $(this).val();
            } else {
                $userdataarr[$name_attr] = $(this).text();
            }
        });
        $.post(
            "/site/saveuserprofile",
            {
                user: $userdataarr
            },
            alert('Данные сохранены')
        );
    }

});
function onAjaxSuccesssaveuserprofile() {
}
$(document).on('click', '.btn-end-order', function () {
    $('#modal-cart').dialog('close');
});
$(document).on('click', '#add-count', function () {
    $count = $(this).siblings('input')[0].value;
    if ($count == '') {
        $count = 0;
    }
    if (isNaN(parseInt($count))) {
        $count = -1;
    }
    $(this).siblings('input')[0].value = parseInt($count) + 1;
});
$(document).on('click', '#del-count', function () {
    $count = $(this).siblings('input')[0].value;
    if ($count == '') {
        $count = 0;
    }
    if (isNaN(parseInt($count))) {
        $count = 1;
    }
    $(this).siblings('input')[0].value = (parseInt($count) - 1) < 0 ? 0 : (parseInt($count) - 1);
});
$(document).on('click', '.del-product', function () {
    $delrow = $(this).parent().attr('data-raw');
    $new_cart = new Object();
    $item = JSON.parse(localStorage.getItem('cart-om'));
    $array_splice = $item.cart;
    $array_splice.splice($delrow, 1);
    $new_cart.cart = $array_splice;
    $ilocal = JSON.stringify($new_cart);
    localStorage.setItem('cart-om', $ilocal);
    $innerhtml = '';
    $c = 0;
    $amount_prod = 0;
    $cart_price = 0;
    $.each($array_splice, function () {
        $amount_prod = $amount_prod + parseInt(this[4]);
        $cart_price = $cart_price + (parseInt(this[3]) * parseInt(this[4]));
        if (this[6] == 'undefined') {
            this[6] = 'Без размера'
        } else {
            this[6] = this[6] + ' размер';
        }
        $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row"><div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div><div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount">' + this[4] + ' шт.</div></div>';
    });
    $(".cart-count").html($amount_prod);
    $(".cart-price").html($cart_price + ' руб.');
    $('#modal-cart').html($innerhtml);

    if ($array_splice.length == 0) {
        $("#modal-cart").dialog('close');
    }
});
$(document).on('click', '.cart', function () {
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
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row"><div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div><div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount">' + this[4] + ' шт.</div></div>';
        });
        $('#modal-cart').html($innerhtml);
    } else {
        $('#modal-cart').html('<div style="text-align: center; padding: calc(100% / 4);">Пусто</div>');
        $('.ui-dialog-titlebar').show();
    }
    $("#modal-cart").dialog({
        position: {my: "center bottom-50", at: "center bottom", of: "#w0"},
        modal: true,
        dialogClass: "cart-dialog",
        closeText: "X",
        maxHeight: 428,
        width: 600,
        title: "Ваша корзина",
        resizable: false,

    });
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        if (document.location.hash == '') {
            $urlhash = '#';
        } else {
            $urlhash = document.location.hash;
        }
        if ($('[data-method="post"]').attr('href') == '/site/lk' && $i.length > 0) {
            $(".ui-dialog-title").html('Ваша корзина. <span class="cart-auth"><a class="save-order" href="' + $urlhash + '">Оформить заказ</a></span>');
        } else if ($i.length > 0) {
            $(".ui-dialog-title").html('Ваша корзина.<span class="cart-auth"><a class="auth-order" href="/site/login">Купить</a></span>');
        }
        $('.ui-dialog-titlebar').show();
    }
});
$(document).on('click', '.cart-lable', function () {
    $cart_add_obj = $(this).siblings().filter('.size-desc');
    $checkzero = 0;
    $.each($cart_add_obj, function () {
        var $item = new Object();
        $item_add = $(this).children('input')[0];
        $item.cart = [];
        if ($item_add.value != '' && $item_add.value != '0') {
            $checkzero = 1;
            $($(this).parent().parent())
                .clone()
                .css({
                    'position': 'absolute',
                    'z-index': '11100',
                    top: $(this).parent().parent().offset()['top'],
                    left: $(this).parent().parent().offset()['left']
                })
                .appendTo("body")
                .animate({
                    opacity: 0.05,
                    left: $(".cart-count").offset()['left'],
                    top: $(".cart-count").offset()['top'],
                    width: 20,
                }, 1000, function () {
                    $(this).remove();
                });
            if (JSON.parse(localStorage.getItem('cart-om'))) {
                $item = JSON.parse(localStorage.getItem('cart-om'));
                $i = $item.cart.length;
            } else {
                $i = 0;
            }
            x = 0;
            if ($item.cart.length > 0) {
                $.each($item.cart, function () {
                    if ($item_add.getAttribute('data-prod') == this[0] && $item_add.getAttribute('data-model') == this[1] && $item_add.getAttribute('data-attr') == this[2]) {
                        this[4] = parseInt(this[4]) + parseInt($item_add.value);
                        x = 1;
                    }
                });
            } else {
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname')];
            }
            if (x == 0) {
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname')];
            }
            $ilocal = JSON.stringify($item);
            localStorage.setItem('cart-om', $ilocal);
            $arr_prod = $item.cart;
            $amount_prod = 0;
            $cart_price = 0;
            $.each($arr_prod, function () {
                $amount_prod = $amount_prod + parseInt(this[4]);
                $cart_price = $cart_price + (parseInt(this[3]) * parseInt(this[4]));
            });
            $(".cart-count").html($amount_prod);
            $(".cart-price").html($cart_price + ' руб.');
        }
    });
    if ($checkzero == 0) {
        alert('Укажите количество');
    }

});

$(document).on('click', '.countdisplay', function index_count_display() {
    $('.page-checked').removeClass('page-checked');
    $(".countdisplay").removeClass('count-checked');
    if ($(this).attr('class') == 'countdisplay') {
        $(this).addClass('count-checked');
    } else {
        $(this).removeClass('count-checked');
    }
});
$(document).on('click', '.reset', function () {
    $(".page-checked").removeClass('page-checked');
    $('.size-checked').removeClass('size-checked');
    $('#max-price').text("1000000");
    $('#min-price').text("0");
});
var cSpeed = 9;
var cWidth = 64;
var cHeight = 64;
var cTotalFrames = 18;
var cFrameWidth = 64;
var cImageSrc = '/images/preloader/sprites.png';
var cImageTimeout = false;
var cIndex = 0;
var cXpos = 0;
var cPreloaderTimeout = false;
var SECONDS_BETWEEN_FRAMES = 0;
function startAnimation() {
    document.getElementById('loaderImage').style.backgroundImage = 'url(' + cImageSrc + ')';
    document.getElementById('loaderImage').style.width = cWidth + 'px';
    document.getElementById('loaderImage').style.height = cHeight + 'px';
    FPS = Math.round(100 / cSpeed);
    SECONDS_BETWEEN_FRAMES = 1 / FPS;
    cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES / 1000);
}
function continueAnimation() {
    cXpos += cFrameWidth;
    cIndex += 1;
    if (cIndex >= cTotalFrames) {
        cXpos = 0;
        cIndex = 0;
    }
    if (document.getElementById('loaderImage'))
        document.getElementById('loaderImage').style.backgroundPosition = (-cXpos) + 'px 0';
    cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES * 1000);
}
function stopAnimation() {
    clearTimeout(cPreloaderTimeout);
    cPreloaderTimeout = false;
}
function imageLoader(s, fun) {
    clearTimeout(cImageTimeout);
    cImageTimeout = 0;
    genImage = new Image();
    genImage.onload = function () {
        cImageTimeout = setTimeout(fun, 0)
    };
    genImage.onerror = new Function('alert(\'Could not load the image\')');
    genImage.src = s;
}
function new_url($arr_sub) {
    $new_url = [];
    $.each($arr_sub, function () {
        $new_url.push(this[0] + '=' + this[1]);
    });
    return $new_url.join('&');
}
function split_url($url) {
    $url_arr = $url.split('&');
    $arr_sub = new Object();
    $.each($url_arr, function () {
        $spl = this.split('=');
        $arr_sub[$spl[0]] = $spl;
    });
    return $arr_sub;
}
function new_suburl($url_obj, $val, $new_var) {
    $value = $url_obj[$val];
    $value[1] = $new_var;
    $url_obj[$val] = $value;
    return $url_obj;
}
$(document).on('click ready', '.data-j', function () {
    if (this.getAttribute('class').indexOf('index-card') != -1) {
        $cat = this.getAttribute('data-cat');
        $(".link[data-cat=" + $cat + "]").attr('data', 'checked');
    }
    if (this.getAttribute('class').indexOf('index-sort') != -1) {
        $cat = this.getAttribute('data-cat');
        $(".link").attr('data', 'checked');
    }
    $cat = [];
    if ($('#search').val() == '') {
        $cat = $('[data=checked]').attr('data-cat');
        $searchword = '';
    } else {
        $cat = '0';
        $searchword = $('#search').val();
    }
    $count = $('.count-checked').text();
    $min_price = $('#min-price').val();
    $sort = $('.sort-checked').attr('data');
    if ($sort == 'undefined') {
        $sort = 0;
    }
    $check = [];
    $max_price = $('#max-price').val();
    if ($max_price == 0 || $max_price == undefined) {
        $max_price = 1000000;
    }
    $('.size-checked').each(function () {
        $check.push($(this).attr('data-size'));
    });
    $page = $('.page-checked').attr('data-page');
    if ($page == 'undefined') {
        $page = 0;
    }

    $prodatrquery = $check.join(',');
    if ($count == '') {
        $count = 20;
    }
    $('body').addClass('some');
    $('link').addClass('some');
    $('html').prepend('<div class="preload"><div id="loaderImage"></div></div>');
    new imageLoader(cImageSrc, 'startAnimation()');
    if(typeof $cat == 'undefined'){
        $urld = '';
        $urld = document.location.toString();
        $urld = '!#'+$urld.replace('?_escaped_fragment_=','!#').split('!#')[1];
        $urld = split_url($urld);
        $cat = $urld['!#cat'][1];
        console.log($urld);
    }
    $url = '#!cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword;
    $url_data = split_url(document.location.hash);
    $.ajax({
        url: "/site/request",
        data: 'cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword,
        cache: false,
        async: true,
        dataType: 'json',
        success: function (data) {
            console.log(data[17])
            $('body').removeClass('some');
            $('link').removeClass('some');
            $('.preload').remove();
            if (data[0] != 'Не найдено!') {
                $('.bside').html("");
                $('#size-slide').html("");
                $('#filters').html(' <div id="price-lable">Цена</div>От <input id="min-price" value="0" class="btn" /> До<input id="max-price" class="btn" /> Руб.<div class="price-slide"><div class="slider"></div> </div><div id="size-slide"></div><div type="button" id="filter-button"></div> ');
                $headbside = '';
                $headbside += '<div id="partners-main-right">';
                $headbside += '<div id="products-counter">' + data[4] + '-' + data[5] + ' из ' + data[1] + '</div>';
                $headbside += '<div id="products-pager"></div>';
                $headbside += '<div id="count-display"> | Показывать по<div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="20"  href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '20')) + '">20</a></div><div class="count data-j"> <a data-j="on" class="countdisplay" onclick="" data-count="50" href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '50')) + '">50</a></div> </div> <div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="100" href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '100')) + '">100</a>  <a class="countdisplay" onclick="" data-j="on" data-count="200" href="' + new_url(new_suburl(split_url($url), 'count', '200')) + '">200</a>  <a class="countdisplay" onclick="" data-j="on" data-count="500" href="' + new_url(new_suburl(split_url($url), 'count', '500')) + '">500</a>  <a class="countdisplay" onclick="" data-j="on" data-count="1000" href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '1000')) + '">1000</a> </div>';
                $headbside += '<div id="sort-order"><div  class="header-sort sort" data="' + data[11] + '">Сортировать по </div>';
                $sortorder = [['дате', 0, 10], ['цене', 1, 11], ['названию', 2, 12], ['модели', 3, 13], ['популярности', 4, 14]];
                $.each($sortorder, function () {
                    if (data[11] == this[1]) {
                        $dataord = this[2];
                        $arrow = 'caret-up';
                    } else {
                        $dataord = this[1];
                        $arrow = 'caret-down';
                    }
                    if (this[1] == data[11] || this[2] == data[11]) {
                        $headbside += '<div class="header-sort-item-active"><a class="sort data-j" href="/site/catalog' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '" data="' + $dataord + '" href="#">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                    } else {
                        $headbside += '<div class="header-sort-item"><a class="sort data-j" data="' + $dataord + '" href="/site/catalog' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                    }
                });
                $('.bside').prepend($headbside);
                $('.header-sort-item:first').attr('style', "border-left:none;");
                $('.header-sort-item:last').attr('style', "border-right:none;");
                $('.header-sort-item-active').next().attr('style', "border-left:none;");
                $('.header-sort-item-active').prev().attr('style', "border-right:none;");
                $('.sort[data=' + data[11] + ']').addClass('sort-checked');
                $('[data-count = ' + $count + ']').addClass('count-checked');
                $('#max-price').val(data[8]);
                $('#min-price').val(data[7]);
                if (data[3].length > 1 && data[3].length <= 30) {
                    $('#size-slide').append('<div id="size-lable">Размеры </div>');
                } else if (data[3].length > 30) {
                    $('#size-slide').append('<div id="size-lable"><input id="class-size-filter" style="width:100%;  height: 20px;" placeholder="начните вводить интересующий размер"/></div>');
                }
                $.each(data[3], function () {
                    $attrproducts = this.products_options_values_name;
                    $attrproductsid = this.products_options_values_id;
                    if ($attrproducts != null && data[3].length <= 30) {
                        $('#size-slide').append('<div data-size="' + $attrproductsid + '" class="size">' + $attrproducts + '</div>');
                    } else if ($attrproducts != null && data[3].length > 30) {
                        $('#size-slide').append('<div data-size="' + $attrproductsid + '" class="size" style="display:none;" data-toggle="tooltip" data-placement="top" title="' + $attrproducts + '"><i class="fa fa-check"></i><div style="left: 341%; position: relative; width: 50px; overflow: hidden; height: 100%;">' + $attrproducts + '</div></div>');
                    }
                });
                $(document).on('keyup', '#class-size-filter', function () {
                    $('.size').hide();
                    $text = $(this).val();
                    $.each(data[3], function () {
                        $attrproducts = this.products_options_values_name;
                        if ($attrproducts != null) {
                            if ($attrproducts.toLowerCase().indexOf($text.toLowerCase()) != -1) {
                                $('[data-size = ' + this.products_options_values_id + ']').show();
                            }
                        }
                    })
                });
                if (data[9] != '') {
                    $("[data-size=" + data[9] + "]").addClass('size-checked');
                }
                $('#filter-button').html('<div style="clear: both;padding: 10px 20px;"><div class="btn btn-info btn-sm data-j addfilter" style="float: left">Применить</div><div class="btn btn-danger btn-sm data-j reset" style="float: right">Сбросить</div></div>');
                $.each(data[0], function () {
                    $product = this.products;
                    $description = this.productsDescription;
                    $attr_desc = this.productsAttributesDescr;
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if ($attr_desc.length > 0) {
                        $.each($attr_desc, function () {
                            $attr_html += '<div class="size-desc"><div><div class="lable-item">' + this.products_options_values_name + '</div></div><input id="input-count" data-prod="' + $product.products_id + '" data-model="' + $product.products_model + '" data-price="' + $product.products_price + '" data-image="' + $product.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        });
                    } else {
                        $attr_html += '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="' + $product.products_id + '" data-model="' + $product.products_model + '" data-price="' + $product.products_price + '" data-image="' + $product.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }
                    $('.bside').append('<div  class="container-fluid float" id="card" product=""><div data-prod="' + $product.products_id + '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');"></div><div class="name">' + $description.products_name + '</div><div class="model">Арт.' + $product.products_model + '</div><div class="price"><b>' + parseInt($product.products_price) + '</b> руб.</div><div id="prod-info" data-prod="' + $product.products_id + '">Инфо</div><span>' + $attr_html + '</span></div>');
                });
                if (data[5] >= data[1] && data[4] == 0) {
                    $('#products-pager').hide();
                } else {
                    $pager = '';
                    $countpager = Math.ceil(data[1] / $count);
                    if (data[10] != 'undefined') {
                        if (parseInt(data[10]) < 1) {
                            $natpage = 1;
                            $nextpage = 0;
                        } else if (parseInt(data[10]) + 1 >= $countpager) {
                            $natpage = $countpager - 1;
                            $nextpage = $countpager - 2;
                        } else {
                            $natpage = parseInt(data[10]);
                            $nextpage = parseInt(data[10]);
                        }
                    } else {
                        $natpage = 1;
                        $nextpage = 0;
                        data[10] = 0;
                    }
                    $pager += ' <a data-page="' + parseInt(data[10]) + '" class="page data-j" href="#">' + (parseInt(data[10]) + 1) + '</a> ';
                    $pager += 'из ' + $countpager;
                    $pager += ' <div data-page="' + ($natpage - 1) + '" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) + '"></a></i></div> ';
                    $pager += ' <div data-page="' + ($nextpage + 1) + '" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) + '"></a></i></div> ';
                    $('#products-pager').html('');
                    $('#products-pager').html('Страница: ' + $pager);
                    $('.bside').append('<div id="products-pager-down">Страница: ' + $pager + '</div>');
                }
                $("[data-page=" + $page + "]").addClass('page-checked');
                $ert = $cat;
                $(".slider").slider({
                    animate: true,
                    range: true,
                    values: [data[7], data[8]],
                    min: 0,
                    max: data[2].maxprice,
                    step: 1,
                    change: function (event, ui) {
                        $('#min-price').val(ui.values[0]);
                        $('#max-price').val(ui.values[1]);
                    }
                });
            } else {
                $('.bside').html('Нет Результатов <a class="data-j reset" href="#"> Попробуйте сбросить критерии</a>');
                $('#size-slide').html('');
                $('#filter-button').html('');
                $('body').removeClass('some');
                $('link').removeClass('some');
                $('.preload').remove();
            }
            $("[data-cat=" + data[12] + "]").attr('data', 'checked');
            $.each($('.link'), function () {
                if ($(this).children('a').length == 0) {
                    $(this).html('<a href="' + $url + '">' + $(this).html() + '</a>');
                } else {
                    $html = $(this).children('a').html()
                    $(this).html('<a href="' + $url + '">' + $(this).text() + '</a>');
                }
            });
            if (typeof data[16] != 'undefined') {
                if (history.pushState) {
                    history.pushState(null, null, '/site/catalog/' + data[16].join('/') + '/' + new_url(split_url($url)))
                }
                else {
                    document.location.hash = '/site/catalog' + data[16].join('/') + '/' + new_url(split_url($url))
                }

                document.title = data[16].join('-') + '-' + (data[10] + 1);
            } else {
                document.title = 'Поиск';
                if (history.pushState) {
                    history.pushState(null, null, '/site/catalog/поиск/' + new_url(split_url($url)))
                }
                else {
                    document.location.hash = '/site/catalog/поиск/' + new_url(split_url($url))
                }
            }
        }
    });

});

$('[data-cat]').on('click', function () {
    $('.link').attr('data', '');
    $('.link').removeClass('checked-cat');
    $(this).attr('data', 'checked');
    $(this).addClass('checked-cat');
    $(".size-checked").removeClass('size-checked');
    $(".page-checked").removeClass('page-checked');

});

$(document).on('keyup', '#search', function () {
    $('.result_search_word').show();
        $('.result_search_word').html('');
        $text = $('#search').val();
        $text = $text.split(' ');
        $count = $text.length;
        $text = $text[$count - 1];
        if ($text.length > 0) {
            $.ajax({
                url: '/site/searchword',
                data: {'filt': $text},
                async: true,
                success: function (data) {
                    $('.result_search_word').html('');
                    if (data != '') {
                        $data = data.split('/////');
                        $out = '';
                        $c = 0;
                        $innerhtml ='';
                        $('.result_search_word').html('');
                        $.each($data, function () {
                           if(this != '') {
                               $innerhtml += '<div data-raw="' + ($c++) + '" class="input_search_word" style="cursor:pointer;border-top: 1px solid rgb(0, 0, 0);padding: 4px 15px;">' + this + '</div>';
                           }});
                        $('.result_search_word').html($innerhtml);
                    }
                }
            });
        }
});
$(document).on('click', '.input_search_word', function () {
    $text = $('#search').val();
    $text = $text.split(' ');
    $count = $text.length;
    $text[$count - 1] = $(this).text();
    console.log($text);
    $('#search').val($text.join(' ', $text));
    $('.result_search_word').hide();
});
$(document).on('ready', function () {
    $amount_prod = 0;
    $cart_price = 0;
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        $.each($i, function () {
            $amount_prod = $amount_prod + parseInt(this[4]);
            $cart_price = $cart_price + (parseInt(this[3]) * parseInt(this[4]));
        });
    } else {
        $i = 0;
        $price_cart = '0 руб.'
    }
    $(".cart-count").html($amount_prod + ' шт');
    $(".cart-price").html($cart_price + ' руб.');
    $(function accord() {
        var Accordion = function (el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;
            var links = this.el.find('.link');
            links.on('click', {
                el: this.el,
                multiple: false
            }, this.dropdown)
        };
        Accordion.prototype.dropdown = function (e) {
            var linksclose = $('.open');
            $('.rotate-more-cat').removeClass('rotate-more-cat');
            $.each(linksclose, function () {
                $(this).removeClass('open');
                $(this).find('ul').hide().fadeOut();
            });
            var $el = e.data.el;
            $this = $(this);
            $next = $this.next();
            $next.slideToggle();
            $this.parents().show();
            $this.parents().filter('li').toggleClass('open');
            $(this).children('div').children('span').addClass('rotate-more-cat');
            if (!e.data.multiple) {
                $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
            }
        };
        var accordion = new Accordion($('#accordion'), false);
    });
    var HeaderTop = $('.navbar-header').offset().top;
    $(window).scroll(function () {
        if ($(window).scrollTop() > HeaderTop) {
            $('.navbar').addClass('fixedbar');
            $('.cart-dialog-info').addClass('fixeddialog');
        } else {
            $('.navbar').removeClass('fixedbar');
            $('.cart-dialog-info').removeClass('fixeddialog');
        }
    });
});

$(document).on('click', '#profile-info', function () {
    $('.bside').html('');
    $('.bside').html('<div id="card"><i class="fa fa-street-view"></i><div id="profile-lastname-info"></div><div id="profile-name-info"></div><div id="profile-secondname-info"></div></div> <div id="card"><i class="fa fa-envelope"></i> <i class="fa fa-phone"></i><div id="profile-telephone-info"></div><div id="profile-email-info"></div></div></div> ');
    $.post(
        "/site/requestadress",
        {ship: 'flat1_flat1'},
        onAjaxProfileSuccessinfo
    );
    function onAjaxProfileSuccessinfo(data) {
        if (data[1].name.Имя != undefined) {
            $('#profile-name-info').html(data[1].name.Имя);
            $('#profile-secondname-info').html(data[2].secondname.Отчество);
            $('#profile-lastname-info').html(data[3].lastname.Фамилия);
        } else {
            $('#profile-name-info').html('Нет данных');
        }
        $('#profile-telephone-info').html(data[9].telephone.Телефон);
        $.post(
            "/site/requestemail",
            onAjaxemailSuccessinfo
        );

    }
    function onAjaxemailSuccessinfo(data) {
        $('#profile-email-info').html(data);
    }
});

$(document).on('click', '.profile-orders', function () {
    $pagenav = 0;
    if ($('[data-page-nav]').length > 0) {
        $page = $('[data-page-nav]');
        $page = parseInt($page[0].getAttribute('data-page-nav'));
    } else {
        $page = 0;
    }
    if (this.getAttribute('class').indexOf('nav-next') != -1) {
        $page += 1;
    } else if (this.getAttribute('class').indexOf('nav-prev') != -1) {
        $page += -1;
    }
    $.ajax({
        url: "/site/requestorders/",
        data: 'cat=1&nav=' + $pagenav + '&page=' + $page,
        cache: false,
        async: true,
        success: function ($data) {
            $orders = $data.ordersatus;
            delete $data.ordersatus;
            $page = $data.page;
            delete $data.page;
            $('.bside').html('');
            $inner = '<div class="orders-row-profile"><div class="orders-num-header">№п/п</div><div class="orders-id-header">Идентификатор</div><div class="orders-name-header">Заказчик</div><div class="orders-data-header">Заказ</div><div class="order-adress-header">Адрес</div><div class="order-status-header">Статус</div></div>';
            $innercount = '';
            $statusarr = new Object();
            $statusarr[100] = 'Обработка заказа';
            $statusarr[1] = 'Обработка заказа';
            $statusarr[2] = 'Ждём оплаты';
            $statusarr[3] = 'Оплачен';
            $statusarr[4] = 'Оплачен - Доставляется';
            $statusarr[5] = 'Оплачен - Доставлен';
            $statusarr[6] = 'Отменён';
            $statusarr[11] = 'Сборка';
            $statusarr[0] = 'Спецпредложение';
            $.each($data, function () {
                $innerdata = '';
                $adress = '';
                $dataq = this.order;
                $dataadress = this.delivery;
                $dataordersnum = this.orders_id;
                if ($orders != undefined) {
                    $dataorderinfo = $orders[$dataordersnum];
                }
                if (this['orders_id'] == undefined) {
                    $status = '<div class="order-status"><div>Ожидание подтверждения администратором</div></div>';
                    if (this.order != undefined) {
                        $.each($dataq, function () {
                            $innerdata += '<div style="clear: both;" class="order-show"><div class="orders-prodimg" style="float: left;  max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px;  background: #fff no-repeat scroll 50% 50% / contain url(http://odezhda-master.ru/images/' + this[5] + ');"></div><div class="orders-prodid">' + this[0] + '</div><div class="orders-prodmodel">' + this[1] + '</div><div class="orders-prodsize">' + this[6] + '</div><div class="orders-prodcount">' + this[4] + '</div></div>';
                        });
                        $adress += '<div><div id="user-country"><b>Страна: </b>' + $dataadress['country'] + '</div><div id="user-state"><b>Область/регион: </b>' + $dataadress['state'] + '</div><div id="user-city"><b>Город: </b>' + $dataadress['city'] + '</div><div id="user-adress"><b>Адрес: </b>' + $dataadress['adress'] + '</div><div id="user-postcode"><b>Почтовый код: </b>' + $dataadress['postcode'] + '</div><div id="user-lastname"><b>Фамилия: </b>' + $dataadress['lastname'] + '</div><div id="user-name"><b>Имя: </b>' + $dataadress['name'] + '</div><div id="user-secondname"><b>Отчество: </b>' + $dataadress['secondname'] + '</div><div id="user-telephone"><b>Телефон: </b>' + $dataadress['telephone'] + '</div><div id="user-pasportser"><b>Серия паспорта: </b>' + $dataadress['pasportser'] + '</div><div id="user-pasportnum"><b>Номер паспорта: </b>' + $dataadress['pasportnum'] + '</div><div id="user-pasportwhere"><b>Кем выдан: </b>' + $dataadress['pasportwhere'] + '</div><div id="user-pasportdate"><b>Когда выдан: </b>' + $dataadress['pasportdate'] + '</div></div>';
                    } else {
                        $innerdata = 'Ошибка чтения из базы';
                    }
                }
                else if (this['orders_id'] > 0) {
                    $status = '<div class="order-status2">' + $statusarr[$dataorderinfo.orders_status] + '</div>';
                    $adress += '<div><div id="user-country"><b>Страна: </b>' + $dataadress['country'] + '</div><div id="user-state"><b>Область/регион: </b>' + $dataadress['state'] + '</div><div id="user-city"><b>Город: </b>' + $dataadress['city'] + '</div><div id="user-adress"><b>Адрес: </b>' + $dataadress['adress'] + '</div><div id="user-postcode"><b>Почтовый код: </b>' + $dataadress['postcode'] + '</div><div id="user-lastname"><b>Фамилия: </b>' + $dataadress['lastname'] + '</div><div id="user-name"><b>Имя: </b>' + $dataadress['name'] + '</div><div id="user-secondname"><b>Отчество: </b>' + $dataadress['secondname'] + '</div><div id="user-telephone"><b>Телефон: </b>' + $dataadress['telephone'] + '</div><div id="user-pasportser"><b>Серия паспорта: </b>' + $dataadress['pasportser'] + '</div><div id="user-pasportnum"><b>Номер паспорта: </b>' + $dataadress['pasportnum'] + '</div><div id="user-pasportwhere"><b>Кем выдан: </b>' + $dataadress['pasportwhere'] + '</div><div id="user-pasportdate"><b>Когда выдан: </b>' + $dataadress['pasportdate'] + '</div></div>';
                    $prod_content = '';
                    $resultprice = 0;
                    $resultcount = 0;
                    $resultcountpos = 0;
                    $oldresultprice = 0;
                    $oldresultcount = 0;
                    $oldresultcountpos = 0;
                    $.each($dataorderinfo.products, function (index) {
                        if (this.products_quantity == 0) {
                            $raw_style = 'style="background: rgb(255, 92, 92) none repeat scroll 0% 0%;"';
                            $prod_stat = 'Нет в наличии!';
                        } else if (this.products_quantity === this.first_quant) {
                            $raw_style = 'style="background: #45B74A  none repeat scroll 0% 0%;"';
                            $prod_stat = 'Количество соответствует';
                        } else {
                            $raw_style = 'style="background: #ECE37F none repeat scroll 0% 0%;"';
                            $prod_stat = 'Количество измененно';
                        }
                        $checkattr = this.orders_products_id;
                        $attr = '';
                        $.each($dataorderinfo.productsAttr, function () {
                            if (this.orders_products_id == $checkattr) {
                                $attr = this.products_options_values;
                            }
                        });
                        if ($attr != '') {
                            $prod_atr = $attr;
                        } else {
                            $prod_atr = 'Без размера';
                        }
                        $resultprice += (parseInt(this.products_quantity) * parseInt($dataorderinfo.products[index].products_price));
                        $oldresultprice += (parseInt(this.first_quant) * parseInt($dataorderinfo.products[index].products_price));
                        $resultcount += parseInt(this.products_quantity);
                        $oldresultcount += parseInt(this.first_quant);
                        $oldresultcountpos += 1;
                        if (parseInt(this.products_quantity) != 0) {
                            $resultcountpos += 1;
                        }
                        $prod_content += '<div class="row-prod"><div class="prod-content-raw" ' + $raw_style + '><div class="orders-prodimg" style="float: left;  max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px;  background: #fff no-repeat scroll 50% 50% / contain url(http://odezhda-master.ru/images/' + $dataq[index][5] + ');"></div><div>' + $prod_stat + '</div></div><div class="colone"><div class="prod-content-count">' + this.products_quantity + 'х' + this.products_name + '</div><div class="prod-content-attr">Размер: ' + $prod_atr + '</div></div><div  class="coltwo"><div class="prod-content-code">' + $dataorderinfo.products[index].products_model + '</div></div><div  class="colthree"><div class="prod-content-price">' + this.products_quantity + 'х' + parseInt($dataorderinfo.products[index].products_price) + ' Руб.</div></div><div class="prod-content-priceallraw">' + (parseInt(this.products_quantity) * parseInt($dataorderinfo.products[index].products_price)) + ' Руб.</div></div>';
                    });
                    $prod_content += '<div class="result-prod"><div class="old-prod-order"><div>Товаров в наличии: ' + $resultcount + ' позиций: ' + $resultcountpos + '</div><div><font color="red">Новая сумма товаров в заказе: ' + $resultprice + ' Руб.</font></div></div><div class="new-prod-order"><div>Товаров в заказе ' + $oldresultcount + ' позиций: ' + $oldresultcountpos + '</div><div>Сумма товаров в заказе: ' + $oldresultprice + ' Руб.</div></div></div>';
                    $innerdata += '<div class="order-om-wrap" style="height: 100%; width:100%"><div class="order-om-show">' + $dataorderinfo.orders_id + '</div><div class="order-om-adress">' + $dataorderinfo.delivery_country + ', ' + $dataorderinfo.delivery_state + ', ' + $dataorderinfo.delivery_city + ', ' + $dataorderinfo.delivery_street_address + ', ' + $dataorderinfo.delivery_postcode + '</div><div class="order-om-name">' + $dataorderinfo.delivery_lastname + ' ' + $dataorderinfo.delivery_name + ' ' + $dataorderinfo.delivery_otchestvo + '</div><div class="order-om-prod-container">' + $prod_content + '</div></div>';
                } else {
                    $status = '<div class="order-status3">Неопределен</div>';
                }
                //        $inner +='<div class="orders-row-profile"><div class="orders-num">'+($innercount++)+'</div><div class="orders-id">'+this['id']+'</div><div class="orders-name">'+this.delivery.lastname+' '+this.delivery.name+' '+this.delivery.secondname+'</div><div data-toggle="'+$innercount+'" class="orders-data-phantom"></div><div data-toggle="'+$innercount+'" class="orders-adress-phantom"></div>'+$status+'</div><div data-toggle="'+$innercount+'" class="orders-data modal"><div style="padding: 10px; overflow:auto; background: rgb(251, 251, 251) none repeat scroll 0% 0%; box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); height: 100%;"><div data-toggle="'+$innercount+'" id="close">x</div>'+$innerdata+'</div></div><div data-toggle="'+$innercount+'" class="order-adress modal"><div style="box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); background: rgb(251, 251, 251) none repeat scroll 0% 0%; border-radius: 3px; padding: 14px;"><div data-toggle="'+$innercount+'" id="close">x</div>'+$adress+'</div></div>';
                $inner += '<div class="orders-row-profile"><div class="orders-num">' + (($innercount++) + ($page * 10)) + '</div><div class="orders-id">' + this['id'] + '</div><div class="orders-name">' + this.delivery.lastname + ' ' + this.delivery.name + ' ' + this.delivery.secondname + '</div><div data-toggle="' + $innercount + '" class="orders-data-phantom"></div><div data-toggle="' + $innercount + '" class="orders-adress-phantom"></div>' + $status + '</div><div data-toggle="' + $innercount + '" class="orders-data modal"><div style="padding: 10px; overflow:auto; background: rgb(251, 251, 251) none repeat scroll 0% 0%; box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); height: 100%;"><div data-toggle="' + $innercount + '" id="close">x</div>' + $innerdata + '</div></div><div data-toggle="' + $innercount + '" class="order-adress modal"><div style="box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); background: rgb(251, 251, 251) none repeat scroll 0% 0%; border-radius: 3px; padding: 14px;"><div data-toggle="' + $innercount + '" id="close">x</div>' + $adress + '</div></div>';
            });
            $pager = '';
            $pager += ' <div data-page="" class="page profile-orders nav-prev btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="#"></a></i></div> ';
            $pager += ' <div data-page="" class="page  profile-orders nav-next  btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="#"></a></i></div> ';
            $('.bside').append('<div style="display:table; width:100%; margin-top: 6px;" data-page-nav="' + $page + '">' + $inner + $pager + '</div>');
        }
    });
});
$(document).on('click', '.orders-data-phantom', function () {
    $toggle = this.getAttribute('data-toggle');
    $('.orders-data[data-toggle=' + $toggle + ']').modal('toggle');
});
$(document).on('click', '.orders-adress-phantom', function () {
    $toggle = this.getAttribute('data-toggle');
    $('.order-adress[data-toggle=' + $toggle + ']').modal('toggle');
});
$(document).on('click', '#profile-call', function () {
    window.location = '/';
});
$(document).on('click', '#close', function () {
    $(this).parent().parent().modal('hide');
});
function onAjaxSuccessinfo(data) {
    $inner = '';
    data.splice(0, 1);
    $.each(data, function (index) {
        $tooltip = new Object();
        $tooltip['name'] = 'Допустимые символы а-я,a-z,-,пробел';
        $tooltip['secondname'] = 'Допустимые символы а-я,a-z,-,пробел';
        $tooltip['lastname'] = 'Допустимые символы а-я,a-z,-,пробел';
        $tooltip['country'] = 'Выберите из списка';
        $tooltip['state'] = 'Выберите из списка';
        $tooltip['city'] = 'Допустимые символы а-я,a-z,0-9,-,пробел';
        $tooltip['adress'] = 'Допустимые символы а-я,a-z,0-9,-,пробел,.,,';
        $tooltip['postcode'] = 'Допустимые символы 0-9, пробел';
        $tooltip['telephone'] = 'Допустимые символы 0-9,-,пробел,),(,+';
        $tooltip['pasportser'] = 'Допустимые символы 0-9, пробел';
        $tooltip['pasportnum'] = 'Допустимые символы 0-9, пробел';
        $tooltip['pasportdate'] = 'Введите в формате ГГГГ-ММ-ДД(2015-12-31)';
        $tooltip['pasportwhere'] = 'Допустимые символы а-я,a-z,0-9,-,пробел,.,,';
        $attr = Object.getOwnPropertyNames(this);
        $attrlableobj = Object.getOwnPropertyDescriptor(this, $attr).value;
        $attrlable = Object.getOwnPropertyNames($attrlableobj);
        $attrval = Object.getOwnPropertyDescriptor($attrlableobj, $attrlable).value;
        if ($attr == 'pasportdate' && $attrval == '0000-00-00') {
            $attrval = '';
        }
        if ($attrval != null && $attrval != '') {
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" data-name="' + $attr + '" class="info-item" data-name="' + $attr + '" value="' + $attrval + '"></input></div>';
        } else {
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" class="info-item" data-name="' + $attr + '" placeholder="' + $attrlable + '"></input></div>';
        }
    });
    $('.userinfo').html('');
    $('.userinfo').html($inner + '<button class="save-order2 btn btn-sm btn-info" style="bottom: 0px; position: relative; float: right;">Подтвердить заказ</button>');
    $('.ui-dialog-titlebar').hide();
    $.ajax({
        type: "GET",
        url: "/site/countryrequest",
        data: '',
        dataType: "json",
        success: function (out) {
            $inner = '';
            $.each(
                out.response.items, function () {
                    $inner += '<li data-country="' + this.id + '" id="country">' + this.title + '</li>';
                });
            $('[data-name=country]').after('<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">' + $inner + '</ul>');
            $('[data-name=country]').attr('autocomplete', 'off');
        }
    });
    var str = '';
    if ($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined) {
        str = $('[data-name="country"]').val();
    } else {
        str = $('[data-name="country"]').text();
    }
    $country = $("[data-country]");
    $check = '';
    $.each($country, function () {
        if (str == $(this).html()) {
            $check = this.getAttribute('data-country');
        }
    });
    $.ajax({
        type: "GET",
        url: "/site/zonesrequest",
        data: 'id=' + $check,
        dataType: "json",
        success: function (out2) {
            $inner = '';
            $.each(out2.response.items, function () {
                $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
            });
            $('#state-drop').remove();
            $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
            $('[data-name=state]').attr('autocomplete', 'off');
        }
    });
    $(document).on('click focus', '[data-name=country]', function () {
        $('#country-drop').show();
    });
    $(document).on('click', '#country', function () {
        $('[data-name=country]').val($(this).text());
        $('[data-name=country]').attr('data-country', this.getAttribute('country'));
        $('#country-drop').hide();
        $.ajax({
            type: "GET",
            url: "/site/zonesrequest",
            data: 'id=' + this.getAttribute('data-country'),
            dataType: "json",
            success: function (out2) {
                $inner = '';
                $.each(out2.response.items, function () {
                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                });
                $('#state-drop').remove();
                $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                $('[data-name=state]').attr('autocomplete', 'off');
            }
        });
    });
    $(document).on('click focus', '[data-name=state]', function () {
        $('#state-drop').show();
    });
    $(document).on('click', '#state', function () {
        $('[data-name=state]').attr('data-state', this.getAttribute('state'));
        $('[data-name=state]').val($(this).text());
        $('#state-drop').hide();
    });
    $(document).on('keyup', '[data-name=country]', function () {
        $filtCountryArr = $(this).siblings('ul').children();
        $search = this.value;
        $.each($filtCountryArr, function () {
            if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    $(document).on('keyup', '[data-name=state]', function () {
        $filtCountryArr = $(this).siblings('ul').children();
        $search = this.value;
        $.each($filtCountryArr, function () {
            if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
}