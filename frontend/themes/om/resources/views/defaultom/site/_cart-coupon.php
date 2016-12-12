<label class="control-label" for="promo-code">У меня есть промо-код на скидку</label>
<div class="row">
    <div class="col-xs-8">
        <input type="text" id="promo-code" class="form-control" name="promo-code" value="<?=$coupon?>">
        <?php
        if(!empty($model)){
            echo '<input type="hidden" value="'.$model->coupon_id.'" name="promo-code-id">';
            echo '<input type="hidden" value="" name="promo-code-sum" id="promo-code-sum">';
            echo '<input type="hidden" value="'.$model->coupon_amount.'" id="promo-code-amount">';
            echo '<input type="hidden" value="'.$model->coupon_type.'" id="promo-code-type">'; //Тип купона: P - процент, F - рубли
        }
        ?>
    </div>
    <div class="col-xs-4">
        <div id="coupon-send" class="btn btn-primary btn-block">Применить</div>
    </div>
</div>
<?php
if(!empty($message["error"]))
    echo '<p class="text-danger">'.$message["error"].'</p>';
elseif(!empty($message["success"]))
    echo '<p class="text-success">'.$message["success"].'</p>';
?>
<?php
$this->registerJs(<<<JS
    $('#coupon-send').on('click', function (e) {
        var coupon = $('#promo-code').val(),
            totalPrice = parseInt($('#gods-price').text()),
            cart = [],
            products = $('.input-count');

        //$.each(products, function () {
        //    cart.push({
        //        id: $(this).data('prod'),
        //        count: $(this).val()
        //    });
        //});
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