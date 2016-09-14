<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 13.05.16
 * Time: 10:47
 */
$this->title = 'Регистрация СП';
?>
  
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