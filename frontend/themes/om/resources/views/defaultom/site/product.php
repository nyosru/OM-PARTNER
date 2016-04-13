
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
            $sizeCounter++;
        }
    }
    $prodinfoattr .= '</div></div></div><div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
} else {
    $date = $product['products']['products_date_added'];
    $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px; margin:0 0 24px 0; font-size: 12px; position: relative; max-width: 200px;width: 170px;"><div id="del-count" style="position: absolute; left: 0px; bottom: 1px;">-</div><input id="input-count" class="no-shadow-form-control" style="display:inline; width:55%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
        $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $products['products_attribute_description']['products_options_values_name'] .
        '" data-attr="' . $products['products_attribute_description']['products_options_values_id'] . '"data-name="'.
        $product['productsDescription']['products_name'].'"data-min="'.$product['products']['products_quantity_order_min'].'"data-step="'.$product['products']['products_quantity_order_units'].'" data-count="'.$product['products']['products_quantity'].'" type="text" placeholder="Количество" /><div id="add-count" style="position: absolute; right: 0px; bottom: 1px;">+</div></div>';
    $prodinfoattr .= '</div><div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
}

$items=array();
$i=0;
$im=array($product['products']['products_id']);
$imsrc=array($product['products']['products_image']);
?>
<div class="product">
    <div class="product-top">
        <div class="prod-attr" itemtype="http://schema.org/ProductModel" itemid="#<?=$product['productsDescription']['products_id']?>" style="width: 100%; position: relative;float: left; overflow: hidden;">
            <div class="prod-show" style="position: relative; float: left;width: 100%; right: 50%">
                <div class="col1" style="float: left; width: 50%;position: relative;left: 52%;overflow: hidden; min-width: 550px;">
                    <div class="prod-img" style="overflow: hidden; margin-bottom: 10px;">
                        <div class="mini-img" style="float: left; width: 20%; ">
                            <?
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
                            foreach($imsrc as $key => $img){
                                $items[$i]['content']='<a style="display: block;cursor:zoom-in;"  rel="light" data-gallery="1" href="http://odezhda-master.ru/images/'.$img.'"><img style="margin:auto; width:150%; " src="'.BASEURL.'/imagepreview?src='.$im[$key].'"/></a>';
                                $i++;
                            }
                            echo Carousel::widget([
                                'items'=>$items,'id'=>'slid','clientOptions'=>['interval'=>false]
                            ]);
//
                            ?>
                            <div class="social" style="height: 50px; bottom: 0px; width: 100%;position: relative">
                                <div style="font-size: 14px;font-weight: 300; float: left; width: 100px; margin-top:10px;text-align: left;position: relative;left:67px;">Поделиться:</div>
                                <div title="Поделиться в социальной сети" class="item-social" style="float: left;width: 150px; font-size: 18px; position: absolute;right:64px;">
                                    <?='<div class="social social-vk"><a href="http://vk.com/share.php?url=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'"><i class="fa fa-vk"></i></a></div>'; ?>
                                    <?='<div class="social social-odnokl"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.urlencode('http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id']).'"><i class="fa fa-odnoklassniki"></i></a></div>';?>
                                    <?='<div class="social social-fb"><a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'"><i class="fa fa-facebook"></i></a></div>';?>
                                    <?='<div class="social social-tw"><a href="http://twitter.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&title=' . $description['products_description'] . '"><i class="fa fa-twitter"></i></a></div>';?>
                                    <?='<div class="social social-mail"><a href="http://connect.mail.ru/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&description=' . (integer)($product['products_price']) . '%20Руб.&title=' . $description['products_description'] . '"><i class="fa fa-at"></i></a></div>'?>
                                    <?='<div class="social social-google"><a href="https://plus.google.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '"><i style="font-size:13px;" class="fa fa-google-plus"></i></a></div>'?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col2" style="float: left;width: 35%;position: relative;left: 55%; overflow: hidden;line-height: 1; color: black; font-weight: 400;min-width:455px;">
                    <div style="font-family: 'Roboto', sans-serif; font-weight: 300;">
                        <div itemprop="model" class="prod-code" style="float: left; margin-right: 12%; font-size: 12px;margin-bottom: 19px; ">Код товара: <?=$product['products']['products_model']?></div>
