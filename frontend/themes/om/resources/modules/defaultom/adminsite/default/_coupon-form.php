<?php
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\Html;
?>
<?php $form = ActiveForm::begin([
    'id' => 'coupon-form',
]); ?>
<div class="modal-body">
    <?= $form->field($model, 'coupon_type')->dropDownList([
        'F' => 'Фиксированная сумма',
        'P' => 'Процент',
    ]) ?>

    <?= $form->field($model, 'coupon_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_minimum_order')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uses_per_coupon')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'uses_per_user')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'restrict_to_products')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'restrict_to_categories')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'restrict_to_customers')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'coupon_active')->checkbox(['id'=>'checkbox-form-id_'.$model->coupon_id]) ?>
    <div class="form-group">
        <label class="control-label">Период действия купона</label>
        <?=DatePicker::widget([
            'model' => $model,
            'language'=>'ru',
            'attribute' => 'coupon_start_date',
            'attribute2' => 'coupon_expire_date',
            'options' => ['placeholder' => 'Дата активации'],
            'options2' => ['placeholder' => 'Дата дезактивации'],
            'type' => DatePicker::TYPE_RANGE,
            'form' => $form,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);?>
    </div>


</div>
<div class="modal-footer">
    <?= Html::submitButton($model->isNewRecord ? 'Создать купон' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>