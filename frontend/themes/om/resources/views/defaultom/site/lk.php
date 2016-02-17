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
$form=ActiveForm::begin();
echo $form->field($cust[0]['userinfo'],'lastname')->label('Фамилия: ');
echo $form->field($cust[0]['userinfo'],'name')->label('Имя: ');
echo $form->field($cust[0]['userinfo'],'secondname')->label('Отчество: ');
echo $form->field($cust[0],'email')->label('E-mail: ');
echo $form->field($cust[0]['customers'],'customers_telephone')->label('Телефон: ');
echo $form->field($cust[0]['customers'],'customers_fax')->label('Факс: ');
echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
ActiveForm::end();
echo '</div>';

foreach($cust[0]['addressBook'] as $key=>$value){

    echo '<div class="profile_address'.$key.'">';
    $form=ActiveForm::begin();
    echo $form->field($value,'entry_firstname')->label('Имя получателя: ');
    echo $form->field($value,'entry_lastname')->label('Фамилия получателя: ');
    echo $form->field($value,'otchestvo')->label('Отчество получателя: ');
    echo $form->field($value,'birth_day')->label('Дата рождения:: ');
    echo $form->field($value,'pasport_seria')->label('Серия паспорта: ');
    echo $form->field($value,'pasport_nomer')->label('Номер паспорта: ');
    echo $form->field($value,'pasport_kem_vidan')->label('Кем выдан паспорт: ');
    echo $form->field($value,'pasport_kogda_vidan')->label('Дата выдачи: ');
    echo $form->field($value,'pasport_nomer')->label('Страна: ');
    echo $form->field($value,'pasport_nomer')->label('Регион: ');
    echo $form->field($value,'pasport_nomer')->label('Город: ');
    echo $form->field($value,'pasport_nomer')->label('Индекс: ');
    echo $form->field($value,'pasport_nomer')->label('Улица: ');
    echo $form->field($value,'pasport_nomer')->label('Дом: ');
    echo $form->field($value,'pasport_nomer')->label('Корпус: ');
    echo $form->field($value,'pasport_nomer')->label('Квартира: ');
    echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary']);
    ActiveForm::end();
    echo '</div>';
}
?>