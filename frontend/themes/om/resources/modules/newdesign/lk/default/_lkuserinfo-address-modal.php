<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
if($value == 'add_address'){
    $cust->delivery['add']['birthday']=date('Y-m-d');
    $cust->delivery['add']['passportdate']=date('Y-m-d');
}
?>
<div id="modal_add<?=$key?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h3 class="modal-title"><?=$title?></h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['action'=>BASEURL.'/lk/userinfo','method'=>'post']); ?>
                <div style="margin:20px 0; padding:10px;">
                    <div style="width:100%; color:black;font-weight: 600; text-align: center;">Получатель:</div>
                    <?=$form->field($cust,'delivery['.$key.'][lastname]' )->label('Фамилия')?>
                    <?=$form->field($cust, 'delivery['.$key.'][name]')->label('Имя')?>
                    <?=$form->field($cust,'delivery['.$key.'][secondname]' )->label('Отчество')?>
                    <?=$form->field($cust,'delivery['.$key.'][birthday]' )->label('Дата рождения')
                        ->widget(\kartik\date\DatePicker::className(), [
                            'options' => ['placeholder' => 'Выберите дату ...'],
                            'language'=>'ru',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ])?>
                </div>
                <div style="margin:20px 0; padding:10px;">
                    <div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>
                    <?=$form->field($cust,'delivery['.$key.'][passportser]' )->label('Серия')?>
                    <?=$form->field($cust,'delivery['.$key.'][passportnum]' )->label('Номер')?>
                    <?=$form->field($cust,'delivery['.$key.'][passportwhere]' )->label('Кем выдан')?>
                    <?=$form->field($cust,'delivery['.$key.'][passportdate]' )->label('Когда выдан')
                        ->widget(\kartik\date\DatePicker::className(), [
                            'options' => ['placeholder' => 'Выберите дату ...'],
                            'language'=>'ru',
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ],
                        ])?>
                </div>
                <div style="margin:20px 0; padding:10px;">
                    <div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>
                    <?=$form->field($cust,'delivery['.$key.'][postcode]' )->label('Почтовый индекс')?>
                    <div class="cstate">
                        <div class="inp">
                            <?=$form->field($cust,'delivery['.$key.'][country]')->label('Страна')->textInput(['data-name'=>'country','id'=>'deliv'.$key])?>
                        </div>
                        <div class="inp">
                            <?=$form->field($cust,'delivery['.$key.'][state]' )->label('Регион')->textInput(['data-name'=>'state','id'=>'deliv'.$key])?>
                        </div>
                    </div>
                    <?=$form->field($cust,'delivery['.$key.'][city]' )->label('Город')?>
                    <?=$form->field($cust,'delivery['.$key.'][address]' )->label('Адрес')?>
                </div>
                <div class="form-group">
                    <?=Html::submitButton('Сохранить', ['class' => 'button', 'name' => 'save_lk', 'value'=>$value])?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>