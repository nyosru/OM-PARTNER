

<div style="display: none;" id="modal-mail" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="header">Отправить e-mail пользователю <span class="recipient_name"></span></div>
            </div>
            <div class="modal-body">
                <?php
                \yii\widgets\Pjax::begin([
                    'id'              => 'send-to-user-pjax',
                    'enablePushState' => false,
                ]);


                $form = \yii\bootstrap\ActiveForm::begin([
                    'options'            => ['data-pjax' => 1],
                    'id'                 => 'send-to-user-form',
                    'action'             => '/sp/mail-to-user',
                    'method'             => 'post',
                    'enableClientScript' => true,
                ]);
                ?>
                <div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: left;">

                    <?php $mailmodel = new \frontend\models\MailToUserForm(); ?>
                    <?= $form->field($mailmodel, 'subject')->label('Тема письма')->input('text'); ?>
                    <?= $form->field($mailmodel, 'body')->label('Текст письма')->input('text')
                        ->widget('\vova07\imperavi\Widget', [
                            'settings' => [
                                'verifiedTags' => ['div', 'a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'],
                                'lang'         => 'ru',
                                'minHeight'    => 200,
                                'plugins'      => ['fontsize', 'fontcolor', 'table']]])
                    ; ?>

                </div>
                <div class="form-group">
                    <?= \yii\helpers\Html::hiddenInput(\Yii::$app->getRequest()->csrfParam,
                        \Yii::$app->getRequest()->getCsrfToken(), []); ?>
                    <?= \yii\helpers\Html::hiddenInput('recipient_id'); ?>
                    <?= \yii\helpers\Html::submitButton('Отправить',
                        ['class' => 'btn btn-primary', 'name' => 'send-to-user-pjax']); ?>
                </div>

                <?php
                $form = \yii\bootstrap\ActiveForm::end();
                \yii\widgets\Pjax::end();
                ?>

            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
        
    // $("document").ready(function() {
        $("#send-to-user-pjax").on('pjax:end', function(){
            $("#modal-mail").modal('hide');
            checkAlerts();
        });
        
        function setRecipientNameModalMail(recipient_name) {
          $('#modal-mail .header .recipient_name').text(recipient_name);
        }
        
        function setRecipientIdModalMail(recipient_id) {
          $('#modal-mail input[name=recipient_id]').val(recipient_id);
        }
    // });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>