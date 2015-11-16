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
            <? if (isset(Yii::$app->params['partnersset']['newsonindex']['value']) && Yii::$app->params['partnersset']['newsonindex']['active'] == 1) { ?>
                <div id="partners-main-left-cont">
                    <div class="header-catalog"><i class="fa fa-bars"></i> НОВОСТИ
                    </div>
                    <?
                    $newsprovider = new \yii\data\ActiveDataProvider([
                        'query' => \common\models\PartnersNews::find()->where(['partners_id' => Yii::$app->params['constantapp']['APP_ID'], 'status' => '1'])->orderBy('date_modified'),
                        'pagination' => [
                            'defaultPageSize' => intval(Yii::$app->params['partnersset']['newsonindex']['value']),
                        ],
                    ]);
                    $newsprovider = $newsprovider->getModels();
                    if (!$newsprovider) {
                        echo 'Новости отсутствуют';
                    } else {
                        foreach ($newsprovider as $valuenews) {
                            echo '<div>';
                            echo '<span style="background: rgb(255, 191, 8) none repeat scroll 0% 0%; padding: 4px 14px; width: 100%; box-shadow: 2px 1px 5px -4px black;">' . $valuenews->date_modified . '</span><br/>';
                            echo '<span style="padding: 10px 25px; margin: 0px; display: block; background: rgb(255, 191, 8) none repeat scroll 0% 0%;">' . $valuenews->name . '</span>';
                            $search = array("'<script[^>]*?>.*?</script>'si",
                                "'<[\/\!]*?[^<>]*?>'si",
                                "'([\r\n])[\s]+'",
                                "'&(quot|#34);'i",
                                "'&(amp|#38);'i",
                                "'&(lt|#60);'i",
                                "'&(gt|#62);'i",
                                "'&(nbsp|#160);'i",
                                "'&(iexcl|#161);'i",
                                "'&(cent|#162);'i",
                                "'&(pound|#163);'i",
                                "'&(copy|#169);'i",
                                "'&#(\d+);'e");

                            $replace = array("",
                                "",
                                "\\1",
                                "\"",
                                "&",
                                "<",
                                ">",
                                " ",
                                chr(161),
                                chr(162),
                                chr(163),
                                chr(169),
                                "chr(\\1)");

                            $text = preg_replace($search, $replace, $valuenews->post);
                            echo '<span style="padding: 0px 10px; display: block; margin: 10px;">' . mb_substr($text, 0, 180, 'UTF-8') . '...</span> <br/>';

                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            <? } ?>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">
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
        </div>
    </div>
