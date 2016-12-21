<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<section>
    <div  style="background: #f5f5f5; position: relative;  text-align: left; padding: 0" class="panel-body">
        <?php
        $form = ActiveForm::begin(['method'=>'post']);
        echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">'.$title.'</div>';
        echo $form->field($cust,'delivery['.$key.'][lastname]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Фамилия');
        echo $form->field($cust,'delivery['.$key.'][name]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Имя');
        echo $form->field($cust,'delivery['.$key.'][secondname]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Отчество');
        echo $form->field($cust,'delivery['.$key.'][birthday]' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Дата рождения')->widget(\kartik\date\DatePicker::className(), [
            'options' => ['placeholder' => 'Выберите дату ...'],
            'language'=>'ru',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ]]);
        echo '</div><div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Адрес</div>';
        echo $form->field($cust,'delivery['.$key.'][postcode]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Почтовый индекс');
        echo '<div class="cstate">'.$form->field($cust,'delivery['.$key.'][country]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Страна')->textInput(['data-name'=>'country','id'=>'delivs'.$key]);
        echo $form->field($cust,'delivery['.$key.'][state]', ['options'=>['class' => 'col-md-6'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Регион')->textInput(['data-name'=>'state','id'=>'delivs'.$key]).'</div>';
        echo $form->field($cust,'delivery['.$key.'][city]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Город');
        echo $form->field($cust,'delivery['.$key.'][address]', ['options'=>['class' => 'col-md-8'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Адрес');
        echo '</div><div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Паспорт</div>';
        echo $form->field($cust,'delivery['.$key.'][passportser]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Серия');
        echo $form->field($cust,'delivery['.$key.'][passportnum]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Номер');
        echo $form->field($cust,'delivery['.$key.'][passportwhere]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Кем выдан');
        echo $form->field($cust,'delivery['.$key.'][passportdate]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Когда выдан')->widget(\kartik\date\DatePicker::className(), [
            'options' => ['placeholder' => 'Выберите дату ...'],
            'language'=>'ru',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd',
            ]]);
        echo '</div><div class="col-md-12" style="margin: 20px 0px;">';
        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'customer', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
        echo '</div>';
        ActiveForm::end();
        ?>
    </div>
</section>