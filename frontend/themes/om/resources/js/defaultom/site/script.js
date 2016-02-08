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
$(document).on('click', '#prod-info', function () {
    $.post(
        "/site/product",
        {id: this.getAttribute('data-prod')},
        onAjaxSuccess
    );
    function onAjaxSuccess(proddata) {
        $product = proddata;
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
                $prodinfoattr += '<div class="size-desc"><div id="input-count" data-prod="' + $product.products.products_id + '" data-model="' + $product.products.products_model + '" data-minorder="' + $product.products.products_quantity_order_min + '" data-price="' + $product.products.products_price + '" data-image="' + $product.products.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '">' + this.products_options_values_name + '</div></div>';
            });
            $prodinfoattr += '<div class="cart-lable">В корзину</div>';
        } else {
            $date = $product.products.products_date_added;
            $prodinfoattr += '<div class="size-desc"><div id="input-count" data-prod="' + $product.products.products_id + '" data-model="' + $product.products.products_model + '" data-minorder="' + $product.products.products_quantity_order_min + '" data-price="' + $product.products.products_price + '" data-image="' + $product.products.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '">+</div></div>';
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
    $.post(
        "/site/shipping",
        function (shipdata) {
                $inht = '';
                console.log(shipdata);
                $.each(shipdata, function (index) {
                    if (this.active == '1') {
                        $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
                    }
                });
            $('.ui-dialog-content').html('<div class="shipping">Cпособ доставки <select  id="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
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
                        $('.ui-dialog-content').append('<div class="shipping">Cпособ оплаты <select  id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select></div><div class="userinfo"></div>');
                    } else {
                        $('.ui-dialog-content').append('<div class="userinfo"></div>');

                    }
                    $("#modal-cart").dialog({
                        position: {my: "center top", at: "top", of: window},
                        modal: true,
                        dialogClass: "cart-dialog",
                        closeText: "X",
                        width: window.screen.width / 100 * 80,
                        title: "Ваша корзина",
                        resizable: false
                        // dialogClass: 'max-cart cart',

                    });
                }
            );
        }
    );

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
        if ($('#paymentmethod option:selected')[0]) {
            $paymentmethod = $('#paymentmethod option:selected')[0].value;
        } else {
            $paymentmethod = '';
        }
        $.post(
            "/site/saveorder",
            {
                order: $item.cart,
                ship: $('#shipping-confirm option:selected')[0].value,
                paymentmethod: $paymentmethod,
                user: $userdataarr
            },
            onAjaxSuccesssaveorder
        );
    }
    function onAjaxSuccesssaveorder(data) {

        if (data.exception) {
            $('#modal-cart').dialog('close');
            $('.footer').append('<div class="alert-danger alert fade in" style="position: fixed; bottom: 0px; right: 0px; margin: 0px; z-index: 99999; width: 100%; text-align: center; background: rgb(255, 191, 8) none repeat scroll 0% 0%; color: black;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + data.exception + '</div>').show();
        } else if (data != 0) {
            localStorage.removeItem('cart-om');
            $(".cart-count").html('0');
            $(".cart-price").html('0');
            $('#modal-cart').html('<div style="padding: 10px; text-align: center; height: 100%; line-height: 40px;"><div>Ваш заказ № ' + data.id + ' ожидает подтверждения менеджером магазина.</div><div> Статус  заказа вы можете проверить в вашем личном кабинете. </div><div class="btn btn-info btn-end-order" style="background: rgb(0, 255, 204) none repeat scroll 0% 0%; color: rgb(68, 68, 68);">Продолжить покупки</div></div>');
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
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row"><div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div><div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount">' + this[4] + ' шт.</div></div>';
        });
        $('#modal-cart').html($innerhtml);
    } else {
        $('#modal-cart').html('<div style="text-align: center; padding: calc(100% / 4);">Пусто</div>');
        $('.ui-dialog-titlebar').show();
    }
    $("#modal-cart").dialog({
        position: {my: "center top", at: "top", of: window},
        modal: true,
        dialogClass: "cart-dialog",
        closeText: "X",
        width: window.screen.width / 100 * 80,
        title: "Ваша корзина",
        resizable: false
        // dialogClass: 'max-cart cart',

    });
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        if (document.location.hash == '') {
            $urlhash = '#';
        } else {
            $urlhash = document.location.hash;
        }
        if ($('[data-method="post"]').attr('href') == '/site/lk' && $i.length > 0) {
            $(".ui-dialog").append('<span class="cart-auth"><a class="save-order" href="' + $urlhash + '">Оформить заказ</a></span>');
        } else if ($i.length > 0) {
            $(".ui-dialog").append('.<span class="cart-auth"><a class="auth-order" href="/site/login">Купить</a></span>');
        }
        $('.ui-dialog-titlebar').show();
    }
});
$(document).on('click', '.cart-lable', function () {
    $cart_add_obj = $('[class="lable-item accept"]');
    console.log($('[class="lable-item accept"]'));
    $checkzero = 0;
    $.each($cart_add_obj, function () {
        var $item = new Object();
        $item_add = $(this)[0];
        $item.cart = [];
        $item_add.value = 1;
            $checkzero = 1;
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
                        this[4] = 1; //parseInt(this[4]) + parseInt($item_add.value);
                        x = 1;
                    }
                });
            } else {
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
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), 1/*$item_add.value*/, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name')];
            }
            if (x == 0) {
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
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), 1/*$item_add.value*/, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name')];
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
    });
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

