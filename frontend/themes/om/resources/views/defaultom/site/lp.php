<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Интернет магазин Одежда Мастер. Товары оптом по выгодным ценам для физических и юридических лиц</title>
    <meta name="author" content="OM GROUP"/>
    <meta name="description" content="Интернет магазин Одежда Мастер. Товары оптом по выгодным ценам для физических и юридических лиц!"/>
    <meta name="keywords" content="интернет магазин,аксессуары, платья,футболки, женские, костюмы,  брюки, одежда, обувь, мастер, товары, оптом,  выгодные цены"/>
    <meta name="Resource-type" content="Document"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    <style>
        #header, #footer {
            background: #fcfcfc none repeat scroll 0% 0%;
            flex-flow: row nowrap;
            justify-content: center;
            display: flex;
            align-content: stretch;
            align-items: center;
            height: 90px;
        }
        a, a:hover, a:focus, a:active{
            color:#333;
            cursor: pointer;
        }
        a:hover, a:focus, a:active{
            color:#007BC1;
            cursor: pointer;
        }
        #header {
            top: 0px;
        }

        #footer {
            bottom: 0px;
        }

        .flex-container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
            align-content: center;
            align-items: center;
        }

        .flex-items-default {
            width: 300px;
            height: 250px;
            flex-grow: 0;
            flex-shrink: 0;
            flex-basis: 0;
        }

        .flex-item-1 {

        }

        .flex-item-2 {

        }

        .item-head {
            font-weight: 600;
            font-size: 1.2vw;
        }

        .item, .item4 {
            font-size: 1.2vw;
            width: 80%;
            margin: auto;
            padding: 10px 0px;

        }

        .item4::before, .item2::before {
            height: 11px;
            border-left: 3px solid;
            border-top: 3px solid;
            transform: rotate(225deg);
            transform-origin: center center 0px;
            content: "";
            width: 11px;
            color: #E9516D;
            font-weight: 500;
            position: relative;
            display: inline-block;
            margin: 5px 5px;
        }

        .item2 {
            font-size: 1.2vw;
            width: 80%;
            margin: auto;
            padding: 10px 0px;
            text-align: justify;
        }

        .mid-item {
            height: 9vw;
            background: #FCFCFC none repeat scroll 0% 0%;
            text-align: center;
        }

        .mid2-item {
            text-align: center;
            padding: 10px;
            color:#333;
            background: #FCFCFC none repeat scroll 0% 0%;
            margin-bottom: 3.5vw;
        }
        .mid2-item:hover, .mid2-item:active, .mid2-item:focus{
            text-align: center;
            padding: 10px;
            color:#007BC1;
            background: #FCFCFC none repeat scroll 0% 0%;
            margin-bottom: 3.5vw;
            cursor:pointer;
        }
        .nav > li {
            position: relative;
            display: inline-block;
            width: 49%;
            margin: auto;
            color: inherit;
            text-align: center;
            background: none;
        }
        .nav > .active {
            position: relative;
            display: inline-block;
            width: 49%;
            margin: auto;
            color: #00a5a2;
            border-bottom: 3px solid #00a5a2;
            text-align: center;
            background: transparent none repeat scroll 0% 0%;
        }
        .border{
            border:1px solid red;
        }
        .nav > li > a:focus, .nav > li > a:hover {
            text-decoration: none;
            background: none;

        }
        .nav > li > a:focus, .nav > li > a {
            text-decoration: none;
            background: none;
            color: #333;
        }
        .panel-title {
            margin-top: 0px;
            margin-bottom: 0px;
            color: inherit;
            font-size: 1.5vw;
            font-weight: 300;
            text-align: left;
            border-radius: 4px;
            width: 100%;
            z-index: 1;
        }
        .mid3-item{
            text-align: justify;
        }
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            color: #00A5A2;
            cursor: default;
            border-color: #DDD #DDD transparent;
            -moz-border-top-colors: none;
            -moz-border-right-colors: none;
            -moz-border-bottom-colors: none;
            -moz-border-left-colors: none;
            border: none;
            background: none;
        }
        .nav-tabs > li > a:hover {
            border:none;
        }
        .panel-default > .panel-heading {
            background-color: #FCFCFC;
            border-color: #DDD;
            font-family: pfhighway,Helvetica,Arial,sans-serif;
            font-size: 30px;
            line-height: 36px;
            font-weight: 200;
            color: #74A3C7;
            display: flex;
            align-items: center;
            position: relative;
            -moz-user-select: none;
            padding: 5px 0px;
        }
        .panel-title > .small, .panel-title > .small > a, .panel-title > a, .panel-title > small, .panel-title > small > a {
            color: inherit;
            padding: 22px 40px 22px 25px;
            display: block;
            width: 100%;
            z-index: 1;
        }
        a:focus, a:hover {
            text-decoration: none;
        }
        .panel-heading::after {
            width: 8px;
            height: 8px;
            border-left: 2px solid;
            border-top: 2px solid;
            transform: rotate(225deg);
            transform-origin: center center 0px;
            transition: transform 0.3s ease 0s, -webkit-transform 0.3s ease 0s, -o-transform 0.3s ease 0s;
            content: "";
            display: block;
            position: absolute;
            right: 20px;
            top: 38px;
            z-index: 0;
        }
        .panel-group .panel {
            margin-bottom: -6px;
            border-radius: 4px;
        }
        .first{

        }
        .item-img {
            height: 150px;
        }
        .header-slide{
            background: #FCFCFC none repeat scroll 0% 0%;
            font-size: 2.5vw;
            text-align: center;
            padding: 10px;
            margin: 2.125vw 0px;
        }
        .sub-header-slide {
            background: #FCFCFC none repeat scroll 0% 0%;
            font-size: 1.5vw;
            text-align: center;
            margin-top: -2.125vw;
            margin-bottom: 2.125vw;
        }
    </style>
