<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
$this->title='Данные пользователя';
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
Collapse::widget();
?>


<div id="index-card-4">Мои данные</div>
<div style="margin-bottom: 46px; padding: 0px 20px;">Эта информация никогда не будет доступна третьим лицам</div>

<?
$sorter = '';
$cs = count($tab_order);



for($i=0; $i<$cs; $i++){
    switch($i){
        case '0':
            $addclass = 'first-sorter';
            break;
        case $cs-1:
            $addclass = 'last-sorter';
            break;
        default:
            $addclass = '';
            break;
    }

//    $sorter .=Collapse::widget([
//        'items' => [
//            [
//                'label' => $tab_order[$i],
//                'content' => 's',
//                'contentOptions' => ['class' => 'user-order-row-expand'],
//                'options' => ['class' => 'user-order-row', 'style'=>'']
//            ],
//
//        ],
//        'id'=>'expanded-tab-user-'.$i,
//        'options'=>['style'=>'margin:0px;width:calc(100% /5)', 'class'=>'collapse-toggle header-sort-item active '.$addclass]
//    ]);
   // $sorter .=  '<a class="sort"  ><a aria-expanded="true"  href="#expanded-tab-user'.$i.'" data-toggle="collapse" data-parent="#expanded-tab-user'.$i.'" style="width:calc(100% /5)" class="'.$addclass. '  ">'..'</a></a>';
}
//echo '<pre>';
//    print_r($cust);
//echo '</pre>';
//die();
?>


