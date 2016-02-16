
<?php
use yii\bootstrap\Carousel;
$this->title = $product['productsDescription']['products_name'];
$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
$prodinfoattr='<div class="size-block" style="overflow: hidden;margin-bottom: 38px; width: 460px;">';
if (count($product['productsAttributesDescr']) > 0) {
    $numInFirstColumn=(int)(count($product['productsAttributesDescr'])/2);
    $sizeCounter=0;
    $prodinfoattr.='<div class="size-column1" style="width: 215px; overflow: hidden; float: left; border-right: 1px solid lightgrey;margin-right: 25px;">';
    foreach ($product['productsAttributesDescr'] as $item) {
        if($sizeCounter==($numInFirstColumn)){
            $prodinfoattr.='</div><div class="size-column2" style="overflow: hidden; width: 215px;">';
        }
        $date = $product['products.products_date_added'];
        $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px; margin:0 0 24px 0; font-size: 12px; position: relative; max-width: 200px;width: 200px;"><div style="float: left; width: 45%;font-size: 18px; font-weight: 300; text-align: left; top:3px; position:relative;">' .
            $item['products_options_values_name'] . '</div><div><div id="del-count">-</div><input id="input-count" class="no-shadow-form-control" style="display:inline; width:25%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' .
            $product['products']['products_id'] . '" data-model="' .
            $product['products']['products_model'] . '" data-price="' .
            $product['products']['products_price'] . '" data-image="' .
            $product['products']['products_image'] . '" data-attrname="' .
            $item['products_options_values_name'] . '" data-attr="' .
            $item['products_options_values_id'] . '"data-name="'.
            $product['productsDescription']['products_name'].'"data-min="'.
            $product['products']['products_quantity_order_min'].'"data-step="'.
            $product['products']['products_quantity_order_units'].
            '" type="text" placeholder="0" /><div id="add-count">+</div></div></div>';
        $sizeCounter++;
    }
    $prodinfoattr .= '</div></div></div><div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
} else {
    $date = $product['products']['products_date_added'];
    $prodinfoattr .= '<div class="size-desc" style="color: black;padding:0px; margin:0 0 24px 0; font-size: 12px; position: relative; max-width: 200px;width: 170px;"><div id="del-count" style="position: absolute; left: 0px; bottom: 1px;">-</div><input id="input-count" class="no-shadow-form-control" style="display:inline; width:55%;padding:0; height:23px; text-align:center; top:-1px;" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' .
        $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $products['products_attribute_description']['products_options_values_name'] .
        '" data-attr="' . $products['products_attribute_description']['products_options_values_id'] . '"data-name="'.
        $product['productsDescription']['products_name'].'"data-min="'.$product['products']['products_quantity_order_min'].'"data-step="'.$product['products']['products_quantity_order_units'].'" type="text" placeholder="Количество" /><div id="add-count" style="position: absolute; right: 0px; bottom: 1px;">+</div></div>';
    $prodinfoattr .= '</div><div class="cart-lable" data-sale="'.$product['products']['products_id'].'" style="position:relative ;bottom:0; left: 0; width: 163px; height: 43px; padding: 0px;text-transform: none; font-weight: 300; font-size: 14px; line-height:3;">В корзину</div>';
}

$items=array();
$i=0;
$im=array(BASEURL.'/imagepreview?src='.$product['products']['products_image']);

