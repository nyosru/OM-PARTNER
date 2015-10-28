<?php

/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use frontend\controllers\ExtFunc;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
$function = new ExtFunc();
$this->title = 'Админка';

?>
    <div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back-admin">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <div class="header-catalog"><i class="fa fa-bars"></i> МЕНЮ
                </div>
                <ul id="accordion" class="accordion">
                    <li class="">
                        <div class="link settings">Настройки</div>
                    </li>
                </ul>
                <ul id="accordion" class="accordion">
                    <li class="">
                        <div class="link users">Пользователи</div>
                    </li>
                </ul>
                <ul id="accordion" class="accordion">
                    <li class="">
                        <div class="link orders">Заказы</div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back-admin">
        <div id="partners-main-right" class="bside">


            <?php
            if($exception == '200'){
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Настройки успешно сохранены',
                ]);
            }elseif($exception == '404'){
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Ошибка! Настройки не сохранены',
                ]);
            }else{

            }
            $form = ActiveForm::begin(['id' => 'partners-settings', 'action'=>'/admin/default/savesettings']);
            $path = Yii::getAlias('@app') . '/themes/';
            $templatedir = opendir($path);
            $count = 0;
            $file = readdir($templatedir);
            while ($file = readdir($templatedir)) {
                if (is_dir($path . $file) && $file !== '.' && file_exists($path . $file . '/template.xml')) {
                    $xmlinfo = simplexml_load_file($path . $file . '/template.xml');
                    $identifycate = (string)$xmlinfo->identifycate;
                    $output[$identifycate] = '<div class="template-case">';
                    $output[$identifycate] .= '<div class="template-name">' . $xmlinfo->name.'<br/>';
                    $output[$identifycate] .= $xmlinfo->autor . '</div>';
                    if (isset($xmlinfo->images->image) && count($xmlinfo->images->image) > 0) {
                        $images = [];
                        $i = 0;
                        foreach ($xmlinfo->images->image as $value) {
                            $images['items'][$i]['content'] = '<img src="/admin/default/templateimage?template=' . (string)$file . '&src=' . (string)$value->file . '"></img>';
                            $images['items'][$i]['caption'] = '<div>'.(string)$value->name.'</div>';
                            $images['items'][$i]['options'] = ['style' => 'color:black;'];
                            $i++;
                        }
                        $images['options'] = ['style' => 'color:black;', 'class' => 'template-carousel'];
                        $images['showIndicators'] = false;
                        $output[$identifycate] .= Carousel::widget($images);
                    }
                    $output[$identifycate] .= '</div>';
                    $count++;
                }
            }
            $l1 = $form->field($model, 'template')->label('Шаблон')->radioList($output);
            $l2 = $form->field($model, 'mail_counter_id')->label('Номер счетчика');
            $l2 .= $form->field($model, 'mail_counter_activated')->checkbox()->label('Включить');
            $l2 .= $form->field($model, 'yandex_counter_id')->label('Номер счетчика');
            $l2 .= $form->field($model, 'yandex_counter_activated')->checkbox()->label('Включить');
            $l3 = 'В разработке';
            ?>
            <? echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Общие(В разработке)',
                        'content' => $l1,
                        'active' => true
                    ],
                    [
                        'label' => 'Счетчики(В разработке)',
                        'content' => $l2,

                    ],
                    [
                        'label' => 'Ценовая политика(В разработке)',
                        'content' => $l3,

                    ],
                    [
                        'label' => 'Контакты(В разработке)',
                        'content' => $l3,

                    ],
                ]]); ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

<?
?>