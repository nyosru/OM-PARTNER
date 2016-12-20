<?php
use yii\filters\AccessControl;
use yii\web\User;
use yii\helpers\Url;
use \common\models\UserProfile;
use yii\bootstrap\Collapse;
/* @var $this yii\web\View */

$this->title = 'Личный кабинет';

$orders_info = [
    [
        'filter' => 5,
        'img' => 'Proverka.png',
        'dataset' => $dataset['countcheck'],
        'title' => 'Ожидает проверки',
    ], [
        'filter' => 4,
        'img' => 'Oplata.png',
        'dataset' => $dataset['countpay'],
        'title' => 'Ожидает оплаты',
    ], [
        'filter' => 7,
        'img' => 'Sborka.png',
        'dataset' => $dataset['countsborka'],
        'title' => 'Ожидает сборки',
    ], [
        'filter' => 6,
        'img' => 'Dostavka.png',
        'dataset' => $dataset['countdelivery'],
        'title' => 'Ожидает доставки',
    ],
];
$stat = [
    [
        'img' => 'LK_order.png',
        'dataset' => $dataset['totalorder'],
        'desc' => 'Заказов сделано мной с момента регистрации на сайт',
    ], [
        'img' => 'LK_goods.png',
        'dataset' => $dataset['totalproducts'],
        'desc' => 'Товаров доставлено мне с момента регистрации на сайте',
    ], [
        'img' => 'LK_summ.png',
        'dataset' => $dataset['totalprice'],
        'desc' => 'Сумма оплаченных мною товаров с момента регистрации на сайте',
    ], [
        'img' => 'LK_cancelorder.png',
        'dataset' => $dataset['totalcancel'],
        'desc' => 'Заказов отменено мной с момента регистрации на сайте',
    ],
];

