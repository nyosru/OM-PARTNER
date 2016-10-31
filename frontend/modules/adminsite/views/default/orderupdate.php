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
    if ($value[6] == 'undefined') {
        $value[6] = 'Без размера';
    }
    $l1 .=
        '<tr>' .
        '<td>' . $value[0] . '</td>' .
        '<td>' . $value[1] . '</td>' .
        '<td>' . $value[6] . '</td>' .
        '<td>' . round(round($value[3]) - round($value[3]) * $discounttotalprice / 100) . '</td>' .
        '<td><img width="50%" src="' . BASEURL . '/imagepreview?src=' . $value[5] . '">' .
        '<td>' .
        $form->field($modelform, 'order[' . $key . ']')->label(false)->input('text', ['value' => $value[4]]) .
        '</td>' .
        '<td><a class="fa fa-lg fa-close" style="color:red;" href="/adminsite/default/orderupdate?id=' . Yii::$app->request->getQueryParam('id') . '&amp;position=' . $key . '&amp;action=delete"></a></td>' .
        '</tr>';

}
$l1 .= '<tbody><tfoot><tr><td colspan="1" style="background: #FFBF08 none repeat scroll 0% 0%;">';
$l1 .= 'Наценка при заказе<br/>' . $discount;
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
$modal .= '<form id="groupdiscountuser" action="/adminsite/default/usercontrol" method="post" role="form">';
$modal .= '<div class="form-group"><label>Артикул</label><input onkeydown="if(event.keyCode == 13) return false;" class="form-control model" name="model" value="" type="text">';
$modal .= Html::Button('Поиск', ['type' => 'button', 'class' => 'btn btn-primary findproduct', 'style' => 'position: relative; top: -33px; float: right;', 'name' => 'findproduct']);
$modal .= '</input></div><div class="exception"></div>' .
    '<table class="inn-table table table-bordered table-stripped" style="display:none;">' .
    '<thead>' .
    '<tr>' .
    '<th>Изображение</th>' .
    '<th>Артикул</th>' .
    '<th>Размеры</th>' .
    '<th>Количество</th>' .
    '<th>Цена, за шт</th>' .
    '</tr>' .
    '</thead>' .
    '<tbody>' .
    '</tbody>' .
    '<tfoot>' .
    '</tfoot>' .
    '</table>';
$modal .= '<div class="form-group"><input name="_csrf" value="" type="hidden">';
$modal .= '</div><div class="form-group">';
$modal .= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'percent']);
$modal .= '</div>';
$modal .= '</form>';
$modal .= '</div></div></div></div></div>';
$modal = '<span  class="btn btn-primary" data-toggle="modal" data-target="#modal-cancel-add">Добавить товар</span>' . $modal;

$l1 .= $modal;

