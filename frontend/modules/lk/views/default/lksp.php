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
    $form = ActiveForm::begin(['action' => BASEURL . '/lk/', 'method' => 'post']);
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


<script>
    $(document).on('ready', function(){
        $cstate = [];
        $idcountry='';
        $('#state-drop').remove();
        $.ajax({
            type: "GET",
            url: "/site/countryrequest",
            data: '',
            async:false,
            dataType: "json",
            success: function (out) {
                $inner = '';
                $.each(
                    out.response.items, function () {
                        $inner += '<li data-country="' + this.id + '" id="country">' + this.title + '</li>';
                    });
                $check = $('[data-name="country"]').attr('value');
                $.each(out.response.items, function () {
                    if (this.title == $check) {
                        $idcountry = this.id;
                    }
                });
                $('[data-name=country]').after('<ul class="dropdown-menu" data-name="' + $(this).attr('id') + '" id="country-drop" aria-labelledby="dropdownMenu1">' + $inner + '</ul>');
                $('[data-name=country]').attr('autocomplete', 'off');
                idnum = '';
                $('.cstate').each(function (i, item) {
                    $check = $(this).find('[data-name=country]').val();
                    $(this).find('[data-name=state]').each(function(index,item){
                        idnum = this.getAttribute('id');
                        $.each(out.response.items, function () {
                            if (this.title == $check) {
                                $idcountry = this.id;

                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: "/site/zonesrequest",
                            async: false,
                            data: 'id=' + $idcountry,
                            dataType: "json",
                            success: function (out2) {
                                $inner = '';
                                $.each(out2.response.items, function () {
                                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                                });
                                //
                                $('[id='+idnum+']').after('<ul class="dropdown-menu state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                                $('[id='+idnum+']').attr('autocomplete', 'off');
                            }
                        });
                    });
                });
            }
        });
    });
    $(document).on('click focus', '[data-name=country]', function () {
        $(this).parent().filter('.state-drop').remove();
        $(this).siblings().filter('#country-drop').show();
    });
    $(document).on('click', '#country', function () {
        $inid=$(this).parent().siblings().filter('[data-name=country]').attr('id');
        $('[data-name=state][id='+$inid+']').val('');
        $(this).parent().siblings().filter('[data-name=country]').val($(this).text());
        $('[id='+$inid+']').attr('data-country', this.getAttribute('country'));
        $(this).parent().filter('#country-drop').hide();
        $(this).parent().filter('.state-drop').remove();
        $(this).parent().siblings().filter('.state-drop').remove();
        $(this).siblings().filter('.state-drop').remove();
        $('.state-drop').remove();
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
                $('.state-drop').remove();
                $(this).parent().filter('.state-drop').remove();
                $(this).parent().siblings().filter('.state-drop').remove();
                $('[id='+$inid+']').after('<ul class="dropdown-menu state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                $('[id='+$inid+']').attr('autocomplete', 'off');
            }
        });
    });
    $(document).on('click focus', '[data-name=state]', function () {
        $(this).siblings().filter('.state-drop').show();
    });
    $(document).on('click', '#state', function () {
        $inid=$(this).parent().siblings().filter('[data-name=state]').attr('id');
        $('[id='+$inid+']').attr('data-state', this.getAttribute('state'));
        $(this).parent().siblings().filter('[data-name=state]').val($(this).text());
        $(this).parent().filter('.state-drop').hide();
        $('.state-drop').hide();
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
</script>
