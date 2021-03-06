<?php
use yii\filters\AccessControl;
use yii\web\User;

/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use \common\models\UserProfile;
use yii\bootstrap\Collapse;

$this->title = 'Личный кабинет';


?>
<div class="circular"><i class="mdi mdi-perm-identity"></i></div>
<div class="" style="float: left; font-size: 24px; font-weight: 500; padding: 20px;">
    <?= $cust['userinfo']['lastname']; ?> <?= $cust['userinfo']['name']; ?>
    <br/><span style="font-size: 18px; color: rgb(204, 204, 204);"><?= $cust['email']; ?></span>
    <br/><span
        style="font-size: 18px; color: rgb(0, 123, 193); font-weight: 300;">id: <?= $cust['userinfo']['customers_id']; ?></span>
</div>
<div class="orders-metro" style="float: left; width: 100%;">
    <a href="<?=BASEURL?>/lk?view=myorder&filter=5">
        <div class="lk-order-status">
            <div class="item">
                <img src="/images/logo/Proverka.png"/>
            </div>
            <div class="item"><?= $dataset['countcheck'];?></div>
            <div class="title">Ожидает проверки</div>
        </div>
    </a>
    <a href="<?=BASEURL?>/lk?view=myorder&filter=4">
        <div class="lk-order-status">
            <div class="item">
                <img src="/images/logo/Oplata.png"/>
            </div>
            <div class="item"><?= $dataset['countpay'];?></div>
            <div class="title">Ожидает оплаты</div>
        </div>
    </a>
    <a href="<?=BASEURL?>/lk?view=myorder&filter=7">
        <div class="lk-order-status">
            <div class="item">
                <img src="/images/logo/Sborka.png"/>
            </div>
            <div class="item"><?= $dataset['countsborka'];?></div>
            <div class="title">Ожидает сборки</div>
        </div>
    </a>
    <a href="<?=BASEURL?>/lk?view=myorder&filter=6">
        <div class="lk-order-status">
            <div class="item">
                <img src="/images/logo/Dostavka.png"/>
            </div>
            <div class="item"><?= $dataset['countdelivery'];?></div>
            <div class="title">Ожидает доставки</div>
        </div>
    </a>
