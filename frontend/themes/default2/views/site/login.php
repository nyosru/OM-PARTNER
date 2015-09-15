<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Вход';

?>
    <div class="" id="partners-main">

    <div class="container-fluid" id="partners-main-right-back">
        <div id="" class="bside">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->label('Логин') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
            <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Восстановить пароль. ', ['site/request-password-reset']) ?>
                <?= Html::a('Зарегистрироваться. ', ['site/signup']) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
