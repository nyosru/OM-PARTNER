<?php
namespace frontend\widgets;

use common\models\PartnersProductsToCategories;
use common\traits\Categories_for_partner;
use common\traits\CatPath;
use common\traits\RecursCat;
use Yii;

class ProductCard extends \yii\bootstrap\Widget
{
    use CatPath,Categories_for_partner,RecursCat;
    public $description;
    public $category=0;
    public $product;
    public $attrib;
    public $attr_descr;
    public $catpath = [];
    public $man_time = [];
    public $showdiscount=0;



    public function init()
    {
        if($this->category==0){
            $categ=PartnersProductsToCategories::find()->where(['products_id'=>$this->product['products_id']])->one();
            $categ=$categ->categories_id;
            $categ=array_pop($this->Catpath($categ, 'name'));
        }
        else {
            $categ = array_pop($this->Catpath($this->category, 'name'));
        }
        $innerhtml = '';
        $product=$this->product;
        $description=$this->description;
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
        $offersstyle='';
        if($this->showdiscount==1){
            $offersstyle='style="right:10px;bottom:105px; position:absolute"';
        }
        ksort($attr_desc,SORT_NATURAL);
        $attr_html = '';
        $activelabel = 0;
        if (count($attr_desc) > 0) {
            $key = 0;
            $class = '';
            foreach ($attr_desc as $key=>$attr_desc_value) {
                if($attr[$attr_desc_value['products_options_values_id']]['quantity'] > 0){
                    $classpos = 'active-options';
                    $add_class = 'add-count';
                    $stylepos = '';
                    $activelabel++;
                    $del_class = 'del-count';
                    $inputpos = '';
                    $some_text = 0;
                    if($key%2 == 0){
                        $class='border-right:1px solid #CCC';
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

                $attr_html .= '<div class="'.$classpos.'" style="'.$stylepos.' width: 50%; overflow: hidden; float: left; '.$class.';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>'.$attr_desc_value['products_options_values_name'].'</div>';
                $attr_html .= '<input '.$inputpos.' id="input-count"'.
                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"'.
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
            $activelabel++;
            $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>';
            $attr_html .= '<input  id="input-count"'.
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
        $attr_html = $cart_html.$attr_html;
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
        if(in_array($product['manufacturers_id'], [749,2700,1241,2058,3412,3473,3481,3512])){
          $man_in_sklad = '<div style="position: absolute; top: 0px; right: 50px;"><img src="'.BASEURL.'/images/logo/ok.png"></div>';
        }else{
            $man_in_sklad = '';
        }
        $preview = '<a style="display: block;cursor:zoom-in;float: left;padding-right: 10px;"  rel="light" data-gallery="1" href="http://odezhda-master.ru/images/'.$product['products_image'].'"><i class="fa fa-search-plus" aria-hidden="true"></i></a>';
        $chosen = '<a style="display: block;cursor:pointer;float: left;padding-right: 10px;" class="selected-product" data-product="'.$product['products_id'].'" ><i class="fa fa-star" aria-hidden="true"></i></a>';
        $product_menu = '<a class="product-menu" style="display: block;cursor:pointer;float: left;padding-right: 10px;"><i class="mdi" style="border-radius: 40px; border: 2px solid rgb(0, 165, 161); padding: 0px; margin: 0px; font-size: 16px;" aria-hidden="true">more_horiz</i></a><div class="product-menu-rel active" style="display:none">Категория: '.$categ.'</div>';

        $innerhtml .= '
                        <div itemscope itemtype="http://schema.org/ProductModel" itemid="' . $product['products_id'] . '"  class="container-fluid float" id="card" style="float:left;">'.$man_in_sklad.'
                            <div id="prod-info" data-prod="' . $product['products_id'] . '" >
                                <div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
                                    '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .'</div>';
        if ((integer)($product['products_old_price']) > 0&&$this->showdiscount==1&&isset($discount)) {
            $innerhtml .= '<div style="position: absolute; top: 5px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 194px; padding: 7px; line-height: 45px; left: 5px; color: aliceblue; font-weight: 600; font-size: 15px;">-' . $discount . ' %</div>';
            $innerhtml .= '<div style="font-size: 18px; color:red; font-weight: 500;" itemprop="old-price" ><strike>' . (integer)($product['products_old_price']) . ' руб.</strike></div>';
        }
                                $innerhtml.='<div  itemprop="name" class="name">'  .htmlentities($description['products_name']) .
                                '</div>
                            </div>' .
            '<div style="" class="model">' . $man_time_list . $preview. $chosen.$product_menu . '</div>' .
            '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
            '<div  itemprop="description" class="model" style="display:none">' .htmlentities($description['products_description']) . '</div>' .
            '<div  itemprop="category" class="model" style="display:none">'  .htmlentities(implode(', ', $this->catpath['name'])) . '</div>' .
            '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" '.$offersstyle.' class="price">' .
            '<div style="font-size: 18px; font-weight: 500;" itemprop="price" >' . round($product['products_price']) . ' руб.</div>' .
            '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
            '</div>' .
            '<div style="cursor:pointer">' .
            '<div data-vis="size-item-desc" data-vis-id="'.$product['products_id'].'" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 35px; right: 30px; margin: 0px 0px -8px; padding: 5px 45px;" data-prod="' . $product['products_id'] . '">'.$options_name.'<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: -20px; padding: 5px 0px 0px 40px;"></i>'.
            '<span data-vis="size-item-card" data-vis-id-card="'.$product['products_id'].'">' . $attr_html . '</span>' .
            '</div>' .
            '</div>' .
            '<a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '" style="float: right; position: absolute; bottom: 9px; right: 12px; font-size: 12px; font-weight: 500;" ><i class="mdi mdi-visibility" style="font-weight: 500; color: rgb(0, 165, 161); font-size: 15px; position: relative; top: 4px;"></i> В карточку</a>' .
            '</div>';
        echo $innerhtml;
    }
}