if ($_COOKIE['info-modal'] !== '1') {?>
    <div class="modal fade in" id="modal-info-lk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                    <h4 class="modal-title">Уважаемые клиенты!</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Убедительная просьба, во избежание действий мошенников,
                        всю информацию об оплате Ваших заказов и реквизиты для
                        оплаты уточнять личным сообщением в нашу электронную
                        почту: <strong>odezhdamaster@gmail.com</strong> или у Ваших региональных менеджеров.
                        Данная информация по горячей линии и скайпу не предоставляется!</p>
                    <p>Обращаем Ваше внимание на изменение нашего скайпа.
                        Новый скайп: <strong><a href="skype:live:sales_53060?chat" class="text-primary">sales@om.ru</a></strong></p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#modal-info-lk').modal('show');
    </script>
   <?php
    setcookie("info-modal", '1', time() + 27000000, '/');
} ?>
<div class="container">
<div class="row" style="margin: 15px 0;">
    <?=$this->render('_navlk',['user'=>$cust])?>
    <div class="col-sm-9">
        <?php if(isset($referal['id'])){?>
            <div class="panel panel-default">
                <div class="panel-heading">Вы принимаете участие в реферальной программе</div>
                <div class="panel-body">
                    <p>Ваш реферальный ид: <strong><?= $referal['id']; ?></strong></p>
                    <p>Ваша реферальная ссылка: <strong>http://<?=$_SERVER['HTTP_HOST']?><?=BASEURL?>/invite?sp=<?=$referal['referral_url']; ?></strong></p>
                </div>
            </div>
        <?php }?>
        <div class="row">
            <?php foreach($orders_info as $item){?>
                <div class="col-sm-3">
                    <a href="<?=Url::to(['/lk/myorder','filter'=>$item['filter']])?>">
                        <div class="thumbnail">
                            <div class="row" style="text-align: center">
                                <div class="col-xs-6" style="padding-right: 2px;">
                                    <img src="/images/logo/<?=$item['img']?>" alt="<?=$item['title']?>">
                                </div>
                                <div class="col-xs-6" style="padding-left: 2px;">
                                    <strong style="font-size: 24px;line-height: 45px;color: #00A5A1;"><?=$item['dataset']?></strong>
                                </div>
                                <div class="col-xs-12">
                                    <strong class="text-primary" style="font-size: 14px;"><?=$item['title']?></strong>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="page-title">
            <h2>Последний заказ</h2>
        </div>

        <?=\yii\grid\GridView::widget([
            'dataProvider' => $orders,
            'layout' => "{items}",
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
                            'courierExpress_courierExpress' => ['value'=>'Бесплатная доставка до ТК Служба доставки Экспресс-Курьер'],
                            'russianpostpf_russianpostpf'=> ['value'=>'Почта России - http://pochta.ru/']
                        ];
                        $shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
                        $inner ='';
                        $ship = $data->shipping_module;
                        $inner .= '<table class="table table-striped  table-hover table-responsive">';
                        $inner .= '<thead><tr>';
                        $inner .= '<th style="border: none" class="col-md-1">#</th>';
                        $inner .= '<th style="border: none" class="col-md-1">Изображение</th>';
                        $inner .= '<th style="border: none" class="col-md-2">Артикул</th>';
                        $inner .= '<th style="border: none" class="col-md-2">Комментарий</th>';
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
                            $inner .= '<td class="col-md-2">'.$value->products_model.'</td>';
                            $omfinalquant = $positionquantity . ' шт';
                            if ($positionquantity > 0) {
                                $totalomcount++;
                                $totalomquant += (int)$positionquantity;
                                $finalomprice += (float)$price * (int)$positionquantity;
                            }
                            $omfirstprice += (float)$price * (int)$firstcountprod;
                            $inner .= '<td class="col-md-2">'.$value->comment.'</td>';
                            $inner .= '<td class="col-md-2">' . (float)$price . ' Руб.</td>';
                            $inner .= '<td class="col-md-1">'. $omfinalquant . '</td>';
                            $inner .= '<td class="col-md-1">'.$attr[$value->orders_products_id]['products_options_values'].'</td>';
                            $inner .= '<td class="col-md-1">'.$value->products_name.'</td>';
                            $inner .= '</tr>';
                            if($data->orders_status == 5){
                                $inner .= '<tr><td colspan="7">
                                                <div class="partners-main-right claim">
                                                     <div class="panel-group" style="margin: 0px;">
                                                        <div class="panel panel-default">
                                                            <a data-toggle="collapse" href="#collapse'.$value->orders_products_id.'">
                                                                <div class="panel-heading" data-opid-collapse="'.$value->orders_products_id.'">
                                                                    <h4 class="panel-title">
                                                                        Претензии к данному товару
                                                                    </h4>
                                                                </div>
                                                            </a>
                                                            <div id="collapse'.$value->orders_products_id.'" class="panel-collapse collapse">
                                                                <div class="panel-body"><div style="margin: 5px; width: calc(50% - 10px); float:left">';
                                $model = new \common\models\ClaimForm();
                                $form = \yii\bootstrap\ActiveForm::begin();
                                $inner .= $form->field($model, 'myphoto',['inputOptions'=>['data-opid'=>$value->orders_products_id,'multiple'=>'multiple','class'=>'']])->fileInput()->label('Фото полученного продукта');
                                $inner .= '<div data-post="file" data-id="'.$value->orders_products_id.'" style="background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 4px; padding: 4px; text-align: center; color: beige; font-weight: 500; cursor: pointer;">Загрузить</div>';
                                $form =   \yii\bootstrap\ActiveForm::end();
                                $inner .= '<div class="progress" >
      <div class="progress-bar" data-progress-opid="' .$value->orders_products_id.'" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
        0%
      </div>
    </div>';
                                $form = \yii\bootstrap\ActiveForm::begin();
                                $inner .= $form->field($model, 'pritenwrite',['inputOptions'=>['style'=>'max-width:100%', 'data-opid'=>$value->orders_products_id]])->textarea()->label('Сообщение');
                                $inner .= '<div data-post="comment" data-id="'.$value->orders_products_id.'" style="background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 4px; padding: 4px; text-align: center; color: beige; font-weight: 500; cursor: pointer;">Отправить</div>';
                                $form =   \yii\bootstrap\ActiveForm::end();
                                $inner .=                           '</div>
                                                    <div style="margin: 5px; width: calc(50% - 10px); float:right">
                                                        <div style="font-weight: 500">
                                                            <div style="float:left; width:100%">Загруженные фото</div>
                                                            <div class="photobank-'.$value->orders_products_id.'"></div>
                                                        </div>
                                                        </div>
                                                        <div style="font-weight: 500">
                                                            <div style="float:left; width:100%">История</div>
                                                            <div class="message-bank-'. $value->orders_products_id.'" style="float:left; width:100%;max-height: 300px; overflow: auto; border: 1px solid rgb(204, 204, 204); border-radius: 4px;"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
                                                        </div>
                                                    </div>
                                                 </div>
                                                            </div>
                                                        </div>
                                                     </div>
                                                </div></td></tr>';
                            }
                        }


                        $inner .= '</tbody><tfooter>';
                        $inner .= '<tr>';
                        $inner .= '<th style="border: none" class="col-md-1">Итого</th>';
                        $inner .= '<th style="border: none" class="col-md-2">Позиций: ' . $totalomcount . ' шт </th>';
                        $inner .= '<th style="border: none" class="col-md-2">Товаров: ' . $totalomquant . ' шт</th>';
                        $inner .= '<th colspan="2" style="border: none" class="col-md-2">Стоимость заказа: '.$finalomprice. ' Руб. </th>';
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
                            case '22':
                                return 'Объединен';
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
                        if($data->ordersReports){
                            if(($datakostyl = \common\models\OrdersReportsOrdersFiles::find()->where(['orders_reports_id'=>$data->ordersReports[0]['orders_reports_id'], 'groups_id'=> $data->ordersReports[0]['groups_id']])->asArray()->one()) == TRUE)
                                return '<a href="'.BASEURL.'/tcncopy?id='.$data->orders_id.'" target="_blank">Открыть</a>';
                        }
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
        ]); ?>

        <div class="page-title">
            <h2>Моя статистика</h2>
        </div>
        <div class="row" style="text-align: center;margin-top: 10px;">
            <?php foreach($stat as $item){?>
                <div class="col-sm-3" style="margin: 10px 0;">
                    <img src="/images/logo/<?=$item['img']?>">
                    <strong style="color: #007BC1;font-size: 22px;display: block"><?=$item['dataset']?></strong>
                    <p><?=$item['desc']?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</div>