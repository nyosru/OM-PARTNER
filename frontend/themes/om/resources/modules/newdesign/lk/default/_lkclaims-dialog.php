<?php
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;

$model = new \common\models\ClaimForm();

Modal::begin([
    'header' => '<h2>Претензии</h2>',
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'button btn-block btn-info show-dialog',
        'data-opid' => $data->orders_products_id,
        'label' => 'ОТКРЫТЬ',
    ]
]);

$model = new \common\models\ClaimForm();
$form = ActiveForm::begin();
?>

<div class="row">
    <div class="col-xs-6">
        <?=$form->field($model, 'myphoto',['inputOptions'=>['data-opid'=>$data->orders_products_id,'multiple'=>'multiple','class'=>'']])->fileInput()->label('Фото полученного продукта')?>
        <div data-post="file" data-id="<?=$data->orders_products_id?>" class="btn btn-primary btn-block">Загрузить</div>
        <div class="progress">
            <div class="progress-bar" data-progress-opid="<?=$data->orders_products_id?>" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <?=$form->field($model, 'pritenwrite',['inputOptions'=>['style'=>'max-width:100%', 'data-opid'=>$data->orders_products_id]])->textarea()->label('Сообщение')?>
        <div data-post="comment" data-id="<?=$data->orders_products_id?>" class="btn btn-primary btn-block">Отправить</div>
    </div>
    <div class="col-xs-6">
        <div>Загруженные фото</div>
        <div class="photobank-<?=$data->orders_products_id?>"></div>
    </div>
    <div class="col-xs-12">
        <div>История</div>
        <div class="message-bank-<?=$data->orders_products_id ?>" style="float:left; width:100%;max-height: 300px; overflow: auto; border: 1px solid rgb(204, 204, 204); border-radius: 4px;"></div>
    </div>
</div>

<?php
ActiveForm::end();

Modal::end();
?>