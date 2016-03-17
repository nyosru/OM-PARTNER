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
<?
$this->title = $title;



    ?>
    <div id="main-index">
        <div id="index-card-5" class="data-j index-card banner-card" data-cat="1720"><a
                href="<?= BASEURL ?>/catalog?cat=1720&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;" src="/images/banners/382_327_1.1.png"></a></div>
        <div id="index-card-6" class="data-j index-card banner-card" data-cat="2008"><a
                href="<?= BASEURL ?>/catalog?cat=2008&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"    src="/images/banners/382_159_1.1.png"></a></div>
        <div id="index-card-3" class="sort data-j index-sort banner-card" data-cat="0"><a
                href="<?= BASEURL ?>/catalog?cat=0&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/773_496.1.png"></a></div>
        <div id="index-card-5" style="float:right" class="data-j index-card banner-card" data-cat="2047"><a
                href="<?= BASEURL ?>/catalog?cat=2047&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/382_327_2.1.png"></a></div>
        <div id="index-card-6" class="data-j index-card banner-card" data-cat="1762"><a
                href="<?= BASEURL ?>/catalog?cat=1762&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;"  src="/images/banners/382_159_2.1.png"></a></div>
        <div id="index-card-6" style="width: calc(100% - 10px);"class="data-j index-card banner-card" data-cat="1836"><a
                href="<?= BASEURL ?>/catalog?cat=1836&count=20&start_price=&end_price=1000000&prod_attr_query=&page=undefined&sort=0&searchword="><img
                    style="width: 100%; height: auto;" src="/images/banners/1570_160_1.png"></a></div>
    </div>


    <div id="main-spec">
        <div id="index-card-4" style='font-family: "Roboto Light",sans serif; border-bottom: 1px solid rgb(204, 204, 204); border-radius: 0px;'>
            <div class="index-icon-plate">
                <div class="index-icon-img">
<img src="/images/logo/low_price.png">
                </div>
                <div class="index-icon-title">
Пожалуй самые низкие цены
                </div>
            </div>
            <div class="index-icon-plate">
                <div class="index-icon-img">
<img src="/images/logo/orders.png">
                </div>
                <div class="index-icon-title">
Нами выполненно более 1,000,000 заказов
                </div>
            </div >
            <div class="index-icon-plate">
                <div class="index-icon-img">
<img src="/images/logo/vipolneno.png">
                </div>
                <div class="index-icon-title">
Более 25,000 товаров для вашего выбора
                </div>
            </div>
            <div class="index-icon-plate">
                <div class="index-icon-img">
<img src="/images/logo/novinki.png">
                </div>
                <div class="index-icon-title">
Новинки каждый день
                </div>
            </div>
            <div class="index-icon-plate">
                <div class="index-icon-img">
<img src="/images/logo/minorder.png">
                </div>
                <div class="index-icon-title">
