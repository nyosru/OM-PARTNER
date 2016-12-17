<?php
/* @var $this yii\web\View */
use yii\jui\Slider;
use frontend\widgets\Menuom;
use frontend\widgets\ProductCard;
use frontend\widgets\ProductCard2;
use yii\helpers\Url;
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
<section class="main-container col2-left-layout bounceInUp animated">
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
                        <ul class="products-<?=(int)$_COOKIE['cardview'] == 1?'list':'grid'?>">
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

