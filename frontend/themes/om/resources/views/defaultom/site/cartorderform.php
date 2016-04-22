<?php
echo 'В процессе';
?>
<script>
$(document).ready(function () {
    $.post(
        "/site/shipping",
        function (shipdata) {
            $inht = '';
            $.each(shipdata, function (index) {
                if (this.active == '1') {
                    $inht += '<option class="shipping-confirm-option" data-pasp="' + this.wantpasport + '" value="' + index + '">' + this.value + '</option>';
                }
            });
            $('.bside').html('<div class="shipping">Cпособ доставки <select  id="shipping-confirm"><option class="shipping-confirm-option" value=""></option>' + $inht + '</select></div>');
            $('.cart-auth').remove();
            $.post(
                "/site/paymentmethod",
                function (data) {
                    if (data != 'false') {
                        $inht = '';
                        $.each(data, function (index) {
                            if (this.active == '1') {
                                $inht += '<option class="shipping-confirm-option" value="' + this.name + '">' + this.name + '</option>';
                            }
                        });
                        $('.bside').append('<div class="shipping">Cпособ оплаты <select  id="paymentmethod"><option class="paymentmethod-option" value=""></option>' + $inht + '</select></div><div class="userinfo"></div>');
                    } else {
                        $('.bside').append('<div class="userinfo"></div>');

                    }
                }
            );
        }
    );
});


$(document).on('change', '#shipping-confirm', function () {
    $('#shipping-confirm option').filter(function (index) {
        if ($(this).val() == '') {
            return $(this)
        }
    }).remove();
    $.post(
        "/site/requestadress",
        {ship: $('#shipping-confirm option:selected')[0].getAttribute('data-pasp')},
        onAjaxSuccessinfo
    );
});
</script>