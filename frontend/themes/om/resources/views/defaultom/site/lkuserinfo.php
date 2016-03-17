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
<div style="width: 100%; margin-left: -10px;">
<div class="lkprofile" style="float:left; width: 80%;">
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
            <div  style="background: #f5f5f5; position: relative;  text-align: left; padding: 0" class="panel-body">
                <?
                $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
                echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Пользователь</div>';
                echo $form->field($cust, 'id')->hiddenInput(['value' => $cust->id])->label(false);
                echo '<div style="overflow:hidden;">'.$form->field($cust, 'email',['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Email (так же является логином)').'</div>';
                echo $form->field($cust, 'lastname' ,['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Фамилия');
                echo $form->field($cust, 'name',['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Имя');
                echo $form->field($cust, 'secondname',['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Отчество');
                echo '</div><div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Адрес</div>';
                echo $form->field($cust, 'postcode', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Почтовый индекс');
                echo '<div class="cstate">'.$form->field($cust, 'country', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Страна')->textInput(['data-name'=>'country','id'=>'userinfo']);
                echo $form->field($cust, 'state', ['options'=>['class' => 'col-md-6'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Регион')->textInput(['data-name'=>'state','id'=>'userinfo']).'</div>';
                echo $form->field($cust, 'city', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Город');
                echo $form->field($cust, 'address' , ['options'=>['class' => 'col-md-6'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Адрес');
                echo $form->field($cust, 'phone' , ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Телефон');
                echo '</div><div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Паспорт</div>';
                echo $form->field($cust, 'pasportser', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Серия паспорта');
                echo $form->field($cust, 'pasportnum', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Номер паспорта');
                echo $form->field($cust, 'pasportdate', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Дата выдачи')->widget(\kartik\date\DatePicker::className(), [
                        'options' => ['placeholder' => 'Выберите дату ...'],
                        'language'=>'ru',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]]);
                echo $form->field($cust, 'pasportwhere', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Кем выдан');
                echo '</div><div class="col-md-12" style="margin: 20px 0px;">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'user', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
                echo '</div>';
                ActiveForm::end();
                ?>
            </div>
    </section>
    <section id="content2">
        <div style="background: #f5f5f5; position: relative; text-align: left; padding: 0" class="panel-body">
            <?
            $form = ActiveForm::begin(['action'=>BASEURL.'/lk?view=userinfo','method'=>'post']);
            echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Пользователь</div>';
            echo $form->field($cust, 'delivery_adress_id')->hiddenInput(['value'=>$cust->delivery_adress_id])->label(false);
            echo $form->field($cust, 'customers_lastname', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Фамилия');
            echo $form->field($cust, 'customers_firstname', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Имя');
            echo $form->field($cust, 'otchestvo', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Отчество');
            echo $form->field($cust, 'customers_email_address' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Email');
            echo $form->field($cust, 'customers_telephone', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Телефон');
            echo $form->field($cust, 'customers_fax' , ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Факс');
            echo '</div><div class="col-md-12" style="margin: 20px 0px;">';
            echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'customer', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
            echo '</div>';
            ActiveForm::end();
            ?>
        </div>
    </section>
    <section id="content3">
        <div style="background: #f5f5f5; position: relative;  text-align: left; padding: 0" class="panel-body">
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
                echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Получатель</div>';
                echo $form->field($cust,'delivery['.$i.'][lastname]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Фамилия');
                echo $form->field($cust, 'delivery['.$i.'][name]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Имя');
                echo $form->field($cust,'delivery['.$i.'][secondname]' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Отчество');
                echo $form->field($cust,'delivery['.$i.'][birthday]' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Дата рождения')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Паспорт</div>';
                echo $form->field($cust,'delivery['.$i.'][passportser]' , ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Серия');
                echo $form->field($cust,'delivery['.$i.'][passportnum]', ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Номер');
                echo $form->field($cust,'delivery['.$i.'][passportwho]' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Кем выдан');
                echo $form->field($cust,'delivery['.$i.'][passportdate]' , ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Когда выдан')->widget(\kartik\date\DatePicker::className(), [
                    'options' => ['placeholder' => 'Выберите дату ...'],
                    'language'=>'ru',
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd',
                    ]]);
                echo '</div>';
                echo '<div style="overflow: hidden"><div class="regmain" style="font-weight: 400; margin: 15px;">Адрес</div>';
                echo $form->field($cust,'delivery['.$i.'][postcode]' , ['options'=>['class' => 'col-md-2'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Почтовый индекс');
                echo '<div class="cstate">'.$form->field($cust,'delivery['.$i.'][country]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']])->label('Страна')->textInput(['data-name'=>'country','id'=>'delivs'.$i]);
                echo $form->field($cust,'delivery['.$i.'][state]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Регион')->textInput(['data-name'=>'state','id'=>'delivs'.$i]).'</div>';
                echo $form->field($cust,'delivery['.$i.'][city]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Город');
                echo $form->field($cust,'delivery['.$i.'][address]', ['options'=>['class' => 'col-md-4'], 'inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;'], 'labelOptions'=>['style'=>'font-weight:300; font-size:12px;']] )->label('Адрес');
                echo '</div>';
                echo '<div class="col-md-12" style="margin: 20px 0px;">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'address', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
                echo '</div>';
                ActiveForm::end();
            }
            else{
                echo '<div style="margin-left:15px;">Адрес доставки не выбран. Перейдите на вкладку "Адресная книга" и выберите его</div>';
            }
            ?>
        </div>
    </section>
    <section id="content4">
        <div style="background: #f5f5f5; position: relative; text-align: left;  padding-left: 15px;" class="panel-body">
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
                echo '<div class="cstate"><div class="inp">'.$form->field($cust,'delivery['.$key.'][country]')->label('Страна')->textInput(['data-name'=>'country','id'=>'deliv'.$key]).'</div>';
                echo '<div class="inp">'.$form->field($cust,'delivery['.$key.'][state]' )->label('Регион')->textInput(['data-name'=>'state','id'=>'deliv'.$key]).'</div></div>';
                echo $form->field($cust,'delivery['.$key.'][city]' )->label('Город');
                echo $form->field($cust,'delivery['.$key.'][address]' )->label('Адрес');
                echo '</div>';
                echo '<div class="form-group">';
                echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'address']);
                echo '</div>';
                ActiveForm::end();
                echo '</div></div></div></div>';
                
                echo '<div class="add_row" style="width:100%; height: 80px;line-height: 3.5;">'.
                    '<div class="add_string" style="width: 80%; float:left">'.$add_str.'</div>';
                if($cust->delivery[$key]['address_book_id']!=$cust->delivery_adress_id) {
                    echo '<div class="add_default" style="width:40px;float:right;text-align:center;color:green;">';
                    $form = ActiveForm::begin(['action' => BASEURL . '/lk?view=userinfo', 'method' => 'post']);
                    echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                    echo Html::submitButton('<i class="checkbox-overlay fa fa-check" style="background-color:transparent;color:#cccccc;border-color: #cccccc;"></i>', ['class' => 'btn btn-link', 'name' => 'save_lk', 'value' => 'addr_default', 'title' => 'Сделать этот адрес адресом доставки', 'style' => 'color: green;']);
                    echo '</div>';
                }else{
                    echo '<div class="add_default" style="width:40px;float:right;text-align:center;position:relative;" title="Этот адрес установлен как адрес доставки"><i class="checkbox-overlay fa fa-check" style="position: relative;top:15px;left:14px;"></i></div>';
                }
                echo '<div class="add_change" style="width:15px;float:right;"><a style="color: #007BC1" title="Изменить адрес" href="#modal_add'.$key.'" data-toggle="modal"><i class="fa fa-pencil"></i></a></div>';
                echo '<div class="add_del" style="width:45px;float:right;text-align:center;">';
                $form = ActiveForm::begin(['action' => BASEURL . '/lk?view=userinfo', 'method' => 'post']);
                echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                echo Html::submitButton('<i class="fa fa-times"></i>', ['class' => 'btn btn-link', 'name' => 'save_lk', 'value' => 'addr_del', 'title' => 'Удалить адрес', 'style' => 'color: #ea516d']);
                echo '</div></div>';
            }
            echo '<a href="#add_addr" class="btn btn-primary" style="height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;" data-toggle="modal">Добавить адрес</a>';
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
        <div style="background: #f5f5f5; position: relative; text-align: left; padding: 0" class="panel-body">
            Данный функционал временно не работает. Приносим свои извинения.
        </div>
    </section>
</div>
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
                                //     console.log($idcountry);
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
                           //      console.log($id);

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
//            console.log($(this).parent().siblings().filter('[data-name=country]').attr('id'));
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
            console.log($inid);
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