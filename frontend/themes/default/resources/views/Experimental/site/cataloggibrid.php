<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use common\traits\Imagepreviewfile;

function new_url($arr_sub)
{
    $new_url = Array();
    foreach ($arr_sub as $value) {
        $new_url[] = $value[0] . '=' . $value[1];
    }
    return implode('&', $new_url);
}

function split_url($url)
{
    $url_arr = explode('&', $url);
    $arr_sub = Array();
    foreach ($url_arr as $value) {
        $spl = explode('=', $value);
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

function rgbToHsl($r, $g, $b)
{
    $oldR = $r;
    $oldG = $g;
    $oldB = $b;

    $r /= 255;
    $g /= 255;
    $b /= 255;

    $max = max($r, $g, $b);
    $min = min($r, $g, $b);

    $h;
    $s;
    $l = ($max + $min) / 2;
    $d = $max - $min;

    if ($d == 0) {
        $h = $s = 0; // achromatic
    } else {
        $s = $d / (1 - abs(2 * $l - 1));

        switch ($max) {
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6);
                if ($b > $g) {
                    $h += 360;
                }
                break;

            case $g:
                $h = 60 * (($b - $r) / $d + 2);
                break;

            case $b:
                $h = 60 * (($r - $g) / $d + 4);
                break;
        }
    }

    return array(round($h, 2), round($s, 2), round($l, 2));
}


function dominant_color($img)
{

    $prev = new Imagepreviewfile();
    //   $img = Yii::$app->request->getQueryParam('src');
    $img = $prev->viewpreviewfile('http://odezhda-master.ru/images/', $img, '@webroot/images/');
    if (trim($img) != '') {
        $result_array = array();
        $result_white = array();
        $result_black = array();
        $result_gray = array();
        $result_body = array();
        $return['max_count'] = 0;
        $return['max_rgb'] = '';
        $return['all_px'] = 0;
        $return['proc'] = 0;
        $type = explode('.', $img);
        $count = (integer)count($type) - 1;
        $type = $type[$count];
        switch ($type) {
            case "jpg":
                $im = imageCreateFromJPEG(Yii::getAlias('@webroot') . $img);
                break;

            case "gif":
                $im = imageCreateFromGIF(Yii::getAlias('@webroot') . $img);
                break;

            case "png":
                $im = imageCreateFromPNG(Yii::getAlias('@webroot') . $img);
                break;

            default:
                die("<p style='color:red;'>Тип файла (" . $img . ") не распознан - " . print_r($type) . "</p>");
        }
        $h = imagesx($im);
        $w = imagesy($im);
        $oh = (integer)$h / 100 * 70;
        $ow = (integer)$w / 100 * 65;
        $rw = (integer)$w / 100 * 17.5;
        $rh = (integer)$h / 100 * 15;
        $x1 = $rh;
        $x2 = ($rh + ($oh / 2)) - ($oh / 100 * 15);
        $x3 = ($rh + $oh) - ($oh / 100 * 30);
        $y1 = $rw;
        $y2 = ($rw + ($ow / 2)) - ($ow / 100 * 15);
        $y3 = ($rw + $ow) - ($ow / 100 * 30);
        $himgp = $oh / 100 * 20;
        $wimgp = $ow / 100 * 20;
//        $imdest = imagecreatetruecolor($himgp, $wimgp * 12);
//        $bgc = imagecolorallocate($imdest, 255, 255, 255);
//        $tc = imagecolorallocate($imdest, 0, 0, 0);
//        imagefilledrectangle($imdest, 0, 0, $himgp, $wimgp * 12, $bgc);
//        imagecopy($imdest, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 1, $x2, $y1, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 2, $x3, $y1, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 3, $x1, $y2, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 4, $x2, $y2, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 5, $x3, $y2, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 6, $x1, $y3, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 7, $x2, $y3, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 8, $x3, $y3, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 9, $x1, $y3, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 10, $x2, $y2, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 11, $x3, $y1, $himgp, $wimgp);
//        imagecopy($imdest, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);
//
//            $imcheck = imagecreatetruecolor($himgp, $wimgp * 3);
//            $bgcimcheck = imagecolorallocate($imcheck, 255, 255, 255);
//            $tcimcheck = imagecolorallocate($imcheck, 0, 0, 0);
//            imagefilledrectangle($imcheck, 0, 0, $himgp, $wimgp * 3, $bgcimcheck);
//            imagecopy($imcheck, $im, 0, $wimgp * 0, $x1, $y1, $himgp, $wimgp);
//            imagecopy($imcheck, $im, 0, $wimgp * 1, $x1, $y3, $himgp, $wimgp);
//            imagecopy($imcheck, $im, 0, $wimgp * 2, $x2, $y2, $himgp, $wimgp);
        $xr1 = range($x1, $x1 + $himgp);
        $xr2 = range($x2, $x2 + $himgp);
        $xr3 = range($x3, $x3 + $himgp);
        $xrange = array_merge($xr1, $xr2, $xr3);
        $yr1 = range($y1, $y1 + $wimgp);
        $yr2 = range($y2, $y2 + $wimgp);
        $yr3 = range($y3, $y3 + $wimgp);
        $yrange = array_merge($yr1, $yr2, $yr3);

        $weight = [
            '00' => 0,
            '11' => 2,
            '12' => 1,
            '13' => 1,
            '21' => 1,
            '22' => 2,
            '23' => 1,
            '31' => 2,
            '32' => 1,
            '33' => 1
        ];

        $h = imagesx($im);
        $w = imagesy($im);
//        $hc = imagesx($imcheck);
//        $wc = imagesy($imcheck);
//        $return['all_pxch'] = $hc * $wc;
        $return['all_px'] = $h * $w;
        for ($i = 0; $i < $h; $i++) {
            for ($j = 0; $j < $w; $j++) {
                if (in_array($i, $xrange) && in_array($j, $yrange)) {
                    if (in_array($i, $xr1)) {
                        $xt = 1;
                    } elseif (in_array($i, $xr2)) {
                        $xt = 2;

                    } elseif (in_array($i, $xr3)) {
                        $xt = 3;
                    } else {
                        $xt = 0;
                    }
                    if (in_array($i, $yr1)) {
                        $yt = 1;
                    } elseif (in_array($i, $yr2)) {
                        $yt = 2;

                    } elseif (in_array($i, $yr3)) {
                        $yt = 3;
                    } else {
                        $yt = 0;
                    }
                    $weight_index = $xt . $yt;
                    $weightfor = $weight[$weight_index];
                    $rgb = imagecolorat($im, $i, $j);
                    $r = ($rgb >> 16) & 0xFF;
                    $g = ($rgb >> 8) & 0xFF;
                    $b = $rgb & 0xFF;
                    $hsl = rgbToHsl($r, $g, $b);
//                    if ($hsl[2] <= 0.2 || $hsl[2] >= 0.8 || $hsl[1] <= 0.1 || ($hsl[0] <= 35 && $hsl[0] >= 15)) {
//                    for ($ic = 0; $ic < $hc; $ic++) {
//                        for ($jc = 0; $jc < $wc; $jc++) {
//                            $rgb = imagecolorat($imcheck, $ic, $jc);
//                            $r = ($rgb >> 16) & 0xFF;
//                            $g = ($rgb >> 8) & 0xFF;
//                            $b = $rgb & 0xFF;
//                            $hsl = rgbToHsl($r,$g, $b);
                    if ($hsl[2] <= 0.2) {
                        $color = "black";
                        $result_black[$color]++;
                    } elseif ($hsl[2] >= 0.8) {
                        $color = "white";
                        $result_white[$color]++;
                    } elseif ($hsl[1] <= 0.1) {
                        $color = "gray";
                        $result_gray[$color]++;
                    } elseif ($hsl[0] <= 35 && $hsl[0] >= 15) {
                        $color = "body";
                        $result_body[$color]++;
                    } else {


                        for ($wfor = 1; $weightfor < $wfor; $wfor++) {
                            $color = $r . ',' . $g . ',' . $b;
                            $result_array[$color]++;
                        }
                    }
                }
//                        }
//                    }
//                        $color = $r . ',' . $g . ',' . $b;
//                        $result_array[$color]++;

//                } else {
//                        $color = $r . ',' . $g . ',' . $b;
//                    $result_array[$color]++;
//                }
            }
        }
        foreach ($result_array as $key => $value) {
            if ($value > $return['max_count']) {
                $return['max_count'] = $value;
                $return['max_rgb'] = $key;
            }
        }
        $return['proc'] = round(($return['max_count'] * 100) / $return['all_px'], 0);

//        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;


//            $headers = Yii::$app->response->headers;
//            $headers->add('Content-Type', 'image/jpg');
//            $headers->add('Cache-Control', 'max-age=68200');
//            Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
//            echo imagejpeg($imdest);

        return $return;
    } else {
        die("<p>Файл не найден! " . $img . "</p>");
    }
}

$start_url = Yii::$app->request->getQueryString();
$url_data = split_url(str_replace('&amp;', '&', str_replace('%26', '&', $start_url)));
$cat = $url_data['cat'][1];
$count = $url_data['count'][1];
$min_price = $url_data['start_price'][1];
$max_price = $url_data['end_price'][1];
$prodatrquery = $url_data['prod_attr_query'][1];
$page = $url_data['page'][1];
$sort = $url_data['sort'][1];
$searchword = $url_data['searchword'][1];
$url = '/site/catalog?cat=' . $cat . '&count=' . $count . '&start_price=' . $min_price . '&end_price=' . $max_price . '&prod_attr_query=' . $prodatrquery . '&page=' . $page . '&sort=' . $sort . '&searchword=' . $searchword;
if ($data[0] != 'Не найдено!') {
    $headbside = '';
    $headbside .= '<div id="partners-main-right" class="headerbside">';
    $headbside .= '<div id="products-counter">' . $data[4] . '-' . $data[5] . ' из ' . $data[1] . '</div>';
    if ($data[5] >= $data[1] && $data[4] == 0) {
    } else {
        $pager = '';
        $countpager = floor($data[1] / $count);
        if ($data[10] != NULL) {

            if (intval($data[10]) < 1) {
                $natpage = 1;
                $nextpage = 0;
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
        $pager .= ' <a data-page="' . intval($data[10]) . '" class="page " href="#">' . (intval($data[10]) + 1) . '</a> ';
        $pager .= 'из ' . $countpager;
        $pager .= ' <a data-page="' . ($natpage - 1) . '" class="fa fa-chevron-left page  btn btn-default btn-sm lock-on" href="' . new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) . '"></a> ';
        $pager .= ' <a data-page="' . ($nextpage + 1) . '" class="fa fa-chevron-right page  btn btn-default btn-sm lock-on" href="' . new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) . '"></a> ';
        $topnav = '<div id="products-pager">Страница: ' . $pager . '</div>';
        $downnav = '<div id="products-pager-down">Страница: ' . $pager . '</div>';
    }
    $headbside .= $topnav;

    $headbside .= '<div id="products-pager"></div>';
    //   $url = new_url(new_suburl(split_url($url), '#!cat', data[16].join('/')));
    $countdisp = [20, 40, 60];
    $innercount = '';
    foreach ($countdisp as $key => $countdisp) {
        if ($countdisp == $count) {
            $classcount = 'countdisplay count-checked';
        } else {
            $classcount = 'countdisplay';
        }
        $innercount .= '<div class="count lock-on"> <a class="' . $classcount . '" onclick=""  data-count="' . $countdisp . '"  href="' . new_url(new_suburl(split_url($url), 'count', $countdisp)) . '">' . $countdisp . '</a></div>';
    }
    $headbside .= '<div id="count-display" style="float: none;"> | Показывать по ' . $innercount . ' </div>';

    $headbside .= '<div id="sort-order"><div  class="header-sort sort sort-checked" data="' . $data[11] . '">Сортировать по </div>';
    $sortorder = [['дате', 0, 10], ['цене', 1, 11], ['названию', 2, 12], ['модели', 3, 13], ['популярности', 4, 14]];
    foreach ($sortorder as $value) {
        if (intval($data[11]) == intval($value[1])) {
            $dataord = $value[2];
            $arrow = 'caret-up';
        } else {
            $dataord = $value[1];
            $arrow = 'caret-down';
        }
        if ($dataord == $data[11]) {
            $class = 'sort  sort-checked';
        } else {
            $class = 'sort ';
        }
        if ($value[1] == $data[11] || $value[2] == $data[11]) {
            $headbside .= '<div class="header-sort-item-active lock-on"><a class="' . $class . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '" data="' . $dataord . '" href="#">' . $value[0] . '</a> <i class="fa fa-' . $arrow . '"> </i></div>';
        } else {
            $headbside .= '<div class="header-sort-item lock-on"><a class="' . $class . '" data="' . $dataord . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '">' . $value[0] . '</a> <i class="fa fa-' . $arrow . '"> </i></div>';
        }
    }
    $headbside .= '</div></div>';
    echo $headbside;
    $innerhtml = '';
    foreach ($data[0] as $value) {
        $product = $value['products'];
        $description = $value['productsDescription'];
        $attr_desc = $value['productsAttributesDescr'];
        $attr_html = '<div class="item-footer"><div class="item-price">'.(integer)$product['products_price'].' руб.</div><div class="cart-lable">В корзину</div></div><div class="item-s">';
        if (count($attr_desc) > 0) {
            foreach ($attr_desc as $attr_desc_value) {
                $attr_html .= '<div class="size-desc"><div><div class="lable-item" id="input-count" data-prod="' . $product['products_id'] .
                    '" data-model="' . $product['products_model'] .
                    '" data-price="' . $product['products_price'] .
                    '" data-image="' . $product['products_image'] .
                    '" data-attrname="' . $attr_desc_value['products_options_values_name'] .
                    '" data-attr="' . $attr_desc_value['products_options_values_id'] .
                    '" data-name="' . $description['products_name'] . '">' . $attr_desc_value['products_options_values_name'] . '</div></div></div>';
            }
        } else {
            $attr_html .= '<div class="size-desc"><div class="lable-item"  id="input-count" data-prod="' . $product['products_id'] . '" data-model="' . $product['products_model'] . '" data-price="' . $product['products_price'] . '" data-image="' . $product['products_image'] . '" data-attrname="' . $attr_desc_value['products_options_values_name'] . '" data-attr="' . $attr_desc_value['products_options_values_id'] . '" data-name="' . $description['products_name'] . '">+</div></div>';
        }
        $attr_html .='</div>';
        $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
        $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
        $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);

        $innerhtml .= '<div itemscope itemtype="http://schema.org/Product"  class="container-fluid float" id="card" ><a href="/site/product?id='.$product['products_id'].'"><div data-prod="' .
            $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px;background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' .
            $product['products_image'] . ');"><meta itemprop="image" content="/site/imagepreview?src=' .
            $product['products_image'] . '"></div></a><div itemprop="name" class="name">' .
            $description['products_name'] . '</div><div itemprop="url" class="model">Артикул ' .
            $product['products_model'] . '</div><div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price"><b itemprop="price">' .
            intval($product['products_price']) . '</b> руб.</div><a href="/site/product?id=' .
            $product['products_id'] . '"><div itemprop="description" data-prod="' .
            $product['products_id'] . '"></div></a><div class="item-descr"><a href="/site/product?id='.$product['products_id'].'"><div title="Инфо" class="eye"><i class="fa fa-eye"></i></div></a><div title="Поделиться в социальной сети" class="item-social"><div class="social"><a href="http://vk.com/share.php?url=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&description='.(integer)($product['products_price']).'%20Руб.&title='.$description['products_description'].'"><i class="fa fa-vk"></i></a></div><div class="social"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.urlencode('http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id']).'&st.comments='.urlencode($description['products_description']).'"><i class="fa fa-odnoklassniki"></i></a></div><div class="social"><a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&p[summary]='.(integer)($product['products_price']).'%20Руб.&p[title]='.$description['products_description'].'"><i class="fa fa-facebook"></i></a></div><div class="social"><a href="http://twitter.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&title=' . $description['products_description'] . '"><i class="fa fa-twitter"></i></a></div></div><div class="item-sizes">'.$attr_html. '</div></div></div>';
    }

    $this->title = implode(', ', $catpath->name) . ' - ' . ($page + 1);
    echo $innerhtml;
    // echo '<div class="productloader" style="padding: 1px 8px; color: rgb(79, 79, 79); margin: 4px; clear: both; background: rgb(255, 255, 255) none repeat scroll 0% 0%; text-align: center;">Loader</div>';
    echo $downnav;
} else {
    echo 'Нет результатов';

}
?>

