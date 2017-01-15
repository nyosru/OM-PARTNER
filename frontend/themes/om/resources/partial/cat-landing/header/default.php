<div class="row-e">
    <div class="col-1">
        <div class="header_bar" style="height: 55px;border-bottom: 1px solid rgb(204, 204, 204);">
            <div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;">
                <div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;"
                     class="cart-count badge">5
                </div>
                <a rel="nofollow" class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart"
                                                                            style="font-size: 28px; color: rgb(0, 165, 161);"></i></a>
            </div>
            <div class="header_bar_img">
                <img src="/images/logo/OM_code.png">
            </div>
        </div>
    </div>
</div>

<div class="special_header">
    <h1><?= ($header_config) ?: 'Специальное предложение' ?></h1>
</div>

<!-- banner -->
<?= \frontend\widgets\MainBanner::widget($main_banner_config); ?>
<div class="clearfix"></div>
<!-- end banner -->

<!--footer banner -->
<div class="row-e" style="margin-top: 25px">
    <div class="col-1">
        <a href="https://www.instagram.com/odezhda_master/" target="_blank"><img
                    style="display: block;max-width: 100%;height: auto;" src="/images/banners/OM_14122016_6.png"
                    alt="Топ 5 лучших товаров каждый день"></a>
    </div>
</div>
<!-- end banner -->



<div id="cat-products">
    <div class="row-e">
        <div class="col-1">
            <div class="row-e" style="padding: 15px; border-bottom: 1px solid rgb(204, 204, 204);">
                <div class="col-1-5" style="margin-top: 10px">
                    <div class="row-e">
                        <div class="col-1-3">
                            <img width="100%" src="/images/logo/low_price.png">
                        </div>
                        <div class="col-2-3 about_text">
                            Пожалуй, самые низкие цены
                        </div>
                    </div>
                </div>
                <div class="col-1-5" style="margin-top: 10px">
                    <div class="row-e">
                        <div class="col-1-3">
                            <img width="100%" src="/images/logo/orders.png">
                        </div>
                        <div class="col-2-3 about_text">
                            Нами выполненно более 1,000,000 заказов
                        </div>
                    </div>
                </div>
                <div class="col-1-5" style="margin-top: 10px">
                    <div class="row-e">
                        <div class="col-1-3">
                            <img width="100%" src="/images/logo/vipolneno.png">
                        </div>
                        <div class="col-2-3 about_text">
                            Более 25,000 товаров для вашего выбора
                        </div>
                    </div>
                </div>
                <div class="col-1-5" style="margin-top: 10px">
                    <div class="row-e">
                        <div class="col-1-3">
                            <img width="100%" src="/images/logo/novinki.png">
                        </div>
                        <div class="col-2-3 about_text">
                            Новинки каждый день
                        </div>
                    </div>
                </div>
                <div class="col-1-5" style="margin-top: 10px">
                    <div class="row-e">
                        <div class="col-1-3">
                            <img width="100%" src="/images/logo/minorder.png">

                        </div>
                        <div class="col-2-3 about_text">
                            Минимальный заказ всего от 5000 рублей
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
