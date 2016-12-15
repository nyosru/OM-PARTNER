<?php
\yii\widgets\Pjax::begin(['id' => 'pjax_checkSetFlash']);
echo \yii\helpers\Html::a(
    "Проверить ошибки",
    \yii\helpers\Url::to('sp/check-alerts', true),
    ['class' => 'hidden', 'id' => 'checkSetFlash']
);
echo \frontend\widgets\Alert::widget();
\yii\widgets\Pjax::end();

$script = <<< JS
    function checkAlerts(){
        $("#checkSetFlash").click();
    }
JS;
$this->registerJs($script, yii\web\View::POS_END);
