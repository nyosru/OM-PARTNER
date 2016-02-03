
<?php
use yii\bootstrap\Carousel;
$this->title = $product['productsDescription']['products_name'];
$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
if (count($product['productsAttributesDescr']) > 0) {
    foreach ($product['productsAttributesDescr'] as $item) {
        $date = $product['products.products_date_added'];
        $prodinfoattr .= '<div class="size-desc"><div><div class="lable-item" id="input-count" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' . $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $item['products_options_values_name'] . '" data-attr="' . $item['products_options_values_id'] . '" data-name="' . $product['productsDescription']['products_name'] . '">' . $item['products_options_values_name'] . '</div></div></div>';
    }
} else {
    $date = $product['products']['products_date_added'];
    $prodinfoattr .= '<div class="size-desc"><div class="lable-item"  id="input-count" data-prod="' . $product['products']['products_id'] . '" data-model="' . $product['products']['products_model'] . '" data-price="' . $product['products']['products_price'] . '" data-image="' . $product['products']['products_image'] . '" data-attrname="' . $item['products_options_values_name'] . '" data-attr="' . $item['products_options_values_id'] . '" data-name="' . $product['productsDescription']['products_name'] . '">+</div></div>';
}
$items=array();
$i=0;
$im=array('http://odezhda-master.ru/images/'.$product['products']['products_image'],'http://odezhda-master.ru/images/catalog_4/566192de0315b.jpg','http://odezhda-master.ru/images/catalog_4/5652c01627c11.jpg');

//echo '<pre>';
//print_r ($catpath);
//print_r($product);
//echo '</pre>';
?>
<div class="product">
    <div class="product-top">
        <div class="prod-attr" itemtype="http://schema.org/ProductModel" itemid="#<?=$product['productsDescription']['products_id']?>" style="width: 100%; position: relative;float: left; overflow: hidden;">
            <div class="prod-show" style="position: relative; float: left;width: 100%; right: 50%">
                <div class="col1" style="float: left; width: 60%;position: relative;left: 52%;overflow: hidden">
                    <div class="prod-img" style="">
                        <div class="mini-img" style="float: left; width: 20%; border-right: 1px solid lightgray;">
                            <?
                            foreach($im as $img){
                                echo'<div id="carousel-selector-'.$i.'" style="height: 150px; width: 100%; margin-top: 5px; overflow: hidden" class="mini-img-item"><img style="height: 100%; display: block; margin: auto;" src="'.$img.'"/> </div>';
                                $i++;
                            }
                            ?>
                        </div>
                        <div style="float: right; width: 80%">
                            <?php
                            $i=0;
                            foreach($im as $img){
                                $items[$i]['content']='<img style="margin:auto;  height:650px;" src="'.$img.'"/>';
                                $i++;
                            }
                            echo Carousel::widget([
                                'items'=>$items,'id'=>'slid','clientOptions'=>['interval'=>false]
                            ]);
