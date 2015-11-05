<?php
use yii\filters\AccessControl;
use yii\web\User;
use dosamigos\ckeditor\CKEditorInline;
use common\models\PartnersUsersInfo;
use common\models\AddressBook;

/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use yii\helpers\BaseUrl;
use common\models\PartnersConfig;
use yii\jui\Slider;

$this->title = 'Контакты';
?>

    <div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                ?>
                <div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
                echo $view;
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена
                </div>

                <div id="min-price" class="btn" style="display:none">0</div>
                <div style="display:none" id="max-price" class="btn">10000</div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">
            <?
            if (isset(Yii::$app->params['partnersset']['contacts'])) {
                $contacts = Yii::$app->params['partnersset']['contacts'];
                if ($contacts['adress']['value'] && $contacts['adress']['active'] == 1) {
                    ?>
                    <div  style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px; border-radius: 5px; padding: 5px 10px;">
                        <div style="float: left; width: 25%; border-right: 2px solid black; margin: 0px 10px;">Адрес
                        </div>
                        <div><?= $contacts['adress']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['telephone']['value'] && $contacts['telephone']['active'] == 1) {
                    ?>
                    <div
                        style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px;  border-radius: 5px; padding: 5px 10px;">
                        <div style="float: left; width: 25%; border-right: 2px solid black; margin: 0px 10px;">Телефоны
                        </div>
                        <div><?= $contacts['telephone']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['fax']['value'] && $contacts['fax']['active'] == 1) {
                    ?>
                    <div
                        style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px;  border-radius: 5px; padding: 5px 10px;">
                        <div style="float: left; width: 25%; border-right: 2px solid black; margin: 0px 10px;">Факсы</div>
                        <div><?= $contacts['fax']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['email']['value'] && $contacts['email']['active'] == 1) {
                    ?>
                    <div
                        style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px;  border-radius: 5px; padding: 5px 10px;">
                        <div style="float: left; width: 25%; border-right: 2px solid black; margin: 0px 10px;">E-mail</div>
                        <div><?= $contacts['email']['value'] ?></div>
                    </div>
                    <?
                }
            }

                 if (Yii::$app->params['partnersset']['googlemap']['value'] && Yii::$app->params['partnersset']['googlemap']['active'] == 1) {
                    ?>
                    <div
                        style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px;  border-radius: 5px; padding: 5px 10px;">
                        <div style="float: left; width: 25%; margin: 0px 10px;">
                            Карта  (Google) </div>
                        <div> <iframe src="https://www.google.com/maps/d/embed?mid=<?= Yii::$app->params['partnersset']['googlemap']['value']?>" width="810" height="400"></iframe>            </div>
                    </div>
                    <?
                }
            if (Yii::$app->params['partnersset']['yandexmap']['value'] && Yii::$app->params['partnersset']['yandexmap']['active'] == 1) {
                ?>
                <div
                    style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; margin-top: 6px;  border-radius: 5px; padding: 5px 10px;">
                    <div style="float: left; width: 25%; margin: 0px 10px;">
                        Карта  (Yandex) </div>
                    <div>   <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?= Yii::$app->params['partnersset']['yandexmap']['value'] ?>&width=810&height=400&lang=ru_RU&sourceType=constructor"></script>
                    </div>
                </div>
                <?
            }
         ?>
        </div>
    </div>