</head>
<body style="background:#fcfcfc ;font-family: Open Sans ,Helvetica Neue,sans-serif, sans-serif; font-style: normal; font-weight: 300; ">


<div id="header">
    <img src="/images/lp/OM_logo.png" style="display: flex; order: 0; flex: 0 1 auto; align-self: auto;"/>
</div>


<div class="col-md-12 " style="height:31.25vw  ;background: rgb(255, 213, 23) none repeat scroll 0% 0%; padding: 3% 0%;">
    <div>
        <div class="flex-container">
            <div style="text-align: center;" class="col-md-6">
                <img src="/images/lp/new.png" style="width: 25vw;" alt="Одежда Мастер">
            </div>
            <h1 style="text-align: left; font-size:  2.5vw; font-weight: 300" class="col-md-6">
                Товары оптом по выгодным ценам <br />для физических и юридических лиц!
            </h1>
        </div>

    </div>


</div>
<div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300">
        C нами выгодно и удобно работать
    </h2>

    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            Очень большой ассортимент
        </h3>
        <div class="item">
            Свыше 350 000 наименований товара!<br />До 500 новинок ежедневно!
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            5000 Рублей
        </h3>
        <div class="item">
            Минимальная закупка товара от 5000р. Начать работу очень легко
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            Пожалуй, самые низкие цены
        </h3>
        <div class="item">
            Мы продаем товары с минимальной наценкой
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            Удобное отслеживвание товара
        </h3>
        <div class="item">
            Всю информацию по заказам можно отследить в личном кабинете
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            Доставка по России и СНГ
        </h3>
        <div class="item">
            Работаем с ведущими транспортными компаниями
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <h3 class="item-head">
            Делайте заказ, где бы вы ни были
        </h3>
        <div class="item">
            Можете делать заказ как на сайте,<br />так и через мобильное приложение
        </div>
    </div>
</div>
<div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300">
        Цены на популярные категории товаров
    </h2>
    <h3 class="col-md-12 sub-header-slide" style="font-weight: 300">
        Наши оптовые цены, пожалуй самые низкие. Убедитесь сами!
    </h3>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1720">
        <div class="item-img">
            <img src="/images/lp/1item.png" alt="Платье">
        </div>
        <h3 class="item-head">
            Платье
        </h3>
        <div class="item">
            От 70р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1728">
        <div class="item-img">
            <img src="/images/lp/2item.png" alt="Блузка">
        </div>
        <h3 class="item-head">
            Блузка
        </h3>
        <div class="item">
            От 56р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1775">
        <div class="item-img">
            <img src="/images/lp/3item.png" alt="Футболка">
        </div>
        <h3 class="item-head">
            Футболка
        </h3>
        <div class="item">
            От 42р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1810">
        <div class="item-img">
            <img src="/images/lp/4item.png" alt="Кофта">
        </div>
        <h3 class="item-head">
            Кофта
        </h3>
        <div class="item">
            От 42р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1758">
        <div class="item-img">
            <img src="/images/lp/5item.png" alt="Джинсы">
        </div>
        <h3 class="item-head">
            Джинсы
        </h3>
        <div class="item">
            От 70р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1755">
        <div class="item-img">
            <img src="/images/lp/6item.png" alt="Куртка">
        </div>
        <h3 class="item-head">
            Куртка
        </h3>
        <div class="item">
            От 140р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1984">
        <div class="item-img">
            <img src="/images/lp/7item.png" alt="Кроссовки">
        </div>
        <h2 class="item-head">
            Кроссовки
        </h2>
        <div class="item">
            От 196р.
        </div>
    </a>
    <a class="col-md-3 mid2-item" style="display: block" href="/catalog?cat=1762">
        <div class="item-img">
            <img src="/images/lp/8item.png" alt="Белье">
        </div>
        <h2 class="item-head">
            Белье
        </h2>
        <div class="item">
            От 14р.
        </div>
    </a>
