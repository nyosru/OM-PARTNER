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
            'attribute' => 'name',
            'label' => 'Заголовок',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->name;
            }
        ],
        [
            'attribute' => 'tegs',
            'label' => 'Теги',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->tegs;
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
            'attribute' => 'date_modified',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'label' => 'Последнее изменение',
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'tbl_column_name'];
            },
            'content' => function ($data) {
                return $data->date_modified;
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
                    return 'Опубликована';
                } else {
                    return 'Не опубликована';
                }

            }
        ],

        ['class' => 'yii\grid\ActionColumn',
            'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            'template' => '{update}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    $url = Yii::$app->urlManager->createUrl(['/admin/default/newsupdate', 'id' => $key]);
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
    'header' => '<h5>Добавление новости</h5>',
    'toggleButton' => ['label' => 'Добавить новость'],
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'options' => [

    ]
]);
$form = ActiveForm::begin(['id' => 'news_add', 'action' => '']);
$l1 = '<div class="">';
$l1 .= $form->field($modelform, 'name')->label('Заголовок')->input('text');
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'post')->label('Текст новости')->input('text')->widget(CKEditor::className(), [
    'options' => ['rows' => 1],
    'preset' => 'full',
]);
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'tegs')->label('Теги(через запятую)')->input('text');
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'status')->label('Статус')->dropDownList(['1' => 'Опубликовать', '0' => 'Не опубликовывать']);
$l1 .= '</div>';
$l1 .= '<div class="form-group">';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</div>';
echo $l1;
ActiveForm::end();
Modal::end();