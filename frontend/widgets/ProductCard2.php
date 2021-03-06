<?php
namespace frontend\widgets;

use common\models\PartnersProductsToCategories;
use common\traits\GetSuppliers;
use common\traits\Categories_for_partner;
use common\traits\Manufacturers\LuxSuppliers;
use common\traits\RecursCat;
use yii;
use common\traits\CatPath;

class ProductCard2 extends \yii\bootstrap\Widget
{
    use CatPath,Categories_for_partner,RecursCat, GetSuppliers, LuxSuppliers;
    public $category=0;
    public $description;
    public $product;
    public $attrib;
    public $attr_descr;
    public $catpath = [];
    public $man_time = [];
    public $showdiscount=0;
    public $writeitemprop = 1;
    public $season = '';
    public $brand = '';
    public $subpreview = '';
    public function init()
    {
        if($this->writeitemprop === 1){
            $product_itemscope = ' itemscope itemtype="http://schema.org/ProductModel" ' ;
            $product_itemprop_model = ' itemprop="model" ';
            $product_itemprop_image = 'itemprop="image"';
            $product_itemprop_old_price = 'itemprop="old-price"';
            $product_itemprop_name = 'itemprop="name"';
            $product_itemprop_description = 'itemprop="description" ';
            $product_itemprop_offers = 'itemprop="offers" itemscope itemtype="http://schema.org/Offer"';
            $product_itemprop_category = 'itemprop="category"';
            $product_itemprop_priceCurrency = 'itemprop="priceCurrency" ';
            $product_itemprop_price = 'itemprop="price" ';
            $product_itemprop_url = 'itemprop="url"';
        }else{
            $product_itemscope = '';
            $product_itemprop_model = '';
            $product_itemprop_image = 'name="image"';
            $product_itemprop_old_price = '';
            $product_itemprop_name = '';
            $product_itemprop_description = '';
            $product_itemprop_offers = '';
            $product_itemprop_category = '';
            $product_itemprop_priceCurrency = '';
            $product_itemprop_price = '';
            $product_itemprop_url = '';
        }
        if($this->category==0){
            $categ=PartnersProductsToCategories::find()->where(['products_id'=>$this->product['products_id']])->one();
            $categ=$categ->categories_id;
            $catpath = $this->Catpath($categ, 'name');
            $categ=end($catpath);
        }
        else {
            $name = 'name';
            $catpath = $this->Catpath($this->category, $name);
            $categ = end($catpath);
        }
        $product=$this->product;
        $description=$this->description;
        $innerhtml = '<div class="inht" '.$product_itemscope.' itemid="' . $product['products_id'] . '" >';

        if($this->attrib){
            $attr  = \yii\helpers\ArrayHelper::index($this->attrib,'options_values_id');
        }else{
            $attr = [];
        }

        if($this->attr_descr){
            $attr_desc = \yii\helpers\ArrayHelper::index($this->attr_descr, 'products_options_values_name');
        }else{
            $attr_desc = [];
        }
        if($product['products_old_price']>$product['products_price']){
            $discount=100-round($product['products_price']*100/$product['products_old_price']);
        }
        ksort($attr_desc,SORT_NATURAL);
        $attr_html = '';
        $activelabel = 0;
        if (count($attr_desc) > 0) {
            $key = 0;
            foreach ($attr_desc as $key=>$attr_desc_value) {
                if($product['products_quantity_order_units'] === '1'  || $product['products_quantity_order_min'] === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'disabled';
                }
                if($attr[$attr_desc_value['products_options_values_id']]['quantity'] > 0 && $attr[$attr_desc_value['products_options_values_id']]['options_values_price'] == 0){
                    $classpos = 'active-options';
                    $add_class = 'add-count';
                    $stylepos = '';
                    $activelabel++;
                    $del_class = 'del-count';
                    $inputpos = '';
                    $some_text = 0;
                    if($key%2 == 0){
                        $class='border-right:1px solid #CCC;';
                        $key++;
                    }else{
                        $class='';
                        $key++;
                    }
                }else{
                    $classpos = 'disable-options';
                    $inputpos = 'readonly';
                    $stylepos = 'display:none; ';
                    $add_class = 'add-count-dis';
                    $del_class = 'del-count-dis';
                    $some_text = 'Нет';
                }

                $attr_html .= '<div class="'.$classpos.'" style="'.$stylepos.' width: 50%; overflow: hidden; float: left; '.$class.'"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'.$attr_desc_value['products_options_values_name'].'</div>';
                $attr_html .= '<input   '. $disable_for_stepping. '   '.$inputpos.' id="input-count"'.
                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;" '.
                    'data-prod="'. $product['products_id'].'"'.
                    'data-name="'. htmlentities($description['products_name'])  .'"'.
                    'data-model="'. $product['products_model'].'"'.
                    'data-price="'. round($product['products_price']).'"'.
                    'data-image="'. $product['products_image'].'"'.
                    'data-count="'. $attr[$attr_desc_value['products_options_values_id']]['quantity'].'"'.
                    'data-step="'. $product['products_quantity_order_units'].'"'.
                    'data-min="'. $product['products_quantity_order_min'].'"'.
                    'data-attrname="'.htmlentities($attr_desc_value['products_options_values_name']).'"'.
                    'data-attr="'.$attr_desc_value['products_options_values_id'].'"'.
                    'placeholder="'.$some_text.'"'.
                    'type="text">';

                $attr_html .= '<div id="'.$add_class.'" style="margin: 0px;line-height: 1.6;font-size: 14px;font-weight: 500;">'.
                    '+'.
                    '</div>'.
                    '<div id="'.$del_class.'" style="margin: 0px;line-height: 1.6;font-size: 14px;font-weight: 500;">'.
                    '-'.
                    '</div>';

                $attr_html .='</div></div></div>';
            }
        } else {
            if($product['products_quantity_order_units'] === '1'  || $product['products_quantity_order_min'] === '1'){
                $disable_for_stepping = '';
            }else{
                $disable_for_stepping = 'readonly';
            }
            $activelabel++;
            $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%; margin-top:20px;"><div style="margin: auto; width: 100%;"><div></div>';
            $attr_html .= '<input    '. $disable_for_stepping. '   id="input-count"'.
                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'.
                'data-prod="'. $product['products_id'].'"'.
                'data-model="'. $product['products_model'].'"'.
                'data-price="'. round($product['products_price']).'"'.
                'data-image="'. $product['products_image'].'"'.
                'data-count="'. $product['products_quantity'].'"'.
                'data-attrname=""'.
                'data-attr=""'.
                'data-name="'.htmlentities($description['products_name']).'"'.
                'data-step="'. $product['products_quantity_order_units'].'"'.
                'data-min="'. $product['products_quantity_order_min'].'"'.
                'placeholder="0"'.
                'type="text">';
            $attr_html .= '<div id="add-count" style="margin: 0px;line-height: 1.6;font-size: 14px;font-weight: 500;">'.
                '+'.
                '</div>'.
                '<div id="del-count" style="margin: 0px;line-height: 1.6;font-size: 14px;font-weight: 500;">'.
                '-'.
                '</div>';

            $attr_html .=  '</div></div></div>';
        }
        if($activelabel > 0) {
            $cart_html = '<div data-sale="' . $product['products_id'] . '" class="cart-lable">В корзину</div>';
        }else{
            $cart_html = '<div class="cart-lable" style="background: #E9516D">Продано</div>';
        }
        $attr_html .= $cart_html.'<div style="font-size:13px; text-align:right;margin-top:5px;">Добавлено: '.$product['products_date_added'].'</div>';
        $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
        $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
        $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);
        if(count($attr)){
            $options_name = 'Размеры';
        }else{
            $options_name = 'Количество';
        }
        if(array_key_exists($product['manufacturers_id'],$this->man_time)){
            $man_time_list = '<a data-ajax="time" style="cursor:pointer;" data-href="'.$product['manufacturers_id'].'"><i class="fa fa-clock-o"></i></a>';
        }else{
            $man_time_list = '';
        }
        if(in_array($product['manufacturers_id'], $this->oksuppliers())){
            $man_in_sklad = '<div style="position: absolute; top: -5px; right: 50px;"><a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)." ><img src="'.BASEURL.'/images/logo/ok.png"></a></div>';
        }else{
            $man_in_sklad = '';
        }
        if(in_array($product['manufacturers_id'], $this->LuxSuppliers())){
            $man_lux = '<div style="position: absolute; top: -5px; right: 85px;"><a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)." >
            <a style="display: block" href="/page?article=product-card" target="_blank" data-toggle="tooltip" data-placement="top" title="Нажмите на значок, чтобы узнать его значение (откроется в новой вкладке)."><img style="position: relative;" src="/images/logo/ok.png"><img style="position: absolute; left: 2px; height: 24px; padding: 0px; top: 0px; margin: 14px auto; right: 24px; border-radius: 45px; border: 2px solid rgb(204, 204, 204);" src="/images/logo/lux.png"></a>
            </a></div>';
        }else{
            $man_lux = '';
        }
        $preview = '<a style="display: block;cursor:zoom-in;float: left;padding-right: 10px;"  rel="light" data-gallery="1" href="http://odezhda-master.ru/images/'.$product['products_image'].'"><i class="fa fa-search-plus" style="position:absolute; bottom:30px; left:25px;" aria-hidden="true"></i></a>';
        $chosen = '<i class="fa fa-star selected-product" style="position:absolute;cursor:pointer; bottom:30px; left:25px; font-size:20px;bottom:30px; left:50px;" data-product="'.$product['products_id'].'" aria-hidden="true"></i>';
        if(isset($product['season_code'])){
            $this->season = $product['season_code'];
        }
        if($this->season){
            $season_html = SeasonPicture::widget([
                'season'=>$this->season
            ]);
        }else{
            $season_html = '';
        }
        if($this->subpreview){
            $subImage = '<div class="fa fa-picture-o fa-lg" style="color: #19a09d;position: absolute;top: 5px;right: 10px;line-height: 1;background: whitesmoke;padding: 5px;border-radius: 40px;"></div>';
        }else{
            $subImage = '';
        }
        $innerhtml .= '
                        <div  class="container-fluid float" id="card2" style="float:left;">'.$man_in_sklad.$man_lux.$season_html.'
                            <div id="prod-info" data-prod="' . $product['products_id'] . '" >
                                <div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; margin-bottom:5px; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
            '<meta '.$product_itemprop_image.' content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .$subImage.
            '</div>' ;
        if ((integer)($product['products_old_price']) > 0 && $this->showdiscount==1  && isset($discount)) {
            $innerhtml .= '<div style="font-size: 18px; margin: 5px; color:#9e9e9e; font-weight: 300; margin-left: 130px;" '.$product_itemprop_old_price.' ><strike>' . (integer)($product['products_old_price']) . ' руб.</strike></div>';
            $innerhtml .= '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; padding: 7px; line-height: 10px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px; border-radius: 4px;">-' . ($discount) . ' %</div>';
        }

