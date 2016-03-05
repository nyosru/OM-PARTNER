<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
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


$this -> title = 'Личный кабинет';

//echo '<pre>';
//print_r($cust);
//echo '</pre>';
//die();
echo '<div class="user-profile"><div class="lable-profile">Информация о пользователе</div>';
$form=ActiveForm::begin(['method'=>'post']);
//echo '<input type="hidden" name="profile-id" value="userinfo"/>';
echo $form->field($cust,'lastname')->label('Фамилия: ');
echo $form->field($cust,'name')->label('Имя: ');
echo $form->field($cust,'secondname')->label('Отчество: ');
echo $form->field($cust,'email')->label('E-mail: ');
echo $form->field($cust,'phone')->label('Телефон: ');
echo $form->field($cust,'fax')->label('Факс: ');
echo '</div><div class="user-profile">';
echo '<div class="lable-profile">Информация для доставки товара</div>';
foreach($cust['delivery'] as $key=>$value){
    echo '<div class="profile_address'.$key.'" style="overflow:hidden; position:relative;margin-bottom:30px;"><div style="text-align:center;font-weight:600;">Адрес доставки '.($key+1).':</div>';
    echo $form->field($cust,'delivery['.$key.'][name]')->label('Имя получателя: ');
    echo $form->field($cust,'delivery['.$key.'][lastname]')->label('Фамилия получателя: ');
    echo $form->field($cust,'delivery['.$key.'][secondname]')->label('Отчество получателя: ');
    echo $form->field($cust,'delivery['.$key.'][birthday]')->label('Дата рождения:: ');
    echo $form->field($cust,'delivery['.$key.'][passportser]')->label('Серия паспорта: ');
    echo $form->field($cust,'delivery['.$key.'][passportnum]')->label('Номер паспорта: ');
    echo $form->field($cust,'delivery['.$key.'][passportwho]')->label('Кем выдан паспорт: ');
    echo $form->field($cust,'delivery['.$key.'][passportdate]')->label('Дата выдачи: ');
    echo $form->field($cust,'delivery['.$key.'][country]',['inputOptions'=>['data'=>['name'=>'country'], 'style'=>'color:#555;border-radius:4px;']])->label('Страна: ');
    echo $form->field($cust,'delivery['.$key.'][state]',['inputOptions'=>['data'=>['name'=>'state'],'style'=>'color:#555;border-radius:4px;']])->label('Регион: ');
    echo $form->field($cust,'delivery['.$key.'][city]')->label('Город: ');
    echo $form->field($cust,'delivery['.$key.'][postcode]')->label('Индекс: ');
    echo $form->field($cust,'delivery['.$key.'][address]')->label('Адрес: ');
    echo '</div>';
}
echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
ActiveForm::end();
echo '</div>';
?>
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
