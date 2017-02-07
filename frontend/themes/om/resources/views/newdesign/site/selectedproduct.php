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
                url: location.href,
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
            </aside>
        </div>
    </div>
</section>