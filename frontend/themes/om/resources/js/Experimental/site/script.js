var HeaderTop = $('.header-container').offset().top;
$(window).scroll(function () {
    if ($(window).scrollTop() > HeaderTop) {
        $('.header-container').addClass('smaller');
    } else {
        $('.header-container').removeClass('smaller');
    }
});

$(function() {
    jQuery('.usericon').click(function() {
        if($('.header-left-link').is(':visible')) {
            jQuery('.header-left-link').attr('style', 'display:none');
        }
        else{
            jQuery('.header-left-link').attr('style','display:block');
        }

    });
});
$(function() {
    jQuery('.cart-lable').click(function() {
        if($('.item-s').is(':visible')) {
            jQuery('.item-s').attr('style', 'display:none');
        }
        else{
            jQuery('.item-s').attr('style','display:block');
        }

    });
});
$(document).on('click', '.lable-item', function () {
    $cart_add_obj = $(this);
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
                    'background':'black',
                    'z-index': '11100',
                    'display':'block',
                    top: $(this).parent().parent().offset()['top'],
                    left: $(this).parent().parent().offset()['left']
                })
                .appendTo("body")
                .animate({
                    opacity: 1,
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
    });
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
            $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row"><div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div><div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount"><div id="del-count" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-id="'+$c+'">-</div><input id="input-c"  data-id="'+$c+'" value="' + this[4] + '"><div id="add-count"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'"  data-id="'+$c+'">+</div><div style="float: left"> шт.</div></div></div>';
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
        width: window.screen.width / 100 * 40,
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

$(document).on('ready', function () {

    $amount_prod = 0;
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        $.each($i, function () {
            $amount_prod = $amount_prod + parseInt(this[4]);
        });
    } else {
        $i = 0;
    }
    $(".cart-count").html($amount_prod);
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
        $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row">' +
            '<div class="cart-image" style="float: left; #D2672D inset; max-height: 100px; max-width: 200px; min-height: 100px; min-width: 200px;  background: #fff no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + this[5] + ');"></div>' +
            '<div class="cart-model">Арт.: ' + this[1] + '</div><div class="del-product">Удалить</div><div data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div><div class="cart-prod-price">' + parseInt(this[3]) + 'руб.</div><div class="cart-amount">' + this[4] + ' шт.</div></div>';
    });
    $(".cart-count").html($amount_prod);
    $(".cart-price").html($cart_price + ' руб.');
    $('#modal-cart').html($innerhtml);

    if ($array_splice.length == 0) {
        $("#modal-cart").dialog('close');
    }
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
            $('#modal-cart').html('<div style="padding: 10px; text-align: center; height: 100%; line-height: 40px;">' +
                '<div>Ваш заказ № ' + data.id + ' ожидает подтверждения менеджером магазина.</div>' +
                '<div> Статус  заказа вы можете проверить в вашем личном кабинете. </div>' +
                '<div class="btn btn-info btn-end-order">Продолжить покупки</div></div>');
        }
    }
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

$(document).on('click', '#add-count, #del-count', function () {
    $did=this.getAttribute('data-id');
    console.log($did);
    console.log($('[class="lable-item accept"]'));
    $checkzero = 0;
        var $item = new Object();
        $item_add = this;
        console.log($item_add);
        $item.cart = [];
        $item_add.value = $('#input-c[data-id="'+$did+'"]').val();
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
                    this[4] = parseInt($item_add.value);
                    x = 1;
                }
            });
        } else {
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
});