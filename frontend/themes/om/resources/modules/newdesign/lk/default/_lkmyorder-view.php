<?php
$shipping = [
    'flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'],
    'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'],
    'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'],
    'flat7_flat7' => ['value' => 'Почта ЕМС России'],
    'flat11_flat11' => ['value'=>'Бесплатная доставка до ТК КИТ'],
    'flat10_flat10' => ['value'=>'Бесплатная доставка до ТК ОПТИМА'],
    'flat9_flat9' => ['value'=>'Бесплатная доставка до ТК Севертранс'],
    'flat12_flat12' => ['value'=>'Бесплатная доставка до ТК ЭНЕРГИЯ'],
    'courierExpress_courierExpress' => ['value'=>'Бесплатная доставка до ТК Служба доставки Экспресс-Курьер'],
    'russianpostpf_russianpostpf'=> ['value'=>'Почта России - http://pochta.ru/']
];
$shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
$inner ='';
$ship = $data->shipping_module;
$count = 0;
$countprod = 0;
$totalomquant = 0;
$totalomcount = 0;
$finalomprice = 0;
$omfirstquant = 0;
$omfirstprice = 0;
$orig_products = \yii\helpers\ArrayHelper::index($data->products, 'orders_products_id');
$attr = \yii\helpers\ArrayHelper::index($data->productsAttr, 'orders_products_id');
$sp  = \yii\helpers\ArrayHelper::index($data->productsSP, 'orders_products_id');
?>
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-order-<?=$data->orders_id?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Просмотр заказа</h4>
            </div>
            <div class="modal-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="col-md-1">#</th>
                            <th class="col-md-1">Изображение</th>
                            <th class="col-md-2">Артикул</th>
                            <th class="col-md-2">Комментарий</th>
                            <th class="col-md-2">Цена за шт</th>
                            <th class="col-md-1">Количество</th>
                            <th class="col-md-1">Размер</th>
                            <th class="col-md-1">Наименование</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($orig_products as $key => $value) {
                            $positionquantity =  min($value->first_quant,((int)$value->products_quantity + (int)$sp[$key]['products_quantity']));
                            $price = round($value->final_price);
                            $count++;
                            $countprod += (int)$value->first_quant;
                            $firstcountprod = $value->first_quant;
                            if ($positionquantity == 0 && isset($data->products)) {
                                $col = '#F8A7A7';
                            } elseif ($positionquantity == $firstcountprod && isset($data->products)) {
                                $col = '#ACDBAC';
                            } else {
                                $col = '#FFBF08 ';
                            }
                            $omfinalquant = $positionquantity . ' шт';
                            if ($positionquantity > 0) {
                                $totalomcount++;
                                $totalomquant += (int)$positionquantity;
                                $finalomprice += (float)$price * (int)$positionquantity;
                            }
                            $omfirstprice += (float)$price * (int)$firstcountprod;
                            // если при заказе использовался купон
                            if(!empty($data->coupons)){
                                $coupon = $data->coupons[0]->redeem_sum;
                                $finalomprice -=$coupon;
                            }
                            ?>
                            <tr style="background: <?=$col ?>">
                                <td class="col-md-1"><?=$count?></td>
                                <td class="col-md-1"><a target="_blank" href="<?=BASEURL.'/product?id='. $value->products_id?>" style="display:block;clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url('<?= BASEURL . '/imagepreview?src=' . $value->products_id?>');"></a></td>
                                <td class="col-md-2"><?=$value->products_model?></td>
                                <td class="col-md-2"><?=$value->comment?></td>
                                <td class="col-md-2"><?=(float)$price?> Руб.</td>
                                <td class="col-md-1"><?=$omfinalquant?></td>
                                <td class="col-md-1"><?=$attr[$value->orders_products_id]['products_options_values']?></td>
                                <td class="col-md-1"><?=$value->products_name?></td>
                            </tr>
                            <?php if($data->orders_status == 5){ ?>
                            <tr>
                                <td colspan="8">
                                    <?=$this->render('_lkmyorder-dialog',['orders_products_id'=>$value->orders_products_id])?>
                                </td>
                            </tr>
                            <?php } ?>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col-md-1">Итого</th>
                            <th class="col-md-2">Позиций:<br><?=$totalomcount?> шт </th>
                            <th class="col-md-2">Товаров:<br><?=$totalomquant?> шт</th>
                            <th colspan="5" class="col-md-2">Стоимость заказа:<br><?=$finalomprice?> Руб. </th>
                        </tr>
                        <tr>
                            <th class="col-md-1">Доставка:</th>
                            <th colspan="7" class="col-md-1"><?=$shipping[$ship]['value']?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>