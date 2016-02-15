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
        "/site/productinfo",
        {id: this.getAttribute('data-prod')},
        onAjaxSuccessProdInfo
    );
    function onAjaxSuccessProdInfo(proddata) {
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
// deprecated
// $(document).on('click', '.save-order', function () {
//     $.post(
//         "/site/shipping",
//         function (shipdata) {
//                 $inht = '';
//                 console.log(shipdata);
//                 $.each(shipdata, function (index) {
//                     if (this.active == '1') {
//                         $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
//                     }
//                 });
//             $('.ui-dialog-content').html('<div class="shipping">Cпособ доставки <select  id="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
//             $('.cart-auth').remove();
//             $.post(
//                 "/site/paymentmethod",
//                 function (data) {
//                     if (data != 'false') {
//                         $inht = '';
//                         $.each(data, function (index) {
//                             if (this.active == '1') {
//                                 $inht += '<option class="shipping-confirm-option" value="' + this.name + '">' + this.name + '</option>';
//                             }
//                         });
//                         $('.ui-dialog-content').append('<div class="shipping">Cпособ оплаты <select  id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select></div><div class="userinfo"></div>');
//                     } else {
//                         $('.ui-dialog-content').append('<div class="userinfo"></div>');
//
//                     }
//                     $("#modal-cart").dialog({
//                         position: {my: "center top", at: "top", of: window},
//                         modal: true,
//                         dialogClass: "cart-dialog",
//                         closeText: "X",
//                         width: window.screen.width / 100 * 80,
//                         title: "Ваша корзина",
//                         resizable: false
//                         // dialogClass: 'max-cart cart',
//
//                     });
//                 }
//             );
//         }
//     );
//
// });

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
    $delrow = $(this).parent().parent().attr('data-raw');
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
    $innerhtml+='<span class="cart-auth" style="display: block; overflow: hidden;"><a class="save-order" style="display: block;position: relative" href="<?=BASEURL;?>/cart?action=1">Оформить заказ</a></span>';
    $(".cart-count").html($amount_prod);
    $(".cart-price").html($cart_price + ' руб.');
    $('.bside').html($innerhtml);
});
// deprecated
// $(document).on('click', '.cart', function () {
//     //var curPos = $(document).scrollTop();
//     //var scrollTime = curPos / 3.73;
//     //$("body,html").animate({"scrollTop": 0}, scrollTime);
//     $amount_prod = 0;
//     $cart_price = 0;
//     $innerhtml = '';
//     if (JSON.parse(localStorage.getItem('cart-om'))) {
//         $item = JSON.parse(localStorage.getItem('cart-om'));
//         $i = $item.cart;
//         $c = 0;
//         $('#modal-cart').html('');
//         $.each($i, function () {
//             if (this[6] == 'undefined') {
//                 this[6] = 'Без размера'
//             } else {
//                 this[6] = this[6] + ' размер';
//             }
//             $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row"><div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div><div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount">' + this[4] + ' шт.</div></div>';
//         });
//         $('#modal-cart').html($innerhtml);
//     } else {
//         $('#modal-cart').html('<div style="text-align: center; padding: calc(100% / 4);">Пусто</div>');
//         $('.ui-dialog-titlebar').show();
//     }
//     $("#modal-cart").dialog({
//         position: {my: "center top", at: "top", of: window},
//         modal: true,
//         dialogClass: "cart-dialog",
//         closeText: "X",
//         width: window.screen.width / 100 * 80,
//         title: "Ваша корзина",
//         resizable: false
//         // dialogClass: 'max-cart cart',
//
//     });
//     if (JSON.parse(localStorage.getItem('cart-om'))) {
//         if (document.location.hash == '') {
//             $urlhash = '#';
//         } else {
//             $urlhash = document.location.hash;
//         }
//         if ($('[data-method="post"]').attr('href') == '/site/lk' && $i.length > 0) {
//             $(".ui-dialog").append('<span class="cart-auth"><a class="save-order" href="' + $urlhash + '">Оформить заказ</a></span>');
//         } else if ($i.length > 0) {
//             $(".ui-dialog").append('.<span class="cart-auth"><a class="auth-order" href="/site/login">Купить</a></span>');
//         }
//         $('.ui-dialog-titlebar').show();
//     }
// });
$(document).on('click', '.cart-lable', function () {
   $id_product =  this.getAttribute('data-sale');
    $cart_add_obj = $('[data-prod='+$id_product+']').filter('input');
    $checkzero = 0;
    $.each($cart_add_obj, function () {
        var $item = new Object();
        $item_add = $(this)[0];
        $item.cart = [];
        $item_add.value = $(this).val();
        if($item_add.value > 0) {
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
                        this[4] = parseInt(this[4]) + parseInt($item_add.value);
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
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name')];
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
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name')];
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
        } });
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
            $page = parseInt($('.pagination-catalog').find('.pagination').find('.active').find('a').attr('data-page'));

            if (typeof $page == 'undefined') {
                $page = 0;
            }
            $page = parseInt($page) + 2;

            $prodatrquery = $check.join(',');
            if ($count == '') {
                $count = 20;
            }

            if (typeof $cat == 'undefined') {
                $urld = '';
                $urld = document.location.toString();
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
                $('.pagination-catalog').remove();
                $('.loader').remove();
                if (data[0] != 'Не найдено!') {
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


                        $('.bside').append('<div class="container-fluid float" id="card">'+
                                    '<a href="/glavnaya/product?id=' + $product.products_id+ '">'+
                                        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/glavnaya/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');">'+
                                        '</div>'+
                                        '<div  class="name">' + $description.products_name  +'</div>'+
                                    '</a>'+
                                    '<div  class="price">'+
                                        '<div style="font-size: 18px; font-weight: 500;">'+
                                           parseInt($product.products_price) + ' Руб.'+
                                        '</div>'+
                                    '</div>'+
                                    '<div style="cursor:pointer">'+
                                        '<div data-vis="size-item-desc" data-vis-id="'+$product.products_id+'" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; margin: 0px 0px -30px; padding: 30px 26px;" data-prod="'+$product.products_id+'">'+
                                            'Размеры'+
                                            '<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: 0px; padding: 30px 0px 0px 31px;">'+
                                            '</i>'+
                                            '<span data-vis="size-item-card" data-vis-id-card="'+$product.products_id+'">'+
                                                '<div data-sale="'+$product.products_id+'" class="cart-lable">'+
                                                    'В корзину'+
                                                '</div>'+
                                                '<div class="" style="width: 50%; overflow: hidden; float: left; sort ;">'+
                                                    '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">'+
                                                        '<div style="margin: auto; width: 100%;">'+
                                                            '<div>'+
                                                            '</div>'+
                                                            '<input id="input-count" style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;" data-prod="'+$product.products_id+'" data-name="Платок головной ситец ГОСТ (кружево)" data-model="959841121" data-price="54" data-image="catalog_4/54fad0b729674.jpg" data-attrname="" data-attr="" placeholder="0" type="text">'+
                                                            '<div id="add-count" style="margin: 0px;line-height: 1.6;">'+
                                                            '        +'+
                                                            '</div>'+
                                                            '<div id="del-count" style="margin: 0px;line-height: 1.6;">'+
                                                            '        -'+
                                                            '</div>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+
                                    '<a href="/glavnaya/product?id='+$product.products_id+'">'+
                                        '<div itemprop="" style="font-size: 12px;" id="prod-info" data-prod="'+$product.products_id+'">'+
                                            '<i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;">'+
                                            '</i>'+
                                            'Увеличить'+
                                        '</div>'+
                                    '</a>'+
                                '</div></div>');
                    });
                    $pageSize = $count;
                    $totalCount = parseInt(data[1]);
                    $pageCount = parseInt((parseInt($totalCount) + parseInt($pageSize) - 1) / parseInt($pageSize));


                        $maxButtonCount = 5;
                        $currentPage = parseInt($page);

                            //$beginPage = $currentPage - parseInt($maxButtonCount / 2);
                            //$endPage = $pageCount - 1;
                            //$beginPage = $endPage - $maxButtonCount + 1;
                            //$endPage = $beginPage + $maxButtonCount;

                    $pager = 'nn';

                    $beginPage = Math.max(0, $currentPage -  parseInt(($maxButtonCount / 2)));
                    if (($endPage = $beginPage + $maxButtonCount) >= $pageCount) {
                        $endPage = $pageCount - 1;
                        $beginPage = Math.max(0, $endPage - $maxButtonCount + 1);
                    }

                        if (($pageprev = $currentPage - 1) < 0) {
                            $pageprev = 0;
                        }
                    $pager += '<li class="prev"><a href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($pageprev)))+'"  data-page="'+$pageprev+'"><<</a></li>';




                        if (($pagenext = $currentPage + 1) >= $pageCount - 1) {
                            $pagenext = $pageCount - 1;
                        }


                    $pagerbeginend = [$beginPage, $endPage];

                    for($beginPage; $beginPage < $endPage; $beginPage++){
                        if($beginPage == $currentPage-1){
                            $class='class="active"';
                        }else{
                            $class='';
                        }
                         $pager += '<li '+$class+'><a href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($beginPage)))+'"  data-page="'+($beginPage-1)+'">'+($beginPage+1)+'</a></li>';
                    }

                    $pager += '<li class="next"><a href="/site/catalog' + new_url(new_suburl(split_url($url), 'page', ($pagenext)))+'" data-page="'+$pagenext+'">>></a></li>';





                    $('.bside').append('<div class="loader col-md-12">'+$loader+'</div><div class="pagination-catalog" style="float: right; margin: auto; text-align: center; width: 100%;" ><ul class="pagination">'+$pager+'</ul></div>');
                    inProgress = false;
                } else {
                    $('#size-slide').html('');
                    $('#filter-button').html('');
                    $('body').removeClass('some');
                    $('link').removeClass('some');
                    $('.preload').remove();
                }
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
    $(".cart-count").html($amount_prod);
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
$(document).on('click','.cart-lable',function () {

})