<script>

    $(document).ready(function () {

    });

    $(document).on('click', '.catalog-mode', function () {
        $('#partners-main-left-back').attr('style', 'display: none;');
        $('#partners-main-right-back').attr('style', 'width: 100%;');
        $('body').append('<style>' +
            '#card{' +
            'float: left;' +
            'min-height: 330px;' +
            'border-radius: 2px;' +
            'box-shadow: 0px 0px 1px 0px #AFBCAA;' +
            'margin: 5px;' +
            'width: calc(100% / 5 - 10px);' +
            'padding: 20px;' +
            'min-width: 230px;' +
            '}' +
            '</style>');
        $('.headerbside').attr('style', 'display: none;');
    });
    var inProgress = false;

    $(document).on('click', '#down', function () {
        var curPos = $(document).scrollTop();
        var height = $(window).scrollTop() + $(window).height();
        //   var scrollTime=(height-curPos)/1.73;
        var scrollTime = height / 1.73;
        $("body,html").animate({"scrollTop": height}, scrollTime);
    });
    $(document).on('click', '#up', function () {
        var curPos = $(document).scrollTop();
        // var scrollTime=curPos/1.73;
        var scrollTime = curPos / 3.73;
        $("body,html").animate({"scrollTop": 0}, scrollTime);
    });


    $(document).on('ready', function () {

        $(document).on('click', '#down', function () {

            console.log($('#card:above-the-viewport'));
        });

        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 800 && !inProgress) {

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

                }
                $url = '?cat=' + $cat + '&count=' + $count + '&start_price=' + $min_price + '&end_price=' + $max_price + '&prod_attr_query=' + $prodatrquery + '&page=' + $page + '&sort=' + $sort + '&searchword=' + $searchword;
                $url_data = split_url(document.location.hash);
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
                    $state = {
                        cat: $cat,
                        count: $count,
                        start_price: $min_price,
                        end_price: $max_price,
                        prod_attr_query: $prodatrquery,
                        page: $page,
                        sort: $sort,
                        searchword: $searchword
                    };
                    $('body').removeClass('some');
                    $('link').removeClass('some');
                    $('.preload').remove();
                    if (data[0] != 'Не найдено!') {
                        $('.headerbside').html('');
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
                            $('.bside').append('<div  class="container-fluid float" id="card" product=""><div data-prod="' + $product.products_id + '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' + encodeURI($product.products_image.replace(')', ']]]]').replace(' ', '%20').replace('(', '[[[[')) + ');"></div><div class="name">' + $description.products_name + '</div><div class="model">Арт.' + $product.products_model + '</div><div class="price"><b>' + parseInt($product.products_price) + '</b> руб.</div><a href="/site/product?id=' + $product.products_id + '"><div id="prod-info" data-prod="' + $product.products_id + '">Инфо</div></a><span>' + $attr_html + '</span><span style="bottom: 45px; width: 30px; height: 30px; top: 0px; box-shadow: none; left: -35px; position: absolute; border: 1px solid rgb(215, 215, 215); margin: 5px; cursor: pointer; padding: 4px 7px;">'
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
                            $pager += ' <a data-page="' + ($natpage - 1) + '" class="fa fa-chevron-left page  btn btn-default btn-sm lock-on" href="' + new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) + '"></a> ';
                            $pager += ' <a data-page="' + ($nextpage + 1) + '" class="fa fa-chevron-right page  btn btn-default btn-sm lock-on" href="' + new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) + '"></a> ';
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
                    if (history.pushState) {
                        history.pushState(null, null, '/site/catalog/' + new_url(split_url($url)))
                    }
                    else {
                        document.location.hash = '/site/catalog/' + new_url(split_url($url))

                    }

                });

            }
        });
    });


</script>
