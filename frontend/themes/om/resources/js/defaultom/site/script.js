
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

$(document).on('click', '.cart-image', function () {
    $('.image').attr('style', 'display:block;');
});
$(document).on('click', '#image-img, .image', function () {
    $('.image').attr('style', 'display:none;');
});
$(document).on('click', '.close-descript', function () {
    $('#prod-card-info').dialog('close');
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
$(document).on('click', '.del-product', function () {
    $delrow = $(this).parent().attr('data-raw');
    $new_cart = new Object();
    $item = JSON.parse(localStorage.getItem('cart-om'));
    $array_splice = $item.cart;
    $array_splice.splice($delrow, 1);
    $nums=[];
    $('[id=input-count]').each(function(index,value){
        $nums.push(value.value);
    });
    $nums.splice($delrow, 1);
    $new_cart.cart = $array_splice;
    $ilocal = JSON.stringify($new_cart);
    localStorage.setItem('cart-om', $ilocal);
    $innerhtml = '';
    $c = 0;
    $amount_prod = 0;
    $cart_price = 0;

    $.each($array_splice, function (index) {
        this[4] = $nums[index];
        $amount_prod = $amount_prod + parseInt(this[4]);
        $cart_price = $cart_price + (parseInt(this[3]) * parseInt(this[4]));
        if (this[6] == 'undefined') {
            this[6] = 'Без размера'
        } else {
            this[6] = this[6] + ' размер';
        }
        $innerhtml += '<div data-raw="' + ($c++) + '" class="cart-row" style="height: 200px; width:100%; border-bottom:1px solid #ccc;margin:0;padding:10px 0 10px 10px;">' +
            '<div class="cart-image" style="float: left; width:120px;"><img style="width: 100%; max-height:100%;" src="/site/imagepreview?src=' + this[5] + '"/></div>' +
            '<div style="overflow:hidden; height:100%;float:left;width:70%;min-width:350px;"><div style="width: 95%; margin-left: 5px; float: left; height: 30%;">' +
            '  <div class="cart-model" style="width: 100%; height:100%; font-size:16px;font-weight:300; margin:0; min-width:200px;"><span class="artik" style="color:#399ee4;font-size:12px;">Код: '+this[1] +' </span>| '+this[7]+'</div>' +
            '</div><div style="width:100%; height:30%; margin:0;" data-attr="' + this[2] + '" class="cart-attr">' + this[6] + '</div>' +
            '<div class="cart-amount" style="float: left;width: 100%; margin:0;height:40%; position:relative;">' +
            '<div class="cart-prod-price" style="float: left; height: 100%; width:85px; font-size:18px; font-weight:400;margin-right:60px;">' + parseInt(this[3]) + ' руб.</div>'+
            '   <div class="num-of-items" style="position:relative;top:7px;overflow:hidden;"><div id="del-count" style=" line-height:1.5;" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-id="'+$c+'">-</div>' +
            '   <input id="input-count" style="width: 50px;float: left;margin:0 3px;height: 22px; text-align:center; border:none; background-color:#f5f5f5;" data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-min="'+this[9]['min']+'" data-step="'+this[8]['step']+'"  data-id="'+$c+'" value="' + this[4] + '">' +
            '   <div id="add-count" style="float: left; line-height:1.5;"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'"  data-id="'+$c+'" data-min="'+this[9]['min']+'" data-step="'+this[8]['step']+'">+</div></div>' +
            '</div></div>' +
            '<div class="del-product" style="width: 12px; margin-left:5px; float: left; position:relative; top:35%;color:#ea516d;"  data-prod="'+this[0]+'" data-model="'+this[1]+'" data-attr="'+this[2]+'" data-price="'+parseInt(this[3])+'" data-image="'+this[5]+'" data-attrname="'+this[6]+'" data-name="'+this[7]+'" data-min="'+this[9]['min']+'" data-step="'+this[8]['step']+'"  data-id="'+$c+'"><i class="fa fa-times"></i></div></div>';
    });
    $innerhtml+='</div>';
    $('.cart-column1').html($innerhtml);
    $(".cart-count").html($amount_prod);
    $(".cart-price").html($cart_price + ' руб.');
    var godsprice=0;
    var wrapprice=0;
    var check = $("[name='wrap']").filter(':checked').first();
    console.log();
    if(check.val()=="boxes") wrapprice=15;

    $indexes = $(".cart-row");
    $.each($indexes, function () {
        var c=((parseInt($(this).find('#input-count').val()))*(parseInt($(this).find('.cart-prod-price').html())));
        godsprice+=c;
    });
    $('#gods-price').html(godsprice+' руб');
    $('#total-price').html(godsprice+wrapprice+' руб');
    $('#wrap-price').html(wrapprice+' руб');
});
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
                $timenow  =  new Date;
                if(localStorage.getItem('cart-om-date')){
                    $timecart =  new Date;
                    $timecart = localStorage.getItem('cart-om-date');
                    console.log($timenow.getTime() - $timecart);
                    if($timenow.getTime() - $timecart > 604800000){
                        localStorage.removeItem('cart-om');
                        localStorage.removeItem('cart-om-date');
                        return false;
                    }
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
                $.each($item.cart, function () {
                    if ($item_add.getAttribute('data-prod') == this[0] && $item_add.getAttribute('data-model') == this[1] && $item_add.getAttribute('data-attr') == this[2]) {
                        $now_count = $item_add.getAttribute('data-count');
                        this[4] = Math.min($now_count,(parseInt(this[4]) + parseInt($item_add.value)));
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
$(document).on('keyup', '#input-count', function(){
 $val =   $(this).val();
    $(this).val(Math.min(parseInt($val), $(this).attr('data-count')));
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
$(document).on('ready', function () {

    $(window).scroll(function () {
        $control = $('#control-load option:selected').val();
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 800 && !inProgress && ControlLoad =='auto') {
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
                method:"post",
                url: "/site/catalog",
                data: { "_csrf":yii.getCsrfToken(),
                    "cat":$cat,
                    "count":$count,
                    "start_price": $min_price,
                    "end_price": $max_price,
                    "prod_attr_query": $prodatrquery,
                    "page": $page,
                    "sort": $sort,
                    "searchword": $searchword,
                    "json": '1'
                },
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
                $loader = $('.loader-inner').html();
                $('.pagination-catalog').remove();
                $('.loader-inner').remove();
                if (data[0] != 'Не найдено!') {
                    console.log(data);
                    $.each(data[0], function () {
                        $product = this.products;
                        $descriptionprod = this.productsDescription;
                        $attr_desc = this['productsAttributesDescr'];
                        $attr = this['productsAttributes'];
                        $attr_html = '<div data-sale="'+$product['products_id']+'" class="cart-lable">В корзину</div>';

                        if ($attr_desc.length > 0) {
                            $.each($attr_desc, function (index,value) {
                                if($attr[value['products_options_values_id']]['quantity'] > 0){
                                    $classpos = 'active-options';
                                    $add_class = 'add-count';
                                    $del_class = 'del-count';
                                    $inputpos = '';
                                    $some_text = 0;
                                }else{
                                    $classpos = 'disable-options';
                                    $inputpos = 'readonly';
                                    $add_class = 'add-count-dis';
                                    $del_class = 'del-count-dis';
                                    $some_text = 'Нет';
                                }
                                if((index%2) ==0){
                                    $class='border-right:1px solid #CCC';
                                }else{
                                    $class='';
                                }
                                $attr_html += '<div class="'+$classpos+'" style="width: 50%; overflow: hidden; float: left; '+$class+';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'+value['products_options_values_name']+'</div>'+
                                    '<input '+$inputpos+' id="input-count"'+
                                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                                    'data-prod="'+ $product['products_id']+'"'+
                                    'data-name="'+ escapeHtml($descriptionprod['products_name'])  +'"'+
                                    'data-model="'+ $product['products_model']+'"'+
                                    'data-price="'+ parseInt($product['products_price'])+'"'+
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
                            $attr_html += '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>'+
                                '<input  id="input-count"'+
                                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                                'data-prod="'+ $product['products_id']+'"'+
                                'data-model="'+ $product['products_model']+'"'+
                                'data-price="'+ parseInt($product['products_price'])+'"'+
                                'data-image="'+ $product['products_image']+'"'+
                                'data-attrname="" '+
                                'data-attr="" '+
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

                        if( data[14][$product.manufacturers_id] === undefined ) {
                            $timewrap = '<div></div>';
                        }else{
                            $timewrap =  '<div style="" class="model"><a data-ajax="time" style="cursor:pointer;" data-href="/glavnaya/timeorderproducts?id='+$product['manufacturers_id']+'"><i class="fa fa-clock-o"></i></a></div>';

                        }
                        //console.log($timewrap);
                        $('.bside').append('<div class="container-fluid float" id="card">'+
                            '<a href="/glavnaya/product?id=' + $product.products_id+ '">'+
                            '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/glavnaya/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');">'+
                            '</div>'+
                            '<div  class="name">' + $descriptionprod.products_name  +'</div>'+
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
                            $attr_html+
                            '</span>'+
                            '</div>'+
                            '</div>'+
                            '<div itemprop="" style="font-size: 12px;" id="prod-info" data-prod="'+$product.products_id+'">'+
                            '<i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;">'+
                            '</i>'+
                            'Увеличить'+
                            '</div>'+
                            ''+$timewrap+''+
                            '</div></div>');
                    });

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
    $(document).on('click', '.loader', function () {
       $control = $('#control-load option:selected').val();
        if (!inProgress && ControlLoad=='manual') {
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
                method:"post",
                url: "/site/catalog",
                data: { "_csrf":yii.getCsrfToken(),
                        "cat":$cat,
                        "count":$count,
                        "start_price": $min_price,
                        "end_price": $max_price,
                        "prod_attr_query": $prodatrquery,
                        "page": $page,
                        "sort": $sort,
                        "searchword": $searchword,
                        "json": '1'
                       },
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
                $loader = $('.loader-inner').html();
                $('.pagination-catalog').remove();
                $('.loader-inner').remove();
                if (data[0] != 'Не найдено!') {
                    console.log(data);
                    $.each(data[0], function () {
                        $product = this.products;
                        $descriptionprod = this.productsDescription;
                        $attr_desc = this['productsAttributesDescr'];
                        $attr = this['productsAttributes'];
                        $attr_html = '<div data-sale="'+$product['products_id']+'" class="cart-lable">В корзину</div>';

                        if ($attr_desc.length > 0) {
                            $.each($attr_desc, function (index,value) {
                                if($attr[value['products_options_values_id']]['quantity'] > 0){
                                    $classpos = 'active-options';
                                    $add_class = 'add-count';
                                    $del_class = 'del-count';
                                    $inputpos = '';
                                    $some_text = 0;
                                }else{
                                    $classpos = 'disable-options';
                                    $inputpos = 'readonly';
                                    $add_class = 'add-count-dis';
                                    $del_class = 'del-count-dis';
                                    $some_text = 'Нет';
                                }
                                if((index%2) ==0){
                                    $class='border-right:1px solid #CCC';
                                }else{
                                    $class='';
                                }
                                $attr_html += '<div class="'+$classpos+'" style="width: 50%; overflow: hidden; float: left; '+$class+';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'+value['products_options_values_name']+'</div>'+
                                    '<input '+$inputpos+' id="input-count"'+
                                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                                    'data-prod="'+ $product['products_id']+'"'+
                                    'data-name="'+ escapeHtml($descriptionprod['products_name'])  +'"'+
                                    'data-model="'+ $product['products_model']+'"'+
                                    'data-price="'+ parseInt($product['products_price'])+'"'+
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
                            $attr_html += '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>'+
                                '<input  id="input-count"'+
                                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'+
                                'data-prod="'+ $product['products_id']+'"'+
                                'data-model="'+ $product['products_model']+'"'+
                                'data-price="'+ parseInt($product['products_price'])+'"'+
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
                        if( data[14][$product.manufacturers_id] === undefined ) {
                            $timewrap = '';
                        }else{
                            $timewrap =  '<div style="" class="model"><a data-ajax="time" style="cursor:pointer;" data-href="/glavnaya/timeorderproducts?id='+$product['manufacturers_id']+'"><i class="fa fa-clock-o"></i></a></div>';

                        }
                        console.log($timewrap);
                        $('.bside').append('<div class="container-fluid float" id="card">'+
                                    '<a href="/glavnaya/product?id=' + $product.products_id+ '">'+
                                        '<div data-prod="'+$product.products_id+'" id="prod-data-img" style="clear: both; min-height: 300px; min-width: 200px; background: no-repeat scroll 50% 50% / contain url(/glavnaya/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');">'+
                                        '</div>'+
                                        '<div  class="name">' + $descriptionprod.products_name  +'</div>'+
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
                                               $attr_html+
                                            '</span>'+
                                        '</div>'+
                                    '</div>'+

                                        '<div itemprop="" style="font-size: 12px;" id="prod-info" data-prod="'+$product.products_id+'">'+
                                            '<i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;">'+
                                            '</i>'+
                                            'Увеличить'+
                                        '</div>'+

                            ''+$timewrap+''+
                            '</div></div>');
                    });
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
        if (JSON.parse(localStorage.getItem('cart-om'))) {
            $timenow  =  new Date;
            if(localStorage.getItem('cart-om-date')){
                $timecart =  new Date;
                $timecart = localStorage.getItem('cart-om-date');
                console.log($timenow.getTime() - $timecart);
                if($timenow.getTime() - $timecart > 604800000){
                    localStorage.removeItem('cart-om');
                    localStorage.removeItem('cart-om-date');
                    return false;
                }
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
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" data-name="' + $attr + '" class="info-item" data-name="' + $attr + '" value="' + $attrval + '" ></input></div>';
        } else {
            $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="' + $tooltip[$attr] + '" data-placement="top" data-toggle="tooltip" class="info-item" data-name="' + $attr + '" placeholder="' + $attrlable + '"></input></div>';
        }
    });
    $('.userinfo').html('');
    $('.userinfo').html($inner + '<div>Нажимая кнопку "Подтвердить заказ" вы подтверждаете свое согласие на сбор и обработку ваших персональных данных.</div><button class=" btn btn-sm btn-info" style="bottom: 0px; position: relative; float: right; border-radius: 5px;" type="submit">Подтвердить заказ</button>');
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