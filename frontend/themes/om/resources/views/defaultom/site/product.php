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
        if( $product['products']['products_quantity_order_units'] === '1'  ||  $product['products']['products_quantity_order_min']  === '1'){
            $disable_for_stepping = 'read';
        }else{
            $disable_for_stepping = 'readonly';
        }
        $date = $product['products.products_date_added'];
        if($product['productsAttributes'][$item['products_options_values_id']] && $product['productsAttributes'][$item['products_options_values_id']]['quantity'] > 0) {
            $prodinfoattr .= '<div class="size-desc"><div class="pr_op_va_name">' .
                $item['products_options_values_name'] . '</div><div><div id="del-count">-</div><input '.$disable_for_stepping.' id="input-count" class="no-shadow-form-control" style="display:inline; width:25%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' .
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
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;"><noindex>В корзину</noindex></div>';
    }else{
        $cart_html = '<div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; background: #E9516D; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">Продано</div>';
    }
    $prodinfoattr .= '</div></div></div>'.$cart_html;
} else {
    $date = $product['products']['products_date_added'];
    if( $product['products']['products_quantity_order_units'] === '1'  ||  $product['products']['products_quantity_order_min']  === '1'){
        $disable_for_stepping = 'read';
    }else{
        $disable_for_stepping = 'readonly';
    }
    $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px; margin:0 0 24px 0; font-size: 12px; position: relative; max-width: 200px;width: 170px;"><div id="del-count" style="position: absolute; left: 0px; bottom: 1px;">-</div><input '.$disable_for_stepping.' id="input-count" class="no-shadow-form-control" style="display:inline; width:55%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
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
$sub = [];
$im= array($product['products']['products_id']);
if($images){
    foreach($images as $img_key => $img_val){
        $sub[] = $product['products']['products_id'].'&amp;sub='.$img_key;
    }
}

$im = array_merge($im, $sub);

$imsrc=array($product['products']['products_image']);
$imsrc=array_merge($imsrc, $images);
if(!$product['products']['products_image']){
    $imsrc = array();
}
?>
<div class="product">
    <div class="product-top">
        <div class="prod-attr" itemscope itemtype="http://schema.org/ProductModel" itemid="#<?=$product['productsDescription']['products_id']?>" style="width: 100%; position: relative;float: left; overflow: hidden;">
            <div class="prod-show" style="position: relative; float: left;width: 100%; right: 50%">
                <div class="col1" style="float: left; width: 50%;position: relative;left: 52%;overflow: hidden; min-width: 550px;">
                    <div style="padding-bottom: 10px; margin-bottom: 5px;">
                        <?php
                        $breadcruumpsresult = array();
                        foreach ($catpath['num'] as $breadcrumpskey => $breadcrumpsvalue){
                            $breadcruumpsresult[] = '<a href="/catalog?cat='.$breadcrumpsvalue.'">'.$catpath['name'][$breadcrumpskey].'</a>';
                        }
                        $breadcruumpsresult = implode(' / ', $breadcruumpsresult);
                        echo $breadcruumpsresult;
                        ?>
                    </div>
                    <div class="prod-img" style="overflow: hidden; margin-bottom: 10px;">
                        <div class="mini-img" style="float: left; width: 20%; ">
                            <?php
                            foreach($im as $img){
                                if($i!=0) echo '<div id="carousel-selector-' . $i . '" style=" width: 100px; margin-top: 5px; overflow: hidden" class="mini-img-item"><img style="width: 100%; display: block; margin: auto;" src="'.BASEURL.'/imagepreview?src=' . $img . '"/> </div>';
                                else echo '<div id="carousel-selector-' . $i . '" style=" width: 100px; margin-top: 5px; overflow: hidden" class="mini-img-item selected"><img style="width: 100%; display: block; margin: auto;" src="'.BASEURL.'/imagepreview?src=' . $img . '"/> </div>';
                                $i++;
                            }
                            ?>
                        </div>
                        <div style="float: right; width: 63%; min-width: 440px;">

                            <?php
                            $i=0;
                            $items = [];
                            foreach($imsrc as $key => $img){
                                $items[$i]['content']='<a target="_blank" style="display: block;cursor:zoom-in;"  rel="light" data-gallery="product" href="http://odezhda-master.ru/images/'.$img.'"><img style="margin:auto;  " itemprop="image"  src="'.BASEURL.'/imagepreview?src='.$im[$key].'" alt="'.$product['productsDescription']['products_name'].'"/></a>';
                                $i++;
                            }
                            echo Carousel::widget([
                                'items'=>$items,'id'=>'slid','clientOptions'=>['interval'=>false]
                            ]);
                            //
                            ?>
                            <div class="" style="
                             height: 50px;
                             bottom: 0px;
                             width: 100%;
                             position: relative;
                             float: left;
                             overflow: hidden;
                             line-height: 1;
                             text-align: center;
                             margin-right: 5px;
                             margin-top: 5px;
                             border-radius: 2px;
                             ">
                                <div style="font-size: 14px;font-weight: 300; float: left; width: 100px; margin-top:10px;text-align: left;position: relative;left:67px;">Поделиться:</div>
                                <div title="Поделиться в социальной сети" class="item-social" style="float: left;width: 150px; font-size: 18px; position: absolute;right:64px;">
                                    <?='<div class="social social-vk"><a target="_blank" href="http://vk.com/share.php?url=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'"><i class="fa fa-vk"></i></a></div>'; ?>
                                    <?='<div class="social social-odnokl"><a target="_blank" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.urlencode('http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id']).'"><i class="fa fa-odnoklassniki"></i></a></div>';?>
                                    <?='<div class="social social-fb"><a target="_blank" href="http://www.facebook.com/sharer.php?s=100&p[url]=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'"><i class="fa fa-facebook"></i></a></div>';?>
                                    <?='<div class="social social-tw"><a target="_blank" href="http://twitter.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&title=' . $description['products_description'] . '"><i class="fa fa-twitter"></i></a></div>';?>
                                    <?='<div class="social social-mail"><a target="_blank" href="http://connect.mail.ru/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&description=' . (integer)($product['products_price']) . '%20Руб.&title=' . $description['products_description'] . '"><i class="fa fa-at"></i></a></div>'?>
                                    <?='<div class="social social-google"><a target="_blank" href="https://plus.google.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '"><i style="font-size:13px;" class="fa fa-google-plus"></i></a></div>'?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col2" style="float: left;width: 35%;position: relative;left: 55%; overflow: hidden;line-height: 1; color: black; font-weight: 400;min-width:455px;">
                    <div style="font-family: 'Roboto', sans-serif; font-weight: 300;">
                        <?php
                        if(!$product['products']['products_ordered']){
                            $product['products']['products_ordered'] = 1;

                        }
                        if((int)$product['products']['products_ordered'] >= 10000){
                            $product['products']['products_ordered'] = "Хит продаж!";
                        }else{
                            $product['products']['products_ordered'] =  $product['products']['products_ordered']." шт";
                        }?>

                        <div class="min-opt" style="font-size: 12px; margin-bottom: 19px;">Минимальный оптовый заказ: <?=$product['products']['products_quantity_order_min']?> шт.</div>
                        <div class="min-opt" style="font-size: 12px; margin-bottom: 19px;">Заказано: <?=$product['products']['products_ordered']?></div>
                        <div itemprop="model" class="prod-code" style="float: left; margin-right: 12%; font-size: 12px;margin-bottom: 19px; ">Код товара: <?=$product['products']['products_model']?></div>
                        <!--                        <div class="stars" style="color: gold; float: left;">Звездочки</div>-->
                        <div style="clear: both;"></div>
                        <div class="prodname" itemprop="name" style="font-size: 24px;margin-bottom: 15px; "><?=$product['productsDescription']['products_name']?></div>
                        <div itemprop="category" class="model" style="display:none"><?=end($catpath['name'])?><</div>
                        <a itemprop="url" href="/glavnaya/product?id=<?=$product['productsDescription']['products_id']?>"></a>
                    </div>
                    <div class="prod-pricing" itemprop="offers" itemscope itemtype="http://schema.org/Offer" style="margin-bottom: 25px;">
                        <div class="prod-price-lable"  style="clear: both; font-size: 12px; margin-bottom: 7px;">Цена</div>
                        <div class="prod-price" itemprop="price" style="float: left; margin-right: 30px; font-size: 28px; font-weight: 400;margin-bottom: 30px;"><?=(int)$product['products']['products_price']?><noindex> руб</noindex></div>
                        <div itemprop="priceCurrency" style="display:none"><noindex>RUB</noindex></div>
                        <!--
  <div class="prod-price-old" style="text-decoration: line-through; float: left; color: gray;margin-right: 30px; font-size: 14px;line-height: 2;">Старая цена</div>-->
                        <!--                        <div class="prod-discount" style="color:gray; border: 1px solid #ccc; padding: 2px;float: left;font-size: 12px;line-height: 1.3; top:4px;position: relative;border-radius: 4px;">Скидка много рублей</div>-->
                        <div style="clear: both"></div>
                        <div class="prod-sizes" style="margin: 0 0 38px 0; font-size: 12px; font-weight: 300;"><?php if (count($product['productsAttributesDescr']) > 0) echo '<div style="margin: 0 0 20px 0"><noindex>Размеры</noindex></div>'; ?><?=$prodinfoattr?></div>
                        <div class="prod-compos" style="font-size: 12px;">
                            <?php
                            // Вывод спецификаций
                            if(is_array($spec['productsSpecification'])){
                                foreach ($spec['productsSpecification'] as $key => $value) {
                                    $specname = '';
                                    $specval = '';
                                    $specname = $spec['specificationDescription'][$value['specifications_id']]['specification_name'];
                                    $specval = $spec['specificationValuesDescription'][$value['specification_values_id']]['specification_value'];
                                    echo $specname . ': ' . $specval . '<br/>';
                                }
                            }
                            ?>
                            <br/>
                            <a href="#descr" style="color: #337ab7; cursor: pointer;margin-bottom: 20px;">Подробные характеристики</a>
                            <div itemprop="description" id="prd" style="display: none; font-size: 12px !important; font-weight: 400 !important; margin-top: 20px;"><br/><?=$product['productsDescription']['products_description']?></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div style="width: 100%;overflow: hidden; float: left;">
            <a name="descr"></a>
            <div class="ov-desc" style="float:left; ">
                <input id="tab1" type="radio" name="tabs" checked>
                <label for="tab1" title="Подробное описание">Подробное описание</label>

                <input id="tab2" type="radio" name="tabs">
                <label for="tab2" title="Отзывы">Отзывы</label>
                <section id="content1">
                    <p>
                        <?=$product['productsDescription']['products_description']?>
                    </p>
                </section>
                <section id="content2">
                    <p>
                        <?= \frontend\widgets\CommentsBlockOM::widget(['category' => 1, 'relateID' => $product['products']['products_id']]) ?>
                    </p>
                </section>
            </div>
        </div>
        <div class="rel-head" style="height: 40px; float: left;font-size:24px; font-weight: 400;">Похожие товары</div>
        <div class="relative" style="height: 460px; width: 100%; float: left; position: relative;margin-bottom: 60px;overflow: hidden;">


            <div id="slid4" style="width: 100%;">
                <div class="carousel-inner sliderNew">
                    <?php
                    if (is_array($relprod))
                        foreach ($relprod as $k1=>$val){ ?>
                            <div class="item">
                                <?php
                                $analitics = '
                         <script>
                            ga( "ec:addImpression", {
                                "id": "'.$val['products']['products_id'].'",
                                "name": "'.htmlentities($val['productsDescription']['products_name']).'",
                                "category": "none",
                                "list": "main-new",
                                "brand": "'.$val['products']['manufacturers_id'].'",
                                "variant": "none",
                                "position": "'.$k1.'"});
                            ga("ec:setAction", "view");
                            ga("send", "event" , "view", "'.$_SERVER["REQUEST_URI"].'" );
                         </script>
                        ';
                                echo $analitics;
                                echo  \frontend\widgets\ProductCard::widget(['product' => $val['products'], 'description' => $val['productsDescription'], 'attrib' => $val['productsAttributes'], 'attr_descr' => $val['productsAttributesDescr'], 'catpath' => $catpath, 'man_time' => $man_time,'category'=>$val['categories_id'],'showdiscount'=>1]);
                                ?>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(window).on('load',function () {
            $("[rel=light]").light();
            $('.sliderNew').owlCarousel({
                loop:true,
                margin:2,
                nav:true,
                items: 6,
                autoplay:true,
                navText: ['<a class="left carousel-control" data-slide="prev">‹</a>','<a class="right carousel-control" data-slide="next">›</a>'],
                dots:false,
                responsive:{
                    0:{
                        items:4
                    },
                    1024:{
                        items:3
                    },
                    1280:{
                        items:4
                    },
                    1560:{
                        items:5
                    },
                    1900:{
                        items:6
                    }
                }
            });

            $(".social").on('click', function () {
                
                ga("send", "event", $(this).attr("class").split(' ')[0], $(this).attr("class").split(' ')[1]);
            })
        });
    </script>