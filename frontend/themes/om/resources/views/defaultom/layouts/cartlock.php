<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\bootstrap\Alert;
use rmrevin\yii\fontawesome;
use dosamigos\ckeditor\CKEditorInline;
use frontend\widgets\Menuom;


/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
rmrevin\yii\fontawesome\AssetBundle::register($this);
$this->beginPage();

?>
    <!DOCTYPE html>
    <html lang="ru-RU">
    <head>
        <meta charset="<?=Yii::$app->charset; ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name='yandex-verification' content='6af7ec36af3406db'/>
        <link rel="search" type="application/opensearchdescription+xml" title="Поиск по товарам"
              href="<?=BASEURL ;?>/addsearch">


        <?=Html::csrfMetaTags(); ?>
        <title><?=Html::encode($this->title); ?></title>
        <?php $this->head();

        ?>
    </head>
    <div class="preload"><div id="loaderImage"></div></div>
    <body style="font-family: Open Sans,Helvetica Neue,sans-serif, sans-serif; font-style: normal; font-weight: 300; min-width: 1280px; margin-left: auto; margin-right: auto; height: 100%; ">
    <script>
        <?php
        if(Yii::$app->params['seourls']){
            echo 'var seo_urls = true;';
        }else{
            echo 'var seo_urls = false;';
        }
        ?>
    </script>
    <?php $this->beginBody(); ?>
    <?=\frontend\widgets\Metrics::widget();?>
    <div class="wrap" >
        <?php
        if (($namecustom = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
            $name = $namecustom;
        } else {
            $name = Yii::$app->params['constantapp']['APP_NAME'];
        }
        ?>
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ;?>
        <div class="partners-main">
            <div class="partners-main-left-back">

                <div >
                    <div class="partners-main-left-cont" style="height: 55px;background: #F5F5F5; position: fixed; width: 16.5%; z-index: 100; min-width: 211px; border-bottom: #CCC 1px solid;">
                        <?php if (($logotype = Yii::$app->params['partnersset']['logotype']['value']) !== FALSE && Yii::$app->params['partnersset']['logotype']['active'] == 1) {
                            echo '<span>' . str_replace('</p>', '', str_replace('<p>', '', $logotype)) . '</span>';
                        } else {
                            $logotype = '';
                        }
                        ?>
                    </div>

                    <div class="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">

                    </div>
                </div>
                <div  class="partners-main-left"  id="scroll1"
                      style="position: fixed; width: 16.5%;  min-width: 211px; z-index: 99; height: calc(100% - 75px);">
                    <?php if($this->beginCache('Right-13312'.Yii::$app->params['constantapp']['APP_ID'].'-'.(int)Yii::$app->request->getQueryParam('cat'), ['duration' => 86400])) { ?>
                        <div class="partners-main-left-cont">
                            <?= \frontend\widgets\RightTopMenuLinks::widget();
                            if(isset(Yii::$app->params['layoutset']['opencat'])){
                                $layoutset =   Yii::$app->params['layoutset']['opencat'];
                            }else{
                                $layoutset =   [0];
                            };
                            ?>

                            <?= Menuom::widget([ 'chpu' =>Yii::$app->params['seourls'],'property' => ['id' => 'main', 'target' => '0', 'opencat' => $layoutset]]); ?>
                        </div>
                        <?= \frontend\widgets\RightBottomMenuLinks::widget() ?>
                        <?php $this->endCache();
                    }?>
                </div>
                <div class="partners-main-left-cont" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);"></div>
                <div  class="partners-main-left-cont suplogo" style=" background: rgb(245, 245, 245) none repeat scroll 0% 0%; position: fixed; width: 16.5%; z-index: 100; min-width: 211px; border-bottom: 1px solid rgb(204, 204, 204); bottom: 0px;">
                </div>
            </div>
            <div id="modal-product" style="min-height: 300px;">
                <span id="modal-close"><i class="fa fa-times"></i></span>
            </div>
            <div class="partners-main-right-back">
                <div class="partners-main-right" style="height: 55px; border-bottom: 1px solid rgb(204, 204, 204);">
                    <div>
                        <div class="top-link-cont large" style="width: calc(100% / 6.5);"><a class="top-link" href="<?=BASEURL?>/page?article=howorders">Как сделать заказ</a></div>
                        <div class="top-link-cont large" style="width: calc(100% / 13);"><a class="top-link red" href="<?=BASEURL?>/discont">Акции</a></div>
                        <div class="top-link-cont large" style="width: calc(100% / 5.1);"><a class="top-link" href="<?=BASEURL?>/info">Сотрудничество</a></div>
                        <div class="top-link-cont alarge" style="width: calc(100% / 5.1);display: none;"><a class="top-link"       href="#">Показать каталог</a></div>
                        <div class="omcode" style="float: left; background: rgb(245, 245, 245) none repeat scroll 0% 0%; text-align: center; width: calc(100% / 6.5);"><img src="/images/logo/OM_code.png"></div>
                        <?php
                        if (isset(Yii::$app->params['partnersset']['contacts']['telephone']['value']) && Yii::$app->params['partnersset']['contacts']['telephone']['active'] == 1) {
                            echo '<div style="float: left; padding: 15px 0px; font-size: 16px; font-weight: 500; text-align: center; width: calc(100% / 7);margin-left:30px;min-width: 130px;">+7-495-204-15-83</div>';
                        }
                        ?>
                        <a class="top-link-cont-back large" style="float: left; font-size: 13px; padding: 17px 0px; width: calc(100% / 7);" class="top-link-back" href="http://odezhda-master.ru">На старую версию сайта</a></a>
                        <div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="selected-count badge"></div><a  rel="nofollow"  class="top-link" href="/glavnaya/selectedproduct"><i class="fa fa-star" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>
                        <div class="top-link-cont" style="padding: 12px 9px; float: right; text-align: right;"><div style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; font-size: 12px; float: right; position: relative; right: 35px;" class="cart-count badge"></div><a  rel="nofollow"  class="top-link" href="/glavnaya/cart"><i class="fa fa-shopping-cart" style="font-size: 28px; color: rgb(0, 165, 161);"></i></a></div>
                    </div>
                </div>
                <div class="partners-main-right">
                    <div style="width: 100%; display: block; height: 72px; padding: 16px 10px 10px; border-bottom: 1px solid rgb(204, 204, 204);">
                        <form action="<?= BASEURL?>/catalog">
                            <input  name="cat" value="0"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="count" value="60"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input  name="prod_attr_query" value="<?=(integer)Yii::$app->request->getQueryParam('prod_attr_query')?>"  style="color: rgb(119, 119, 119); height: 40px; float: left; width: 65%;" type="hidden">
                            <input   name="searchword" class="search no-shadow-form-control" placeholder="Введите артикул или название" style="height: 40px; float: left; width: 65%; color: rgb(119, 119, 119); background: transparent none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); border-radius: 4px; margin-top: 0px;" type="text">
                            <button class="btn btn-default data-j" type="submit" style="width: 10%; height: 40px; position: relative; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: white; font-size: 1.2pc; left: -5px; margin-right: 0px; float: left;">
                                Найти
                            </button>
                        </form>
                        <a  rel="nofollow"  class="change-cart" href="#"></a>
                        <div class="logindiv" style="float: right; width: 25%; padding: 8px 0px; font-weight: 400;">
                            <?php
                            if(Yii::$app->user->isGuest){
                                echo '<div style="float: right;"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i>';
                                $model = new \common\models\LoginFormOM();
                                Modal::begin([
                                    'id'=> 'authform',
                                    'header' => 'Вход на Одежда-Мастер',
                                    'toggleButton' => ['label' => 'Вход', 'tag'=> 'a', 'style'=> 'float: left; margin: 4px; cursor:pointer;'],
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


                                echo '</div>';
                                echo '<div style="float: right;"><a  rel="nofollow"  href="'.BASEURL.'/signup"><span style="float: left; margin: 4px;">Регистрация</span></a></div>';
                            }else{
                                echo '<div style="float: right;"><a  rel="nofollow" href="'.BASEURL.'/logout" data-method="post"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE879;</i><span style="float: left; margin: 4px;">Выход</span></a></div>';
                                echo '<div style="float: right;"><a rel="nofollow"  href="'.BASEURL.'/lk/"><i class="mdi" style="color: rgb(254, 213, 23); font-size: 24px; float: left;">&#xE7FF;</i><span style="float: left; margin: 4px;">Профиль</span></a></div>';
                            }
                            ?>
                        </div>
                        <div class="result_search_word" style="background: rgba(245, 245, 245, 0.84) none repeat scroll 0% 0%; z-index: 5000; overflow-y: auto; max-height: 300px; position: relative; width: 65%;"></div>

                    </div>

                </div>

                <div  class=" partners-main-right bside">

                    <?= $content ?>
                </div>
                <div class="modal-cart" id="modal-cart" style="display: none;"></div>
                <div style="clear:both;"></div>
                <footer class="footer">
                    <hr class="linebottom1">
                    <hr class="linebottom2">
                    <div class="" style="margin: 0px 25px;">
                        <p class="pull-left">&copy; Все права защищены, 2014-<?= date('Y') ?></p>
                        <div style="margin: 0% 25%; float: left;">
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <?php
        $this->endBody();
        Yii::$app->params['assetsite']->registerAssetFiles($this);
        ?>
    </div>
 <?php
 if(($ga = Yii::$app->session->get('ga'))){
     foreach ($ga as $gakey=>$gavalue){
        ?>
         <script>
             $(window).load(function () {
                 if(typeof(ga) != 'undefined') {
                     ga('send', 'event', '<?=$gavalue['event']?>', '<?=$gavalue['location']?>')
                 }
             });
         </script>
         <?php
     }
     $ga = Yii::$app->session->set('ga', []);
 }
 echo \frontend\widgets\StatWidget::widget();
 echo \frontend\widgets\MailCounter::widget();
 echo  \frontend\widgets\ReTargetVKWidget::widget();
 echo  \frontend\widgets\SlizaWidget::widget();
 ?>
    
    </body>
    </html>
<?php $this->endPage() ?>