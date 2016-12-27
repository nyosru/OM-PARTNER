
<?php
use yii\bootstrap\Carousel;
use yii\helpers\Html;

$this->title = $product['productsDescription']['products_name'];

$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
$this->registerMetaTag(['content' => Html::encode($product['productsDescription']['products_name']), 'property' => 'og:title',]);
$this->registerMetaTag(['content' => 'product', 'property' => 'og:type',]);
$this->registerMetaTag(['content' => Html::encode($_SERVER['SERVER_NAME'].BASEURL.'/product?id='.$product['products']['products_id']), 'property' => 'og:url',]);
$this->registerMetaTag(['content' => 'http://odezhda-master.ru/images/'.$product['products']['products_image'], 'property' => 'og:image',]);
$this->registerMetaTag(['content' => 'Одежда Мастер. Интернет-магазин', 'property' => 'og:site_name',]);
$this->registerMetaTag(['content' => 'Цена: '.(integer)$product['products']['products_price'].' рублей. '.Html::encode($product['productsDescription']['products_description']), 'property' => 'og:description',]);

$prodinfoattr='<div class="size-block">';
if (count($product['productsAttributesDescr']) > 0) {
    $numInFirstColumn=(int)(count($product['productsAttributesDescr'])/2);
    $countproductreal = 0;
    $sizeCounter=0;
    $product['productsAttributesDescr']=\yii\helpers\ArrayHelper::index($product['productsAttributesDescr'],'products_options_values_name');
    $product['productsAttributes']=\yii\helpers\ArrayHelper::index($product['productsAttributes'],'options_values_id');

    ksort($product['productsAttributesDescr'],SORT_NATURAL);
    $prodinfoattr.='<div class="size-column1">';
    foreach ($product['productsAttributesDescr'] as $item) {
        if($sizeCounter==($numInFirstColumn)){
            $prodinfoattr.='</div><div class="size-column2">';
        }
        $date = $product['products.products_date_added'];
        if($product['productsAttributes'][$item['products_options_values_id']] && $product['productsAttributes'][$item['products_options_values_id']]['quantity'] > 0) {
            $prodinfoattr .= '<div class="size-desc"><div class="pr_op_va_name">' .
                $item['products_options_values_name'] . '</div><div><div id="del-count">-</div><input id="input-count" class="no-shadow-form-control" style="display:inline; width:25%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' .
                $product['products']['products_id'] . '" data-model="' .
                $product['products']['products_model'] . '" data-price="' .
                $product['products']['products_price'] . '" data-image="' .
                $product['products']['products_image'] . '" data-attrname="' .
                $item['products_options_values_name'] . '" data-attr="' .
                $item['products_options_values_id'] . '"data-name="' .
                $product['productsDescription']['products_name'] . '"data-min="' .
                $product['products']['products_quantity_order_min'] . '"data-step="' .
                $product['products']['products_quantity_order_units'] . '" data-count="' .
                $product['productsAttributes'][$item['products_options_values_id']]['quantity'] .
                '" type="text" placeholder="0" /><div id="add-count">+</div></div></div>';
            $countproductreal += $product['productsAttributes'][$item['products_options_values_id']]['quantity'];
            $sizeCounter++;
        }
    }
    if($countproductreal > 0) {
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
    }else{
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; background: #E9516D; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">Продано</div>';
    }

    $prodinfoattr .= '</div></div></div>'.$cart_html;
} else {
    $date = $product['products']['products_date_added'];
    $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px; margin:0 0 24px 0; font-size: 12px; position: relative; max-width: 200px;width: 170px;"><div id="del-count" style="position: absolute; left: 0px; bottom: 1px;">-</div><input id="input-count" class="no-shadow-form-control" style="display:inline; width:55%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
        $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="" data-attr="" data-name="'.
        $product['productsDescription']['products_name'].'"data-min="'.$product['products']['products_quantity_order_min'].'"data-step="'.$product['products']['products_quantity_order_units'].'" data-count="'.$product['products']['products_quantity'].'" type="text" placeholder="Количество" /><div id="add-count" style="position: absolute; right: 0px; bottom: 1px;">+</div></div>';


    if($product['products']['products_quantity'] > 0) {
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
    }else{
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; background: #E9516D; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">Продано</div>';
    }

    $prodinfoattr .= '</div>'.$cart_html;
}

$items=array();
$i=0;
$im=array($product['products']['products_id']);
$imsrc=array($product['products']['products_image']);
if(!$product['products']['products_image']){
    $imsrc = array();
}
?>

<!-- layout: main-layout -->
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul>
                    <li class="home"> <a title="Go to Home Page" href="index.html">Home</a><span>&rarr; </span></li>
                    <li class=""> <a title="Go to Home Page" href="grid.html">Women</a><span>&rarr; </span></li>
                    <li class="category13"><strong>Sed volutpat ac massa eget lacinia</strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumbs End -->
