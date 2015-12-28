<?php

/* @var $this yii\web\View */
?>
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


$modal .= '<div class="modal-body">';
$modal .= '<div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: center;">';
$modal .= '<div class="form-group">' .
    '<input onkeydown="if(event.keyCode == 13) return false;" class="form-control model" name="model" value="" placeholder="Введите артикул" type="text">';
$modal .= Html::Button('Поиск', ['type' => 'button', 'class' => 'btn btn-primary findproduct', 'style' => 'position: relative; top: -33px; float: right;', 'name' => 'findproduct']);
$modal .= '</input>' .
    '</div>' .
    '<div class="exception">' .
    '</div>' .
    '<table class="inn-table table table-bordered table-stripped" style="display:none;">' .
    '<thead>' .
    '<tr>' .
    '<th style="width: 25%; text-align: center;">Изображение</th>' .
    '<th style="width: 45%; text-align: center;">Артикул</th>' .
    '<th style="width: 20%; text-align: center;">Цена, за шт</th>' .
    '<th style="width: 10%; text-align: center;">Удалить</th>' .
    '</tr>' .
    '</thead>' .
    '<tbody>' .
    '</tbody>' .
    '<tfoot>' .
    '</tfoot>' .
    '</table>';
$modal .= '<div class="form-group">' .
    '<input name="_csrf" value="" type="hidden">';
$modal .= '</div>';
$modal .= '</div>';
$modal .= '</div>';
$form = ActiveForm::begin(['id' => 'partners-settings', 'action' => '/admin/default/savesettings']);

echo Tabs::widget([
    'items' => [
        [
            'label' => 'Общие',
            'content' => '',
            'active' => true
        ],
        [
            'label' => 'Рекомендуемые товары',
            'content' => $modal,

        ],
        [
            'label' => 'Баннеры',
            'content' => '',

        ]

    ]]);


echo '<div class="form-group">';
echo Html::submitButton('Сохранить', ['class' => 'box btn', 'name' => 'partners-settings-button', 'style' => 'background: snow;']);
echo '</div>';
ActiveForm::end(); ?>
<script>
    $(document).on('click', '.findproduct', function prod_serach() {
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
                                            '<td><img width="25%" src="/site/imagepreview?src=' + value.products.products_image + '"></img></td>' +
                                            '<td>' + value.products.products_model +
                                            '<input type="hidden" name="PartnersSettings[recomendedwares][value][]" style="float: left; clear: both;" value="' + value.products.products_id + '"></input>' +
                                            '</td>' +
                                            '<td>' + value.products.products_price + '</td>' +
                                            '<td><span id="' + value.products.products_id + '" class="delrow fa fa-close fa-2x" style="cursor: pointer;"></span></td>' +
                                            '</tr>'
                                    }
                                });
                            } else {
                                $row += '<tr id="' + value.products.products_id + '">' +
                                    '<td><img width="25%" src="/site/imagepreview?src=' + value.products.products_image + '"></img></td>' +
                                    '<input type="hidden" name="PartnersSettings[recomendedwares][value][]" style="float: left; clear: both;" value="' + value.products.products_id + '"></input>' +
                                    '<td>' + value.products.products_model + '</td>' +
                                    '<td>' + value.products.products_price + '</td>' +
                                    '<td><span id="' + value.products.products_id + '" class="delrow fa fa-close fa-2x" style="cursor: pointer;"></span></td>' +
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

    $(document).on('click', '.delrow', function prod_serach() {
        $(this).parent().parent().remove();
    });
</script>