</div>
<div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300">
        Работаем с ведущими транспортными компаниями
    </h2>
    <h3 class="col-md-12 sub-header-slide" style="font-weight: 300">
        Доставка товара до транспортных компаний осуществляется бесплатно
    </h3>
    <div class="col-md-12">


        <ul class="nav nav-tabs" style="width: 60%; margin: auto auto  2.5vw; font-size: 1.2vw; font-weight: 500;">
            <li class="active"><a data-toggle="tab" href="#panel1">Доставка партнерам из России</a></li>
            <li><a data-toggle="tab" href="#panel2">Доставка партнерам из Москвы и МО</a></li>
        </ul>

        <div class="tab-content">
            <div id="panel1" class="tab-pane fade in active">
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Первая Экспедиционная компания»
                    </div>
                    <div class="item">
                        <a href="http://www.pecom.ru/ru/" >http://www.pecom.ru/ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Желдорэкспедиция»
                    </div>
                    <div class="item">
                        <a href="http://www.jde.ru/" >http://www.jde.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Деловые линии»
                    </div>
                    <div class="item">
                        <a href=" http://www.dellin.ru/" > http://www.dellin.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «ОПТИМА»
                    </div>
                    <div class="item">
                        <a href="http://www.77-11.ru/" >http://www.77-11.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «КИТ»
                    </div>
                    <div class="item">
                        <a href=" http://tk-kit.ru/" > http://tk-kit.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «ЭНЕРГИЯ»
                    </div>
                    <div class="item">
                        <a href=" http://nrg-tk.ru/" > http://nrg-tk.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Севертранс»
                    </div>
                    <div class="item">
                        <a href=" http://severtrans-msk.ru/" > http://severtrans-msk.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Почта России»
                    </div>
                    <div class="item">
                        <a href="http://www.pochta.ru/" >http://www.pochta.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Служба доставки Экспресс-Курьер»
                    </div>
                    <div class="item">
                        <a href="http://www.edostavka.ru/" >http://www.edostavka.ru/</a>
                    </div>
                </div>
            </div>
            <div id="panel2" class="tab-pane fade">
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «EMS Почта России»
                    </div>
                    <div class="item">
                        <a href=" http://www.emspost.ru/ru/" > http://www.emspost.ru/ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Деловые линии»
                    </div>
                    <div class="item">
                        <a href="http://www.dellin.ru/" >http://www.dellin.ru/</a>
                    </div>
                </div>
                <div class="col-md-4 mid-item">
                    <div class="item-head">
                        «Служба доставки Экспресс-Курьер»
                    </div>
                    <div class="item">
                        <a href="http://www.edostavka.ru/" >http://www.edostavka.ru/</a>
                    </div>
                </div>
                <div class="col-md-12 mid-item">
                    <div class="item-head">
                        Самовывоз
                    </div>
                    <div class="item">
                        Так же возможен самовывоз Московская область, Люберецкий р-он, пос.Томилино, деревня Кирилловка
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mid-item">
        <div class="item-head">
        </div>
        <div class="item2">
            Отгрузка товара осуществляется ближайшей отправкой выбранной Вами компанией из вышеперечисленных на следующий РАБОЧИЙ день или через день.
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <div class="item-head">
        </div>
        <div class="item2">
            Отгружаются только заказы оплаченные по порядку от более раннего к более позднему.
        </div>
    </div>
    <div class="col-md-4 mid-item">
        <div class="item-head">
        </div>
        <div class="item2">
            Заказы оплаченные выборочно отправляются только после оплаты предшествующих им неоплаченных заказов.
        </div>
    </div>
    <div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%; font-size: 1vw; text-align: center; margin: 5vh 0px;">

        <a class="" type="button" data-toggle="collapse" data-target="#collapsenext" aria-expanded="false" aria-controls="collapsenext">
            Развернуть полные условия по доставке
        </a>
        <div class="collapse" id="collapsenext">
            <div style="text-align: left; margin: 10px 0px;">
                <div class="item4">
                    Сопроводительные документы для ТК оформляются нами при подготовке Вашего заказа к отправке.
                </div>
                <div class="item4">
                    Грузы ТК: "Первая Экспедиционная компания", "КИТ", "Почта России", "Служба доставки Экспресс-Курьер", "Деловые линии","Энергия" отправляются из г. ИВАНОВО
                </div>
                <div class="item4">
                    Грузы ТК: "Желдорэкспедиция", "ОПТИМА", "Севертранс", ЕМС почта России отправляются из г. МОСКВЫ
                </div>
                <div class="item4">
                    Отправки ТК «Почта России» производятся 1 раз в неделю.  
                </div>
                <div class="item4">
                    Также возможна доставка через ЕМС почту России http://www.emspost.ru/ru/. Отправка заказов через почту ЕМС осуществляется 1-2 раза в неделю (по мере накопления заказов).
                </div>
                <div class="item4">
                    Оплата доставки осуществляется Вами при получении заказа.
                </div>

                </div>
        </div>

    </div>
