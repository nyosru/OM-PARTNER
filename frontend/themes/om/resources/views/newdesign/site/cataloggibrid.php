<?php
/* @var $this yii\web\View */
use yii\jui\Slider;
use frontend\widgets\Menuom;
use frontend\widgets\ProductCard;
use frontend\widgets\ProductCard2;
if (!function_exists('new_url')) {
    function new_url($arr_sub)
    {
        $new_url = Array();
        foreach ($arr_sub as $value) {
            $new_url[] = $value[0] . '=' . $value[1];
        }
        return implode('&', $new_url);
    }
}
if (!function_exists('split_url')) {
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
}
if (!function_exists('new_suburl')) {
    function new_suburl($url_obj, $val, $new_var)
    {
        $value = $url_obj[$val];
        $value[1] = $new_var;

        $url_obj[$val] = $value;
        return $url_obj;
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
$ok = $url_data['ok'][1];
$searchword = $url_data['searchword'][1];
$url =  '?cat=' . $cat . '&count=' . $count . '&start_price=' . $min_price . '&end_price=' . $max_price . '&prod_attr_query=' . $prodatrquery . '&page=' . $page . '&sort=' . $sort . '&searchword=' . $searchword.'&ok='.$ok;
if ($data[0] != 'Не найдено!') {
//
//
//echo '<div class="partners-main-right bside">';
//    $headbside = '';
//    $headbside .= '<div  class="partners-main-right headerbside">';
//    echo '<div style="width: 100%; height: 100%; float: left;" class="cat-nav">';
//    $countdisp = [60, 120, 180];
//    $innercount = '';
//    foreach ($countdisp as $key => $countdisp) {
//        if ($countdisp == $count) {
//            $classcount = 'countdisplay count-checked';
//        } else {
//            $classcount = 'countdisplay';
//        }
//        $innercount .= '<div class="count lock-on"> <a class="' . $classcount . '" onclick=""  data-count="' . $countdisp . '"  href="' . new_url(new_suburl(split_url(new_url(new_suburl(split_url($url), 'page', 0))), 'count', $countdisp)) . '">' . $countdisp . '</a></div>';
//    }
//    echo '<div id="count-display" style="float: right;"> | Показать ' . $innercount . ' </div>';
//    echo '<div id="products-counter" style="float: right;">' . $data[4] . '-' . $data[5] .  ($data[1]? 'из' . $data[1] : '' ) . '</div>';
//
//
//    echo '<div id="products-pager"></div>';
//
//    if($this->beginCache('Top-'.Yii::$app->params['constantapp']['APP_ID'].'-'.(int)Yii::$app->request->getQueryParam('cat'), ['duration' => 86400])) {
//
//        if ($catpath['num'] != 0) {
//            foreach ($catpath['num'] as $key => $catid) {
//                $menu = Menuom::widget(['property' => ['id' => 'in' . $catid, 'target' => $catid, 'opencat' => Yii::$app->params['layoutset']['opencat']]]);
//                if ($menu != false) {
//                    echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
//                    echo '<div class="panel-heading" role="tab" style="border: medium none;" id="headingOne">';
//                    echo '<div class="panel-title" style="font-size: 14px;">';
//                    echo '<a class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catid . '" href="#collapseOne' . $catid . '" aria-expanded="true" aria-controls="collapseOne' . $catid . '">';
//                    echo $catpath['name'][$key] . '<i class="fa fa-caret-down" style="padding: 5px;"></i>';
//                    echo '</a>';
//                    echo '</div>';
//                    echo '</div>';
//                    echo '<div style="position: absolute; background: rgb(245, 245, 245) none repeat scroll 0% 0%; z-index: 999;height:0px; border: 1px solid rgb(204, 204, 204); border-radius: 4px;" aria-expanded="false" id="collapseOne' . $catid . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">';
//                    echo '<div class="panel-body"  >';
//                    echo $menu;
//                    echo '</div></div></div>';
//                } else {
//                    echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
//                    echo '<div class="panel-heading" style="border-bottom: medium none;  border-top-left-radius: 0px; color: #00A5A1;" role="tab" id="headingOne">';
//                    echo '<div class="panel-title" style="font-size: 14px;">';
//                    echo '<div style="line-height: 24px;  padding: 0px 4px;" class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catid . '" href="#collapseOne' . $catid . '" aria-expanded="true" aria-controls="collapseOne' . $catid . '">';
//                    echo $catpath['name'][$key];
//                    echo '</div>';
//                    echo '</div>';
//                    echo '</div>';
//                    echo '<div style="" aria-expanded="false" id="collapseOne' . $catid . '" class="panel-collapse collapse" role="tabpanel" style="height:0px;" aria-labelledby="headingOne">';
//                    echo '</div></div>';
//                }
//
//            }
//        } else {
//            echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
//            echo '<div class="panel-heading" style="border-bottom: medium none;  border-top-left-radius: 0px; color: #00A5A1;" role="tab" id="headingOne">';
//            echo '<div class="panel-title" style="font-size: 14px;">';
//            echo '<div style="line-height: 24px;  padding: 0px 4px;" class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catpath['num'] . '" href="#collapseOne' . $catpath['num'] . '" aria-expanded="true" aria-controls="collapseOne' . $catpath['num'] . '">';
//            echo 'Каталог';
//            echo '</div>';
//            echo '</div>';
//            echo '</div>';
//            echo '<div style="" aria-expanded="false" id="collapseOne' . $catpath['num'] . '" class="panel-collapse collapse" role="tabpanel" style="height:0px;" aria-labelledby="headingOne">';
//            echo '</div></div>';
//        }
//        echo '</div>';
//        $this->endCache();
//    }
//    if($catpath['num'] != 0) {
//        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">' . end($catpath['name']) . '</h3>';
//    }else{
//        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">Каталог</h3>';
//    }
//    $headbside .=  '<form class="partners-main-right filter" action="">
//                    <div class="panel panel-default">
//                         <div class="filter-search" style="float: left; margin: 13px; font-size: 14px; width: 25%;">
//                         <form action="">
//                            <input id="search" autocomplite="off" name="searchword" class="no-shadow-form-control" placeholder="Введите артикул или название" style="color: rgb(119, 119, 119); height: 27px; float: left; width: 75%; font-size: 14px; line-height: 1; padding: 4px;" type="text">
//                        <button class="btn btn-default data-j" type="submit" style="width: 25%; height: 27px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; left: -5px; margin-right: 0px; float: left; font-size: 14px; line-height: 0.9;">
//                            Найти
//                        </button></form></div>';
//    $headbside .=
//    '<div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="selected-count badge"></div><a class="top-link" href="/glavnaya/selectedproduct"><i class="fa fa-star" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>
//                    <div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="cart-count badge"></div><a class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>';
//
//    $headbside .='<div class="filter-auth" style="float: right; width: 25%; padding: 14px; font-size: 14px; font-weight: 300;">';
//
//                            if(Yii::$app->user->isGuest){
//                                $headbside .='<div style="float: right; line-height: 2;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left; line-height: 0.9;">&#xE7FF;</i><a data-toggle="modal" style="float: left; cursor:pointer;" data-target="#authform">Вход</a>';
//                                 $headbside .= '</div>';
//                                 $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/signup"><span style="float: left; margin: 4px;">Регистрация</span></a></div>';
//                               }else{
//                                 $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
//                                 $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/lk"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
//                            }
//
//                      $headbside .=   '</div>
//                         <a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">
//
//                           <div class="panel-heading" role="tab" id="headingOne">
//
//                            <h4 class="panel-title">
//                                        Показать фильтр
//
//                            </h4>
//                        </div>
//                         </a>
//                    <div style="height: 0px; position: relative;    z-index: 999;" aria-expanded="false" id="filter-cont" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
//                        <div class="panel-body">';
//    $headbside .=           '<div style="padding: 10px 0px;">'.
//                                'Цена'.
//                            '</div>'.
//                            '<div style="display: block; height: 45px;" >'.
//                            '<input name="cat"   value="'.$cat.'" type="hidden"/>'.
//                             '<input name="count" value="'.$count.'" type="hidden" />'.
//                                '<input name="start_price" id="min-ev-price" class="" placeholder="от" style="float: left; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" />'.
//                                '<input name="end_price" style="float: right; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" id="max-ev-price" class="" placeholder="до" />'.
//                             '</div>'.
//                            Slider::widget([
//                                'id'=>'price-slider',
//                                'options'=>['style'=>'width: 95%; margin: auto;border: 1px solid #CCC;'],
//                                'clientOptions' => [
//                                'values'=>[$data[7],$data[8]],
//                                'min' => 0,
//                                'max' => $data[2]['maxprice'],
//                                'step' => 1,
//                                'range' => true,
//                                ],
//                            ]);
//        $headbside .=   '<div><hr style="border-color: #CCC">'.
//        'Дата'.
//           '</div>'.\kartik\date\DatePicker::widget([
//                'options'=>[
//                    'placeholder'=>'C',
//                ],
//
//                'language'=>'ru',
//                'name' => 'date_start',
//                'value' => '',
//                'pluginOptions' => [
//                    'autoclose'=>true,
//                    'format' => 'dd-mm-yyyy'
//                ]
//            ]).\kartik\date\DatePicker::widget([
//                'options'=>[
//                    'placeholder'=>'До',
//                ],
//
//                'language'=>'ru',
//                'name' => 'date_end',
//                'value' => '',
//                'pluginOptions' => [
//                    'autoclose'=>true,
//                    'format' => 'dd-mm-yyyy'
//                ]
//            ]);
//    if(count($data[3])>1){
//    $headbside .=           '<div><hr style="border-color: #CCC">'.
//                            'Размеры'.
//                            '</div>'.
//                            '<div class="size-inner" style="">';
//                             $data[3] = \yii\helpers\ArrayHelper::index($data[3], 'products_options_values_name');
//        ksort($data[3],SORT_NATURAL);
//    foreach($data[3] as $key=>$value){
//        if($value['products_options_values_id'] == $prodatrquery){
//            $checked = 'fa-check';
//        }else{
//            $checked = '';
//        }
//        if($value['products_options_values_id']) {
//            $headbside .=       '<div class="filter-item-size">';
//
//            $headbside .= '<div class="checkbox-overlay fa '.$checked.'" for="checkbox-hidden-group">'.
//                '<input id="checkbox-hidden-group"  class="checkbox-hidden-group" type="checkbox" class="prod_attr_query" value="'.$value['products_options_values_id'].
//                '" name = "prod_attr_query"'.
//                ' '. $checked.' /></div><span class="checkbox-hidden-group-label" style="display: inline; min-width: 100px; color: black; margin-left: 10px; font-weight: 300; font-size: 12px; padding-left: 20px; line-height: 1.7; max-width: calc(100% - 50px); overflow: hidden; float: left;">'.$value['products_options_values_name'].'</span>';
//
//    $headbside .=               '</div>';
//        }
//
//    }
//        $headbside .=               '</div>';
//    }
//
//    $headbside .=                       '<hr style="border-color: #CCC"><div style="position: relative; height: 38px;" class="panel-footer" role="tab" id="headingOne">'.
//        '<button class="btn" type="submit" style="height: 28px; float: left; line-height: 1; background: #00a5a1; color: rgb(0, 0, 0); font-weight: 300;">Применить</button><a href="?cat='.$cat.'&amp;count='.$count.'&amp;start_price=&amp;end_price=1000000&amp;prod_attr_query=&amp;page=0&amp;sort=0&amp;searchword=" style="height: 28px; float: right; line-height: 1; color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); font-weight: 300;" class="btn  reset-filter">Сбросить</a>'.
//        '</div>'. '</div>'.
//                        '</div>'.
//                    '</div>'.
//        '<input name="page"  value="0" type="hidden"/>'.
//        '<input name="sort"  value="0"  type="hidden"/>'.
//        '<input name="searchword"   value="" type="hidden"/>'.
//                '</form>';
//
//
//    $headbside .= $topnav;
//    $headbside .= '<div class="partheaderbside">';
//
//    $headbside .= '<a href="'.BASEURL.'/changecardview" style="float: right; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); padding: 0px 25px; border-radius: 4px; font-weight: 500;">Вид</a>';
//
//    $headbside .= ' <a href="#demo" style="float: left; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); border-radius: 4px; font-weight: 500; padding: 0px 25px; text-align: center; width: 200px;" data-toggle="collapse">Сортировка</a>';
//    $headbside .= ' <a href="' . new_url(new_suburl(split_url($url),'ok', abs($ok-1))).'" style="float: left; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); border-radius: 4px; font-weight: 500; padding: 0px 25px; text-align: center; width: 200px;">ОК</a>';
//
//    $headbside .= '<div id="demo" style="width: 200px; position: absolute; margin-top: 25px; z-index: 98;" class="collapse">';
//    $headbside .= '<div id="sort-order"><div  class="header-sort sort sort-checked" data="' . $data[11] . '"></div>';
//
//    $sortorder = [['дате', 0, 10, 'date'], ['цене', 1, 11, 'price'], ['названию', 2, 12, 'name'], ['модели', 3, 13, 'model'], ['популярности', 4, 14, 'popular']];
//    foreach ($sortorder as $value) {
//        if (intval($data[11]) == intval($value[1])) {
//            $dataord = $value[2];
//            $arrow = 'caret-up';
//        } else {
//            $dataord = $value[1];
//            $arrow = 'caret-down';
//        }
//        if ($dataord == $data[11]) {
//            $class = 'sort  sort-checked';
//        } else {
//            $class = 'sort ';
//        }
//        if ($value[1] == $data[11] || $value[2] == $data[11]) {
//            $headbside .= '<a class="' . $class . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '" data="' . $dataord . '" href="#"><div class="header-sort-item-'.$value[3].' header-sort-item active lock-on">'. $value[0] . ' <i style="float: right; padding: 3px 10px;" class="fa fa-' . $arrow . '"> </i></div></a>';
//        } else {
//            $headbside .= '<a class="' . $class . '" data="' . $dataord . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '"><div class="header-sort-item-'.$value[3].' header-sort-item lock-on">' . $value[0] . '</div></a>';
//        }
//    }
//    $headbside .= '</div></div></div></div>';
//    echo $headbside;
//    $innerhtml = '';
//?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>→ </span></li>
                    <li class=""> <a title="Go to Home Page" href="grid.html">Women</a><span>→ </span></li>
                    <li class="category13"><strong>Tops &amp; Tees</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="main-container col2-left-layout bounceInUp animated">
    <div class="category-description std">
        <div class="container">
            <div class="slider-items-products">
                <div id="category-desc-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col1 owl-carousel owl-theme" style="opacity: 1; display: block;">

                        <!-- Item -->
                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 4680px; left: 0px; display: block; transition: all 500ms ease; transform: translate3d(0px, 0px, 0px);"><div class="owl-item" style="width: 1170px;"><div class="item"> <a href="#"><img alt="" src="images/category-img1.jpg"></a>
                                        <div class="cat-img-title cat-bg cat-box">
                                            <div class="small-tag"><span>Sale</span>  10% OFF</div>
                                            <h2 class="cat-heading">Women Collection</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                        </div>
                                    </div></div><div class="owl-item" style="width: 1170px;"><div class="item"> <a href="#"><img alt="" src="images/category-img2.jpg"></a>



                                        <!-- End Item -->

                                    </div></div></div></div>
                        <!-- End Item -->

                        <!-- Item -->

                        <div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><a class="flex-prev"></a></div><div class="owl-next"><a class="flex-next"></a></div></div></div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class=" col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="page-title">
                        <h2>Tops &amp; Tees</h2>
                    </div>

                    <div class="toolbar">
                        <div class="sorter">
                            <div class="view-mode"> <span title="Grid" class="button button-active button-grid">&nbsp;</span><a href="list.html" title="List" class="button-list">&nbsp;</a> </div>
                        </div>
                        <div id="sort-by">
                            <label class="left">Sort By: </label>
                            <ul>
                                <li><a href="#">Position<span class="right-arrow"></span></a>
                                    <ul>
                                        <li><a href="#">Name</a></li>
                                        <li><a href="#">Price</a></li>
                                        <li><a href="#">Position</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <a class="button-asc left" href="#" title="Set Descending Direction"><span class="top_arrow"></span></a> </div>
                        <div class="pager">
                            <div id="limiter">
                                <label>View: </label>
                                <ul>
                                    <li><a href="#">15<span class="right-arrow"></span></a>
                                        <ul>
                                            <li><a href="#">20</a></li>
                                            <li><a href="#">30</a></li>
                                            <li><a href="#">35</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="pages">
                                <label>Page:</label>
                                <ul class="pagination">
                                    <li><a href="#">«</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">»</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="category-products">
                        <ul class="products-grid">
                            <?php
                            foreach ($data[0] as $value) {
                                echo '<li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">';
                                echo \frontend\widgets\ProductCardFabia1::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'catpath'=>$catpath, 'man_time'=>$man_time, 'category'=>$value['categories_id']]);
                                echo '</li>';
                            }

                            ?>

                        </ul>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <aside class="col-left sidebar">

                    <div class="side-nav-categories">
                        <div class="block-title"> Categories </div>
                        <!--block-title-->
                        <!-- BEGIN BOX-CATEGORY -->
                        <div class="box-content box-category">
                            <ul>
                                <li> <a class="active" href="#/women.html">Women</a> <span class="subDropdown minus"></span>
                                    <ul class="level0_415">
                                        <li> <a href="#/women/tops.html"> Tops </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/tops/evening-tops.html"> Evening Tops </a> </li>
                                                <li> <a href="#/women/tops/shirts-blouses.html"> Shirts &amp; Blouses </a> </li>
                                                <li> <a href="#/women/tops/tunics.html"> Tunics </a> </li>
                                                <li> <a href="#/women/tops/vests.html"> Vests </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/bags.html"> Bags </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/bags/bags.html"> Bags </a> </li>
                                                <li> <a href="#/women/bags/designer-handbags.html"> Designer Handbags </a> </li>
                                                <li> <a href="#/women/bags/purses.html"> Purses </a> </li>
                                                <li> <a href="#/women/bags/shoulder-bags.html"> Shoulder Bags </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/shoes.html"> Shoes </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/shoes/flat-shoes.html"> Flat Shoes </a> </li>
                                                <li> <a href="#/women/shoes/flat-sandals.html"> Flat Sandals </a> </li>
                                                <li> <a href="#/women/shoes/boots.html"> Boots </a> </li>
                                                <li> <a href="#/women/shoes/heels.html"> Heels </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/Jewellery.html"> Jewellery </a>
                                            <ul class="level1">
                                                <li> <a href="#/women/Jewellery/bracelets.html"> Bracelets </a> </li>
                                                <li> <a href="#/women/Jewellery/necklaces-pendants.html"> Necklaces &amp; Pendants </a> </li>
                                                <li> <a href="#/women/Jewellery/pins-brooches.html"> Pins &amp; Brooches </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/dresses.html"> Dresses </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/dresses/casual-dresses.html"> Casual Dresses </a> </li>
                                                <li> <a href="#/women/dresses/evening.html"> Evening </a> </li>
                                                <li> <a href="#/women/dresses/designer.html"> Designer </a> </li>
                                                <li> <a href="#/women/dresses/party.html"> Party </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/lingerie.html"> Lingerie </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/lingerie/bras.html"> Bras </a> </li>
                                                <li> <a href="#/women/lingerie/bodies.html"> Bodies </a> </li>
                                                <li> <a href="#/women/lingerie/necklaces-pendants.html"> Lingerie Sets </a> </li>
                                                <li> <a href="#/women/lingerie/shapewear.html"> Shapewear </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/jackets.html"> Jackets </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/jackets/coats.html"> Coats </a> </li>
                                                <li> <a href="#/women/jackets/jackets.html"> Jackets </a> </li>
                                                <li> <a href="#/women/jackets/leather-jackets.html"> Leather Jackets </a> </li>
                                                <li> <a href="#/women/jackets/blazers.html"> Blazers </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/women/swimwear.html"> Swimwear </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/women/swimwear/swimsuits.html"> Swimsuits </a> </li>
                                                <li> <a href="#/women/swimwear/beach-clothing.html"> Beach Clothing </a> </li>
                                                <li> <a href="#/women/swimwear/bikinis.html"> Bikinis </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                    </ul>
                                    <!--level0-->
                                </li>
                                <!--level 0-->
                                <li> <a href="#/men.html">Men</a> <span class="subDropdown plus"></span>
                                    <ul class="level0_455">
                                        <li> <a href="#/men/shoes.html"> Shoes </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/men/shoes/flat-shoes.html"> Flat Shoes </a> </li>
                                                <li> <a href="#/men/shoes/boots.html"> Boots </a> </li>
                                                <li> <a href="#/men/shoes/heels.html"> Heels </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/men/Jewellery.html"> Jewellery </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/men/Jewellery/bracelets.html"> Bracelets </a> </li>
                                                <li> <a href="#/men/Jewellery/necklaces-pendants.html"> Necklaces &amp; Pendants </a> </li>
                                                <li> <a href="#/men/Jewellery/pins-brooches.html"> Pins &amp; Brooches </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/men/dresses.html"> Dresses </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/men/dresses/casual-dresses.html"> Casual Dresses </a> </li>
                                                <li> <a href="#/men/dresses/evening.html"> Evening </a> </li>
                                                <li> <a href="#/men/dresses/designer.html"> Designer </a> </li>
                                                <li> <a href="#/men/dresses/party.html"> Party </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/men/jackets.html"> Jackets </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/men/jackets/coats.html"> Coats </a> </li>
                                                <li> <a href="#/men/jackets/jackets.html"> Jackets </a> </li>
                                                <li> <a href="#/men/jackets/leather-jackets.html"> Leather Jackets </a> </li>
                                                <li> <a href="#/men/jackets/blazers.html"> Blazers </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/men/swimwear.html"> Swimwear </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/men/swimwear/swimsuits.html"> Swimsuits </a> </li>
                                                <li> <a href="#/men/swimwear/beach-clothing.html"> Beach Clothing </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                    </ul>
                                    <!--level0-->
                                </li>
                                <!--level 0-->
                                <li> <a href="#.html">Electronics</a> <span class="subDropdown plus"></span>
                                    <ul class="level0_482">
                                        <li> <a href="#/smartphones.html"> Smartphones </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/smartphones/samsung.html"> Samsung </a> </li>
                                                <li> <a href="#/smartphones/apple.html"> Apple </a> </li>
                                                <li> <a href="#/smartphones/blackberry.html"> Blackberry </a> </li>
                                                <li> <a href="#/smartphones/nokia.html"> Nokia </a> </li>
                                                <li> <a href="#/smartphones/htc.html"> HTC </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/cameras.html"> Cameras </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/cameras/digital-cameras.html"> Digital Cameras </a> </li>
                                                <li> <a href="#/cameras/camcorders.html"> Camcorders </a> </li>
                                                <li> <a href="#/cameras/lenses.html"> Lenses </a> </li>
                                                <li> <a href="#/cameras/filters.html"> Filters </a> </li>
                                                <li> <a href="#/cameras/tripod.html"> Tripod </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                        <li> <a href="#/accesories.html"> Accesories </a> <span class="subDropdown plus"></span>
                                            <ul class="level1">
                                                <li> <a href="#/accesories/headsets.html"> HeadSets </a> </li>
                                                <li> <a href="#/accesories/batteries.html"> Batteries </a> </li>
                                                <li> <a href="#/accesories/screen-protectors.html"> Screen Protectors </a> </li>
                                                <li> <a href="#/accesories/memory-cards.html"> Memory Cards </a> </li>
                                                <li> <a href="#/accesories/cases.html"> Cases </a> </li>
                                                <!--end for-each -->
                                            </ul>
                                            <!--level1-->
                                        </li>
                                        <!--level1-->
                                    </ul>
                                    <!--level0-->
                                </li>
                                <!--level 0-->
                                <li> <a href="#/digital.html">Digital</a> </li>
                                <!--level 0-->
                                <li class="last"> <a href="#/fashion.html">Fashion</a> </li>
                                <!--level 0-->
                            </ul>
                        </div>
                        <!--box-content box-category-->
                    </div>


                    <div class="block block-layered-nav">
                        <div class="block-title">Shop By</div>
                        <div class="block-content">
                            <p class="block-subtitle">Shopping Options</p>
                            <dl id="narrow-by-list">
                                <dt class="odd">Price</dt>
                                <dd class="odd">
                                    <ol>
                                        <li> <a href="#"><span class="price">$0.00</span> - <span class="price">$99.99</span></a> (6) </li>
                                        <li> <a href="#"><span class="price">$100.00</span> and above</a> (6) </li>
                                    </ol>
                                </dd>
                                <dt class="even">Manufacturer</dt>
                                <dd class="even">
                                    <ol>
                                        <li> <a href="#">TheBrand</a> (9) </li>
                                        <li> <a href="#">Company</a> (4) </li>
                                        <li> <a href="#">LogoFashion</a> (1) </li>
                                    </ol>
                                </dd>
                                <dt class="odd">Color</dt>
                                <dd class="odd">
                                    <ol>
                                        <li> <a href="#">Green</a> (1) </li>
                                        <li> <a href="#">White</a> (5) </li>
                                        <li> <a href="#">Black</a> (5) </li>
                                        <li> <a href="#">Gray</a> (4) </li>
                                        <li> <a href="#">Dark Gray</a> (3) </li>
                                        <li> <a href="#">Blue</a> (1) </li>
                                    </ol>
                                </dd>
                                <dt class="last even">Size</dt>
                                <dd class="last even">
                                    <ol>
                                        <li> <a href="#">S</a> (6) </li>
                                        <li> <a href="#">M</a> (6) </li>
                                        <li> <a href="#">L</a> (4) </li>
                                        <li> <a href="#">XL</a> (4) </li>
                                    </ol>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="block block-cart">
                        <div class="block-title ">My Cart</div>
                        <div class="block-content">
                            <div class="summary">
                                <p class="amount">There are <a href="#">2 items</a> in your cart.</p>
                                <p class="subtotal"> <span class="label">Cart Subtotal:</span> <span class="price">$27.99</span> </p>
                            </div>
                            <div class="ajax-checkout">
                                <button class="button button-checkout" title="Submit" type="submit"><span>Checkout</span></button>
                            </div>
                            <p class="block-subtitle">Recently added item(s) </p>
                            <ul>
                                <li class="item"> <a href="product_detail.html" title="Fisher-Price Bubble Mower" class="product-image"><img src="products-images/product23.jpg" alt="Fisher-Price Bubble Mower"></a>
                                    <div class="product-details">
                                        <div class="access"> <a href="#" title="Remove This Item" class="btn-remove1"> <span class="icon"></span> Remove </a> </div><strong>1</strong> x <span class="price">$19.99</span>
                                        <p class="product-name"> <a href="product_detail.html">Sample Product</a> </p>
                                    </div>
                                </li>
                                <li class="item last"> <a href="product_detail.html" title="Prince Lionheart Jumbo Toy Hammock" class="product-image"><img src="products-images/product22.jpg" alt="Prince Lionheart Jumbo Toy Hammock"></a>
                                    <div class="product-details">
                                        <div class="access"> <a href="#" title="Remove This Item" class="btn-remove1"> <span class="icon"></span> Remove </a> </div><strong>1</strong> x <span class="price">$8.00</span>
                                        <p class="product-name"> <a href="product_detail.html"> Sample Product</a> </p>

                                        <!--access clearfix-->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="block block-compare">
                        <div class="block-title ">Compare Products (2)</div>
                        <div class="block-content">
                            <ol id="compare-items">
                                <li class="item odd">
                                    <input type="hidden" value="2173" class="compare-item-id">
                                    <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Polyester Wrapped Cushions</a> </li>
                                <li class="item last even">
                                    <input type="hidden" value="2174" class="compare-item-id">
                                    <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a> </li>
                            </ol>
                            <div class="ajax-checkout">
                                <button type="submit" title="Submit" class="button button-compare"><span>Compare</span></button>
                                <button type="submit" title="Submit" class="button button-clear"><span>Clear</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="block block-list block-viewed">
                        <div class="block-title"> Recently Viewed </div>
                        <div class="block-content">
                            <ol id="recently-viewed-items">
                                <li class="item odd">
                                    <p class="product-name"><a href="#"> Armchair with Box-Edge Upholstered Arm</a></p>
                                </li>
                                <li class="item even">
                                    <p class="product-name"><a href="#"> Pearce Upholstered Slee pere</a></p>
                                </li>
                                <li class="item last odd">
                                    <p class="product-name"><a href="#"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a></p>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="block block-poll">
                        <div class="block-title">Community Poll </div>
                        <form id="pollForm" action="#" method="post" onsubmit="return validatePollAnswerIsSelected();">
                            <div class="block-content">
                                <p class="block-subtitle">What is your favorite Magento feature?</p>
                                <ul id="poll-answers">
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_5" value="5">
                      <span class="label">
                      <label for="vote_5">Layered Navigation</label>
                      </span> </li>
                                    <li class="even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_6" value="6">
                      <span class="label">
                      <label for="vote_6">Price Rules</label>
                      </span> </li>
                                    <li class="odd">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_7" value="7">
                      <span class="label">
                      <label for="vote_7">Category Management</label>
                      </span> </li>
                                    <li class="last even">
                                        <input type="radio" name="vote" class="radio poll_vote" id="vote_8" value="8">
                      <span class="label">
                      <label for="vote_8">Compare Products</label>
                      </span> </li>
                                </ul>
                                <div class="actions">
                                    <button type="submit" title="Vote" class="button button-vote"><span>Vote</span></button>
                                </div>
                            </div>
                        </form>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</section>
<?php
} else {
    echo '<div style="text-align: center; font-size: 40px; position: relative;  min-height: 100%;">Нет результатов</div>';
}
?>

    <script>
    $(document).on('slide', '#price-slider',function( event, ui){
        $('#min-ev-price').val(ui.values[0]);
        $('#max-ev-price').val(ui.values[1]);

    });
    $(document).on('ready', function( event, ui){
        $('#min-ev-price').val('<?=$data[7]?>');
        $('#max-ev-price').val('<?=(integer)$data[2]['maxprice']?>');
        if($('.filter').length >0){
        var HeaderTop = $('.filter').offset().top;
        $(window).scroll(function () {
            if ($(window).scrollTop() > HeaderTop) {
                $('.filter').addClass('fixedbar-filter');
                $('.headerbside').addClass('headerbside-filter');
                // $('.cart-dialog-info').addClass('fixeddialog');
            } else {
                $('.filter').removeClass('fixedbar-filter');
                $('.headerbside').removeClass('headerbside-filter');
                //  $('.cart-dialog-info').removeClass('fixeddialog');
            }
        });
       }

    });
    $(document).on('click', '.reset-filter',  function( event, ui){
        $('#min-ev-price').val('<?=$data[7]?>');
        $('#max-ev-price').val('<?=(integer)$data[2]['maxprice']?>');
        $('[name="prod_attr_query"]:checked').removeAttr('checked');
        $('[class*=checkbox-overlay]').removeClass('fa-check');
    });
    $(document).on('click', '.filter > .panel  > a',  function(){
        if($('#filter-cont').attr('class').indexOf('collapse in')+1) {
            $(this).html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Показать фильтр </h4> </div>');
            $('#filter-cont').removeClass('in');
        }else{
            $(this).html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Свернуть фильтр</h4> </div>');
            $(this).find(':first-child').addClass('no-border-bottom-rad');
            $('#filter-cont').addClass('in');
        }
    });
    $(document).on('click', '[class*=checkbox-overlay]', function(){
        $('[class*=checkbox-overlay]').removeClass('fa-check');
        $inputs=document.getElementsByClassName("checkbox-hidden-group");
        $.each($inputs, function(){
            this.checked = false;
        });
        $(this).children().prop('checked', true);
        $(this).addClass('fa-check');
    });
//    $(document).on('ready', function(){
//        $('a[rel=light]').light();
//    });
    </script>

