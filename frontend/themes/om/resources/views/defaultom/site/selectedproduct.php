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
                var suppliers = new Object();

                $.ajax({
                    url: "/suppliers-lux",
                    success: function (data) {
                        suppliers.lux = data;
                    }
                });
                $.ajax({
                    url: "/suppliers-ok",
                    success: function (data) {
                        suppliers.ok  = data;
                    }
                });

                requestdata = $.ajax({
                    method: 'post',
                    url: "/site/selectedproduct",
                    async: false,
                    data: {products:$i},
                    success: function (data) {
                        $bside = $('.bside').html();
                        $('.bside').html('');
                        $.each(data, function(i,item){
                            var subImg = [];
                            if(typeof (this.subImage) != 'undefined'){
                                subImg = this.subImage;
                            }
                            if(getCookie('cardview')==1) {
                                renderProduct2(item.products, item.productsDescription,item.productsAttributes, item['productsAttributesDescr'], '',item.catpath);
                                $('[itemid = "'+item.products['products_id']+'"]').prepend('<div class="del-products" style="top: 5px; right: 10px; float: right; cursor: pointer; color: red; font-size: 25px; position: relative;z-index:25"><i  class="fa fa-times"></i></div>');
                            }else{
                                renderProduct(item.products, item.productsDescription, item.productsAttributes, item['productsAttributesDescr'], '',item.catpath,true,suppliers,subImg);
                                $('[itemid = "'+item.products['products_id']+'"]').prepend('<div class="del-products" style="top: 5px; right: 10px; float: right; position: absolute; cursor: pointer; color: red; font-size: 25px;z-index:25"><i  class="fa fa-times"></i></div>');

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