Минимальный заказ всего от 5000 рублей
                </div>
            </div>
        </div>
    </div>
    <div id="main-spec">
        <div id="index-card-4">Специальные предложения</div>
        <?
        foreach ($dataproducts as $value) {
            $product = $value['products'];
            $attr  = \yii\helpers\ArrayHelper::index($value['productsAttributes'],'options_values_id');
            $description = $value['productsDescription'];
            $attr_desc = \yii\helpers\ArrayHelper::index($value['productsAttributesDescr'], 'products_options_values_name');
            ksort($attr_desc,SORT_NATURAL);
            $attr_html = '<div data-sale="'.$product['products_id'].'" class="cart-lable">В корзину</div>';
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
                $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; ' . $class . ';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>' .
                    '<input  id="input-count"' .
                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"' .
                    'data-prod="' . $product['products_id'] . '"' .
                    'data-model="' . $product['products_model'] . '"' .
                    'data-price="' . (integer)$product['products_price'] . '"' .
                    'data-image="' . $product['products_image'] . '"' .
                    'data-attrname="' . htmlentities($attr_desc_value['products_options_values_name']) . '"' .
                    'data-attr="' . $attr_desc_value['products_options_values_id'] .  '"' .
                    'data-count="'. $product['products_quantity'].'"'.
                    'data-name="' . htmlentities($description['products_name']) . '"' .
                    'data-step="' . $product['products_quantity_order_units'] . '"' .
                    'data-min="' . $product['products_quantity_order_min'] . '"' .
                    'placeholder="0"' .
                    'type="text">' .
                    '<div id="add-count" style="margin: 0px;line-height: 1.6;">' .
                    '+' .
                    '</div>' .
                    '<div id="del-count" style="margin: 0px;line-height: 1.6;">' .
                    '-' .
                    '</div>' .
                    '</div></div></div>';
            }
            $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
            $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
            $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);

            $innerhtml .= '<div itemscope itemtype="http://schema.org/ProductModel" itemid="#' . $product['products_id'] . '"  class="container-fluid float" id="card"><a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
                '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .
                '</div>' .
                '<div  itemprop="name" class="name">' . htmlentities($description['products_name']) . '</div></a>' .
                '<div style="display:none;" class="model">Артикул ' . $product['products_model'] . '</div>' .
                '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
                '<div  itemprop="description" class="model" style="display:none">' . htmlentities($description['products_description']) . '</div>' .
                '<div  itemprop="category" class="model" style="display:none">' . htmlentities(implode(', ', $catpath['name'])) . '</div>' .
                '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">' .
                '<div style="font-size: 18px; font-weight: 500;" itemprop="price" >' . (integer)($product['products_price']) . ' руб.</div>' .
                '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
                '</div>' .
                '<div style="cursor:pointer">' .
                '<div data-vis="size-item-desc" data-vis-id="' . $product['products_id'] . '" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; margin: 0px 0px -30px; padding: 30px 26px;" data-prod="' . $product['products_id'] . '">Размеры<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: 0px; padding: 30px 0px 0px 31px;"></i>' .
                '<span data-vis="size-item-card" data-vis-id-card="' . $product['products_id'] . '">' . $attr_html . '</span>' .
                '</div>' .
                '</div>' .
                '<a href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div  itemprop="" style="font-size: 12px;" id="prod-info" data-prod="' . $product['products_id'] . '"><i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;"></i> Увеличить</div></a>' .
                '</div>';
        }
        echo $innerhtml;
        ?>
    </div>
    <div id="main-new" style="clear: both;">
        <div id="index-card-4">Новые поступления</div>
        <?
        $innerhtml = '';
        foreach ($newproducts as $value) {
            $product = $value['products'];
            $attr  = \yii\helpers\ArrayHelper::index($value['productsAttributes'],'options_values_id');
            $description = $value['productsDescription'];
            $attr_desc = \yii\helpers\ArrayHelper::index($value['productsAttributesDescr'], 'products_options_values_name');
            ksort($attr_desc,SORT_NATURAL);
            $attr_html = '<div data-sale="'.$product['products_id'].'" class="cart-lable">В корзину</div>';
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
                $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; ' . $class . ';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>' .
                    '<input  id="input-count"' .
                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"' .
                    'data-prod="' . $product['products_id'] . '"' .
                    'data-model="' . $product['products_model'] . '"' .
                    'data-price="' . (integer)$product['products_price'] . '"' .
                    'data-image="' . $product['products_image'] . '"' .
                    'data-attrname="' . htmlentities($attr_desc_value['products_options_values_name']) . '"' .
                    'data-attr="' . $attr_desc_value['products_options_values_id'] .
                    'data-count="'. $product['products_quantity'].'"'.
                    'data-name="' . htmlentities($description['products_name']) . '"' .
                    'data-step="' . $product['products_quantity_order_units'] . '"' .
                    'data-min="' . $product['products_quantity_order_min'] . '"' .
                    'placeholder="0"' .
                    'type="text">' .
                    '<div id="add-count" style="margin: 0px;line-height: 1.6;">' .
                    '+' .
                    '</div>' .
                    '<div id="del-count" style="margin: 0px;line-height: 1.6;">' .
                    '-' .
                    '</div>' .
                    '</div></div></div>';
            }
            $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
            $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
            $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);

            $innerhtml .= '<div itemscope itemtype="http://schema.org/ProductModel" itemid="#' . $product['products_id'] . '"  class="container-fluid float" id="card"><a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
                '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .
                '</div>' .
                '<div  itemprop="name" class="name">' . htmlentities($description['products_name']) . '</div></a>' .
                '<div style="display:none;" class="model">Артикул ' . $product['products_model'] . '</div>' .
                '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
                '<div  itemprop="description" class="model" style="display:none">' . htmlentities($description['products_description']) . '</div>' .
                '<div  itemprop="category" class="model" style="display:none">' . htmlentities(implode(', ', $catpath['name'])) . '</div>' .
                '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">' .
                '<div style="font-size: 18px; font-weight: 500;" itemprop="price" >' . (integer)($product['products_price']) . ' руб.</div>' .
                '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
                '</div>' .
                '<div style="cursor:pointer">' .
                '<div data-vis="size-item-desc" data-vis-id="' . $product['products_id'] . '" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; margin: 0px 0px -30px; padding: 30px 26px;" data-prod="' . $product['products_id'] . '">Размеры<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: 0px; padding: 30px 0px 0px 31px;"></i>' .
                '<span data-vis="size-item-card" data-vis-id-card="' . $product['products_id'] . '">' . $attr_html . '</span>' .
                '</div>' .
                '</div>' .
                '<a href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div  itemprop="" style="font-size: 12px;" id="prod-info" data-prod="' . $product['products_id'] . '"><i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;"></i> Увеличить</div></a>' .
                '</div>';
        }
        echo $innerhtml;
        ?>
    </div>
    <div id="main-new" style="clear: both;">
        <div style="float: left;width: 33.333%;">
            <div id="" style="font-size: 20px; font-weight: 400; float: left; margin: 5px;">Новости</div>
            <a id="" href="<?= BASEURL . '/news' ?>"
               style="display: block; font-size: 14px; font-weight: 400; float: right; color: rgb(0, 165, 161); margin: 0px 20px; padding: 10px;">Все
                Новости</a>

            <div style="margin: 0px 5px; float: left; width: 100%;">
                <?= \frontend\widgets\NewsBlockOM::widget() ?>
            </div>
        </div>
        <div style="float: left;width: 33.333%;">
            <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">
                <a href="http://vk.com/odezdamast_shop" style="display:block; cursor:pointer;" class="circular-vk"><i class="fa fa-vk"></i>

                </a>
                <a href="http://vk.com/odezdamast_shop" class="circular-title">
                    Одежда-Мастер<br/>в Вконтакте
                </a>
                <a href="http://vk.com/odezdamast_shop" class="circular-link">
                    следить за новостями >>
                </a>
            </div>
        </div>
        <div style="float: left;width: 33.333%;">
            <div style="height: 200px; text-align: center; padding: 60px 0px; margin: 5px;">
                <a href="http://ok.ru/group52616511881357?st._aid=ExternalGroupWidget_OpenGroup" style="display:block; cursor:pointer;" class="circular-ok"><i class="fa fa-odnoklassniki "></i>

                </a>
                <a href="http://ok.ru/group52616511881357?st._aid=ExternalGroupWidget_OpenGroup" class="circular-title">
                    Одежда-Мастер<br/>в Одноклассниках
                </a>
                <a href="http://ok.ru/group52616511881357?st._aid=ExternalGroupWidget_OpenGroup" class="circular-link">
                    следить за новостями >>
                </a>
            </div>
        </div>
    </div>
    <div style="clear: both;">
