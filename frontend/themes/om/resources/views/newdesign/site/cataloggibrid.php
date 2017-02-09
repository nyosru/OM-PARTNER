<?php
/* @var $this yii\web\View */
use yii\jui\Slider;
use frontend\widgets\NewMenuom;
use frontend\widgets\ProductCard;
use frontend\widgets\ProductCard2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
// return ['data' => [$data, $count_arrs, $price_max, $productattrib, $start_arr, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword], 'catpath' => $catpath, 'man_time' => $man_time, 'spec'=>$spec, 'params'=>array_merge($options,$params)];
// $data[1] - всего товаров
// $data[11] - сортировка


$countdisp = [60, 120, 180];

if($params['count'] != $countdisp[0]){
    $count =  $start_url['count'] = $params['count'];
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

$urlsrc[] = $newurl;
if ($data[0] != 'Не найдено!') {
?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <?php
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
                            }else{
                                $paste[0] = $urlsrc[0];
                                $paste['cat'] = $catid;
                            }
                            if(count($catpath['num'])>=1 && $catpath['num'][0]!=0 && $key==0){
                                echo '<li><a href="/catalog/">Каталог</a><span>→ </span></li>';
                            }
                            if(count($catpath['num'])-1==$key){
                                echo '<li><strong>'.$catpath['name'][$key].'</strong></li>';
                            } else {
                                echo '<li><a href="' . Url::toRoute($paste) . '">' . $catpath['name'][$key] . '</a><span>→ </span></li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="main-container col2-left-layout">
    <?=\frontend\widgets\MainBanner::widget(['template'=>'category-slider']);?>
    <?php if ($catpath['num'][0] == 0 && empty(Yii::$app->request->get())) { ?>
        <div class="top-banner-section categories-images">
            <div class="container">
                <div class="row">
                    <?=NewMenuom::widget([
                        'chpu' =>Yii::$app->params['seourls'],
                        'html' => false,
                        'property' => ['target' => '0','type'=>'images']
                    ])?>
                </div>
            </div>
        </div>
    <?php } else { ?>
    <div class="container">
        <div class="row">
            <div class=" col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <?php
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
                            }else{
                                $paste[0] = $urlsrc[0];
                                $paste['cat'] = $catid;
                            }
                        }
                    }
                    ?>
                    <div class="page-title">
                        <h2>
                            <?php
                            if($catpath['num'] != 0) {
                                echo end($catpath['name']);
                            }else{
                                echo 'Каталог';
                            }?>
                        </h2>
                    </div>

                    <div class="toolbar">
                        <div class="sorter">
                            <div class="view-mode">
                                <?php if((int)$_COOKIE['cardview'] == 1){ ?>
                                    <a href="<?=Url::to('/changecardview')?>" title="Grid" class="button button-grid"></a>
                                    <span title="List" class="button button-active button-list"></span>
                                <?php } else { ?>
                                    <span title="Grid" class="button button-active button-grid"></span>
                                    <a href="<?=Url::to('/changecardview')?>" title="List" class="button-list"></a>
                                <?php } ?>
                            </div>
                        </div>
                        <div id="sort-by">
                            <label class="left">Сортировка по: </label>
                            <?php $sortorder = [['дате', 5, 15, 'date'], ['цене', 1, 11, 'price'], ['названию', 2, 12, 'name'], ['модели', 3, 13, 'model'], ['популярности', 4, 14, 'popular']];?>
                            <ul>
                                <li>
                                    <?php
                                    $paste = $urlsrc;
                                    if(!$data[11]){
                                        echo '<a href="#">умолчанию<span class="right-arrow"></span></a>';
                                    } else {
                                        foreach($sortorder as $i=>$sortitem){
                                            if($data[11]==$sortitem[1] || $data[11]==$sortitem[2]){
                                                echo '<a href="#" onclick="return false">'.$sortitem[0].'<span class="right-arrow"></span></a>';
                                                $sortorder_active = $sortorder[$i];
                                                unset($sortorder[$i]);
                                            }
                                        }
                                    }
                                    echo '<ul>';
                                    foreach($sortorder as $sortitem){
                                        echo '<li><a href="'.Url::to(ArrayHelper::merge($urlsrc,['sort'=>$sortitem[1]])).'">'.$sortitem[0].'</a></li>';
                                    }
                                    echo '</ul>';
                                    ?>
                                </li>
                            </ul>
                            <?php
                            if($data[11]){
                                if($data[11] != $sortorder_active[1]){
                                    $sort_arrow = 'bottom';
                                    $sort_set_active = $sortorder_active[1];
                                } else {
                                    $sort_arrow = 'top';
                                    $sort_set_active = $sortorder_active[2];
                                }
                                echo '<a class="button-asc left" href="'.Url::to(ArrayHelper::merge($urlsrc,['sort'=>$sort_set_active])).'" title="Изменить порядок сортировки"><span class="'.$sort_arrow.'_arrow"></span></a>';
                            }?>
                        </div>
                        <div class="pager">
                            <div id="limiter">
                                <label>Показать: </label>
                                <ul>
                                    <?php
                                    if(in_array($count,$countdisp)){
                                        echo '<li><a onclick="return false" href="#">'.$count.'<span class="right-arrow"></span></a>';
                                        unset($countdisp[array_search($count, $countdisp)]);
                                    } else {
                                        echo '<li><a onclick="return false" href="#">60<span class="right-arrow"></span></a>';
                                        unset($countdisp[array_search(60, $countdisp)]);
                                    }
                                    echo '<ul>';
                                    foreach($countdisp as $countdisp_item){
                                        echo '<li><a href="'.Url::to(ArrayHelper::merge($urlsrc,['count'=>$countdisp_item])).'">'.$countdisp_item.'</a></li>';
                                    }
                                    echo '</ul>';
                                    echo '</li>';
                                    ?>
                                </ul>
                            </div>

                            <div class="pages">
                                <label>Страница:</label>
                                <?=LinkPager::widget([
                                    'pagination' => new Pagination([
                                        'defaultPageSize' => 60,
                                        'totalCount' => $data[1],
                                        'route' => $paste[0],
                                    ]),
                                    'maxButtonCount' => 3,
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="category-products">
                        <ul class="clearfix products-<?=(int)$_COOKIE['cardview'] == 1?'list':'grid'?>" style="padding: 0;">
                            <?php
                            foreach ($data[0] as $value) {
                                if((int)$_COOKIE['cardview'] == 1){
                                    echo '<li class="item even">';
                                } else {
                                    echo '<li class="item col-lg-4 col-md-3 col-sm-4 col-xs-6">';
                                }
                                echo \frontend\widgets\ProductCardFabia::widget(['template'=>(int)$_COOKIE['cardview'] == 1?'list':'grid','product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr'],'catpath'=>$catpath, 'man_time'=>$man_time, 'category'=>$value['categories_id']]);
                                echo '</li>';
                            }

                            ?>

                        </ul>
                    </div>
                    <div class="pager" style="margin: 15px 0;">
                        <div class="pages">
                            <?=LinkPager::widget([
                                'pagination' => new Pagination([
                                    'defaultPageSize' => 60,
                                    'totalCount' => $data[1],
                                    'route' => $paste[0],
                                ]),
                                'maxButtonCount' => 3,
                            ]); ?>
                        </div>
                    </div>
                </article>
                <!--	///*///======    End article  ========= //*/// -->
            </div>
            <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
                <aside class="col-left sidebar">
                    <?php if ($catpath['num'][0] != 0) { ?>
                    <div class="side-nav-categories">
                        <div class="block-title"> Категории </div>
                        <!--block-title-->
                        <!-- BEGIN BOX-CATEGORY -->
                        <div class="box-content box-category">
                            <?php
                                if(isset(Yii::$app->params['layoutset']['opencat'])){
                                    $layoutset =   Yii::$app->params['layoutset']['opencat'];
                                }else{
                                    $layoutset =   [0];
                                };
                            ?>
                            <?= NewMenuom::widget([ 'chpu' =>Yii::$app->params['seourls'],'property' => ['id' => 'main', 'target' => '0', 'opencat' => $layoutset]]); ?>
                        </div>
                        <!--box-content box-category-->
                    </div>
                    <?php } ?>


                    <div class="block block-layered-nav">
                        <div class="block-title">Фильтр</div>
                        <div class="block-content">
                            <form class="partners-main-right filter" action="">
                            <dl id="narrow-by-list">
                                <dt class="odd">Цена</dt>
                                <dd class="odd">
                                    <div style="display: block; height: 45px;" >
                                        <input name="cat"   value="<?=$cat?>" type="hidden"/>
                                        <input name="count" value="<?=$count?>" type="hidden" />
                                        <input id="suppliers-lux" value="" type="hidden" />
                                        <input id="suppliers-ok" value="" type="hidden" />
                                        <input name="start_price" id="min-ev-price" class="" placeholder="от" style="float: left; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" />
                                        <input name="end_price" style="float: right; width: 40%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 5px;" id="max-ev-price" class="" placeholder="до" />
                                    </div>
                                    <?= Slider::widget([
                                        'id'=>'price-slider',
                                        'options'=>['style'=>'width: 95%; margin: auto;border: 1px solid #CCC;'],
                                        'clientOptions' => [
                                            'values'=>[$data[7],$data[8]],
                                            'min' => 0,
                                            'max' => $data[2]['maxprice'],
                                            'step' => 1,
                                            'range' => true,
                                        ],
                                    ]);?>
                                </dd>
                                <dt class="even">Дата</dt>
                                <dd class="even">
                                    <?=DatePicker::widget([
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
                                    ]).DatePicker::widget([
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
                                    ]);?>

                                </dd>
                                <dt class="odd">Размеры</dt>
                                <dd class="odd">
                                    <div class="catalog-list-filter">
                                        <?php
                                        $data[3] = \yii\helpers\ArrayHelper::index($data[3], 'products_options_values_name');
                                        ksort($data[3],SORT_NATURAL);
                                        foreach($data[3] as $key=>$value){
                                            if($value['products_options_values_id']) { ?>
                                                <div class="checkbox-filter">
                                                    <label>
                                                        <?=Html::radio('prod_attr_query', $value['products_options_values_id'] == $prodatrquery ,[
                                                            'value' => $value['products_options_values_id'],
                                                        ]);?>
                                                        <?=$value['products_options_values_name']?>
                                                    </label>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </dd>
                                <?php
                                if($spec) {
                                    foreach ($spec as $speckey => $specval) {
                                        if ($speckey == '77' || $speckey == '4119' || $speckey == '74' ) { ?>
                                            <dt class="odd"><?=$specval['name']?></dt>
                                            <dd class="odd">
                                                <div class="catalog-list-filter">
                                                    <?php foreach ($specval['dataset'] as $keyr => $valuer) { ?>
                                                        <?php if($valuer) { ?>
                                                            <div class="checkbox-filter">
                                                                <label>
                                                                    <?=Html::checkbox('sfilt[]', is_array($valuer) && $valuer['products_options_values_id'] == $prodatrquery ,[
                                                                        'value' => $keyr,
                                                                    ]);?>
                                                                    <?=$valuer?>
                                                                </label>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </div>
                                            </dd>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                <dd class="odd">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="button" type="submit">Применить</button>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="?cat=<?=$cat?>&amp;count=<?=$count?>&amp;start_price=&amp;end_price=1000000&amp;prod_attr_query=&amp;page=0&amp;sort=0&amp;searchword=" class="button reset-filter lock-on">Сбросить</a>
                                        </div>
                                    </div>
                                </dd>
                            </dl>
                            </form>
                        </div>
                    </div>
                    <div class="block block-cart" id="cart-catalog-left">
                        <div class="block-title ">Моя корзина</div>
                        <div class="block-content">
                            <div class="summary">
                                <p class="amount">Количество товаров: <span class="cart-count">0</span></p>
                                <p class="subtotal"> <span class="label">Сумма:</span> <span class="price total-price-cart">0</span> </p>
                            </div>
                            <p class="block-subtitle">Товары в корзине</p>
                            <ul>

                            </ul>
                            <div class="actions">
                                <a href="/cart" class="view-cart"><span>Перейти к корзине</span></a> </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <?php } ?>
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
    $(document).on('click','.box-category .subDropdown', function(e) {
        e.preventDefault();
        var parentLink = $(this).parent('a'),
            parentLi = parentLink.parent('li'),
            categoryId = parentLink.attr('data-cat');

        if ($(this).hasClass('plus')) {
            $(this).removeClass('plus').addClass('minus');
            if(parentLi.children('ul').length == 0) {
                $.ajax({
                    type: 'POST',
                    url: document.location.href,
                    data: {category_id: categoryId},
                    success: function (html) {
                        parentLi.append(html);
                        parentLi.children('ul').slideDown();
                    }
                });
            } else {
                parentLi.children('ul').slideDown();
            }
        } else {
            $(this).removeClass('minus').addClass('plus');
            parentLi.children('ul').slideUp();
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

