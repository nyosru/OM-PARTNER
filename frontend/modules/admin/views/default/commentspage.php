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
                return $data->user->username;
            }
        ],
        [
            'attribute' => 'post',
            'label' => 'Сообщение',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->post;
            }
        ],
        [
            'attribute' => 'date_added',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'label' => 'Добавленно',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->date_added;
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
                if ($data->status == '1') {
                    return 'Опубликован';
                } else {
                    return 'Не опубликован';
                }

            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'template' => '{add}{hidden}',
            'buttons' => [
                'add' => function ($url, $model, $key) {
                    $url = Yii::$app->urlManager->createUrl(['/admin/default/commentscontrol', 'id' => $key, 'action' => 'add']);
                    return Html::a(
                        '<span class="fa fa-check" style="font-size: 20px; color: green; margin: 0px 10px;"></span>',
                        $url);
                },
                'hidden' => function ($url, $model, $key) {
                    $url = Yii::$app->urlManager->createUrl(['/admin/default/commentscontrol', 'id' => $key, 'action' => 'hidden']);
                    return Html::a(
                        '<span class="fa fa-close" style="font-size: 20px; color: red; margin: 0px 10px;"></span>',
                        $url);
                },
            ],
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
]);
