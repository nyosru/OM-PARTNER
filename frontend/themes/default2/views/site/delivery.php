<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Dropdown;
use yii\bootstrap\Carousel;
use common\models\Partners;
use yii\helpers\BaseUrl;

use yii\jui\Slider;
$this -> title = 'Доставка';
?>
<div class="container" id="partners-main">
    <div class="container" id="partners-main-left-back">
        <div id="partners-main-left">
            <div id="partners-main-left-cont">
                <?
                $run = new Partners();
                $check = $run -> GetId($_SERVER['HTTP_HOST']);
                $checks = $run -> GetAllowCat($check);
                foreach ($catdata as $value) {
                    if (in_array(intval($value['categories_id']), $checks)) {
                        $catdataallow[] = $value;
                    }
                }
                for ($i = 0; $i < count($catdataallow); $i++) {
                    $row = $catdataallow[$i];
                    if (empty($arr_cat[$row['parent_id']])) {
                        $arr_cat[$row['parent_id']] = $row;
                    }
                    $arr_cat[$row['parent_id']][] = $row;
                }
                foreach ($categories as $value) {
                    $catnamearr[$value['categories_id']] = $value['categories_name'];
                }
                function view_cat($arr, $parent_id = 0, $catnamearr, $allow_cat) {
                    if (empty($arr[$parent_id])) {
                        return;
                    } else {
                        if ($parent_id !== 0) {$style = 'style="display: none;"';
                        }
                        echo '<ul id="accordion" class="accordion" ' . $style . '">';
                        for ($i = 0; $i < count($arr[$parent_id]); $i++) {
                            $catdesc = $arr[$parent_id][$i]['categories_id'];
                            if (!$arr[$parent_id][$i] == '') {
                                echo '<li class=""><div class="link data-j" data-j="on" data-cat="' . $catdesc . '">' . $catnamearr["$catdesc"] .'</div>';
                                view_cat($arr, $arr[$parent_id][$i]['categories_id'], $catnamearr, $allow_cat);
                                echo '</li>';
                            }
                        }
                        echo '</ul>';
                    }
                }
                ?><div class="header-catalog"><i class="fa fa-bars"></i> КАТАЛОГ ТОВАРОВ
                </div><?
                view_cat($arr_cat, 0, $catnamearr, $check);
                ?>
            </div>
            <div id="filters">
                <div id="price-lable" style="display:none;">
                    Цена </div>

                <div id="min-price" class="btn" style="display:none">0</div><div style="display:none" id="max-price" class="btn">10000</div>

            </div>
        </div>
    </div>
    <div class="container-fluid" id="partners-main-right-back">
        <div id="partners-main-right" class="bside">

            <div class="delivery-box">
                <h1>Куда изволите доставить?</h1>
                <div class="delivery-top-left-block">
                    Сделать заказ на Lapana.ru легко!<br>
                    Просто заполните форму при оформлении заказа самостоятельно на сайте или позвоните нам по телефону +7 (495) 204-36-73, +7 (4932) 222-962 или оформите доставку через нашего оператора.<br><br>
                    Если у вас нет возможности нам позвонить, то мы перезвоним вам сами. Для этого у нас работает услуга <a href="/site/contact/3" data-options="{&quot;width&quot;:600, &quot;height&quot;:600, &quot;modal&quot;: false, &quot;move&quot;: false}" class="lightbox quick-view">"Перезвоните мне"</a>.<br><br>
                    Для вас мы можем предложить:
                </div>
                <div class="delivery-top-right-block"></div>
                <div class="clear"></div>
                <div class="delivery-middle-block">
                    <div class="delivery-middle-block-item">
                        <h2><div class="delivery-middle-block-yellow-bullet"></div> Самовывоз из аутпоста</h2>
                        Вы всегда можете забрать товар самостоятельно. Мы можем предложить два варианта пунктов самовывоза:<br><br>
                        <ol>
                            <li>
                                Пункты самовывоза Лапана.<br>
                                Стоимость услуги - 50 руб.*<br>
                                <div class="red-text">Обладателям ВИП-карт Лапана доставка до пунктов самовывоза Лапана - БЕСПЛАТНО!</div>
                                <div class="link-arrow"></div><a href="/delivery/index" target="_blank">Список аутпостов Лапана</a>
                            </li>
                            <li>
                                Пункты самовывоза СДЭК.<br>
                                <div class="link-arrow"></div><a href="#infopage" data-options="{&quot;width&quot;:1000, &quot;height&quot;:550, &quot;modal&quot;: false, &quot;move&quot;: false}" class="lightbox">Показать тарифную сетку</a>
                            </li>
                        </ol>
                    </div>
                    <div class="delivery-middle-block-item">
                        <h2><div class="delivery-middle-block-blue-bullet"></div> Доставка курьером</h2>
                        Если вы предпочитаете, чтобы покупка приехала к вам с доставкой на дом, то выберите удобный для вас способ курьерской доставки:<br><br>
                        <ol>
                            <li>
                                "Доставка до дверей курьером Лапана".<br>
                                Стоимость услуги составляет 100 рублей для регионов. Цену доставки "курьером Лапана" для Москвы и Санкт-Петербурга уточняйте у оператора.<br>
                                <span id="sdek-full-info-link"><div class="link-arrow"></div><a href="#">Подробнее об услуге</a></span>
