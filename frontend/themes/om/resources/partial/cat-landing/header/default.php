<div class="header-top-row">
    <div  class="col-1">
        <div class="header-top-row__info" style="justify-content: flex-start;">
            <div class="col-4-10">
                <?php if (
                    ($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE
                    &&  Yii::$app->params['partnersset']['logotype']['active'] == 1){
                    echo  str_replace('</p>', '', str_replace('<p>', '', $logotype));
                } else {
                    $logotype = '';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="header-top-row__info" style="">
            <div class="header-top-row__info__date-period">
                <span>Пн - Пт 9:00 - 19:00</span>
            </div>
            <div class="header-top-row__info__phone-number">
                <span>
                    <?php
                    if (isset(Yii::$app->params['partnersset']['contacts']['telephone']['value']) && Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1) {
                        echo Yii::$app->params['partnersset']['contacts']['telephone']['value'];
                    }
                    ?>
                </span>
            </div>
            <div class="header-top-row__info__lk">
                <span class="header-top-row__info__lk__btn">
                      <?php
                      if (Yii::$app->user->isGuest) {
                          echo '<div style="float: right;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i>';
                          $model = new \common\models\LoginFormOM();
                          \yii\bootstrap\Modal::begin([
                              'id' => 'authform',
                              'header' => 'Вход на Одежда-Мастер',
                              'toggleButton' => ['label' => 'Вход', 'tag' => 'a', 'style' => 'float: left; margin: 4px; cursor:pointer;'],
                          ]);
                          $form = \yii\bootstrap\ActiveForm::begin([
                              'action' => BASEURL . '/login',
                              'id' => 'login-form'
                          ]);
                          echo $form->field($model, 'username', ['inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;']])->label('Электронная почта');
                          echo $form->field($model, 'password', ['inputOptions' => ['class' => 'no-shadow-form-control', 'style' => 'height:36px;']])->passwordInput()->label('<span style="float: left;">Пароль</span><span style="float: right; text-decoration: underline;">' . \yii\helpers\Html::a('Забыли пароль?', [BASEURL . '/request-password-reset']) . '</span>');
                          echo ' <div style="color:#999;margin:1em 0">';
                          echo \yii\bootstrap\Html::a('Зарегистрироваться', [BASEURL . '/signup'], ['class' => 'btn', 'rel'=>'nofollow', 'style' => 'height: 36px; color: rgb(0, 0, 0); position: absolute; right: 30px; text-decoration: underline;']);
                          echo \yii\bootstrap\Html::submitButton('Вход', ['class' => 'btn', 'name' => 'partners-settings-button', 'style' => 'height: 36px; color: rgb(255, 255, 255); position: absolute; left: 30px; background: rgb(0, 165, 161) none repeat scroll 0% 0%;']);
                          echo '</div>';
                          echo $form->field($model, 'rememberMe', ['options' => ['style' => 'margin-top:80px']])->checkbox()->label('Запомнить меня');

                          \yii\bootstrap\ActiveForm::end();

                          \yii\bootstrap\Modal::end();


                          echo '</div>';
                          echo '<div style="float: right;"><a rel="nofollow" href="' . BASEURL . '/signup"><span style="float: left; margin: 4px;">Регистрация</span></a></div>';
                      } else {
                          echo '<div style="float: right;"><a rel="nofollow"  href="' . BASEURL . '/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
                          echo '<div style="float: right;"><a rel="nofollow"  href="' . BASEURL . '/lk/"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
                      }
                      ?>
                </span>
            </div>
            <div class="header-actions-bar__shopping-basket">
                <div style="padding: 0px 9px;">
                    <div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;"
                         class="cart-count badge">5
                    </div>
                    <a rel="nofollow" class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart"
                                                                                style="font-size: 28px; color: rgb(0, 165, 161);"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="o-container col-95">
    <div class="header-nav-bar">
        <?php
        echo \frontend\widgets\Menuom::widget([
            'chpu' =>Yii::$app->params['seourls'],
            'tpl' => [
                'wrap' => '<div class="header-nav-bar__list">{menu}</div>',
                'block' => '{sub}',
                'link' => '<div class="header-nav-bar__list_b list_disc"><a class="header-nav-bar__list_a list_a list_a-new" href="{uri}">{name}</a></div>'
            ],
            'property'=>['limit'=>0,'id' => 'main', 'target' => '0']]);
        ?>
    </div>

<!-- banner -->


<?= \frontend\widgets\GenBanners::widget(['tpl'=>$banner_config['template'], 'path'=>$banner_config['custom_path']]); ?>
<div class="clearfix"></div>
<!-- end banner -->

<div class="col-1 special_header_c-h2"><?= ($header_title) ?: '' ?></div>
<div class="clearfix"></div>

</div>
<div class="clearfix"></div>
