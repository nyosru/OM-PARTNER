<?php

/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Modal;

$this->title = 'Админка';

echo \yii\grid\GridView::widget([
    'dataProvider' => $orders,
    'layout' => "{pager}\n{items}\n{pager}",
    'options' => ['class' => 'grid-view admin-news'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
        ],
        [
            'attribute' => 'id',
            'label' => 'Идентификатор',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->id;
            }
        ],
        [
            'attribute' => 'order',
            'label' => 'Заказ',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                $shipping = ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'], 'flat7_flat7' => ['value' => 'Почта ЕМС России']];
                $shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
                $inner = '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseOrd' . $data->id . '" aria-expanded="false" aria-controls="collapseOrd' . $data->id . '">Просмотр</a><div class="collapse"  style="position: absolute; z-index: 999999; left: 19px; height: 0px;" id="collapseOrd' . $data->id . '"><div class="well">';
                $order = unserialize($data->order);
                $ship = $order['ship'];
                $discount = $order['discount'];
                $discounttotalprice = $order['discounttotalprice'];
                unset($order['ship'], $order['discount'], $order['discounttotalprice']);
                $inner .= '<table class="table table-striped table-bordered table-hover table-responsive">';
                $inner .= '<thead><tr>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">#</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Артикул</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Цена за шт</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Количество</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-3">Изображение</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Размер</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Описание</th>';
                $inner .= '</tr></thead><tbody>';
                $count = 0;
                $countprod = 0;
                $totalprice = 0;
                foreach ($order as $key => $value) {
                    $price = $value[3] - $value[3] / 100 * $discounttotalprice;
                    $count++;
                    $countprod += $value[4];
                    $totalprice += (integer)$price * $value[4];
                    $inner .= '<tr>';
                    $inner .= '<td class="col-md-1">' . $key . '</td>';
                    $inner .= '<td class="col-md-2">' . $value[1] . '</td>';
                    if ($data->oMOrdersProducts) {
                        $omprice = '<br/>(ОМ: ' . (integer)$data->oMOrdersProducts[$key]->products_price . ' Руб.)';
                        $omfinalquant = '<br/>(В наличии: ' . $data->oMOrdersProducts[$key]->products_quantity . ')';
                    } else {
                        $omprice = '';
                        $omfinalquant = '';
                    }

                    $inner .= '<td class="col-md-2">' . (integer)$price . ' Руб.' . $omprice . '</td>';
                    $inner .= '<td class="col-md-1">' . $value[4] . $omfinalquant . '</td>';
                    $inner .= '<td class="col-md-3"><img style="width: 50%;" src="/site/imagepreview?src=' . $value[5] . '"/></td>';
                    $inner .= '<td class="col-md-1">' . (integer)$value[6] . '</td>';
                    $inner .= '<td class="col-md-1">' . $value[7] . '</td>';
                    $inner .= '</tr>';
                }
                $inner .= '</tbody><tfooter>';
                $inner .= '<tr>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Итого</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Позиций: ' . $count . ' шт</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Товаров: ' . $countprod . ' шт</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Наценка: ' . (integer)$discount . '%</th>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-3">Скидка: ' . (integer)$discounttotalprice . '%</th>';
                $inner .= '<th colspan="2" style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Стоимость заказа: ' . $totalprice . ' Руб.</th>';
                $inner .= '</tr>';
                $inner .= '<tr>';
                $inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Доставка: </th>';
                $inner .= '<th colspan="6" style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">' . $shipping[$ship]['value'] . '</th>';
                $inner .= '</tr>';
                $inner .= '</tfooter></table>';
                return $inner;
            }
        ],
        [
            'attribute' => 'user_id',
            'label' => 'Пользователь',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->user->username;
            }
        ],
        [
            'attribute' => 'order',
            'label' => 'Доставка',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                $inner = '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseAdr' . $data->id . '" aria-expanded="false" aria-controls="collapseAdr' . $data->id . '">Просмотр</a><div class="collapse" style="position: absolute; z-index: 999999; height: 0px;" id="collapseAdr' . $data->id . '"><div class="well">';
                $delivery = unserialize($data->delivery);
                $inner .= '<div class="col-md-6">Фамилия: </div><div class="col-md-6">' . $delivery['lastname'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Имя: </div><div class="col-md-6">' . $delivery['name'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Отчество: </div><div class="col-md-6">' . $delivery['secondname'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Страна: </div><div class="col-md-6">' . $delivery['country'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Область,регион: </div><div class="col-md-6">' . $delivery['state'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Город: </div><div class="col-md-6">' . $delivery['city'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Адрес: </div><div class="col-md-6">' . $delivery['adress'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Индекс: </div><div class="col-md-6">' . $delivery['postcode'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Телефон: </div><div class="col-md-6">' . $delivery['telephone'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Паспорт(серия): </div><div class="col-md-6">' . $delivery['pasportser'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Паспорт(номер): </div><div class="col-md-6">' . $delivery['pasportnum'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Паспрот(дата выдачи): </div><div class="col-md-6">' . $delivery['pasportdate'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Паспорт(Кем выдан): </div><div class="col-md-6">' . $delivery['pasportwhere'] . '</div><br><br>';
                $inner .= '<div class="col-md-6">Идентификатор ОМ: </div><div class="col-md-6">' . $data->userDescription->customers_id . '</div><br><br>';
                $inner .= '</div></div>';
                return $inner;
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Дата заказа',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->create_date;
            }
        ],
        [
            'attribute' => 'status',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'label' => 'Статус',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                if ($data->orders_id > 0) {
                    switch ($data->oMOrders->orders_status) {
                        case '100':
                            return 'Обработка заказа';
                        case '1':
                            return 'Сверка';
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
                            return $data->oMOrders->orders_status;
                    }
                } else {
                    switch ($data->status) {
                        case '0':
                            return 'Отменен';
                        case '1':
                            return 'Новый';
                        default:
                            return $data->status;
                    }
                }

            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'template' => '{delegate}{cancel}{print}{edit}{mail}',
            'header' => 'Управление',
            'buttons' => [
                'delegate' => function ($url, $model, $key) {
                    if ($model->status == '1' && !($model->orders_id > 0)) {
                        $modal = '<div style="display: none;" id="modal-delegate-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                        $modal .= '<div class="modal-dialog modal-lg">';
                        $modal .= '<div class="modal-content">';
                        $modal .= '<div class="modal-header">';
                        $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                        $modal .= 'Отправка заказа';
                        $modal .= '</div>';
                        $modal .= '<div class="modal-body">';
                        if (Yii::$app->params['partnersset']['transport']['active']) {
                            $where = 'из ОМ на адрес магазина';
                        } else {
                            $where = 'из ОМ на адрес указанный клиентом';
                        }
                        $modal .= '<div>Подтвердите отправку  заказа № ' .
                            $key . ' ' . $where . '</div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">' .
                            '<a href="/admin/default/delegate?id=' . $key . '&self=' . Yii::$app->params['partnersset']['transport']['active'] . '" class="" style="margin: 20px; background: green none repeat scroll 0% 0%; padding: 5px 10px; border-radius: 3px;cursor:pointer;">Да</a>' .
                            '<a class="" data-dismiss="modal" aria-hidden="true"  style="padding: 5px 10px; border-radius: 3px; margin: 20px; background: red none repeat scroll 0% 0%; cursor:pointer;">Нет</a></div>';
                        $modal .= '</div></div></div></div>';
                        return '<span  class="fa fa-truck col-md-2" style="cursor:pointer; font-size: 20px; color: green;" data-toggle="modal" data-target="#modal-delegate-' . $key . '"></span>' . $modal;
                    } else {
                        return '';
                    }
                },
                'cancel' => function ($url, $model, $key) {
                    if ($model->status == 1 && !($model->orders_id > 0)) {
                        $modal = '<div style="display: none;" id="modal-cancel-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                        $modal .= '<div class="modal-dialog modal-lg">';
                        $modal .= '<div class="modal-content">';
                        $modal .= '<div class="modal-header">';
                        $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                        $modal .= 'Отмена заказа';
                        $modal .= '</div>';
                        $modal .= '<div class="modal-body">';
                        $modal .= '<div>Вы уверены что хотите отменить заказ  № ' .
                            $key . ' ? </div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">' .
                            '<a href="/admin/default/cancelorder?id=' . $key . '" class="" style="margin: 20px; background: green none repeat scroll 0% 0%; padding: 5px 10px; border-radius: 3px;cursor:pointer;">Да</a>' .
                            '<a class="" data-dismiss="modal" aria-hidden="true"  style="padding: 5px 10px; border-radius: 3px; margin: 20px; background: red none repeat scroll 0% 0%; cursor:pointer;">Нет</a></div>';
                        $modal .= '</div></div></div></div>';
                        return '<span  class="fa fa-close col-md-2" style="cursor:pointer; font-size: 20px; color: red;" data-toggle="modal" data-target="#modal-cancel-' . $key . '"></span>' . $modal;
                    } else {
                        return '';

                    }
                },
                'print' => function ($url, $model, $key) {
                    $url = Yii::$app->urlManager->createUrl(['/site/printorders', 'id' => $key]);
                    return '<div class="col-md-2">' . Html::a(
                        '<span class="fa fa-print"  style="cursor:pointer; font-size: 20px; color: blue;" ></span>',
                        $url, ['target' => '_blank']) . '</div>';
                },
                'edit' => function ($url, $model, $key) {
                    if ($model->status == 1 && !($model->orders_id > 0)) {
                        $url = Yii::$app->urlManager->createUrl(['/admin/default/orderupdate', 'id' => $key]);
                        return '<div class="col-md-2">' . Html::a(
                            '<span class="fa fa-edit"  style="cursor:pointer; font-size: 20px; color: black;" ></span>',
                            $url, ['target' => '_blank']) . '</div>';

                    } else {
                        return '';

                    }
                },
                'mail' => function ($url, $model, $key) {
                    if ($model->status !== 0) {
                        $modal = '<div style="display: none;" id="modal-mail-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                        $modal .= '<div class="modal-dialog modal-lg">';
                        $modal .= '<div class="modal-content">';
                        $modal .= '<div class="modal-header">';
                        $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                        $modal .= 'Отправить e-mail пользователю ' . $model->user->username;
                        $modal .= '</div>';
                        $modal .= '<div class="modal-body">';
                        $modal .= '<div></div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
                        $modal .= '<form id="groupdiscountuser" action="/admin/default/usercontrol" method="post" role="form">';
                        $form = ActiveForm::begin();
                        $mailmodel = new \frontend\models\MailToUserForm();
                        $mailmodel->email = $model->user->username;
                        if (Yii::$app->params['partnersset']['contacts']['email']['active'] == 1 && ($email = Yii::$app->params['partnersset']['contacts']['email']['value']) == TRUE) {
                            $mailmodel->name = $email;
                        } else {
                            $mailmodel->name = 'support@' . $_SERVER['HTTP_HOST'];
                        }
                        $modal .= $form->field($mailmodel, 'subject')->input('text')->label('Тема');
                        $modal .= $form->field($mailmodel, 'email')->hiddenInput()->label(false);
                        $modal .= $form->field($mailmodel, 'name')->hiddenInput()->label(false);
                        $modal .= '<input type="hidden" name="_csrf" value="" />';
                        $modal .= $form->field($mailmodel, 'body')->label('Текст письма')->input('text')->widget(CKEditor::className(), [
                            'options' => [
                                'id' => $model->id,
                                'rows' => 1],
                            'preset' => 'full',
                        ]);
                        ActiveForm::end();
                        $modal .= '</div><div class="form-group">';
                        $modal .= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'mailtouser']);
                        $modal .= '</div>';
                        $modal .= '</form>';
                        $modal .= '</div></div></div></div></div></div>';
                        return '<div class="col-md-2"><span  class="fa fa-envelope" style="cursor:pointer; font-size: 20px; color: darkblue;" data-toggle="modal" data-target="#modal-mail-' . $key . '"></span></div>' . $modal;
                    } else {
                        return '';
                    }
                },
            ],
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
]);
