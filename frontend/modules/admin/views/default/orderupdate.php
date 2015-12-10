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
$l1 .= '<table class="table table-bordered table-striped"><thead>';
$l1 .=
    '<tr>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">ID товара</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Артикул</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Размер</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Цена</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Картинка</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Количество</th>' .
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Ред.</th>' .
    '</tr></thead><tbody>';
foreach ($order as $key => $value) {

    $l1 .=
        '<tr>' .
        '<td>' . $value[0] . '</td>' .
        '<td>' . $value[1] . '</td>' .
        '<td>' . (float)$value[6] . '</td>' .
        '<td>' . round(round($value[3]) - round($value[3]) * $discounttotalprice / 100) . '</td>' .
        '<td><img width="50%" src="/site/imagepreview?src=' . $value[5] . '">' .
        '<td>' .
        $form->field($modelform, 'order[' . $key . ']')->label(false)->input('text', ['value' => $value[4]]) .
        '</td>' .
        '<td><a class="fa fa-lg fa-close" style="color:red;"></a></td>' .
        '</tr>';

}
$l1 .= '<tbody><tfoot><tr><td colspan="2" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= $form->field($modelform, 'order[discount]')->label('Наценка')->input('text', ['value' => $discount]);
$l1 .= '</td><td colspan="2" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= $form->field($modelform, 'order[discounttotalprice]')->label('Скидка')->input('text', ['value' => $discounttotalprice]);
$l1 .= '</td><td colspan="3" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= $form->field($modelform, 'id')->hiddenInput()->label('Номер заказа');
$l1 .= $modelform->id . '</td>' .


    '</tr>';
$l1 .= '<tr class="form-group">';
$l1 .= '<td>';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</td>';
$l1 .= '<td>';
$l1 .= Html::submitButton('Добавить продукт', ['class' => 'btn btn-primary', 'name' => 'partners-add-button']);
$l1 .= '</td>';
$l1 .= '</tr><tfoot>';
$l1 .= '</table>';
echo $l1;
ActiveForm::end();

