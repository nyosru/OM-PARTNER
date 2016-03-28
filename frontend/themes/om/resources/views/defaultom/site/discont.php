<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<SCRIPT LANGUAGE="JavaScript">
    $(document).ready(function() {
        $(".AcciaEntity, .AcciaEntityB").on('click', ".addSCartAction", function(){
            var UId = $(this).closest('div.ProdBord');
            if (OpenFlyDiv ($("input[name=TestRegUser]").val(), UId)) { return false; } else {
//			alert(UId.data('tid'));
                var unit = parseInt(UId.data('unit'));
                var sklad = parseInt(UId.data('sklad'));
                var qty = parseInt(UId.find(".BasketCount").val())+unit;
                if (qty>sklad) { qty = sklad; }
                if (qty<1) { qty = 0; }
                UId.find(".BasketCount").val(qty);
                $.post("application_top.php?action=add_ajax_cart", {quant: qty, tid:UId.data('tid')}, function(data) {
                    $('#ShopinngCartUpdate').html('');
                    $('#ShopinngCartUpdate').html(data);
                });
            }
        });
    });
</script>
<style>
    .AcciaEntity {
        width: 160px;
        height: 160px;
        padding: 4px 4px 0px 4px;
        position: relative;
    }
    .miniBoxHead {
        font: bold 12px/14px Verdana, Arial, sans-serif;
        text-align: right;
        margin: 0;
        padding: 0;
    }
    .addSCartAction { top: 18PX; }
    .ViewDesAction { top: 46PX; }
    .ViewAction { top: 74PX; }
    .addSCartAction, .ViewDesAction, .ViewAction {
        cursor: pointer;
        display: block;
        position: absolute;
        right: 4px;
        z-index: 30;
        -moz-box-shadow:inset 0px 1px 0px 0px #caefab;
        -webkit-box-shadow:inset 0px 1px 0px 0px #caefab;
        box-shadow:inset 0px 1px 0px 0px #caefab;
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77d42a), color-stop(1, #5cb811) );
        background:-moz-linear-gradient( center top, #77d42a 5%, #5cb811 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77d42a', endColorstr='#5cb811');
        background-color:#77d42a;
        -webkit-border-top-left-radius:7px;
        -moz-border-radius-topleft:7px;
        border-top-left-radius:7px;
        -webkit-border-top-right-radius:7px;
        -moz-border-radius-topright:7px;
        border-top-right-radius:7px;
        -webkit-border-bottom-right-radius:7px;
        -moz-border-radius-bottomright:7px;
        border-bottom-right-radius:7px;
        -webkit-border-bottom-left-radius:7px;
        -moz-border-radius-bottomleft:7px;
        border-bottom-left-radius:7px;
        text-indent:0;
        border:1px solid #268a16;
        display:inline-block;
        color:#306108;
        font-family:Arial;
        font-size:12px;
        font-weight:bold;
        font-style:normal;
        height:20px;
        line-height:20px;
        width:65px;
        text-decoration:none;
        text-align:center;
        text-shadow:1px 1px 0px #aade7c;
    }
    .addSCartAction:hover, .ViewDesAction:hover {
        background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #5cb811), color-stop(1, #77d42a) );
        background:-moz-linear-gradient( center top, #5cb811 5%, #77d42a 100% );
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#5cb811', endColorstr='#77d42a');
        background-color:#5cb811;
    }
</style>

<?php
//if ($cart->count_contents() > 0) {
//    $products = $cart->get_products();
//    if (count($products)>0) {
//        foreach ($products as $num=>$val) {
//            $BaketProd[$val['id']] = $val['quantity'];
//        }
//    }
//}
$query = new yii\db\Query();
$t_partners_products = \common\models\PartnersProducts::tableName();
$t_products_description = \common\models\PartnersProductsDescription::tableName();
$t_products_to_categories = \common\models\PartnersProductsToCategories::tableName();

$random_product_query = $query->
select([

    $t_partners_products.'.products_id',
    $t_products_description.'.products_name',
    $t_partners_products.'.products_price',
    $t_partners_products.'.products_tax_class_id',
    $t_partners_products.'.products_image',
    $t_partners_products.'.products_old_price',
    $t_partners_products.'.products_quantity_order_units',
    $t_partners_products.'.products_quantity',
    $t_products_description.'.products_description',
    $t_products_description.'.products_info',
    $t_partners_products.'.products_date_available'])->

from([

    $t_partners_products,
    $t_products_description,
    $t_products_to_categories])->

where([
        $t_partners_products.'.products_status'=>"1",
        $t_partners_products.'.products_id'=>$t_products_to_categories.'.products_id',
        $t_products_description.'.products_id'=> $t_products_to_categories.'.products_id',
        $t_products_description.'.language_id' => "1"])->
       // $t_products_to_categories.'.categories_id'=>"1435"])->
andWhere(['>' , 'products_quantity', 0])->
andWhere(['>', $t_partners_products.'.products_sort_order' ,0 ])->
orderBy($t_partners_products.'.products_sort_order')->
limit(30);

echo '<pre>';
print_r($random_product_query->all());
echo '</pre>';
die();
echo '<table border="0" cellspacing="0" cellpadding="0"><tr>'."\n";
while ($random_product = tep_db_fetch_array($random_product_query)) {
    if ($random_product['products_date_available'] == '0000-00-00 00:00:00') tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_date_available=now() WHERE products_id='".(int)$random_product['products_id']."'");
    if ((int)$random_product['products_quantity_order_units']<1) $random_product['products_quantity_order_units'] = 1;
    $price = round($random_product['products_price']);
    $oldPrice = round($random_product['products_old_price']);
    $products_attributes_query = tep_db_query("SELECT pa.options_id, po.products_options_name
	FROM products_attributes pa, products_options po
	WHERE pa.products_id='".(int)$random_product['products_id']."' AND po.products_options_id=pa.options_id AND po.language_id='1' LIMIT 1");
    if (tep_db_num_rows($products_attributes_query)>0) {
        $products_attributes = tep_db_fetch_array($products_attributes_query);
        $products_values_query = tep_db_query("SELECT pa.options_values_id, ov.products_options_values_name, pa.quantity,
		pa.options_values_price, pa.price_prefix
		FROM products_attributes pa, products_options_values ov
		WHERE pa.products_id='".(int)$random_product['products_id']."' AND pa.options_id='".$products_attributes['options_id']."'
		AND ov.products_options_values_id=pa.options_values_id AND ov.language_id='1' LIMIT 1");
        $products_values = tep_db_fetch_array($products_values_query);
        if ($products_values['price_prefix'] == '-') {
            $price += $products_values['options_values_price'];
            $oldPrice += $products_values['options_values_price'];
        } elseif ($products_values['price_prefix'] == '+') {
            $price -= $products_values['options_values_price'];
            $oldPrice -= $products_values['options_values_price'];
        }
        $tid = (int)$random_product['products_id'].'{'.(int)$products_attributes['options_id'].'}'.(int)$products_values['options_values_id'];
        $htmlOutput = strip_tags($products_attributes['products_options_name']).': '.strip_tags($products_values['products_options_values_name']);
    } else {
        $htmlOutput = '';
        $tid = (int)$random_product['products_id'];
    }
    ?>
    <td><div class="ProdBord AcciaEntity" <?='data-unit="'.$random_product['products_quantity_order_units'].'" data-sklad="'.$random_product['products_quantity'].'" data-tid="'.$tid.'"'?>>
            <?php
            echo '<div class="miniBoxHead">Товар дня</div><div><a title="'.(int)$random_product['products_id'].'" class="fancybox" data-fancybox-group="gallery" href="' . DIR_WS_IMAGES . $random_product['products_image'] . '">' . tep_preview_image(DIR_WS_IMAGES, $random_product['products_image'], $random_product['products_name'], '150', '', 'prev', '90') . '</a></div><div style="float:left">' . $random_product['products_name'] . '<!-- x '.(int)$random_product['products_quantity'].' шт.-->'.($htmlOutput ? '<div>'.$htmlOutput.'</div>' : '') .'<div style="font-size:14px"><s>' . round($random_product['products_old_price']) . '</s> <b style="color:red">' . round($random_product['products_price']).'</b>р.</div></div>
	<div class="addSCartAction">Купить</div>
	<a class="various ViewDesAction" href="#inline'.str_replace(array('{','}'), '-', $tid).'">Описание</a>
	<a class="various ViewAction" href="accia.php">Все</a>';
            echo '<input type="hidden" class="BasketCount" value="'.(isset($BaketProd[$tid]) ? $BaketProd[$tid] : '0').'">';
            ?>
            <div class="HidenActionDescribe" id="inline<?=str_replace(array('{','}'), '-', $tid)?>">
                <h2><?=stripslashes($random_product['products_name'])?></h2>
                <p><b><?=stripslashes($random_product['products_info'])?></b></p>
                <p><?=stripslashes($random_product['products_description'])?></p>
            </div>
        </div>
    </td>
    <?php
}
?>
</tr></table>