<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */
$this->title = 'Регистрация СП';
?>
    <style>
        .col-person {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ea516d;
            z-index: 9999;
            color: #FFF;
            background: #ea516d;
            font-weight: 400;
            width: 33%;
            display: inline-block;
        }
        .col-address {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #00a5a1;
            z-index: 9999;
            color: #FFF;
            background: #00a5a1;
            font-weight: 400;
            width: 33%;
            display: inline-block;
        }
        .col-contacts {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #007BC1 ;
            z-index: 9999;
            color: #FFF;
            background: #007BC1 ;
            font-weight: 400;
            width: 33%;
            display: inline-block;
            float: right;
        }
        .button-sp {
            margin: 20px 5px;
            font-weight: 400;
            font-size: 18px;
            background: #FFBF08 none repeat scroll 0% 0%;
        }
        .col-data-new-sp{
            padding: 5px 15px;
            background: #FFF;
            border-radius: 2px;
            color:#000;
            height: 90px;
            line-height: 25px;
            text-align: left;
        }
        .col-item{
            border-bottom: 1px solid #CCC;
        }
        .col-item:last-child{
            border-bottom: none;
        }
    </style>
<div style="text-align: center">
    <div class="col-person">
        Персональные данные
        <div class="col-data-new-sp">
            <div class="col-item">
                <span class="col-item-label">Имя:</span>
                <span><?= $user['name'] ?></span>
            </div>
            <div class="col-item">
                <span class="col-item-label">Отчество:</span>
                <span><?= $user['secondname'] ?></span>
            </div>
            <div class="col-item">
                <span class="col-item-label">Фамилия:</span>
                <span><?= $user['lastname'] ?></span>
            </div>
        </div>
    </div>
    <div class="col-address">
        Адрес
    <div class="col-data-new-sp">
        <div class="col-item">
            <span class="col-item-label">Город:</span>
            <span><?= $user['city'] ?></span>
        </div>
        <div class="col-item">
            <span class="col-item-label">Регион:</span>
            <span><?= $user['state'] ?></span>
        </div>
        <div class="col-item">
            <span class="col-item-label">Страна:</span>
            <span><?= $user['country'] ?></span>
        </div>
    </div>
    </div>
    <div  class="col-contacts">
        Контактные данные
    <div class="col-data-new-sp">
        <div class="col-item">
            <span class="col-item-label">Номер телефона:</span>
            <span> <?= $user['telephone'] ?></span>
        </div>
        <div class="col-item">
            <span class="col-item-label">E-mail:</span>
            <span> <?= $user['mail'] ?></span>
        </div>
    </div>
    </div>
    <div>
        <?php
        $form = \yii\bootstrap\ActiveForm::begin([
            'method'=>'post'
        ]);

        echo \yii\helpers\Html::submitButton('Подтвердить регистрацию',
            [
                'class' => 'button-sp btn',
                'name' => 'accept',
                'value'=> 'true'
                 ]);
        $form->end();
        ?>
    </div>
</div>
<?= \frontend\widgets\Alert::widget(); ?>


<?php
?>