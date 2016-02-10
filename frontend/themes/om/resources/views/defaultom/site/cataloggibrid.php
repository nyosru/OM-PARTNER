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
use common\traits\Imagepreviewfile;
use kartik\slider\SliderAsset;
use yii\jui\Slider;
use frontend\widgets\Menuom;
use Zelenin\yii\SemanticUI\modules\Checkbox;
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
$url_data = split_url(str_replace('&amp;', '&', str_replace('%26', '&', $start_url)));
$cat = $url_data['cat'][1];
$count = $url_data['count'][1];
$min_price = $url_data['start_price'][1];
$max_price = $url_data['end_price'][1];
$prodatrquery = $url_data['prod_attr_query'][1];
$page = $url_data['page'][1];
$sort = $url_data['sort'][1];
$searchword = $url_data['searchword'][1];
$url = BASEURL . '/catalog?cat=' . $cat . '&count=' . $count . '&start_price=' . $min_price . '&end_price=' . $max_price . '&prod_attr_query=' . $prodatrquery . '&page=' . $page . '&sort=' . $sort . '&searchword=' . $searchword;
if ($data[0] != 'Не найдено!') {
    $headbside = '';
    $headbside .= '<div id="partners-main-right" class="headerbside">';
    echo '<div style="width: 100%; height: 100%; float: left;" class="cat-nav">';
    if($catpath->num != 0){
    foreach($catpath->num as $key => $catid) {
        $menu = Menuom::widget(['property' => ['id' => 'in'.$catid, 'target' => $catid, 'opencat' => Yii::$app->params['layoutset']['opencat']]]);
        if ($menu != false) {
            echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
            echo '<div class="panel-heading" role="tab" style="border: medium none;" id="headingOne">';
            echo '<div class="panel-title" style="font-size: 14px;">';
            echo '<a class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catid . '" href="#collapseOne' . $catid . '" aria-expanded="true" aria-controls="collapseOne' . $catid . '">';
            echo $catpath->name[$key] . '<i class="fa fa-caret-down" style="padding: 5px;"></i>';
            echo '</a>';
            echo '</div>';
            echo '</div>';
            echo '<div style="position: absolute; background: rgb(245, 245, 245) none repeat scroll 0% 0%; z-index: 999; border: 1px solid rgb(204, 204, 204); border-radius: 4px;" aria-expanded="false" id="collapseOne' . $catid . '" class="panel-collapse collapse" role="tabpanel" style="height:0px;" aria-labelledby="headingOne">';
            echo '<div class="panel-body"  >';
            echo $menu;
            echo '</div></div></div>';
    }else{
            echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
            echo '<div class="panel-heading" style="border-bottom: medium none;  border-top-left-radius: 0px; color: #00A5A1;" role="tab" id="headingOne">';
            echo '<div class="panel-title" style="font-size: 14px;">';
            echo '<div style="line-height: 24px;  padding: 0px 4px;" class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catid . '" href="#collapseOne' . $catid . '" aria-expanded="true" aria-controls="collapseOne' . $catid . '">';
            echo $catpath->name[$key];
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div style="" aria-expanded="false" id="collapseOne' . $catid . '" class="panel-collapse collapse" role="tabpanel" style="height:0px;" aria-labelledby="headingOne">';
            echo '</div></div>';
        }

    }
    }else{
        echo '<div class="panel panel-default" style="width: auto; margin: 0px; float: left; border: medium none; box-shadow: none;">';
        echo '<div class="panel-heading" style="border-bottom: medium none;  border-top-left-radius: 0px; color: #00A5A1;" role="tab" id="headingOne">';
        echo '<div class="panel-title" style="font-size: 14px;">';
        echo '<div style="line-height: 24px;  padding: 0px 4px;" class="" role="button" data-toggle="collapse" data-parent="#accordion' . $catpath->num  . '" href="#collapseOne' . $catpath->num  . '" aria-expanded="true" aria-controls="collapseOne' . $catpath->num  . '">';
        echo 'Каталог';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div style="" aria-expanded="false" id="collapseOne' . $catpath->num . '" class="panel-collapse collapse" role="tabpanel" style="height:0px;" aria-labelledby="headingOne">';
        echo '</div></div>';
    }
    echo '</div>';
    if($catpath->num != 0) {
        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">' . end($catpath->name) . '</h3>';
    }else{
        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">Каталог</h3>';
    }
//    if ($data[5] >= $data[1] && $data[4] == 0) {
//    } else {
//        $pager = '';
//        $countpager = floor($data[1] / $count);
//        if ($data[10] != NULL) {
//
//            if (intval($data[10]) < 1) {
//                $natpage = 1;
//                $nextpage = 0;
//            } else if (intval($data[10]) + 1 >= $countpager) {
//                $natpage = $countpager - 1;
//                $nextpage = $countpager - 2;
//            } else {
//                $natpage = intval($data[10]);
//                $nextpage = intval($data[10]);
//            }
//        } else {
//            $natpage = 1;
//            $nextpage = 0;
//            $data[10] = 0;
//        }
//        $pager .= ' <a data-page="' . intval($data[10]) . '" class="page " href="#">' . (intval($data[10]) + 1) . '</a> ';
//        $pager .= 'из ' . $countpager;
//        $pager .= ' <a data-page="' . ($natpage - 1) . '" class="fa fa-chevron-left page  btn btn-default btn-sm lock-on" href="' . new_url(new_suburl(split_url($url), 'page', ($natpage - 1))) . '"></a> ';
//        $pager .= ' <a data-page="' . ($nextpage + 1) . '" class="fa fa-chevron-right page  btn btn-default btn-sm lock-on" href="' . new_url(new_suburl(split_url($url), 'page', ($nextpage + 1))) . '"></a> ';
//        $topnav = '<div id="products-pager" style="display: none">Страница: ' . $pager . '</div>';
//        $downnav = '<div id="products-pager-down">Страница: ' . $pager . '</div>';
//    }
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

    $headbside .= $topnav;
    $headbside .= '<div id="count-display" style="float: right;"> | Показать ' . $innercount . ' </div>';
    $headbside .= '<div id="products-counter" style="float: right;">' . $data[4] . '-' . $data[5] . ' из ' . $data[1] . '</div>';


    $headbside .= '<div id="products-pager"></div>';
    //   $url = new_url(new_suburl(split_url($url), '#!cat', data[16].join('/')));


    $headbside .= '<div id="sort-order"><div  class="header-sort sort sort-checked" data="' . $data[11] . '"></div>';
    $sortorder = [['дате', 0, 10, 'date'], ['цене', 1, 11, 'price'], ['названию', 2, 12, 'name'], ['модели', 3, 13, 'model'], ['популярности', 4, 14, 'popular']];
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
            $headbside .= '<a class="' . $class . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '" data="' . $dataord . '" href="#"><div class="header-sort-item-'.$value[3].' header-sort-item active lock-on">'. $value[0] . ' <i class="fa fa-' . $arrow . '"> </i></div></a>';
        } else {
            $headbside .= '<a class="' . $class . '" data="' . $dataord . '" href="' . new_url(new_suburl(split_url($url), 'sort', $dataord)) . '"><div class="header-sort-item-'.$value[3].' header-sort-item lock-on">' . $value[0] . '</div></a>';
        }
    }
    $headbside .= '</div></div>
                <form id="partners-main-right" class="filter" action="'.BASEURL.'/catalog">
                    <div class="panel panel-default">
                         <a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" href="#filter-cont" aria-expanded="false" aria-controls="collapseOne">
                           <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                        Показать фильтр

                            </h4>
                        </div>
                         </a>
                    <div style="height: 0px; position: relative;    z-index: 999;" aria-expanded="false" id="filter-cont" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">';
    $headbside .=           '<div style="padding: 10px 0px;">'.
                                'Цена'.
                            '</div>'.
                            '<div style="display: block; height: 45px;" >'.
        '<input name="cat"   value="'.$cat.'" type="hidden"/>'.
        '<input name="count" value="'.$count.'" type="hidden" />'.
                                '<input name="start_price" id="min-ev-price" class="" placeholder="от" style="float: left; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" />'.
                                '<input name="end_price" style="float: right; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" id="max-ev-price" class="" placeholder="до" />'.
        '</div>'.
                            Slider::widget([
                                'id'=>'price-slider',
                                'options'=>['style'=>'width: 95%; margin: auto;border: 1px solid #CCC;'],
                                'clientOptions' => [
                                'values'=>[$data[7],$data[8]],
                                'min' => 0,
                                'max' => $data[2]['maxprice'],
                                'step' => 1,
                                'range' => true,
                                ],
                            ]);
    if(count($data[3])>1){
    $headbside .=           '<div><hr style="border-color: #CCC">'.
                            'Размеры'.
                            '</div>'.
                            '<div class="size-inner" style="">';
    foreach($data[3] as $key=>$value){
        if($value['products_options_values_id'] == $prodatrquery){
            $checked = 'fa-check';
        }else{
            $checked = '';
        }
        if($value['products_options_values_id']) {
            $headbside .=       '<div class="filter-item-size">';

            $headbside .= '<div class="checkbox-overlay fa '.$checked.'" for="checkbox-hidden-group">'.
                '<input id="checkbox-hidden-group"  class="checkbox-hidden-group" type="checkbox" class="prod_attr_query" value="'.$value['products_options_values_id'].
                '" name = "prod_attr_query"'.
                ' '. $checked.' /></div><span class="checkbox-hidden-group-label" style="display: inline; min-width: 100px; color: black; margin-left: 10px; font-family: Roboto,sans-serif; font-weight: 300; font-size: 12px; padding-left: 20px; line-height: 1.7; max-width: calc(100% - 50px); overflow: hidden; float: left;">'.$value['products_options_values_name'].'</span>';

    $headbside .=               '</div>';
        }

    }
        $headbside .=               '</div>';
    }

    $headbside .=                       '<hr style="border-color: #CCC"><div style="position: relative; height: 38px;" class="panel-footer" role="tab" id="headingOne">'.
        '<button class="btn" type="submit" style="height: 28px; float: left; line-height: 1; background: rgb(224, 224, 224) none repeat scroll 0% 0%; color: rgb(0, 0, 0); font-weight: 300;">Применить</button><a href="'.BASEURL.'/catalog?cat='.$cat.'&amp;count='.$count.'&amp;start_price=&amp;end_price=1000000&amp;prod_attr_query=&amp;page=0&amp;sort=0&amp;searchword=" style="height: 28px; float: right; line-height: 1; color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); font-weight: 300;" class="btn  reset-filter">Сбросить</a>'.
        '</div>'. '</div>'.
                        '</div>'.
                    '</div>'.
        '<input name="page"  value="0" type="hidden"/>'.
        '<input name="sort"  value="0"  type="hidden"/>'.
        '<input name="searchword"   value="" type="hidden"/>'.
                '</form>';
    echo $headbside;
    $innerhtml = '';
    foreach ($data[0] as $value) {
        $product = $value['products'];
        $description = $value['productsDescription'];
        $attr_desc = $value['productsAttributesDescr'];
        $attr_html = '<div data-sale="'.$product['products_id'].'" class="cart-lable">В корзину</div>';
        ?>

        <?
        if (count($attr_desc) > 0) {
            foreach ($attr_desc as $key=>$attr_desc_value) {
                if($key%2 ==0){
                    $class='border-right:1px solid #CCC';
                }else{
                    $class='';
                }
                $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; '.$class.';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'.$attr_desc_value['products_options_values_name'].'</div>'.
                '<input  id="input-count"'.
                'style="width: 50%; height: 23px; text-align: center; position: relative; top: 0px;"'.
                'data-prod="'. $product['products_id'].'"'.
                'data-model="'. $product['products_model'].'"'.
                'data-price="'. (integer)$product['products_price'].'"'.
                'data-image="'. $product['products_image'].'"'.
                'data-attrname="'.$attr_desc_value['products_options_values_name'].'"'.
                'data-attr="'.$attr_desc_value['products_options_values_id'].'"'.
                'placeholder="0"'.
                'type="text">'.
                '<div id="add-count" style="margin: 0px;">'.
                '+'.
                '</div>'.
                '<div id="del-count" style="margin: 0px;">'.
                '-'.
                '</div>'.
                '</div></div></div>';
            }
        } else {
            $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; '.$class.';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>'.
                '<input  id="input-count"'.
                'style="width: 50%; height: 23px; text-align: center; position: relative; top: 0px;"'.
                'data-prod="'. $product['products_id'].'"'.
                'data-model="'. $product['products_model'].'"'.
                'data-price="'. (integer)$product['products_price'].'"'.
                'data-image="'. $product['products_image'].'"'.
                'data-attrname="'.$attr_desc_value['products_options_values_name'].'"'.
                'data-attr="'.$attr_desc_value['products_options_values_id'].'"'.
                'placeholder="0"'.
                'type="text">'.
                '<div id="add-count" style="margin: 0px;">'.
                '+'.
                '</div>'.
                '<div id="del-count" style="margin: 0px;">'.
                '-'.
                '</div>'.
                '</div></div></div>';       }
        $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
        $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
        $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);

        $innerhtml .= '<div itemscope itemtype="http://schema.org/ProductModel" itemid="#' . $product['products_id'] . '"  class="container-fluid float" id="card"><a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_image'] . ');">' .
            '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_image'] . '">' .
            '</div>' .
            '<div  itemprop="name" class="name">' . $description['products_name'] . '</div></a>' .
            '<div style="display:none;" class="model">Артикул ' . $product['products_model'] . '</div>' .
            '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
            '<div  itemprop="description" class="model" style="display:none">' . $description['products_description'] . '</div>' .
            '<div  itemprop="category" class="model" style="display:none">' . implode(', ', $catpath->name) . '</div>' .
            '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">' .
            '<div style="font-size: 18px; font-weight: 500;" itemprop="price" >' . (integer)($product['products_price']) . ' руб.</div>' .
            '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
            '</div>' .
            '<div style="cursor:pointer">' .
            '<div data-vis="size-item-desc" data-vis-id="'.$product['products_id'].'" style="text-align: right; font-size: 12px; font-weight:400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; padding: 0px 27px;" data-prod="' . $product['products_id'] . '">Размеры<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: #00A5A1; font-size: 18px; position: absolute; right: 0px; padding: 0px 0px 0px 30px;"></i></div>' .
            '</div>' .
            '<a href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div  itemprop="" style="font-size: 12px;" id="prod-info" data-prod="' . $product['products_id'] . '"><i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;"></i> Увеличить</div></a>' .
            '<span data-vis="size-item-card" data-vis-id-card="'.$product['products_id'].'">' . $attr_html . '</span>' .
            '</div>';
    }
    if ($searchword !== '') {
        $thistitle = 'Результаты поиска';
    } elseif ($cat == 0) {
        $thistitle = 'Каталог';
    } else {
        $thistitle = implode(', ', $catpath->name);
    }
    $this->title = $thistitle . ' - ' . ($page + 1);
    echo $innerhtml;
    echo '<div class="loader">Показать еще <span style="font-family: Roboto  Bold,sans serif; font-weight: 600;">'.end($catpath->name).'</span></div>';
    // echo '<div class="productloader" style="padding: 1px 8px; color: rgb(79, 79, 79); margin: 4px; clear: both; background: rgb(255, 255, 255) none repeat scroll 0% 0%; text-align: center;">Loader</div>';
    echo '<div class="pagination-catalog" style="float: right; margin: auto; text-align: center; width: 100%;">';
    $pagination = new \yii\data\Pagination();
    $pagination->totalCount = $data[1]-$count;
    $pagination->pageSize = $count;
    $pagination->pageSizeParam = 'count';
    $pagination->defaultPageSize = 20;

    echo \yii\widgets\LinkPager::widget([
            'firstPageLabel' => 'Первая',
            'lastPageLabel' => 'Последняя',
            'nextPageLabel'=>'<i class="mdi mdi-arrow-forward"></i>',
            'prevPageLabel'=>'<i class="mdi mdi-arrow-back"></i>',
            'id'=>'pager-catalog',
            'maxButtonCount'=>5,
            'pagination' => $pagination
        ]

    );
echo '</div>';
} else {
    echo 'Нет результатов';

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
        $(this).find(':first-child').removeClass('no-border-bottom-rad');
    }else{
        $(this).html('<div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title">Свернуть фильтр</h4> </div>');
        $(this).find(':first-child').addClass('no-border-bottom-rad');
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
    $(document).on('click', '[data-vis="size-item-desc"]', function(){
        $attr = this.getAttribute('data-vis-id');
        $obj = $('[data-vis-id-card="'+$attr+'"]');
        if($obj.hasClass('show')){
            $obj.removeClass('show');
        }else{
            $obj.addClass('show');
        }
    });

    </script>


<?