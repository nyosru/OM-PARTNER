<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
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

?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $check = Yii::$app->params[constantapp]['APP_ID'];
                $checks = Yii::$app->params[constantapp]['APP_CAT'];
                $this -> title = Yii::$app->params[constantapp]['APP_NAME'];
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
                function load_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
                    static $str_load_cat = Array();
                    if (empty($arr[$parent_id])) {
                        return ;
                    } else {
                        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                            $catdesc = $arr[$parent_id][$i]['categories_id'];
                            if (!$arr[$parent_id][$i] == '') {
                               // array_push($str_load_cat, $catdesc )  ;
                                echo  $catdesc.'.';
                                load_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                            }
                        }
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
<? if(true){?>
           <div id="main-index">
               <div id="index-card-5" class="data-j index-card" data-cat="1720"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 1720, $catnamearr, $check);?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/7.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2008"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 2008, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/1.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2047"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 2047, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/2.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="1762"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 1762, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/5.jpg"></a></div>
               <div id="index-card-3" class="sort data-j index-sort" data="10"><a href="/site/catalog#!cat=<?  load_cat($arr_cat, 932, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/6.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="1836"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 1836, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/3.jpg"></a></div>
               <div id="index-card-6" class="data-j index-card" data-cat="2066"><a href="/site/catalog#!cat=<? load_cat($arr_cat, 2066, $catnamearr, $check)?>&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img src="/images/banners/4.jpg"></a></div>
           </div>

            <div id="main-spec">

                <div id="index-card-4">Специальные предложения</div>
                <?
                foreach($dataproducts as $value){
                    $outer = '';
                    $product = $value[products];
                    $description = $value[productsDescription];
                    $attr_desc = $value[productsAttributesDescr];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr[products_options_values_name].'</div></div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }

                    $product[products_image] = str_replace(')',']]]]', $product[products_image]);
                    $product[products_image] = str_replace(' ','[[[[]]]]', $product[products_image]);
                    $product[products_image] = str_replace('(','[[[[', $product[products_image]);

                    $outer .= '<div  class="container-fluid float" id="index-card-1" product=""><div data-prod="'.$product[products_id].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product[products_image].');"></div><div class="name">'.$description[products_name].'</div><div class="model">Арт.'.$product[products_model].'</div><div class="price"><b>'.intval($product[products_price]).'</b> руб.</div><div id="prod-info" data-prod="'.$product[products_id].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }


                ?>
            </div>
            <div id="main-new">
                <div id="index-card-4">Новые поступления</div>
                <?
                foreach($newproducts as $value){
                    $outer = '';
                    $product = $value[products];
                    $description = $value[productsDescription];
                    $attr_desc = $value[productsAttributesDescr];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr[products_options_values_name].'</div></div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product[products_id].'" data-model="'.$product[products_model].'" data-price="'.$product[products_price].'" data-image="'.$product[products_image].'" data-attrname="'.$value_attr[products_options_values_name].'" data-attr="'.$value_attr[products_options_values_id].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }

                    $product[products_image] = str_replace(')',']]]]', $product[products_image]);
                    $product[products_image] = str_replace(' ','[[[[]]]]', $product[products_image]);
                    $product[products_image] = str_replace('(','[[[[', $product[products_image]);

                    $outer .= '<div  class="container-fluid float" id="index-card-1"><div data-prod="'.$product[products_id].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product[products_image].');"></div><div class="name">'.$description[products_name].'</div><div class="model">Арт.'.$product[products_model].'</div><div class="price"><b>'.intval($product[products_price]).'</b> руб.</div><div id="prod-info" data-prod="'.$product[products_id].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }


                ?>
            </div>
        </div>
    </div>
<?}else{?>




<?}?>
