function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}
(function($){
    $.getQuery = function (name, url) {
        var rQuery = new RegExp(name + '=([^&#]*)(&|#|$)', 'g'),
            url = url && url.split ? url.split('?')[1] : window.location.search,
            ret = url && url.match(rQuery);
        $.each(ret, function (index, value) {
            ret[index] = this.split('=')[1].replace('&', '');
        });
        return ret && name ? ret : null;
    }
})(jQuery);

$('.search-button-toggle').tooltip();
/*
 Переключение Глобальный поиск <-> Поиск по категории
 */
$('.search-button-toggle').on('click',function(){
    var parentForm = $(this).parents('form'),
        siblingButton = $(this).siblings('.search-button-toggle');

    if(siblingButton.length) {
        siblingButton.toggleClass('hide');
        $(this).toggleClass('hide');

        if($(this).data('category') == undefined){
            var category = siblingButton.data('category');
            parentForm.attr('action','/'+category);
        } else {
            parentForm.attr('action','/catalog/');
        }
    }
});

$(document).on('click', '.size', function () {
    $('.size-checked').removeClass('size-checked');
    $check = [];
    $(this).addClass('size-checked');
});
$(document).on('click', '.alarge', function () {
    if($('.partners-main-left-back').hasClass('absolute-catalog')){
        $('.partners-main-left-back').removeClass('absolute-catalog');
        $('.partners-main-left').removeClass('absolute-catalog');
        $('.partners-main-left-back').hide();
    }else {
        $('.partners-main-left-back').addClass('absolute-catalog');
        $('.partners-main-left').addClass('absolute-catalog');
        $('.partners-main-left-back').show();
    }
});
$(document).on('click', '.alk', function () {
    if($('.partners-main-left-back').hasClass('absolute-lk')){
        $('.partners-main-left-back').removeClass('absolute-lk');
        $('.partners-main-left-cont').removeClass('absolute-lk');
        $('.partners-main-left-back').hide();
    }else {
        $('.partners-main-left-back').addClass('absolute-lk');
        $('.partners-main-left-cont').addClass('absolute-lk');
        $('.partners-main-left-back').show();
    }
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
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
};

$(document).on('click', '.cart-image', function () {
    $('.image').attr('style', 'display:block;');
});
$(document).on('click', '#image-img, .image', function () {
    $('.image').attr('style', 'display:none;');
});
$(document).on('click', '.close-descript', function () {
    $('#prod-card-info').dialog('close');
});


$(document).on('click', '.btn-end-order', function () {
    $('#modal-cart').dialog('close');
});

$(document).on('click', '#add-count', function () {
    $count = $(this).siblings('input')[0].value;
    $step=parseInt($(this).siblings('input').attr('data-step'));
    $countprodpos=parseInt($(this).siblings('input').attr('data-count'));
    if ($count == '') {
        $count = 0;
    }
    if (isNaN(parseInt($count))) {
        $count = -1;
    }
    $(this).siblings('input')[0].value = Math.min(parseInt($count) + $step, $countprodpos);
});

$(document).on('click', '.add-count', function () {
    changeCartCount();
    changeOveralPrice();
    changeCart($(this).siblings('#input-count'));
});

$(document).on('click', '#del-count', function () {
    $count = $(this).siblings('input')[0].value;
    $step=parseInt($(this).siblings('input').attr('data-step'));
    if ($count == '') {
        $count = 0;
    }
    if (isNaN(parseInt($count))) {
        $count = 1;
    }
    $(this).siblings('input')[0].value = (parseInt($count) - 1) < 0 ? 0 : (parseInt($count) - $step);
});
$(document).on('click', '.del-count', function () {
    changeCartCount();
    changeOveralPrice();
    changeCart($(this).siblings('#input-count'));
});


$(document).on('click', '.del-product', function () {
    $delrow = $(this).parent().attr('data-raw');
    $new_cart = new Object();
    $item = JSON.parse(localStorage.getItem('cart-om'));
    $item.cart.splice($delrow, 1);
    $ilocal = JSON.stringify($item);
    localStorage.setItem('cart-om', $ilocal);
    $(this).parent().next().remove();
    $(this).parent().remove();
    $str = $('.cart-row');
    $str2=$('.num-of-items');
    $.each($str, function(i,item){
        $(this).attr('data-raw',i);
        $(this).children().find('.num-of-items').attr('data-raw',i);
    });
    // $.each($str2, function(i,item){
    //     $(this).attr('data-raw',i);
    // });



    //$amount_prod == $item.cart.length;
    $(".cart-count").html($amount_prod);
    $(".cart-price").html($cart_price + ' руб.');
    changeOveralPrice();
    changeCartCount();
});
function coupon(godsprice,wrapprice){

    return couponprice;
}
function changeOveralPrice(){
    var godsprice = 0;
    var wrapprice = 0;
    var totalPrice = 0;
    var couponprice = 0;
    var check = $("[name='wrap']").filter(':checked').first();
    if (check.val() == "boxes") wrapprice = 15;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        var c = ((parseInt($(this).find('#input-count').val())) * (parseInt($(this).find('.cart-prod-price').html())));
        godsprice += c;
    });

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

    $('#gods-price').html(godsprice + ' руб');
    $('#total-price').html(totalPrice + ' руб');
    $('#wrap-price').html(wrapprice + ' руб');
    $('#coupon-price').html(couponprice);
}
$(document).on('click', '.cart-lable', function () {
    $id_product =  this.getAttribute('data-sale');
    $cart_add_obj = $('[data-prod='+$id_product+']').filter('input');
    $checkzero = 0;
    $noanimate = false;
    $.each($cart_add_obj, function () {
        var $item = new Object();
        $item_add = $(this)[0];
        $item.cart = [];
        $item_add.value = $(this).val();
        if($item_add.value > 0) {
            $checkzero = 1;
            if (JSON.parse(localStorage.getItem('cart-om'))) {
                $timenow  =  new Date;
                if(localStorage.getItem('cart-om-date')){
                    $timecart = localStorage.getItem('cart-om-date');
                    // if($timenow.getTime() - $timecart > 604800000){
                    //     localStorage.removeItem('cart-om');
                    //     localStorage.removeItem('cart-om-date');
                    //     return false;
                    // }
                }else{
                    localStorage.setItem('cart-om-date', $timenow.getTime());
                }
                $item = JSON.parse(localStorage.getItem('cart-om'));
                $i = $item.cart.length;
            } else {
                var $time = new Date;
                localStorage.setItem('cart-om-date', $time.getTime());
                $i = 0;
            }
            x = 0;
            if ($item.cart.length > 0) {
                if($noanimate == false) {
                    $noanimate = true;
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
                            $noanimate = false;
                        });

                }

                $.each($item.cart, function () {
                    if ($item_add.getAttribute('data-prod') == this[0] && $item_add.getAttribute('data-model') == this[1] && $item_add.getAttribute('data-attr') == this[2]) {
                        $now_count = $item_add.getAttribute('data-count');
                        if(parseInt($now_count) < (parseInt($item_add.value)+parseInt(this[4]))){
                            alert('Максимальное количество товара уже в корзине');
                        }
                        this[4] = Math.min($now_count,(parseInt(this[4]) + parseInt($item_add.value)));
                        x = 1;
                    }
                });
            } else {
                $noanimate = true;
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
                        $noanimate = false;
                    });
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name'),  {"step":  $item_add.getAttribute('data-min') }, { "min":  $item_add.getAttribute('data-step') }, { "count":  $item_add.getAttribute('data-count') }];
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
                $item.cart[$i] = [$item_add.getAttribute('data-prod'), $item_add.getAttribute('data-model'), $item_add.getAttribute('data-attr'), $item_add.getAttribute('data-price'), $item_add.value, $item_add.getAttribute('data-image'), $item_add.getAttribute('data-attrname'), $item_add.getAttribute('data-name'), {"step":  $item_add.getAttribute('data-min') }, { "min":  $item_add.getAttribute('data-step') }, { "count":  $item_add.getAttribute('data-count') }];
            }
            $ilocal = JSON.stringify($item);
            localStorage.setItem('cart-om', $ilocal);
            $arr_prod = $item.cart;
            $amount_prod = 0;

            $.each($arr_prod, function () {
                $amount_prod = $amount_prod + parseInt(this[4]);

            });
            $(".cart-count").html($amount_prod);

        } });
});
$(document).on('click', '.selected-product', function () {
    $id_product =   parseInt(this.getAttribute('data-product'));
    $checkzero = 0;
    $noanimate = false;
    var $item = new Object();
    $item.products = [];
    if($id_product > 0) {
        $checkzero = 1;
        if (JSON.parse(localStorage.getItem('selected-product-om'))) {
            $timenow  =  new Date;
            if(localStorage.getItem('selected-product-om-date')){
                $timecart =  new Date;
                $timecart = localStorage.getItem('selected-product-om-date');
                // if($timenow.getTime() - $timecart > 604800000){
                //     localStorage.removeItem('cart-om');
                //     localStorage.removeItem('cart-om-date');
                //     return false;
                // }
            }else{
                localStorage.setItem('selected-product-om-date', $timenow.getTime());
            }
            $item = JSON.parse(localStorage.getItem('selected-product-om'));
            $i = $item.products.length;
        } else {
            var $time = new Date;
            localStorage.setItem('selected-product-om-date', $time.getTime());
            $i = 0;
        }
        x = 0;
        if ($id_product > 0) {
            if($noanimate == false) {
                $noanimate = true;
                $($(this))
                    .clone()
                    .css({
                        'position': 'absolute',
                        'z-index': '91100',
                        top: $(this).offset()['top'],
                        left: $(this).offset()['left']
                    })
                    .appendTo("body")
                    .animate({
                        opacity: 0.05,
                        left: $(".selected-count").offset()['left'],
                        top: $(".selected-count").offset()['top'],
                        width: 20,
                    }, 1000, function () {
                        $(this).remove();
                        $noanimate = false;
                    });

            }
            $.each($item.products, function () {
                if ($id_product == this) {
                    x = 1;
                }
            });
        } else {
            $noanimate = true;
            $($(this).parent().parent())
                .clone()
                .css({
                    'position': 'absolute',
                    'z-index': '91100',
                    top: $(this).offset()['top'],
                    left: $(this).offset()['left']
                })
                .appendTo("body")
                .animate({
                    opacity: 0.05,
                    left: $(".selected-count").offset()['left'],
                    top: $(".selected-count").offset()['top'],
                    width: 20,
                }, 1000, function () {
                    $(this).remove();
                    $noanimate = false;
                });
            $item.products[$i] = $id_product;
        }
        if (x == 0) {
            $($(this))
                .clone()
                .css({
                    'position': 'absolute',
                    'z-index': '91100',
                    top: $(this).offset()['top'],
                    left: $(this).offset()['left']
                })
                .appendTo("body")
                .animate({
                    opacity: 0.05,
                    left: $(".selected-count").offset()['left'],
                    top: $(".selected-count").offset()['top'],
                    width: 20,
                }, 1000, function () {
                    $(this).remove();
                });
            $item.products[$i] = $id_product;
            if(typeof(ga) != 'undefined') {
                ga('send', 'event', 'selected', 'click', 'add to selected product');
            }
            }
        $ilocal = JSON.stringify($item);
        localStorage.setItem('selected-product-om', $ilocal);
        $arr_prod = $item.products;
        $amount_prod = 0;
        $(".selected-count").html($item.products.length);
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

function changeCartCount(){
    var cartCount=document.getElementsByClassName('cart-count');
    var count=0;
    $('.num-of-items').each(function () {
        count+=parseInt($(this).children('#input-count').val());
    });
    cartCount[0].textContent=count;
}

$(document).on('keyup', '#input-count', function(){
    $val =   $(this).val();
    if($val == '' || isNaN($val)){
        $val = 0;
    }
    $(this).val(Math.min(parseInt($val), $(this).attr('data-count')));
});
$(document).on('keyup', '.input-count', function(){
    changeCartCount();
    changeOveralPrice();
    changeCart($(this));
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
    SECONDS_BETWEEN_FRAMES = 0 / FPS;
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
function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
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

// отображение иконок сезона на продуктах
function renderSeason(season){
    var result = "";
    if(season != "" && season != undefined){
        var code = {
            'лето': '/summer.png',
            'зима': '/winter.png',
            'весна': '/spring.png',
            'осень': '/autumn.png',
            'всесезон': '/allseasons.png'
        };
        var seasonProduct = '',
            zIndex = 13,
            left = 15;
        for (var name in code) {
            if(season.toLowerCase().indexOf(name)+1){
                seasonProduct +='<div style="position: absolute;z-index: '+zIndex+';left: '+left+'px;">' +
                '<a style="display: block" href="#" data-toggle="tooltip" data-placement="top" title="'+name+'"><img style="" src="/images/icons/seasons'+code[name]+'"></a></div>';
                zIndex--;
                left +=15;
            }
        }
        result = '<div style="position: absolute;top: 0;left: 40px;">'+seasonProduct+'</div>';
    }
    return result;
}

function renderProduct($prod,$descr,$attrib,$attribdescr,$time,$category, $showdiscount,suppliers,subImage){
    if($category.lenght  ==  0  || typeof($category['num']) =='undefined' ) {
        $catname = '';
        $catnum = '';
    }else{
        $catname = $category.name[$category.name.length - 1];
        $catnum = $category.num[$category.num.length - 1];
    }

    $product = $prod;
    $descriptionprod = $descr;
    $attr_desc = $attribdescr;
    $attr = $attrib;

    if(parseInt($product['products_old_price']) > parseInt($product['products_price']) && $showdiscount == 1){
        $discount = 100 - Math.round($product['products_price'] * 100 / $product['products_old_price']);
    }else{
        $discount = false;
    }
    $offersstyle='';
    if($showdiscount == 1 && $product['products_old_price'] > 0){
        $offersstyle='style="right:10px;top: 325px;position:absolute"';
    }
    $attr_html = '<div data-sale="'+$product['products_id']+'" class="cart-lable">В корзину</div>';

    if(subImage.length != 0){
        $subImage = '<div class="fa fa-picture-o fa-lg" style="color: #19a09d;position: absolute;top: 5px;right: 10px;line-height: 1;background: whitesmoke;padding: 5px;border-radius: 40px;"></div>';
    } else {
        $subImage = "";
    }

    if($.inArray($product['manufacturers_id'], suppliers.ok) != -1){
        $man_in_sklad = '<div style="position: absolute; top: 0px; right: 50px;"><a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)." ><img src="/images/logo/ok.png"></a></div>';
    }else{
        $man_in_sklad = '';
    }
    if($.inArray($product['manufacturers_id'], suppliers.lux) != -1){
        $man_lux = '<div style="position: absolute;top: 0px;right: 90px;height: 30px;width: 30px;"><a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)." > <a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)."><img style="position: relative;" src="/images/logo/ok.png"><img style="position: absolute; left: 2px; height: 24px; padding: 0px; top: 0px; margin: 14px auto; right: 24px; border-radius: 45px; border: 2px solid rgb(204, 204, 204);" src="/images/logo/lux.png"></a> </a></div>';
    }else{
        $man_lux = '';
    }

    if ($attr_desc.length > 0) {
        var  innerindex = 0;
        $.each($attr_desc, function (index,value) {
            if($product['products_quantity_order_units'] === '1'  || $product['products_quantity_order_min'] === '1'){
                $disable_for_stepping = '';
            }else{
                $disable_for_stepping = 'disabled';
            }
            if($attr[value['products_options_values_id']]['quantity'] > 0  && $attr[value['products_options_values_id']]['options_values_price'] == 0){
                $classpos = 'active-options';
                $add_class = 'add-count';
                $del_class = 'del-count';
                $stylepos = '';
                $inputpos = '';
                $some_text = 0;
                if((innerindex%2) == 0 && $stylepos == ''){
                    $class='border-right:1px solid #CCC';
                    innerindex++;
                }else{
                    $class='';
                    innerindex++;
                }
            }else{
                $classpos = 'disable-options';
                $inputpos = 'readonly';
                $stylepos = 'display:none; ';
                $add_class = 'add-count-dis';
                $del_class = 'del-count-dis';
                $some_text = 'Нет';
            }

            if($descriptionprod == "null"){
                $descriptionprod.products_description="Без Описания";
                $descriptionprod['products_name']="Не указано";
            }

            $attr_html += '<div class="'+$classpos+'" style="'+$stylepos+' width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'+value['products_options_values_name']+'</div>'+
                '<input  '+ $disable_for_stepping +'  '+$inputpos+' id="input-count"'+
                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                'data-prod="'+ $product['products_id']+'"'+
                'data-name="'+ escapeHtml($descriptionprod['products_name'])  +'"'+
                'data-model="'+ $product['products_model']+'"'+
                'data-price="'+ Math.round($product['products_price'])+'"'+
                'data-image="'+ $product['products_image']+'"'+
                'data-count="'+ $attr[value['products_options_values_id']]['quantity']+'"'+
                'data-step="'+ $product['products_quantity_order_units']+'"'+
                'data-min="'+ $product['products_quantity_order_min']+'"'+
                'data-attrname="'+escapeHtml(value['products_options_values_name'])+'"'+
                'data-attr="'+value.products_options_values_id+'"'+
                'placeholder="0"'+
                'type="text">'+
                '<div id="'+$add_class+'" style="margin: 0px;line-height: 1.6;">'+
                '+'+
                '</div>'+
                '<div id="'+$del_class+'" style="margin: 0px;line-height: 1.6;">'+
                '-'+
                '</div>'+
                '</div></div></div>';
        });
    } else {
        if($product['products_quantity_order_units'] === '1'  || $product['products_quantity_order_min'] === '1'){
            $disable_for_stepping = '';
        }else{
            $disable_for_stepping = 'disabled';
        }
        $attr_html += '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>'+
            '<input '+ $disable_for_stepping +' id="input-count"'+
            'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
            'data-prod="'+ $product['products_id']+'"'+
            'data-model="'+ $product['products_model']+'"'+
            'data-price="'+ Math.round($product['products_price'])+'"'+
            'data-image="'+ $product['products_image']+'"'+
            'data-attrname=""'+
            'data-attr=""'+
            'data-count="'+ $product['products_quantity']+'"'+
            'data-name="'+  escapeHtml($descriptionprod['products_name'] ) +'"'+
            'data-step="'+ $product['products_quantity_order_units']+'"'+
            'data-min="'+ $product['products_quantity_order_min']+'"'+
            'placeholder="0"'+
            'type="text">'+
            '<div id="add-count" style="margin: 0px;line-height: 1.6;">'+
            '+'+
            '</div>'+
            '<div id="del-count" style="margin: 0px;line-height: 1.6;">'+
            '-'+
            '</div>'+
            '</div></div></div>';
    }

    if( $time[$product.manufacturers_id] === undefined ) {
        $timewrap = '';
    }else{
        $timewrap =  '<a data-ajax="time" style="cursor:pointer;" data-href="'+$product['manufacturers_id']+'"><i class="fa fa-clock-o"></i></a>';

    }
    $chosen = '<a style="display: block;cursor:pointer;float: left;padding-right: 10px;" class="selected-product" data-product="'+$product['products_id']+'" ><i class="fa fa-star" aria-hidden="true"></i></a>';
    $product_menu = '<a class="product-menu" style="display: block;cursor:pointer;float: left;padding-right: 10px;"><i class="mdi" style="width: 20px;border-radius: 40px; border: 2px solid rgb(0, 165, 161); padding: 0px; margin: 0px; font-size: 16px;" aria-hidden="true">more_horiz</i></a>';

    $preview = '<a style="display: block;cursor:zoom-in;float: left;padding-right: 10px;"  rel="light" data-gallery="1" href="http://odezhda-master.ru/images/'+$product['products_image']+'"><i class="fa fa-search-plus"  aria-hidden="true"></i></a>';
    if($product['products_ordered'] >= 1000){
        $product['products_ordered'] = 'Хит продаж!';
    }else{
        $product['products_ordered'] = 'Заказано: '+ $product['products_ordered'];
    }
    $timeprew = '<div style="" class="model">'+$timewrap+$preview+$chosen+$product_menu+'<div class="product-menu-rel active" style="display:none" data-cat="'+$product['products_id']+'"><div>'+$product['products_ordered']+'</div><a href=/catalog?cat='+$catnum+'>Категория: '+$catname+'</a></div></div>';
    $discounthtml = '';
    if (($product['products_old_price']) > 0 && $showdiscount == 1 && $discount) {
        $discounthtml += '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; padding: 7px; line-height: 10px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px; border-radius: 4px;">-' + $discount + ' %</div>';
        $discounthtml += '<div style="font-size: 18px; color:#9e9e9e; font-weight: 300; margin: 5px;"  itemprop="old-price" ><strike>' + $product['products_old_price'] + ' руб.</strike></div>';
    }
    $href = '';
    if(typeof(seo_urls) != 'undefined' && seo_urls  && $product['product_seo']){
        $href = '<a itemprop="url" href="/product/'+$product['product_seo'] + '"  style="float: right; position: absolute; bottom: 9px; right: 12px; font-size: 12px; font-weight: 500;">'+
            '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
            '</i>'+
            'В карточку'+
            '</a>';
    }else{
        $href = '<a itemprop="url" href="/product?id=' + $product.products_id+ '"  style="float: right; position: absolute; bottom: 9px; right: 12px; font-size: 12px; font-weight: 500;">'+
        '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
        '</i>'+
        'В карточку'+
        '</a>';
    }
    $('.bside').append('<div class="container-fluid float" itemscope itemtype="http://schema.org/ProductModel" id="card" itemid="' + $product.products_id+ '">'+$man_in_sklad+$man_lux+renderSeason($product["season_code"])+
        '<meta itemprop="image" content="/imagepreview?src=' + $product['products_id'] + '">' +
        '<a id="prod-info" data-prod="' + $product.products_id + '" >'+$subImage+
        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/imagepreview?src=' + $product.products_id + ');">'+
        '</div>'+ $discounthtml+
        '<div  itemprop="model" class="model" style="display:none">' + $product.products_model + '</div>' +
        '<div  itemprop="description" class="model" style="display:none">' +$descriptionprod.products_description + '</div>' +
        '<div itemprop="name" class="name">' + $descriptionprod.products_name  +'</div>'+
        '</a>'+
        '<div itemprop="offers" '+$offersstyle+' itemscope itemtype="http://schema.org/Offer" class="price">'+
        '<div itemprop="price" style="font-size: 18px; font-weight: 500;">'+
        Math.round($product.products_price) + ' Руб.'+
        '</div>'+
        '</div>'+
        '<div style="cursor:pointer">'+
        '<div data-vis="size-item-desc" data-vis-id="'+$product.products_id+'" style="text-align: right;font-size: 12px;font-weight: 400;display: block;width: 50%;position: absolute;bottom: 35px;right: 20px;margin: 0px 0px -8px;padding: 5px 45px;" data-prod="'+$product.products_id+'">'+
        'Размеры'+
        '<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600;color: rgb(0, 165, 161);font-size: 18px;position: absolute;right: 0px;padding: 3px 0px 0px 40px;">'+
        '</i>'+
        '<span data-vis="size-item-card" data-vis-id-card="'+$product.products_id+'">'+
        $attr_html+
        '</span>'+
        '</div>'+
        '</div>'+
        $href+
        ''+$timeprew+''+
        '</div></div>');
}
function renderProduct2($prod,$descr,$attrib,$attribdescr,$time,$category, $showdiscount){
    if($category.lenght  ==  0  || typeof($category['num']) =='undefined' ) {
        $catname = '';
        $catnum = '';
    }else{
        $catname = $category.name[$category.name.length - 1];
        $catnum = $category.num[$category.num.length - 1];
    }
    $product = $prod;
    $descriptionprod = $descr;
    $attr_desc = $attribdescr;
    $attr = $attrib;
    $attr_html = '';
    if(parseInt($product['products_old_price']) > parseInt($product['products_price']) && $showdiscount == 1){
        $discount= 100 - Math.round($product['products_price']*100/$product['products_old_price']);
    }else{
        $discount = false;
    }
    $offersstyle='';
    if($showdiscount == 1 && $product['products_old_price'] > 0){
        $offersstyle='style="right:10px;bottom:105px; position:absolute"';
    }
    if($.inArray($product['manufacturers_id'], ["749","2700","1241","2058","3412","3473","3481",'3512']) != -1){
        $man_in_sklad = '<div style="position: absolute; top: -5px; right: 50px;"><img src="/images/logo/ok.png"></div>';
    }else{
        $man_in_sklad = '';
    }
    if ($attr_desc.length > 0) {
        var  innerindex = 0;
        $.each($attr_desc, function (index,value) {
            if($attr[value['products_options_values_id']]['quantity'] > 0 && $attr[value['products_options_values_id']]['options_values_price'] == 0){
                $classpos = 'active-options';
                $add_class = 'add-count';
                $del_class = 'del-count';
                $stylepos = '';
                $inputpos = '';
                $some_text = 0;
                if((innerindex%2) == 0 && $stylepos == ''){
                    $class='border-right:1px solid #CCC';
                    innerindex++;
                }else{
                    $class='';
                    innerindex++;
                }
            }else{
                $classpos = 'disable-options';
                $inputpos = 'readonly';
                $stylepos = 'display:none; ';
                $add_class = 'add-count-dis';
                $del_class = 'del-count-dis';
                $some_text = 'Нет';
            }

            $attr_html += '<div class="'+$classpos+'" style="'+$stylepos+' width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'+value['products_options_values_name']+'</div>'+

                '<input '+$inputpos+' id="input-count"'+
                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                'data-prod="'+ $product['products_id']+'"'+
                'data-name="'+ escapeHtml($descriptionprod['products_name'])  +'"'+
                'data-model="'+ $product['products_model']+'"'+
                'data-price="'+ Math.round($product['products_price'])+'"'+
                'data-image="'+ $product['products_image']+'"'+
                'data-count="'+ $attr[value['products_options_values_id']]['quantity']+'"'+
                'data-step="'+ $product['products_quantity_order_units']+'"'+
                'data-min="'+ $product['products_quantity_order_min']+'"'+
                'data-attrname="'+escapeHtml(value['products_options_values_name'])+'"'+
                'data-attr="'+value['products_options_values_id']+'"'+
                'placeholder="0"'+
                'type="text">'+
                '<div id="'+$add_class+'" style="margin: 0px;line-height: 1.6;">'+
                '+'+
                '</div>'+
                '<div id="'+$del_class+'" style="margin: 0px;line-height: 1.6;">'+
                '-'+
                '</div>'+
                '</div></div></div>';

        });
    } else {
        $attr_html += '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;margin-top:20px;"><div style="margin: auto; width: 100%;"><div></div>'+
            '<input  id="input-count"'+
            'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
            'data-prod="'+ $product['products_id']+'"'+
            'data-model="'+ $product['products_model']+'"'+
            'data-price="'+ Math.round($product['products_price'])+'"'+
            'data-image="'+ $product['products_image']+'"'+
            'data-attrname=""'+
            'data-attr=""'+
            'data-count="'+ $product['products_quantity']+'"'+
            'data-name="'+  escapeHtml($descriptionprod['products_name'] ) +'"'+
            'data-step="'+ $product['products_quantity_order_units']+'"'+
            'data-min="'+ $product['products_quantity_order_min']+'"'+
            'placeholder="0"'+
            'type="text">'+
            '<div id="add-count" style="margin: 0px;line-height: 1.6;">'+
            '+'+
            '</div>'+
            '<div id="del-count" style="margin: 0px;line-height: 1.6;">'+
            '-'+
            '</div>'+
            '</div></div></div>';
    }
    $attr_html+='<div data-sale="'+$product['products_id']+'" class="cart-lable">В корзину</div><div style="font-size:13px; text-align:right;margin-top:5px;">Добавлено: '+$product['products_date_added']+'</div>';

    if( $time[$product.manufacturers_id] === undefined ) {
        $timewrap = '';
    }else{
        $timewrap =  '<a data-ajax="time" style="cursor:pointer;" data-href="'+$product['manufacturers_id']+'"><i class="fa fa-clock-o"></i></a>';

    }
    $preview = '<a style="display: block;cursor:zoom-in;float: left;padding-right: 10px;"  rel="light" data-gallery="1" href="http://odezhda-master.ru/images/'+$product['products_image']+'"><i class="fa fa-search-plus"  style="position:absolute; bottom:30px; left:25px;" aria-hidden="true"></i></a>';
    $chosen = '<i class="fa fa-star selected-product" style="position:absolute;cursor:pointer; bottom:30px; left:25px; font-size:20px;bottom:30px; left:50px;" data-product="'+$product['products_id']+'" aria-hidden="true"></i>';
    $product_menu = '<i class="mdi product-menu" style="border-radius: 40px;cursor: pointer; border: 2px solid rgb(0, 165, 161); font-size: 16px; position: absolute;top:auto;bottom:30px;left: 75px;" aria-hidden="true">more_horiz</i>';
    $timeprew = '<div style="" class="model">'+$timewrap+$preview+$chosen+$product_menu+'<div class="product-menu-rel active" style="display:none" data-cat="'+$product['products_id']+'"><a href=/catalog?cat='+$catnum+'>Категория: '+$catname+'</a></div></div>';

    $discounthtml = '';
    if (($product['products_old_price']) > 0 && $showdiscount == 1 && $discount) {
        $discounthtml += '<div style="font-size: 18px; margin: 5px; color:#9e9e9e; font-weight: 300; margin-left: 130px;"   itemprop="old-price" ><strike>' + parseInt($product['products_old_price']) + ' руб.</strike></div>';
        $discounthtml += '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; padding: 7px; line-height: 10px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px; border-radius: 4px;">-' + parseInt($discount) + ' %</div>';
    }
    if($product.products_ordered >= 1000){
        $product.products_ordered = 'Хит продаж!';
    }else{
        $product.products_ordered = 'Заказано: '+ $product.products_ordered;
    }
    $href = '';
    if(typeof(seo_urls) != 'undefined' && seo_urls && $product['product_seo']){
        $href =  '<a itemprop="url" href="/product/' + $product['product_seo']+ '"  style="float: right; position: absolute; bottom: 9px; left: 25px; font-size: 12px; font-weight: 500;">'+
        '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
        '</i>'+
        'В карточку'+
        '</a>';
    }else{
        $href =  '<a itemprop="url" href="/product?id=' + $product.products_id+ '"  style="float: right; position: absolute; bottom: 9px; left: 25px; font-size: 12px; font-weight: 500;">'+
        '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
        '</i>'+
        'В карточку'+
        '</a>';
    }
    $('.bside').append('<div class="inht" itemid="' + $product.products_id+ '" itemscope itemtype="http://schema.org/ProductModel"><div class="container-fluid float"  id="card2" >'+$man_in_sklad+
        '<div id="prod-info" data-prod="' + $product.products_id + '" >'+
        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/imagepreview?src=' + $product.products_id + ');">'+
        '<meta itemprop="image" content="/imagepreview?src=' + $product['products_id'] + '">' +
        '</div>'+$discounthtml+'</div>'+
        ''+$timeprew+''+
        '<div  itemprop="model" class="model" style="display: none;">' + $product.products_model + '</div>' +
        '<div  itemprop="description" class="model" style="display:none">' +$descriptionprod.products_description + '</div>' +
        '<div style="cursor:pointer">'+
        '<div data-vis="size-item-desc" data-vis-id="'+$product.products_id+'" style="text-align: right;font-size: 12px;font-weight: 400;display: none;width: 50%;position: absolute;bottom: 35px;right: 20px;margin: 0px 0px -8px;padding: 5px 45px;" data-prod="'+$product.products_id+'">'+
        'Размеры'+
        '<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600;color: rgb(0, 165, 161);font-size: 18px;position: absolute;right: 0px;padding: 3px 0px 0px 40px;">'+
        '</i>'+
        '</div>'+
        '</div>'+
        $href+
        '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price"  style="margin-left:130px;" >'+
        '<div itemprop="price" style="font-size: 18px; font-weight: 500;">'+
        Math.round($product.products_price) + ' Руб.'+
        '</div>'+
        '</div>'+
        '</div>' +
        '<div id="card2size"><span data-vis="size-item-card" data-vis-id-card="'+$product.products_id+'">'+
        '<div itemprop="name" class="name">' + $descriptionprod.products_name  +'</div>'+
        '<div  itemprop="model" class="model">' + $product.products_model + '</div>' +
        '<div>' + $product.products_ordered + '</div>' +
        $attr_html+
        '</span></div>'+
        '</div></div>');
}
$(document).on('click', '.lock-on', function () {
    $('html').prepend('<div class="preload"><div class="loading"></div></div>');

});


var inProgress = false;
var ControlLoad = 'manual';
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
//
//
$(document).on('change','#control-load', function(){
    ControlLoad = $('#control-load option:selected').val();
});
function loaddata(){
    $('html').prepend('<div class="preload"><div class="loading"></div></div>');
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

    $prodatrquery = $check.join(',');
    if ($count == '') {
        $count = 60;
    }


    $urld = '';
    $urld = document.location.toString();
    $urld = '' + $urld.split('?')[1];
    $urld = split_url($urld);
    if($urld['cat']){
        $cat = $urld['cat'][1];
    }else{
        $cat = 0;
    }
    if($urld['ok']){
        $ok = $urld['ok'][1];
    }else{
        $ok = 0;
    }
    if($urld['lux']){
        $lux = $urld['lux'][1];
    }else{
        $lux = 0;
    }
    if($urld['prod_attr_query']){
        $prodatrquery = $urld['prod_attr_query'][1];
    }else{
        $prodatrquery = '';
    }
    if($urld['searchword']){
        $searchword = $urld['searchword'][1];
    }else{
        $searchword = '';
    }

    $sfilt = $.getQuery('sfilt%5B%5D');
    if($sfilt != null){
        $sfilt_url_param = $sfilt.join('&sfilt%5B%5D=');
    }else{
        if($urld['sfilt[]']){
            $sfilt = [$urld['sfilt[]'][1]];
            $sfilt_url_param ='&sfilt%5B%5D='+$sfilt;
        }else{
            $sfilt_url_param  = '';
        }
    }
    $url = '?cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword+'&ok='+$ok+$sfilt_url_param;
    $url_data = $urld;
    $.ajax({
        method:"post",
        url: "",
        data: { "_csrf":yii.getCsrfToken(),
            "cat":$cat,
            "count":$count,
            "start_price": $min_price,
            "end_price": $max_price,
            "prod_attr_query": $prodatrquery,
            "page": $page+1,
            "sort": $sort,
            "ok": $ok,
            "searchword": $searchword,
            "json": '1',
            "sfilt":$sfilt
        },
        cache: false,
        async: true,
        dataType: 'json',
        beforeSend: function () {
            inProgress = true;
        }
    }).done(function (data) {
        var suppliers = new Object();
        suppliers.lux = $.parseJSON($('#suppliers-lux').val());
        suppliers.ok = $.parseJSON($('#suppliers-ok').val());
        $('.preload').remove();
        $loader = $('.loader-inner').html();
        $('.pagination-catalog').remove();
        $('.loader-inner').remove();
        if (data[0] != 'Не найдено!') {
            if(getCookie('cardview')==1) {
                $.each(data[0], function (i, item) {
                    renderProduct2(this.products, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], data[14],this.catpath, true)
                });
            }else{
                $.each(data[0], function (i, item) {
                    renderProduct(this.products, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], data[14],this.catpath, true,suppliers,this.subImage)
                });
            }
            $pager = '';
            data[1] = parseInt(data[1]);
            $count = parseInt($count);
            if(data[1] > $count){
                $pager +='<div class="pagination-catalog" style="float: right; margin: auto; text-align: center; width: 100%;">';
                if($page <= 0){
                    $fpclass = 'disable';
                }else{
                    $fpclass = '';
                }
                $pager += '<ul class="pagination">';
                $pager += '<li class="first">';
                $pager += '<a href="' + new_url(new_suburl(split_url($url), 'page', 0)) + '" data-page="0">';
                $pager += 'Первая';
                $pager += '</a>';
                $pager += '</li>';
                $pager += '<li class="prev">';
                $pager += '<a href="' + new_url(new_suburl(split_url($url), 'page', Math.max(0,$page-1))) + '" data-page="'+($page-1)+'">';
                $pager += '<i class="mdi mdi-arrow-back">';
                $pager += '</i>';
                $pager += '</a>';
                $pager += '</li>';
                $checkdelimiter = data[1]%$count;
                if($checkdelimiter){
                    $pagecount = parseInt(data[1]/$count);
                }else{
                    $pagecount = parseInt(data[1]/$count)-1;
                }
                $endpage = Math.min($pagecount, $page+2);
                $startpage = Math.max(0, $page-2);
                for($startpage; $startpage<=$endpage ; $startpage++){
                    if($page == $startpage){
                        $pager += '<li class="active"><a  href="' + new_url(new_suburl(split_url($url), 'page', Math.max(0,$startpage+1))) + '" data-page="'+($startpage+1)+'">'+($startpage+1)+'</a></li>';

                    }else{
                        $pager += '<li><a href="' + new_url(new_suburl(split_url($url), 'page', Math.max(0,$startpage))) + '">'+($startpage+1)+'</a></li>';
                    }
                }
                $pager += '<li class="next">';
                $pager += '<a href="' + new_url(new_suburl(split_url($url), 'page', Math.min($pagecount,$page+1))) + '">';
                $pager += '<i class="mdi mdi-arrow-forward">';
                $pager += '</i>';
                $pager += '</a>';
                $pager += '</li>';
                $pager += '<li class="last">';
                $pager +='<a href="' + new_url(new_suburl(split_url($url), 'page', $pagecount)) + '">';
                $pager += 'Последняя';
                $pager += '</a>';
                $pager +='</li> </ul></div>';

            }


            $('.bside').append('<div class="loader-inner">'+$loader+'</div><div class="pagination-catalog" style="float: right; margin: auto; text-align: center; width: 100%;" ><ul class="pagination">'+$pager+'</ul></div>');
            $(document).on('load', 'a[rel=light]', function(){
                $(this).light();
            });
            inProgress = false;
        } else {
            $('#size-slide').html('');
            $('#filter-button').html('');
            $('.preload').remove();
        }
    });
}
$(window).on('load', function () {

    $(window).scroll(function () {
        $control = $('#control-load option:selected').val();
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 500 && !inProgress && ControlLoad =='auto') {
            loaddata();
        }
    });
    $(document).on('click', '.loader', function () {
        $control = $('#control-load option:selected').val();
        if (!inProgress && ControlLoad=='manual') {
            loaddata();
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

$(document).on('keyup', '.search', function () {
    $('.result_search_word').show();
    $('.result_search_word').html('');
    $text = $(this).val();
    $text = $text.split(' ');
    $count = $text.length;
    $text = $text[$count - 1];
    if ($text.length > 0) {
        $.ajax({
            url: '/searchword',
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
    $text = $('.search').val();
    $text = $text.split(' ');
    $count = $text.length;
    $text[$count - 1] = $(this).text();
    $('.search').val($text.join(' ', $text));
    $('.result_search_word').hide();
});
$(window).on('load', function () {

    $amount_prod = 0;
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        if (JSON.parse(localStorage.getItem('cart-om'))) {
            $timenow  =  new Date;
            if(localStorage.getItem('cart-om-date')){
                $timecart =  new Date;
                $timecart = localStorage.getItem('cart-om-date');
                // if($timenow.getTime() - $timecart > 604800000){
                //     localStorage.removeItem('cart-om');
                //     localStorage.removeItem('cart-om-date');
                //     return false;
                // }
            }else{
                localStorage.setItem('cart-om-date', $timenow.getTime());
            }
            $item = JSON.parse(localStorage.getItem('cart-om'));
            $i = $item.cart.length;
        } else {
            var $time = new Date;
            localStorage.setItem('cart-om-date', $time.getTime());
            $i = 0;
        }
        $item = JSON.parse(localStorage.getItem('cart-om'));
        $i = $item.cart;
        $.each($i, function () {
            $amount_prod = $amount_prod + parseInt(this[4]);
        });
    } else {
        $i = 0;

    }
    $(".cart-count").html($amount_prod);

    $amount_products = 0;
    if (JSON.parse(localStorage.getItem('selected-product-om'))) {
        if (JSON.parse(localStorage.getItem('selected-product-om'))) {
            $timenow  =  new Date;
            if(localStorage.getItem('selected-product-om-date')){
                $timecart =  new Date;
                $timecart = localStorage.getItem('selected-product-om-date');
                // if($timenow.getTime() - $timecart > 604800000){
                //     localStorage.removeItem('cart-om');
                //     localStorage.removeItem('cart-om-date');
                //     return false;
                // }
            }else{
                localStorage.setItem('selected-product-om-date', $timenow.getTime());
            }
            $item = JSON.parse(localStorage.getItem('selected-product-om'));
            $i = $item.products.length;
        } else {
            var $time = new Date;
            localStorage.setItem('selected-product-om-date', $time.getTime());
            $i = 0;
        }
        $item = JSON.parse(localStorage.getItem('selected-product-om'));
        $i = $item.products;
        $.each($i, function () {
            $amount_products++ ;
        });
    } else {
        $i = 0;

    }
    $(".selected-count").html($amount_products);



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
        var accordion = new Accordion($('.accordion'), false);
    });

});

$(document).on('click', '#profile-info', function () {
    $(location).attr('href','/lk/');
    $.post(
        "/requestadress",
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
            "/requestemail",
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
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input disabled name="[userinfo]'+$attr+'" title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" data-name="' + $attr + '" class="info-item" data-name="' + $attr + '" value="' + $attrval + '" ></input></div>';
        } else {
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input disabled name="[userinfo]'+$attr+'" title="'  + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" class="info-item" data-name="' + $attr + '" placeholder="' + $attrlable + '"></input></div>';
        }
    });
    $('.address').remove();
    $('.pre-order').remove();
    //$('.cart-column2').append('<div class="address" style="padding: 0px 10px;">'+$inner + '<div class="order-accept"><strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе! </strong><br>Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных, а также соглашаетесь с <a target="_blank" href="/page?article=offerta">договором оферты</a>.</div><button class=" btn btn-lg btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-bottom: 5px;" type="submit">Подтвердить заказ</button></div>');
	  $('#check-confirm').before('<div class="address" style="padding: 0px 10px;">'+$inner + '<div class="order-accept">Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных. , а также соглашаетесь с <a target="_blank" href="/page?article=offerta">договором оферты</a><strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе! </strong></div></div>');
	  $('.ui-dialog-titlebar').hide();
    $.ajax({
        type: "GET",
        url: "/countryrequest",
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
        url: "/zonesrequest",
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
        $(this).parent().parent().siblings().find('[data-name=state]').val('');
        $('#country-drop').hide();
        $.ajax({
            type: "GET",
            url: "/zonesrequest",
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
$(document).on('click','.product-menu',function() {
    if($('.product-menu-rel').is(':not(:visible)')) {
        jQuery('.product-menu-rel').attr('style', 'display:block');
    }
    else{
        jQuery('.product-menu-rel').attr('style','display:none');
    }});
$(document).on('click', '[data-ajax=time]', function(){
    $.post('/timeorderproducts?id='+$(this).attr('data-href'), function( data ) {
        if($("#time").length) {
            $('#time').html(data);
            $('#overlay')
                .css('display','block')
        }else{
            $('.bside').append('<div id="overlay" ></div><div id="time" style="display: none;">'+data+'</div>');
        }
        $('#time').show();
    });
});
$(document).on('click', '.close-modal', function(){
    $(this).parents().find('#time').hide();
    $('#overlay').css('display','none');
});
var lockprodinfo = false;
$(document).on('click','#prod-info',function(){
    if(lockprodinfo !== true) {
        lockprodinfo = true;
        var dp = $(this).attr('data-prod');
        $prod_html = '';
        $size_html = '';
        $spec_html = '';

        $.post('/product', {id: dp}, function (data) {
            $spec_html = '<div class="spec" style="margin-top:25px; ">';
            $.each(data['spec'].productsSpecification, function (i, item) {
                if (typeof(data['spec']['specificationDescription'][item.specifications_id]) != "undefined") {
                    $spec_html += data['spec']['specificationDescription'][item.specifications_id]['specification_name'] + ': ';
                } else {
                    $spec_html += '';
                }
                if (typeof(data['spec']['specificationValuesDescription'][item.specification_values_id]) != "undefined") {
                    $spec_html += data['spec']['specificationValuesDescription'][item.specification_values_id]['specification_value'] + '<br/>';
                } else {
                    $spec_html += 'Не указан<br/>';
                }


            });

            $spec_html += '</div>';
            $activelabel=0;
            if(Array.isArray(data.product.productsAttributes)){
                if(parseInt(data.product.products.products_quantity)>0){
                    $activelabel++;
                }
            }
            else{
                $.each(data.product.productsAttributes,function(i,item){
                    if(item.quantity > 0   && item.options_values_price == 0){
                        $activelabel++;
                    }
                })
            }
            if($activelabel>0) {
                $size_html += '<div data-sale="' + data.product.products_id + '" class="cart-lable" style="left:0">В корзину</div>';
            }else{
                $size_html += '<div class="cart-lable" style="left:0; background: #E9516D;">Продано</div>';
            }

            $imgs = new Array('/imagepreview?src=' + data['product']['products']['products_id']);
            $imgs2 = new Array(data['product']['products']['products_image']);
            $.each(data['images'], function(i,index){
                $imgs.push('/imagepreview?src=' + data['product']['products']['products_id']+'&amp;sub='+i);
                $imgs2.push(data['images'][i]);
            });


            $miniimg = '';
            $bigimg = '';

            $.each($imgs, function (i, item) {
                $miniimg += '<div id="carousel-selector-' + i + '" style="float:left; margin-top: 5px; overflow: hidden" class="mini-img-item"><img style="height:80px; display: block; margin: auto; border:1px solid #cccccc; border-radius:4px;" src="' + item + '"/></div>';
                if (i == 0) {
                    $bigimg += '<div class="item active" style="margin: 0px;"><div style="position: absolute; bottom: 0;"></div><a class="cloud-zoom"  href="http://odezhda-master.ru/images/' + data.product.products.products_image +'"><img  style="border:1px solid #cccccc; border-radius:4px;" src=' + item + '></a></div>';
                }
                else {
                    $bigimg += '<div class="item"><a class="cloud-zoom" data-cloud="'+i+'" href="http://odezhda-master.ru/images/' + $imgs2[i] +'"><img style="border:1px solid #cccccc; border-radius:4px;" src=' + item + '></a></div>';
                }

            });

            $size_html += '<div class="size-block" style="overflow: hidden;margin-bottom: 38px; width: 340px;">';
            $baseduri = window.location.hostname;
            if(typeof (ga)!='undefined') {
                ga("ec:addProduct", {
                    "id": data['product']['products']['products_id'],
                    "name": data['product']['productsDescription']['products_name'],
                    "category": data.catpath.name.join('/'),
                    "list": window.location.pathname,
                    "brand": data['product']['products']['manufacturers_id'],
                    "variant": "none",
                    "position": 0
                });
                ga("ec:setAction", "popupview");
                ga("send", "event", "popupview", window.location.pathname);
                ga("ec:addProduct", {
                    "id": data['product']['products']['products_id'],
                    "name": data['product']['productsDescription']['products_name'],
                    "category": data.catpath.name.join('/'),
                    "list": window.location.pathname,
                    "brand": data['product']['products']['manufacturers_id'],
                    "variant": "none",
                    "position": 0
                });
                ga("ec:setAction", "click");
                ga("send", "event", "click", window.location.pathname);
            }
            if (typeof (data.product.productsAttributesDescr.keys) == "undefined") {

                if(data.product.products.products_quantity_order_units === '1'  || data.product.products.products_quantity_order_min === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'disabled';
                }

                $.each(data.product.productsAttributesDescr, function (i, item) {
                    if (data.product.productsAttributes[item['products_options_values_id']]['quantity'] > 0 && (data.product.productsAttributes[item['products_options_values_id']]['options_values_price'] == 0)) {
                        $classpos = 'active-options';
                        $add_class = 'add-count';
                        $del_class = 'del-count';
                        $stylepos = '';
                        $inputpos = '';
                        $some_text = 0;
                    } else {
                        $classpos = 'disable-options';
                        $inputpos = 'readonly';
                        $stylepos = 'display:none; ';
                        $add_class = 'add-count-dis';
                        $del_class = 'del-count-dis';
                        $some_text = '';
                    }

                    $size_html += '<div class="' + $classpos + '" style="' + $stylepos + 'width: 50%; overflow: hidden; float: left; margin-bottom:10px;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div style="margin-bottom: 3px ;">' + item.products_options_values_name + '</div>';
                    //   $size_html += '<div class="' + $classpos + '" style="width: 50%; overflow: hidden; float: left; margin-bottom:10px;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div style="margin-bottom: 5px;">' + item.products_options_values_name + '</div>';
                    $size_html += '<input '+ $disable_for_stepping +' ' + $inputpos + ' id="input-count" style="width: 40%;height: 22px; text-align: center; position: relative;top:0px;border-radius: 4px;border:1px solid #CCC;" data-prod="' + data.product.products_id + '" data-name="' + data.product.productsDescription.products_name + '" data-model="' + data.product.products.products_model + '" data-price="' + Math.round(data.product.products.products_price) + '" data-image="' + data.product.products.products_image + '" data-count="' + data.product.products.products_quantity + '" data-step="' + data.product.products.products_quantity_order_units + '" data-min="' + data.product.products.products_quantity_order_min + '" data-attrname="' + data.product.productsAttributesDescr[i].products_options_values_name + '" data-attr="'+data.product.productsAttributesDescr[i].products_options_values_id+'" placeholder="' + $some_text + '" type="text">';
                    $size_html += '<div id="' + $add_class + '" style="margin: 0px;line-height: 1.6;">+</div><div id="' + $del_class + '" style="margin: 0px;line-height: 1.6;">-</div></div></div></div>';
                });

            } else {
                if(data.product.products.products_quantity_order_units === '1'  || data.product.products.products_quantity_order_min === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'disabled';
                }
                if (data.product.products.products_quantity > 0) {
                    $classpos = 'active-options';
                    $add_class = 'add-count';
                    $del_class = 'del-count';
                    $inputpos = '';
                    $some_text = 0;
                } else {
                    $classpos = 'disable-options';
                    $inputpos = 'readonly';
                    $add_class = 'add-count-dis';
                    $del_class = 'del-count-dis';
                    $some_text = '';
                }
                $size_html += '<div class="' + $classpos + '" style="width: 50%; overflow: hidden; float: left; margin-bottom:10px;">' +
                    '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">' +
                    '<div style="margin: auto; width: 100%;">' +
                    '<input  '+ $disable_for_stepping +'  ' + $inputpos + ' id="input-count" style="width: 40%;height: 22px; text-align: center; position: relative;top:0px;border-radius: 4px;border:1px solid #CCC;" data-prod="' + data.product.products_id + '" data-name="' + data.product.productsDescription.products_name + '" data-model="' + data.product.products.products_model + '" data-price="' + Math.round(data.product.products.products_price) + '" data-image="' + data.product.products.products_image + '" data-count="' + data.product.products.products_quantity + '" data-step="' + data.product.products.products_quantity_order_units + '" data-min="' + data.product.products.products_quantity_order_min + '" data-attrname="" data-attr="" placeholder="' + $some_text + '" type="text" />' +
                    '<div id="' + $add_class + '" style="margin: 0px;line-height: 1.6;">' +
                    '+</div>' +
                    '<div id="' + $del_class + '" style="margin: 0px;line-height: 1.6;">-' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            }
            $size_html += '</div>';
            $breadcruumpsresult = [];
            $.each(data.catpath['num'], function(i, index){

                $breadcruumpsresult.push('<a href="/catalog?cat='+data.catpath['num'][i]+'">'+data.catpath['name'][i]+'</a>');

            });
            $breadcruumpsresult =  $breadcruumpsresult.join(' &#47; ');

            if(data['product']['products']['products_ordered'] >= 1000){
                $ordered = 'Хит продаж!';
            }else{
                $ordered = 'Заказано: '+data['product']['products']['products_ordered'];
            }
            $href = '';
            if(typeof(seo_urls) != 'undefined' && seo_urls && data['product']['products']['product_seo']){
                $href =   '<a href="/product/' + data['product']['products']['product_seo'] + '" style="color:#007BC1;font-weight: 600;">' +
                'Перейти к полному описанию товара' +
                '</a>';
            }else{
                $href =   '<a href="/product?id=' + data.product.products_id + '" style="color:#007BC1;font-weight: 600;">' +
                'Перейти к полному описанию товара' +
                '</a>';
            }
            $prod_html += '<div class="prod-attr" style="width: 100%; position: relative;float: left; overflow: hidden;">' +
                '<div class="prod-show" style="position: relative; float: left;width: 100%;">' +
                '<div class="col1" style="float: left; width: 50%;position: relative;overflow: hidden; min-width: 430px;margin-left:4px;">' +
                '<div>'+$breadcruumpsresult+'</div>'+
                '<div class="prod-img" style="overflow: hidden; margin-bottom: 10px; max-width: 455px; margin-right: 10px;">' +
                '<div style=" min-width: 380px;">' +
                '<div id="slid" class="carousel slide">' +
                '<div class="carousel-inner">' +
                $bigimg +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="mCustomScrollBox mCS-dark mCSB_vertical mCSB_inside" id="min-img" style="height: 90px; width: 100%;" >' +
                $miniimg +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="col2" style="float: left;width: 340px;position: relative; overflow: hidden;line-height: 1; color: black; font-weight: 400;">' +
                '<div style=" font-weight: 300;">' +
                '<div class="min-opt" style="font-size: 12px; margin-bottom: 19px; text-align:left;">' +
                'Заказано: ' + $ordered +
                '</div>' +
                '<div class="min-opt" style="font-size: 12px; margin-bottom: 19px; text-align:left;">' +
                'Минимальный оптовый заказ: ' + data['product']['products']['products_quantity_order_min'] + ' шт.' +
                '</div>' +
                '<div itemprop="model" class="prod-code" style="width: 100%;float: left; margin-right: 12%; font-size: 12px;margin-bottom: 19px; ">' +
                'Код товара: ' + data['product']['products']['products_model'] +
                '</div>' +
                '<div class="prodname" itemprope="name" style="font-size: 24px;margin-bottom: 15px; text-align: left; ">' +
                data['product']['productsDescription']['products_name'] +
                '</div>' +
                '<a itemprop="url" href="/product?id=' + dp + '">' +
                '</a>' +
                '</div>' +
                '<div class="prod-pricing" style="margin-bottom: 25px;">' +
                '<div style="overflow: hidden;">' +
                '<div class="prod-price-lable" style="font-size: 12px; margin-bottom: 7px;text-align:left;float: left;line-height: 3;">' +
                'Цена' +
                '</div>' +
                '<div class="prod-price" itemprop="price" style="float: right; margin-right: 30px; font-size: 28px; font-weight: 400;margin-bottom: 30px;">' +
                Math.round(data['product']['products']['products_price']) + ' руб' +
                '</div>' +
                '</div>' +
                '<div style="margin-bottom: 20px;">' +
                '<span>' +
                'Размеры' +
                '</span>' +
                '<i style="margin-left: 20px; color:#00a5a1;" class="fa fa-angle-down">' +
                '</i>' +
                '</div>' +
                '<div class="prod-sizes" style="margin: 0 0 38px 0; font-size: 12px; font-weight: 300;padding-bottom: 12px;">' +
                $size_html +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="prod-compos" style="font-size: 12px; width:100%;float: left;padding-left: 10px;">' +
                '<div itemprop="description" id="prd" style="display: block; max-height:340px; overflow:auto; font-size: 12px !important; font-weight: 400 !important; ">' +
                data.product.productsDescription.products_description + ' ' + $spec_html + '' +
                '</div>' +
                '<div>' +
                $href +
                '<span style="float: right;padding-right: 10px;">' +
                'Добавлено: ' + data.product.products.products_date_added +
                '</span>' +
                '</div>' +
                '</div>' +
                '</div>';
            if($('[id="card"]').length > 0) {
                $current = $('[id="card"][itemid=' + data.product.products.products_id + ']').filter('#card').attr('itemid');
                $prev = $('[id="card"][itemid=' + data.product.products.products_id + ']').prev('#card').attr('itemid');
                $next = $('[id="card"][itemid=' + data.product.products.products_id + ']').next('#card').attr('itemid');

                if (typeof($next) != "undefined") {
                    $prevlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; right: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; padding-left: 11px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4;" class="fa fa-chevron-right" data-prod="' + $next + '" id="prod-info"></i>' +
                        '</div>';
                } else {
                    if (!inProgress && document.getElementsByClassName('loader').length != 0) {
                        loaddata();
                    }

                    $prevlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; right: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; padding-left: 11px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4;" class="fa fa-chevron-right" data-prod="' + $current + '" id="prod-info"></i>' +
                        '</div>';

                }


                if (typeof($prev) != "undefined") {
                    $nextlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; left: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4; padding-left: 6px;" class="fa fa-chevron-left" data-prod="' + $prev + '" id="prod-info"></i>' +
                        '</div>';
                } else {
                    $nextlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; left: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4; padding-left: 6px;" class="fa fa-chevron-left" data-prod="' + $current + '" id="prod-info"></i>' +
                        '</div>';
                }
            }else{
                $current = $('[class="inht"][itemid=' + data.product.products.products_id + ']').filter('.inht').attr('itemid');
                $prev = $('[class="inht"][itemid=' + data.product.products.products_id + ']').prev('.inht').attr('itemid');
                $next = $('[class="inht"][itemid=' + data.product.products.products_id + ']').next('.inht').attr('itemid');
                if (typeof($next) != "undefined") {
                    $prevlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; right: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; padding-left: 11px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4;" class="fa fa-chevron-right" data-prod="' + $next + '" id="prod-info"></i>' +
                        '</div>';
                } else {
                    if (!inProgress && document.getElementsByClassName('loader').length != 0) {
                        loaddata();
                    }

                    $prevlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; right: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; padding-left: 11px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4;" class="fa fa-chevron-right" data-prod="' + $current + '" id="prod-info"></i>' +
                        '</div>';

                }
                if (typeof($prev) != "undefined") {
                    $nextlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; left: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4; padding-left: 6px;" class="fa fa-chevron-left" data-prod="' + $prev + '" id="prod-info"></i>' +
                        '</div>';
                } else {
                    $nextlink = '<div style="float: right; position: absolute; height: 35px; width: 38px; z-index: 2147483647; top: 0px; margin: 40% -50px; left: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0% ! important; border-radius: 40px; box-shadow: 1px 1px 1px rgb(204, 204, 204); padding: 40px 40px 0px 0px;">' +
                        '<i style="font-size: 30px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; line-height: 1.4; padding-left: 6px;" class="fa fa-chevron-left" data-prod="' + $current + '" id="prod-info"></i>' +
                        '</div>';
                }
            }
            var  modal_product = function ($prod_html, $prevlink, $nextlink ){
                $('#modal-product').html(
                    '<span id="modal-close">' +
                    '<i class="fa fa-times" style="font-size:24px;"></i>' +
                    '</span>' + $prod_html + '' + $prevlink + '' + $nextlink);
            }
            setTimeout(modal_product($prod_html, $prevlink, $nextlink ),1000)
        });

        var kl = function () {
            $('[id^=carousel-selector-]').on('click', function(){
                var id_selector = $(this).attr("id");
                var id = id_selector.substr(id_selector.length - 1);
                id = parseInt(id);
                $('#slid').carousel(id);
                $('[id^=carousel-selector-]').removeClass('selected');
                $(this).addClass('selected');
                $('[data-cloud='+id+']').CloudZoom({
                    'position' : 'inside'
                });
            });
        };
        var cloud = function () {
            $('[class="cloud-zoom"]').CloudZoom({
                'position' : 'inside'
            });

        };
        $(document).on('load', function(){
            $('a[rel=light]').light();
            $('.target').shortscroll();
        });
        setTimeout(kl, 1000);
        setTimeout(cloud, 1000);
        var cont_top = window.pageYOffset ? window.pageYOffset : document.body.scrollTop;
        $('#overlay')
            .css('display', 'block');
        $('#modal-product')
            .css('display', 'block');
        var cont_top = window.pageYOffset ? window.pageYOffset : document.body.scrollTop;
        $('#modal-product').css('top',cont_top+100);
        lockprodinfo = false;
    }

});

$(document).on('click','#overlay, #modal-close',function(){
    $('#modal-product')
        .html('').hide('');
    $('#overlay')
        .css('display','none');
    $('#time')
        .css('display','none');
});

function changeCart($inputc){
    $ind=$inputc.parent().attr('data-raw');
    if (JSON.parse(localStorage.getItem('cart-om'))) {
        $item = JSON.parse(localStorage.getItem('cart-om'));
        if (typeof ($item.cart) == 'undefined') {
            localStorage.removeItem('cart-om');
            localStorage.removeItem('cart-om-date');
        }
        else{
            $count_id = parseInt($item.cart[$ind][4]);
            $count = parseInt($inputc.val());
            if($count_id < $count){
                if(typeof (ga)!='undefined') {
                    ga('ec:addProduct', {
                        'id': $item.cart[$ind][0],
                        'name': $item.cart[$ind][7],
                        'quantity': $count - $count_id
                    });
                    ga('ec:setAction', 'add');
                    ga('send', 'event', 'UX', 'click', 'add to cart');
                }
            }else if($count_id > $count){
                if(typeof (ga)!='undefined') {
                    ga('ec:addProduct', {
                        'id': $item.cart[$ind][0],
                        'name': $item.cart[$ind][7],
                        'quantity': $count_id - $count
                    });
                    ga('ec:setAction', 'remove');
                    ga('send', 'event', 'UX', 'click', 'remove from cart');
                }
            }
            $item.cart[$ind][4]=$inputc.val();
            $newc=JSON.stringify($item);
            localStorage.setItem('cart-om',$newc);
        }
    }
}
$(document).on('load', function(){
    $('a[rel=light]').light();
});

function getProductCart(){
    $elems=$('.input-count');
    $data=localStorage.getItem('cart-om');
    $comments=$('#comment-cart-save')[0].value;
    if($('#save-chk').hasClass('chk-unchecked')){
        $shara=0;
    }else{
        $shara=1;
    }
    $baseduri = '/savecart';
    $.post($baseduri,{
        'data':$data,
            'public':$shara,
            'comments':$comments,
            '_csrf':yii.getCsrfToken()
    },
        function(data){
            if(data==1){
                alert('Корзина записана');
            }else if(data==2){
                alert('Сохранять корзину могут только зарегистрированные пользователи. Войдите на сайт и попробуйте еще раз')
            }else{
                alert('Ошибка');
            }
        });
}
$(document).on('click','#save-set-btn',function () {
    getProductCart();
});

$(document).on('click','#save-chk',function () {
    if($(this).hasClass('chk-unchecked')){
        $(this).removeClass('chk-unchecked');
    }else{
        $(this).addClass('chk-unchecked');
    }
});

$(document).on('click','#save-set',function(){
    $('#modal-save-set').css('display', 'block');
    $('#overlay-save-cart').css('display','block');
})
$(document).on('click','#overlay-save-cart, #close-cart-save,#save-set-btn',function(){
    $('#modal-save-set').hide();
    $('#overlay-save-cart').hide();
})

$(document).on('click','.share-set',function () {
    $id=$(this).data('id');
    if($(this).hasClass('chk-unchecked')){
        $(this).removeClass('chk-unchecked');
        $data=1;
    }else{
        $(this).addClass('chk-unchecked');
        $data=0;
    }
    $baseduri = '/savecart';
    $.post($baseduri,{'id':$id,'param':'share','data':$data,  '_csrf':yii.getCsrfToken()},
        function(data){
            if(data==1){

            }else if(data==2){

            }else{

            }
        });
});

$(document).on('click','.del-cart-set',function () {
    $id=$(this).data('id');
    $row=$(this).data('row');
    $baseduri = '/savecart';
    $.post($baseduri,{'id':$id,'param':'delete'},
        function(data){
            if(data==1){
                if(localStorage.getItem('cart-set')){
                    $set=JSON.parse(localStorage.getItem('cart-set'));
                    $set.splice($row,1);
                    $set=JSON.stringify($set);
                    localStorage.removeItem('cart-set');
                    localStorage.setItem('cart-set',$set);
                }
                $rows=$('[class="cart-set-row"][data-id="'+$id+'"]');
                $rows.remove();
                $recount=$('[data-row]');
                $.each($recount,function ($i,$item) {
                    $num=parseInt($item.getAttribute('data-row'));
                    $num--;
                    $item.setAttribute('data-row',$num);
                })
            }else if(data==2){

            }else{

            }
        });
});
function drawLeftCart($item){
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
            url: "/product",
            async: false,
            data: {id: this[0]}
        });

        mandata = $.ajax({
            method:'post',
            url: "/manlist",
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
        $innerhtml += '<div data-calc="'+$identypay+'" data-raw="' + ($c) + '" class="cart-row" style="float: left; height: auto; margin: 0px; border-bottom: 1px solid rgb(204, 204, 204); width: 420px;margin-left: 60px; padding: 5px;">' +
            '<div class = "access '+$identypay+'" >'+$access+'</div>'+
            '<a target="_blank" href="/product?id='+requestdata.responseJSON.product.products.products_id+'" class="cart-image" style="float: left; width:120px;height: 180px;"><img style="width: 100%; max-height:100%;" src="/imagepreview?src=' + requestdata.responseJSON.product.products.products_id + '"/></a>' +
            '<div class="cart-row-content" style="overflow:hidden; height:100%;float:left;width:70%;"><div style="width: 95%; margin-left: 5px; float: left; height: 30%;">' +
            '  <div class="cart-model" style="width: 100%; height:100%; font-size:16px;font-weight:300; margin:0; min-width:200px;"><span class="artik" style="color:#399ee4;font-size:12px;">Код: '+requestdata.responseJSON.product.products.products_model +' </span>| <span id="gods-name">'+requestdata.responseJSON.product.productsDescription.products_name+'</span></div>' +
            '</div><div style="width:100%; height:30%; margin:0;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div>' +
            '<div class="cart-amount" style="float: left;width: 100%; margin:0;height:40%; position:relative;">' +
            '<div class="cart-prod-price" style="float: left; height: 100%; width:85px; font-size:18px; font-weight:400;margin-right:60px;">' + parseInt(requestdata.responseJSON.product.products.products_price) + ' руб.</div>'+
            '   <div class="num-of-items" data-raw="' + ($c++) + '" style="position:relative;top:7px;overflow:hidden;">';

        if(typeof(requestdata.responseJSON.product.productsAttributes[this[2]]) !=='undefined'){
            $quan = Math.min(this[4],requestdata.responseJSON.product.productsAttributes[this[2]].quantity);
        }else{
            $quan = Math.min(this[4],requestdata.responseJSON.product.products.products_quantity);
        }
        $innerhtml +='<div id="input-count" class="input-count">'+$quan+'</div>';
        $innerhtml += '</div></div></div></div>'+
            '<div style="float: left; width: 100%;border-bottom: 1px solid #CCC; display: none;">' +
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
}
$(document).on('click','.open-set',function(){
    $row=$(this).data('row');
    if($('[data-row='+$row+'][class=cart-set-content]').is(':visible')) {
        $('[data-row=' + $row + '][class=cart-set-content]').hide();
    }else{
        $('[data-row=' + $row + '][class=cart-set-content]').show();
    }
    $innerhtml='';
    $text=$('[class=cart-set-content][data-row='+$row+']').html();
    $content=JSON.parse($text);
    drawLeftCart($content);
    $('[class=cart-set-content][data-row='+$row+']').html($innerhtml);
})

$(document).on('click','.del-products',function(){
    $id =  $(this).parent().filter('[itemid]').attr('itemid');
    $('[itemid='+$id+']').remove();
    $new_cart = new Object();
    $item = JSON.parse(localStorage.getItem('selected-product-om'));
    $.each($item.products, function(i,item){
        if(item == $id){
            $item.products.splice(i, 1);
        }
    });

    $ilocal = JSON.stringify($item);
    localStorage.setItem('selected-product-om', $ilocal);

});
