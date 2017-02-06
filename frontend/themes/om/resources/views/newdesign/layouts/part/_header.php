<?php
use yii\bootstrap\Modal;
use yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;
?>
<!-- Header -->
<header>
    <div class="header-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-2 col-xs-4">
                    <!-- Header Logo -->
                    <?php
                    if (($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                        $name = $namecustom;
                    } else {
                        $name = Yii::$app->params['constantapp']['APP_NAME'];
                    }
                    ?>

                    <?php if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                    } else {
                        $logotype = '';
                    }
                    ?>
                    <div  class="logo"><a title="<?=Yii::$app->params['constantapp']['APP_NAME']?>" href="/"><img alt="Magento Commerce" src="/images/logo/logo-om-new.png"></a></div>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-6 col-sm-5 col-xs-8 toplinks">
                    <div class="links">
                        <div>
                            <a  rel="nofollow"  href="/selectedproduct">Избранные</a>
                        </div>
                        <?php
                        if(Yii::$app->user->isGuest){ ?>
                            <div>
                                <a  rel="nofollow"  href="/signup"><span class="hidden-xs">Регистрация</span></a>
                            </div>
                            <div>
                                <a  rel="nofollow" data-toggle="modal" data-target="#authform" href="#"><span class="hidden-xs">Вход</span></a>
                            </div>
                        <?php } else{ ?>
                            <div>
                                <a rel="nofollow"  href="/lk/"><span class="hidden-xs">Профиль</span></a>
                            </div>
                            <div>
                                <a  rel="nofollow" href="/logout" data-method="post"><span class="hidden-xs">Выход</span>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?=$this->render('_header-modal')?>
                <div class="col-lg-4 col-sm-5 col-xs-12 right_menu">
                    <div class="menu_top">
                        <div class="top-cart-contain pull-right">
                            <!-- Top Cart -->
                            <div class="mini-cart">
                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a href="#">Корзина <span class="cart-count">0</span></a></div>
                                <div>
                                    <div class="top-cart-content">
                                        <div class="block-subtitle">
                                            <div class="top-subtotal">
                                                Товары: <span class="cart-count">0</span> <span class="price" id="total-price-cart">$259.99</span>
                                            </div>
                                            <div class="pull-right">
                                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
                                                    <a href="/cart">Моя корзина <span class="cart-count">0</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="mini-products-list" id="cart-sidebar">

                                        </ul>
                                        <div class="actions">
<!--                                            <button class="btn-checkout" title="Checkout" type="button"><span>Checkout</span></button>-->
                                            <a href="/cart" class="view-cart" ><span>Перейти к корзине</span></a> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>