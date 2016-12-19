<?php
/* @var $this yii\web\View */
use yii\jui\Slider;
use frontend\widgets\Menuom;
use frontend\widgets\ProductCard;
use frontend\widgets\ProductCard2;


$countdisp = [60, 120, 180];

if($params['count'] != $countdisp[0]){
    $count =  $start_url['count'] = $params['count'];
}else{

}



$min_price =   $start_url['start_price'] = $params['start_price'];
$max_price =  $start_url['end_price'] = $params['end_price'];
$prodatrquery =  $start_url['prod_attr_query'] = $params['prod_attr_query'];
if(Yii::$app->params['seourls'] == TRUE){
    $page = $params['page']  = max(1,Yii::$app->params['chpu']['page']);
}else{
    $page =  $start_url['page'] = max(1,$params['page']);
}

$sort =  $start_url['sort'] =  $params['sort'];
$date_start =  $start_url['date_start'] = $params['date_start'];
$date_end =  $start_url['date_end'] = $params['date_end'];
$ok =  $start_url['ok'] = $params['ok'];
$lux =  $start_url['lux'] = $params['lux'];
$searchword =  $start_url['searchword'] = $params['searchword'];
$sfilt  = $start_url['sfilt'] =  $params['sfilt'];
$sfqueryparam ='';
$urlsrc = [];
if(Yii::$app->params['seourls'] == TRUE){
    if($params['cat_start'] != 0){
        $newurl = Yii::$app->params['chpu']['action'].'/'.Yii::$app->params['chpu']['cat_start'];
        $cat  = $params['cat_start'];
    }else{
        $newurl = Yii::$app->params['chpu']['action'];
        $cat  = $params['cat_start'];
    }

}else{
    $newurl =  '/'.Yii::$app->request->getPathInfo();
    $cat =  $start_url['cat'] = $params['cat_start'];
}

foreach ($start_url as $key=>$val){
  if($val != FALSE){
        $urlsrc[$key] = $val;
    }
}
$url = new \yii\helpers\Url();

$urlsrc[] = $newurl;

