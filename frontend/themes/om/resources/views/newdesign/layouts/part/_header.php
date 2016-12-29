<?php
use yii\bootstrap\Modal;
use yii\bootstrap\Html;
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
                    <div  class="logo"><a title="<?=Yii::$app->params['constantapp']['APP_NAME']?>" href="/"><?=$logotype?></a></div>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-6 col-sm-5 col-xs-8 toplinks">

                    <!-- Default Welcome Message -->
<!--                    <div class="welcome-msg hidden-xs">Default welcome msg! </div>-->
                    <!-- End Default Welcome Message -->
                    <div class="links">
<!--                        <div class="wishlist"><a title="My Wishlist" href="/selectedproduct"><span class="hidden-xs">Избранное</span></a></div>-->
                        <?php
                        if(Yii::$app->user->isGuest){
                            $model = new \common\models\LoginFormOM();
                            Modal::begin([
                                'id'=> 'authform',
                                'header' => 'Вход на Одежда-Мастер',
                                'toggleButton' => ['label' => 'Вход','tag'=>'a'],
                            ]);
                            $form = \yii\bootstrap\ActiveForm::begin([
                                'action' => BASEURL.'/login',
                                'id' => 'login-form'
                            ]);
                            echo $form->field($model, 'username', ['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->label('Электронная почта');
                            echo $form->field($model, 'password',['inputOptions'=>['class'=>'no-shadow-form-control', 'style'=>'height:36px;']])->passwordInput()->label('<span style="float: left;">Пароль</span><span style="float: right; text-decoration: underline;">'.Html::a('Забыли пароль?', [BASEURL . '/request-password-reset']).'</span>') ;
                            echo' <div style="color:#999;margin:1em 0">';
                            echo    Html::a('Зарегистрироваться', [BASEURL . '/signup'],  ['class'=>'btn' , 'style'=>'height: 36px; color: rgb(0, 0, 0); position: absolute; right: 30px; text-decoration: underline;' ]) ;
                            echo    Html::submitButton('Вход', ['class' => 'btn', 'name' => 'partners-settings-button', 'style'=>'height: 36px; color: rgb(255, 255, 255); position: absolute; left: 30px; background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
                            echo'</div>';
                            echo $form->field($model, 'rememberMe', ['options'=>['style'=>'margin-top:80px']])->checkbox()->label('Запомнить меня');

                            \yii\bootstrap\ActiveForm::end();

                            Modal::end();

                            echo '<a  rel="nofollow"  href="'.BASEURL.'/signup"><span style="float: left; margin: 4px;">Регистрация</span></a>';
                        }else{
                            echo '<div style="float: right;"><a  rel="nofollow" href="'.BASEURL.'/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
                            echo '<div style="float: right;"><a rel="nofollow"  href="'.BASEURL.'/lk/"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
                        }
                        ?>

                        <!-- links -->
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5 col-xs-12 right_menu">
                    <div class="menu_top">
                        <div class="top-cart-contain pull-right">
                            <!-- Top Cart -->
                            <div class="mini-cart">
                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a href="#">My Cart <span>2</span></a></div>
                                <div>
                                    <div class="top-cart-content">
                                        <div class="block-subtitle">
                                            <div class="top-subtotal">2 items, <span class="price">$259.99</span> </div>
                                            <!--top-subtotal-->
                                            <div class="pull-right">
                                                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a href="#">My Cart <span>2</span></a></div>
                                            </div>
                                            <!--pull-right-->
                                        </div>
                                        <!--block-subtitle-->
                                        <ul class="mini-products-list" id="cart-sidebar">
                                            <li class="item first">
                                                <div class="item-inner"><a class="product-image" title="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" href="product_detail.html"><img alt="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" src="/images/new/product1.jpg"></a>
                                                    <div class="product-details">
                                                        <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                                                        <!--access--> <strong>1</strong> x <span class="price">$179.99</span>
                                                        <p class="product-name"><a href="product_detail.html">Sample Product</a></p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item last">
                                                <div class="item-inner"><a class="product-image" title="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" href="product_detail.html"><img alt="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" src="/images/new/product1.jpg"></a>
                                                    <div class="product-details">
                                                        <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                                                        <!--access--> <strong>1</strong> x <span class="price">$80.00</span>
                                                        <p class="product-name"><a href="product_detail.html">Sample Product</a></p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="actions">
                                            <button class="btn-checkout" title="Checkout" type="button"><span>Checkout</span></button>
                                            <a href="#" class="view-cart" ><span>View Cart</span></a> </div>
                                        <!--actions-->
                                    </div>
                                </div>
                            </div>
                            <!-- Top Cart -->
                            <div id="ajaxconfig_info"><a href="#/"></a>
                                <input value="" type="hidden">
                                <input id="enable_module" value="1" type="hidden">
                                <input class="effect_to_cart" value="1" type="hidden">
                                <input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
                            </div>
                        </div>
                    </div>
                    <!-- Header Language -->
                    <div class="lang-curr">
                        <div class="form-language">
                            <ul class="lang">
                                <li class=""><a href="" title="English"><img src="/images/new/english.png" alt="English" /> <span>English</span></a></li>
                                <li class=""><a href="" title="Francais"><img src="/images/new/francais.png" alt="Francais" /> <span>francais</span></a></li>
                                <li class=""><a href="" title="German"><img src="/images/new/german.png" alt="German" /> <span>german</span></a></li>
                            </ul>
                        </div>
                        <div class="form-currency">
                            <ul class="currencies_list">
                                <li class=""><a class="" title="Dollar" href="#">$</a></li>
                                <li class=""><a class="" title="Euro" href="#">&euro;</a></li>
                                <li class=""><a class="" title="Pound" href="#">&pound;</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- End Header Currency -->
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
