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
<div class="lkprofile" style="float:left; ">
    <input id="tab1" type="radio" name="tabs" checked>
    <label for="tab1" title="Мои данные">Мои данные</label>

    <input id="tab2" type="radio" name="tabs">
    <label for="tab2" title="Данные плательщика">Данные плательщика</label>

    <input id="tab3" type="radio" name="tabs">
    <label for="tab3" title="Данные грузополучателя">Данные грузополучателя</label>

    <input id="tab4" type="radio" name="tabs">
    <label for="tab4" title="Адресная книга">Адресная книга</label>

    <input id="tab5" type="radio" name="tabs">
    <label for="tab5" title="Сменить пароль">Сменить пароль</label>
    <section id="content1">
            <div  style="background: #f5f5f5; position: relative;  text-align: left; padding: 10px;" class="panel-body">
                <?
                $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                echo '<div style="position: relative; margin: 20px 0px; padding: 10px; border: 1px solid rgb(204, 204, 204);border-radius:4px;"><div style="font-weight: 600; top: -22px; position: relative; background-color: whitesmoke; width: 140px; padding: 0px 3px; margin-bottom: -30px; font-size: 16px; color: rgb(85, 96, 144);">Пользователь</div>';
                echo $form->field($cust, 'id')->hiddenInput(['value' => $cust->id])->label(false);
                echo '<div class="inp">'.$form->field($cust, 'email' )->label('Email (так же является логином)').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'lastname' )->label('Фамилия').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'name' )->label('Имя').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'secondname' )->label('Отчество').'</div>';
                echo '</div>';
                echo '<div style="position: relative; margin: 20px 0px; padding: 10px; border: 1px solid rgb(204, 204, 204);border-radius:4px;"><div style="font-weight: 600; top: -22px; position: relative; background-color: whitesmoke; width: 70px; padding: 0px 3px; margin-bottom: -15px; font-size: 16px; color: rgb(85, 96, 144);">Адрес</div>';
                echo '<div class="inp">'.$form->field($cust, 'postcode' )->label('Почтовый индекс').'</div>';
                echo '<div class="cstate"><div class="inp">'.$form->field($cust, 'country' )->label('Страна')->textInput(['data-name'=>'country','id'=>'userinfo']).'</div>';
                echo '<div class="inp">'.$form->field($cust, 'state' )->label('Регион')->textInput(['data-name'=>'state','id'=>'userinfo']).'</div></div>';
                echo '<div class="inp">'.$form->field($cust, 'city' )->label('Город').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'address' )->label('Адрес').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'phone' )->label('Телефон').'</div>';
                echo '</div>';
                echo '<div style="position: relative; margin: 20px 0px; padding: 10px; border: 1px solid rgb(204, 204, 204);border-radius:4px;"><div style="font-weight: 600; top: -22px; position: relative; background-color: whitesmoke; width: 90px; padding: 0px 3px; margin-bottom: -15px; font-size: 16px; color: rgb(85, 96, 144);">Паспорт</div>';
                echo '<div class="inp">'.$form->field($cust, 'pasportser' )->label('Серия паспорта').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'pasportnum' )->label('Номер паспорта').'</div>';
                echo '<div class="inp">'.$form->field($cust, 'pasportdate' )->label('Дата выдачи')->widget(\kartik\date\DatePicker::className(), [
                        'options' => ['placeholder' => 'Выберите дату ...'],
                        'language'=>'ru',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]]).'</div>';
                echo '<div class="inp">'.$form->field($cust, 'pasportwhere' )->label('Кем выдан').'</div>';
                echo '</div><div class="form-group">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'user']);
                echo '</div>';
                ActiveForm::end();
                ?>
            </div>
    </section>
    <section id="content2">
        <div style="background: #f5f5f5; position: relative; text-align: left; padding: 10px;" class="panel-body">
            <?
            $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
            echo $form->field($cust, 'delivery_adress_id' )->hiddenInput(['value'=>$cust->delivery_adress_id])->label(false);
            echo $form->field($cust, 'customers_lastname' )->label('Фамилия');
            echo $form->field($cust, 'customers_firstname' )->label('Имя');
            echo $form->field($cust, 'otchestvo' )->label('Отчество');
            echo $form->field($cust, 'customers_email_address' )->label('Email');
            echo $form->field($cust, 'customers_telephone' )->label('Телефон');
            echo $form->field($cust, 'customers_fax' )->label('Факс');
            echo '<div class="form-group">';
            echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'customer']);
            echo '</div>';
            ActiveForm::end();
            ?>
        </div>
    </section>
    <section id="content3">
        <div style="background: #f5f5f5; position: relative;  text-align: left; padding: 10px;" class="panel-body">
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
                echo $form->field($cust,'delivery['.$i.'][birthday]' )->label('Дата рождения')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>';
                echo $form->field($cust,'delivery['.$i.'][passportser]' )->label('Серия');
                echo $form->field($cust,'delivery['.$i.'][passportnum]' )->label('Номер');
                echo $form->field($cust,'delivery['.$i.'][passportwho]' )->label('Кем выдан');
                echo $form->field($cust,'delivery['.$i.'][passportdate]' )->label('Когда выдан')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>';
                echo $form->field($cust,'delivery['.$i.'][postcode]' )->label('Почтовый индекс');
                echo '<div class="cstate">'.$form->field($cust,'delivery['.$i.'][country]')->label('Страна')->textInput(['data-name'=>'country','id'=>'deliv'.$i]);
                echo $form->field($cust,'delivery['.$i.'][state]' )->label('Регион')->textInput(['data-name'=>'state','id'=>'deliv'.$i]).'</div>';
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
    </section>
    <section id="content4">
        <div style="background: #f5f5f5; position: relative; text-align: left;  padding: 10px;" class="panel-body">
            <?

            foreach($cust['delivery'] as $key=>$value){
                $add_str='';$row='';
                $add_str=$value['postcode'].', '.$value['country'].', '.$value['state'].', '.$value['city'].', '.$value['address'];
                echo '<div id="modal_add'.$key.'" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 class="modal-title">Изменение адреса доставки</h3></div>';
                echo '<div class="modal-body">';
                $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Получатель:</div>';
                echo $form->field($cust,'delivery['.$key.'][lastname]' )->label('Фамилия');
                echo $form->field($cust, 'delivery['.$key.'][name]')->label('Имя');
                echo $form->field($cust,'delivery['.$key.'][secondname]' )->label('Отчество');
                echo $form->field($cust,'delivery['.$key.'][birthday]' )->label('Дата рождения')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>';
                echo $form->field($cust,'delivery['.$key.'][passportser]' )->label('Серия');
                echo $form->field($cust,'delivery['.$key.'][passportnum]' )->label('Номер');
                echo $form->field($cust,'delivery['.$key.'][passportwho]' )->label('Кем выдан');
                echo $form->field($cust,'delivery['.$key.'][passportdate]' )->label('Когда выдан')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>';
                echo $form->field($cust,'delivery['.$key.'][postcode]' )->label('Почтовый индекс');
                echo '<div class="cstate">'.$form->field($cust,'delivery['.$key.'][country]')->label('Страна')->textInput(['data-name'=>'country','id'=>'deliv'.$key]);
                echo $form->field($cust,'delivery['.$key.'][state]' )->label('Регион')->textInput(['data-name'=>'state','id'=>'deliv'.$key]).'</div>';
                echo $form->field($cust,'delivery['.$key.'][city]' )->label('Город');
                echo $form->field($cust,'delivery['.$key.'][address]' )->label('Адрес');
                echo '</div>';
                echo '<div class="form-group">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'address']);
                echo '</div>';
                ActiveForm::end();
                echo '</div></div></div></div>';
                $row='<div class="add_row" style="width:100%; height: 80px;line-height: 3.5;"><div class="add_string" style="width: 80%; float:left">'.$add_str.
                    '</div><div class="add_change" style="width:150px;float:right;"><a href="#modal_add'.$key.'" data-toggle="modal">Изменить</a></div></div>';
                echo $row;

            }
            echo '<a href="#add_addr" class="btn btn-primary" data-toggle="modal">Добавить адрес</a>';
            echo '<div id="add_addr" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 class="modal-title">Добавить адрес доставки</h3></div>';
            echo '<div class="modal-body">';
            $key=count($cust['delivery']);
            if($key>=7){
                echo 'У вас уже указано максимальное количество адресов доставки';
            }
            else {
                $cust->delivery['add']['birthday']=date('Y-m-d');;
                $cust->delivery['add']['passportdate']=date('Y-m-d');;
                $form = ActiveForm::begin(['action' => BASEURL . '/lk?view=userinfo', 'method' => 'post']);
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Получатель:</div>';
                echo $form->field($cust, 'delivery[add][lastname]')->label('Фамилия');
                echo $form->field($cust, 'delivery[add][name]')->label('Имя');
                echo $form->field($cust, 'delivery[add][secondname]')->label('Отчество');
                echo $form->field($cust, 'delivery[add][birthday]')->label('Дата рождения')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Паспорт:</div>';
                echo $form->field($cust, 'delivery[add][passportser]')->label('Серия');
                echo $form->field($cust, 'delivery[add][passportnum]')->label('Номер');
                echo $form->field($cust, 'delivery[add][passportwho]')->label('Кем выдан');
                echo $form->field($cust, 'delivery[add][passportdate]')->label('Когда выдан')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="margin:20px 0; padding:10px;"><div style="width:100%; color:black;font-weight: 600; text-align: center;">Адрес:</div>';
                echo $form->field($cust, 'delivery[add][postcode]')->label('Почтовый индекс');
                echo '<div class="cstate">'.$form->field($cust, 'delivery[add][country]')->label('Страна')->textInput(['data-name' => 'country', 'id' => 'add']);
                echo $form->field($cust, 'delivery[add][state]')->label('Регион')->textInput(['data-name' => 'state', 'id' => 'add']).'</div>';
                echo $form->field($cust, 'delivery[add][city]')->label('Город');
                echo $form->field($cust, 'delivery[add][address]')->label('Адрес');
                echo '</div>';
                echo '<div class="form-group">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value' => 'add_address']);
                echo '</div>';
                ActiveForm::end();
            }
            echo '</div></div></div></div>';
            ?>
        </div>
    </section>
    <section id="content5">
        <div style="background: #f5f5f5; position: relative; text-align: left; padding: 10px 0px;" class="panel-body">
            Данный функционал временно не работает. Приносим свои извинения.
        </div>
    </section>
