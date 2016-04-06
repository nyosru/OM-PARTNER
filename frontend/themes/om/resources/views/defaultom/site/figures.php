<?php
//    echo '<pre>';
//    print_r($value['products']);
//    echo '</pre>';
//    die();


echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';
$i=0;   //счетчик для дней
foreach ($figuresprovider as $value) {
    echo '<div class="days_raw days_raw'.$i++.'">';
    echo '<div class="days-group-descr" style="padding:5px;">'.$value['description'].'</div>
          <div class="days-group-image" style="height:700px;float:left;margin-right:30px;"><img style="max-width:100%;max-height:100%;" src="'.$value['image'].'"/></div>';
    foreach ($value['products'] as $k=>$v) {
        $product=$value['info'][$k];
        $desc=$value['productsDescription'][$k];
        $attr = \yii\helpers\ArrayHelper::index($value['productsAttributes'][$k], 'options_values_id');
        $innerhtml = '';
        $attr_html = '<div data-sale="' . $product['products_id'] . '" class="cart-lable">В корзину</div>';
        $active_border = 0;
        if ($attr) {
            $attr_desc = \yii\helpers\ArrayHelper::index($value['productsAttributesDescr'][$k], 'products_options_values_name');
            ksort($attr_desc, SORT_NATURAL);
            foreach ($attr_desc as $key1 => $attr_desc_value) {
                if ($attr[$attr_desc_value['products_options_values_id']]['quantity'] > 0) {
                    $classpos = 'active-options';
                    $add_class = 'add-count';
                    $stylepos = '';
                    $del_class = 'del-count';
                    $inputpos = '';
                    $some_text = 0;
                    if ($active_border % 2 == 0 && $stylepos == '') {
                        $class = 'border-right:1px solid #CCC';
                        $active_border++;
                    } else {
                        $class = '';
                        $active_border++;
                    }
                } else {
                    $classpos = 'disable-options';
                    $stylepos = 'display:none;';
                    $inputpos = 'readonly';
                    $add_class = 'add-count-dis';
                    $del_class = 'del-count-dis';
                    $some_text = 'Нет';
                }


                $attr_html .= '<div class="' . $classpos . '" style="' . $stylepos . ' width: 50%; overflow: hidden; float: left; ' . $class . ';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div>' . $attr_desc_value['products_options_values_name'] . '</div>';
                $attr_html .= '<input ' . $inputpos . ' id="input-count"' .
                    'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"' .
                    'data-prod="' . $product['products_id'] . '"' .
                    'data-name="' . htmlentities($description['products_name']) . '"' .
                    'data-model="' . $product['products_model'] . '"' .
                    'data-price="' . (integer)$product['products_price'] . '"' .
                    'data-image="' . $product['products_image'] . '"' .
                    'data-count="' . $attr[$attr_desc_value['products_options_values_id']]['quantity'] . '"' .
                    'data-step="' . $product['products_quantity_order_units'] . '"' .
                    'data-min="' . $product['products_quantity_order_min'] . '"' .
                    'data-attrname="' . htmlentities($attr_desc_value['products_options_values_name']) . '"' .
                    'data-attr="' . $attr_desc_value['products_options_values_id'] . '"' .
                    'placeholder="' . $some_text . '"' .
                    'type="text">';

                $attr_html .= '<div id="' . $add_class . '" style="margin: 0px;line-height: 1.6;">' .
                    '+' .
                    '</div>' .
                    '<div id="' . $del_class . '" style="margin: 0px;line-height: 1.6;">' .
                    '-' .
                    '</div>';

                $attr_html .= '</div></div></div>';
            }
        } else {
            $attr_html .= '<div class="" style="width: 50%; overflow: hidden; float: left; ' . $class . ';"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div></div>';
            $attr_html .= '<input ' . $inputpos . ' id="input-count"' .
                'style="    width: 40%;height: 22px;    text-align: center;    position: relative;top: 0px;    border-radius: 4px;   border: 1px solid #CCC;"' .
                'data-prod="' . $product['products_id'] . '"' .
                'data-model="' . $product['products_model'] . '"' .
                'data-price="' . (integer)$product['products_price'] . '"' .
                'data-image="' . $product['products_image'] . '"' .
                'data-count="' . $product['products_quantity'] . '"' .
                'data-attrname=""' .
                'data-attr=""' .
                'data-name="' . htmlentities($description['products_name']) . '"' .
                'data-step="' . $product['products_quantity_order_units'] . '"' .
                'data-min="' . $product['products_quantity_order_min'] . '"' .
                'placeholder="0"' .
                'type="text">';
            $attr_html .= '<div id="add-count" style="margin: 0px;line-height: 1.6;">' .
                '+' .
                '</div>' .
                '<div id="del-count" style="margin: 0px;line-height: 1.6;">' .
                '-' .
                '</div>';

            $attr_html .= '</div></div></div>';
        }
        $product['products_image'] = str_replace(')', ']]]]', $product['products_image']);
        $product['products_image'] = str_replace(' ', '[[[[]]]]', $product['products_image']);
        $product['products_image'] = str_replace('(', '[[[[', $product['products_image']);
        if (count($attr)) {
            $options_name = 'Размеры';
        } else {
            $options_name = 'Количество';
        }
        if (array_key_exists($product['manufacturers_id'], $man_time)) {
            $man_time_list = '<a data-ajax="time" style="cursor:pointer;" data-href="' . $product['manufacturers_id'] . '"><i class="fa fa-clock-o"></i></a>';
        } else {
            $man_time_list = '';
        }
        $innerhtml .= '<div style="min-height:340px;" itemscope itemtype="http://schema.org/ProductModel" itemid="' . $product['products_id'] . '"  class="container-fluid float" id="card"><a itemprop="url" href="' . BASEURL . '/product?id=' . $product['products_id'] . '"><div data-prod="' . $product['products_id'] . '" id="prod-data-img"  style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $product['products_id'] . ');">' .
            '<meta itemprop="image" content="http://' . $_SERVER['HTTP_HOST'] . BASEURL . '/imagepreview?src=' . $product['products_id'] . '">' .
            '</div>' .
            '<div  itemprop="name" class="name">' . htmlentities($description['products_name']) . '</div></a>' .
            '<div style="" class="model">' . $man_time_list . '</div>' .
            '<div  itemprop="model" class="model" style="display:none">' . $product['products_model'] . '</div>' .
            '<div  itemprop="description" class="model" style="display:none">' . htmlentities($description['products_description']) . '</div>' .
            '<div  itemprop="category" class="model" style="display:none">' . htmlentities(implode(', ', $catpath['name'])) . '</div>' .
            '<div  itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="price">' .
            '<div style="display:none;font-size: 18px; font-weight: 500;" itemprop="price" >' . (integer)($product['products_price']) . ' руб.</div>' .
            '<b itemprop="priceCurrency" style="display:none">RUB</b>' .
            '</div>';
//            if((integer)($product['products_old_price'])>0){
//             $innerhtml .= '<div style="font-size: 18px; color:red; font-weight: 500;" itemprop="old-price" ><strike>' . (integer)($product['products_old_price']) . ' руб.</strike></div>';
//
//             }

        $innerhtml .= '<div style="cursor:pointer; display: none;">' .
            '<div data-vis="size-item-desc" data-vis-id="' . $product['products_id'] . '" style="text-align: right; font-size: 12px; font-weight: 400; display: block; width: 50%; position: absolute; bottom: 30px; right: 20px; margin: 0px 0px -30px; padding: 30px 26px;" data-prod="' . $product['products_id'] . '">' . $options_name . '<i class="mdi mdi-keyboard-arrow-down" style="font-weight: 600; color: rgb(0, 165, 161); font-size: 18px; position: absolute; right: 0px; padding: 30px 0px 0px 31px;"></i>' .
            '<span data-vis="size-item-card" data-vis-id-card="' . $product['products_id'] . '">' . $attr_html . '</span>' .
            '</div>' .
            '</div>' .
            '<div  itemprop="" style="font-size: 12px; display:none;" id="prod-info" data-prod="' . $product['products_id'] . '"><i class="mdi mdi-visibility" style="right: 65px; font-weight: 500; color: #00A5A1; font-size: 15px; padding: 0px 0px 0px 45px; position: absolute;"></i> Увеличить</div>' .
            '</div>';
        
        echo '<div class="days-prod' . $k . '" style="float:left;overflow:hidden;width:500px;">
                <div style="float:left;" class="days-prod' . $k . '-card">'.$innerhtml.'</div>';
        echo '<div style="float:left;padding:10px;width:240px;" class="days-prod' . $i . '-desc">'.$v['description'].'</div>
          </div>';
        echo $value->post;
//        echo '<pre>';
//        print_r($figuresprovider);
//        echo '</pre>';
    }
    echo '</div>';
    echo '<div style="border-top:1px solid #cccccc;margin-top:20px;"><div style="float:left; width:20%; padding:0 30px;" class="days-group-date">'.$value['date_added'].'</div>
              <div style="float:right; width:80%;text-align:right;padding:0 30px;" class="days-group-tags">Теги: '.$value['tags'].'</div></div>';
}
echo '<div>' . \yii\widgets\LinkPager::widget(['pagination' => $pagination]) . '</div>';