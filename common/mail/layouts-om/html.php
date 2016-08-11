<?php
use yii\helpers\Html;
use common\traits\Products\NewProducts;
/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>


<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html style="width:100%;height:100%;background-color:#ffffff;padding:0;margin:0 auto;">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    
<body style="font-family: Roboto,Helvetica Neue,sans-serif,sans-serif; font-weight: 300;      font-size: 18px;color: rgb(51, 51, 51);">
<?php $this->beginBody();
$contentutm = \frontend\widgets\UtmLinker::widget(['param'=>Yii::$app->params['params']['utm']]);
?>
<body style="width:100%;height:auto;padding:0;margin:0 auto;">
<div style="max-width:840px;margin:0 auto;padding:0;">
    <p style="text-align:center;width:100%;padding:25px 0;margin:0;"><img src="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/images/logo/OM_logo.png" alt="Одежда-Мастер" style="margin:0 auto;"></p>
    <ul style="list-style:none;text-align:center;padding:0;margin:0 auto 20px auto;width:100%;padding: 0;">
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/discont?<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#EB516D;font-family:'Roboto', Arial;font-size:14px;">Распродажа</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/dayproduct?<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Новинки сегодня</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/allbrands?<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Бренды</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/catalog?cat=1632&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=&<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Женщинам</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/catalog?cat=1668&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=&<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Мужчинам</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/catalog?cat=1903&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=&<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Детям</a></li>
        <li style="display:inline;padding-left:10px;padding-right:10px;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/catalog?cat=2048&count=60&start_price=&end_price=1000000&prod_attr_query=&page=0&sort=0&searchword=&<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#000000;font-family:'Roboto', Arial;font-size:14px;">Красота</a></li>
    </ul>
    <p style="height:1px;padding:0;margin:0 15px 10px 15px;background-color:#C0E8E8;">&nbsp;</p>
    <p style="height:1px;padding:0;margin:0 30px 10px 30px;background-color:#F8D3DA;">&nbsp;</p>
    <p style="height:1px;padding:0;margin:0 45px 10px 45px;background-color:#FFF5C4;">&nbsp;</p>

    <?= $content ?>
    <p style="font-family:'Roboto', Arial;font-size:21px;padding:0 15px;text-align:center;max-width:630px;margin:0 auto;">
        Одежда-Мастер постоянно стремится сделать процесс покупки максимально удобным и приятным!
    </p>
    <ul style="list-style:none;width:100%;text-align:center;padding:0;margin:30px 0 20px 0;position:relative;">
        <li style="padding:10px;margin:0 5px 10px 5px;width:45%;border:1px solid #e2e2e2;color:#222222;border-radius:8px;-webkit-border-radius:8px;-moz-border-radius:8px;display:inline-block;min-width:320px;height:140px;overflow:hidden;">
            <p style="width:100%;text-align:center;color:#007dc0;font-family:'Roboto', Arial;padding:0;margin:0 0 10px 0;font-size:21px;">Адресная книга</p>
            <p style="text-align:left;font-family:'Roboto', Arial;margin:0;padding:0;line-height:20px;font-size:14px;">
                Доставим товар по любому указанному вами адресу! Просто заполните их в адресной книге в личном кабинете.
            </p>
            <p style="text-align:center;margin:15px 0;padding:0;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="text-decoration:underline;color:#027bc2;font-family:'Roboto', Arial;font-size:14px;">Подробнее</a></p>
        </li>
        <li style="padding:10px;margin:0 5px 10px 5px;width:45%;border:1px solid #e2e2e2;color:#222222;border-radius:8px;-webkit-border-radius:8px;-moz-border-radius:8px;display:inline-block;min-width:320px;height:140px;overflow:hidden;">
            <p style="width:100%;text-align:center;color:#e1126d;font-family:'Roboto', Arial;padding:0;margin:0 0 10px 0;font-size:21px;">Несгораемая корзина</p>
            <p style="text-align:left;font-family:'Roboto', Arial;margin:0;padding:0;line-height:20px;font-size:14px;">
                Любые товары, добавленные в корзину, остаются там до тех пор, пока Вы не решите их приобрести или пока не удалите их из корзины.
            </p>
            <p style="text-align:center;margin:15px 0;padding:0;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="text-decoration:underline;color:#027bc2;font-family:'Roboto', Arial;font-size:14px;">Подробнее</a></p>
        </li>
        <li style="padding:10px;margin:0 5px 10px 5px;width:calc(94% - 5px);border:1px solid #e2e2e2;color:#222222;border-radius:8px;-webkit-border-radius:8px;-moz-border-radius:8px;display:inline-block;min-width:320px;height:140px;">
            <p style="width:100%;text-align:left;color:#00a5a1;font-family:'Roboto', Arial;padding:0;margin:0 0 10px 0;font-size:21px;">Маркеры товара</p>
            <p style="text-align:left;font-family:'Roboto', Arial;margin:0;padding:0;line-height:20px;font-size:14px;">
                Чтобы вам легче было идентифицировать товар на сайте, например, отличить новинку среди тысячи товаров или выбрать товар, который на складе мы ввели для вашего удобства специальные маркеры товара.
            </p>
            <p style="text-align:left;margin:35px 0 0 0;padding:0;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="text-decoration:underline;color:#027bc2;font-family:'Roboto', Arial;font-size:14px;">Подробнее</a></p>
        </li>
    </ul>
    <table style="width:100%;border:0;margin:0;padding:0;padding:0 15px;" border="0">
        <tr>
            <td style="width:25%;text-align:left;color:#000000;padding: 0 15px;">
                <p style="font-family:'Roboto', Arial;font-size:18px;padding:0;margin:0 0 10px 0;color:#00a69f;">Как сделать заказ</p>
                <p style="font-family:'Roboto', Arial;font-size:14px;padding:0;margin:0;color:#000000;line-height:25px;">
                    Чтобы выбор товаров и их оформление были максимально быстрыми и удобными, ознакомьтесь с нашими рекомендациями.
                </p>
                <p style="text-align:center;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="font-family:'Roboto', Arial;text-decoration:underline;font-size:14px;color:#007bbf;">Подробнее</a></p>
            </td>
            <td style="width:25%;text-align:left;color:#000000;padding: 0 15px;">
                <p style="font-family:'Roboto', Arial;font-size:18px;padding:0;margin:0 0 10px 0;color:#00a69f;">Дозаказ</p>
                <p style="font-family:'Roboto', Arial;font-size:14px;padding:0;margin:0;color:#000000;line-height:25px;">
                    Оформили заказ, но в самый последний момент решили докупить пару блузок? Ок, Вы всегда сможете включить свой дозаказ в основной заказ.
                </p>
                <p style="text-align:center;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="font-family:'Roboto', Arial;text-decoration:underline;font-size:14px;color:#007bbf;">Подробнее</a></p>
            </td>
            <td style="width:25%;text-align:left;color:#000000;padding: 0 15px;">
                <p style="font-family:'Roboto', Arial;font-size:18px;padding:0;margin:0 0 10px 0;color:#00a69f;">История заказов</p>
                <p style="font-family:'Roboto', Arial;font-size:14px;padding:0;margin:0;color:#000000;line-height:25px;">
                    Вы легко можете просмотреть все сделанные вами заказы через ваш личный кабинет, отфильтровав их по статусу и по дате заказа.
                </p>
                <p style="text-align:center;"><a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="font-family:'Roboto', Arial;text-decoration:underline;font-size:14px;color:#007bbf;">Подробнее</a></p>
            </td>
        </tr>
    </table>
    <p style="text-align:center;margin:40px 0 20px 0;">
        <a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="font-weight:bold;text-decoration:underline;color:#007BC1;font-family:'Roboto', Arial;font-size:14px;">Полные условия сотрудничества</a>
    </p>
    <?php
    if(isset( Yii::$app->params['params']['products_mail']) && is_array( Yii::$app->params['params']['products_mail'])) {
            ?>
            <p style="font-family:'Roboto', Arial;font-size:21px;padding:0 15px;margin:65px 0 35px 0;color:#4d4d4d;text-align:center;line-height:30px;">
                Каждый день в нашем каталоге появляется до <span
                    style="color:#ea516d;font-size:36px;">2000 новинок</span> по
                самым доступным ценам
            </p>
            <ul style="list-style:none;margin:0 auto 45px auto;text-align:center;padding: 0;">
            <?php
        foreach ( Yii::$app->params['params']['products_mail'] as $key=>$value) {
 ?>
                <li style="display:inline-block;margin:5px 12px;width:100px;text-align:center;">
                    <div style="width:100px;height:100px;">
                        <a href="http://<?= $_SERVER['HTTP_HOST'] . BASEURL; ?>/product?id=<?=$value['products_id']?>&<?=$contentutm;?>" target="_blank" style="text-decoration:none;">
                            <img src="http://<?= $_SERVER['HTTP_HOST'] . BASEURL; ?>/imagepreview?src=<?=$value['products_id']?>"
                                 alt="<?=$value['productsDescription']['products_name'];?>" style="max-width:100px;max-height:100px;">
                        </a>
                    </div>
                    <p style="color:#000000;font-family:'Roboto', Arial;font-size:11px;"><?=$value['productsDescription']['products_name'];?></p>
                    <p style="color:#41BCBA;font-family:'Roboto', Arial;font-size:11px;"><?=(int)$value['products']['products_price'];?>р.</p>
                </li>


            <?php
        }
            ?>
        </ul>
        <p style="text-align:center;padding:0;margin:30px 0 0 0;"><a
                href="http://<?= $_SERVER['HTTP_HOST'] . BASEURL; ?>/dayproduct?<?=$contentutm;?>" target="_blank"
                style="font-family:'Roboto', Arial;text-decoration:underline;font-size:14px;font-weight:bold;color:#007bbf;">Все
                новинки за сегодня</a></p>
        <?php
    }
    Yii::$app->params['params']['products_mail'] = '';
    ?>
    <p style="padding:0;margin:65px 0 40px 0;width:100%;text-align:center;font-family:'Roboto', Arial;font-size:14px;line-height:25px;">
        Остались вопросы? Хотите пообщаться со специалистом?
        <br>
        Выберите удобный способ связи
    </p>
    <ul style="list-style:none;width:100%;text-align:center;padding: 0;">
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #41BCBA;border-radius:6px;margin:0 4px 10px 0;font-weight:bold;">
            <a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/contactform?<?=$contentutm;?>" target="_blank" style="text-decoration:none;color:#41BCBA;font-family:'Roboto', Arial;font-size:14px;">
                помощь<br>онлайн
            </a>
        </li>
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #EA516D;border-radius:6px;margin:0 4px 10px 0;">
            <a href="/" target="_blank" style="text-decoration:none;color:#EA516D;font-family:'Roboto', Arial;font-size:14px;">
                <b>телефон</b><br>+7-495-204-15-83
            </a>
        </li>
        <li style="padding:10px;width:250px;display:inline-block;border:1px solid #007BC1;border-radius:6px;margin:0 4px 10px 0;">
            <a href="mailto:odezhdamaster@gmail.com" target="_blank" style="text-decoration:none;color:#007BC1;font-family:'Roboto', Arial;font-size:14px;">
                <b>емейл</b><br>odezhdamaster@gmail.com
            </a>
        </li>
    </ul>
    <p style="margin:40px 0 0 0;width:100%;text-align:left;padding:0;">
    <table style="border:0;width:100%;padding:0 15px;" border="0">
        <tr>
            <td style="width:50%;vertical-align:middle;text-align:left;font-family:'Roboto', Arial;font-size:14px;">
                А еще мы доступны в соцсетях для вопросов, общения, дружбы
            </td>
            <td style="width:50%;vertical-align:middle;text-align:left;">
                <ul style="margin:0;padding:0;list-style:none;display:inline-block;">
                    <li style="display:inline-block;margin:0 2px;"><a href="https://new.vk.com/odezdamast_shop" target="_blank" style="text-decoration:none;"><img src="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/images/lp/vk.png" alt="" style="height:38px;width:38px;"></li>
                    <li style="display:inline-block;margin:0 2px;"><a href="https://ok.ru/odezhda.master" target="_blank" style="text-decoration:none;"><img src="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/images/lp/ok.png" alt="" style="height:38px;width:38px;"></li>
                    <li style="display:inline-block;margin:0 2px;"><a href="https://www.instagram.com/odezhda_master/" target="_blank" style="text-decoration:none;"><img src="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/images/lp/inst.png" alt="" style="height:38px;width:38px;"></li>
                </ul>
            </td>
        </tr>
    </table>
    </p>
    <p style="padding:0;margin:65px 0 0 0;width:100%;text-align:left;">
    <table style="border:0;width:100%;padding:0 15px;" border="0">
        <tr>
            <td style="width:50%;text-align:left;font-family:'Roboto', Arial;font-size:14px;line-height: 25px;">
                Хотите заказывать новинки где угодно одним из<br>
                самых первых? Тогда скачайте наше приложение
            </td>
            <td style="width:50%;text-align:left;">
                <ul style="margin:0;padding:0;list-style:none;display:inline-block;">
                    <li style="display:inline-block;margin:0 4px 5px 4px;"><a href="https://play.google.com/store/apps/details?id=com.codegeek.omshopmobile&hl=ru" target="_blank" style="text-decoration:none;"><img src="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/images/lp/google.png" alt="" style="height:53px;width:162px;"></li>
                </ul>
            </td>
        </tr>
    </table>
    </p>
    <p style="text-align:center;width:100%;margin:55px 0;padding:0;">
        <span style="color:#ea5c76;font-family:'Roboto', Arial;font-size:10px;">Хорошего настроения и приятных покупок на Одежда-Мастер!</span>
        <span style="color:#9d9d9d;font-family:'Roboto', Arial;font-size:10px;">ОГРН 312774628501195</span>
        <a href="http://<?=$_SERVER['HTTP_HOST'].BASEURL;?>/?<?=$contentutm;?>" target="_blank" style="color:#9d9d9d;text-decoration:underline;font-family:'Roboto', Arial;font-size:10px;">Отписаться от рассылки</a>
    </p>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