<!--                        <div class="stars" style="color: gold; float: left;">Звездочки</div>-->
                        <div style="clear: both;"></div>
                        <div class="min-opt" style="font-size: 12px; margin-bottom: 19px;">Минимальный оптовый заказ: <?=$product['products']['products_quantity_order_min']?> шт.</div>
                        <div class="prodname" itemprope="name" style="font-size: 24px;margin-bottom: 15px; "><?=$product['productsDescription']['products_name']?></div>
                        <div itemprop="category" class="model" style="display:none"><?=end($catpath->name)?></div>
                        <div itemprop="priceCurrency" style="display:none">RUB</div>
                        <a itemprop="url" href="/glavnaya/product?id=<?=$product['productsDescription']['products_id']?>"></a>
                    </div>
                    <div class="prod-pricing" style="margin-bottom: 25px;">
                        <div class="prod-price-lable" style="clear: both; font-size: 12px; margin-bottom: 7px;">Цена</div>
                        <div class="prod-price" itemprop="price" style="float: left; margin-right: 30px; font-size: 28px; font-weight: 400;margin-bottom: 30px;"><?=(int)$product['products']['products_price']?> руб</div>
<!--                        <div class="prod-price-old" style="text-decoration: line-through; float: left; color: gray;margin-right: 30px; font-size: 14px;line-height: 2;">Старая цена</div>-->
<!--                        <div class="prod-discount" style="color:gray; border: 1px solid #ccc; padding: 2px;float: left;font-size: 12px;line-height: 1.3; top:4px;position: relative;border-radius: 4px;">Скидка много рублей</div>-->
                        <div style="clear: both"></div>
                        <div class="prod-sizes" style="margin: 0 0 38px 0; font-size: 12px; font-weight: 300;"><? if (count($product['productsAttributesDescr']) > 0) echo '<div style="margin: 0 0 20px 0">Размеры</div>'; ?><?=$prodinfoattr?></div>
                        <div class="prod-compos" style="font-size: 12px;">
                            <?
                            // Вывод спецификаций
                            foreach($spec['productsSpecification'] as $key=>$value){
                                $specname='';
                                $specval='';
                                $specname = $spec['specificationDescription'][$value['specifications_id']]['specification_name'];
                                $specval = $spec['specificationValuesDescription'][$value['specification_values_id']]['specification_value'];
                                echo $specname.': '.$specval.'<br/>';
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
            <div class="relative" style="height: 400px; width: 100%; float: left; position: relative;margin-bottom: 60px;overflow: hidden;">
            <?php
            foreach ($relprod as $value) {
                echo \frontend\widgets\ProductCard::widget(['product'=>$value['products'],'description'=>$value['productsDescription'],'attrib'=>$value['productsAttributes'],'attr_descr'=>$value['productsAttributesDescr']]);
            }

            ?>
            </div>
        <div id="modal-product" style="border:none; min-height: 300px;">
            <span id="modal-close"><i class="fa fa-times"></i></span>
        </div>
        <div id="overlay"></div>
<!--    <div class="seen" style="float: left">-->
<!--        <div class="seen-title" style="font-size: x-large; font-weight: 500; margin-bottom: 20px;">Вы недавно смотрели</div>-->
<!--        <div class="seen-items" style="height: 250px; ">-->
<!--            <div class="seen-item" style="border: 1px solid lightgray; width: 170px;height: 100%; text-align: center;">-->
<!--                <div class="seen-img" style="height: 70%;">-->
<!--                    --><?//='<img style="max-width:100%; max-height: 100%; display: block; margin: auto" src="http://odezhda-master.ru/images/'.$product['products']['products_image'].'"/>'?>
<!--                </div>-->
<!--                <div class="seen-name" style="margin: 10px;"><a href="#" style="color: #00A5A1; font-weight: bolder;" >Одежда</a></div>-->
<!--                <div class="seen-price">200 руб</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
    <script>
        $(document).on('ready', function(){
            $('a[rel=light]').light();
        });

        </script>