<?php

/* @var $this \yii\web\View */
/* @var $data_provider \yii\data\ActiveDataProvider */
?>
<?= \frontend\widgets\HeaderFilterBarNew::widget([
    'dataProvider' => $data_provider,
    'sortOrderByData'  =>
        [
            'sort' => [
                'status'      => ['Статус'],
                'secondname'  => ['ФИО'],
                'create_date' => ['Последний заказ'],
                'date_added'  => ['Зарегистрирован'],
            ],
        ],
    'sortStatusData'  => [
        'status' => [
            ''   => ['Все клиенты'],
            '1'  => ['Новые', 'options' => ['style' => 'border-bottom: 2px solid #009f9c;']],
            '2'  => ['Постоянные', 'options' => ['style' => 'border-bottom: 2px solid #d8d8d8;']],
            '3'  => ['Вип клиенты', 'options' => ['style' => 'border-bottom: 2px solid #9c27b0;']],
        ],
    ],
]); ?>
    <div>
        <div class="client-orders-board-table" style="background: #FFF">
            <?php


            \yii\widgets\Pjax::begin(['id' => 'clients']);

            echo \yii\grid\GridView::widget([
                'tableOptions'     => [
                    'class' => 'table table-striped',
                    'style' => 'vertical-align:middle; border-bottom:1px solid #CCC;',
                ],
                'rowOptions'       => [
                    'style' => 'border:none',
                ],
                'headerRowOptions' => [
                    'class' => 'column-header_row_options',
                ],
                'captionOptions'   => [
                    'style' => 'border:none',
                ],
                'emptyText' => 'Данных нет',
                'dataProvider'     => $data_provider,
                'layout'           => "{items}\n<div class=\"pag\">{pager}</div>",
                'columns'          => [
                    [
                        'label'          => 'Фио клента',
                        'contentOptions' => [
                            'class' => 'column-style-grid',
                        ],
                        'content'        => function ($model) {
                            if ($model->userinfo->name) {
                                $name = $model->userinfo->lastname.' '.$model->userinfo->name.' '.$model->userinfo->secondname;
                            } else {
                                $name = 'Пользователь еще не заполнял свои данные';
                            }
                            $class = ['client-new', 'client-new', 'client-old', 'client-vip'];

                            return '<div class="">
                                    <div class="client-avatar">
                                        <div class="avatar">
                                            <div class="client-image">
                                            </div>
                                            <div class="'.$class[$model->status].'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="client-info-fr">
                                            <div class="client-name" style="margin-bottom: 4%; margin-top: 4%">
                                                '.$name.'
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        },
                    ],
                    [
                        'label'          => 'Последний заказ',
                        'contentOptions' => [
                            'class' => 'column-style-grid column-content-order',
                            'style' => 'max-width: 250px;',
                        ],
                        'content'        => function ($model) {
                            $stat_class = [
                                'status-cancel',
                                'status-new',
                                'status-proceed',
                                'status-like',
                                'status-payed',
                                'status-ordered',
                                'status-return',
                            ];

                            $order_status_label = [
                                'Удален',
                                'Новый',
                                'В обработке',
                                'Одобренный',
                                'Оплаченый',
                                'Выполненный',
                                'Возврат'
                            ];

                            if ($model->lastOrder) {
                                $final_order_price = 0;
                                $order_arr = unserialize($model->lastOrder->order);
                                foreach ($order_arr['products'] as $product) {
                                    $final_order_price += round($product[3]) * round($product[4]);
                                }
                                $params = new \php_rutils\struct\TimeParams();
                                $params->date = $model->lastOrder->create_date; //это значение по умолчанию
                                $params->format = 'd F Y H:i:s';
                                $params->monthInflected = true;
                                $create_date = \php_rutils\RUtils::dt()->ruStrFTime($params);

                                return
                                    '<div class="column-content-header">                       
                                        <div class="client-order-num">'.$order_status_label[$model->lastOrder->status].'</div>
                                        <div class="client-order-status '.$stat_class[$model->lastOrder->status].'"></div>
                                    </div>
                                    <div class="column-content">'.$create_date.'</div>
                                         <br> 
                                    <div class="column-content">'.(int)$final_order_price.'р.</div>';
                            } else {
                                return '<div class="column-content-header">Заказов от клиента не поступало</div>';
                            }

                        },
                    ],
                    [
                        'attribute'      => 'Всего заказов',
                        'contentOptions' => [
                            'class' => 'column-style-grid',
                        ],
                        'content'        => function ($model) {
                            return '<span class="orders-count" style="border-radius: 4px;padding: 2px 25px;background: #5b8acf;color:#FFF; font-weight: 400">'.count($model->order).'</span>';
                        },
                    ],
                    [
                        'attribute'      => 'Сумма заказов',
                        'contentOptions' => [
                            'class' => 'column-style-grid',
                        ],
                        'value'          => function ($model) {
                            if (!$model->order) {
                                return 0;
                            }
                            $final_order_price = 0;
                            foreach ($model->order as $order) {
                                $order_arr = unserialize($order['order']);
                                foreach ($order_arr['products'] as $product) {
                                    $final_order_price += round($product[3]) * round($product[4]);
                                }
                            }

                            return $final_order_price;
                        },
                    ],
                    [
                        'label'          => 'Статус клиента',
                        'contentOptions' => [
                            'class' => 'column-style-grid',
                        ],
                        'content'        => function ($model) {
                            $color = ['000000', '009f9c', 'CCCCCC', '6200ea'];
                            $text = ['Неизвестный', 'Новый', 'Старый клиент', 'VIP-клиент'];

                            return '<div style="width: 14px; height: 14px;  background: #'.$color[$model->status].';border-radius: 45px; display: inline-block;padding: 6px;margin: -3px 10px;"></div>'.$text[$model->status];
                        },
                    ],
                    [
                        'label'          => 'Зарегистрирован',
                        'contentOptions' => [
                            'class' => 'column-client column-style-grid',
                        ],
                        'value'          => function ($model) {
                            $params = new \php_rutils\struct\TimeParams();
                            $params->date = $model->date_added; //это значение по умолчанию
                            $params->format = 'd F Y';
                            $params->monthInflected = true;
                            $date_added = \php_rutils\RUtils::dt()->ruStrFTime($params);
                            return $date_added;
                        },
                    ],
                ],
            ]);
            \yii\widgets\Pjax::end();
            ?>
        </div>
    </div>
<?php

?>