$(document).on('click keydown', '.lock-on', function () {
    $('body').addClass('some');
    $('link').addClass('some');
    $('html').prepend('<div class="preload"><div id="loaderImage"></div></div>');
    new imageLoader(cImageSrc, 'startAnimation()');
});

$(document).ready(function () {

});

$(document).on('click', '#catalog-mode', function () {

    if ($('#partners-main-left-back').attr('style') != 'display: none;') {
        $('#partners-main-left-back').attr('style', 'display: none;');
        $('#partners-main-right-back').attr('style', 'width: 100%;margin-left: 0;');
        $('#partners-main-right-back').prepend('<div id="catalog-mode" class="" style="float: right; position: fixed; z-index: 99; font-size: 11px; line-height: 1.1; width: 24px; height: 24px; text-align: center; border: 1px solid rgb(204, 204, 204); background: rgb(204, 204, 204) none repeat scroll 0% 0%; color: rgb(255, 255, 255);"> <i class="fa fa-2x fa-angle-right"></i></div>');


    } else {
        $('#catalog-mode-back').remove();
        $('#partners-main-left-back').attr('style', 'display: block;');
        $('#partners-main-right-back').attr('style', 'width: 83.5%%;');
        $('#stcat').remove();
    }

});
var inProgress = false;

$(document).on('click', '#down', function () {
    var curPos = $(document).scrollTop();
    var height = $(window).scrollTop() + $(window).height();
    var scrollTime = (height - curPos) / 1.73;
    // var scrollTime = height / 1.73;
    $("body,html").animate({"scrollTop": height}, scrollTime);
});
$(document).on('click', '#up', function () {
    var curPos = $(document).scrollTop();
    // var scrollTime=curPos/1.73;
    var scrollTime = curPos / 3.73;
    $("body,html").animate({"scrollTop": 0}, scrollTime);
});


