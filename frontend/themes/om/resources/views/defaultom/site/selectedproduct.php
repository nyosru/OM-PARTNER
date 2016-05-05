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
                var mandata = [];
                var requestdata = [];

                    requestdata = $.ajax({
                        method: 'post',
                        url: "/site/selectedproduct",
                        async: false,
                        data: {products:$i}
                    });

                 $.each(requestdata.responseJSON, function(){

                     if(getCookie('cardview')==1) {
                         renderProduct2(this, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], '')
                     }else{
                         renderProduct(this, this.productsDescription, this['productsAttributes'], this['productsAttributesDescr'], '')
                     }
                     $('[itemid = "'+this.products_id+'"]').prepend('<div class="del-products" style="top: 5px; right: 10px; float: right; position: absolute; cursor: pointer; color: red; font-size: 25px;"><i  class="fa fa-times"></i></div>');

                 });


                    
//

            }
        });
    </script>
<?
