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

$start_url = Yii::$app->request->getQueryString();
$url_data = split_url(str_replace('&amp;', '&', str_replace('%26', '&', str_replace('_escaped_fragment_=', '#!', $start_url))));
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
    $headbside .= '<div id="partners-main-right">';
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
    foreach ($countdisp as $countdisp) {
        if ($countdisp == $count) {
            $classcount = 'countdisplay count-checked';
        } else {
            $classcount = 'countdisplay';
        }
        $innercount .= '<div class="count"> <a class="countdisplay" onclick=""  data-count=". $countdisp."  href="/' . new_url(new_suburl(split_url($url), 'count', $countdisp)) . '">. $countdisp.</a></div>';
    }
    $headbside .= '<div id="count-display"> | Показывать по<div class="count lock-on"> <a class="countdisplay" onclick=""  data-count="20"  href="' . new_url(new_suburl(split_url($url), 'count', '20')) . '">20</a></div><div class="count lock-on"> <a  class="countdisplay" onclick="" data-count="40" href="' . new_url(new_suburl(split_url($url), 'count', '40')) . '">40</a></div> </div> <div class="count lock-on"> <a class="countdisplay" onclick=""  data-count="60" href="' . new_url(new_suburl(split_url($url), 'count', '60')) . '">60</a> </div>';

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
        $attr_html = '<div class="cart-lable">В корзину</div>';
        if (count($attr_desc) > 0) {
            foreach ($attr_desc as $attr_desc_value) {
                $attr_html .= '<div class="size-desc"><div><div class="lable-item" id="input-count" data-prod="' . $product['products_id'] . '" data-model="' . $product['products_model'] . '" data-price="' . $product['products_price'] . '" data-image="' . $product['products_image'] . '" data-attrname="' . $attr_desc_value['products_options_values_name'] . '" data-attr="' . $attr_desc_value['products_options_values_id'] . '" data-name="' . $description['products_name'] . '">' . $attr_desc_value['products_options_values_name'] . '</div></div></div>';
            }
        } else {
            $attr_html .= '<div class="size-desc"><div class="lable-item"  id="input-count" data-prod="' . $product['products_id'] . '" data-model="' . $product['products_model'] . '" data-price="' . $product['products_price'] . '" data-image="' . $product['products_image'] . '" data-attrname="' . $attr_desc_value['products_options_values_name'] . '" data-attr="' . $attr_desc_value['products_options_values_id'] . '" data-name="' . $description['products_name'] . '">+</div></div>';
        }
        $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
        $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
        $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);
        $innerhtml .= '<div itemscope itemtype="http://schema.org/Product"  class="container-fluid float" id="card"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src=' . $product['products_image'] . ');"><meta itemprop="image" content="/site/imagepreview?src=' . $product['products_image'] . '"></div><div itemprop="name" class="name">' . $description['products_name'] . '</div><div itemprop="url" class="model">Артикул ' . $product['products_model'] . '</div><div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price"><b itemprop="price">' . intval($product['products_price']) . '</b> руб.</div><a href="/site/product?id=' . $product['products_id'] . '"><div itemprop="description" id="prod-info" data-prod="' . $product['products_id'] . '">Инфо</div></a><span>' . $attr_html . '</span></div>';
    }

    $this->title = implode(', ', $catpath->name) . ' - ' . ($page + 1);
    echo $innerhtml;
    echo $downnav;
} else {
    echo 'Нет результатов';

}
?>

<script>

</script>
