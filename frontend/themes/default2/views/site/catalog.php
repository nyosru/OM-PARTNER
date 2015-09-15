<?php
use Yii;
use frontend\controllers\SiteController;
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use common\models\Partners;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
$this -> title = 'Партнеры';
?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $run = new Partners();
                $check = $run -> GetId($_SERVER['HTTP_HOST']);
                $checks = $run -> GetAllowCat($check);
                foreach ($catdata as $value) {
                    if (in_array(intval($value['categories_id']), $checks)) {
                        $catdataallow[] = $value;
                    }
                }
                for ($i = 0; $i < count($catdataallow); $i++) {
                    $row = $catdataallow[$i];
                    if (empty($arr_cat[$row['parent_id']])) {
                        $arr_cat[$row['parent_id']] = $row;
                    }
                    $arr_cat[$row['parent_id']][] = $row;
                }
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
                    if (empty($arr[$parent_id])) {
                        return;
                    } else {
                        if ($parent_id !== 0) {$style = 'style="display: none;"';
                        }
                        echo '<ul id="accordion" class="accordion" ' . $style . '">';
                        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                            $catdesc = $arr[$parent_id][$i]['categories_id'];
                            if (!$arr[$parent_id][$i] == '') {
                                echo '<li class=""><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
                                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                }
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
                view_cat($arr_cat, 0, $catnamearr, $check);
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">
            <?
            $check_ygbot = Yii::$app->request->getQueryParam('_escaped_fragment_', NULL);
            if($check_ygbot == NULL) {?>
                <script >
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

    function startAnimation()
    {
        document . getElementById('loaderImage') . style . backgroundImage = 'url(' + cImageSrc + ')';
        document . getElementById('loaderImage') . style . width = cWidth + 'px';
        document . getElementById('loaderImage') . style . height = cHeight + 'px';
        FPS = Math . round(100 / cSpeed);
        SECONDS_BETWEEN_FRAMES = 1 / FPS;
        cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES / 1000);
    }
    function continueAnimation()
    {
        cXpos += cFrameWidth;
        cIndex += 1;
        if (cIndex >= cTotalFrames) {
            cXpos = 0;
            cIndex = 0;
        }
        if (document . getElementById('loaderImage'))
            document . getElementById('loaderImage') . style . backgroundPosition = (-cXpos) + 'px 0';
        cPreloaderTimeout = setTimeout('continueAnimation()', SECONDS_BETWEEN_FRAMES * 1000);
    }
    function stopAnimation()
    {
        clearTimeout(cPreloaderTimeout);
        cPreloaderTimeout = false;
    }
    function imageLoader(s, fun)
    {
        clearTimeout(cImageTimeout);
        cImageTimeout = 0;
        genImage = new Image();
        genImage . onload = function () {
            cImageTimeout = setTimeout(fun, 0)};
        genImage . onerror = new Function ('alert(\'Could not load the image\')');
        genImage . src = s;
    }
    function new_url($arr_sub)
    {
        $new_url = [];
        $.each($arr_sub, function () {
            $new_url . push(this[0] + '=' + this[1]);
        });
        return $new_url . join('&');
    }
    function split_url($url)
    {
        $url_arr = $url . split('&');
        $arr_sub = new Object();
        $.each($url_arr, function () {
            $spl = this . split('=');
            $arr_sub[$spl[0]] = $spl;
        });
        return $arr_sub;
    }
    function new_suburl($url_obj, $val, $new_var)
    {
        $value = $url_obj[$val];
        $value[1] = $new_var;

        $url_obj[$val] = $value;
        return $url_obj;
    }

        $('body') . addClass('some');
        $('link') . addClass('some');
        $('html') . prepend('<div class="preload"><div id="loaderImage"></div></div>');


        new imageLoader(cImageSrc, 'startAnimation()');

    $url = '';
    $url = document.location.hash;
    if($url.toLowerCase().indexOf('#!')){
        window.location('/');
    }
    $url_data = split_url(document.location .hash);
    console.log($url_data);
    $cat = $url_data['#!cat'][1];
    $count = $url_data . count[1];
    $min_price = $url_data . start_price[1];
    $max_price = $url_data . end_price[1];
    $prodatrquery = $url_data . prod_attr_query[1];
    $page = $url_data . page[1];
    $sort = $url_data . sort[1];
    $searchword = $url_data . searchword[1];
        $.ajax({
            url : "/site/request",
            data : 'cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword,
            cache : false,
            async : true,
            dataType : 'json',
            success : function (data) {
                    console . log(data);
                    $('body') . removeClass('some');
                    $('link') . removeClass('some');
                    $('.preload') . remove();
                    if (data[0] != 'Не найдено!') {

                        $('.bside') . html("");
                        $('#size-slide') . html("");
                        $('#filters') . html(' <div id="price-lable">Цена</div>От <input id="min-price" value="0" class="btn" /> До<input id="max-price" class="btn" /> Руб.<div class="price-slide"><div class="slider"></div> </div><div id="size-slide"></div><div type="button" id="filter-button"></div> ');
                        $headbside = '';
                        $headbside += '<div id="partners-main-right">';
                        $headbside += '<div id="products-counter">' + data[4] + '-' + data[5] + ' из ' + data[1] + '</div>';
                    $headbside += '<div id="products-pager"></div>';
                    $headbside += '<div id="count-display"> | Показывать по<div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="20"  href="' + new_url(new_suburl(split_url($url), 'count', '20')) + '">20</a></div><div class="count data-j"> <a data-j="on" class="countdisplay" onclick="" data-count="40" href="' + new_url(new_suburl(split_url($url), 'count', '40')) + '">40</a></div> </div> <div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="60" href="' + new_url(new_suburl(split_url($url), 'count', '60')) + '">60</a> </div>';
                    $headbside += '<div id="sort-order"><div  class="header-sort sort" data="' + data[11] + '">Сортировать по </div>';
                    //  '<div class="header-sort-item">дате <a class="sort data-j arrow-down" data="0" href="#"></a><a class="sort data-j arrow-up" data="10" href="#"></a></div><div class="header-sort-item">цене<a class="sort data-j arrow-down" data="1" href="#"></a><a class="sort data-j arrow-up" data="11" href="#"></a></div><div class="header-sort-item"> названию<a class="sort data-j arrow-up" data="2" href="#"></a><a class="sort data-j arrow-down" data="12" href="#"></a></div><div class="header-sort-item"> модели<a class="sort data-j arrow-up" data="3" href="#"></a><a class="sort data-j arrow-down" data="13" href="#"></a></div><div class="header-sort-item">популярности<a class="sort data-j arrow-up" data="4" href="#"></a><a class="sort data-j arrow-down" data="14" href="#"></a> </div>' + '</div>';
                    $sortorder = [['дате', 0, 10], ['цене', 1, 11], ['названию', 2, 12], ['модели', 3, 13], ['популярности', 4, 14]];
                    $.each($sortorder, function () {

                        if (data[11] == this[1]){
                            $dataord = this[2];
                            $arrow = 'caret-up';
                        }else{
                            $dataord = this[1];
                            $arrow = 'caret-down';
                        }
                        if (this[1] == data[11] || this[2] == data[11]){
                            $headbside += '<div class="header-sort-item-active"><a class="sort data-j" href="' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '" data="' + $dataord + '" href="#">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                        }else{

                            $headbside += '<div class="header-sort-item"><a class="sort data-j" data="' + $dataord + '" href="' + new_url(new_suburl(split_url($url), 'sort', $dataord)) + '">' + this[0] + '</a> <i class="fa fa-' + $arrow + '"> </i></div>';
                        }


                    });
                    $('.bside') . prepend($headbside);
                    $('.header-sort-item:first') . attr('style', "border-left:none;");
                    $('.header-sort-item:last') . attr('style', "border-right:none;");
                    $('.header-sort-item-active') . next() . attr('style', "border-left:none;");
                    $('.header-sort-item-active') . prev() . attr('style', "border-right:none;");

                    $('.sort[data=' + data[11] + ']').addClass('sort-checked');

                    $('[data-count = ' + $count + ']') . addClass('count-checked');

                    $('#max-price') . val(data[8]);
                    $('#min-price') . val(data[7]);

                    if (data[3] . length > 1 && data[3] . length <= 30) {

                            $('#size-slide') . append('<div id="size-lable">Размеры </div>');
                        }else if (data[3] . length > 30){
                            $('#size-slide') . append('<div id="size-lable"><input id="class-size-filter" style="width:100%;  height: 20px;" placeholder="начните вводить интересующий размер"/></div>');
                        }
                    $.each(data[3], function ()
                        {
                            $attrproducts = this . products_options_values_name;
                            $attrproductsid = this . products_options_values_id;
                            if ($attrproducts != null && data[3] . length <= 30) {
                            $('#size-slide') . append('<div data-size="' + $attrproductsid + '" class="size">' + $attrproducts + '</div>');
                        }else if ($attrproducts != null && data[3] . length > 30){
                            $('#size-slide') . append('<div data-size="' + $attrproductsid + '" class="size" style="display:none;" data-toggle="tooltip" data-placement="top" title="' + $attrproducts + '"><i class="fa fa-check"></i><div style="left: 341%; position: relative; width: 50px; overflow: hidden; height: 100%;">' + $attrproducts + '</div></div>');

                        }
                    });
                    $(document) . on('keyup', '#class-size-filter', function () {
                        $('.size') . hide();
                        $text = $(this) . val();
                        $.each(data[3] , function ()
                        {
                            $attrproducts = this . products_options_values_name;
                            if ($attrproducts != null) {
                                if ($attrproducts . toLowerCase() . indexOf($text . toLowerCase()) != -1) {
                                    $('[data-size = ' + this . products_options_values_id + ']') . show();
                                }
                            }
                        })
                    });
                    if (data[9] != '') {
                            $("[data-size=" + data[9] + "]").addClass('size-checked');
                    }

                    $('#filter-button') . html('<div style="clear: both;padding: 10px 20px;"><div class="btn btn-info btn-sm data-j addfilter" style="float: left">Применить</div><div class="btn btn-danger btn-sm data-j reset" style="float: right">Сбросить</div></div>');

                    $.each(data[0], function ()
                        {
                            $product = this . products;
                            $description = this . productsDescription;
                            $attr_desc = this . productsAttributesDescr;
                            $attr_html = '<div class="cart-lable">В корзину</div>';
                            if ($attr_desc . length > 0) {

                                $.each($attr_desc, function () {
                                    $attr_html += '<div class="size-desc"><div><div class="lable-item">' + this . products_options_values_name + '</div></div><input id="input-count" data-prod="' + $product . products_id + '" data-model="' + $product . products_model + '" data-price="' + $product . products_price + '" data-image="' + $product . products_image + '" data-attrname="' + this . products_options_values_name + '" data-attr="' + this . products_options_values_id + '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                                });
                            } else {
                                $attr_html += '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="' + $product . products_id + '" data-model="' + $product . products_model + '" data-price="' + $product . products_price + '" data-image="' + $product . products_image + '" data-attrname="' + this . products_options_values_name + '" data-attr="' + this . products_options_values_id + '" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                            }
                            $('.bside') . append('<div  class="container-fluid float" id="card" product=""><div data-prod="' + $product . products_id + '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + $product . products_image . replace(')', ']]]]') . replace(' ', '[[[[]]]]') . replace('(', '[[[[') + ');"></div><div class="name">' + $description . products_name + '</div><div class="model">Арт.' + $product . products_model + '</div><div class="price"><b>' + parseInt($product . products_price) + '</b> руб.</div><div id="prod-info" data-prod="' + $product . products_id + '">Инфо</div><span>' + $attr_html + '</span></div>');
                        });

                    if (data[5] >= data[1] && data[4] == 0) {
                            $('#products-pager') . hide();
                        }else {
                            $pager = '';
                            $countpager = Math . ceil(data[1] / $count);
                        if (data[10] != 'undefined') {

                                if (parseInt(data[10]) < 1) {
                                    $natpage = 1;
                                    $nextpage = 0;
                                } else if (parseInt(data[10]) +1 >= $countpager) {
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
                        $pager += ' <a data-page="' + parseInt(data[10]) +'" class="page data-j" href="#">' + (parseInt(data[10]) + 1) +'</a> ';
                        $pager += 'из ' + $countpager;

                        $pager += ' <div data-page="' + ($natpage - 1) + '" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="' + new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) + '"></a></i></div> ';
                        $pager += ' <div data-page="' + ($nextpage + 1) + '" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="' + new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) + '"></a></i></div> ';

                        $('#products-pager') . html('');
                        $('#products-pager') . html('Страница: ' + $pager);
                        $('.bside') . append('<div id="products-pager-down">Страница: ' + $pager + '</div>');
                    }
                    $("[data-page=" + $page + "]") . addClass('page-checked');
                    $ert = $cat;
                    $(".slider") . slider({
                        animate : true,
                        range : true,
                        values : [data[7], data[8]],
                        min : 0,
                        max : data[2] . maxprice,
                        step : 1,
                        change : function (event, ui) {
                            $('#min-price') . val(ui . values[0]);
                            $('#max-price') . val(ui . values[1]);
                        }
                    });
                } else {
                        $('.bside') . html('Нет Результатов <a class="data-j reset" href="#"> Попробуйте сбросить критерии</a>');
                        $('#size-slide') . html('');
                        $('#filter-button') . html('');
                    }
                data[12] . split(',');
                $.each(data[12] . split(','), function ()
                    {
                        $("[data-cat=" + this + "]") . attr('data', 'checked');
                    });

                $.each($('.link'), function () {
                    if ($(this) . children('a') . length == 0) {
                        $(this) . html('<a href="' + $url + '">' + $(this) . html() + '</a>');
                    } else {
                        $html = $(this) . children('a') . html()
                        $(this) . html('<a href="' + $url + '">' + $html + '</a>');
                    }
                });


                if(history.pushState) {
                    history.pushState(null, null, '/site/catalog/'+data[16].join('/')+'/'+new_url(split_url($url)))      }
                else {
                    document.location.hash = '/site/catalog'+data[16].join('/')+'/'+new_url(split_url($url))  }



//                if(history.pushState) {
//                    history.pushState(null, null, new_url(split_url($url)))      }
//                else {
//                    document.location.hash = new_url(split_url($url))  }



                //alert('На этой странице  '+$('div').length+' divов');
                // $('div').attr('style', 'border:1px solid red; margin:3px');
            }
        });


    </script >

    <? }else{
                function new_url($arr_sub){
                    $new_url = Array();
                    foreach($arr_sub as $value){
                        $new_url[] = $value[0].'='.$value[1];
                    }
                    return implode('&',$new_url);
                }

                function split_url($url)
                {
                    $url_arr = explode('&',$url);
                    $arr_sub = Array();
                    foreach($url_arr as $value){
                        $spl = explode('=' ,$value);
                        $arr_sub[$spl[0]] = $spl;
                    }
                    return $arr_sub;
                }

                function new_suburl($url_obj, $val, $new_var)
                {
                    $value = $url_obj[$val];
                    $value[1] = $new_var;

                    $url_obj[$val] = $value;
                    return $url_obj;
                }
                if(strpos(Yii::$app->request->getQueryString(), '#!') === FALSE){
                    header('Location: http://'.$_SERVER['HTTP_HOST']);
                }
                $url_data = split_url(str_replace('_escaped_fragment_=', '#!', Yii::$app->request->getQueryString()));
                $cat = $url_data['#!cat'][1];
                $count = $url_data['count'][1];
                $min_price = $url_data['start_price'][1];
                $max_price = $url_data['end_price'][1];
                $prodatrquery = $url_data['prod_attr_query'][1];
                $page = $url_data['page'][1];
                $sort = $url_data['sort'][1];
                $searchword = $url_data['searchword'][1];
                $url = '/site/request/?cat='.$cat.'&count='.$count.'&start_price='.$min_price.'&end_price='.$max_price.'&prod_attr_query='.$prodatrquery.'&page='.$page.'&sort='.$sort.'&searchword='.$searchword;
                $data = file('http://'.$_SERVER[HTTP_HOST].'/site/request/?cat='.$cat.'&count='.$count.'&start_price='.$min_price.'&end_price='.$max_price.'&prod_attr_query='.$prodatrquery.'&page='.$page.'&sort='.$sort.'&searchword='.$searchword);
                $data = json_decode($data[0]);


                $url = '#!cat='.$cat.'&count='.$count.'&start_price='.$min_price.'&end_price='.$max_price.'&prod_attr_query='.$prodatrquery.'&page='.$page.'&sort='.$sort.'&searchword='.$searchword;

                if ($data[0] != 'Не найдено!') {

                    $headbside = '';
                    $headbside .= '<div id="partners-main-right">';



                    $headbside .= '<div id="products-counter">'.$data[4].'-'.$data[5].' из '.$data[1].'</div>';

                    if ($data[5] >= $data[1] && $data[4] == 0) {

                    }else {
                        $pager = '';
                        $countpager = floor($data[1] / $count);
                        if ($data[10] != NULL) {

                            if (intval($data[10]) < 1) {
                                $natpage = 1; $nextpage =0;
                            } else if (intval($data[10]) + 1 >= $countpager) {
                                $natpage = $countpager - 1;
                                $nextpage = $countpager - 2;
                            } else {
                                $natpage = intval($data[10]);
                                $nextpage = intval($data[10]);
                            }
                        } else {
                            $natpage = 1;
                            $nextpage = 0;
                            $data[10] = 0;
                        }
                        $pager .= ' <a data-page="'.intval($data[10]).'" class="page data-j" href="#">'.(intval($data[10])+1).'</a> ';
                        $pager .= 'из '.$countpager;

                        $pager .= ' <div data-page="'.($natpage - 1).'" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="/site/catalog'.new_url(new_suburl(split_url($url), 'page', ($natpage - 1))).'"></a></i></div> ';
                        $pager .= ' <div data-page="'.($nextpage+1).'" class="page data-j btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="/site/catalog'.new_url(new_suburl(split_url($url), 'page', ($nextpage+1))).'"></a></i></div> ';


                        $topnav = '<div id="products-pager">Страница: '.$pager.'</div>';
                        $downnav = '<div id="products-pager-down">Страница: '.$pager.'</div>';

                    }

                    $headbside .= $topnav;

                    $headbside .= '<div id="products-pager"></div>';
             //   $url = new_url(new_suburl(split_url($url), '#!cat', data[16].join('/')));
                    $countdisp = [20, 40, 60];
                    $innercount = '';
                    foreach($countdisp as $countdisp){
                        if($countdisp == $count){
                            $classcount = 'countdisplay count-checked';
                        }else{
                            $classcount = 'countdisplay';
                        }
                      $innercount .=   '<div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count=". $countdisp."  href="/site/catalog'.new_url(new_suburl(split_url($url), 'count',  $countdisp)).'">. $countdisp.</a></div>';
                    }
                $headbside .= '<div id="count-display"> | Показывать по<div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="20"  href="/site/catalog'.new_url(new_suburl(split_url($url), 'count', '20')).'">20</a></div><div class="count data-j"> <a data-j="on" class="countdisplay" onclick="" data-count="40" href="/site/catalog'.new_url(new_suburl(split_url($url), 'count', '40')).'">40</a></div> </div> <div class="count data-j"> <a class="countdisplay" onclick="" data-j="on" data-count="60" href="/site/catalog'.new_url(new_suburl(split_url($url), 'count', '60')).'">60</a> </div>';

                $headbside .= '<div id="sort-order"><div  class="header-sort sort sort-checked" data="'.$data[11].'">Сортировать по </div>';
                //  '<div class="header-sort-item">дате <a class="sort data-j arrow-down" data="0" href="#"></a><a class="sort data-j arrow-up" data="10" href="#"></a></div><div class="header-sort-item">цене<a class="sort data-j arrow-down" data="1" href="#"></a><a class="sort data-j arrow-up" data="11" href="#"></a></div><div class="header-sort-item"> названию<a class="sort data-j arrow-up" data="2" href="#"></a><a class="sort data-j arrow-down" data="12" href="#"></a></div><div class="header-sort-item"> модели<a class="sort data-j arrow-up" data="3" href="#"></a><a class="sort data-j arrow-down" data="13" href="#"></a></div><div class="header-sort-item">популярности<a class="sort data-j arrow-up" data="4" href="#"></a><a class="sort data-j arrow-down" data="14" href="#"></a> </div>' + '</div>';
                $sortorder = [['дате',0,10],['цене',1,11],['названию',2,12],['модели',3,13],['популярности',4,14]];
                foreach($sortorder as $value){

                    if(intval($data[11]) == intval($value[1])){
                        $dataord = $value[2];
                        $arrow = 'caret-up';
                    }else{
                        $dataord = $value[1];
                        $arrow = 'caret-down';
                    }
                    if($dataord == $data[11]){
                        $class = 'sort data-j sort-checked';
                    }else{
                        $class = 'sort data-j';
                    }
                    if($value[1] == $data[11] || $value[2] == $data[11]){
                        $headbside .= '<div class="header-sort-item-active"><a class="'.$class.'" href="/site/catalog'.new_url(new_suburl(split_url($url), 'sort', $dataord)).'" data="'.$dataord.'" href="#">'.$value[0].'</a> <i class="fa fa-'.$arrow.'"> </i></div>';
                    }else{

                        $headbside .= '<div class="header-sort-item"><a class="'.$class.'" data="'.$dataord.'" href="/site/catalog'.new_url(new_suburl(split_url($url), 'sort', $dataord)).'">'.$value[0].'</a> <i class="fa fa-'.$arrow.'"> </i></div>';
                    }


                }
                    $headbside .= '</div></div>';
               echo $headbside;


                    $innerhtml ='';
foreach($data[0] as $value) {
    $product = $value->products;
    $description = $value->productsDescription;
    $attr_desc = $value->productsAttributesDescr;
    $attr_html = '<div class="cart-lable">В корзину</div>';
    if (count($attr_desc) > 0) {
        foreach($attr_desc as $attr_desc_value)  {
            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$attr_desc_value->products_options_values_name.'</div></div><input id="input-count" data-prod="'.$product->products_id.'" data-model="'.$product->products_model.'" data-price="'.$product->products_price.'" data-image="'.$product->products_image.'" data-attrname="'.$attr_desc_value->products_options_values_name.'" data-attr="'.$attr_desc_value->products_options_values_id.'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
        }
    } else {
        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product->products_id.'" data-model="'.$product->products_model.'" data-price="'.$product->products_price.'" data-image="'.$product->products_image.'" data-attrname="'.$attr_desc_value->products_options_values_name.'" data-attr="'.$attr_desc_value->products_options_values_id.'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
    }
    $product->products_image = str_replace(')',']]]]', $product->products_image);
    $product->products_image = str_replace(' ','[[[[]]]]' , $product->products_image);
    $product->products_image = str_replace('(','[[[[', $product->products_image);

    $innerhtml .= '<div itemscope itemtype="http://schema.org/Product"  class="container-fluid float" id="card"><div data-prod="'.$product->products_id.'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product->products_image.');"><meta itemprop="image" content="/site/imagepreview?src='.$product->products_image.'"></div><div itemprop="name" class="name">'.$description->products_name.'</div><div itemprop="url" class="model">Артикул '.$product->products_model.'</div><div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price"><b itemprop="price">'.intval($product->products_price).'</b> руб.</div><div itemprop="description id="prod-info" data-prod="'.$product->products_id.'">Инфо</div><span>'.$attr_html.'</span></div>';


}

echo $innerhtml;

echo $downnav;






            }else {
                   echo 'Нет результатов';
                }







            }?>
        </div>
    </div>