//
                            ?>
                        </div>
                    </div>
                    <div class="social" style="font-size:xx-large ; height: 50px; bottom: 0px; width: 100%"><div style="font-size: medium; float: left; width: 30%; margin-top:10px;margin-left: 110px;"> Поделиться:</div>
                        <div title="Поделиться в социальной сети" class="item-social" style="float: left;width: 40%">
                            <?='<div class="social social-vk"><a href="http://vk.com/share.php?url=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&description='.(integer)($product['products_price']).'"><i class="fa fa-vk"></i></a></div>'; ?>
                            <?='<div class="social social-odnokl"><a href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl='.urlencode('http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id']).'&st.comments='.urlencode($description['products_description']).'"><i class="fa fa-odnoklassniki"></i></a></div>';?>
                            <?='<div class="social social-fb"><a href="http://www.facebook.com/sharer.php?s=100&p[url]=http://'.$_SERVER['HTTP_HOST'].BASEURL.'/product?id='.$product['products_id'].'&p[summary]='.(integer)($product['products_price']).'%20Руб.&p[title]='.$description['products_description'].'"><i class="fa fa-facebook"></i></a></div>';?>
                            <?='<div class="social social-tw"><a href="http://twitter.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&title=' . $description['products_description'] . '"><i class="fa fa-twitter"></i></a></div>';?>
                            <?='<div class="social social-mail"><a href="http://connect.mail.ru/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '&description=' . (integer)($product['products_price']) . '%20Руб.&title=' . $description['products_description'] . '"><i class="fa fa-at"></i></a></div>'?>
                            <?='<div class="social social-google"><a href="https://plus.google.com/share?url=http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/product?id=' . $product['products_id'] . '"><i class="fa fa-google-plus"></i></a></div>'?>
                        </div>
                    </div>
                </div>
                <div class="col2" style="float: left;width: 40%;position: relative;left: 55%; overflow: hidden; font-size: large;line-height: 1.6; color: black; font-weight: 400;">
                    <div class="prod-code" style="float: left; margin-right: 12%; font-size: small; font-weight: 400;">Код товара: <?=$product['products']['products_model']?></div>
                    <div class="stars" style="color: gold; float: left;">Звездочки</div>
                    <div style="clear: both;"></div>
                    <div class="min-opt" style="font-size: small;font-weight: 400;">Минимальный оптовый заказ: Х шт.</div>
                    <div class="prodname" itemprope="name" style="font-size: xx-large; font-weight: 400;"><?=$product['productsDescription']['products_name']?></div>
                    <div itemprop="model" class="model" style="display:none"><?=$product['products']['products_model']?></div>
                    <div itemprop="description" class="model" style="display:none"><?=$product['productsDescription']['products_description']?></div>
                    <div itemprop="category" class="model" style="display:none"><?=end($catpath->name)?></div>
                    <div itemprop="priceCurrency" style="display:none">RUB</div>
                    <a itemprop="url" href="/glavnaya/product?id=<?=$product['productsDescription']['products_id']?>"></a>
                    <div class="prod-pricing">
                        <div class="prod-price-lable" style="clear: both">Цена</div>
                        <div class="prod-price" itemprop="price" style="float: left; margin-right: 30px;"><?=$product['products']['products_price']?> руб</div>
                        <div class="prod-price-old" style="text-decoration: line-through; float: left; color: gray;margin-right: 30px;">Старая цена</div>
                        <div class="prod-discount" style="color:gray; border: 1px solid lightgray; padding: 1px;float: left">Скидка много рублей</div>
                        <div style="clear: both"></div>
                        <div class="prod-sizes" style="margin: 20px 0px;">Размеры <br/><?=$prodinfoattr?><br/><br/><br/><br/></div>
                        <div class="prod-compos" style="font-size: small;font-weight: bold;">
                            <a id="prdesc" style="color: #337ab7; cursor: pointer">Подробные характеристики</a><br>
                            <div id="prd" style="display: none"><?=$product['productsDescription']['products_description']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rel-head" style="height: 40px; float: left;">Похожие</div>
            <div style="clear: both"></div>
            <div class="relative" style="height: 400px; width: 100%; float: left; position: relative;">
                <div class="rel-item" style="height: 100%;width: 320px; float: left; border: 1px solid lightgray; text-align: center;padding: 25px; margin-right: 10px;">
                    <div class="rel-img" style="height: 87%;">
                        <?='<img style="max-height: 100%; max-width:100%; display: block; margin: auto" src="http://odezhda-master.ru/images/'.$product['products']['products_image'].'"/>'?>
                    </div>
                    <div class="rel-name" style="margin: 10px;"><a href="#"  style="color: #00A5A1; font-weight: bolder;">Одежда</a></div>
                    <div class="rel-price" style="margin: 10px;">1000 руб</div>
                </div>
                <div class="rel-item" style="height: 100%;width: 320px; float: left; border: 1px solid lightgray; text-align: center;padding: 25px;  margin-right: 10px;">
                    <div class="rel-img" style="height: 87%;">
                        <?='<img style="max-height: 100%; max-width:100%; display: block; margin: auto" src="http://odezhda-master.ru/images/'.$product['products']['products_image'].'"/>'?>
                    </div>
                    <div class="rel-name" style="margin: 10px;"><a href="#" style="color: #00A5A1; font-weight: bolder;" >Одежда</a></div>
                    <div class="rel-price" style="margin: 10px;">1000 руб</div>
                </div>
            </div>
        </div>
    </div>

    <div style="clear: both;"></div>
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