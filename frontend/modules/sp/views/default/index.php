<?php
/* @var $data_provider \yii\data\ActiveDataProvider */
/* @var $model_form_partners_user_info \common\models\PartnersUserInfoForm */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$text = [
    '',
    '<div class="client-new"></div>',
    '<div class="client-old"></div>',
    '<div class="client-vip"></div>',
];
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
<div id="container2">
    <div id="container1">
        <div id="col1">
            <div id="scroll1" style="height: 100%">

                <?php
                $i_model = 0;
                foreach ($data_provider->getModels() as $user_id => $user) : ?>
                    <a href="<?= \yii\helpers\Url::current(['user_id' => $user_id]) ?>"  style="color: inherit;">
                        <?php
                        $i_model += 1;
                        ( $i_model % 2 ) ? '' : $back_fff = 'background: #FFF;';
                        ?>
                        <div style="<?=$back_fff?>" class="client-plate <?=(Yii::$app->request->getQueryParam('user_id')==$user_id)?'client-active':''?>">
                            <div class="client-avatar">
                                <div class="avatar">

                                    <div class="client-image"></div>

                                    <?= $text[$user->status] ?>
                                </div>
                            </div>
                            <div class="client-info">
                                <div class="client-info-fr">
                                    <div class="client-name">
                                        <?php
                                        if ($user->userinfo->name) {
                                            $name = $user->userinfo->lastname.' '.$user->userinfo->name.' '.$user->userinfo->secondname;
                                        } else {
                                            $name = 'Пользователь еще не заполнял свои данные';
                                        }
                                        echo $name;
                                        ?>
                                    </div>
                                    <?php if ($user->lastOrder) :
                                        $final_order_price = 0;
                                        $order_arr = unserialize($user->lastOrder->order);
                                        foreach ($order_arr['products'] as $product) {
                                            $final_order_price += round($product[3]) * round($product[4]);
                                        }
                                        $params = new \php_rutils\struct\TimeParams();
                                        $params->date = $user->lastOrder->create_date; //это значение по умолчанию
                                        $params->format = 'd F Y H:i:s';
                                        $params->monthInflected = true;
                                        $create_date = \php_rutils\RUtils::dt()->ruStrFTime($params);
                                        ?>
                                        <div class="client-last-order">
                                            <?= '<span>Последний заказ: #'.$user->lastOrder->id.'</span>' ?>
                                        </div>
                                        <div class="client-last-order-date">
                                            <?= '<span>Дата: '.$create_date.'</span>' ?>
                                            <br>
                                            <?= '<span>Цена: '.$final_order_price.'р.</span>' ?>
                                        </div>

                                    <?php else : ?>

                                        <div class="client-last-order-date">
                                            <?= '<span">Заказов от клиента не поступало</span>' ?>
                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="col2">
            <?php if($query_user){?>
            <div id="scroll2" style="height: 100%">
                <div class="client-board">
                    <div class="client-board-avatar">
                        <div class="client-board-avatar-image">
                            <div class="avatar">
                                <div class="client-image"></div>
                                <?= $text[$query_user->status] ?>
                            </div>

                        </div>
                    </div>
                    <div class="client-board-plain">
                        <div class="client-board-plain-name">
                            <?php if ($query_user->userinfo && $query_user->userinfo->name) :
                                $userrinfo_name = $query_user->userinfo->lastname.' '.$query_user->userinfo->name.' '.$query_user->userinfo->secondname;
                            else :
                                $userrinfo_name = 'Данных нет';
                            endif; ?>

                            <?= '<div>' .$userrinfo_name .
                            '
                             <!-- Button trigger modal -->
                                 <span class="glyphicon glyphicon-pencil pencil-edit-custom pencil-edit-userinfo" href="/sp/#" data-toggle="modal" data-target="#om_modal"></span>
                             ' . '</div>'
                            ?>
                        </div>
                        <div class="client-board-plain-info">
                            <div class="client-board-plain-info-col1">
                                <div class="client-board-plain-item">
                                    Дата рождения: Данных нет
                                </div>
                                <div class="client-board-plain-item">
                                    <?php if ($query_user && $query_user->status) : ?>
                                        <?php $text_status = ['Неизвестный', 'Новый', 'Старый клиент', 'VIP-клиент']; ?>
                                        Статус клиента: <?= $text_status[$query_user->status]; ?>
                                    <?php else : ?>
                                        Статус клиента: Неизвестный
                                    <?php endif; ?>
                                </div>
                                <div class="client-board-plain-item">
                                    <?php if ($query_user && $query_user->date_added) :
                                        $params = new \php_rutils\struct\TimeParams();
                                        $params->date = $query_user->date_added; //это значение по умолчанию
                                        $params->format = 'd F Y H:i:s';
                                        $params->monthInflected = true;
                                        $date_added = \php_rutils\RUtils::dt()->ruStrFTime($params);
                                        ?>
                                        Зарегистрирован: <?= $date_added ?>
                                    <?php else : ?>
                                        Зарегистрирован: Данных нет
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="client-board-plain-info-col2">
                                <div class="client-board-plain-item">
                                    <?php if ($query_user->user && $query_user->user->email) : ?>
                                        E-mail: <?= $query_user->user->email ?>
                                    <?php else : ?>
                                        E-mail: Данных нет
                                    <?php endif; ?>
                                </div>
                                <div class="client-board-plain-item">
                                    <?php if ($query_user->userinfo && $query_user->userinfo->telephone) : ?>
                                        Телефон: <?= $query_user->userinfo->telephone ?>
                                    <?php else : ?>
                                        Телефон: Данных нет
                                    <?php endif; ?>
                                </div>
                                <div class="client-board-plain-item">
                                    <?php if ($query_user->userinfo && ($query_user->userinfo->adress || $query_user->userinfo->state || $query_user->userinfo->country || $query_user->userinfo->city)) : ?>
                                        Адрес: <?=
                                        $query_user->userinfo->country . ' ' .
                                        $query_user->userinfo->state . ' ' .
                                        $query_user->userinfo->city . ' ' .
                                        $query_user->userinfo->adress; ?>
                                    <?php else : ?>
                                        Адрес: Данных нет
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (Yii::$app->session->hasFlash('success')) : ?>
                        <div class="alert alert-success alert-block" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (Yii::$app->session->hasFlash('error')) : ?>
                        <div class="alert alert-danger alert-block" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="client-orders-board">
                    <div class="client-orders-board-last">
                        <?php if($query_user->order) :
                            $last_order = new DateTime($query_user->order[0]['create_date']);
                            $now = new DateTime("now");
                            $interval = $now->diff($last_order);

                            $params = new \php_rutils\struct\TimeParams();
                            $params->date = $last_order; //это значение по умолчанию
                            $params->format = 'd F Y';
                            $params->monthInflected = true;
                            $last_order = \php_rutils\RUtils::dt()->ruStrFTime($params);
                            ?>
                            <div>Последний заказ <?= $interval->format('%d'); ?> дней назад (<?= $last_order ?>)</div>
                        <?php else : ?>
                            <div>Заказов не было</div>
                        <?php endif; ?>
                    </div>
                    <?php
                    $dataProvider = new \yii\data\ArrayDataProvider([
                        'key'        => 'id',
                        'allModels'  => $query_user->order,
                        'sort'       => [
                            'attributes' => ['id', 'key', 'value', 'description'],
                        ],
                        'pagination' => [
                            'pageSize' => 5,
                        ],
                    ]);
                    ?>
                    <div class="client-orders-board-table">
                        <div class="row">
                            <?php
                            $i_product = 0;
                            $order_un = null;
                            ?>
                            <?php foreach ($dataProvider->getModels() as $order) : ?>
                                <?php
                                $order_un = unserialize($order['order']);
                                $order_price = 0;
                                foreach ($order_un['products'] as $product) {
                                    if(count($product) > 5) {
                                        $order_price = $order_price + round($product[3] * $product[4]);
                                    }
                                }
                                ?>

                                <div class="col-md-12">
                                    <div class="col-md-1 order-pseudo-column" style="text-align: center;">
                                        <a class="hrefline collapsed" data-toggle="collapse" data-parent="#product-plane" href="#product-line-<?=$i_product?>"></a>
                                    </div>
                                    <div class="col-md-1 order-pseudo-column"><?= $order->id ?></div>
                                    <div class="col-md-2 order-pseudo-column"><?= $order->create_date ?></div>
                                    <div class="col-md-1 order-pseudo-column"><?= $order_price ?>p</div>
                                    <div class="col-md-6 order-pseudo-column"><?= $order->status ?></div>
                                    <div class="col-md-1 order-pseudo-column" style="text-align: right;"><a class="glyphicon glyphicon-pencil" target="_blank" href="/sp/#id=<?= $order->id ?>"></a></div>
                                </div>
                                <div id="product-line-<?=$i_product?>" class="panel-collapse collapse" style="height: 100%">
                                    <div class="panel-body">
                                        <?php foreach ($order_un['products'] as $products) : ?>
                                            <div style="" class="product-card-common">
                                                <div style="" class="product-main-board">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="col-md-2 card-order-column">
                                                                <div class="photo-card-order-column">
                                                                    <?php if(!empty($products[0])) : ?>
                                                                        <img src="/imagepreview?src=<?=$products[0]?>" class="photo-card-order-img">
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 card-order-column">
                                                                <div class="header-card-order-column">
                                                                    Арт. <?= $products[1]?>
                                                                </div>
                                                                <div class="content-card-order-column">
                                                                    <?= $products[7]?> <br><br>
                                                                    Размер: <?= $products[6] ?>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7 card-order-column">
                                                                <div class="col-md-4">
                                                                    <div class="header-card-order-column">
                                                                        Цена:
                                                                    </div>
                                                                    <div class="content-card-order-column">
                                                                        <?= round($products[3]) ?>р
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="header-card-order-column">
                                                                        Количество:
                                                                    </div>
                                                                    <div class="content-card-order-column">
                                                                        <?= $products[4] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4"><div class="header-card-order-column">
                                                                        Сумма:
                                                                    </div>
                                                                    <div class="content-card-order-column">
                                                                        <?= round($products[3] * $products[4])?>р
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>

                                <?php

                                $order_un = null;
                                $i_product++;
                            endforeach;
                            ?>
                        </div>
                        <div class="pag">
                            <?= LinkPager::widget([
                                'pagination'     => $dataProvider->getPagination(),
                                'firstPageLabel' => 'Первая',
                                'lastPageLabel'  => 'Последняя',
                                'maxButtonCount' => 5,
                            ]); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
    </div>
</div>
<?php if($model_form_partners_user_info){?>
<!-- Modal -->
<div class="modal fade" id="om_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="om_partners_modal_block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактирование данных пользователя</h4>
                </div>
                <div class="modal-body">

                    <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['/sp/edit-user-info', 'id' => $query_user->user_id])]); ?>
                    <?php echo $form->field($model_form_partners_user_info, 'id')->hiddenInput(['readonly' => true, 'value' => $query_user->user_id])->label(false)?>
                    <?php echo $form->field($model_form_partners_user_info, 'city')->textInput(['maxlength' => 75])?>
                    <?php echo $form->field($model_form_partners_user_info, 'adress')->textInput(['maxlength' => 100]) ?>
                    <?php echo $form->field($model_form_partners_user_info, 'state')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'country')->textInput(['maxlength' => 45]) ?>
                    <?php echo $form->field($model_form_partners_user_info, 'telephone')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'postcode')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'pasportser')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'pasportnum')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'pasportwhere')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'pasportwhere')->textInput(['maxlength' => 45])?>
                    <?php echo $form->field($model_form_partners_user_info, 'pasportdate')->widget(\kartik\date\DatePicker::classname(), [
                        'language'      => 'ru',
                        'name'          => 'pasportdate',
                        'type'          => \kartik\date\DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format'    => 'yyyy-mm-dd',
                        ],
                    ]) ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <?= Html::submitButton('Сохранить изменения', ['class' => 'btn btn-primary']); ?>
                </div>
                <?php $form = ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
<?php }?>