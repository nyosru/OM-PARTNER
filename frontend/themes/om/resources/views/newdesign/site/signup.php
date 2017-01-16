<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
//$partners = new \common\models\Partners();
//$id_partners = $partners->GetId($_SERVER['HTTP_HOST']);
//$userCustomer = new \common\models\User();
//$check_part_email = $userCustomer->find()->where(['email' => 'desure85@mail.ru', 'id_partners'=>$id_partners])->asArray()->one();
$this->title = 'Регистрация';

?>
<style>
    .page-singup .krajee-datepicker{
        margin: 0;
    }
    .page-singup input.form-control {
        width: 100%;
    }
    .page-singup .dropdown-menu {
        width: 100%;
        padding: 5px 0;
    }
    .page-singup .form-group{
        position: relative;
    }
    .page-singup .dropdown-menu>li{
        padding: 0 15px;
        cursor: pointer;
    }
    .page-singup .dropdown-menu>li:hover{
        background-color: #f5f5f5;
    }
</style>
<div class="container page-singup">
    <div style="margin: 20px 0;">
        <div class="page-title">
            <h2>Я регистрируюсь на Одежда-Мастер</h2>
        </div>
        <h4>Мои персональные данные</h4>
        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
        <div class="row">
            <?= $form->field($model, 'lastname', ['options'=>['class' => 'col-md-4']])->label('Фамилия'); ?>
            <?= $form->field($model, 'name', ['options'=>['class' => 'col-md-4']])->label('Имя'); ?>
            <?= $form->field($model, 'secondname', ['options'=>['class' => 'col-md-4']])->label('Отчество'); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'pasportser', ['options'=>['class' => 'col-md-2']])->label('Паспорт серия'); ?>
            <?= $form->field($model, 'pasportnum', ['options'=>['class' => 'col-md-2']])->label('Паспорт номер'); ?>
            <?= $form->field($model, 'pasportwhere', ['options'=>['class' => 'col-md-4']])->label('Кем выдан паспорт'); ?>
            <?= $form->field($model, 'pasportdate', ['options'=>['class' => 'col-md-4']])->label('Когда выдан паспорт')->widget(\kartik\date\DatePicker::className(), [
                'options' => ['placeholder' => 'Enter event time ...'],
                'language'=>'ru',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'mm-dd-yyyy'
                ]
            ]); ?>
        </div>
        <hr><h4>Мой адрес</h4>
        <div class="row">
            <?= $form->field($model, 'country', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['data'=>['name'=>'country']]])->label('Страна'); ?>
            <?= $form->field($model, 'state', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['data'=>['name'=>'state']]])->label('Регион'); ?>
            <?= $form->field($model, 'city', ['options'=>['class' => 'col-md-4']])->label('Город'); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'postcode', ['options'=>['class' => 'col-md-2']])->label('Индекс'); ?>
            <?= $form->field($model, 'adress_street', ['options'=>['class' => 'col-md-4']])->label('Улица'); ?>
            <?= $form->field($model, 'adress_house', ['options'=>['class' => 'col-md-2']])->label('Дом'); ?>
            <?= $form->field($model, 'adress_bildings', ['options'=>['class' => 'col-md-2']])->label('Корпус'); ?>
            <?= $form->field($model, 'adress_appartment', ['options'=>['class' => 'col-md-2']])->label('Квартира'); ?>
        </div>
        <hr><h4>Мои контактные данные</h4>
        <div class="row">
            <?= $form->field($model, 'telephone', ['options'=>['class' => 'col-md-4']])->label('Телефон'); ?>
            <?= $form->field($model, 'fax', ['options'=>['class' => 'col-md-4']])->label('Факс'); ?>
            <?= $form->field($model, 'emails', ['options'=>['class' => 'col-md-4']])->label('Электронная почта'); ?>
        </div>
        <div class="row">
            <?= $form->field($model, 'spam', ['options'=>['class' => 'col-md-12']])->checkbox()->label('Уведомлять о доступных промо-кодах, подарках и спецпредложениях'); ?>
        </div>
        <hr><h4>Мой пароль</h4>
        <div class="row">
            <?= $form->field($model, 'password', ['options'=>['class' => 'col-md-4']])->passwordInput()->passwordInput()->label('Пароль') ?>
            <?= $form->field($model, 'passwordcheck', ['options'=>['class' => 'col-md-4']])->passwordInput()->passwordInput()->label('Подтвердить пароль') ?>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin: 20px 0px;">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'button', 'name' => 'signup-button']) ?>
            </div>

            <div class="col-md-12">
                <p style="font-size: 12px">
                    Нажимая кнопку &laquo;Зарегистрироваться&raquo; Вы соглащаетесть на обработку Ваших персональных
                    данных в соответствии с ФЗ РФ от 27.07.2006 №152-ФЗ(в ред. 25.07.2011 г.) "О персональных данных"
                    а также с нашей политикой конфиденциальности и условиями договора публичной оферты.
                </p>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

    <script>
    $(document).on('ready', function(){

        $.ajax({
            type: "GET",
            url: "/site/countryrequest",
            data: '',
            dataType: "json",
            success: function (out) {
                $inner = '';
                $.each(
                    out.response.items, function () {
                        $inner += '<li data-country="' + this.id + '" id="country">' + this.title + '</li>';
                    });
                $('[data-name=country]').after('<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">' + $inner + '</ul>');
                $('[data-name=country]').attr('autocomplete', 'off');
            }
        });
        var str = '';
        if ($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined) {
            str = $('[data-name="country"]').val();
        } else {
            str = $('[data-name="country"]').text();
        }
        $country = $("[data-country]");
        $check = '';
        $.each($country, function () {
            if (str == $(this).html()) {
                $check = this.getAttribute('data-country');
            }
        });
        $.ajax({
            type: "GET",
            url: "/site/zonesrequest",
            data: 'id=' + $check,
            dataType: "json",
            success: function (out2) {
                $inner = '';
                $.each(out2.response.items, function () {
                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                });
                $('#state-drop').remove();
                $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                $('[data-name=state]').attr('autocomplete', 'off');
            }
        });
        $(document).on('click focus', '[data-name=country]', function () {
            $('#country-drop').show();
        });
        $(document).on('click', '#country', function () {
            $('[data-name=state]').val('');
            $('[data-name=country]').val($(this).text());
            $('[data-name=country]').attr('data-country', this.getAttribute('country'));
            $('#country-drop').hide();
            $.ajax({
                type: "GET",
                url: "/site/zonesrequest",
                data: 'id=' + this.getAttribute('data-country'),
                dataType: "json",
                success: function (out2) {
                    $inner = '';
                    $.each(out2.response.items, function () {
                        $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                    });
                    $('#state-drop').remove();
                    $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                    $('[data-name=state]').attr('autocomplete', 'off');
                }
            });
        });
        $(document).on('click focus', '[data-name=state]', function () {
            $('#state-drop').show();
        });
        $(document).on('click', '#state', function () {
            $('[data-name=state]').attr('data-state', this.getAttribute('state'));
            $('[data-name=state]').val($(this).text());
            $('#state-drop').hide();
        });
        $(document).on('keyup', '[data-name=country]', function () {
            $filtCountryArr = $(this).siblings('ul').children();
            $search = this.value;
            $.each($filtCountryArr, function () {
                if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        $(document).on('keyup', '[data-name=state]', function () {
            $filtCountryArr = $(this).siblings('ul').children();
            $search = this.value;
            $.each($filtCountryArr, function () {
                if (this.textContent.toLowerCase().indexOf($search.toLowerCase()) + 1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });


    });
    </script>


