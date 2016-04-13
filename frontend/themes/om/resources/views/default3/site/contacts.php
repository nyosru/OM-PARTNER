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
$graf = Yii::$app->params['partnersset']['contacts']['graf_work'];
if ($graf['activated'] == 1) {
    echo '<div class = "contacts-adress"><div class="contacts-adress-name"> График работы</div>';
    if ($graf['mon']['active'] == 1) {

        // Понедельник
        if ($graf['mon']['o']['active'] == 1) {
            echo '<div>Понедельник: с ' . $graf['mon']['w']['in'] . ':' . $graf['mon']['wm']['in'] . ' до ' . $graf['mon']['w']['out'] . ':' . $graf['mon']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['mon']['o']['in'] . ':' . $graf['mon']['om']['in'] . ' до ' . $graf['mon']['o']['out'] . ':' . $graf['mon']['om']['out'] . '</div>';
        } else {
            echo '<div>Понедельник: с ' . $graf['mon']['w']['in'] . ':' . $graf['mon']['wm']['in'] . ' до ' . $graf['mon']['w']['out'] . ':' . $graf['mon']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Понедельник: выходной</div>';
    }

    // Вторник
    if ($graf['tue']['active'] == 1) {
        if ($graf['tue']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Вторник: с ' . $graf['tue']['w']['in'] . ':' . $graf['tue']['wm']['in'] . ' до ' . $graf['tue']['w']['out'] . ':' . $graf['tue']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['tue']['o']['in'] . ':' . $graf['tue']['om']['in'] . ' до ' . $graf['tue']['o']['out'] . ':' . $graf['tue']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Вторник: с ' . $graf['tue']['w']['in'] . ':' . $graf['tue']['wm']['in'] . ' до ' . $graf['tue']['w']['out'] . ':' . $graf['tue']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Вторник: выходной</div>';
    }

    // Среда
    if ($graf['wed']['active'] == 1) {
        if ($graf['wed']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Среда: с ' . $graf['wed']['w']['in'] . ':' . $graf['wed']['wm']['in'] . ' до ' . $graf['wed']['w']['out'] . ':' . $graf['wed']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['wed']['o']['in'] . ':' . $graf['wed']['om']['in'] . ' до ' . $graf['wed']['o']['out'] . ':' . $graf['wed']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Среда: с ' . $graf['wed']['w']['in'] . ':' . $graf['wed']['wm']['in'] . ' до ' . $graf['wed']['w']['out'] . ':' . $graf['wed']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Среда: выходной</div>';
    }

    // Четверг
    if ($graf['thu']['active'] == 1) {
        if ($graf['thu']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Четверг: с ' . $graf['thu']['w']['in'] . ':' . $graf['thu']['wm']['in'] . ' до ' . $graf['thu']['w']['out'] . ':' . $graf['thu']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['thu']['o']['in'] . ':' . $graf['thu']['om']['in'] . ' до ' . $graf['thu']['o']['out'] . ':' . $graf['thu']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Четверг: с ' . $graf['thu']['w']['in'] . ':' . $graf['thu']['wm']['in'] . ' до ' . $graf['thu']['w']['out'] . ':' . $graf['thu']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Четверг: выходной</div>';
    }

    // Пятница
    if ($graf['fri']['active'] == 1) {
        if ($graf['fri']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Пятница: с ' . $graf['fri']['w']['in'] . ':' . $graf['fri']['wm']['in'] . ' до ' . $graf['fri']['w']['out'] . ':' . $graf['fri']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['fri']['o']['in'] . ':' . $graf['fri']['om']['in'] . ' до ' . $graf['fri']['o']['out'] . ':' . $graf['fri']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Пятница: с ' . $graf['fri']['w']['in'] . ':' . $graf['fri']['wm']['in'] . ' до ' . $graf['fri']['w']['out'] . ':' . $graf['fri']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Пятница: выходной</div>';
    }

    // Суббота
    if ($graf['sat']['active'] == 1) {
        if ($graf['sat']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Суббота: с ' . $graf['sat']['w']['in'] . ':' . $graf['sat']['wm']['in'] . ' до ' . $graf['sat']['w']['out'] . ':' . $graf['sat']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['sat']['o']['in'] . ':' . $graf['sat']['om']['in'] . ' до ' . $graf['sat']['o']['out'] . ':' . $graf['sat']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Суббота: с ' . $graf['sat']['w']['in'] . ':' . $graf['sat']['wm']['in'] . ' до ' . $graf['sat']['w']['out'] . ':' . $graf['sat']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Суббота: выходной</div>';
    }

    // Воскресенье
    if ($graf['sun']['active'] == 1) {
        if ($graf['sun']['o']['active'] == 1) {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Воскресенье: с ' . $graf['sun']['w']['in'] . ':' . $graf['sun']['wm']['in'] . ' до ' . $graf['sun']['w']['out'] . ':' . $graf['sun']['wm']['out'] .
                '<span style="margin-left:30px">Обед:</span> с ' . $graf['sun']['o']['in'] . ':' . $graf['sun']['om']['in'] . ' до ' . $graf['sun']['o']['out'] . ':' . $graf['sun']['om']['out'] . '</div>';
        } else {
            echo '<div class="contacts-adress-name">&nbsp;</div><div>Воскресенье: с ' . $graf['sun']['w']['in'] . ':' . $graf['sun']['wm']['in'] . ' до ' . $graf['sun']['w']['out'] . ':' . $graf['tue']['wm']['out'] . '</div>';
        }
    } else {
        echo '<div class="contacts-adress-name">&nbsp;</div><div>Воскресенье: выходной</div>';
    }
    echo '</div>';
    ?>


    <?php
}


if (isset(Yii::$app->params['partnersset']['contacts'])) {
    $contacts = Yii::$app->params['partnersset']['contacts'];
    if ($contacts['adress']['value'] && $contacts['adress']['active'] == 1) {
        ?>
        <div class="contacts-adress">
            <div class="contacts-adress-name">Адрес</div>
            <div><?= $contacts['adress']['value'] ?></div>
        </div>
        <?
    }
    if ($contacts['telephone']['value'] && $contacts['telephone']['active'] == 1) {
        ?>
        <div class="contacts-telephone">
            <div class="contacts-telephone-name">Телефоны
            </div>
            <div><?= $contacts['telephone']['value'] ?></div>
        </div>
        <?
    }
    if ($contacts['fax']['value'] && $contacts['fax']['active'] == 1) {
        ?>
        <div class="contacts-fax">
            <div class="contacts-fax-name">Факсы</div>
            <div><?= $contacts['fax']['value'] ?></div>
        </div>
        <?
    }
    if ($contacts['email']['value'] && $contacts['email']['active'] == 1) {
        ?>
        <div class="contacts-email">
            <div class="contacts-email-name">E-mail</div>
            <div><?= $contacts['email']['value'] ?></div>
        </div>
        <?
    }
}

if (Yii::$app->params['partnersset']['googlemap']['value'] && Yii::$app->params['partnersset']['googlemap']['active'] == 1) {
    ?>
    <div class="contacts-googlemap">
        <div class="contacts-googlemap-name">
            Карта (Google)
        </div>
        <div>
            <iframe
                src="https://www.google.com/maps/d/embed?mid=<?= Yii::$app->params['partnersset']['googlemap']['value'] ?>"
                width="810" height="400"></iframe>
        </div>
    </div>
    <?
}
if (Yii::$app->params['partnersset']['yandexmap']['value'] && Yii::$app->params['partnersset']['yandexmap']['active'] == 1) {
    ?>
    <div class="contacts-yandexmap">
        <div class="contacts-yandexmap-name">
            Карта (Yandex)
        </div>
        <div>
            <script type="text/javascript" charset="utf-8"
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?= Yii::$app->params['partnersset']['yandexmap']['value'] ?>&width=810&height=400&lang=ru_RU&sourceType=constructor"></script>
        </div>
    </div>
    <?
}
?>
