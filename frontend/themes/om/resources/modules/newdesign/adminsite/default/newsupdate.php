<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Modal;

$this->title = 'Админка';

$form = ActiveForm::begin(['id' => 'news_add', 'action' => '']);
$l1 = '<div class="">';
$l1 .= $form->field($modelform, 'name')->label('Заголовок')->input('text');
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'post')->label('Текст новости')->input('text')->widget('\vova07\imperavi\Widget', [
    'settings' => [
        'verifiedTags' => ['div', 'a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'],
        'lang' => 'ru',
        'minHeight' => 200,
        'plugins' => ['fontsize', 'fontcolor', 'table']]]);
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'tegs')->label('Теги(через запятую)')->input('text');
$l1 .= '</div>';
$l1 .= '<div class="">';
$l1 .= $form->field($modelform, 'status')->label('Статус')->dropDownList(['1' => 'Опубликовать', '0' => 'Не опубликовывать']);
$l1 .= '</div>';
$l1 .= '<div class="form-group">';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</div>';
echo $l1;
ActiveForm::end();
