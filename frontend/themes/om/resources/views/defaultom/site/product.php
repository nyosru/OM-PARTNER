
<?php
use yii\bootstrap\Carousel;
$this->title = $product['productsDescription']['products_name'];
$this->registerMetaTag(['content' => $product['productsDescription']['products_description'], 'name' => 'description',]);
$prodinfoattr='<div class="size-block">';
if (count($product['productsAttributesDescr']) > 0) {
    $numInFirstColumn=(int)(count($product['productsAttributesDescr'])/2);
    $sizeCounter=0;
    $product['productsAttributesDescr']=\yii\helpers\ArrayHelper::index($product['productsAttributesDescr'],'products_options_values_name');
    $product['productsAttributes']=\yii\helpers\ArrayHelper::index($product['productsAttributes'],'options_values_id');

    ksort($product['productsAttributesDescr'],SORT_NATURAL);
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
            $product['products']['products_quantity_order_units'].'" data-count="'.
            $product['productsAttributes'][$item['products_options_values_id']]['quantity'].
            '" type="text" placeholder="0" /><div id="add-count">+</div></div></div>';
        $sizeCounter++;
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
            <div class="relative" style="height: 400px; width: 100%; float: left; position: relative;margin-bottom: 60px;">
            <?php
            $innerhtml = '';
            foreach ($relprod as $value) {
                $product = $value['products'];
                $attr  = \yii\helpers\ArrayHelper::index($value['productsAttributes'],'options_values_id');
                $description = $value['productsDescription'];
                $attr_desc = \yii\helpers\ArrayHelper::index($value['productsAttributesDescr'], 'products_options_values_name');
                ksort($attr_desc,SORT_NATURAL);
                $attr_html = '<div data-sale="'.$product['products_id'].'" class="cart-lable">В корзину</div>';
// echo '<pre>';
//        print_r($attr);
//         echo '</pre>';



                ?>

                <?
                if (count($attr_desc) > 0) {
                    foreach ($attr_desc as $key=>$attr_desc_value) {
                        if($attr[$attr_desc_value['products_options_values_id']]['quantity'] > 0){
                            $classpos = 'active-options';
                            $add_class = 'add-count';
                            $del_class = 'del-count';
                            $inputpos = '';
                            $some_text = 0;
                        }else{
                            $classpos = 'disable-options';
                            $inputpos = 'readonly';
                            $add_class = 'add-count-dis';
                            $del_class = 'del-count-dis';
                            $some_text = 'Нет';
                        }
                        if($key%2 ==0){
                            $class='border-right:1px solid #CCC';
                        }else{
                            $class='';
                        }
                        $attr_html .= '<div class="'.$classpos.'" style="width: 50%; overflow: hidden; float: left; '.$class.';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'.$attr_desc_value['products_options_values_name'].'</div>';
                        $attr_html .= '<input '.$inputpos.' id="input-count"'.
                            'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'.
                            'data-prod="'. $product['products_id'].'"'.
                            'data-name="'. htmlentities($description['products_name'])  .'"'.
                            'data-model="'. $product['products_model'].'"'.
                            'data-price="'. (integer)$product['products_price'].'"'.
                            'data-image="'. $product['products_image'].'"'.
                            'data-count="'. $attr[$attr_desc_value['products_options_values_id']]['quantity'].'"'.
                            'data-step="'. $product['products_quantity_order_units'].'"'.
                            'data-min="'. $product['products_quantity_order_min'].'"'.
                            'data-attrname="'.htmlentities($attr_desc_value['products_options_values_name']).'"'.
                            'data-attr="'.$attr_desc_value['products_options_values_id'].'"'.
                            'placeholder="'.$some_text.'"'.
                            'type="text">';

                        $attr_html .= '<div id="'.$add_class.'" style="margin: 0px;line-height: 1.6;">'.
                            '+'.
                            '</div>'.
                            '<div id="'.$del_class.'" style="margin: 0px;line-height: 1.6;">'.
                            '-'.
                            '</div>';

                        $attr_html .='</div></div></div>';
                    }
                } else {
                    $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; '.$class.';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>';
                    $attr_html .= '<input '.$inputpos.' id="input-count"'.
                        'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'.
                        'data-prod="'. $product['products_id'].'"'.
                        'data-model="'. $product['products_model'].'"'.
                        'data-price="'. (integer)$product['products_price'].'"'.
                        'data-image="'. $product['products_image'].'"'.
                        'data-count="'. $product['products_quantity'].'"'.
                        'data-attrname="'.htmlentities($attr_desc_value['products_options_values_name']).'"'.
                        'data-attr="'.$attr_desc_value['products_options_values_id'].'"'.
                        'data-name="'.  htmlentities($description['products_name'])  .'"'.
                        'data-step="'. $product['products_quantity_order_units'].'"'.
                        'data-min="'. $product['products_quantity_order_min'].'"'.
                        'placeholder="0"'.
                        'type="text">';
                    $attr_html .= '<div id="add-count" style="margin: 0px;line-height: 1.6;">'.
                        '+'.
                        '</div>'.
                        '<div id="del-count" style="margin: 0px;line-height: 1.6;">'.
                        '-'.
                        '</div>';

                    $attr_html .=  '</div></div></div>';
                }
                $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
                $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
                $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);
                if(count($attr)){
                    $options_name = 'Размеры';
                }else{
                    $options_name = 'Количество';
                }
                if(array_key_exists($product['manufacturers_id'],$man_time)){
                    $man_time_list = '<a data-ajax="time" style="cursor:pointer;" data-href="'.$product['manufacturers_id'].'"><i class="fa fa-clock-o"></i></a>';
                }else{
                    $man_time_list = '';
                }
                $innerhtml .= '<div itemscope itemtype="http://schema.org/ProductModel" itemid="' . $product['products_id'] . '"  class="container-fluid float" id="card" style="float:left;"><a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
                    '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .
                    '</div>' .
                    '<div  itemprop="name" class="name">'  .htmlentities($description['products_name']) . '</div></a>' .
                    '<div style="" class="model">' . $man_time_list . '</div>' .
                    '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
                    '<div  itemprop="description" class="model" style="display:none">' .htmlentities($description['products_description']) . '</div>' .
                    '<div  itemprop="category" class="model" style="display:none">'  .htmlentities(implode(', ', $catpath['name'])) . '</div>' .
                    '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">' .
                    '<div style="font-size: 18px; font-weight: 500;" itemprop="price" >' . (integer)($product['products_price']) . ' руб.</div>' .
                    '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
                    '</div>' .
                    '<div style="cursor:pointer">' .
                    '<div data-vis="size-item-desc" data-vis-id="'.$product['products_id'].'" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; margin: 0px 0px -30px; padding: 30px 26px;" data-prod="' . $product['products_id'] . '">'.$options_name.'<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: 0px; padding: 30px 0px 0px 31px;"></i>'.
                    '<span data-vis="size-item-card" data-vis-id-card="'.$product['products_id'].'">' . $attr_html . '</span>' .
                    '</div>' .
                    '</div>' .
                    '<div  itemprop="" style="font-size: 12px;" id="prod-info" data-prod="' . $product['products_id'] . '"><i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;"></i> Увеличить</div>' .
                    '</div>';
            }
            echo $innerhtml;

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