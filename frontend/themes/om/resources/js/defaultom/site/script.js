function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
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
function changeOveralPrice(){
    var godsprice = 0;
    var wrapprice = 0;
    var check = $("[name='wrap']").filter(':checked').first();
    if (check.val() == "boxes") wrapprice = 15;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        var c = ((parseInt($(this).find('#input-count').val())) * (parseInt($(this).find('.cart-prod-price').html())));
        godsprice += c;
    });
    $('#gods-price').html(godsprice + ' руб');
    $('#total-price').html(godsprice + wrapprice + ' руб');
    $('#wrap-price').html(wrapprice + ' руб');
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
            ga('send', 'event', 'selected', 'click', 'add to selected product');
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

function renderProduct($prod,$descr,$attrib,$attribdescr,$time,$category, $showdiscount){
    if($category.lenght  ==  0 ) {
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
    if($.inArray($product['manufacturers_id'], ['749','2700','1241','2058','3412','3473','3481','3512']) != -1){
        $man_in_sklad = '<div style="position: absolute; top: 0px; right: 50px;"><img src="/images/logo/ok.png"></div>';
    }else{
        $man_in_sklad = '';
    }
    if ($attr_desc.length > 0) {
        var  innerindex = 0;
        $.each($attr_desc, function (index,value) {
            if($product['products_quantity_order_units'] === '1'  || $product['products_quantity_order_min'] === '1'){
                $disable_for_stepping = '';
            }else{
                $disable_for_stepping = 'disabled';
            }
            if($attr[value['products_options_values_id']]['quantity'] > 0){
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
        $discounthtml += '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 194px; padding: 7px; line-height: 45px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px;">-' + $discount + ' %</div>';
        $discounthtml += '<div style="font-size: 18px; color:#9e9e9e; font-weight: 300; margin: 5px;"  itemprop="old-price" ><strike>' + $product['products_old_price'] + ' руб.</strike></div>';
    }
    $('.bside').append('<div class="container-fluid float" itemscope itemtype="http://schema.org/ProductModel" id="card" itemid="' + $product.products_id+ '">'+$man_in_sklad+
        '<meta itemprop="image" content="/imagepreview?src=' + $product['products_id'] + '">' +
        '<a id="prod-info" data-prod="' + $product.products_id + '" >'+
        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + $product.products_id + ');">'+
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

        '<a itemprop="url" href="/site/product?id=' + $product.products_id+ '"  style="float: right; position: absolute; bottom: 9px; right: 12px; font-size: 12px; font-weight: 500;">'+
        '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
        '</i>'+
        'В карточку'+
        '</a>'+

        ''+$timeprew+''+
        '</div></div>');
}
function renderProduct2($prod,$descr,$attrib,$attribdescr,$time,$category, $showdiscount){
    $catname = $category['name'][$category['name'].length - 1];
    $catnum = $category['num'][$category['num'].length - 1];
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
            if($attr[value['products_options_values_id']]['quantity'] > 0){
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
        $discounthtml += '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 194px; padding: 7px; line-height: 45px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px;">-' + parseInt($discount) + ' %</div>';
    }
    if($product.products_ordered >= 1000){
        $product.products_ordered = 'Хит продаж!';
    }else{
        $product.products_ordered = 'Заказано: '+ $product.products_ordered;
    }
    $('.bside').append('<div class="inht" itemid="' + $product.products_id+ '" itemscope itemtype="http://schema.org/ProductModel"><div class="container-fluid float"  id="card2" >'+$man_in_sklad+
        '<div id="prod-info" data-prod="' + $product.products_id + '" >'+
        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + $product.products_id + ');">'+
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
        '<a itemprop="url" href="/site/product?id=' + $product.products_id+ '"  style="float: right; position: absolute; bottom: 9px; left: 25px; font-size: 12px; font-weight: 500;">'+
        '<i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;">'+
        '</i>'+
        'В карточку'+
        '</a>'+
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
$(document).on('click keydown', '.lock-on', function () {
    $('html').prepend('<div class="preload"><div id="loaderImage"></div></div>');

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
    $('html').prepend('<div class="preload"><div id="loaderImage"></div></div>');
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
            "page": $page,
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
        $('.preload').remove();
        $loader = $('.loader-inner').html();
        $('.pagination-catalog').remove();
        $('.loader-inner').remove();
        if (data[0] != 'Не найдено!') {
            if(getCookie('cardview')==1) {
                $.each(data[0], function (i, item) {
                    ga("ec:addProduct", {
                        "id": this.products['products_id'],
                        "name": this.productsDescription['products_name'],
                        "category": this.catpath.name.join('/'),
                        "list":  window.location.pathname,
                        "brand": this.products['manufacturers_id'],
                        "variant": "none",
                        "position": i});
                    ga("ec:setAction", "ajaxview");
                    ga("send", "event" , "ajaxview", window.location.pathname );
                    renderProduct2(this.products, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], data[14],this.catpath, true)
                });
            }else{
                $.each(data[0], function (i, item) {
                    ga("ec:addProduct", {
                        "id": this.products['products_id'],
                        "name": this.productsDescription['products_name'],
                        "category": this.catpath.name.join('/'),
                        "list":  window.location.pathname,
                        "brand": this.products['manufacturers_id'],
                        "variant": "none",
                        "position": i});
                    ga("ec:setAction", "ajaxview");
                    ga("send", "event" , "ajaxview", window.location.pathname );
                    renderProduct(this.products, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], data[14],this.catpath, true)
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
    $(location).attr('href','/site/lk');
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
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input disabled name="[userinfo]'+$attr+'" title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" data-name="' + $attr + '" class="info-item" data-name="' + $attr + '" value="' + $attrval + '" ></input></div>';
        } else {
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input disabled name="[userinfo]'+$attr+'" title="'  + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" class="info-item" data-name="' + $attr + '" placeholder="' + $attrlable + '"></input></div>';
        }
    });
    $('.address').remove();
    $('.cart-column2').append('<div class="address" style="padding: 0px 10px;">'+$inner + '<div class="order-accept"><strong>Убедительная просьба проверить свой заказ, так как после подтверждения заказа Вами, мы не можем добавлять, удалять или менять размер у позиции в заказе! </strong><br>Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных, а также соглашаетесь с <a target="_blank" href="/page?article=offerta">договором оферты</a>.</div><button class=" btn btn-sm btn-info lock-on" style="border-radius: 4px; text-align: center; width: 100%; margin-bottom: 5px;" type="submit">Подтвердить заказ</button></div>');
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
        $(this).parent().parent().siblings().find('[data-name=state]').val('');
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
$(document).on('click','.product-menu',function() {
    if($('.product-menu-rel').is(':not(:visible)')) {
        jQuery('.product-menu-rel').attr('style', 'display:block');
    }
    else{
        jQuery('.product-menu-rel').attr('style','display:none');
    }});
$(document).on('click', '[data-ajax=time]', function(){
    $.post('/site/timeorderproducts?id='+$(this).attr('data-href'), function( data ) {
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

        $.post('/site/product', {id: dp}, function (data) {
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
                    if(item.quantity>0){
                        $activelabel++;
                    }
                })
            }
            if($activelabel>0) {
                $size_html += '<div data-sale="' + data.product.products_id + '" class="cart-lable" style="left:0">В корзину</div>';
            }else{
                $size_html += '<div class="cart-lable" style="left:0; background: #E9516D;">Продано</div>';
            }

            $imgs = new Array('/site/imagepreview?src=' + data['product']['products']['products_id']);
            $imgs2 = new Array(data['product']['products']['products_image']);
            $.each(data['images'], function(i,index){
                $imgs.push('/site/imagepreview?src=' + data['product']['products']['products_id']+'&amp;sub='+i);
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
            ga("ec:addProduct", {
                "id": data['product']['products']['products_id'],
                "name": data['product']['productsDescription']['products_name'],
                "category": data.catpath.name.join('/'),
                "list":  window.location.pathname,
                "brand": data['product']['products']['manufacturers_id'],
                "variant": "none",
                "position": 0});
            ga("ec:setAction", "popupview");
            ga("send", "event" , "popupview", window.location.pathname );
            ga("ec:addProduct", {
                "id": data['product']['products']['products_id'],
                "name": data['product']['productsDescription']['products_name'],
                "category": data.catpath.name.join('/'),
                "list":  window.location.pathname,
                "brand": data['product']['products']['manufacturers_id'],
                "variant": "none",
                "position": 0});
            ga("ec:setAction", "click");
            ga("send", "event" , "click", window.location.pathname );
            if (typeof (data.product.productsAttributesDescr.keys) == "undefined") {

                if(data.product.products.products_quantity_order_units === '1'  || data.product.products.products_quantity_order_min === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'disabled';
                }

                $.each(data.product.productsAttributesDescr, function (i, item) {
                    if (data.product.productsAttributes[item['products_options_values_id']]['quantity'] > 0) {
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
                '<a itemprop="url" href="/site/product?id=' + dp + '">' +
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
                '<a href="/site/product?id=' + data.product.products_id + '" style="color:#007BC1;font-weight: 600;">' +
                'Перейти к полному описанию товара' +
                '</a>' +
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
                ga('ec:addProduct', {
                    'id': $item.cart[$ind][0],
                    'name': $item.cart[$ind][7],
                    'quantity': $count - $count_id
                });
                ga('ec:setAction', 'add');
                ga('send', 'event', 'UX', 'click', 'add to cart');
            }else if($count_id > $count){
                ga('ec:addProduct', {
                    'id': $item.cart[$ind][0],
                    'name': $item.cart[$ind][7],
                    'quantity': $count_id -$count
                });
                ga('ec:setAction', 'remove');
                ga('send', 'event', 'UX', 'click', 'remove from cart');
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
    $.post($baseduri,{'data':$data,'public':$shara,'comments':$comments},
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
    $.post($baseduri,{'id':$id,'param':'share','data':$data},
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


/**
 * Owl carousel
 * @version 2.0.0
 * @author Bartosz Wojciechowski
 * @license The MIT License (MIT)
 * @todo Lazy Load Icon
 * @todo prevent animationend bubling
 * @todo itemsScaleUp
 * @todo Test Zepto
 * @todo stagePadding calculate wrong active classes
 */
;(function($, window, document, undefined) {

    var drag, state, e;

    /**
     * Template for status information about drag and touch events.
     * @private
     */
    drag = {
        start: 0,
        startX: 0,
        startY: 0,
        current: 0,
        currentX: 0,
        currentY: 0,
        offsetX: 0,
        offsetY: 0,
        distance: null,
        startTime: 0,
        endTime: 0,
        updatedX: 0,
        targetEl: null
    };

    /**
     * Template for some status informations.
     * @private
     */
    state = {
        isTouch: false,
        isScrolling: false,
        isSwiping: false,
        direction: false,
        inMotion: false
    };

    /**
     * Event functions references.
     * @private
     */
    e = {
        _onDragStart: null,
        _onDragMove: null,
        _onDragEnd: null,
        _transitionEnd: null,
        _resizer: null,
        _responsiveCall: null,
        _goToLoop: null,
        _checkVisibile: null
    };

    /**
     * Creates a carousel.
     * @class The Owl Carousel.
     * @public
     * @param {HTMLElement|jQuery} element - The element to create the carousel for.
     * @param {Object} [options] - The options
     */
    function Owl(element, options) {

        /**
         * Current settings for the carousel.
         * @public
         */
        this.settings = null;

        /**
         * Current options set by the caller including defaults.
         * @public
         */
        this.options = $.extend({}, Owl.Defaults, options);

        /**
         * Plugin element.
         * @public
         */
        this.$element = $(element);

        /**
         * Caches informations about drag and touch events.
         */
        this.drag = $.extend({}, drag);

        /**
         * Caches some status informations.
         * @protected
         */
        this.state = $.extend({}, state);

        /**
         * @protected
         * @todo Must be documented
         */
        this.e = $.extend({}, e);

        /**
         * References to the running plugins of this carousel.
         * @protected
         */
        this._plugins = {};

        /**
         * Currently suppressed events to prevent them from beeing retriggered.
         * @protected
         */
        this._supress = {};

        /**
         * Absolute current position.
         * @protected
         */
        this._current = null;

        /**
         * Animation speed in milliseconds.
         * @protected
         */
        this._speed = null;

        /**
         * Coordinates of all items in pixel.
         * @todo The name of this member is missleading.
         * @protected
         */
        this._coordinates = [];

        /**
         * Current breakpoint.
         * @todo Real media queries would be nice.
         * @protected
         */
        this._breakpoint = null;

        /**
         * Current width of the plugin element.
         */
        this._width = null;

        /**
         * All real items.
         * @protected
         */
        this._items = [];

        /**
         * All cloned items.
         * @protected
         */
        this._clones = [];

        /**
         * Merge values of all items.
         * @todo Maybe this could be part of a plugin.
         * @protected
         */
        this._mergers = [];

        /**
         * Invalidated parts within the update process.
         * @protected
         */
        this._invalidated = {};

        /**
         * Ordered list of workers for the update process.
         * @protected
         */
        this._pipe = [];

        $.each(Owl.Plugins, $.proxy(function(key, plugin) {
            this._plugins[key[0].toLowerCase() + key.slice(1)]
                = new plugin(this);
        }, this));

        $.each(Owl.Pipe, $.proxy(function(priority, worker) {
            this._pipe.push({
                'filter': worker.filter,
                'run': $.proxy(worker.run, this)
            });
        }, this));

        this.setup();
        this.initialize();
    }

    /**
     * Default options for the carousel.
     * @public
     */
    Owl.Defaults = {
        items: 3,
        loop: false,
        center: false,

        mouseDrag: true,
        touchDrag: true,
        pullDrag: true,
        freeDrag: false,

        margin: 0,
        stagePadding: 0,

        merge: false,
        mergeFit: true,
        autoWidth: false,

        startPosition: 0,
        rtl: false,

        smartSpeed: 250,
        fluidSpeed: false,
        dragEndSpeed: false,

        responsive: {},
        responsiveRefreshRate: 200,
        responsiveBaseElement: window,
        responsiveClass: false,

        fallbackEasing: 'swing',

        info: false,

        nestedItemSelector: false,
        itemElement: 'div',
        stageElement: 'div',

        // Classes and Names
        themeClass: 'owl-theme',
        baseClass: 'owl-carousel',
        itemClass: 'owl-item',
        centerClass: 'center',
        activeClass: 'active'
    };

    /**
     * Enumeration for width.
     * @public
     * @readonly
     * @enum {String}
     */
    Owl.Width = {
        Default: 'default',
        Inner: 'inner',
        Outer: 'outer'
    };

    /**
     * Contains all registered plugins.
     * @public
     */
    Owl.Plugins = {};

    /**
     * Update pipe.
     */
    Owl.Pipe = [ {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            cache.current = this._items && this._items[this.relative(this._current)];
        }
    }, {
        filter: [ 'items', 'settings' ],
        run: function() {
            var cached = this._clones,
                clones = this.$stage.children('.cloned');

            if (clones.length !== cached.length || (!this.settings.loop && cached.length > 0)) {
                this.$stage.children('.cloned').remove();
                this._clones = [];
            }
        }
    }, {
        filter: [ 'items', 'settings' ],
        run: function() {
            var i, n,
                clones = this._clones,
                items = this._items,
                delta = this.settings.loop ? clones.length - Math.max(this.settings.items * 2, 4) : 0;

            for (i = 0, n = Math.abs(delta / 2); i < n; i++) {
                if (delta > 0) {
                    this.$stage.children().eq(items.length + clones.length - 1).remove();
                    clones.pop();
                    this.$stage.children().eq(0).remove();
                    clones.pop();
                } else {
                    clones.push(clones.length / 2);
                    this.$stage.append(items[clones[clones.length - 1]].clone().addClass('cloned'));
                    clones.push(items.length - 1 - (clones.length - 1) / 2);
                    this.$stage.prepend(items[clones[clones.length - 1]].clone().addClass('cloned'));
                }
            }
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function() {
            var rtl = (this.settings.rtl ? 1 : -1),
                width = (this.width() / this.settings.items).toFixed(3),
                coordinate = 0, merge, i, n;

            this._coordinates = [];
            for (i = 0, n = this._clones.length + this._items.length; i < n; i++) {
                merge = this._mergers[this.relative(i)];
                merge = (this.settings.mergeFit && Math.min(merge, this.settings.items)) || merge;
                coordinate += (this.settings.autoWidth ? this._items[this.relative(i)].width() + this.settings.margin : width * merge) * rtl;

                this._coordinates.push(coordinate);
            }
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function() {
            var i, n, width = (this.width() / this.settings.items).toFixed(3), css = {
                'width': Math.abs(this._coordinates[this._coordinates.length - 1]) + this.settings.stagePadding * 2,
                'padding-left': this.settings.stagePadding || '',
                'padding-right': this.settings.stagePadding || ''
            };

            this.$stage.css(css);

            css = { 'width': this.settings.autoWidth ? 'auto' : width - this.settings.margin };
            css[this.settings.rtl ? 'margin-left' : 'margin-right'] = this.settings.margin;

            if (!this.settings.autoWidth && $.grep(this._mergers, function(v) { return v > 1 }).length > 0) {
                for (i = 0, n = this._coordinates.length; i < n; i++) {
                    css.width = Math.abs(this._coordinates[i]) - Math.abs(this._coordinates[i - 1] || 0) - this.settings.margin;
                    this.$stage.children().eq(i).css(css);
                }
            } else {
                this.$stage.children().css(css);
            }
        }
    }, {
        filter: [ 'width', 'items', 'settings' ],
        run: function(cache) {
            cache.current && this.reset(this.$stage.children().index(cache.current));
        }
    }, {
        filter: [ 'position' ],
        run: function() {
            this.animate(this.coordinates(this._current));
        }
    }, {
        filter: [ 'width', 'position', 'items', 'settings' ],
        run: function() {
            var rtl = this.settings.rtl ? 1 : -1,
                padding = this.settings.stagePadding * 2,
                begin = this.coordinates(this.current()) + padding,
                end = begin + this.width() * rtl,
                inner, outer, matches = [], i, n;

            for (i = 0, n = this._coordinates.length; i < n; i++) {
                inner = this._coordinates[i - 1] || 0;
                outer = Math.abs(this._coordinates[i]) + padding * rtl;

                if ((this.op(inner, '<=', begin) && (this.op(inner, '>', end)))
                    || (this.op(outer, '<', begin) && this.op(outer, '>', end))) {
                    matches.push(i);
                }
            }

            this.$stage.children('.' + this.settings.activeClass).removeClass(this.settings.activeClass);
            this.$stage.children(':eq(' + matches.join('), :eq(') + ')').addClass(this.settings.activeClass);

            if (this.settings.center) {
                this.$stage.children('.' + this.settings.centerClass).removeClass(this.settings.centerClass);
                this.$stage.children().eq(this.current()).addClass(this.settings.centerClass);
            }
        }
    } ];

    /**
     * Initializes the carousel.
     * @protected
     */
    Owl.prototype.initialize = function() {
        this.trigger('initialize');

        this.$element
            .addClass(this.settings.baseClass)
            .addClass(this.settings.themeClass)
            .toggleClass('owl-rtl', this.settings.rtl);

        // check support
        this.browserSupport();

        if (this.settings.autoWidth && this.state.imagesLoaded !== true) {
            var imgs, nestedSelector, width;
            imgs = this.$element.find('img');
            nestedSelector = this.settings.nestedItemSelector ? '.' + this.settings.nestedItemSelector : undefined;
            width = this.$element.children(nestedSelector).width();

            if (imgs.length && width <= 0) {
                this.preloadAutoWidthImages(imgs);
                return false;
            }
        }

        this.$element.addClass('owl-loading');

        // create stage
        this.$stage = $('<' + this.settings.stageElement + ' class="owl-stage"/>')
            .wrap('<div class="owl-stage-outer">');

        // append stage
        this.$element.append(this.$stage.parent());

        // append content
        this.replace(this.$element.children().not(this.$stage.parent()));

        // set view width
        this._width = this.$element.width();

        // update view
        this.refresh();

        this.$element.removeClass('owl-loading').addClass('owl-loaded');

        // attach generic events
        this.eventsCall();

        // attach generic events
        this.internalEvents();

        // attach custom control events
        this.addTriggerableEvents();

        this.trigger('initialized');
    };

    /**
     * Setups the current settings.
     * @todo Remove responsive classes. Why should adaptive designs be brought into IE8?
     * @todo Support for media queries by using `matchMedia` would be nice.
     * @public
     */
    Owl.prototype.setup = function() {
        var viewport = this.viewport(),
            overwrites = this.options.responsive,
            match = -1,
            settings = null;

        if (!overwrites) {
            settings = $.extend({}, this.options);
        } else {
            $.each(overwrites, function(breakpoint) {
                if (breakpoint <= viewport && breakpoint > match) {
                    match = Number(breakpoint);
                }
            });

            settings = $.extend({}, this.options, overwrites[match]);
            delete settings.responsive;

            // responsive class
            if (settings.responsiveClass) {
                this.$element.attr('class', function(i, c) {
                    return c.replace(/\b owl-responsive-\S+/g, '');
                }).addClass('owl-responsive-' + match);
            }
        }

        if (this.settings === null || this._breakpoint !== match) {
            this.trigger('change', { property: { name: 'settings', value: settings } });
            this._breakpoint = match;
            this.settings = settings;
            this.invalidate('settings');
            this.trigger('changed', { property: { name: 'settings', value: this.settings } });
        }
    };

    /**
     * Updates option logic if necessery.
     * @protected
     */
    Owl.prototype.optionsLogic = function() {
        // Toggle Center class
        this.$element.toggleClass('owl-center', this.settings.center);

        // if items number is less than in body
        if (this.settings.loop && this._items.length < this.settings.items) {
            this.settings.loop = false;
        }

        if (this.settings.autoWidth) {
            this.settings.stagePadding = false;
            this.settings.merge = false;
        }
    };

    /**
     * Prepares an item before add.
     * @todo Rename event parameter `content` to `item`.
     * @protected
     * @returns {jQuery|HTMLElement} - The item container.
     */
    Owl.prototype.prepare = function(item) {
        var event = this.trigger('prepare', { content: item });

        if (!event.data) {
            event.data = $('<' + this.settings.itemElement + '/>')
                .addClass(this.settings.itemClass).append(item)
        }

        this.trigger('prepared', { content: event.data });

        return event.data;
    };

    /**
     * Updates the view.
     * @public
     */
    Owl.prototype.update = function() {
        var i = 0,
            n = this._pipe.length,
            filter = $.proxy(function(p) { return this[p] }, this._invalidated),
            cache = {};

        while (i < n) {
            if (this._invalidated.all || $.grep(this._pipe[i].filter, filter).length > 0) {
                this._pipe[i].run(cache);
            }
            i++;
        }

        this._invalidated = {};
    };

    /**
     * Gets the width of the view.
     * @public
     * @param {Owl.Width} [dimension=Owl.Width.Default] - The dimension to return.
     * @returns {Number} - The width of the view in pixel.
     */
    Owl.prototype.width = function(dimension) {
        dimension = dimension || Owl.Width.Default;
        switch (dimension) {
            case Owl.Width.Inner:
            case Owl.Width.Outer:
                return this._width;
            default:
                return this._width - this.settings.stagePadding * 2 + this.settings.margin;
        }
    };

    /**
     * Refreshes the carousel primarily for adaptive purposes.
     * @public
     */
    Owl.prototype.refresh = function() {
        if (this._items.length === 0) {
            return false;
        }

        var start = new Date().getTime();

        this.trigger('refresh');

        this.setup();

        this.optionsLogic();

        // hide and show methods helps here to set a proper widths,
        // this prevents scrollbar to be calculated in stage width
        this.$stage.addClass('owl-refresh');

        this.update();

        this.$stage.removeClass('owl-refresh');

        this.state.orientation = window.orientation;

        this.watchVisibility();

        this.trigger('refreshed');
    };

    /**
     * Save internal event references and add event based functions.
     * @protected
     */
    Owl.prototype.eventsCall = function() {
        // Save events references
        this.e._onDragStart = $.proxy(function(e) {
            this.onDragStart(e);
        }, this);
        this.e._onDragMove = $.proxy(function(e) {
            this.onDragMove(e);
        }, this);
        this.e._onDragEnd = $.proxy(function(e) {
            this.onDragEnd(e);
        }, this);
        this.e._onResize = $.proxy(function(e) {
            this.onResize(e);
        }, this);
        this.e._transitionEnd = $.proxy(function(e) {
            this.transitionEnd(e);
        }, this);
        this.e._preventClick = $.proxy(function(e) {
            this.preventClick(e);
        }, this);
    };

    /**
     * Checks window `resize` event.
     * @protected
     */
    Owl.prototype.onThrottledResize = function() {
        window.clearTimeout(this.resizeTimer);
        this.resizeTimer = window.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate);
    };

    /**
     * Checks window `resize` event.
     * @protected
     */
    Owl.prototype.onResize = function() {
        if (!this._items.length) {
            return false;
        }

        if (this._width === this.$element.width()) {
            return false;
        }

        if (this.trigger('resize').isDefaultPrevented()) {
            return false;
        }

        this._width = this.$element.width();

        this.invalidate('width');

        this.refresh();

        this.trigger('resized');
    };

    /**
     * Checks for touch/mouse drag event type and add run event handlers.
     * @protected
     */
    Owl.prototype.eventsRouter = function(event) {
        var type = event.type;

        if (type === "mousedown" || type === "touchstart") {
            this.onDragStart(event);
        } else if (type === "mousemove" || type === "touchmove") {
            this.onDragMove(event);
        } else if (type === "mouseup" || type === "touchend") {
            this.onDragEnd(event);
        } else if (type === "touchcancel") {
            this.onDragEnd(event);
        }
    };

    /**
     * Checks for touch/mouse drag options and add necessery event handlers.
     * @protected
     */
    Owl.prototype.internalEvents = function() {
        var isTouch = isTouchSupport(),
            isTouchIE = isTouchSupportIE();

        if (this.settings.mouseDrag){
            this.$stage.on('mousedown', $.proxy(function(event) { this.eventsRouter(event) }, this));
            this.$stage.on('dragstart', function() { return false });
            this.$stage.get(0).onselectstart = function() { return false };
        } else {
            this.$element.addClass('owl-text-select-on');
        }

        if (this.settings.touchDrag && !isTouchIE){
            this.$stage.on('touchstart touchcancel', $.proxy(function(event) { this.eventsRouter(event) }, this));
        }

        // catch transitionEnd event
        if (this.transitionEndVendor) {
            this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, false);
        }

        // responsive
        if (this.settings.responsive !== false) {
            this.on(window, 'resize', $.proxy(this.onThrottledResize, this));
        }
    };

    /**
     * Handles touchstart/mousedown event.
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragStart = function(event) {
        var ev, isTouchEvent, pageX, pageY, animatedPos;

        ev = event.originalEvent || event || window.event;

        // prevent right click
        if (ev.which === 3 || this.state.isTouch) {
            return false;
        }

        if (ev.type === 'mousedown') {
            this.$stage.addClass('owl-grab');
        }

        this.trigger('drag');
        this.drag.startTime = new Date().getTime();
        this.speed(0);
        this.state.isTouch = true;
        this.state.isScrolling = false;
        this.state.isSwiping = false;
        this.drag.distance = 0;

        pageX = getTouches(ev).x;
        pageY = getTouches(ev).y;

        // get stage position left
        this.drag.offsetX = this.$stage.position().left;
        this.drag.offsetY = this.$stage.position().top;

        if (this.settings.rtl) {
            this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width()
                + this.settings.margin;
        }

        // catch position // ie to fix
        if (this.state.inMotion && this.support3d) {
            animatedPos = this.getTransformProperty();
            this.drag.offsetX = animatedPos;
            this.animate(animatedPos);
            this.state.inMotion = true;
        } else if (this.state.inMotion && !this.support3d) {
            this.state.inMotion = false;
            return false;
        }

        this.drag.startX = pageX - this.drag.offsetX;
        this.drag.startY = pageY - this.drag.offsetY;

        this.drag.start = pageX - this.drag.startX;
        this.drag.targetEl = ev.target || ev.srcElement;
        this.drag.updatedX = this.drag.start;

        // to do/check
        // prevent links and images dragging;
        if (this.drag.targetEl.tagName === "IMG" || this.drag.targetEl.tagName === "A") {
            this.drag.targetEl.draggable = false;
        }

        $(document).on('mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents', $.proxy(function(event) {this.eventsRouter(event)},this));
    };

    /**
     * Handles the touchmove/mousemove events.
     * @todo Simplify
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.onDragMove = function(event) {
        var ev, isTouchEvent, pageX, pageY, minValue, maxValue, pull;

        if (!this.state.isTouch) {
            return;
        }

        if (this.state.isScrolling) {
            return;
        }

        ev = event.originalEvent || event || window.event;

        pageX = getTouches(ev).x;
        pageY = getTouches(ev).y;

        // Drag Direction
        this.drag.currentX = pageX - this.drag.startX;
        this.drag.currentY = pageY - this.drag.startY;
        this.drag.distance = this.drag.currentX - this.drag.offsetX;

        // Check move direction
        if (this.drag.distance < 0) {
            this.state.direction = this.settings.rtl ? 'right' : 'left';
        } else if (this.drag.distance > 0) {
            this.state.direction = this.settings.rtl ? 'left' : 'right';
        }
        // Loop
        if (this.settings.loop) {
            if (this.op(this.drag.currentX, '>', this.coordinates(this.minimum())) && this.state.direction === 'right') {
                this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
            } else if (this.op(this.drag.currentX, '<', this.coordinates(this.maximum())) && this.state.direction === 'left') {
                this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length);
            }
        } else {
            // pull
            minValue = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum());
            maxValue = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum());
            pull = this.settings.pullDrag ? this.drag.distance / 5 : 0;
            this.drag.currentX = Math.max(Math.min(this.drag.currentX, minValue + pull), maxValue + pull);
        }

        // Lock browser if swiping horizontal

        if ((this.drag.distance > 8 || this.drag.distance < -8)) {
            if (ev.preventDefault !== undefined) {
                ev.preventDefault();
            } else {
                ev.returnValue = false;
            }
            this.state.isSwiping = true;
        }

        this.drag.updatedX = this.drag.currentX;

        // Lock Owl if scrolling
        if ((this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === false) {
            this.state.isScrolling = true;
            this.drag.updatedX = this.drag.start;
        }

        this.animate(this.drag.updatedX);
    };

    /**
     * Handles the touchend/mouseup events.
     * @protected
     */
    Owl.prototype.onDragEnd = function(event) {
        var compareTimes, distanceAbs, closest;

        if (!this.state.isTouch) {
            return;
        }

        if (event.type === 'mouseup') {
            this.$stage.removeClass('owl-grab');
        }

        this.trigger('dragged');

        // prevent links and images dragging;
        this.drag.targetEl.removeAttribute("draggable");

        // remove drag event listeners

        this.state.isTouch = false;
        this.state.isScrolling = false;
        this.state.isSwiping = false;

        // to check
        if (this.drag.distance === 0 && this.state.inMotion !== true) {
            this.state.inMotion = false;
            return false;
        }

        // prevent clicks while scrolling

        this.drag.endTime = new Date().getTime();
        compareTimes = this.drag.endTime - this.drag.startTime;
        distanceAbs = Math.abs(this.drag.distance);

        // to test
        if (distanceAbs > 3 || compareTimes > 300) {
            this.removeClick(this.drag.targetEl);
        }

        closest = this.closest(this.drag.updatedX);

        this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed);
        this.current(closest);
        this.invalidate('position');
        this.update();

        // if pullDrag is off then fire transitionEnd event manually when stick
        // to border
        if (!this.settings.pullDrag && this.drag.updatedX === this.coordinates(closest)) {
            this.transitionEnd();
        }

        this.drag.distance = 0;

        $(document).off('.owl.dragEvents');
    };

    /**
     * Attaches `preventClick` to disable link while swipping.
     * @protected
     * @param {HTMLElement} [target] - The target of the `click` event.
     */
    Owl.prototype.removeClick = function(target) {
        this.drag.targetEl = target;
        $(target).on('click.preventClick', this.e._preventClick);
        // to make sure click is removed:
        window.setTimeout(function() {
            $(target).off('click.preventClick');
        }, 300);
    };

    /**
     * Suppresses click event.
     * @protected
     * @param {Event} ev - The event arguments.
     */
    Owl.prototype.preventClick = function(ev) {
        if (ev.preventDefault) {
            ev.preventDefault();
        } else {
            ev.returnValue = false;
        }
        if (ev.stopPropagation) {
            ev.stopPropagation();
        }
        $(ev.target).off('click.preventClick');
    };

    /**
     * Catches stage position while animate (only CSS3).
     * @protected
     * @returns
     */
    Owl.prototype.getTransformProperty = function() {
        var transform, matrix3d;

        transform = window.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + 'transform');
        // var transform = this.$stage.css(this.vendorName + 'transform')
        transform = transform.replace(/matrix(3d)?\(|\)/g, '').split(',');
        matrix3d = transform.length === 16;

        return matrix3d !== true ? transform[4] : transform[12];
    };

    /**
     * Gets absolute position of the closest item for a coordinate.
     * @todo Setting `freeDrag` makes `closest` not reusable. See #165.
     * @protected
     * @param {Number} coordinate - The coordinate in pixel.
     * @return {Number} - The absolute position of the closest item.
     */
    Owl.prototype.closest = function(coordinate) {
        var position = -1, pull = 30, width = this.width(), coordinates = this.coordinates();

        if (!this.settings.freeDrag) {
            // check closest item
            $.each(coordinates, $.proxy(function(index, value) {
                if (coordinate > value - pull && coordinate < value + pull) {
                    position = index;
                } else if (this.op(coordinate, '<', value)
                    && this.op(coordinate, '>', coordinates[index + 1] || value - width)) {
                    position = this.state.direction === 'left' ? index + 1 : index;
                }
                return position === -1;
            }, this));
        }

        if (!this.settings.loop) {
            // non loop boundries
            if (this.op(coordinate, '>', coordinates[this.minimum()])) {
                position = coordinate = this.minimum();
            } else if (this.op(coordinate, '<', coordinates[this.maximum()])) {
                position = coordinate = this.maximum();
            }
        }

        return position;
    };

    /**
     * Animates the stage.
     * @public
     * @param {Number} coordinate - The coordinate in pixels.
     */
    Owl.prototype.animate = function(coordinate) {
        this.trigger('translate');
        this.state.inMotion = this.speed() > 0;

        if (this.support3d) {
            this.$stage.css({
                transform: 'translate3d(' + coordinate + 'px' + ',0px, 0px)',
                transition: (this.speed() / 1000) + 's'
            });
        } else if (this.state.isTouch) {
            this.$stage.css({
                left: coordinate + 'px'
            });
        } else {
            this.$stage.animate({
                left: coordinate
            }, this.speed() / 1000, this.settings.fallbackEasing, $.proxy(function() {
                if (this.state.inMotion) {
                    this.transitionEnd();
                }
            }, this));
        }
    };

    /**
     * Sets the absolute position of the current item.
     * @public
     * @param {Number} [position] - The new absolute position or nothing to leave it unchanged.
     * @returns {Number} - The absolute position of the current item.
     */
    Owl.prototype.current = function(position) {
        if (position === undefined) {
            return this._current;
        }

        if (this._items.length === 0) {
            return undefined;
        }

        position = this.normalize(position);

        if (this._current !== position) {
            var event = this.trigger('change', { property: { name: 'position', value: position } });

            if (event.data !== undefined) {
                position = this.normalize(event.data);
            }

            this._current = position;

            this.invalidate('position');

            this.trigger('changed', { property: { name: 'position', value: this._current } });
        }

        return this._current;
    };

    /**
     * Invalidates the given part of the update routine.
     * @param {String} part - The part to invalidate.
     */
    Owl.prototype.invalidate = function(part) {
        this._invalidated[part] = true;
    }

    /**
     * Resets the absolute position of the current item.
     * @public
     * @param {Number} position - The absolute position of the new item.
     */
    Owl.prototype.reset = function(position) {
        position = this.normalize(position);

        if (position === undefined) {
            return;
        }

        this._speed = 0;
        this._current = position;

        this.suppress([ 'translate', 'translated' ]);

        this.animate(this.coordinates(position));

        this.release([ 'translate', 'translated' ]);
    };

    /**
     * Normalizes an absolute or a relative position for an item.
     * @public
     * @param {Number} position - The absolute or relative position to normalize.
     * @param {Boolean} [relative=false] - Whether the given position is relative or not.
     * @returns {Number} - The normalized position.
     */
    Owl.prototype.normalize = function(position, relative) {
        var n = (relative ? this._items.length : this._items.length + this._clones.length);

        if (!$.isNumeric(position) || n < 1) {
            return undefined;
        }

        if (this._clones.length) {
            position = ((position % n) + n) % n;
        } else {
            position = Math.max(this.minimum(relative), Math.min(this.maximum(relative), position));
        }

        return position;
    };

    /**
     * Converts an absolute position for an item into a relative position.
     * @public
     * @param {Number} position - The absolute position to convert.
     * @returns {Number} - The converted position.
     */
    Owl.prototype.relative = function(position) {
        position = this.normalize(position);
        position = position - this._clones.length / 2;
        return this.normalize(position, true);
    };

    /**
     * Gets the maximum position for an item.
     * @public
     * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
     * @returns {Number}
     */
    Owl.prototype.maximum = function(relative) {
        var maximum, width, i = 0, coordinate,
            settings = this.settings;

        if (relative) {
            return this._items.length - 1;
        }

        if (!settings.loop && settings.center) {
            maximum = this._items.length - 1;
        } else if (!settings.loop && !settings.center) {
            maximum = this._items.length - settings.items;
        } else if (settings.loop || settings.center) {
            maximum = this._items.length + settings.items;
        } else if (settings.autoWidth || settings.merge) {
            revert = settings.rtl ? 1 : -1;
            width = this.$stage.width() - this.$element.width();
            while (coordinate = this.coordinates(i)) {
                if (coordinate * revert >= width) {
                    break;
                }
                maximum = ++i;
            }
        } else {
            throw 'Can not detect maximum absolute position.'
        }

        return maximum;
    };

    /**
     * Gets the minimum position for an item.
     * @public
     * @param {Boolean} [relative=false] - Whether to return an absolute position or a relative position.
     * @returns {Number}
     */
    Owl.prototype.minimum = function(relative) {
        if (relative) {
            return 0;
        }

        return this._clones.length / 2;
    };

    /**
     * Gets an item at the specified relative position.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
     */
    Owl.prototype.items = function(position) {
        if (position === undefined) {
            return this._items.slice();
        }

        position = this.normalize(position, true);
        return this._items[position];
    };

    /**
     * Gets an item at the specified relative position.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @return {jQuery|Array.<jQuery>} - The item at the given position or all items if no position was given.
     */
    Owl.prototype.mergers = function(position) {
        if (position === undefined) {
            return this._mergers.slice();
        }

        position = this.normalize(position, true);
        return this._mergers[position];
    };

    /**
     * Gets the absolute positions of clones for an item.
     * @public
     * @param {Number} [position] - The relative position of the item.
     * @returns {Array.<Number>} - The absolute positions of clones for the item or all if no position was given.
     */
    Owl.prototype.clones = function(position) {
        var odd = this._clones.length / 2,
            even = odd + this._items.length,
            map = function(index) { return index % 2 === 0 ? even + index / 2 : odd - (index + 1) / 2 };

        if (position === undefined) {
            return $.map(this._clones, function(v, i) { return map(i) });
        }

        return $.map(this._clones, function(v, i) { return v === position ? map(i) : null });
    };

    /**
     * Sets the current animation speed.
     * @public
     * @param {Number} [speed] - The animation speed in milliseconds or nothing to leave it unchanged.
     * @returns {Number} - The current animation speed in milliseconds.
     */
    Owl.prototype.speed = function(speed) {
        if (speed !== undefined) {
            this._speed = speed;
        }

        return this._speed;
    };

    /**
     * Gets the coordinate of an item.
     * @todo The name of this method is missleanding.
     * @public
     * @param {Number} position - The absolute position of the item within `minimum()` and `maximum()`.
     * @returns {Number|Array.<Number>} - The coordinate of the item in pixel or all coordinates.
     */
    Owl.prototype.coordinates = function(position) {
        var coordinate = null;

        if (position === undefined) {
            return $.map(this._coordinates, $.proxy(function(coordinate, index) {
                return this.coordinates(index);
            }, this));
        }

        if (this.settings.center) {
            coordinate = this._coordinates[position];
            coordinate += (this.width() - coordinate + (this._coordinates[position - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1);
        } else {
            coordinate = this._coordinates[position - 1] || 0;
        }

        return coordinate;
    };

    /**
     * Calculates the speed for a translation.
     * @protected
     * @param {Number} from - The absolute position of the start item.
     * @param {Number} to - The absolute position of the target item.
     * @param {Number} [factor=undefined] - The time factor in milliseconds.
     * @returns {Number} - The time in milliseconds for the translation.
     */
    Owl.prototype.duration = function(from, to, factor) {
        return Math.min(Math.max(Math.abs(to - from), 1), 6) * Math.abs((factor || this.settings.smartSpeed));
    };

    /**
     * Slides to the specified item.
     * @public
     * @param {Number} position - The position of the item.
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.to = function(position, speed) {
        if (this.settings.loop) {
            var distance = position - this.relative(this.current()),
                revert = this.current(),
                before = this.current(),
                after = this.current() + distance,
                direction = before - after < 0 ? true : false,
                items = this._clones.length + this._items.length;

            if (after < this.settings.items && direction === false) {
                revert = before + this._items.length;
                this.reset(revert);
            } else if (after >= items - this.settings.items && direction === true) {
                revert = before - this._items.length;
                this.reset(revert);
            }
            window.clearTimeout(this.e._goToLoop);
            this.e._goToLoop = window.setTimeout($.proxy(function() {
                this.speed(this.duration(this.current(), revert + distance, speed));
                this.current(revert + distance);
                this.update();
            }, this), 30);
        } else {
            this.speed(this.duration(this.current(), position, speed));
            this.current(position);
            this.update();
        }
    };

    /**
     * Slides to the next item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.next = function(speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) + 1, speed);
    };

    /**
     * Slides to the previous item.
     * @public
     * @param {Number} [speed] - The time in milliseconds for the transition.
     */
    Owl.prototype.prev = function(speed) {
        speed = speed || false;
        this.to(this.relative(this.current()) - 1, speed);
    };

    /**
     * Handles the end of an animation.
     * @protected
     * @param {Event} event - The event arguments.
     */
    Owl.prototype.transitionEnd = function(event) {

        // if css2 animation then event object is undefined
        if (event !== undefined) {
            event.stopPropagation();

            // Catch only owl-stage transitionEnd event
            if ((event.target || event.srcElement || event.originalTarget) !== this.$stage.get(0)) {
                return false;
            }
        }

        this.state.inMotion = false;
        this.trigger('translated');
    };

    /**
     * Gets viewport width.
     * @protected
     * @return {Number} - The width in pixel.
     */
    Owl.prototype.viewport = function() {
        var width;
        if (this.options.responsiveBaseElement !== window) {
            width = $(this.options.responsiveBaseElement).width();
        } else if (window.innerWidth) {
            width = window.innerWidth;
        } else if (document.documentElement && document.documentElement.clientWidth) {
            width = document.documentElement.clientWidth;
        } else {
            throw 'Can not detect viewport width.';
        }
        return width;
    };

    /**
     * Replaces the current content.
     * @public
     * @param {HTMLElement|jQuery|String} content - The new content.
     */
    Owl.prototype.replace = function(content) {
        this.$stage.empty();
        this._items = [];

        if (content) {
            content = (content instanceof jQuery) ? content : $(content);
        }

        if (this.settings.nestedItemSelector) {
            content = content.find('.' + this.settings.nestedItemSelector);
        }

        content.filter(function() {
            return this.nodeType === 1;
        }).each($.proxy(function(index, item) {
            item = this.prepare(item);
            this.$stage.append(item);
            this._items.push(item);
            this._mergers.push(item.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
        }, this));

        this.reset($.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0);

        this.invalidate('items');
    };

    /**
     * Adds an item.
     * @todo Use `item` instead of `content` for the event arguments.
     * @public
     * @param {HTMLElement|jQuery|String} content - The item content to add.
     * @param {Number} [position] - The relative position at which to insert the item otherwise the item will be added to the end.
     */
    Owl.prototype.add = function(content, position) {
        position = position === undefined ? this._items.length : this.normalize(position, true);

        this.trigger('add', { content: content, position: position });

        if (this._items.length === 0 || position === this._items.length) {
            this.$stage.append(content);
            this._items.push(content);
            this._mergers.push(content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
        } else {
            this._items[position].before(content);
            this._items.splice(position, 0, content);
            this._mergers.splice(position, 0, content.find('[data-merge]').andSelf('[data-merge]').attr('data-merge') * 1 || 1);
        }

        this.invalidate('items');

        this.trigger('added', { content: content, position: position });
    };

    /**
     * Removes an item by its position.
     * @todo Use `item` instead of `content` for the event arguments.
     * @public
     * @param {Number} position - The relative position of the item to remove.
     */
    Owl.prototype.remove = function(position) {
        position = this.normalize(position, true);

        if (position === undefined) {
            return;
        }

        this.trigger('remove', { content: this._items[position], position: position });

        this._items[position].remove();
        this._items.splice(position, 1);
        this._mergers.splice(position, 1);

        this.invalidate('items');

        this.trigger('removed', { content: null, position: position });
    };

    /**
     * Adds triggerable events.
     * @protected
     */
    Owl.prototype.addTriggerableEvents = function() {
        var handler = $.proxy(function(callback, event) {
            return $.proxy(function(e) {
                if (e.relatedTarget !== this) {
                    this.suppress([ event ]);
                    callback.apply(this, [].slice.call(arguments, 1));
                    this.release([ event ]);
                }
            }, this);
        }, this);

        $.each({
            'next': this.next,
            'prev': this.prev,
            'to': this.to,
            'destroy': this.destroy,
            'refresh': this.refresh,
            'replace': this.replace,
            'add': this.add,
            'remove': this.remove
        }, $.proxy(function(event, callback) {
            this.$element.on(event + '.owl.carousel', handler(callback, event + '.owl.carousel'));
        }, this));

    };

    /**
     * Watches the visibility of the carousel element.
     * @protected
     */
    Owl.prototype.watchVisibility = function() {

        // test on zepto
        if (!isElVisible(this.$element.get(0))) {
            this.$element.addClass('owl-hidden');
            window.clearInterval(this.e._checkVisibile);
            this.e._checkVisibile = window.setInterval($.proxy(checkVisible, this), 500);
        }

        function isElVisible(el) {
            return el.offsetWidth > 0 && el.offsetHeight > 0;
        }

        function checkVisible() {
            if (isElVisible(this.$element.get(0))) {
                this.$element.removeClass('owl-hidden');
                this.refresh();
                window.clearInterval(this.e._checkVisibile);
            }
        }
    };

    /**
     * Preloads images with auto width.
     * @protected
     * @todo Still to test
     */
    Owl.prototype.preloadAutoWidthImages = function(imgs) {
        var loaded, that, $el, img;

        loaded = 0;
        that = this;
        imgs.each(function(i, el) {
            $el = $(el);
            img = new Image();

            img.onload = function() {
                loaded++;
                $el.attr('src', img.src);
                $el.css('opacity', 1);
                if (loaded >= imgs.length) {
                    that.state.imagesLoaded = true;
                    that.initialize();
                }
            };

            img.src = $el.attr('src') || $el.attr('data-src') || $el.attr('data-src-retina');
        });
    };

    /**
     * Destroys the carousel.
     * @public
     */
    Owl.prototype.destroy = function() {

        if (this.$element.hasClass(this.settings.themeClass)) {
            this.$element.removeClass(this.settings.themeClass);
        }

        if (this.settings.responsive !== false) {
            $(window).off('resize.owl.carousel');
        }

        if (this.transitionEndVendor) {
            this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
        }

        for ( var i in this._plugins) {
            this._plugins[i].destroy();
        }

        if (this.settings.mouseDrag || this.settings.touchDrag) {
            this.$stage.off('mousedown touchstart touchcancel');
            $(document).off('.owl.dragEvents');
            this.$stage.get(0).onselectstart = function() {};
            this.$stage.off('dragstart', function() { return false });
        }

        // remove event handlers in the ".owl.carousel" namespace
        this.$element.off('.owl');

        this.$stage.children('.cloned').remove();
        this.e = null;
        this.$element.removeData('owlCarousel');

        this.$stage.children().contents().unwrap();
        this.$stage.children().unwrap();
        this.$stage.unwrap();
    };

    /**
     * Operators to calculate right-to-left and left-to-right.
     * @protected
     * @param {Number} [a] - The left side operand.
     * @param {String} [o] - The operator.
     * @param {Number} [b] - The right side operand.
     */
    Owl.prototype.op = function(a, o, b) {
        var rtl = this.settings.rtl;
        switch (o) {
            case '<':
                return rtl ? a > b : a < b;
            case '>':
                return rtl ? a < b : a > b;
            case '>=':
                return rtl ? a <= b : a >= b;
            case '<=':
                return rtl ? a >= b : a <= b;
            default:
                break;
        }
    };

    /**
     * Attaches to an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The event handler to attach.
     * @param {Boolean} capture - Wether the event should be handled at the capturing phase or not.
     */
    Owl.prototype.on = function(element, event, listener, capture) {
        if (element.addEventListener) {
            element.addEventListener(event, listener, capture);
        } else if (element.attachEvent) {
            element.attachEvent('on' + event, listener);
        }
    };

    /**
     * Detaches from an internal event.
     * @protected
     * @param {HTMLElement} element - The event source.
     * @param {String} event - The event name.
     * @param {Function} listener - The attached event handler to detach.
     * @param {Boolean} capture - Wether the attached event handler was registered as a capturing listener or not.
     */
    Owl.prototype.off = function(element, event, listener, capture) {
        if (element.removeEventListener) {
            element.removeEventListener(event, listener, capture);
        } else if (element.detachEvent) {
            element.detachEvent('on' + event, listener);
        }
    };

    /**
     * Triggers an public event.
     * @protected
     * @param {String} name - The event name.
     * @param {*} [data=null] - The event data.
     * @param {String} [namespace=.owl.carousel] - The event namespace.
     * @returns {Event} - The event arguments.
     */
    Owl.prototype.trigger = function(name, data, namespace) {
        var status = {
            item: { count: this._items.length, index: this.current() }
        }, handler = $.camelCase(
            $.grep([ 'on', name, namespace ], function(v) { return v })
                .join('-').toLowerCase()
        ), event = $.Event(
            [ name, 'owl', namespace || 'carousel' ].join('.').toLowerCase(),
            $.extend({ relatedTarget: this }, status, data)
        );

        if (!this._supress[name]) {
            $.each(this._plugins, function(name, plugin) {
                if (plugin.onTrigger) {
                    plugin.onTrigger(event);
                }
            });

            this.$element.trigger(event);

            if (this.settings && typeof this.settings[handler] === 'function') {
                this.settings[handler].apply(this, event);
            }
        }

        return event;
    };

    /**
     * Suppresses events.
     * @protected
     * @param {Array.<String>} events - The events to suppress.
     */
    Owl.prototype.suppress = function(events) {
        $.each(events, $.proxy(function(index, event) {
            this._supress[event] = true;
        }, this));
    }

    /**
     * Releases suppressed events.
     * @protected
     * @param {Array.<String>} events - The events to release.
     */
    Owl.prototype.release = function(events) {
        $.each(events, $.proxy(function(index, event) {
            delete this._supress[event];
        }, this));
    }

    /**
     * Checks the availability of some browser features.
     * @protected
     */
    Owl.prototype.browserSupport = function() {
        this.support3d = isPerspective();

        if (this.support3d) {
            this.transformVendor = isTransform();

            // take transitionend event name by detecting transition
            var endVendors = [ 'transitionend', 'webkitTransitionEnd', 'transitionend', 'oTransitionEnd' ];
            this.transitionEndVendor = endVendors[isTransition()];

            // take vendor name from transform name
            this.vendorName = this.transformVendor.replace(/Transform/i, '');
            this.vendorName = this.vendorName !== '' ? '-' + this.vendorName.toLowerCase() + '-' : '';
        }

        this.state.orientation = window.orientation;
    };

    /**
     * Get touch/drag coordinats.
     * @private
     * @param {event} - mousedown/touchstart event
     * @returns {object} - Contains X and Y of current mouse/touch position
     */

    function getTouches(event) {
        if (event.touches !== undefined) {
            return {
                x: event.touches[0].pageX,
                y: event.touches[0].pageY
            };
        }

        if (event.touches === undefined) {
            if (event.pageX !== undefined) {
                return {
                    x: event.pageX,
                    y: event.pageY
                };
            }

            if (event.pageX === undefined) {
                return {
                    x: event.clientX,
                    y: event.clientY
                };
            }
        }
    }

    /**
     * Checks for CSS support.
     * @private
     * @param {Array} array - The CSS properties to check for.
     * @returns {Array} - Contains the supported CSS property name and its index or `false`.
     */
    function isStyleSupported(array) {
        var p, s, fake = document.createElement('div'), list = array;
        for (p in list) {
            s = list[p];
            if (typeof fake.style[s] !== 'undefined') {
                fake = null;
                return [ s, p ];
            }
        }
        return [ false ];
    }

    /**
     * Checks for CSS transition support.
     * @private
     * @todo Realy bad design
     * @returns {Number}
     */
    function isTransition() {
        return isStyleSupported([ 'transition', 'WebkitTransition', 'MozTransition', 'OTransition' ])[1];
    }

    /**
     * Checks for CSS transform support.
     * @private
     * @returns {String} The supported property name or false.
     */
    function isTransform() {
        return isStyleSupported([ 'transform', 'WebkitTransform', 'MozTransform', 'OTransform', 'msTransform' ])[0];
    }

    /**
     * Checks for CSS perspective support.
     * @private
     * @returns {String} The supported property name or false.
     */
    function isPerspective() {
        return isStyleSupported([ 'perspective', 'webkitPerspective', 'MozPerspective', 'OPerspective', 'MsPerspective' ])[0];
    }

    /**
     * Checks wether touch is supported or not.
     * @private
     * @returns {Boolean}
     */
    function isTouchSupport() {
        return 'ontouchstart' in window || !!(navigator.msMaxTouchPoints);
    }

    /**
     * Checks wether touch is supported or not for IE.
     * @private
     * @returns {Boolean}
     */
    function isTouchSupportIE() {
        return window.navigator.msPointerEnabled;
    }

    /**
     * The jQuery Plugin for the Owl Carousel
     * @public
     */
    $.fn.owlCarousel = function(options) {
        return this.each(function() {
            if (!$(this).data('owlCarousel')) {
                $(this).data('owlCarousel', new Owl(this, options));
            }
        });
    };

    /**
     * The constructor for the jQuery Plugin
     * @public
     */
    $.fn.owlCarousel.Constructor = Owl;

})(window.Zepto || window.jQuery, window, document);