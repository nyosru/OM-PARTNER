<label class="control-label" for="promo-code">У меня есть промо-код на скидку</label>
<div class="row">
    <div class="col-xs-8">
        <input type="text" id="promo-code" class="form-control" name="promo-code" value="<?=$coupon?>">
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
        var coupon = $('#promo-code').val();
        $.ajax({
            type: "POST",
            url: "/glavnaya/cart?coupon=1",
            data: {coupon:coupon}
        }).done(function (html) {
            $('.deliv-code').html(html);
        });
    });
JS
    , $this::POS_READY);

?>