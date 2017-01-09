<div class="container_95">
    <?php
    $i = 0;
    echo \yii\grid\GridView::widget([
        'dataProvider' => $arrayDataProvider,
        'columns'      => [
            [
                'label'  => 'Номер строки',
                'format' => 'raw',
                'value'  => function ($data) use (&$i) {
                    return ++$i;
                },
            ], [
                'label'  => 'Имя файла настроек',
                'format' => 'raw',
                'value'  => function ($data) {
                    return $data;
                },
            ], [
                'label'  => 'Действия',
                'format' => 'raw',
                'value'  => function ($data) {
                    return "
                <div class='row'>
                     <div class='center' style='display: inherit;'>
                         <div class='action_grid'>
                             " . \yii\helpers\Html::a("<i class=\"fa fa-eye\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['cat/landing', 'c' => $data]), ['class' => '']) . "
                         </div> 
                         <div class='action_grid'>
                         " . \yii\helpers\Html::a("<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['cat/index', 'c' => $data]), ['class' => '']) . "
                         </div>   
                         <div class='action_grid'>                         
                         " . \yii\helpers\Html::a("<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>",
                            Yii::$app->urlManager->createUrl(['cat/delete-config', 'c' => $data]), ['class' => '']) . "
                         </div>
                     </div>
                </div>
                ";
                },
            ],
        ],
    ]); ?>
</div>
