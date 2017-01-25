
    <div class="row">
        <div class="col-md-12">
            <div style="float: right;">
                <?= \yii\helpers\Html::a("Создать новый", Yii::$app->urlManager->createUrl(['adminsite/configure']),
                    ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

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
        'dataProvider' => $arrayDataProvider,
        'layout'       => "{pager}\n{items}\n{pager}",
        'options'      => ['class' => 'grid-view admin-news'],
        'columns'      => [
            ['class'         => 'yii\grid\SerialColumn',
             'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
            ],
            [
                'attribute'      => 'config_name',
                'label'          => 'Имя файла настроек',
                'headerOptions'  => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['class' => 'tbl_column_name'];
                },
                'content'        => function ($data) {
                    return $data;
                },
            ],
            [
                'label'         => 'Действия',
                'headerOptions' => ['style' => 'background: #FFBF08 none repeat scroll 0% 0%;'],
                'format'        => 'raw',
                'value'         => function ($data) {
                    return "
                <div class='row-e'>
                     <div class='center' style='display: inherit;'>
                         <div class='action_grid'>
                             " . \yii\helpers\Html::a("<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['cat/landing', 'c' => $data]), ['class' => '']) . "
                         </div> 
                         <div class='action_grid'>
                         " . \yii\helpers\Html::a("<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['adminsite/configure', 'c' => $data]), ['class' => '']) . "
                         </div>   
                         <div class='action_grid'>                         
                         " . \yii\helpers\Html::a("<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['adminsite/delete-config', 'c' => $data]), ['class' => '']) . "
                         </div>
                     </div>
                </div>
                ";
                },
            ],
        ],
        'tableOptions' => ['class' => 'table table-striped table-bordered admin-news-grid'],
    ]);
    ?>