</div>
<div class="" style="background: rgb(233, 81, 109) none repeat scroll 0% 0%;">
    <div class="col-md-12" style="text-align: center; background: rgb(233, 81, 109) none repeat scroll 0% 0%; color: aliceblue; font-size: 2.5vw; z-index: 8; padding: 2% 14%;">
        С нами работают и зарабатывают более 400 клиентов по всей России и СНГ
        <img src="/images/lp/strel.png" style="position: absolute; margin: auto; bottom: -45px; right: 0px; left: 0px; z-index: -1;">
    </div>
</div>
<div class="col-md-12" style="margin-top: 0px; background: rgb(245, 245, 245) none repeat scroll 0% 0%; padding: 150px 0px;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300; background: rgb(245, 245, 245) none repeat scroll 0% 0%;">
        Один шаг отделяет Вас от выгодных покупок!
    </h2>
    <h2 class="col-md-12 sub-header-slide" style="font-weight: 300; background: rgb(245, 245, 245) none repeat scroll 0% 0%;">
        Просто зарегистрируйтесь на сайте и выбирайте среди свыше 350 000 товаров по самым выгодным ценам.
    </h2>
    <div style="text-align: center;" class="col-md-12">
        <a class="number" style="padding:5px;font-size: 1.4vw;
font-weight: 500; display: inline-block; width: 25%; color:#00a5a2; min-width: 320px; height: 50px;border: 1px solid #00a5a2; border-radius: 4px; margin: 17px;" href="/signup">
            Зарегистрироваться
        </a>
    </div>
