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
//print_r($check_part_email);
$this->title = 'Регистрация';
?>
<div style="width: 80%; margin-left: 10px;">
<div class="regmain" style="font-size: 24px;margin: 0px 15px; font-weight: 300;clear:none">Я регистрируюсь на Одежда-Мастер</div>
<div class="regmain" style="font-weight: 400; margin: 15px;">Мои персональные данные</div>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
<?= $form->field($model, 'lastname', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Фамилия'); ?>
<?= $form->field($model, 'name', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Имя'); ?>
<?= $form->field($model, 'secondname', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Отчество'); ?>
    <div class="regmain" style="font-weight: 400; margin: 15px;">Мои контактные данные</div>
    <?= $form->field($model, 'pasportser', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Паспорт серия'); ?>
<?= $form->field($model, 'pasportnum', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Паспорт номер'); ?>
<?= $form->field($model, 'pasportwhere', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Кем выдан паспорт'); ?>
<?= $form->field($model, 'pasportdate', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Когда выдан паспорт')->widget(\kartik\date\DatePicker::className(), [
    'options' => ['placeholder' => 'Enter event time ...'],
    'pluginOptions' => [
        'autoclose' => true,
        'format' => 'mm-dd-yyyy'
    ]
]); ?>
<div class="regmain" style="font-weight: 400; margin: 15px;">Мой адрес</div>
<?= $form->field($model, 'country', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control','data'=>['name'=>'country'], 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Страна'); ?>
<?= $form->field($model, 'state', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control','data'=>['name'=>'state'], 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Регион'); ?>
<?= $form->field($model, 'city', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Город'); ?>
    <div class="regmain" style="font-weight: 400; margin: 15px;">Мои контактные данные</div>
    <?= $form->field($model, 'postcode', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Индекс'); ?>
<?= $form->field($model, 'adress[street]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Улица'); ?>
<?= $form->field($model, 'adress[house]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Дом'); ?>
<?= $form->field($model, 'adress[bilding]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Корпус'); ?>
<?= $form->field($model, 'adress[apartment]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Квартира'); ?>
<div class="regmain" style="font-weight: 400; margin: 15px;">Мои контактные данные</div>
<?= $form->field($model, 'telephone', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Телефон'); ?>
<?= $form->field($model, 'fax', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Факс'); ?>
<?= $form->field($model, 'logemail', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Электронная почта'); ?>

<?= $form->field($model, 'spam', ['options'=>['class' => 'col-md-12'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->checkbox()->label('Уведомлять о доступных промо-кодах, подарках и спецпредложениях'); ?>

<div class="regmain" style="font-weight: 400; margin: 15px;">Мой пароль</div>
<?= $form->field($model, 'password', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->passwordInput()->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'passwordcheck', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->passwordInput()->passwordInput()->label('Подтвердить пароль') ?>

<?= $form->field($model, 'captcha', ['options'=>['class' => 'col-md-12'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->widget(\yii\captcha\Captcha::classname(), [
                'template' => '{input}{image}',
                'options' => ['class'=>' col-md-12', 'style'=>'height: 36px; border-radius: 4px; border: 1px solid rgb(204, 204, 204);'],
    //'inputOptions'=>['class'=>'col-md-8'],
    'imageOptions'=>['class'=>'', 'style'=>'height:36px;'],
            ])->label('Введите текст на картинке') ?>

            <div class="col-md-12" style="margin: 20px 0px;">
                <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']) ?>
            </div>
    <div class="col-md-12" style="font-size: 12px">
        Нажимая кнопку &laquo;Зарегистрироваться&raquo; Вы соглащаетесть на обработку Ваших персональных данных в соответствии с ФЗ РФ от 27.07.2006 №152-ФЗ(в ред. 25.07.2011 г.) "О персональных данных"б а также с нашей политикой конфиденциальности и условиями договора публичной оферты.
    </div>
            <?php ActiveForm::end(); ?>

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

</div>
