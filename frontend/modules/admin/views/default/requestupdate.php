<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Tabs;
use yii\bootstrap\Carousel;
use yii\bootstrap\Alert;
use yii\helpers\BaseHtml;
use dosamigos\ckeditor\CKEditor;
use yii\bootstrap\Modal;

$this->title = 'Запросы';
?>
<h2>Текст заявки:</h2><br>
</h1><div style="border:1px solid black; padding: 10px; margin: 20px 0"><?=$modelform->post?></div>
<h2>Комментарии:</h2>
<div style="border:1px solid black; padding: 10px; margin: 20px 0">
<?php
foreach (unserialize($modelform->comments) as $item) {
   echo $item[who].'<br>',$item[text];
}
echo '</div>';
$form = ActiveForm::begin(['id' => 'request_add', 'action' => '']);
$l1 .= '<div class="">';
    $l1 .= $form->field($modelc, 'comments[text]')->label('Новый коментарий')->input('text')->widget(CKEditor::className(), [
    'options' => ['rows' => 1],
    'preset' => 'full',
]);
    $l1 .= '</div>';
$l1 .= '<div class="form-group">';
    $l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
    $l1 .= '</div>';
echo $l1;
ActiveForm::end();