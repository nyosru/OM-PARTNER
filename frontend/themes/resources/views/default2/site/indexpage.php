<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use yii\caching\Cache;
use yii\filters\AccessControl;
use yii\web\User;
//if ($this->beginCache('partner-index'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] , array('duration'=>600))) {?>
    <div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $this -> title = Yii::$app->params['constantapp']['APP_NAME'];
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
               echo $view;
                ?>
            </div>

            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
            <? if (isset(Yii::$app->params['partnersset']['newsonindex']['value']) && Yii::$app->params['partnersset']['newsonindex']['active'] == 1) { ?>
                <div id="partners-main-left-cont">
                    <div class="header-catalog"><i class="fa fa-bars"></i> НОВОСТИ
                    </div>
                    <?
                    $newsprovider = new \yii\data\ActiveDataProvider([
                        'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID']])->orderBy('date_modified'),
                        'pagination' => [
                            'defaultPageSize' => intval(Yii::$app->params['partnersset']['newsonindex']['value']),
                        ],
                    ]);
                    $newsprovider = $newsprovider->getModels();
                    if (!$newsprovider) {
                        echo 'Новости отсутствуют';
                    } else {
                        foreach ($newsprovider as $valuenews) {
                            echo '<div>';
                            echo '<span style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; padding: 4px 14px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span><br/>';
                            echo '<span style="padding: 10px 25px; margin: 0px; display: block; background: rgb(255, 191, 8) none repeat scroll 0% 0%;">' . $valuenews->name . '</span>';
                            $search = array("'<script[^>]*?>.*?</script>'si",
                                "'<[\/\!]*?[^<>]*?>'si",
                                "'([\r\n])[\s]+'",
                                "'&(quot|#34);'i",
                                "'&(amp|#38);'i",
                                "'&(lt|#60);'i",
                                "'&(gt|#62);'i",
                                "'&(nbsp|#160);'i",
                                "'&(iexcl|#161);'i",
                                "'&(cent|#162);'i",
                                "'&(pound|#163);'i",
                                "'&(copy|#169);'i",
                                "'&#(\d+);'e");

                            $replace = array("",
                                "",
                                "\\1",
                                "\"",
                                "&",
                                "<",
                                ">",
                                " ",
                                chr(161),
                                chr(162),
                                chr(163),
                                chr(169),
                                "chr(\\1)");

                            $text = preg_replace($search, $replace, $valuenews->post);
                            echo '<span style="padding: 0px 10px; display: block; margin: 10px;">' . mb_substr($text, 0, 180, 'UTF-8') . '...</span> <br/>';

                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <? } ?>
        </div>
    </div>

    <div class="container-fluid" id="partners-main-right-back">
        <span class="navbredcrump"></span>
        <div id="partners-main-right" class="bside">

        <div id="main-index">
                <div id="index-card-5" class="data-j index-card banner-card" data-cat="1720"><img src="/images/banners/7.png"><a href="/site/catalog?_escaped_fragment_=cat=1720&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-6" class="data-j index-card banner-card" data-cat="2008"><img src="/images/banners/1.png"><a href="/site/catalog?_escaped_fragment_cat=2008&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-6" class="data-j index-card banner-card" data-cat="2047"><img src="/images/banners/2.png"><a href="/site/catalog?_escaped_fragment_cat=2047&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-6" class="data-j index-card banner-card" data-cat="1762"><img src="/images/banners/5.png"><a href="/site/catalog?_escaped_fragment_cat=1762&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-3" class="sort data-j index-sort banner-card" data-cat="0"><img src="/images/banners/6.png"><a href="/site/catalog?_escaped_fragment_cat=0&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-6" class="data-j index-card banner-card" data-cat="1836"><img src="/images/banners/3.png"><a href="/site/catalog?_escaped_fragment_cat=1836&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
                <div id="index-card-6" class="data-j index-card banner-card" data-cat="2066"><img src="/images/banners/4.png"><a href="/site/catalog?_escaped_fragment_cat=2066&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="></a></div>
            </div>
            <div id="main-spec">
                <div id="index-card-4">Специальные предложения</div>
                <?
                foreach($dataproducts as $value){
                    $outer = '';
                    $product = $value['products'];
                    $description = $value['productsDescription'];
                    $attr_desc = $value['productsAttributesDescr'];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr['products_options_values_name'].'</div></div><input id="input-count" data-prod="'.$product['products_id'].'" data-model="'.$product['products_model'].'" data-price="'.$product['products_price'].'" data-image="'.$product['products_image'].'" data-attrname="'.$value_attr['products_options_values_name'].'" data-attr="'.$value_attr['products_options_values_id'].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product['products_id'].'" data-model="'.$product['products_model'].'" data-price="'.$product['products_price'].'" data-image="'.$product['products_image'].'" data-attrname="'.$value_attr['products_options_values_name'].'" data-attr="'.$value_attr['products_options_values_id'].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }
                    $product['products_image'] = str_replace(')',']]]]', $product['products_image']);
                    $product['products_image'] = str_replace(' ','[[[[]]]]', $product['products_image']);
                    $product['products_image'] = str_replace('(','[[[[', $product['products_image']);
                    $outer .= '<div  class="container-fluid float" id="index-card-1" product=""><div data-prod="'.$product['products_id'].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product['products_image'].');"></div><div class="name">'.$description['products_name'].'</div><div class="model">Арт.'.$product['products_model'].'</div><div class="price"><b>'.intval($product['products_price']).'</b> руб.</div><div id="prod-info" data-prod="'.$product['products_id'].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }
                ?>
            </div>
            <div id="main-new">
                <div id="index-card-4">Новые поступления</div>
                <?
                foreach($newproducts as $value){
                    $outer = '';
                    $product = $value['products'];
                    $description = $value['productsDescription'];
                    $attr_desc = $value['productsAttributesDescr'];
                    $attr_html = '<div class="cart-lable">В корзину</div>';
                    if(count($attr_desc) > 0){
                        foreach($attr_desc as $value_attr){
                            $attr_html .= '<div class="size-desc"><div><div class="lable-item">'.$value_attr['products_options_values_name'].'</div></div><input id="input-count" data-prod="'.$product['products_id'].'" data-model="'.$product['products_model'].'" data-price="'.$product['products_price'].'" data-image="'.$product['products_image'].'" data-attrname="'.$value_attr['products_options_values_name'].'" data-attr="'.$value_attr['products_options_values_id'].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                        }
                    }else{
                        $attr_html .= '<div class="size-desc"><div class="lable-item">+</div><input id="input-count" data-prod="'.$product['products_id'].'" data-model="'.$product['products_model'].'" data-price="'.$product['products_price'].'" data-image="'.$product['products_image'].'" data-attrname="'.$value_attr['products_options_values_name'].'" data-attr="'.$value_attr['products_options_values_id'].'" type="text" placeholder="0" /><div id="add-count">+</div><div id="del-count">-</div></div>';
                    }
                    $product['products_image'] = str_replace(')',']]]]', $product['products_image']);
                    $product['products_image'] = str_replace(' ','[[[[]]]]', $product['products_image']);
                    $product['products_image'] = str_replace('(','[[[[', $product['products_image']);
                    $outer .= '<div  class="container-fluid float" id="index-card-1"><div data-prod="'.$product['products_id'].'" id="prod-data-img"  style="clear: both; min-height: 180px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(/site/imagepreview?src='.$product['products_image'].');"></div><div class="name">'.$description['products_name'].'</div><div class="model">Арт.'.$product['products_model'].'</div><div class="price"><b>'.intval($product['products_price']).'</b> руб.</div><div id="prod-info" data-prod="'.$product['products_id'].'">Инфо</div><span>'.$attr_html.'</span></div>';
                    echo $outer;
                }
                ?>
            </div>
        </div>
    </div>

    <? //  $this->endCache(); }?>