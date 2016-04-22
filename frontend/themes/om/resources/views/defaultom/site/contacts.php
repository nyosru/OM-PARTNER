<?php
use yii\filters\AccessControl;
use yii\web\User;
use dosamigos\ckeditor\CKEditorInline;
use common\models\PartnersUsersInfo;
use common\models\AddressBook;

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
use common\models\PartnersConfig;
use yii\jui\Slider;

$this->title = 'Контакты';
?>

<div style=" text-align: justify; padding: 10px;"><i>Уважаемые клиенты! Используя приведенные ниже возможности
                        Вы можете проконсультироваться по всем вопросам работы сайта, проведения оплаты, отгрузки
                        товара. Обращаем Ваше внимание, что специалисты контактного центра "Одежда-Мастер" работают по
                        графику: пн-пт с 9-00 до 18-00. Письменные обращения принимаются 24 часа в сутки, 7 дней в
                        неделю. Письменные обращения, поступившие в нерабочее время, или в выходные дни, будут
                        рассмотрены в ближайший рабочий день. <b>Обращаем Ваше внимание</b> - для качественной обработки
                        Ваших запросов понадобится информация о Вашем заказе(дата, номер) из вашего личного
                        кабинета.<br>Администрация "Одежда-Мастер" будет признательна Вам за предложения по улучшению
                        нашей работы и объективные отзывы о работе сотрудников Контактного Центра.</i></div>
<div style="float: left;margin-top: 20px; width: 30%;">
<table border="0">
    <tr>
        <td width="100" align="center"><i class="fa fa-phone-square " style="font-size: 50px; color: rgb(0, 165, 161); text-shadow: 1px 1px 1px rgb(204, 204, 204);"></i></td>
        <td style="font-size: 16px"><b>Телефон горячей линии:</b>

            <div class="greenContact">+7&nbsp;(495)&nbsp;204-1583</div>
        </td>
    </tr>
    <tr>
        <td align="center"><i class="fa fa-skype" style="font-size: 50px; color: rgb(0, 165, 161); text-shadow: 1px 1px 1px rgb(204, 204, 204);"></i></td>
        <td style="font-size: 16px"><b>Skype:</b><br><a href="skype:odezhda-master1?chat"
                                                        class="greenContact">odezhda-master1</a>
        </td>
    </tr>
    <tr>
        <td align="center"><i class="fa fa-phone-square " style="font-size: 50px; color: rgb(0, 165, 161); text-shadow: 1px 1px 1px rgb(204, 204, 204);"></i></td>
        <td style="font-size: 16px"><b>Для клиентов из Москвы и МО</b>

            <div class="greenContact">+7&nbsp;(910)&nbsp;996-0134</div>
        </td>
    </tr>
</table>
    </div>
<div style="float: left;margin-top: 20px;width: 70%;">

    <?php

    $form = ActiveForm::begin([
      'method'=>'post'
    ]);

    echo $form->field($model,'to')->dropDownList(
        $to, ['prompt'=>'Выберите...']
        )->label('Письмо в');
    if(Yii::$app->user->isGuest) {
        echo $form->field($model, 'name')->label('Имя');
        echo $form->field($model, 'email')->label('e-mail');
    }
    echo $form->field($model,'subject')->label('Тема обращения');
    echo $form->field($model,'body')->textarea()->label('Сообщение');
    echo Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'save_lk', 'value'=>'user', 'style'=>'height: 36px; color: rgb(255, 255, 255);background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
    ActiveForm::end();

    if($result){
        echo    '<div>'.$result.'</div>';
    }
    ?>
        <div class="to"></div>

</div>
<?

                 if (Yii::$app->params['partnersset']['googlemap']['value'] && Yii::$app->params['partnersset']['googlemap']['active'] == 1) {
                    ?>
                    <div  class = "contacts-googlemap">
                        <div class = "contacts-googlemap-name">
                            Карта  (Google) </div>
                        <div> <iframe src="https://www.google.com/maps/d/embed?mid=<?= Yii::$app->params['partnersset']['googlemap']['value']?>" width="810" height="400"></iframe>            </div>
                    </div>
                    <?
                }
            if (Yii::$app->params['partnersset']['yandexmap']['value'] && Yii::$app->params['partnersset']['yandexmap']['active'] == 1) {
                ?>
                <div  class = "contacts-yandexmap">
                    <div class = "contacts-yandexmap-name">
                        Карта  (Yandex) </div>
                    <div>   <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?= Yii::$app->params['partnersset']['yandexmap']['value'] ?>&width=810&height=400&lang=ru_RU&sourceType=constructor"></script>
                    </div>
                </div>
                <?
            }
         ?>