<!-- Main Container -->
<section class="main-container col1-layout">
<div class="main container">
<div class="col-main">
<div class="row">

<div class="product-view">
<div class="product-next-prev"> <a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a> </div>
<div class="product-essential">
    <form action="#" method="post" id="product_addtocart_form">
        <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
        <div class="product-img-box col-sm-5 col-xs-12">
            <div class="new-label new-top-left"> New </div>
            <div class="product-image">
                <div class="large-image">
                    <a href="http://odezhda-master.ru/images/<?=$imsrc[0]?>" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20" >
                        <img src="http://odezhda-master.ru/images/<?=$imsrc[0]?>" alt="<?=$product['productsDescription']['products_name']?>">
                    </a>
                </div>
                <div class="flexslider flexslider-thumb">
                    <ul class="previews-list slides">
                        <?php
                        foreach($imsrc as $key => $img){
                            echo '<li><a href="/images/'.$img.'" class="cloud-zoom-gallery" rel="useZoom: \'zoom1\', smallImage: \'/imagepreview?src='.$im[$key].'\' "><img src="/imagepreview?src='.$im[$key].'"/></a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end: more-images -->
        </div>
        <div class="product-shop col-sm-7 col-xs-12">
            <div class="product-name">
                <h1><?=$product['productsDescription']['products_name']?></h1>
            </div>


            <div class="price-block">
                <?php if((integer)($product['products']["products_old_price"])){ ?>
                    <div class="price-box">
                        <p class="old-price">
                            <span class="price-label"></span>
                            <span class="price"><?=round($product['products']["products_old_price"])?> р.</span>
                        </p>
                        <p class="special-price">
                            <span class="price-label"></span>
                            <span class="price"><?=round($product['products']["products_price"])?> р.</span>
                        </p>
                    </div>
                <?php } else { ?>
                    <div class="price-box">
                        <span class="regular-price">
                            <span class="price"><?=round($product['products']["products_price"])?> р.</span>
                        </span>
                    </div>
                <?php } ?>
            </div>

            <div class="short-description">
                <h2>Подробное описание</h2>
                <p><?=$product['productsDescription']['products_description']?></p>
            </div>

            <div class="add-to-box">
                <div class="add-to-cart">
                    <div class="pull-left">
                        <div class="custom pull-left">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                            <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                        </div>
                    </div>

                    <button onClick="productAddToCartForm.submit(this)" class="button btn-cart" title="Add to Cart" type="button"><span><i class="icon-basket"></i> Add to Cart</span></button>

                </div>
                <div class="email-addto-box">
                    <ul class="add-to-links">
                        <li> <a class="link-wishlist selected-product"  data-product="<?=$product['products_id']?>" href="#"><span>В избранное</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="social">
                <ul class="link">
                    <li class="fb"><a href="#"></a></li>
                    <li class="tw"><a href="#"></a></li>
                    <li class="googleplus"><a href="#"></a></li>
                    <li class="rss"><a href="#"></a></li>
                    <li class="pintrest"><a href="#"></a></li>
                    <li class="linkedin"><a href="#"></a></li>
                    <li class="youtube"><a href="#"></a></li>
                </ul>
            </div>
        </div>
    </form>
</div>
<div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
    <div class="add_info">
        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
            <li class="active"> <a href="#product_tabs_description" data-toggle="tab">Полное описание</a> </li>
            <li> <a href="#reviews_tabs" data-toggle="tab">Отзывы</a> </li>
        </ul>
        <div id="productTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="product_tabs_description">
                <div class="std"><p><?=$product['productsDescription']['products_description']?></p></div>
            </div>
            <div class="tab-pane fade" id="reviews_tabs">
                <div class="box-collateral box-reviews" id="customer-reviews">
                    <div class="box-reviews1">
                        <div class="form-add">
                            <form id="review-form" method="post" action="http://www.magikcommerce.com/review/product/post/id/176/">
                                <h3>Write Your Own Review</h3>
                                <fieldset>
                                    <h4>How do you rate this product? <em class="required">*</em></h4>
                                    <span id="input-message-box"></span>
                                    <table id="product-review-table" class="data-table">


                                        <thead>
                                        <tr class="first last">
                                            <th>&nbsp;</th>
                                            <th><span class="nobr">1 *</span></th>
                                            <th><span class="nobr">2 *</span></th>
                                            <th><span class="nobr">3 *</span></th>
                                            <th><span class="nobr">4 *</span></th>
                                            <th><span class="nobr">5 *</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="first odd">
                                            <th>Price</th>
                                            <td class="value"><input type="radio" class="radio" value="11" id="Price_1" name="ratings[3]"></td>
                                            <td class="value"><input type="radio" class="radio" value="12" id="Price_2" name="ratings[3]"></td>
                                            <td class="value"><input type="radio" class="radio" value="13" id="Price_3" name="ratings[3]"></td>
                                            <td class="value"><input type="radio" class="radio" value="14" id="Price_4" name="ratings[3]"></td>
                                            <td class="value last"><input type="radio" class="radio" value="15" id="Price_5" name="ratings[3]"></td>
                                        </tr>
                                        <tr class="even">
                                            <th>Value</th>
                                            <td class="value"><input type="radio" class="radio" value="6" id="Value_1" name="ratings[2]"></td>
                                            <td class="value"><input type="radio" class="radio" value="7" id="Value_2" name="ratings[2]"></td>
                                            <td class="value"><input type="radio" class="radio" value="8" id="Value_3" name="ratings[2]"></td>
                                            <td class="value"><input type="radio" class="radio" value="9" id="Value_4" name="ratings[2]"></td>
                                            <td class="value last"><input type="radio" class="radio" value="10" id="Value_5" name="ratings[2]"></td>
                                        </tr>
                                        <tr class="last odd">
                                            <th>Quality</th>
                                            <td class="value"><input type="radio" class="radio" value="1" id="Quality_1" name="ratings[1]"></td>
                                            <td class="value"><input type="radio" class="radio" value="2" id="Quality_2" name="ratings[1]"></td>
                                            <td class="value"><input type="radio" class="radio" value="3" id="Quality_3" name="ratings[1]"></td>
                                            <td class="value"><input type="radio" class="radio" value="4" id="Quality_4" name="ratings[1]"></td>
                                            <td class="value last"><input type="radio" class="radio" value="5" id="Quality_5" name="ratings[1]"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" value="" class="validate-rating" name="validate_rating">
                                    <div class="review1">
                                        <ul class="form-list">
                                            <li>
                                                <label class="required" for="nickname_field">Nickname<em>*</em></label>
                                                <div class="input-box">
                                                    <input type="text" class="input-text" id="nickname_field" name="nickname">
                                                </div>
                                            </li>
                                            <li>
                                                <label class="required" for="summary_field">Summary<em>*</em></label>
                                                <div class="input-box">
                                                    <input type="text" class="input-text" id="summary_field" name="title">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="review2">
                                        <ul>
                                            <li>
                                                <label class="required " for="review_field">Review<em>*</em></label>
                                                <div class="input-box">
                                                    <textarea rows="3" cols="5" id="review_field" name="detail"></textarea>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="buttons-set">
                                            <button class="button submit" title="Submit Review" type="submit"><span>Submit Review</span></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="box-reviews2">
                        <h3>Customer Reviews</h3>
                        <div class="box visible">
                            <ul>
                                <li>
                                    <table class="ratings-table">


                                        <tbody>
                                        <tr>
                                            <th>Value</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Quality</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="review">
                                        <h6><a href="#">Excellent</a></h6>
                                        <small>Review by <span>Leslie Prichard </span>on 1/3/2014 </small>
                                        <div class="review-txt"> I have purchased shirts from Minimalism a few times and am never disappointed. The quality is excellent and the shipping is amazing. It seems like it's at your front door the minute you get off your pc. I have received my purchases within two days - amazing.</div>
                                    </div>
                                </li>
                                <li class="even">
                                    <table class="ratings-table">


                                        <tbody>
                                        <tr>
                                            <th>Value</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Quality</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="review">
                                        <h6><a href="#/catalog/product/view/id/60/">Amazing</a></h6>
                                        <small>Review by <span>Sandra Parker</span>on 1/3/2014 </small>
                                        <div class="review-txt"> Minimalism is the online ! </div>
                                    </div>
                                </li>
                                <li>
                                    <table class="ratings-table">


                                        <tbody>
                                        <tr>
                                            <th>Value</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Quality</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th>Price</th>
                                            <td><div class="rating-box">
                                                    <div class="rating"></div>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="review">
                                        <h6><a href="#/catalog/product/view/id/59/">Nicely</a></h6>
                                        <small>Review by <span>Anthony  Lewis</span>on 1/3/2014 </small>
                                        <div class="review-txt"> Unbeatable service and selection. This store has the best business model I have seen on the net. They are true to their word, and go the extra mile for their customers. I felt like a purchasing partner more than a customer. You have a lifetime client in me. </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div></div>
</section>
<!-- Main Container End -->
<!-- Related Products Slider -->
<section class="related-pro">
    <div class="container">
        <div class="slider-items-products">
            <div class="new_title center">
                <h2>Похожие товары</h2>
            </div>
            <div id="related-products-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid">
                    <?php
                    if(is_array($relprod)) {
                        foreach ($relprod as $val) {
                            echo '<div class="item">';
                            echo \frontend\widgets\ProductCardFabia::widget([
                                'template'=>'grid',
                                'product'=>$val['products'],
                                'description'=>$val['productsDescription'],
                                'attrib'=>$val['productsAttributes'],
                                'attr_descr'=>$val['productsAttributesDescr'],
                                'catpath'=>$catpath,
                                'man_time'=>$man_time,
                                'category'=>$val['categories_id'],
                            ]);
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related Products Slider End -->
