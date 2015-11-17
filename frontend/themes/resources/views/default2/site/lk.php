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


$this -> title = 'Личный кабинет';
?>


<script>
    $(document).on('ready', function() {

        $('.bside').html('');
        $.post(
            '/site/requestadress',
            { ship: 'flat1_flat1'},

            onAjaxProfileSuccessinfo
        );
        function  onAjaxProfileSuccessinfo(data) {
            $inner = '';
            data.splice(0,1);

            $.each(data, function(index){
                $tooltip = new Object();
                $tooltip['name'] = 'Допустимые символы а-я,a-z,-,пробел';
                $tooltip['secondname'] = 'Допустимые символы а-я,a-z,-,пробел';
                $tooltip['lastname'] = 'Допустимые символы а-я,a-z,-,пробел';
                $tooltip['country'] = 'Выберите из списка';
                $tooltip['state'] = 'Выберите из списка';
                $tooltip['city'] = 'Допустимые символы а-я,a-z,0-9,-,пробел';
                $tooltip['adress'] = 'Допустимые символы а-я,a-z,0-9,-,пробел,.,,';
                $tooltip['postcode'] = 'Допустимые символы 0-9, пробел';
                $tooltip['telephone'] = 'Допустимые символы 0-9,-,пробел,),(,+';
                $tooltip['pasportser'] = 'Допустимые символы 0-9, пробел';
                $tooltip['pasportnum'] = 'Допустимые символы 0-9, пробел';
                $tooltip['pasportdate'] = 'Введите в формате ГГГГ-ММ-ДД(2015-12-31)';
                $tooltip['pasportwhere'] = 'Допустимые символы а-я,a-z,0-9,-,пробел,.,,';
                $attr = Object.getOwnPropertyNames(this);
                $attrlableobj = Object.getOwnPropertyDescriptor(this, $attr).value;
                $attrlable = Object.getOwnPropertyNames($attrlableobj);
                $attrval = Object.getOwnPropertyDescriptor($attrlableobj, $attrlable).value;

                if($attr == 'pasportdate' && $attrval == '0000-00-00'){
                    $attrval = '';
                }
                if($attrval != null && $attrval  != '') {
                    $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="'+$tooltip[$attr]+'" data-placement="top" data-toggle="tooltip" data-name="'+$attr+'" class="info-item" data-name="'+$attr+'" value="' + $attrval + '"></input></div>';
                }else{
                    $inner += '<div class="' + $attr + '-item lable-info-item">' + $attrlable + ': <input title="'+$tooltip[$attr]+'" data-placement="top" data-toggle="tooltip" class="info-item" data-name="'+$attr+'" placeholder="'+$attrlable+'"></input></div>';
                }


            });
            $('.userinfo').html('');
            $('.userinfo').html($inner+'<button class="save-order2 btn btn-sm btn-info" style="bottom: 0px; position: relative; float: right;">Подтвердить заказ</button>');
            $inner +='<button class="btn btn-sm btn-info profile-orders" id="profile-orders" style="bottom: 0px; position: relative; float: right;">Оставить без изменений</button><button class="save-user-profile btn btn-sm btn-info" style="bottom: 0px; position: relative; float: right;">Сохранить</button>';
            $('.ui-dialog-titlebar').hide();
            $.ajax({
                type: 'GET',
                url: '/site/countryrequest',
                data: '',
                dataType:'json',
                success: function(out) {

                    $inner = '';
                    $.each(
                        out.response.items, function(){
                            $inner += '<li data-country="'+this.id+'" id="country">'+this.title+'</li>';
                        });
                    $('[data-name=country]').after('<ul class="dropdown-menu" id="country-drop" aria-labelledby="dropdownMenu1">'+$inner+'</ul>');
                    $('[data-name=country]').attr('autocomplete', 'off');

                }
            });
            var str = '';
            if($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined){
                str = $('[data-name="country"]').val();
            }else{
                str = $('[data-name="country"]').text();
            }

            $country = $('[data-country]');
            $check = '';

            $.each($country, function(){
                if(str == $(this).html() ) {

                    $check = this.getAttribute('data-country');
                }
            });


            $.ajax({
                type: 'GET',
                url: '/site/zonesrequest',
                data: 'id='+$check,
                dataType:'json',
                success: function(out2) {

                    $inner = '';
                    $.each(out2.response.items, function(){
                        $inner += '<li data-state="'+this.id+'" id="state">'+this.title+'</li>';
                    });
                    $('#state-drop').remove();
                    $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">'+$inner+'</ul>');
                    $('[data-name=state]').attr('autocomplete', 'off');


                }

        });
            $('.bside').append($inner);

            $(document).on('click focus', '[data-name=country]', function() {
                $('#country-drop').show();

            });
            $(document).on('click', '#country', function() {
                $('[data-name=country]').val($(this).text());
                $('[data-name=country]').attr('data-country', this.getAttribute('country'));
                $('#country-drop').hide();
                $.ajax({
                    type: 'GET',
                    url: '/site/zonesrequest',
                    data: 'id='+this.getAttribute('data-country'),
                    dataType:'json',
                    success: function(out2) {

                        $inner = '';
                        $.each(out2.response.items, function(){
                            $inner += '<li data-state="'+this.id+'" id="state">'+this.title+'</li>';
                        });
                        $('#state-drop').remove();
                        $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">'+$inner+'</ul>');
                        $('[data-name=state]').attr('autocomplete', 'off');
                    }
                });
            });
            $(document).on('click focus', '[data-name=state]', function() {
                $('#state-drop').show();

            });
            $(document).on('click', '#state', function() {
                $('[data-name=state]').attr('data-state', this.getAttribute('state'));
                $('[data-name=state]').val($(this).text());
                $('#state-drop').hide();

            });
            $(document).on('keyup', '[data-name=country]', function() {
                $filtCountryArr = $(this).siblings('ul').children();
                $search = this.value;
                $.each($filtCountryArr, function(){
                    if(this.textContent.toLowerCase().indexOf($search.toLowerCase())+1){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            });
            $(document).on('keyup', '[data-name=state]', function() {
                $filtCountryArr = $(this).siblings('ul').children();
                $search = this.value;
                $.each($filtCountryArr, function(){
                    if(this.textContent.toLowerCase().indexOf($search.toLowerCase())+1){
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
            });
        }

    });
    </script>