</div>
<div id="index-card-4">Последний заказ</div>
<div style="float: left; width: 100%; padding: 0px 20px;float: left; width: 100%;">
    <?php
    echo \yii\grid\GridView::widget([
        'dataProvider' => $orders,
        'layout' => "{items}",
        'options' => ['class' => 'grid-view admin-news'],
        'columns' => [
            [
                'attribute' => 'orders_num',
                'label' => 'Номер заказа',
                'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'user-order-table-row'];
                },
                'content' => function ($data) {
                    return '<a class="collapse-toggle" style="color:#007BC1" href="#expanded-order-' . $data->orders_id . '-collapse1" data-toggle="collapse" data-parent="#expanded-order-' . $data->orders_id . '">' . $data->NumOrder() . '</a>';
                }
            ],
            [
                'attribute' => 'create_date',
                'label' => 'Дата',
                'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'user-order-table-row'];
                },
                'content' => function ($data) {
                    return date('d.m.Y', strtotime($data->date_purchased));
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
                    $shipping = [
                        'flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'],
                        'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'],
                        'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'],
                        'flat7_flat7' => ['value' => 'Почта ЕМС России'],
                        'flat11_flat11' => ['value'=>'Бесплатная доставка до ТК КИТ'],
                        'flat10_flat10' => ['value'=>'Бесплатная доставка до ТК ОПТИМА'],
                        'flat9_flat9' => ['value'=>'Бесплатная доставка до ТК Севертранс'],
                        'flat12_flat12' => ['value'=>'Бесплатная доставка до ТК ЭНЕРГИЯ'],
                        'courier_express' => ['value'=>'Бесплатная доставка до ТК Служба доставки Экспресс-Курьер'],
                        'russianpostpf_russianpostpf'=> ['value'=>'Почта России - http://pochta.ru/']
                    ];
                    $shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
                    $inner = '';
                    $ship = $data->shipping_module;
                    $inner .= '<table class="table table-striped  table-hover table-responsive">';
                    $inner .= '<thead><tr>';
                    $inner .= '<th style="border: none" class="col-md-2">#</th>';
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
                    $orig_products = \yii\helpers\ArrayHelper::index($data->products, 'orders_products_id');
                    $attr = \yii\helpers\ArrayHelper::index($data->productsAttr, 'orders_products_id');
                    $sp  = \yii\helpers\ArrayHelper::index($data->productsSP, 'orders_products_id');
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
                        $inner .= '<tr style="background: ' . $col . '">';
                        $inner .= '<td class="col-md-1">' . $count . '</td>';
                        $inner .= '<td class="col-md-1"><a target="_blank" href="'.BASEURL.'/product?id='. $value->products_id.'" style="display:block;clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $value->products_id . ');"></a></td>';

                        $inner .= '<td class="col-md-2">' . $value->products_model . '</td>';
                        if ($data->orders_status != 1) {
                            $omfinalquant = '<br/>В наличии: ' . $positionquantity . '';
                        } else {
                            $omfinalquant = '';
                        }
                        if ($positionquantity > 0) {
                            $totalomcount++;
                            $totalomquant += (int)$positionquantity;
                            $finalomprice += (float)$price * (int)$positionquantity;
                        }
                        $omfirstprice += (float)$price * (int)$firstcountprod;
                        $inner .= '<td class="col-md-2">' . (float)$price . ' Руб.</td>';
                        $inner .= '<td class="col-md-1">Заказано:' . $firstcountprod . $omfinalquant . '</td>';
                        $inner .= '<td class="col-md-1">' . $attr[$value->orders_products_id]['products_options_values'] . '</td>';
                        $inner .= '<td class="col-md-1">' . $value->products_name . '</td>';
                        $inner .= '</tr>';
                    }
                    if ($data->orders_status != 1) {
                        $totalomcount = '<br/>(После сверки: ' . $totalomcount . ')';
                        $totalomquant = '<br/>(После сверки: ' . $totalomquant . ')';
                        $finalompriceview = '<br/>(После сверки ' . $finalomprice . ' Руб.)';
                    } else {
                        $totalomcount = '';
                        $totalomquant = '';
                        $finalompriceview = '';
                    }
                    $inner .= '</tbody><tfooter>';
                    $inner .= '<tr>';
                    $inner .= '<th style="border: none" class="col-md-1">Итого</th>';
                    $inner .= '<th style="border: none" class="col-md-2">Позиций: ' . $count . ' шт' . $totalomcount . '</th>';
                    $inner .= '<th style="border: none" class="col-md-2">Товаров: ' . $countprod . ' шт' . $totalomquant . '</th>';
                    $inner .= '<th colspan="2" style="border: none" class="col-md-2">Стоимость заказа: ' . $omfirstprice . ' Руб. ' . $finalompriceview . ' </th>';
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
                        'id' => 'expanded-order-' . $data->orders_id,
                        'options' => ['style' => 'margin:0px;']
                    ]);


                }


            ],
            [
                'attribute' => 'delivery_adress',
                'label' => 'Статус заказа',
                'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
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
            [
                'attribute' => 'payment',
                'label' => 'Счет',
                'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'user-order-table-row'];
                },
                'content' => function ($data) {
                    if($data->orders_status != 1) {
                        return '<a href="' . BASEURL . '/payview?id=' . $data->orders_id . '">Счет</a>';
                    }else{
                        return 'Не выставлен';
                    }  }
            ],
            [
                'attribute' => 'delivery_adress',
                'label' => 'Копия ТН ТК',
                'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'user-order-table-row'];
                },
                'content' => function ($data) {

                    return 'Счет'.$data->orders_reports_orders['orders_id'];
                }
            ],
//            [
//                'attribute' => 'customers_name',
//                'label' => 'Действия',
//                'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
//                'contentOptions' => function ($model, $key, $index, $column) {
//                    return ['class' => 'user-order-table-row'];
//                },
//                'content' => function ($data) {
//                    return 'Оставить комментарий';
//                }
//            ],

        ],
        'tableOptions' => ['class' => 'table table-striped admin-news-grid'],
    ]);
    ?>
</div>
<div id="index-card-4">Моя статистика</div>
<div class="orders-metro" >
    <div class="lk-order-stat">
        <div class="item">
            <img src="/images/logo/LK_order.png">
        </div>
        <div class="title"><?= $dataset['totalorder'];?></div>
        <div class="desc">
            Заказов сделано мной с момента регистрации на сайте
        </div>
    </div>
    <div class="lk-order-stat">
        <div class="item">
            <img src="/images/logo/LK_goods.png">
        </div>
        <div class="title"><?=$dataset['totalproducts'];?></div>
        <div class="desc">
            Товаров доставлено мне с момента регистрации на сайте
        </div>
    </div>
    <div class="lk-order-stat">
        <div class="item">
            <img src="/images/logo/LK_summ.png">
        </div>
        <div class="title"><?=$dataset['totalprice'];?></div>
        <div class="desc">
            Сумма оплаченных мною товаров с момента регистрации на сайте
        </div>
    </div>
    <div class="lk-order-stat">
        <div class="item">
            <img src="/images/logo/LK_cancelorder.png">
        </div>
        <div class="title"><?=$dataset['totalcancel'];?></div>
        <div class="desc">
            Заказов отменено мной с момента регистрации на сайте
        </div>
    </div>
</div>