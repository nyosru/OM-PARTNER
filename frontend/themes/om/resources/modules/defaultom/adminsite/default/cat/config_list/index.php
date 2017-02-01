<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Modal;
?>
    <div class="row">
        <div class="col-md-12">
            <div style="float: right;">
                <?= \yii\helpers\Html::a("Создать новый", Yii::$app->urlManager->createUrl(['adminsite/configure']),
                    ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

<?php

    $this->title = 'Админка';
    echo \yii\grid\GridView::widget([
        'dataProvider' => $arrayDataProvider,
        'layout'       => "{pager}\n{items}\n{pager}",
        'options'      => ['class' => 'grid-view admin-news'],
        'columns'      => [
            ['class'         => 'yii\grid\SerialColumn',
             'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            ],
            [
                'attribute'      => 'visible_name',
                'label'          => 'Название конфигурации',
                'headerOptions'  => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'tbl_column_name'];
                },
                'content'        => function ($data) {
                    return $data['visible_name'];
                },
            ],
            [
                'attribute'      => 'config_name',
                'label'          => 'url',
                'headerOptions'  => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'tbl_column_name'];
                },
                'content'        => function ($data) {
                    return $data['url'];
                },
            ],
            [
                'label'         => 'Действия',
                'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
                'format'        => 'raw',
                'value'         => function ($data) {
                if(Yii::$app->params['seourls'] == TRUE){
                    $url = ['cat/landing/'.$data['url']];
                }else{
                    $url = ['cat/landing', 'c' => $data['url']];
                }
                return   '<div class="row-e">'.
                            '<div class="center" style="display: inherit;">'.
                                '<div class="action_grid">'.
                                    \yii\helpers\Html::a('<i class="fa fa-eye" aria-hidden="true"></i>',
                                        Yii::$app->urlManager->createUrl($url), ['class' => '']) .
                                '</div>'.
                                '<div class="action_grid">'.
                                    \yii\helpers\Html::a('<i class="fa fa-copy" aria-hidden="true"></i>',
                                        Yii::$app->urlManager->createUrl(['adminsite/copy-config', 'c' =>$data['url']]), ['class' => '']) .
                                '</div>'.
                                '<div class="action_grid">'.
                                    \yii\helpers\Html::a('<i class="fa fa-pencil" aria-hidden="true"></i>',
                                        Yii::$app->urlManager->createUrl( ['adminsite/configure', 'c' => $data['url']])  , ['class' => '']).
                                '</div>'.
                                '<div class="action_grid">'.
                                    \yii\helpers\Html::a('<i class="fa fa-trash" aria-hidden="true"></i>',
                                        Yii::$app->urlManager->createUrl(['adminsite/delete-config', 'c' =>$data['url']]), ['class' => '']) .
                                '</div>'.
                            '</div>'.
                        '</div>';
                },
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
    ]);
    ?>


