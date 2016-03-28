<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = 'Восстановление пароля';

?>

<?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
<?= $form->field($model, 'email')->label('Введите e-mail указанный при регистрации') ?>
<div class="form-group">
    <?= Html::submitButton('Выслать', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

