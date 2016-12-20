<?php
$this->title = 'Избранные продукты';
?>
<script>
    $(window).on('load', function () {
        var selectedProductOm = JSON.parse(localStorage.getItem('selected-product-om'));
        if(selectedProductOm && selectedProductOm.products.length > 0) {
            var products = selectedProductOm.products;
            if (typeof (products) == 'undefined') {
                localStorage.removeItem('selected-product-om');
                localStorage.removeItem('selected-product-om-date');
            }

            $.ajax({
                method: 'post',
                url: "/site/selectedproduct",
                async: false,
                data: {products:products,html:true},
                success: function (data) {
                    $('.my-wishlist').html(data);
                }
            });
        } else {
            $('.my-wishlist').html('<p>Нет продуктов</p>');
        }
    });
</script>
<section class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class="col-main col-sm-9" style="margin-left: 0">
                <div class="my-account">
                    <div class="page-title">
                        <h2><?=$this->title?></h2>
                    </div>
                    <div class="my-wishlist clearfix">

                    </div>
                    <div class="buttons-set">
                        <p class="back_link"><a href="<?=Yii::$app->request->referrer?>"><small>« </small>Back</a></p>
                    </div>
                </div>
            </div>
            <aside class="col-right sidebar col-sm-3">
                <div class="block block-account">
                    <div class="block-title">My Account</div>
                    <div class="block-content">
                        <ul>
                            <li><a href="dashboard.html">Account Dashboard</a></li>
                            <li><a href="#">Account Information</a></li>
                            <li><a href="#">Address Book</a></li>
                            <li><a href="#">My Orders</a></li>
                            <li><a href="#">Billing Agreements</a></li>
                            <li><a href="#">Recurring Profiles</a></li>
                            <li><a href="#">My Product Reviews</a></li>
                            <li><a href="#">My Tags</a></li>
                            <li class="current"><a href="#">My Wishlist</a></li>
                            <li><a href="#">My Downloadable</a></li>
                            <li class="last"><a href="#">Newsletter Subscriptions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="block block-compare">
                    <div class="block-title ">Compare Products (2)</div>
                    <div class="block-content">
                        <ol id="compare-items">
                            <li class="item odd">
                                <input type="hidden" value="2173" class="compare-item-id">
                                <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Polyester Wrapped Cushions</a> </li>
                            <li class="item last even">
                                <input type="hidden" value="2174" class="compare-item-id">
                                <a class="btn-remove1" title="Remove This Item" href="#"></a> <a href="#" class="product-name"> Sofa with Box-Edge Down-Blend Wrapped Cushions</a> </li>
                        </ol>
                        <div class="ajax-checkout">
                            <button type="submit" title="Submit" class="button button-compare"><span>Compare</span></button>
                            <button type="submit" title="Submit" class="button button-clear"><span>Clear</span></button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>