</div>
<div  class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300">
        Подробные условия работы и частые вопросы
    </h2>
    <div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%; font-size: 1.5vw; text-align: center; width: 90%; margin: 0px 5vw;">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            Условия оформления заказа </a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                При оформлении заказа необходимо выбрать транспортную компанию, которой Вы бы хотели осуществить доставку товара. Обязательно указывается полное  ФИО и паспортные данные (если они требуются в выбраной ТК). Если получателем по Вашему заказу будет другой человек, то Его данные  необходимо также указать.
                            </div>
                            <div class="item4">
                                Минимальная сумма заказа 5000 тысяч рублей. Но если после редактирования нами Вашего заказа его итоговая стоимость стал меньше 5000р., заказ в любом случае будет отправлен Вам сразу же после оплаты. К уже оформленному заказу Вы можете оформить Дозаказ на сумму от 1000 руб. (Дозаказ осуществляется так же, как обычный Заказ, с комментарием о том, что это Дозаказ). Поштучно можно заказывать любой товар, кроме того,  который продается упаковками.
                            </div>
                        </div>
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Заказы оплаченные выборочно отправляются только после оплаты  предшествующих им неоплаченных заказов.
                            </div>
                            <div class="item4">
                                Оформляйте заказ, внимательно ознакомившись с условиями определения размера, которые есть в разделе <a href="/article?view=sizes">«Размерная сетка»</a> на нашем сайте
                            </div>
                            <div class="item4">
                                В случае Вашего отказа от уже  оформленного Заказа ( не в день его оформления до 17:00, а позже), в  дальнейшем Ваши заказы будут приниматься к оформлению только  при 100%-ой предоплате. На сумму переплаты сможете оформлять дозаказы
                            </div>
                        </div>
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Убедительно просим осознанно, внимательно и тщательно  формировать свои заявки. После оформления заказа Вам на электронную почту придет перечень  вашего заказа- который нужно внимательно проверить. Заказы собираются индивидуально строго под каждого клиента, поэтому после оформления Вами заказа НЕЛЬЗЯ  ОТКАЗЫВАТЬСЯ И ВНОСИТЬ  ИЗМЕНЕНИЯ В СОБРАННЫЕ ЗАКАЗЫ. Отказ от заказа принимается только  в день его оформления.
                            </div>
                            <div class="item4">
                                При оформлении в 1 день нескольких заказов или дозаказов – они будут объединены в один общий заказ с одним присвоенным номером  (он автоматически будет отправлен  вам на электронную почту).  Оплачивать заказ нужно будет по  сумме, выставленной после сборки  заказа.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            Обработка заказа, сборка заказа </a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Заказ обрабатывается в течении 2-3 дней, после чего Вам выставляется счет (он находится в «личном кабинете» в «истории заказов»). Дождитесь когда статус Вашего заказа поменяется на ЖДЕМ ОПЛАТЫ. Сразу после этого выставится окончательный счет. Только после этого можно оплачивать.
                            </div>
                        </div>
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                При оформлении в 1 день нескольких заказов или дозаказов – они будут объединены в один общий заказ с одним присвоенным номером  (он автоматически будет отправлен  вам на электронную почту).  Оплачивать заказ нужно будет по  сумме, выставленной после сборки  заказа.
                            </div>
                        </div>
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Отгрузка товара осуществляется ближайшей отправкой на следующий рабочий день или через день после поступления оплаты.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            Порядок и способы оплаты</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Банковской карты у нас нет! Вы можете оплатить Ваши заказы через Сбербанк Онлайн (образец по оплате есть у нас на сайте ),также можете оплатить в кассе банка.  Все реквизиты для оплаты в счете.
                            </div>
                            <div class="item4">
                                При оплате выбирайте ПЕРЕВОД НА ОРГАНИЗАЦИЮ. Если выпадает регион ПЕРМЬ (это наш регион) продолжайте оплату.
                            </div>

                        </div>

                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Если Вы открыли собственный Юнистрим кошелек, персонифицировали и пополнили его счет, то Вы можете оплатить заказы с него также.
                            </div>
                            <div class="item4">
                                При уведомлении об оплате обязательно указывать  номера оплачиваемых заказов, сумму оплаты и дату платежа текстом в письме. Уточните отправлять оплаченные заказы или не отправлять?
                            </div>
                        </div>

                        <div class="col-md-4 mid3-item">
                            <div class="item4">
                                Оплата на расчетный счет проходит в течении 2-3 рабочих банковских дней. Как только придет оплата - Вам придет извещение на почту и статус Вашего заказа изменится на оплачен.Оплата в выходные дни не зачисляется.
                            </div>
                            <div class="item4">
                                Оплата в выходные дни не зачисляется.
                            </div>
                        </div>
                    </div>
                </div>
            </div><div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                            График работы офиса и службы сборки заказов </a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="col-md-12 mid3-item">
                            <div class="item4">
                                Cпециалисты контактного центра "Одежда-Мастер" работают по графику: c 8.00 до 20.00 7 дней в неделю и в праздники.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="col-md-12" style="background: #fcfcfc none repeat scroll 0% 0%; clear: both;">
    <h2 class="col-md-12 header-slide" style="font-weight: 300">
        Остались вопросы? Хотите пообщаться со специалистом?
    </h2>
    <h3 class="col-md-12 sub-header-slide" style="font-weight: 300">
        С удовольствием ответим на интересующие вопросы по будням с 8 до 20 часов по московскому времени
    </h3>
    <div style="text-align: center;" class="col-md-12">
        <a class="online" style="font-weight: 600;padding:5px; display: inline-block; color:rgb(0, 165, 161); width: 25%; min-width: 320px;height: 50px;border: 1px solid rgb(0, 165, 161); border-radius: 4px; margin: 17px;" href="/contactform">
            Помощь<br/><span>онлайн</span>
        </a>
        <div class="number" style="font-weight: 600;padding:5px; display: inline-block; width: 25%; color:rgb(234, 81, 109); min-width: 320px; height: 50px;border: 1px solid rgb(234, 81, 109); border-radius: 4px; margin: 17px;">
            Для клиентов из Москвы и МО<br/><span style="font-weight: 300">+7 (910) 996-0134</span>
        </div>
        <div class="number" style="font-weight: 600;padding:5px; display: inline-block; width: 25%; color:rgb(234, 81, 109); min-width: 320px; height: 50px;border: 1px solid rgb(234, 81, 109); border-radius: 4px; margin: 17px;">
            Телефон<br/><span style="font-weight: 300">+7 (495) 204-1583</span>
        </div>
        <a class="mail" style="font-weight: 600;padding:5px; display: inline-block; width: 25%; min-width: 320px; color:rgb(234, 81, 109); height: 50px;border: 1px solid #007BC1; border-radius: 4px; margin: 17px;" href="mailto:odezhdamaster@gmail.com">
            Администратор<br/><span style="font-weight: 300">+7 (915) 811-4051</span>
        </a>
        <a class="mail" style="font-weight: 600;padding:5px; display: inline-block; width: 25%; min-width: 320px; color:#007BC1; height: 50px;border: 1px solid #007BC1; border-radius: 4px; margin: 17px;" href="mailto:odezhdamaster@gmail.com">
            емейл<br/><span style="font-weight: 300">odezhdamaster@gmail.com</span>
        </a>
        <a class="mail" style="font-weight: 600;padding:5px; display: inline-block; width: 25%; min-width: 320px; color:#007BC1; height: 50px;border: 1px solid #007BC1; border-radius: 4px; margin: 17px;" href="skype:odezhda-master1?chat">
            Skype<br/><span style="font-weight: 300">odezhda-master1</span>
        </a>
    </div>
