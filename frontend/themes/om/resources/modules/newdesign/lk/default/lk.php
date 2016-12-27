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
                ['class' => 'yii\grid\SerialColumn',
                    'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['class' => 'user-order-table-row'];
                    }
                ],
                [
                    'attribute' => 'orders_id',
                    'label' => 'Номер заказа',
                    'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%; '],
                    'contentOptions' => function ($model, $key, $index, $column) {
                        return ['class' => 'user-order-table-row'];
                    },
                    'content' => function ($data) {
                        return $this->render('_lkmyorder-view',['data'=>$data]).
                        '<button class="button" data-toggle="modal" data-target="#modal-order-'.$data->orders_id.'">'.$data->NumOrder().'<br/>('.$data->orders_id.')</button>';
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
                        $finalomprice = 0;
                        $orig_products = \yii\helpers\ArrayHelper::index($data->products, 'orders_products_id');
                        $sp  = \yii\helpers\ArrayHelper::index($data->productsSP, 'orders_products_id');
                        foreach ($orig_products as $key => $value) {
                            $positionquantity =  min($value->first_quant,((int)$value->products_quantity + (int)$sp[$key]['products_quantity']));
                            $price = round($value->final_price);
                            if ($positionquantity > 0) {
                                $finalomprice += (float)$price * (int)$positionquantity;
                            }
                        }

                        // если при заказе использовался купон
                        if(!empty($data->coupons)){
                            $coupon = $data->coupons[0]->redeem_sum;
                            $finalomprice -=$coupon;
                        }
                        return $finalomprice;
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
                        }
                    }
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