$(document).on('ready', function () {
    $(document).on('click', '.loader', function () {
   // $(window).scroll(function () {
        if (!inProgress) {
       // if ($(window).scrollTop() + $(window).height() >= $(document).height() - 800 && !inProgress) {


            $searchword = '';

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
            if (typeof $page == 'undefined') {
                $page = 0;
            }
            $page = parseInt($page) + 1;
            $prodatrquery = $check.join(',');
            if ($count == '') {
                $count = 20;
            }

            if (typeof $cat == 'undefined') {
                $urld = '';
                $urld = document.location.toString();
                console.log($urld);
                $urld = '?' + $urld.split('?')[1];
                $urld = split_url($urld);
                $cat = $urld['?cat'][1];
                $searchword = $urld['searchword'][1];

            }
            $url = '?cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword;
            $url_data = $urld;
            $.ajax({
                url: "/site/request",
                data: 'cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword + '&json=1',
                cache: false,
                async: true,
                dataType: 'json',
                beforeSend: function () {
                    inProgress = true;
                }
            }).done(function (data) {
                $('body').removeClass('some');
                $('link').removeClass('some');
                $('.preload').remove();
                $loader = $('.loader').html();
                $('.loader').remove();
                if (data[0] != 'Не найдено!') {
                    $('.headerbside').html('');
                    $('.filters').html('');
                    $('.cat-nav').html('');
                    $('#products-pager-down').remove();
                    $('#size-slide').html("");
                    $('#filters').html(' <div id="price-lable">Цена</div>От <input id="min-price" value="0" class="btn" /> До<input id="max-price" class="btn" /> Руб.<div class="price-slide"><div class="slider"></div> </div><div id="size-slide"></div><div type="button" id="filter-button"></div> ');
                    $headbside = '';
                    $headbside += '<div id="products-counter">' + data[4] + '-' + data[5] + ' из ' + data[1] + '</div>';
                    $headbside += '<div id="products-pager"></div>';
                    $headbside += '<div id="count-display"> | Показывать по<div class="count"> <a class="countdisplay" onclick=""  data-count="20"  href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '20')) + '">20</a></div><div class="count"> <a  class="countdisplay" onclick="" data-count="40" href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '40')) + '">40</a></div> </div> <div class="count"> <a class="countdisplay" onclick=""  data-count="60" href="/site/catalog' + new_url(new_suburl(split_url($url), 'count', '60')) + '">60</a>  </div>';
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
                            $headbside += '<div class="header-sort-item-active"><a class="sort" href="/site/catalog' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '" data="' + $dataord + '" href="#">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                        } else {
                            $headbside += '<div class="header-sort-item"><a class="sort" data="' + $dataord + '" href="/site/catalog' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                        }
                    });
                    $('.headerbside').prepend($headbside);
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
                        $('#size-slide').append('<div id="size-lable"><input id="class-size-filter" style="width:100%;  height: 20px;border: none;background: none;text-align: center;" placeholder="начните вводить интересующий размер"/></div>');
                    }
                    $.each(data[3], function () {
                        $attrproducts = this.products_options_values_name;
                        $attrproductsid = this.products_options_values_id;
                        if ($attrproducts != null && data[3].length <= 30) {
                            $('#size-slide').append('<div data-size="' + $attrproductsid + '" class="size">' + $attrproducts + '</div>');
                        } else if ($attrproducts != null && data[3].length > 30) {
                            $('#size-slide').append('<div data-size="' + $attrproductsid + '" class="size" style="display:none;" data-toggle="tooltip" data-placement="top" title="' + $attrproducts + '"><i class="fa fa-check"></i><div style="overflow: hidden; height: 100%; width: 100%; padding: 3% 10%;">' + $attrproducts + '</div></div>');
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
                    $('#filter-button').html('<div style="clear: both;padding: 10px 20px;"><div class="btn btn-info btn-sm addfilter" style="float: left">Применить</div><div class="btn btn-danger btn-sm reset" style="float: right">Сбросить</div></div>');
                    $.each(data[0], function () {
                        $product = this.products;
                        $description = this.productsDescription;
                        $attr_desc = this.productsAttributesDescr;
                        $attr_html = '<div class="cart-lable">В корзину</div>';
                        if ($attr_desc.length > 0) {
                            $.each($attr_desc, function () {
                                $attr_html += '<div class="size-desc"> <div><div class="lable-item" id="input-count" data-prod="' + $product.products_id + '" data-model="' + $product.products_model + '" data-price="' + $product.products_price + '" data-image="' + $product.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" data-name="' + $description.products_name + '">' + this.products_options_values_name + '</div></div></div>';
                            });
                        } else {
                            $attr_html += '<div class="size-desc"><div class="lable-item"  id="input-count" data-prod="' + $product.products_id + '" data-model="' + $product.products_model + '" data-price="' + $product.products_price + '" data-image="' + $product.products_image + '" data-attrname="' + this.products_options_values_name + '" data-attr="' + this.products_options_values_id + '" data-name="' + $description.products_name + '">+</div></div>';
                        }
                        $('.bside').append('<div  class="container-fluid float" id="card"><div data-prod="' + $product.products_id + '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');"></div><div class="name">' + $description.products_name + '</div><div class="model">Арт.' + $product.products_model + '</div><div class="price"><b>' + parseInt($product.products_price) + '</b> руб.</div><a href="/site/product?id=' + $product.products_id + '"><div id="prod-info" data-prod="' + $product.products_id + '">Инфо</div></a><span>' + $attr_html + '</span><span style="bottom: 45px; width: 30px; height: 30px; top: 0px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">'
                            + '<a href="http://vk.com/share.php?url=http://' + location.host + '/site/product?id=' + $product.products_id + '&description=' + parseInt($product.products_price) + '%20Руб.&title=' + $description.products_description + '"><i class="fa fa-vk"></i></a></span><span style="bottom: 45px; width: 30px; height: 30px; top: 35px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">' +
                            '' + '<a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=' + encodeURIComponent('http://' + location.host + '/site/product?id=' + $product.products_id) + '&st.comments=' + encodeURIComponent($description.products_description) + '"><i class="fa fa-odnoklassniki"></i></a></span><span style="bottom: 45px; width: 30px; height: 30px; top: 70px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">' +
                            '' + '<a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://' + location.host + '/site/product?id=' + $product.products_id + '&p[summary]=' + parseInt($product.products_price) + '%20Руб.&p[title]=' + $description.products_description + '"><i class="fa fa-facebook"></i></a></span><span style="bottom: 45px; width: 30px; height: 30px; top: 105px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">' +
                            '' + '<a href="http://twitter.com/share?url=http://' + location.host + '/site/product?id=' + $product.products_id + '&title=' + $description.products_description + '"><i class="fa fa-twitter"></i></a></span><span style="bottom: 45px; width: 30px; height: 30px; top: 140px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">' +
                            '' + '<a href="http://connect.mail.ru/share?url=http://' + location.host + '/site/product?id=' + $product.products_id + '&description=' + parseInt($product.products_price) + '%20Руб.&title=' + $description.products_description + '"><i class="fa fa-at"></i></a></span>' +
                            '' + '<span style="bottom: 45px; width: 30px; height: 30px; top: 140px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">' +
                            '' + '<a href="https://plus.google.com/share?url=http://' + location.host + '/site/product?id=' + $product.products_id + '"><i class="fa fa-google-plus"></i></a></span>' +
                            '' + '</div>');
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
                        $pager += ' <a data-page="' + parseInt(data[10]) + '" class="page" href="#">' + (parseInt(data[10]) + 1) + '</a> ';
                        $pager += 'из ' + $countpager;
                        $pager += ' <a data-page="' + ($natpage - 1) + '" class="fa fa-chevron-left page  btn btn-default btn-sm lock-on" href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) + '"></a> ';
                        $pager += ' <a data-page="' + ($nextpage + 1) + '" class="fa fa-chevron-right page  btn btn-default btn-sm lock-on" href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) + '"></a> ';
                        $('#products-pager').html('');
                        $('#products-pager').html('Страница: ' + $pager);
                        $('.bside').append('<div class="loader col-md-12">'+$loader+'</div><div id="products-pager-down">Страница: ' + $pager + '</div>');
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
                    inProgress = false;
                } else {
                    $('#size-slide').html('');
                    $('#filter-button').html('');
                    $('body').removeClass('some');
                    $('link').removeClass('some');
                    $('.preload').remove();
                }
                $("[data-cat=" + data[12] + "]").attr('data', 'checked');
                //  document.title = $title.join('-') + ', Страница - ' + (data[10] + 1);


            });

        }
    });
});