<span id="sdek-full-info-text">
Доставка оплачивается отдельно "курьеру Лапана" наличными. Заказать услуги вы можете только у оператора магазина после подтверждения прихода вашего заказа на пункт самовывоза Лапана. Наш курьер доставит заказ по указанному адресу с 10:00 до 21:00. После предварительного звонка оператора курьер дополнительно свяжется для предупреждения о выезде по адресу доставки (ориентировочно за 1 час).
<br><div class="link-arrow2"></div><a href="#">Свернуть</a>
</span>
                            </li>
                            <li>
                                "Доставка "До дверей" от СДЭК".<br>
                                Если вы выбираете этот способ доставки, то в день поступления вашего заказа с вами свяжется курьер и согласует удобное время доставки по указанному вами адресу**.<br>
                                <div class="link-arrow"></div><a href="#infopage" data-options="{&quot;width&quot;:1000, &quot;height&quot;:550, &quot;modal&quot;: false, &quot;move&quot;: false}" class="lightbox">Показать тарифную сетку</a>
                            </li>
                        </ol>
                    </div>
                    <div class="delivery-middle-block-item">
                        <h2><div class="delivery-middle-block-red-bullet"></div> Доставка по России</h2>
                        На этапе совершения заказа вам будут автоматически предложены различные виды доставки:<br><br>
                        <div class="logos-dostavka"></div><br>
                        Стоимость доставки расчитывается на основе тарифов почтовых операторов в зависимости от адреса доставки и веса товара. Все товары отправляются с центрального склада Lapana, расположенного в г. Иваново.
                    </div>
                </div>
                <div class="clear"></div>
                <div class="delivery-middle-bottom-block">
                    Рассчитать итоговую стоимость самовывоза из пункта выдачи СДЭК, доставки до дверей СДЭК, доставки Почтой России вы можете при оформлении заказа на сайте или позвонив нам по телефону +7 (495) 204-36-73 или +7 (4932) 222-962, а также у нашего онлайн-консультанта на сайте.
                </div>
                <h2>Обратите внимание на важные моменты!</h2>
                <table>
                    <tbody><tr>
                        <td>–</td>
                        <td>Мы доставим ваш товар по адресу, указанному при оформлении заказа. Пожалуста, проверьте, правильно ли указан адрес доставки.</td>
                    </tr>
                    <tr>
                        <td>–</td>
                        <td>При доставке курьером в его присутствии обязательно проверьте внешний вид товара и комплектность поставки.</td>
                    </tr>
                    <tr>
                        <td>–</td>
                        <td>Просим вас с пониманием отнестись к тому, что примерка одежды, проверка и оплата товара должны быть произведены в течение 10 минут.</td>
                    </tr>
                    <tr>
                        <td>–</td>
                        <td>Курьер не даёт консультаций по составу изделия, техническим характеристикам товара, стоимости и т.п. Эту информацию вы можете получить у нашего онлайн-консультанта или позвонив нам по телефону +7 (495) 204-36-73, +7 (4932) 222-962.</td>
                    </tr>
                    <tr>
                        <td>–</td>
                        <td>Оплату мы принимаем в рублях.</td>
                    </tr>
                    <tr>
                        <td>–</td>
                        <td>Если на территории места назначения доставки действует платный въезд, вам нужно будет компенсировать стоимость въезда нашего курьера, иначе мы сможем доставить товар только к месту платного въезда.</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>*</td>
                        <td>Цена за доставку указана для всех товаров, оформленных в один или несколько заказов в течение одного дня (то есть с 00:00 до 23:59).</td>
                    </tr>
                    <tr>
                        <td>**</td>
                        <td>Стоимость доставки может варьироваться в зависимости от веса и суммы вашего заказа.</td>
                    </tr>
                    <tr>
                        <td>***</td>
                        <td>Если вашего города нет в списке, ориентируйтесь по тарифу ближайшего к вам города.</td>
                    </tr>
                    </tbody></table>
                Удачных покупок на Lapana.ru.
            </div>


        </div>
    </div>

