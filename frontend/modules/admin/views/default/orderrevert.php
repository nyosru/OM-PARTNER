<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$order = unserialize($modelform['order']);
$modelform->order = $order;
$sheep = $order['ship'];
$discount = $order['discount'];
$discounttotalprice = $order['discounttotalprice'];
$paymentmethod = $order['paymentmethod'];
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
    '<th style="background: #FFBF08 none repeat scroll 0% 0%;">Причина</th>' .
    '</tr></thead><tbody>';
foreach ($order as $key => $value) {
    $positionquantityfirst = $modelform->oMOrdersProducts[$key]->products_quantity + $modelform->oMOrdersProductsSP[$key]->products_quantity;

    $positionquantity = $positionquantityfirst - $value[8]['count'];
    if ($value[6] == 'undefined') {
        $value[6] = 'Без размера';
    }
    $l1 .=
        '<tr>' .
        '<td>' . $value[0] . '</td>' .
        '<td>' . $value[1] . '</td>' .
        '<td>' . $value[6] . '</td>' .
        '<td>' . round(round($value[3]) - round($value[3]) * $discounttotalprice / 100) . '</td>' .
        '<td><img width="50%" src="/site/imagepreview?src=' . $value[5] . '">' .
        '<td>' .
        '<div>' .
        '<label class="control-label" for="partnersorders-id">Заказано: </label>' .
        '<label class="control-label">' . $positionquantityfirst . '</label>' .
        '</div>' . '<div>' .
        '<label class="control-label" for="partnersorders-id">Текущее: </label>' .
        '<label class="control-label">' . $positionquantity . '</label>' .
        '</div>' .
        '<label class="control-label">На возврат: </label>' .
        '<input value="' . $value[8]['count'] . '" name="revert[' . $key . '][count]" class="form-control"/>' .
        '</div>' .
        '</td>' .
        '<td><textarea name="revert[' . $key . '][reason]"class="form-control" type="textarea">' . $value[8]['reason'] . '</textarea></td>' .
        '</tr>';

}
$l1 .= '<tbody><tfoot><tr><td colspan="1" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= '<div class="form-group">' .
    '<label class="control-label" for="partnersorders-id">Первичная наценка</label>' .
    '<div class="control-label" for="partnersorders-id">' . $discount . '</div>' .
    '</div>';
$l1 .= '</td><td colspan="1" style="background: #FFBF08 none repeat scroll 0% 0%;">';
if (Yii::$app->params['partnersset']['paysystem']['active']) {
    foreach (Yii::$app->params['partnersset']['paysystem']['value'] as $key => $value) {
        if ($value['active'] == 1) {
            $paymentsmethod[$value['name']] = $value['name'];
        }
    }
    $modelform->order['paymentmethod'] = $paymentmethod;
    $subl1 = '<td colspan="2"  style="background: #FFBF08 none repeat scroll 0% 0%;" >';
    $subl1 .= '<div class="form-group">' .
        '<label class="control-label" for="partnersorders-id">Способ оплаты</label>' .
        '<div class="control-label" for="partnersorders-id">' . $modelform->order['paymentmethod'] . '</div>' .
        '</div>';
    $subl1 .= '</td>';
    $ordersdcol = '1';
} else {
    $ordersdcol = '3';
    $subl1 = '';
}
if (Yii::$app->params['partnersset']['transport']['active']) {
    $transport = Yii::$app->params['partnersset']['transport']['value'];
} else {
    $transport = ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция', 'active' => '1', 'wantpasport' => '0'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии', 'active' => '1', 'wantpasport' => '1'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК', 'active' => '1', 'wantpasport' => '0'], 'flat7_flat7' => ['value' => 'Почта ЕМС России', 'active' => '1', 'wantpasport' => '0']];
}
foreach ($transport as $key => $val) {
    $transportset[$key] = $val['value'];
}
$l1 .= '<div class="form-group">' .
    '<label class="control-label" for="partnersorders-id">Скидка</label>' .
    '<div class="control-label" for="partnersorders-id">' . $modelform->order['discounttotalprice'] . '</div>' .
    '</div>';
$l1 .= '</td><td colspan="' . $ordersdcol . '" style="background: #FFBF08 none repeat scroll 0% 0%;text-align: center;">';
$l1 .= '<div class="form-group">' .
    '<label class="control-label" for="partnersorders-id">Номер заказа</label>' .
    '<div class="control-label" for="partnersorders-id">' . (integer)Yii::$app->request->getQueryParam('id') . '</div>' .
    '</div>';
$l1 .= '</td>';
$l1 .= $subl1;
$l1 .= '<td colspan="2"  style="background: #FFBF08 none repeat scroll 0% 0%;" >';
$l1 .= '<div class="form-group">' .
    '<label class="control-label" for="partnersorders-id">Способ доставки</label>' .
    '<div class="control-label" for="partnersorders-id">' . $transportset[$modelform->order['ship']] . '</div>' .
    '</div>';
$l1 .= '</td>';
$l1 .= '</tr><tr class="form-group">';
$l1 .= '<td>';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</td>';
$l1 .= '<td>';
$l1 .= '</td>';
$l1 .= '</tr><tfoot>';
$l1 .= '</table>';
echo $l1;
ActiveForm::end(); ?>