if ($data[0] != 'Не найдено!') {
    echo '<div class="partners-main-right bside">';
    $headbside = '';
    $headbside .= '<div  class="partners-main-right headerbside">';
    echo '<div style="width: 100%; height: 100%; float: left;" class="cat-nav">';

    $innercount = '';
    foreach ($countdisp as $key => $countdisp) {
        if ($countdisp == $count) {
            $classcount = 'countdisplay count-checked';
        } else {
            $classcount = 'countdisplay';
        }
        $paste = $urlsrc;
      //  $paste['page'] = 1;
        $paste['count'] = $countdisp;
        $innercount .= '<div class="count lock-on"> <a class="' . $classcount . '" onclick=""  data-count="' . $countdisp . '"  href="' . $url::toRoute($paste). '">' . $countdisp . '</a></div>';
    }
    echo '<div id="count-display" style="float: right;"> | Показать ' . $innercount . ' </div>';
    echo '<div id="products-counter" style="float: right;">' . $data[4] . '-' . $data[5] .  ($data[1]? ' из ' . $data[1] : '' ) . '</div>';
    echo '<div id="products-pager"></div>';
    $chpu = new \common\traits\Categories\CategoryChpuClass();
    if ($catpath['num'] != 0) {
        foreach ($catpath['num'] as $key => $catid) {
            $paste = [];
            if(Yii::$app->params['seourls'] == TRUE){
                if(!$chpu->categoryChpu($catid)){
                    $paste[0] = $urlsrc[0];
                    $paste['cat'] = $catid;
                }else{
                    $paste[0] =   Yii::$app->params['chpu']['action'].'/'.$chpu->categoryChpu($catid);
                }
                echo '<a href="' . $url::toRoute($paste) . '" class="lock-on">';
                echo $catpath['name'][$key];
                echo ' / </a>';
            }else{
                $paste[0] = $urlsrc[0];
                $paste['cat'] = $catid;
                echo '<a href="' . $url::toRoute($paste) . '" class="lock-on">';
                echo $catpath['name'][$key];
                echo ' / </a>';
            }
        }
    }
    echo '</div>';
    if($catpath['num'] != 0) {
        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">' . end($catpath['name']) . '</h3>';
    }else{
        $headbside .= '<h3 style="float: left; width: 100%; margin: 10px 0px 16px;">Каталог</h3>';
    }
    $headbside .=  '<form class="partners-main-right filter" action="">
                    <div class="panel panel-default">
                         <div class="filter-search" style="float: left; margin: 13px; font-size: 14px; width: 25%;">
                         <form action="">
                            <input id="search" autocomplite="off" name="searchword" class="no-shadow-form-control" placeholder="Введите артикул или название" style="color: rgb(119, 119, 119); height: 27px; float: left; width: 75%; font-size: 14px; line-height: 1; padding: 4px;" type="text">
                        <button class="btn btn-default data-j" type="submit" style="width: 25%; height: 27px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; left: -5px; margin-right: 0px; float: left; font-size: 14px; line-height: 0.9;">
                            Найти
                        </button></form></div>';
    $headbside .=
        '<div class="filter-cart" style="padding: 9px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="selected-count badge"></div><a class="top-link" href="/glavnaya/selectedproduct"><i class="fa fa-star" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>
                    <div class="filter-cart" style="padding: 9px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="cart-count badge"></div><a class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>';

    $headbside .='<div class="filter-auth" style="float: right; width: 25%; padding: 14px; font-size: 14px; font-weight: 300;">';

    if(Yii::$app->user->isGuest){
        $headbside .='<div style="float: right; line-height: 2;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left; line-height: 0.9;">&#xE7FF;</i><a data-toggle="modal" style="float: left; cursor:pointer;" data-target="#authform">Вход</a>';
        $headbside .= '</div>';
        $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/signup" ><span style="float: left; margin: 4px;">Регистрация</span></a></div>';
    }else{
        $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
        $headbside .= '<div style="float: right;"><a href="'.BASEURL.'/lk/"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
    }
    $headbside .=   '</div>
                         <a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" aria-controls="collapseOne">

                           <div class="panel-heading" role="tab" id="headingOne">

                          <h4 class="panel-title popover-js" data-container="body" data-trigger="manual" data-toggle="popover" data-placement="bottom" data-html="true" data-content="<button type=\'button\' class=\'close\'>&times;</button><br><div style=\'width:200px;\'>Попробуйте задать фильтры</div>">
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
        '<input id="suppliers-lux" value="" type="hidden" />'.
        '<input id="suppliers-ok" value="" type="hidden" />'.
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
    $headbside .=   '<div><hr style="border-color: #CCC">'.
        'Дата'.
        '</div>'.\kartik\date\DatePicker::widget([
            'language'=>'ru',
            'options'=>[
                'placeholder'=>'C',
            ],
            'name' => 'date_start',
            'value' => '',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-mm-yyyy'
            ]
        ]).\kartik\date\DatePicker::widget([
            'language'=>'ru',
            'options'=>[
                'placeholder'=>'До',
            ],
            'name' => 'date_end',
            'value' => '',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-mm-yyyy'
            ]
        ]);
    if(count($data[3])>1){
        $headbside .=           '<div><hr style="border-color: #CCC">'.
            'Размеры'.
            '</div>'.
            '<div class="size-inner" style="">';
        $data[3] = \yii\helpers\ArrayHelper::index($data[3], 'products_options_values_name');
        ksort($data[3],SORT_NATURAL);
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
                    ' '. $checked.' /></div><span class="checkbox-hidden-group-label" style="display: inline; min-width: 100px; color: black; margin-left: 10px; font-weight: 300; font-size: 12px; padding-left: 20px; line-height: 1.7; max-width: calc(100% - 50px); overflow: hidden; float: left;">'.$value['products_options_values_name'].'</span>';

                $headbside .=               '</div>';
            }

        }
        $headbside .=               '</div>';
    }
    if($spec) {
        foreach ($spec as $speckey => $specval) {
            if ($speckey == '77' || $speckey == '4119' || $speckey == '74' ) {
                $headbside .= '<div><hr style="border-color: #CCC">' .
                    $specval['name'] .
                    '</div>' .
                    '<div class="size-inner" style="">';
                foreach ($specval['dataset'] as $keyr => $valuer) {
                    if (is_array($valuer) && $valuer['products_options_values_id'] == $prodatrquery) {
                        $checked = ' fa-check';
                    } else {
                        $checked = '';
                    }
                    if ($valuer) {
                        $headbside .= '<div class="filter-item-size">';

                        $headbside .= '<div class="checkboxmty-overlay fa' . $checked . '" for="checkbox-hidden-group">' .
                            '<input id="checkbox-hidden-group"  class="checkbox-hidden-group" type="checkbox" class="prod_attr_query" value="' . $keyr .
                            '" name = "sfilt[]"' .
                            ' ' . $checked . ' /></div><span class="checkbox-hidden-group-label" style="display: inline; min-width: 100px; color: black; margin-left: 10px; font-weight: 300; font-size: 12px; padding-left: 20px; line-height: 1.7; max-width: calc(100% - 50px); overflow: hidden; float: left;">' . $valuer . '</span>';

                        $headbside .= '</div>';
                    }

                }
                $headbside .= '</div>';
            }
        }
    }
    $headbside .=                       '<hr style="border-color: #CCC"><div style="position: relative; height: 38px;" class="panel-footer" role="tab" id="headingOne">'.
        '<button class="btn" type="submit" style="height: 28px; float: left; line-height: 1; background: #00a5a1; color: rgb(0, 0, 0); font-weight: 300;">Применить</button><a href="?cat='.$cat.'&amp;count='.$count.'&amp;start_price=&amp;end_price=1000000&amp;prod_attr_query=&amp;page=0&amp;sort=0&amp;searchword=" style="height: 28px; float: right; line-height: 1; color: rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); font-weight: 300;" class="btn  reset-filter lock-on">Сбросить</a>'.
        '</div>'. '</div>'.
        '</div>'.
        '</div>'.
        '<input name="page"  value="0" type="hidden"/>'.
        '<input name="sort"  value="0"  type="hidden"/>'.
        '<input name="searchword"   value="" type="hidden"/>'.
        '</form>';


    $headbside .= $topnav;
    $headbside .= '<div class="partheaderbside">';

    $headbside .= '<a href="'.BASEURL.'/changecardview" style="float: right; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); padding: 0px 25px; border-radius: 4px; font-weight: 500;" class="lock-on">Вид</a>';

    $headbside .= ' <a href="#demo" style="float: left; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); border-radius: 4px; font-weight: 500; padding: 0px 25px; text-align: center; width: 200px;" data-toggle="collapse">Сортировка</a>';

    $absok = abs($ok-1);
    $paste = $urlsrc;
    $paste['ok'] = $absok;
  //  $paste['page'] = 1;
    $headbside .= ' <a href="' .  $url::toRoute($paste). '" style="float: left; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); border-radius: 4px; font-weight: 500; padding: 0px 25px; text-align: center; width: 200px;" class="lock-on">ОК</a>';


    $abslux = abs($lux-1);
    $paste = $urlsrc;
    $paste['lux'] = $abslux;
  //  $paste['page'] = 1;
    $headbside .= ' <a href="' .  $url::toRoute($paste). '" style="float: left; color: rgb(0, 165, 161); margin-right: 30px; font-size: 16px; border: 1px solid rgb(204, 204, 204); border-radius: 4px; font-weight: 500; padding: 0px 25px; text-align: center; width: 200px;" class="lock-on">LUX</a>';



    $headbside .= '<div id="demo" style="width: 200px; position: absolute; margin-top: 25px; z-index: 98;" class="collapse">';
    $headbside .= '<div id="sort-order"><div  class="header-sort sort sort-checked" data="' . $data[11] . '"></div>';

    $sortorder = [['дате', 5, 15, 'date'], ['цене', 1, 11, 'price'], ['названию', 2, 12, 'name'], ['модели', 3, 13, 'model'], ['популярности', 4, 14, 'popular']];
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
            $paste = $urlsrc;
            $paste['sort'] = $dataord;
        //    $paste['page'] = 1;

            $headbside .= '<a class="' . $class . ' lock-on" href="' .  $url::toRoute($paste). '" data="' . $dataord . '" href="#"><div class="header-sort-item-'.$value[3].' header-sort-item active lock-on">'. $value[0] . ' <i style="float: right; padding: 3px 10px;" class="fa fa-' . $arrow . '"> </i></div></a>';
        } else {
            $paste = $urlsrc;
            $paste['sort'] = $dataord;
         //   $paste['page'] = 1;
            $headbside .= '<a class="' . $class . ' lock-on" data="' . $dataord . '" href="' .   $url::toRoute($paste). '"><div class="header-sort-item-'.$value[3].' header-sort-item lock-on">' . $value[0] . '</div></a>';
        }
    }
    $headbside .= '</div></div></div></div>';
    echo $headbside;
    $innerhtml = '';
    $products = '';
    $analitics = '';
    if($_COOKIE['cardview']==1){
        foreach ($data[0] as $key=>$value) {
            $analitics .= '';
            $spec = $value['productsSpecification']['74']['specification_values_id'];
            $spec_code = $value['specificationValuesDescription'][$spec]['specification_value'];
            $products .= ProductCard2::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'catpath'=>$catpath, 'man_time'=>$man_time, 'category'=>$value['categories_id'], 'showdiscount'=>1, 'season'=>$spec_code, 'subpreview'=>$value['subImage']]);
        }
    }else{
        foreach ($data[0] as $key=>$value) {
            $analitics .= '';
            $spec = $value['productsSpecification']['74']['specification_values_id'];
            $brand = $value['productsSpecification']['77']['specification_values_id'];
            $spec_code = $value['specificationValuesDescription'][$spec]['specification_value'];
            $products .= ProductCard::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'catpath'=>$catpath, 'man_time'=>$man_time,'category'=>$value['categories_id'], 'showdiscount'=>1, 'season'=>$spec_code, 'brand'=>$brand,  'subpreview'=>$value['subImage']]);
        }
    }

    echo $analitics;
    echo $products;

    if ($searchword !== '') {
        $thistitle = 'Результаты поиска';
    } elseif ($cat == 0) {
        $thistitle = 'Каталог';
    } else {
        $thistitle = implode(', ', $catpath['name']);
    }
    $this->title = $thistitle . ' : Самый большой выбор по самым низким ценам в интернет магазине Одежда Мастер - Страница -' . ($page + 1);
    echo $innerhtml;

    // echo '<div class="productloader" style="padding: 1px 8px; color: rgb(79, 79, 79); margin: 4px; clear: both; background: rgb(255, 255, 255) none repeat scroll 0% 0%; text-align: center;">Loader</div>';

    if($data[1] > $count){
        echo '<div class="loader-inner"><div class="loader lock-on"><div style="float: left; text-align: center; width: 100%;">Показать еще <span style="font-weight: 600;">'.end($catpath['name']).'</span></div>'.
            '</div><div style="text-align: center; width: 25%; float: left; margin: 10px 0px 0px;">'.
            '<select id="control-load" style="background-color: rgba(255, 255, 255, 0);" class="no-shadow-form-control" name="control-load">'.
            '<option value="manual">Ручная загрузка</option>'.
            '<option value="auto">Автозагрузка</option>'.
            '</select>'
            .'</div></div>';
        echo '<div class="pagination-catalog" style="float: right; margin: auto; text-align: center; width: 100%;">';
        if($page<=0){
            $fpclass = 'disable';
        }else{
            $fpclass = '';
        }

        echo '<ul class="pagination">';

        if($page==1){
            echo '<li class="first disabled"><span>Первая</span></li>';
            echo '<li class="prev disabled"><span><i class="mdi mdi-arrow-back"></i></span></li>';
        } else {
            $paste = $urlsrc;
            unset($paste['page']);
            echo '<li class="first"><a href="' . $url::toRoute($paste) . '" data-page="1" class="lock-on">Первая</a></li>';
            if ($page == 2) {
                $paste = $urlsrc;
                    echo '<li class="prev"><a href="' . $url::toRoute($paste) . '" data-page="' . ($page - 1) . '" class="lock-on"><i class="mdi mdi-arrow-back"></i></a></li>';
            } else {
                if(Yii::$app->params['seourls'] == TRUE){
                    $paste = $urlsrc;
                    $paste[0] = $urlsrc[0].'/' . max(1, $page - 1);
                    echo '<li class="prev"><a href="' . $url::toRoute($paste) . '" data-page="' . ($page - 1) . '" class="lock-on"><i class="mdi mdi-arrow-back"></i></a></li>';
                }else{
                    $paste = $urlsrc;
                    $paste['page'] =  max(1, $page - 1);
                    echo '<li class="prev"><a href="' . $url::toRoute($paste) . '" data-page="' . ($page - 1) . '" class="lock-on"><i class="mdi mdi-arrow-back"></i></a></li>';
                }

            }
        }



        $count = min(1000, $count);
        $count = max(60, $count);
        $checkdelimiter = $data[1]%$count;
        if($checkdelimiter){
            $pagecount = (int)($data[1]/$count)+1;
        }else{
            $pagecount = (int)($data[1]/$count);
        }
        $endpage = min($pagecount, $page+2);
        $startpage = max(1, $page-2);
        for($startpage; $startpage<=$endpage ; $startpage++){
            if($page == $startpage){
                if(Yii::$app->params['seourls'] == TRUE){
                    echo '<li class="active"><a  href="" data-page="'.($startpage).'">'.($startpage).'</a></li>';
                }else{
                    $paste = $urlsrc;
                    echo '<li class="active"><a  href="" data-page="'.($startpage).'">'.($startpage).'</a></li>';
                }

            }else{
                if($startpage==1){
                    if(Yii::$app->params['seourls'] == TRUE){
                        $paste = $urlsrc;
                        $paste[0] = $urlsrc[0];
                        echo '<li><a href="' .  $url::toRoute($paste) . '" class="lock-on">'.($startpage).'</a></li>';
                    }else{
                        $paste = $urlsrc;
                        echo '<li><a href="' .  $url::toRoute($paste) . '" class="lock-on">'.($startpage).'</a></li>';
                    }
                } else {
                    if(Yii::$app->params['seourls'] == TRUE){
                        $paste = $urlsrc;
                        $paste[0] = $urlsrc[0].'/'.$startpage;
                        echo '<li><a href="' .  $url::toRoute($paste) . '" class="lock-on">'.($startpage).'</a></li>';
                    }else{
                        $paste = $urlsrc;
                        $paste['page'] = max(1,$startpage);
                        echo '<li><a href="' .  $url::toRoute($paste) . '" class="lock-on">'.($startpage).'</a></li>';
                    }

                }
            }
        }
        if($page == $pagecount){
            echo '<li class="next disabled"><span><i class="mdi mdi-arrow-forward"></i></span></li>';
            echo '<li class="last disabled"><span>Последняя</span></li>';
        } else {
            if(Yii::$app->params['seourls'] == TRUE){
                $paste = $urlsrc;
                $paste[0] = $urlsrc[0].'/'.min($pagecount,$page+1);
                echo '<li class="next"><a href="' .   $url::toRoute($paste)  . '" class="lock-on"><i class="mdi mdi-arrow-forward"></i></a></li>';
                $paste = $urlsrc;
                $paste[0] = $urlsrc[0].'/'.$pagecount;
                echo '<li class="last"><a href="' . $url::toRoute($paste)  . '" class="lock-on">Последняя</a></li>';
            }else{
                $paste = $urlsrc;
                $paste['page'] = min($pagecount,$page+1);
                echo '<li class="next"><a href="' .   $url::toRoute($paste)  . '" class="lock-on"><i class="mdi mdi-arrow-forward"></i></a></li>';
                $paste['page'] = $pagecount;
                echo '<li class="last"><a href="' . $url::toRoute($paste)  . '" class="lock-on">Последняя</a></li>';
            }
               }
        ?>
        </ul>

        </div>
        <?php
    }
} else {
    echo '<div style="text-align: center; font-size: 40px; position: relative;  min-height: 100%;">Нет результатов</div>';
}

