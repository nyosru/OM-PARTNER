<?php
use yii\bootstrap\ActiveForm;
use common\models\LoginFormOM;
use yii\bootstrap\Html;

$model = new LoginFormOM();

$form = ActiveForm::begin([
    'action' => BASEURL.'/login',
    'id' => 'login-form'
]);
?>
<div class="modal fade" id="authform" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Название модали</h4>
            </div>
            <div class="modal-body">
                <?= $form->field($model, 'username')->label('Электронная почта');?>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль');?>
                <?= Html::a('Забыли пароль?', [BASEURL . '/request-password-reset']); ?>
            </div>
            <div class="modal-footer">
                <?= $form->field($model, 'rememberMe')->checkbox()->label('Запомнить меня'); ?>
                <div class="group-btn">
                    <button type="submit" name="partners-settings-button" class="button">Вход</button>
                    <a href="/signup" class="button" style="color: #FFFFFF;">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>