        $innerhtml.=        '</div>' .
            '<div style="" class="model">' . $man_time_list . $preview.$chosen. '</div>' .
            '<div  '.$product_itemprop_model.'class="model" style="display:none">' . $product['products_model'] . '</div>' .
            '<div  '.$product_itemprop_description.' class="model" style="display:none">' .htmlentities($description['products_description']) . '</div>' .
            '<div  '.$product_itemprop_category.' class="model" style="display:none">'  .htmlentities(implode(', ', $this->catpath['name'])) . '</div>' .
            '<div style="cursor:pointer">' .
            '<div data-vis="size-item-desc" data-vis-id="'.$product['products_id'].'" style="text-align: right; font-size: 12px; font-weight: 400; display: none; width: 50%; position: absolute; bottom: 35px; right: 30px; margin: 0px 0px -8px; padding: 5px 45px;" data-prod="' . $product['products_id'] . '">'.$options_name.'<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: -20px; padding: 5px 0px 0px 40px;"></i>'.
            '' .
            '</div>' .
            '</div>';
        $href = '';
        if(
            Yii::$app->params['seourls'] == TRUE &&
            (
            (
                (isset($product['product_seo']) && $seourl = $product['product_seo'] ) ||
                ($seourl = $this->generateFileChpu(
                    $description['products_name'],
                    $product['products_id'],
                    '',
                    '')
                ) == TRUE
            )
            )){
            $href = BASEURL .'/product/'.$seourl;
        }else{
            $href =  BASEURL . '/product?id=' . $product['products_id'];
        }
        $innerhtml.=     '<a '.$product_itemprop_url.' href="' . $href. '" style="float: right; position: absolute; bottom: 9px; left: 25px; font-size: 12px; font-weight: 500;" ><i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;"></i> В карточку</a>' .

            '<div  '.$product_itemprop_offers.' class="price" style="margin-left:130px;">' .
            '<div style="font-size: 18px; font-weight: 500; min-width:100px;" '.$product_itemprop_price.'>' . round($product['products_price']) . ' руб.</div>' .
            '<b '.$product_itemprop_priceCurrency.' style="display:none">RUB</b>' .
            '</div>'.
            '</div><div id="card2size"><span data-vis="size-item-card" data-vis-id-card="'.$product['products_id'].'"><div '.$product_itemprop_name.' class="name" >'  .htmlentities($description['products_name']).'</div><div class="model">'.$product['products_model'].'</div>' . $attr_html . '</span></div></div>';
        echo $innerhtml;
    }
}