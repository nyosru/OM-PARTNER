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
$l1 .= '<tbody><tfoot><tr><td colspan="1" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= $form->field($modelform, 'order[discount]')->label('Наценка')->input('text', ['value' => $discount]);
$l1 .= '</td><td colspan="1" style="background: #FFBF08 none repeat scroll 0% 0%;">';
if (Yii::$app->params['partnersset']['paysystem']['active']) {
    foreach (Yii::$app->params['partnersset']['paysystem']['value'] as $key => $value) {
        if ($value['active'] == 1) {
            $paymentsmethod[$value['name']] = $value['name'];
        }
    }
    $modelform->order['paymentmethod'] = $paymentmethod;
    $subl1 = '<td colspan="2"  style="background: #FFBF08 none repeat scroll 0% 0%;" >';
    $subl1 .= $form->field($modelform, 'order[paymentmethod]')->label('Способ оплаты')->dropDownList($paymentsmethod);
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
$l1 .= $form->field($modelform, 'order[discounttotalprice]')->label('Скидка')->input('text', ['value' => $discounttotalprice]);
$l1 .= '</td><td colspan="' . $ordersdcol . '" style="background: #FFBF08 none repeat scroll 0% 0%;text-align: center;">';
$l1 .= $form->field($modelform, 'id')->hiddenInput()->label('Номер заказа');
$l1 .= $modelform->id . '</td>';
$l1 .= $subl1;
$l1 .= '<td colspan="2"  style="background: #FFBF08 none repeat scroll 0% 0%;" >';
$l1 .= $form->field($modelform, 'order[ship]')->label('Способ доставки')->dropDownList($transportset);
$l1 .= '</td>';
$l1 .= '</tr><tr class="form-group">';
$l1 .= '<td>';
$l1 .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'partners-settings-button']);
$l1 .= '</td>';
$l1 .= '<td>';
$modal = '<div style="display: none;" id="modal-cancel-add" class="fade modal" role="dialog" tabindex="-1">';
$modal .= '<div class="modal-dialog modal-lg">';
$modal .= '<div class="modal-content">';
$modal .= '<div class="modal-header">';
$modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
$modal .= 'Добавить товар';
$modal .= '</div>';
$modal .= '<div class="modal-body">';
$modal .= '<div></div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
$modal .= '<form id="groupdiscountuser" action="/admin/default/usercontrol" method="post" role="form">';
$modal .= '<div class="form-group"><label>Артикул</label><input class="form-control" name="model" value="" type="text"><div class="inner"></div>';
$modal .= '<div class="form-group"><input name="_csrf" value="" type="hidden">';
$modal .= '</div><div class="form-group">';
$modal .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'percent']);
$modal .= Html::Button('Поиск', ['type' => 'button', 'class' => 'btn btn-primary findproduct', 'name' => 'findproduct']);
$modal .= '</div>';
$modal .= '</form>';
$modal .= '</div></div></div></div></div></div>';
$modal = '<span  class="btn btn-primary" data-toggle="modal" data-target="#modal-cancel-add">Добавить товар</span>' . $modal;

$l1 .= $modal;

$l1 .= '</td>';
$l1 .= '</tr><tfoot>';
$l1 .= '</table>';
echo $l1;
ActiveForm::end(); ?>
<script>
    $(document).on('click', '.findproduct', function () {

        console.log($(this).parent());
        $.ajax({
            url: "/site/productinfobymodel",
            data: 'model=966776018',
            cache: false,
            async: true,
            dataType: 'json',
            success: function (data) {
                if (data[0] != 'Не найдено!') {
                    console.log('Модель не найдена');
                } else {
                    console.log(data);
                }
            }
        });
    });
</script>