<!--        <div id="index-card-4">Сео индекс инлайн</div>-->
<!--        <div style="margin: 0px 15px;">-->
<!--            --><?//
//            if (Yii::$app->user->can('admin')) {
//                \dosamigos\ckeditor\CKEditorInline::begin(['preset' => 'standart']);
//            }
//            $data = new \common\models\PartnersConfig();
//            $check = Yii::$app->params['constantapp']['APP_ID'];
//            $page = 'seoindex';
//            $data = $data->find()->where(['partners_id' => $check, 'type' => $page])->one();
//            if ($data) {
//                echo stripcslashes($data->value);
//            } else {
//                ?>
<!---->
<!---->
<!--                НАЖМИТЕ ТУТ ЧТО БЫ ИЗМЕНИТЬ ОПИСАНИЕ-->
<!--            --><?// } ?>
<!--            --><?php //if (Yii::$app->user->can('admin')) {
//                \dosamigos\ckeditor\CKEditorInline::end(); ?>
<!--                <button class="savehtml">Сохранить</button>-->
<!--                <script>-->
<!--                    $(document).on('click', '.savehtml', function () {-->
<!--                        $html = $('.cke_editable').html();-->
<!---->
<!---->
<!--                        $.post(-->
<!--                            '/site/savehtml',-->
<!--                            {-->
<!--                                html: $html,-->
<!--                                page: 'seoindex'-->
<!--                            }-->
<!--                        );-->
<!--                        alert('Изменения сохранены');-->
<!---->
<!--                    });-->
<!---->
<!--                </script>-->
<!--            --><?// } ?>
<!--        </div>-->
    </div>
<? //  $this->endCache(); }?>