<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<section>
    <?php $form = ActiveForm::begin(['method'=>'post']); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><h4 style="margin: 0;"><?=$title?></h4></div>
        <div class="panel-body">
        <?php
        echo '<div class="row">';
            echo $form->field($cust,'delivery['.$key.'][lastname]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Фамилия');
            echo $form->field($cust,'delivery['.$key.'][name]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Имя');
            echo $form->field($cust,'delivery['.$key.'][secondname]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Отчество');
        echo '</div>';
        echo '<div class="row">';
            if($title != 'Пользователь') {
                echo $form->field($cust, 'delivery[' . $key . '][birthday]', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['style' => ''], 'labelOptions' => ['style' => '']])->label('Дата рождения')
                    ->widget(\kartik\date\DatePicker::className(), [
                        'options' => ['placeholder' => 'Выберите дату ...'],
                        'language' => 'ru',
                        'pluginOptions' => [
                            'id' => 'birthday-' . $key,
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ],
                    ]);
            }
        echo '</div>';
        echo '<hr><h4>Адрес</h4>';
        echo '<div class="row">';
            echo $form->field($cust,'delivery['.$key.'][postcode]', ['options'=>['class' => 'col-md-3'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Почтовый индекс');
            echo $form->field($cust,'delivery['.$key.'][country]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Страна')->textInput(['data-name'=>'country','id'=>'delivs'.$key]);
            echo $form->field($cust,'delivery['.$key.'][state]', ['options'=>['class' => 'col-md-5'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Регион')->textInput(['data-name'=>'state','id'=>'delivs'.$key]);
        echo '</div>';
        echo '<div class="row">';
            echo $form->field($cust,'delivery['.$key.'][city]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Город');
            echo $form->field($cust,'delivery['.$key.'][address]', ['options'=>['class' => 'col-md-8'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Адрес');
        echo '</div>';
        if($title == 'Пользователь') {
            echo '<div class="row">';
                echo $form->field($cust, 'id')->hiddenInput(['value' => $cust->id])->label(false);
                echo $form->field($cust, 'phone', ['options' => ['class' => 'col-md-3'], 'inputOptions' => [], 'labelOptions' => []])->label('Телефон');
                echo $form->field($cust, 'customers_fax', ['options' => ['class' => 'col-md-3'], 'inputOptions' => [], 'labelOptions' => []])->label('Факс');
            echo '</div>';
        }
        echo '<hr><h4>Паспорт</h4>';
        echo '<div class="row">';
            echo $form->field($cust,'delivery['.$key.'][passportser]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Серия');
            echo $form->field($cust,'delivery['.$key.'][passportnum]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Номер');
            echo $form->field($cust,'delivery['.$key.'][passportwhere]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Кем выдан');
            echo $form->field($cust,'delivery['.$key.'][passportdate]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['style'=>''], 'labelOptions'=>['style'=>'']] )->label('Когда выдан')
                ->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ],
                ]);
        echo '</div>';
        ?>
        </div>
        <div class="panel-footer">
            <?=Html::submitButton('Сохранить', ['class' => 'button', 'name' => 'save_lk', 'value'=>$value, 'style'=>'']);?>
        </div>
    </div>
    <?php ActiveForm::end();?>
</section>