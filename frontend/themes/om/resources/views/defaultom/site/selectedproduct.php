<?php

$this -> title = 'Избранные продукты';

?>

    <script>
        $(window).on('load', function () {
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
                        data: {products:$i},
                        success: function (data) {
                            $bside = $('.bside').html();
                            $('.bside').html('');
                            $.each(data, function(i,item){

                                if(getCookie('cardview')==1) {
                                    renderProduct2(item.products, item.productsDescription,item.productsAttributes, item['productsAttributesDescr'], '',item.catpath);
                                }else{
                                     renderProduct(item.products, item.productsDescription, item.productsAttributes, item['productsAttributesDescr'], '',item.catpath);
                                }
                            });
                            $('.bside').append($bside);
                        }
                    });



                    
//

            }
        });
    </script>
<?
