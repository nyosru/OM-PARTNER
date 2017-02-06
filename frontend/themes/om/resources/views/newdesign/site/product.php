
<?php
use yii\bootstrap\Carousel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\traits\Products\ProductVariants;

$this->title = $product['productsDescription']['products_name'];

$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
$this->registerMetaTag(['content' => Html::encode($product['productsDescription']['products_name']), 'property' => 'og:title',]);
$this->registerMetaTag(['content' => 'product', 'property' => 'og:type',]);
$this->registerMetaTag(['content' => Html::encode($_SERVER['SERVER_NAME'].BASEURL.'/product?id='.$product['products']['products_id']), 'property' => 'og:url',]);
$this->registerMetaTag(['content' => 'http://odezhda-master.ru/images/'.$product['products']['products_image'], 'property' => 'og:image',]);
$this->registerMetaTag(['content' => 'Одежда Мастер. Интернет-магазин', 'property' => 'og:site_name',]);
$this->registerMetaTag(['content' => 'Цена: '.(integer)$product['products']['products_price'].' рублей. '.Html::encode($product['productsDescription']['products_description']), 'property' => 'og:description',]);

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
                                    $paste[0] =  'catalog/'.$chpu->categoryChpu($catid);
                                }
                            }else{
                                $paste[0] = $urlsrc[0];
                                $paste['cat'] = $catid;
                            }
                            if(count($catpath['num'])>=1 && $catpath['num'][0]!=0 && $key==0){
                                echo '<li><a href="/catalog/">Каталог</a><span>→ </span></li>';
                            }
                            echo '<li><a href="' . Url::toRoute($paste) . '">' . $catpath['name'][$key] . '</a><span>→ </span></li>';
                        }
                        echo '<li><strong>'.$product['productsDescription']['products_name'].'</strong></li>';
                    }
                    ?>
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
<?php if(is_array($relprod) && !empty($relprod)) { ?>
    <?php
    $session = Yii::$app->session;
    $session_name = 'relprod_'.$product['categories_id'];
    if(empty($session[$session_name])){
        $relprod_ids = [];
        foreach ($relprod as $key=>$item) {
            $relprod_ids[$key] = (int)$item['products_id'];
        }
        $session[$session_name] = $relprod_ids;
    }
    $relprod_index = array_search($product['products_id'], $session[$session_name]);

    if($relprod_index !== FALSE){
        if($relprod_index==0){
            $next_product = 1;
            $prev_product = count($session[$session_name]) - 1;
        } elseif ($relprod_index == count($session[$session_name])) {
            $next_product = 0;
            $prev_product = $relprod_index - 1;
        } else {
            $next_product = $relprod_index + 1;
            $prev_product = $relprod_index - 1;
        }
    } else {
        $next_product = 1;
        $prev_product = 0;
    }

    ?>
    <div class="product-next-prev">
        <a class="product-next" href="<?=Url::to(['product','id'=>$session[$session_name][$next_product]])?>"><span></span></a>
        <a class="product-prev" href="<?=Url::to(['product','id'=>$session[$session_name][$prev_product]])?>"><span></span></a>
    </div>
<?php } ?>
<div class="product-essential">
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
        <div class="info-block">
            <ul>
                <li>Код: <strong><?=$product['products']['products_model']?></strong></li>
                <li style="border: none;">Мин. опт. зака: <?=$product['products']['products_quantity_order_min']?> шт.</li>
                <li>Заказано: <?=$product['products']['products_ordered']?> шт.</li>
            </ul>
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
                <?php if($product_sizes['isset_variants']) {?>
                    <p>Размеры в наличии:</p>
                    <div class="row add-to-cart-inputs">
                        <?php foreach($product_sizes['sizes'] as $item){ ?>
                            <div class="col-md-4">
                                <div class="label-product"><?=$item['label']?></div>
                                <div class="custom">
                                    <button id="del-count" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                                    <?=Html::textInput('','',['data'=>$item['data_attr'], 'class'=>'input-text qty','id'=>'input-count','placeholder'=>0])?>
                                    <button id="add-count" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="pull-left" style="margin-right: 10px;">
                        <div class="custom pull-left">
                            <button id="del-count" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
                            <?=Html::textInput('','',['data'=>$product_sizes['sizes']['data_attr'], 'class'=>'input-text qty','id'=>'input-count','placeholder'=>0])?>
                            <button id="add-count" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
                        </div>
                    </div>
                <?php } ?>
                <?php if($product_sizes['count_product'] > 0) { ?>
                    <button class="button btn-cart cart-lable disabled" data-sale="<?=$product['products']['products_id']?>"><span><i class="icon-basket"></i> Добавить в корзину</span></button>
                <?php }else{ ?>
                    <button class="button btn-cart cart-lable disabled" data-sale="<?=$product['products']['products_id']?>"><span><i class="icon-basket"></i> Продано</span></button>
                <?php } ?>
            </div>
            <div class="email-addto-box">
                <ul class="add-to-links">
                    <li> <a class="link-wishlist selected-product"  data-product="<?=$product['products_id']?>" href="#"><span>В избранное</span></a></li>
                </ul>
            </div>
        </div>
        <div class="social">
            <ul class="link">
                <li class="vk"><a href="#"></a></li>
                <li class="ok"><a href="#"></a></li>
                <li class="fb"><a href="#"></a></li>
                <li class="tw"><a href="#"></a></li>
                <li class="googleplus"><a href="#"></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="product-collateral col-lg-12 col-sm-12 col-xs-12">
    <div class="add_info">
        <ul id="product-detail-tab" class="nav nav-tabs product-tabs">
            <li class="active"> <a href="#product_tabs_specification" data-toggle="tab">Характеристики</a> </li>
            <li> <a href="#product_tabs_description" data-toggle="tab">Полное описание</a> </li>
            <li> <a href="#reviews_tabs" data-toggle="tab">Отзывы</a> </li>
        </ul>
        <div id="productTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="product_tabs_specification">
                <?php if(is_array($spec['productsSpecification']) && !empty($spec['productsSpecification'])){ ?>
                    <ul class="product-specification">
                        <?php foreach ($spec['productsSpecification'] as $key => $value) { ?>
                            <li>
                                <?=$spec['specificationDescription'][$value['specifications_id']]['specification_name']?>:
                                <strong><?=$spec['specificationValuesDescription'][$value['specification_values_id']]['specification_value']?></strong>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p>У товара отсутствуют характеристики</p>
                <?php } ?>
            </div>
            <div class="tab-pane fade" id="product_tabs_description">
                <div class="std"><p style="white-space: pre-wrap;"><?=$product['productsDescription']['products_description']?></p></div>
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
            <div id="featured-slider" class="product-flexslider hidden-buttons">
                <div class="slider-items slider-width-col4 products-grid">
                    <?php
                    if(is_array($relprod)) {
                        foreach ($relprod as $val) {
                            echo '<div class="item">';
                            echo \frontend\widgets\ProductCardFabia::widget([
                                'template'=>'grid',
                                'css'=>['imageHeight'=>'205px'],
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
<script>
    /*
    Кнопка "В корзину" активна только при выбранных размерах
     */
    function btnState(){
        setTimeout(function(){
            var countProducts = 0;
            $('.input-text.qty').each(function(){
                if($(this).val()!=''){
                    countProducts += parseInt($(this).val());
                }
            });
            if(countProducts > 0){
                $('.cart-lable').removeClass('disabled');
            } else {
                $('.cart-lable').addClass('disabled');
            }
        },100);
    }
    $(document).on('click', '.items-count', function(){
        btnState();
    });
    $(document).on('keyup', '.input-text qty', function(){
        btnState();
    });
</script>