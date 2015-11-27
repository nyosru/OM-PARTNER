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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
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
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                if (isset($data->total_order)) {
                    return $data->total_order;
                } else {
                    return 'У пользователя нет завершеных заказов';
                }
            }
        ],
//        ['class' => 'yii\grid\ActionColumn',
//            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
//            'template' => '{percent}{hidden}',
//            'buttons' => [
//                'percent' => function ($url, $model, $key) {
//                    $url = Yii::$app->urlManager->createUrl(['/admin/default/commentscontrol', 'id' => $key, 'action' => 'add']);
//                    return Html::a(
//                        '<span class="fa fa-percent" style="font-size: 20px; color: green; margin: 0px 10px;"></span>',
//                        $url);
//                },
//                'hidden' => function ($url, $model, $key) {
//                    $url = Yii::$app->urlManager->createUrl(['/admin/default/commentscontrol', 'id' => $key, 'action' => 'hidden']);
//                    return Html::a(
//                        '<span class="fa fa-close" style="font-size: 20px; color: red; margin: 0px 10px;"></span>',
//                        $url);
//                },
//            ],
//        ],
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
]);