</div>

<script>
    $(document).on('ready', function(){
        $cstate = [];
        $idcountry='';
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

                $('.cstate').each(function (i, item) {
                    $check = $(this).find('[data-name=country]').val();
                    $row_add = $(this).find('[data-name=state]');
                    console.log($row_add)
                    $.each(out.response.items, function () {
                        if (this.title == $check) {
                            $idcountry = this.id;
                            console.log($idcountry);
                        }
                    });
                    $.ajax({
                        type: "GET",
                        url: "/site/zonesrequest",
                        data: 'id=' + $idcountry,
                        dataType: "json",
                        success: function (out2) {
                            $inner = '';
                            $.each(out2.response.items, function () {
                                $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
                            });
                            $row_add.after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
                            $row_add.attr('autocomplete', 'off');
                        }
                    });
                });
            }
        });
    });

//        var str = '';
//        if ($('[data-name="country"]').val() != '' && $('[data-name="country"]').val() != undefined) {
//            str = $('[data-name="country"]').val();
//        } else {
//            str = $('[data-name="country"]').text();
//        }
//        $country = $("[data-country]");
//        $check = '';
//        $.each($country, function () {
//            if (str == $(this).html()) {
//                $check = this.getAttribute('data-country');
//            }
//        });
//        $check=$('[data-name="country"]').attr('value');
//        console.log($idcountry);
//        $.ajax({
//            type: "GET",
//            url: "/site/zonesrequest",
//            data: 'id=' + $idcountry,
//            dataType: "json",
//            success: function (out2) {
//                $inner = '';
//                $.each(out2.response.items, function () {
//                    $inner += '<li data-state="' + this.id + '" id="state">' + this.title + '</li>';
//                });
//                $('[data-name=state]').after('<ul class="dropdown-menu" id="state-drop" aria-labelledby="dropdownMenu2">' + $inner + '</ul>');
//                $('[data-name=state]').attr('autocomplete', 'off');
//            }
//        });
        $(document).on('click focus', '[data-name=country]', function () {
            $(this).siblings().filter('#country-drop').show();
        });
        $(document).on('click', '#country', function () {
            $('[data-name=state]').val('');
            $('[data-name=country]').val($(this).text());
            $('[data-name=country]').attr('data-country', this.getAttribute('country'));
            $(this).parent().filter('#country-drop').hide();
            $('#state-drop').remove();
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
            $(this).siblings().filter('#state-drop').show();
        });
        $(document).on('click', '#state', function () {
            $('[data-name=state]').attr('data-state', this.getAttribute('state'));
            $('[data-name=state]').val($(this).text());
            $(this).parent().filter('#state-drop').remove();
            $('#state-drop').remove();
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