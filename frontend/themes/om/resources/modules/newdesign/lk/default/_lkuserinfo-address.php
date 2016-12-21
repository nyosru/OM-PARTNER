<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<section>
    <div style="background: #f5f5f5; position: relative; text-align: left;  padding-left: 15px;" class="panel-body">
        <?php
        echo '<div style="overflow: hidden"><div style="float: right; width:45px;height: 20px;"></div>';
        echo '<div style="float: right; width:160px;">Адрес плательщика</div>';
        echo '<div style="float: right; width:160px;">Адрес доставки</div></div>';
        foreach($cust['delivery'] as $key=>$value){
            if($cust->customers_default_address_id!=$value['address_book_id']){
                $add_str='';$row='';
                $add_str=$value['postcode'].', '.$value['country'].', '.$value['state'].', '.$value['city'].', '.$value['address'];
                echo '<div id="modal_add'.$key.'" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 class="modal-title">Изменение адреса доставки</h3></div>';
                echo '<div class="modal-body">';
                $form = ActiveForm::begin(['action'=>BASEURL.'/lk/userinfo','method'=>'post']);
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
                echo $form->field($cust,'delivery['.$key.'][passportwhere]' )->label('Кем выдан');
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
                echo '</div>';
                echo '</div></div></div>';
                echo '<div class="add_row" style="width:100%;min-width: 960px; height: 80px;line-height: 3.5;"><div class="add_string" style="width: 60%; line-height: 1.5; float:left">'.$add_str.'</div>';
                echo '<div style="min-width: 380px;">';
                echo '<div class="add_del" style="width:45px;float:right;text-align:center;">';
                if($cust->delivery[$key]['address_book_id']==$cust->customers_default_address_id||$cust->delivery[$key]['address_book_id']==$cust->delivery_adress_id||$cust->delivery[$key]['address_book_id']==$cust->pay_adress_id){
                    $tit='';
                    if($cust->delivery[$key]['address_book_id']==$cust->delivery_adress_id){
                        $tit='Вы не можете удалить этот адрес, так как он установлен как адрес доставки';
                    }
                    else{
                        $tit='Вы не можете удалить этот адрес, так как он установлен как адрес плательщика';
                    }
                    echo '<div><i style="color:#cccccc; cursor: pointer;" title="'.$tit.'" class="fa fa-times"></i></div>';
                }
                else {
                    $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                    echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                    echo Html::submitButton('<i class="fa fa-times"></i>', ['class' => 'btn btn-link', 'name' => 'save_lk', 'value' => 'addr_del', 'title' => 'Удалить адрес', 'style' => 'color: #ea516d']);
                    ActiveForm::end();
                }
                echo '</div>';
                echo '<div class="add_change" style="width:15px;float:right;"><a style="color: #007BC1" title="Изменить адрес" href="#modal_add'.$key.'" data-toggle="modal"><i class="fa fa-pencil"></i></a></div>';
                if($cust->delivery[$key]['address_book_id']!=$cust->pay_adress_id) {
                    echo '<div class="add_pay" style="width:160px;float:right;color:green;">';
                    $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                    echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                    echo Html::submitButton('<i class="checkbox-overlay fa fa-check" style="background-color:transparent;color:#cccccc;border-color: #cccccc;"></i>', ['class' => 'btn btn-link', 'name' => 'save_lk', 'value' => 'add_pay', 'title' => 'Сделать этот адрес адресом плательщика', 'style' => 'color: green;']);
                    ActiveForm::end();
                    echo '</div>';
                }else{
                    echo '<div class="add_pay" style="width:160px;float:right;text-align:center;position:relative;" title="Этот адрес установлен как адрес плательщика"><i class="checkbox-overlay fa fa-check" style="position: relative;top:15px;left:14px;"></i></div>';
                }
                if($cust->delivery[$key]['address_book_id']!=$cust->delivery_adress_id) {
                    echo '<div class="add_default" style="width:160px;float:right;color:green;">';
                    $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                    echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                    echo Html::submitButton('<i class="checkbox-overlay fa fa-check" style="background-color:transparent;color:#cccccc;border-color: #cccccc;"></i>', ['class' => 'btn btn-link', 'name' => 'save_lk', 'value' => 'addr_default', 'title' => 'Сделать этот адрес адресом доставки', 'style' => 'color: green;']);
                    ActiveForm::end();
                    echo '</div>';
                }else{
                    echo '<div class="add_default" style="width:160px;float:right;text-align:center;position:relative;" title="Этот адрес установлен как адрес доставки"><i class="checkbox-overlay fa fa-check" style="position: relative;top:15px;left:14px;"></i></div>';
                }
                echo '</div></div>';
            }
        }
        echo '<a href="#add_addr" class="btn btn-primary" style="height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;" data-toggle="modal">Добавить адрес</a>';
        echo '<div id="add_addr" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button><h3 class="modal-title">Добавить адрес доставки</h3></div>';
        echo '<div class="modal-body">';
        $key=count($cust['delivery']);
        if($key>=7){
            echo 'У вас уже указано максимальное количество адресов доставки';
        }
        else {
            $cust->delivery['add']['birthday']=date('Y-m-d');
            $cust->delivery['add']['passportdate']=date('Y-m-d');
            $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
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
            echo $form->field($cust, 'delivery[add][passportwhere]')->label('Кем выдан');
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