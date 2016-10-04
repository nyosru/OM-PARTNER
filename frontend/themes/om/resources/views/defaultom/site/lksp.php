<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use yii\jui\Slider;
use \common\models\UserProfile;
use yii\bootstrap\Collapse;
$this->title = 'Личный кабинет';
?>
<div class="col-md-12">
    <div class="circular"><i class="mdi mdi-perm-identity"></i></div>
    <div class="" style="float: left; font-size: 24px; font-weight: 500; padding: 20px;">
        <?= $cust['userinfo']['lastname']; ?> <?= $cust['id']['name']; ?>
        <br/><span style="font-size: 18px; color: rgb(204, 204, 204);"><?= $cust['email']; ?></span>
        <br/><span
            style="font-size: 18px; color: rgb(0, 123, 193); font-weight: 300;">id: <?= $cust['id']; ?></span>
    </div>
</div>
<div class="col-md-12">
    <?php
    $form = ActiveForm::begin(['action' => BASEURL . '/lk?view=userinfo', 'method' => 'post']);
    ?>
    <div style="overflow: hidden">
        <div class="regmain" style="font-weight: 400; margin: 15px;">
            Пользователь
        </div>
        <?php
        echo $form->field($profile, 'id')->hiddenInput(['value' => $profile->id])->label(false);
        echo $form->field($profile, 'lastname', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Фамилия');
        echo $form->field($profile, 'name', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Имя');
        echo $form->field($profile, 'secondname', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Отчество');
        ?>
    </div>
    <div style="overflow: hidden">
        <div class="regmain" style="font-weight: 400; margin: 15px;">
            Адрес
        </div>
        <?php
        echo $form->field($profile, 'postcode', ['options' => ['class' => 'col-md-2'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Почтовый индекс');
        echo '<div class="cstate">' . $form->field($profile, 'country', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Страна')->textInput(['data-name' => 'country', 'id' => 'userinfo']).'</div>';
        echo  '<div class="cstate">' . $form->field($profile, 'state', ['options' => ['class' => 'col-md-6'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Регион')->textInput(['data-name' => 'state', 'id' => 'userinfo']) . '</div>';
        echo $form->field($profile, 'city', ['options' => ['class' => 'col-md-4'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Город');
        echo $form->field($profile, 'address', ['options' => ['class' => 'col-md-6'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Адрес');
        echo $form->field($profile, 'phone', ['options' => ['class' => 'col-md-2'], 'inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;'], 'labelOptions' => ['style' => 'font-weight:300; font-size:12px;']])->label('Телефон');
        ?>
    </div>
    <div style="overflow: hidden">
        <div class="regmain" style="font-weight: 400; margin: 15px;">
            Паспорт
        </div>
        <?php
        echo $form->field($profile, 'pasportser', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Серия паспорта');
        echo $form->field($profile, 'pasportnum', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Номер паспорта');
        echo $form->field($profile, 'pasportdate', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Дата выдачи')->widget(\kartik\date\DatePicker::className(), [
                'options' => ['placeholder' => 'Выберите дату ...'],
                'language'=>'ru',
                'pluginOptions' => [
                   'autoclose' => true,
                   'format' => 'yyyy-mm-dd',
               ]
        ]);
          echo $form->field($profile, 'pasportwhere', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Кем выдан');
        ?>
    </div>
    <div class="col-md-12" style="margin: 20px 0px;">
        <?php
        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_user', 'value' => 'user', 'style' => 'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>