<div id="sort-order" style="width: 100%;padding: 0px 20px;">
    <div aria-expanded="true" id="expanded-tab-user-0" class="collapse-toggle header-sort-item active first-sorter panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a aria-expanded="false" class="collapse-toggle collapsed" href="#expanded-tab-user-0-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-0">Мои данные</a>
                </h4></div>
            <div  aria-expanded="false" id="expanded-tab-user-0-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div  style="background: #f5f5f5;margin: 0px -300% 0px -100%; position: relative; left: 100%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                   <?
                   $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                   echo $form->field($cust, 'id')->hiddenInput(['value' => $cust->id])->label(false);
                   echo $form->field($cust, 'email' );
                   echo $form->field($cust, 'name' );
                   echo $form->field($cust, 'secondname' );
                   echo $form->field($cust, 'lastname' );
                   echo $form->field($cust, 'postcode' );
                   echo $form->field($cust, 'country' );
                   echo $form->field($cust, 'state' );
                   echo $form->field($cust, 'city' );
                   echo $form->field($cust, 'address' );
                   echo $form->field($cust, 'phone' );
                   echo $form->field($cust, 'pasportser' );
                   echo $form->field($cust, 'pasportnum' );
                   echo $form->field($cust, 'pasportdate' );
                   echo $form->field($cust, 'pasportwhere' );
                   echo '<div class="form-group">';
                   echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'user']);
                   echo '</div>';
                   ActiveForm::end();
                   ?>
                </div>
            </div>
        </div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-1" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-1-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-1">Данные плательщика</a>
                </h4></div>
            <div style="" id="expanded-tab-user-1-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -300% 0px -100%; position: relative; left: 0%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    <?
                    $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                    echo $form->field($cust, 'delivery_adress_id' )->hiddenInput(['value'=>$cust->delivery_adress_id])->label(false);
                    echo $form->field($cust, 'customers_lastname' );
                    echo $form->field($cust, 'customers_firstname' );
                    echo $form->field($cust, 'otchestvo' );
                    echo $form->field($cust, 'customers_email_address' );
                    echo $form->field($cust, 'customers_telephone' );
                    echo $form->field($cust, 'customers_fax' );
                    echo '<div class="form-group">';
                    echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'customer']);
                    echo '</div>';
                    ActiveForm::end();
                    ?>
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-2" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-2-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-2">Данные грузополучателя</a>
                </h4></div>
            <div style="" id="expanded-tab-user-2-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin:0px -300% 0px -100%; position: relative; left: -100%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    <?
                    $i=-1;
                    foreach($cust['delivery'] as $key=>$value){
                        if($value['address_book_id']===$cust['delivery_adress_id']){
                            $i=$key;
                            break;
                        }
                    }
                    if($i!=-1){
                        $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Получатель:</div>';
                        echo $form->field($cust,'delivery['.$i.'][lastname]' )->label('Фамилия');
                        echo $form->field($cust, 'delivery['.$i.'][name]')->label('Имя');
                        echo $form->field($cust,'delivery['.$i.'][secondname]' )->label('Отчество');
                        echo $form->field($cust,'delivery['.$i.'][birthday]' )->label('Дата рождения');
                        echo '</div>';
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>';
                        echo $form->field($cust,'delivery['.$i.'][passportser]' )->label('Серия');
                        echo $form->field($cust,'delivery['.$i.'][passportnum]' )->label('Номер');
                        echo $form->field($cust,'delivery['.$i.'][passportwho]' )->label('Кем выдан');
                        echo $form->field($cust,'delivery['.$i.'][passportdate]' )->label('Когда выдан');
                        echo '</div>';
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>';
                        echo $form->field($cust,'delivery['.$i.'][postcode]' )->label('Почтовый индекс');
                        echo $form->field($cust,'delivery['.$i.'][country]')->label('Страна')->textInput(['data-name'=>'country']);
                        echo $form->field($cust,'delivery['.$i.'][state]' )->label('Регион')->textInput(['data-name'=>'state']);
                        echo $form->field($cust,'delivery['.$i.'][city]' )->label('Город');
                        echo $form->field($cust,'delivery['.$i.'][address]' )->label('Адрес');
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'address']);
                        echo '</div>';
                        ActiveForm::end();
                    }
                    ?>
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-3" class="collapse-toggle header-sort-item active panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-3-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-3">Адресная книга</a>
                </h4></div>
            <div style="" id="expanded-tab-user-3-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin: 0px -300% 0px -100%; position: relative; left: -200%; text-align: left; border: 1px solid rgb(204, 204, 204); border-radius: 4px; padding: 10px;" class="panel-body">
                    <?
                    foreach($cust['delivery'] as $key=>$value){
                        $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Получатель:</div>';
                        echo $form->field($cust,'delivery['.$key.'][lastname]' )->label('Фамилия');
                        echo $form->field($cust, 'delivery['.$key.'][name]')->label('Имя');
                        echo $form->field($cust,'delivery['.$key.'][secondname]' )->label('Отчество');
                        echo $form->field($cust,'delivery['.$key.'][birthday]' )->label('Дата рождения');
                        echo '</div>';
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>';
                        echo $form->field($cust,'delivery['.$key.'][passportser]' )->label('Серия');
                        echo $form->field($cust,'delivery['.$key.'][passportnum]' )->label('Номер');
                        echo $form->field($cust,'delivery['.$key.'][passportwho]' )->label('Кем выдан');
                        echo $form->field($cust,'delivery['.$key.'][passportdate]' )->label('Когда выдан');
                        echo '</div>';
                        echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>';
                        echo $form->field($cust,'delivery['.$key.'][postcode]' )->label('Почтовый индекс');
                        echo $form->field($cust,'delivery['.$key.'][country]')->label('Страна')->textInput(['data-name'=>'country']);
                        echo $form->field($cust,'delivery['.$key.'][state]' )->label('Регион')->textInput(['data-name'=>'state']);
                        echo $form->field($cust,'delivery['.$key.'][city]' )->label('Город');
                        echo $form->field($cust,'delivery['.$key.'][address]' )->label('Адрес');
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'address']);
                        echo '</div>';
                        ActiveForm::end();
                    }
                    ?>
                </div>
            </div></div>
    </div>
    <div aria-expanded="true" id="expanded-tab-user-4" class="collapse-toggle header-sort-item active last-sorter panel-group collapse in" style="margin: 0px; width: calc(100% / 5); border: medium none; box-shadow: none; background: transparent none repeat scroll 0% 0%;">
        <div class="user-order-row panel panel-default" style=""><div style="border: 1px solid rgb(204, 204, 204);" class="panel-heading"><h4 class="panel-title"><a class="collapse-toggle" href="#expanded-tab-user-4-collapse1" data-toggle="collapse" data-parent="#expanded-tab-user-4">Сменить пароль</a>
                </h4></div>
            <div style="" id="expanded-tab-user-4-collapse1" class="user-order-row-expand panel-collapse collapse">
                <div style="background: #f5f5f5;margin:0px -300% 0px -100%; position: relative; left: -300%; text-align: left; padding: 10px 0px;" class="panel-body">
                    пароль
                </div>
            </div></div>
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

<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user0" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло0-->
<!--    </div>-->
<!--</div>-->
<!---->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user1" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло1-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user2" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло2-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user3" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло3-->
<!--    </div>-->
<!--</div>-->
<!--<div style="position: absolute; width: 100%;" aria-expanded="false" id="#expanded-tab-user4" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло4-->
<!--    </div>-->
<!--</div>-->
<!--<div style="height: 0px;" aria-expanded="false" id="#expanded-tab-user5" class="user-order-row-expand panel-collapse collapse">-->
<!--    <div class="panel-body">-->
<!--        Хэлло5-->
<!--    </div>-->
<!--</div>-->