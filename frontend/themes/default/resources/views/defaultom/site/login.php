<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Вход';

?>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username')->label('Логин') ?>
            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
<!--            --><?//= $form->field($model, 'captcha')->widget(\yii\captcha\Captcha::classname(), [
//                'template' => '{image}{input}'
//            ])->label('Введите текст на картинке') ?>
            <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня') ?>

            <div style="color:#999;margin:1em 0">
                <?= Html::a('Восстановить пароль. ', [BASEURL . '/request-password-reset']) ?>
                <?= Html::a('Зарегистрироваться. ', [BASEURL . '/signup']) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
