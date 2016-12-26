<div style="display: none;" id="modal-common" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <div class="header"><h4>Создать объединенный заказ<span class="recipient_name"></span></h4></div>
            </div>
            <div class="modal-body">
                <?php
                \yii\widgets\Pjax::begin([
                    'id'=>'pjax_common',
                    'enablePushState' =>false
                ]);
                $form = \yii\bootstrap\ActiveForm::begin([
                    'options' => ['data-pjax' =>1],
                    'id'=>'groupdiscountuser',
                    'action'=>'/sp/add-common',
                    'method'=> 'post',
                    'enableClientScript' => true
                ]);
                $commonForm = new \common\forms\PartnersOrders\CommonOrderForm();
                echo $form->field($commonForm, 'header')->label('Наименование заказа')->input('text');
                echo $form->field($commonForm, 'description')->label('Краткое описание')->input('text');
                echo \yii\helpers\Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'pjax_common']);
                $form = \yii\bootstrap\ActiveForm::end();
                \yii\widgets\Pjax::end();
                ?>
                <script>

                </script>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<< JS
        $('#pjax_common').on('pjax:end', function(){
            $('#modal-common').modal('hide');
            checkAlerts();
        });
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>