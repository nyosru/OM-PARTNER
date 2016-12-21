<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<section id="content5">
    <div style="background: #f5f5f5; position: relative; text-align: left; " class="panel-body">
        <?php
        $form = ActiveForm::begin(['id' => 'reset-password-form']);
        $cust->scenario = 'chpass';?>

        <?= $form->field($cust, 'password')->passwordInput()->label('Пароль') ?>
        <div class="form-group">
            <?= Html::submitButton('Сменить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value' => 'chpassword']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>