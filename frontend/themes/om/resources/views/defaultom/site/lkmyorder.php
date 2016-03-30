<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\bootstrap\Collapse;



$this -> title = 'Мои заказы';
?>
<form>
    <input type="hidden" value="myorder" name="view">
<div style="float: left; width: 100%;">
    <?
    $sorter = '';
    $cs = count($sort_order);
    for($i=0; $i<$cs; $i++){
        switch($i){
            case '0':
                $addclass = 'first-sorter';
                break;
            case $cs-1:
                $addclass = 'last-sorter';
                break;
            default:
                $addclass = '';
                break;
        }

        $sorter .=  '<a class="sort" name="order"  type="submit" href="" ><button name="filter" type="submit" value="'.$i.'" class="'.$addclass.' header-sort-item active lock-on">'.$sort_order[$i].'</button></a>';
    }
    ?>
    <div id="sort-order" style="width: 50%;">
        <?= $sorter?>
    </div>
    <div id="find-date" style="float: right; width: 30%; text-align: right;">

            <?
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'di',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'от', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'value'=>Yii::$app->request->getQueryParam('di'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <?
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'do',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'value'=>Yii::$app->request->getQueryParam('do'),
                'options' => ['placeholder' => 'до', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <button style="background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); width: 10%; height: 33px; line-height: 1.2; margin-right: 0px;" class="btn" type="submit">»</button>

    </div>
    <div id="find-order"  style="float: right; width: 20%; text-align: right;">

            <input name="id" value="<?= Yii::$app->request->getQueryParam('id');?>" class="no-shadow-form-control" type="text" placeholder="числовой идентификатор"></input>
            <button style="width: 10%; height: 32px; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); margin-right: 0px; float: left; position: relative; left: 90%; bottom: 33px; line-height: 1.2;" class="btn" type="submit">»</button>

    </div>

</div>
</form><?
echo \yii\grid\GridView::widget([
    'dataProvider' => $orders,
    'layout' => "{pager}\n{items}",
    'options' => ['class' => 'grid-view admin-news', 'style'=>'float: left; width: 100%;'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            }
        ],
        [
            'attribute' => 'orders_id',
            'label' => 'Номер заказа',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return '<a class="collapse-toggle" href="#expanded-order-'.$data->orders_id.'-collapse1" data-toggle="collapse" data-parent="#expanded-order-'.$data->orders_id.'">'.$data->NumOrder().'<br/>('.$data->orders_id.')</a>';
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Дата',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return date('d.m.Y',strtotime($data->date_purchased));
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Сумма, руб.',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                $shipping = ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'], 'flat7_flat7' => ['value' => 'Почта ЕМС России']];
                $shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
                $inner ='';
                $ship = $data->shipping_module;
                $inner .= '<table class="table table-striped  table-hover table-responsive">';
                $inner .= '<thead><tr>';
                $inner .= '<th style="border: none" class="col-md-1">#</th>';
                $inner .= '<th style="border: none" class="col-md-1">Изображение</th>';
                $inner .= '<th style="border: none" class="col-md-2">Артикул</th>';
                $inner .= '<th style="border: none" class="col-md-2">Цена за шт</th>';
                $inner .= '<th style="border: none" class="col-md-1">Количество</th>';
                $inner .= '<th style="border: none" class="col-md-1">Размер</th>';
                $inner .= '<th style="border: none" class="col-md-1">Наименование</th>';
                $inner .= '</tr></thead><tbody>';
                $count = 0;
                $countprod = 0;
                $totalomquant = 0;
                $totalomcount = 0;
                $finalomprice = 0;
                $omfirstquant = 0;
                $omfirstprice = 0;
                $attr = \yii\helpers\ArrayHelper::index($data->productsAttr, 'orders_products_id');
                foreach ($data->products as $key => $value) {
                    $positionquantity =  (int)$value->products_quantity + (int)$data->productsSP[$key]->products_quantity;
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
                    $inner .= '<tr style="background: ' . $col . '">';
                    $inner .= '<td class="col-md-1">' . $count . '</td>';
                    $inner .= '<td class="col-md-1"><div style="clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $value->products_id . ');"></div></td>';
                    $inner .= '<td class="col-md-2">'.$value->products_model.'</td>';
                    if($data->orders_status != 1) {
                        $omfinalquant = '<br/>В наличии: ' . $positionquantity . '';
                    }else{
                        $omfinalquant = '';
                    }
                    if ($positionquantity > 0) {
                        $totalomcount++;
                        $totalomquant += (int)$positionquantity;
                        $finalomprice += (float)$price * (int)$firstcountprod;
                        }
                    $omfirstprice += (float)$price * (int)$firstcountprod;
                    $inner .= '<td class="col-md-2">' . (float)$price . ' Руб.</td>';
                    $inner .= '<td class="col-md-1">Заказано: ' . $firstcountprod . $omfinalquant . '</td>';
                    $inner .= '<td class="col-md-1">'.$attr[$value->orders_products_id]['products_options_values'].'</td>';
                    $inner .= '<td class="col-md-1">'.$value->products_name.'</td>';
                    $inner .= '</tr>';
                }

                if($data->orders_status != 1) {
                    $totalomcount = '<br/>(После сверки: ' . $totalomcount . ')';
                    $totalomquant = '<br/>(После сверки: ' . $totalomquant . ')';
                    $finalompriceview = '<br/>(После сверки ' . $finalomprice . ' Руб.)';
                }else{
                    $totalomcount = '';
                    $totalomquant = '';
                    $finalompriceview = '';
                }

                $inner .= '</tbody><tfooter>';
                $inner .= '<tr>';
                $inner .= '<th style="border: none" class="col-md-1">Итого</th>';
                $inner .= '<th style="border: none" class="col-md-2">Позиций: ' . $count . ' шт' . $totalomcount . '</th>';
                $inner .= '<th style="border: none" class="col-md-2">Товаров: ' . $countprod . ' шт' . $totalomquant . '</th>';
                $inner .= '<th colspan="2" style="border: none" class="col-md-2">Стоимость заказа: '.$omfirstprice. ' Руб. '.$finalompriceview.'</th>';
                $inner .= '</tr>';
                $inner .= '<tr>';
                $inner .= '<th style="border: none" class="col-md-1">Доставка: </th>';
                $inner .= '<th colspan="6" style="border: none" class="col-md-1">' . $shipping[$ship]['value'] . '</th>';
                $inner .= '</tr>';
                $inner .= '</tfooter></table>';
                //$inner = '<a class="" role="" data-toggle="collapse" href="#collapseOrd' . $data->orders_id . '" aria-expanded="false" aria-controls="collapseOrd' . $data->orders_id . '">'. $finalomprice . ' Руб</a><div class="collapse"  style="position: absolute; z-index: 999999; left: 19px; height: 0px;" id="collapseOrd' . $data->orders_id . '"><div class="well">';
                return Collapse::widget([
                    'items' => [
                        [
                            'label' => $finalomprice,
                            'content' => $inner,
                            'contentOptions' => ['class' => 'user-order-row-expand'],
                            'options' => ['class' => 'user-order-row']
                        ],

                    ],
                    'id'=>'expanded-order-'.$data->orders_id,
                    'options'=>['style'=>'margin:0px;']
                ]);


            }


        ],
        [
            'attribute' => 'orders_status',
            'label' => 'Статус заказа',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                switch ($data->orders_status) {
                        case '100':
                            return 'Обработка заказа';
                        case '1':
                            return 'Ожидает проверки';
                        case '2':
                            return 'Ждём оплаты';
                        case '3':
                            return 'Оплачен';
                        case '4':
                            return 'Оплачен - Доставляется';
                        case '5':
                            return 'Оплачен - Доставлен';
                        case '6':
                            return 'Отменён';
                        case '11':
                            return 'Сборка';
                        case '0':
                            return 'Спецпредложение';
                        default:
                            return $data->orders_status;
                    }

            }

        ],
//        [
//            'attribute' => 'delivery_adress',
//            'label' => 'Оплатить заказ',
//            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
//            'contentOptions' => function ($model, $key, $index, $column) {
//                return ['class' => 'user-order-table-row'];
//            },
//            'content' => function ($data) {
//                return 'Инструкция по оплате';
//            }
//        ],
//        [
//            'attribute' => 'delivery_adress',
//            'label' => 'Квитанция',
//            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
//            'contentOptions' => function ($model, $key, $index, $column) {
//                return ['class' => 'user-order-table-row'];
//            },
//            'content' => function ($data) {
//                return 'Счет';
//            }
//        ],
//        [
//            'attribute' => 'customers_name',
//            'label' => 'Действия',
//            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
//            'contentOptions' => function ($model, $key, $index, $column) {
//                return ['class' => 'user-order-table-row'];
//            },
//            'content' => function ($data) {
//                return 'Оставить комментарий';
//            }
//        ],

    ],
    'tableOptions' => ['class' => 'table table-striped admin-news-grid'],
]);
?>