</div>
<div class="col-md-12" style="font-size: 18px; margin: auto; padding: 20px 6.7%;">
    <div class="social-pretext" style="display: inline-block; text-align: left; margin-right: 4vw;">
        А еще мы доступны в соцсетях для вопросов, общения, дружбы
    </div>
    <div class="social-link" style="display: inline-block; text-align: left;">
        <a style="display: inline-block; margin: 5px;" href="https://new.vk.com/odezdamast_shop">
            <img src="/images/lp/vk.png" alt="Группа Одежда Мастер в Вконтакте">
        </a>
        <a style="display: inline-block; margin: 5px;" href="https://ok.ru/odezhda.master">
            <img src="/images/lp/ok.png"  alt="Группа Одежда Мастер в Одноклассниках">
        </a>
        <a style="display: inline-block; margin: 5px;" href="https://www.instagram.com/odezhda_master/">
            <img src="/images/lp/inst.png"  alt="Группа Одежда Мастер в Инстаграме">
        </a>
    </div>
</div>
<div style="font-size: 18px; margin: auto; padding: 20px 6.7%;" class="col-md-12">
    <div style="display: inline-block; text-align: left; margin-right: 4vw;" class="pretext">
        Хотите заказывать новинки где угодно одним из самых первых? Тогда скачайте наше приложение
    </div>
    <div class="playmarket-link" style="display: inline-block; text-align: right;">
        <a class="play-market" style=" display: inline-block;" href="https://play.google.com/store/apps/details?id=com.codegeek.omshopmobile">
            <img src="/images/lp/google.png" style="width: 75%;">
        </a>
        <!--<div class="app-store" style="width: 48%; display: inline-block;">-->
        <!--<img src="/images/lp/app-store.png" style="width: 75%;">-->
        <!--</div>-->
    </div>

</div>
<div style="text-align: center;margin: 2.5vw 0px;" class="col-md-12">
    <a class="number" style="padding:5px;font-size: 1.4vw;
font-weight: 500; display: inline-block; background:#00a5a2;   width: 25%; color:#FCFCFC; min-width: 320px; height: 50px;border: 1px solid #00a5a2; border-radius: 4px; margin: 17px;" href="/catalog?cat=1632">
        Перейти в каталог товаров
    </a>
</div>

</body>
</html>
