<?php
use yii\bootstrap\ActiveForm;

$model = new \common\models\ClaimForm();
$form = ActiveForm::begin();
?>
<div class="row">
    <div class="col-xs-6">
        <?=$form->field($model, 'myphoto',['inputOptions'=>['data-opid'=>$orders_products_id,'multiple'=>'multiple','class'=>'']])->fileInput()->label('Фото полученного продукта')?>
        <div data-post="file" data-id="<?=$orders_products_id?>" class="btn btn-primary btn-block">Загрузить</div>
        <div class="progress">
            <div class="progress-bar" data-progress-opid="<?=$orders_products_id?>" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        <?=$form->field($model, 'pritenwrite',['inputOptions'=>['style'=>'max-width:100%', 'data-opid'=>$orders_products_id]])->textarea()->label('Сообщение')?>
        <div data-post="comment" data-id="<?=$orders_products_id?>" class="btn btn-primary btn-block">Отправить</div>
    </div>
    <div class="col-xs-6">
        <div>Загруженные фото</div>
        <div class="photobank-<?=$orders_products_id?>"></div>
    </div>
    <div class="col-xs-12">
        <div>История</div>
        <div class="message-bank-<?=$orders_products_id ?>" style="float:left; width:100%;max-height: 300px; overflow: auto; border: 1px solid rgb(204, 204, 204); border-radius: 4px;"></div>
    </div>
</div>
<?php
ActiveForm::end();
?>