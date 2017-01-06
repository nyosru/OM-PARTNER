<?php
\yii\widgets\Pjax::begin(['id' => 'pjax_checkSetFlash']);

echo \yii\helpers\Html::a(
    "Проверить ошибки",
    Yii::$app->urlManager->createUrl(['sp/check-alerts']),
    [
        'class' => 'hidden',
        'id'    => 'checkSetFlash',
        'data'  => [
            'method' => 'get',
            'pjax'   => '#pjax_checkSetFlash',
        ],
    ]
);

echo \frontend\widgets\Alert::widget();

$script = <<< JS
    function checkAlerts(){
        $("#checkSetFlash").click();
    }
JS;
$this->registerJs($script, yii\web\View::POS_HEAD);


\yii\widgets\Pjax::end();