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

$this->title = 'Новости';
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

        </div>
    </div>