?>
</div>


<script>
    $(document).on('slide', '#price-slider',function( event, ui){
        $('#min-ev-price').val(ui.values[0]);
        $('#max-ev-price').val(ui.values[1]);

    });
    $(window).on('load', function( event, ui){

        var popoverJs = $('.popover-js');
        if(getCookie('popover-filter') == undefined){
            popoverJs.popover('show');
        }
        popoverJs.on('click',function(){
            $(this).popover('hide');
        });
        $('.popover-content>button').on('click',function(){
            popoverJs.popover('hide');
        });
        popoverJs.on('hidden.bs.popover', function () {
            setCookie('popover-filter',1,{expires: 3600*24*30,path:'/'})
        });

        $.ajax({
            url: "/suppliers-lux",
            success: function (data) {
                $('#suppliers-lux').val(JSON.stringify(data));
            }
        });
        $.ajax({
            url: "/suppliers-ok",
            success: function (data) {
                $('#suppliers-ok').val(JSON.stringify(data));
            }
        });

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
    $(document).on('click', '[class*=checkboxmty-overlay]', function(){
        if($(this).hasClass('fa-check')){
            $(this).children().prop('checked', false);
            $(this).removeClass('fa-check');
        }else{

            $(this).children().prop('checked', true);
            $(this).addClass('fa-check');
        }

    });

</script>

