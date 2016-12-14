<div style="display: none;" id="<?=$modal_id?>" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                Создать объединенный заказ
            </div>
            <div class="modal-body">
                <?php
                \yii\widgets\Pjax::begin([
                    'id'=>$pjax_id,
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
                echo \yii\helpers\Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => $pjax_id]);
                $form = \yii\bootstrap\ActiveForm::end();
                \yii\widgets\Pjax::end();
                ?>
                <script>
                    $("document").ready(function() {
                        $('#<?=$pjax_id?>').on('pjax:end', function(){
                            $('#<?=$modal_id?>').modal('hide');
                        });
                        $("#<?=$pjax_id?>").on("pjax:end", function () {
                            $.pjax.reload({container: "#groupdiscountuser"});  //Reload form
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>