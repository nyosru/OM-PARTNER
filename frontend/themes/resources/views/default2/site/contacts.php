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

            <?
            if (isset(Yii::$app->params['partnersset']['contacts'])) {
                $contacts = Yii::$app->params['partnersset']['contacts'];
                if ($contacts['adress']['value'] && $contacts['adress']['active'] == 1) {
                    ?>
                    <div class = "contacts-adress">
                        <div class = "contacts-adress-name">Адрес
                        </div>
                        <div><?= $contacts['adress']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['telephone']['value'] && $contacts['telephone']['active'] == 1) {
                    ?>
                    <div class = "contacts-telephone">
                        <div class = "contacts-telephone-name">Телефоны
                        </div>
                        <div><?= $contacts['telephone']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['fax']['value'] && $contacts['fax']['active'] == 1) {
                    ?>
                    <div class = "contacts-fax">
                        <div class = "contacts-fax-name">Факсы</div>
                        <div><?= $contacts['fax']['value'] ?></div>
                    </div>
                    <?
                }
                if ($contacts['email']['value'] && $contacts['email']['active'] == 1) {
                    ?>
                    <div class = "contacts-email">
                        <div class = "contacts-email-name">E-mail</div>
                        <div><?= $contacts['email']['value'] ?></div>
                    </div>
                    <?
                }
            }

                 if (Yii::$app->params['partnersset']['googlemap']['value'] && Yii::$app->params['partnersset']['googlemap']['active'] == 1) {
                    ?>
                    <div  class = "contacts-googlemap">
                        <div class = "contacts-googlemap-name">
                            Карта  (Google) </div>
                        <div> <iframe src="https://www.google.com/maps/d/embed?mid=<?= Yii::$app->params['partnersset']['googlemap']['value']?>" width="810" height="400"></iframe>            </div>
                    </div>
                    <?
                }
            if (Yii::$app->params['partnersset']['yandexmap']['value'] && Yii::$app->params['partnersset']['yandexmap']['active'] == 1) {
                ?>
                <div  class = "contacts-yandexmap">
                    <div class = "contacts-yandexmap-name">
                        Карта  (Yandex) </div>
                    <div>   <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?= Yii::$app->params['partnersset']['yandexmap']['value'] ?>&width=810&height=400&lang=ru_RU&sourceType=constructor"></script>
                    </div>
                </div>
                <?
            }
         ?>
