<?php
/* @var $this yii\web\View */
use yii\jui\Slider;
use frontend\widgets\Menuom;
use frontend\widgets\ProductCard;
use frontend\widgets\ProductCard2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use kartik\date\DatePicker;
// return ['data' => [$data, $count_arrs, $price_max, $productattrib, $start_arr, $end_arr, $countfilt, $start_price, $end_price, $prod_attr_query, $page, $sort, $cat_start, $searchword], 'catpath' => $catpath, 'man_time' => $man_time, 'spec'=>$spec, 'params'=>array_merge($options,$params)];
// $data[1] - всего товаров
// $data[11] - сортировка


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

$urlsrc[] = $newurl;
$pagination = new Pagination([
    'defaultPageSize' => 60,
    'totalCount' => $data[1],
]);
if ($data[0] != 'Не найдено!') {
?>
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
<section class="main-container col2-left-layout bounceInUp">
    <?=\frontend\widgets\MainBanner::widget(['template'=>'category-slider']);?>

    <div class="container">
        <div class="row">
            <div class=" col-sm-9 col-sm-push-3">
                <article class="col-main">
                    <div class="page-title">
                        <h2>Tops &amp; Tees</h2>
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
                                                echo '<a href="#">'.$sortitem[0].'<span class="right-arrow"></span></a>';
                                                $sortorder_active = $sortorder[$i];
                                                unset($sortorder[$i]);
                                            }
                                        }
                                    }
                                    echo '<ul>';
                                    foreach($sortorder as $sortitem){
                                        echo '<li><a href="'.Url::current(['sort'=>$sortitem[1]]).'">'.$sortitem[0].'</a></li>';
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
                                echo '<a class="button-asc left" href="'.Url::current(['sort'=>$sort_set_active]).'" title="Изменить порядок сортировки"><span class="'.$sort_arrow.'_arrow"></span></a>';
                            }?>
                        </div>
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
                                <?=LinkPager::widget([
                                    'pagination' => $pagination,
                                    'maxButtonCount' => 5,
                                ]); ?>
                            </div>
                        </div>
                    </div>
                    <div class="category-products">
                        <ul class="products-<?=(int)$_COOKIE['cardview'] == 1?'list':'grid'?>" style="padding: 0;">
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

