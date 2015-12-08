<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$order = unserialize($modelform['order']);
$sheep = $order['ship'];
$discount = $order['discount'];
$discounttotalprice = $order['discounttotalprice'];
unset($order['ship'], $order['discount'], $order['discounttotalprice'], $order['paymentmethod']);
$form = ActiveForm::begin(['id' => 'order_update', 'action' => '']);
$l1 = '';
foreach ($order as $key => $value) {
    $l1 .= '<div>ID товара: ' . $value[0] . '<br>Артикул: ' . $value[1] . '<br>Аттрибут ID: ' . $value[2] . '<br>Цена: ' .
        (float)($value[3] - $value[3] * $discounttotalprice / 100) . '<br>Количество: ' . $value[4] . '<br>Картинка: <img src="/site/imagepreview?src=' . $value[5] . '">';

    $l1 .= '<div class="">';
    $l1 .= $form->field($modelform, 'order[' . $key . ']')->label('Количество')->input('text', ['value' => $value[4]]);
    $l1 .= '</div></div>';

}
$l1 .= $form->field($modelform, 'order[discount]')->label('Наценка')->input('text', ['value' => $discount]);
$l1 .= $form->field($modelform, 'order[discounttotalprice]')->label('Скидка')->input('text', ['value' => $discounttotalprice]);
$l1 .= $form->field($modelform, 'id')->hiddenInput()->label(false);
$l1 .= '<div class="form-group">';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</div></div>';
echo $l1;
ActiveForm::end();

