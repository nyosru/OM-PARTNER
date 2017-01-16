<label class="control-label" for="promo-code">У меня есть промо-код на скидку</label>
<input type="text" name="promo-code" id="promo-code" class="input-text fullwidth" style="margin: 8px 0;width: 100%;" value="<?=$coupon?>">
<?php
if(!empty($model)){
    echo '<input type="hidden" value="'.$model->coupon_id.'" name="promo-code-id">';
    echo '<input type="hidden" value="" name="promo-code-sum" id="promo-code-sum">';
    echo '<input type="hidden" value="'.$model->coupon_amount.'" id="promo-code-amount">';
    echo '<input type="hidden" value="'.$model->coupon_type.'" id="promo-code-type">'; //Тип купона: P - процент, F - рубли
}
if(!empty($message["error"]))
    echo '<p class="text-danger">'.$message["error"].'</p>';
elseif(!empty($message["success"]))
    echo '<p class="text-success">'.$message["success"].'</p>';
?>
<button class="button coupon" id="coupon-send" title="Применить" type="button"><span>Применить</span></button>
<?php
$this->registerJs(<<<JS
    $('#coupon-send').on('click', function (e) {
        var coupon = $('#promo-code').val(),
            totalPrice = parseInt($('#gods-price').text()),
            cart = [],
            products = $('.input-count');
        console.log(coupon);
        $.ajax({
            type: "POST",
            url: "/glavnaya/cart?coupon=1",
            data: {coupon:coupon,totalPrice:totalPrice, _csrf: yii.getCsrfToken()}
        }).done(function (html) {
            $('.deliv-code').html(html);
            countPrice();
        });
    });
JS
    , $this::POS_READY);

?>