<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<section id="content5">
    <div class="panel panel-default panel-address">
        <div class="panel-heading">
            <h4 style="margin: 0;">Сменить пароль</h4>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin(['id' => 'reset-password-form']);
            $cust->scenario = 'chpass';?>

            <?= $form->field($cust, 'password')->passwordInput()->label('Пароль') ?>
            <div class="form-group">
                <?= Html::submitButton('Сменить', ['class' => 'button', 'name' => 'save_lk', 'value' => 'chpassword']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>