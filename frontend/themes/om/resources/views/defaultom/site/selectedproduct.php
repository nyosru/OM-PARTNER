<?php

$this -> title = 'Избранные продукты';

?>

    <script>
        $(document).on('ready', function () {
             $amount_prod = 0;
            $innerhtml = '';
            if (JSON.parse(localStorage.getItem('selected-product-om'))) {
                $item = JSON.parse(localStorage.getItem('selected-product-om'));
                $i = $item.products;
                if (typeof ($i) == 'undefined') {
                    localStorage.removeItem('selected-product-om');
                    localStorage.removeItem('selected-product-om-date');
                }
                $c = 0;


                $.each($i, function () {
                    var mandata = [];
                    var requestdata = [];
                   console.log( $i);
                    requestdata = $.ajax({
                        method: 'post',
                        url: "/site/product",
                        async: false,
                        data: {id: this}
                    });

                    mandata = $.ajax({
                        method: 'post',
                        url: "/site/manlist",
                        async: false,
                        data: {data: requestdata.responseJSON.product.products.manufacturers_id}
                    });
                    if(getCookie('cardview')==1) {
                            renderProduct2(requestdata.responseJSON.product.products, requestdata.responseJSON.product.productsDescription, requestdata.responseJSON.product['productsAttributes'], requestdata.responseJSON.product['productsAttributesDescr'], '')
                    }else{
                            renderProduct(requestdata.responseJSON.product.products, requestdata.responseJSON.product.productsDescription, requestdata.responseJSON.product['productsAttributes'], requestdata.responseJSON.product['productsAttributesDescr'], '')
                    }
                    $('[itemid = "'+requestdata.responseJSON.product.products.products_id+'"]').prepend('<div class="del-products" style="top: 5px; right: 10px; float: right; position: absolute; cursor: pointer; color: red; font-size: 25px;"><i  class="fa fa-times"></i></div>');
                });


            }
        });
    </script>
<?