//echo '<pre>';
//print_r ($spec);
//echo '</pre>';
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
                                if($i!=0) echo '<div id="carousel-selector-' . $i . '" style=" width: 100px; margin-top: 5px; overflow: hidden" class="mini-img-item"><img style="width: 100%; display: block; margin: auto;" src="' . $img . '"/> </div>';
                                else echo '<div id="carousel-selector-' . $i . '" style=" width: 100px; margin-top: 5px; overflow: hidden" class="mini-img-item selected"><img style="width: 100%; display: block; margin: auto;" src="' . $img . '"/> </div>';
                                    $i++;
                            }
                            ?>
                        </div>
                        <div style="float: right; width: 63%; min-width: 440px;">
                            <?php
                            $i=0;
                            foreach($im as $img){
                                $items[$i]['content']='<img style="margin:auto; width:150%; " src="'.$img.'"/>';
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
                                    <?='<div class="social social-vk"><a href="http://vk.com/share.php?url=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&description='.(integer)($product['products_price']).'"><i class="fa fa-vk"></i></a></div>'; ?>
                                    <?='<div class="social social-odnokl"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.urlencode('http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id']).'&st.comments='.urlencode($description['products_description']).'"><i class="fa fa-odnoklassniki"></i></a></div>';?>
                                    <?='<div class="social social-fb"><a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&p[summary]='.(integer)($product['products_price']).'%20Руб.&p[title]='.$description['products_description'].'"><i class="fa fa-facebook"></i></a></div>';?>
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
                        <div class="stars" style="color: gold; float: left;">Звездочки</div>
                        <div style="clear: both;"></div>
                        <div class="min-opt" style="font-size: 12px; margin-bottom: 19px;">Минимальный оптовый заказ: Х шт.</div>
                        <div class="prodname" itemprope="name" style="font-size: 24px;margin-bottom: 15px; "><?=$product['productsDescription']['products_name']?></div>
                        <div itemprop="category" class="model" style="display:none"><?=end($catpath->name)?></div>
                        <div itemprop="priceCurrency" style="display:none">RUB</div>
                        <a itemprop="url" href="/glavnaya/product?id=<?=$product['productsDescription']['products_id']?>"></a>
                    </div>
                    <div class="prod-pricing" style="margin-bottom: 25px;">
                        <div class="prod-price-lable" style="clear: both; font-size: 12px; margin-bottom: 7px;">Цена</div>
                        <div class="prod-price" itemprop="price" style="float: left; margin-right: 30px; font-size: 28px; font-weight: 400;margin-bottom: 30px;"><?=(int)$product['products']['products_price']?> руб</div>
                        <div class="prod-price-old" style="text-decoration: line-through; float: left; color: gray;margin-right: 30px; font-size: 14px;line-height: 2;">Старая цена</div>
                        <div class="prod-discount" style="color:gray; border: 1px solid #ccc; padding: 2px;float: left;font-size: 12px;line-height: 1.3; top:4px;position: relative;border-radius: 4px;">Скидка много рублей</div>
                        <div style="clear: both"></div>
                        <div class="prod-sizes" style="margin: 0 0 38px 0; font-size: 12px; font-weight: 300;"><? if (count($product['productsAttributesDescr']) > 0) echo '<div style="margin: 0 0 20px 0">Размеры</div>'; ?><?=$prodinfoattr?></div>
                        <div class="prod-compos" style="font-size: 12px;">
                            <?
                            // Вывод спецификаций
                            foreach($spec[0]['specificationDescription'] as $key=>$value){
                                echo $value['specification_name'].': '.$spec[0]['specificationValuesDescription'][$key]['specification_value'].'<br/>';
                            }
                            ?>
                            <br/>
                            <a id="prdesc" style="color: #337ab7; cursor: pointer;margin-bottom: 20px;">Подробные характеристики</a>
                            <div itemprop="description" id="prd" style="display: none; font-size: 12px !important; font-weight: 400 !important; margin-top: 20px;"><br/><?=$product['productsDescription']['products_description']?></div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="rel-head" style="height: 40px; float: left;font-size:24px; font-weight: 400;">Похожие товары</div>
            <div class="relative" style="height: 400px; width: 100%; float: left; position: relative;margin-bottom: 20px;">
            <?php
            foreach($relprod as $value){
                echo '<div class="rel-item" style="height: 100%;width: 310px; float: left; border: 1px solid lightgray; text-align: center;padding: 25px; margin-right: 10px;">';
                echo '<div class="rel-img" style="height: 75%;"><img style="max-height: 100%; max-width:100%; display: block; margin: auto" src="http://odezhda-master.ru/images/'.$value['products_image'].'"/></div>';
                echo '<div class="rel-name" style="height: 22%;"><a href="'.BASEURL.'/product?id='.$value['products_id'].'"  style="color: #00A5A1; font-weight: bolder;">'.$value['products_name'].'</a></div>';
                echo '<div class="rel-price" style="margin: 10px; height: 3%;">'.(integer)$value['products_price'].' руб. </div></div>';
            }
            ?>
            </div>
    <div class="ov-desc" style="margin:45px 0">
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
                <?= \frontend\widgets\CommentsBlock::widget(['category' => 1, 'relateID' => $product['products']['products_id']]) ?>
            </p>
        </section>
    </div>
    <div class="seen">
        <div class="seen-title" style="font-size: x-large; font-weight: 500; margin-bottom: 20px;">Вы недавно смотрели</div>
        <div class="seen-items" style="height: 250px; ">
            <div class="seen-item" style="border: 1px solid lightgray; width: 170px;height: 100%; text-align: center;">
                <div class="seen-img" style="height: 70%;">
                    <?='<img style="max-width:100%; max-height: 100%; display: block; margin: auto" src="http://odezhda-master.ru/images/'.$product['products']['products_image'].'"/>'?>
                </div>
                <div class="seen-name" style="margin: 10px;"><a href="#" style="color: #00A5A1; font-weight: bolder;" >Одежда</a></div>
                <div class="seen-price">200 руб</div>
            </div>
        </div>
    </div>
</div>