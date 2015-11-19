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

$this->title = 'Запросы';
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
            'label' => 'ID заявки',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->id;
            }
        ],

        [
            'attribute' => 'post',
            'label' => 'Текст заявки',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->post;
            }
        ],
        [
            'attribute' => 'date_add',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'label' => 'Добавлено',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->date_add;
            }
        ],
        [
            'attribute' => 'date_modify',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'label' => 'Последнее изменение',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->date_modify;
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
                    return 'Исполнена';
                } else {
                    return 'Ожидает исполнения';
                }

            }
        ],
        [
            'attribute' => 'supervisor',
            'label' => 'Исполнитель',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->supervisor;
            }
        ],

        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    $url = Yii::$app->urlManager->createUrl(['/admin/default/requestupdate', 'id' => $key]);
                    return Html::a(
                        '<span class="fa fa-edit"></span>',
                        $url);
                },
            ],
        ],
    ],
    'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
]);
Modal::begin([
    'header' => '<h5>Создание заявки</h5>',
    'toggleButton' => ['label' => 'Создать заявку'],
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'options' => [

    ]
]);
$form = ActiveForm::begin(['id' => 'request_add', 'action' => '']);
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'post')->label('Текст заявки')->input('text')->widget(CKEditor::className(), [
    'options' => ['rows' => 1],
    'preset' => 'full',
]);
$l1 .= '</div>';
$l1 .= '<div class="form-group">';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</div>';
echo $l1;
ActiveForm::end();
Modal::end();
echo $errors;