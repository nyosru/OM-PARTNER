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
use frontend\models\MailToUserForm;

$this->title = 'Админка';
echo \yii\grid\GridView::widget([
    'dataProvider' => $model,
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
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                return $data->id;
            }
        ],
        [
            'attribute' => 'username',
            'label' => 'Пользователь',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1', 'style' => 'word-break: break-all;'];
            },
            'content' => function ($data) {
                return $data->username;
            }
        ],
        [
            'attribute' => 'created_at',
            'label' => 'Дата регистрации',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                return date('Y-m-d H:i:s', $data->created_at);
            }
        ],
        [
            'attribute' => 'updated_at',
            'label' => 'Дата изменения',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                return date('Y-m-d H:i:s', $data->updated_at);
            }
        ],
        [
            'attribute' => 'role',
            'label' => 'Роль',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                switch ($data->role) {
                    case 'admin':
                        return 'Адмимнистратор';
                    case 'register':
                        return 'Клиент';
                    default:
                        return 'не определен';
                }
            }
        ],
        [
            'attribute' => 'active_discount',
            'label' => 'Группа скидок',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                if (isset($data->active_discount)) {
                    if (isset(Yii::$app->params['partnersset']['discountgroup']['value'][$data->active_discount]['name'])) {
                        return Yii::$app->params['partnersset']['discountgroup']['value'][$data->active_discount]['name'];
                    } else {
                        return 'Пользователь находится в группе о которой нет информации';
                    }
                } else {
                    return 'Группа не назначена';
                }
            }
        ],
        [
            'attribute' => 'total_order',
            'label' => 'Общая сумма заказов',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'col-md-1'];
            },
            'content' => function ($data) {
                if (isset($data->total_order)) {
                    return $data->total_order;
                } else {
                    return 'У пользователя нет завершеных заказов';
                }
            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'template' => '{percent}{m}',
            'header' => 'Действия',
            'buttons' => [
                'percent' => function ($url, $model, $key) {
                    if (Yii::$app->params['partnersset']['discountgroup']['active'] == 1) {
                        $modal = '<div style="display: none;" id="modal-cancel-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                        $modal .= '<div class="modal-dialog modal-lg">';
                        $modal .= '<div class="modal-content">';
                        $modal .= '<div class="modal-header">';
                        $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                        $modal .= 'Назначить группу скидок пользователю ' . $model->username;
                        $modal .= '</div>';
                        $modal .= '<div class="modal-body">';
                        $modal .= '<div></div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
                        $modal .= '<form id="groupdiscountuser" action="/admin/default/usercontrol" method="post" role="form">';
                        $modal .= '<div class="form-group"><input name="id" value="' . $model->id . '" type="hidden">';
                        $modal .= '<div class="form-group"><input name="_csrf" value="" type="hidden">';
                        $modal .= '<select name="group" class="form-control">';
                        foreach (Yii::$app->params['partnersset']['discountgroup']['value'] as $k => $v) {
                            if ($v['active'] == 1) {
                                $modal .= '<option value="' . $k . '">' . $v['name'] . '</option>';
                            }
                        }
                        $modal .= '</select>';
                        $modal .= '</div><div class="form-group">';
                        $modal .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'percent']);
                        $modal .= '</div>';
                        $modal .= '</form>';


                        $modal .= '</div></div></div></div></div></div>';
                        return '<span  class="fa fa-percent" style="cursor:pointer; font-size: 20px; color: green;" data-toggle="modal" data-target="#modal-cancel-' . $key . '"></span>' . $modal;
                    } else {
                        $modal = '<div style="display: none;" id="modal-cancel-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                        $modal .= '<div class="modal-dialog modal-lg">';
                        $modal .= '<div class="modal-content">';
                        $modal .= '<div class="modal-header">';
                        $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                        $modal .= 'Назначить группу скидок пользователю ' . $model->username;
                        $modal .= '</div>';
                        $modal .= '<div class="modal-body">';
                        $modal .= '<div>Групповые скидки отключены в настройках</div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
                        $modal .= '</div></div></div></div>';
                        return '<span  class="fa fa-percent col-md-3" style="cursor:pointer; margin:10px; font-size: 20px; color: green;" data-toggle="modal" data-target="#modal-cancel-' . $key . '"></span>' . $modal;
                    }
                },
                'm' => function ($url, $model, $key) {
                    $modal = '<div style="display: none;" id="modal-mail-' . $key . '" class="fade modal" role="dialog" tabindex="-1">';
                    $modal .= '<div class="modal-dialog modal-lg">';
                    $modal .= '<div class="modal-content">';
                    $modal .= '<div class="modal-header">';
                    $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                    $modal .= 'Отправить e-mail пользователю ' . $model->username;
                    $modal .= '</div>';
                    $modal .= '<div class="modal-body">';
                    $modal .= '<div></div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
                    $modal .= '<form id="groupdiscountuser" action="/admin/default/usercontrol" method="post" role="form">';
                    $form = ActiveForm::begin();
                    $mailmodel = new MailToUserForm();
                    $mailmodel->email = $model->username;
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
                    return '<span  class="fa fa-envelope" style="cursor:pointer; font-size: 20px;  margin:10px; color: darkblue;" data-toggle="modal" data-target="#modal-mail-' . $key . '"></span>' . $modal;
                },
            ],
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
]);