$l1 .= '</td>';
$l1 .= '</tr><tfoot>';
$l1 .= '</table>';
echo $l1;
ActiveForm::end(); ?>
<script>
    $(document).on('click', '.findproduct', function prod_serach() {
        console.log($('.model').val());
        $.ajax({
            url: "/site/productinfobymodel",
            data: 'model=' + parseInt($('.model').val()),
            cache: false,
            async: true,
            dataType: 'json',
            success: function (data) {
                if (typeof data.exception != 'undefined') {
                    $('.exception').html(data.exception);
                    setTimeout(function () {
                        $('.exception').html('');
                    }, 2000);
                } else {
                    $('.inn-table').show();
                    $row = '';
                    $.each(data, function (key, value) {
                        if ($('.inn-table > tbody > tr[id=' + value.products.products_id + ']').length == 0) {
                            $options = '';
                            $count = 0;
                            $productset = [];
                            $.each(value.productsAttributesDescr, function (index) {
                                if (value.productsAttributes[index].quantity > 0) {
                                    $productset.push(value.productsAttributes[index]);
                                }
                            });
                            if ($productset.length > 0) {
                                $.each(value.productsAttributesDescr, function (index) {
                                    if (index == 0) {
                                        $row += '<tr id="' + value.products.products_id + '">' +
                                            '<td rowspan="' + value.productsAttributesDescr.length + '"><img width="25%" src="/site/imagepreview?src=' + value.products.products_image + '"></img></td>' +
                                            '<td rowspan="' + value.productsAttributesDescr.length + '">' + value.products.products_model +
                                            '<input type="hidden" name="new[' + value.products.products_id + '][image]" style="float: left; clear: both;" value="' + value.products.products_image + '"></input>' +
                                            '<input type="hidden" name="new[' + value.products.products_id + '][description]" style="float: left; clear: both;" value="' + value.productsDescription.products_description + '"></input>' +
                                            '<input type="hidden" name="new[' + value.products.products_id + '][name]" style="float: left; clear: both;" value="' + value.productsDescription.products_name + '"></input>' +
                                            '<input type="hidden" name="new[' + value.products.products_id + '][model]" style="float: left; clear: both;" value="' + value.products.products_model + '"></input>' +
                                            '<input type="hidden" name="new[' + value.products.products_id + '][price]" style="float: left; clear: both;" value="' + value.products.products_price + '"></input>' +
                                            '</td>' +
                                            '<td>' +
                                            '<input type="checkbox" name="new[' + value.products.products_id + '][attr][' + this.products_options_values_id + '][name]" style="float: left; clear: both;" value="' + this.products_options_values_name + '"></input>' +
                                            '<span style="float: left; padding: 0px 10px;">' + this.products_options_values_name + '</span>' +
                                            '</td>' +
                                            '<td>' +
                                            '<input class="form-control" name="new[' + value.products.products_id + '][attr][' + this.products_options_values_id + '][count]" type="text" onkeydown="if(event.keyCode == 13) return false;" />' +
                                            '</td>' +
                                            '<td name="" rowspan="' + value.productsAttributesDescr.length + '">' + value.products.products_price + '</td>' +
                                            '</tr>'
                                    } else {
                                        $row += '<tr>' +

                                            '<td>' +
                                            '<input type="checkbox" name="new[' + value.products.products_id + '][attr][' + this.products_options_values_id + '][name]" style="float: left; clear: both;" value="' + this.products_options_values_name + '"></input>' +
                                            '<span style="float: left; padding: 0px 10px;">' + this.products_options_values_name + '</span>' +
                                            '</td>' +
                                            '<td>' +
                                            '<input name="new[' + value.products.products_id + '][attr][' + this.products_options_values_id + '][count]" class="form-control" type="text" onkeydown="if(event.keyCode == 13) return false;" />' +
                                            '</td>' +

                                            '</tr>'
                                    }
                                });
                            } else {
                                $row += '<tr id="' + value.products.products_id + '">' +
                                    '<td><img width="25%" src="/site/imagepreview?src=' + value.products.products_image + '"></img></td>' +
                                    '<input type="hidden" name="new[' + value.products.products_id + '][image]" style="float: left; clear: both;" value="' + value.products.products_image + '"></input>' +
                                    '<input type="hidden" name="new[' + value.products.products_id + '][description]" style="float: left; clear: both;" value="' + value.productsDescription.products_description + '"></input>' +
                                    '<input type="hidden" name="new[' + value.products.products_id + '][name]" style="float: left; clear: both;" value="' + value.productsDescription.products_name + '"></input>' +
                                    '<input type="hidden" name="new[' + value.products.products_id + '][model]" style="float: left; clear: both;" value="' + value.products.products_model + '"></input>' +
                                    '<input type="hidden" name="new[' + value.products.products_id + '][price]" style="float: left; clear: both;" value="' + value.products.products_price + '"></input>' +
                                    '<td>' + value.products.products_model + '</td>' +
                                    '<td>' +
                                    '<input type="checkbox" name="new[' + value.products.products_id + '][attr][undefined][name]" style="float: left; clear: both;" value="undefined" />' +
                                    '<span style="float: left; padding: 0px 10px;">Без размера</span>' +
                                    '</td>' +
                                    '<td>' +
                                    '<input class="form-control" name="new[' + value.products.products_id + '][attr][undefined][count]" type="text" onkeydown="if(event.keyCode == 13) return false;" />' +
                                    '</td>' +
                                    '<td>' + value.products.products_price + '</td>' +
                                    '</tr>'
                            }
                            $('.inn-table > tbody').append(
                                $row
                            );
                        }
                    });

                }
            }
        });
    });
</script>





