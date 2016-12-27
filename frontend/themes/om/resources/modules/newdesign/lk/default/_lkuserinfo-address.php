<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .panel-address .button.active{
        background-color: #08c;
        color: #fff;
        border: 2px solid #08c;
    }
    .panel-address .button.disabled{
        cursor: no-drop;
    }
    .panel-address .button.disabled:focus,
    .panel-address .button.disabled:hover{
        border: 2px solid #eee;
        background: #fff;
        color: #333;
    }
    .panel-address .btn-group{
        width: 80px;
    }
    .panel-address .btn-group button{
        float: left;
        margin-right: 3px;
    }
</style>
<section>
    <div class="panel panel-default panel-address">
        <div class="panel-heading"><h4 style="margin: 0;">Адресная книга</h4></div>
        <table class="data-table">
                <thead>
                    <tr>
                        <th>Описание</th>
                        <th>Адрес плательщика</th>
                        <th>Адрес доставки</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cust['delivery'] as $key=>$value){ ?>
                        <?php if($cust->customers_default_address_id!=$value['address_book_id']){ ?>
                            <tr>
                                <td>
                                    <?=$this->render('_lkuserinfo-address-modal',[
                                        'cust'=>$cust,
                                        'key'=>$key,
                                        'title'=>'Изменение адреса доставки',
                                        'value'=>'address',
                                    ]) ?>
                                    <?=$value['postcode'].', '.$value['country'].', '.$value['state'].', '.$value['city'].', '.$value['address']?>
                                </td>
                                <td>
                                    <?php
                                    if($cust->delivery[$key]['address_book_id']!=$cust->delivery_adress_id) {
                                        $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                                        echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                                        echo Html::submitButton('<i class="checkbox-overlay fa fa-check"></i>', ['class' => 'add_default button', 'name' => 'save_lk', 'value' => 'addr_default', 'title' => 'Сделать этот адрес адресом доставки']);
                                        ActiveForm::end();
                                    }else{
                                        echo '<button class="add_default button active" title="Этот адрес установлен как адрес доставки"><i class="glyphicon glyphicon-ok"></i></button>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if($cust->delivery[$key]['address_book_id']!=$cust->pay_adress_id) {
                                        $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                                        echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                                        echo Html::submitButton('<i class="checkbox-overlay fa fa-check"></i>', ['class' => 'add_pay button', 'name' => 'save_lk', 'value' => 'add_pay', 'title' => 'Сделать этот адрес адресом плательщика']);
                                        ActiveForm::end();
                                    }else{
                                        echo '<button class="add_pay button active" title="Этот адрес установлен как адрес плательщика"><i class="glyphicon glyphicon-ok"></i></button>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button title="Изменить адрес" data-target="#modal_add<?=$key?>" data-toggle="modal" class="button"><i class="glyphicon glyphicon-pencil"></i></button>
                                        <?php
                                        if($cust->delivery[$key]['address_book_id']==$cust->customers_default_address_id||$cust->delivery[$key]['address_book_id']==$cust->delivery_adress_id||$cust->delivery[$key]['address_book_id']==$cust->pay_adress_id){
                                            $tit='';
                                            if($cust->delivery[$key]['address_book_id']==$cust->delivery_adress_id){
                                                $tit='Вы не можете удалить этот адрес, так как он установлен как адрес доставки';
                                            }
                                            else{
                                                $tit='Вы не можете удалить этот адрес, так как он установлен как адрес плательщика';
                                            }
                                            echo '<button class="button disabled"><i title="'.$tit.'" class="glyphicon glyphicon-remove"></i></button>';
                                        }
                                        else {
                                            $form = ActiveForm::begin(['action' => BASEURL . '/lk/userinfo', 'method' => 'post']);
                                            echo $form->field($cust, 'delivery[' . $key . '][address_book_id]', ['options' => ['style' => 'display:none;']])->hiddenInput(['value' => $cust->delivery[$key]['address_book_id']])->label(false);
                                            echo Html::submitButton('<i class="glyphicon glyphicon-remove"></i>', ['class' => 'button', 'name' => 'save_lk', 'value' => 'addr_del', 'title' => 'Удалить адрес']);
                                            ActiveForm::end();
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        <div class="panel-footer">
            <?php if(count($cust['delivery'])>=7) { ?>
                <p>У вас уже указано максимальное количество адресов доставки</p>
            <?php } else { ?>
                <button data-target="#modal_addadd" class="button" data-toggle="modal">Добавить адрес</button>
                <?=$this->render('_lkuserinfo-address-modal',[
                    'cust'=>$cust,
                    'key'=>'add',
                    'title'=>'Добавить адрес доставки',
                    'value'=>'add_address',
                ]) ?>
            <?php } ?>
        </div>
    </div>
</section>