$('[data-cat]').on('click', function () {
    $('.link').attr('data', '');
    $('.link').removeClass('checked-cat');
    $(this).attr('data', 'checked');
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
                    $innerhtml = '';
                    $('.result_search_word').html('');
                    $.each($data, function () {
                        if (this != '') {
                            $innerhtml += '<div data-raw="' + ($c++) + '" class="input_search_word" style="cursor:pointer;border-top: 1px solid rgb(0, 0, 0);padding: 4px 15px;">' + this + '</div>';
                        }
                    });
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


$(document).on('click', '#profile-call', function () {
    window.location = '/';
});

$(document).on('click', '.lable-item', function () {
    if ($(this).hasClass('accept')) {
        $(this).removeClass('accept');
    } else {
        $(this).addClass('accept');
    }
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
    $('.userinfo').html($inner + '<div>Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных.</div><button class="save-order2 btn btn-sm btn-info" style="bottom: 0px; position: relative; float: right;">Подтвердить заказ</button>');
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

$('[id^=carousel-selector-]').click( function(){
    var id_selector = $(this).attr("id");
    var id = id_selector.substr(id_selector.length -1);
    id = parseInt(id);
    $('#slid').carousel(id);
    $('[id^=carousel-selector-]').removeClass('selected');
    $(this).addClass('selected');
});

$(document).on('click','#prdesc',function() {
        if($('#prd').is(':not(:visible)')) {
            jQuery('#prd').attr('style', 'display:block');
        }
        else{
            jQuery('#prd').attr('style','display:none');
        }});