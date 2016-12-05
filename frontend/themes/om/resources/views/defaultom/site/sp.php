<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Интернет магазин Одежда Мастер. Товары оптом по выгодным ценам для физических и юридических лиц</title>
    <meta name="author" content="OM GROUP">
    <?=\yii\helpers\Html::csrfMetaTags(); ?>
    <meta name="description" content="Интернет магазин Одежда Мастер. Товары оптом по выгодным ценам для физических и юридических лиц!">
    <meta name="keywords" content="интернет магазин,аксессуары, платья,футболки, женские, костюмы, брюки, одежда, обувь, мастер, товары, оптом, выгодные цены">
    <meta name="Resource-type" content="Document">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,500italic,700,700italic,900italic,900" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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
        a, a:hover, a:focus, a:active {
            color: #333;
            cursor: pointer;
        }
        a:hover, a:focus, a:active {
            color: #007BC1;
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
            color: #333;
            background: #FCFCFC none repeat scroll 0% 0%;
            margin-bottom: 3.5vw;
        }
        .mid2-item:hover, .mid2-item:active, .mid2-item:focus {
            text-align: center;
            padding: 10px;
            color: #007BC1;
            background: #FCFCFC none repeat scroll 0% 0%;
            margin-bottom: 3.5vw;
            cursor: pointer;
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
        .border {
            border: 1px solid red;
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
        .mid3-item {
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
            border: none;
        }
        .panel-default > .panel-heading {
            background-color: #FCFCFC;
            border-color: #DDD;
            font-family: pfhighway, Helvetica, Arial, sans-serif;
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
        .first {
        }
        .item-img {
            height: 150px;
        }
        .header-slide {
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
        .alert-sys-error {
            padding: 5px;
            border-radius: 4px;
            position: fixed;
            bottom: 50%;
            right: 0px;
            border: 1px solid #ea516d;
            z-index: 9999;
            color: #FFF;
            background: #ea516d;
            font-weight: 400;
            margin-bottom:0px;
        }
        .alert-sys-warning {
            padding: 5px;
            border-radius: 4px;
            position: fixed;
            bottom: 50%;
            right: 0px;
            border: 1px solid #febd13;
            z-index: 9999;
            color: #FFF;
            background: #febd13;
            font-weight: 400;
            margin-bottom:0px;
        }
        .alert-sys-danger {
            padding: 5px;
            border-radius: 4px;
            position: fixed;
            bottom: 50%;
            right: 0px;
            border: 1px solid #febd13;
            z-index: 9999;
            color: #FFF;
            background: #febd13;
            font-weight: 400;
            margin-bottom:0px;
        }
        .alert-sys-info {
            padding: 5px;
            border-radius: 4px;
            position: fixed;
            bottom: 50%;
            right: 0px;
            border: 1px solid #4a90e2;
            z-index: 9999;
            color: #FFF;
            background: #4a90e2;
            font-weight: 400;
            margin-bottom:0px;
        }
        .alert-sys-success {
            padding: 5px;
            border-radius: 4px;
            position: fixed;
            bottom: 50%;
            right: 0px;
            border: 1px solid #19a09d;
            z-index: 9999;
            color: #FFF;
            background: #19a09d;
            font-weight: 400;
            margin-bottom:0px;
        }
    </style>
</head>
<body style="min-width: 1440px;no-repeat 50% 0%;margin:auto;font-family: Roboto ,Helvetica Neue,sans-serif, sans-serif;font-style: normal;font-weight: 300;">
<?= \frontend\widgets\Alert::widget() ?>
<div style="background: white; z-index: 2; height: 180px; font-size: 40px; font-weight: 400; text-align: center; padding: 70px 0px;">
    Хотите ДЕШЕВО покупать ХОРОШИЕ вещи?
    <div style="font-size: 24px; line-height: 45px;">
        Вступайте в клуб совместных закупок на Одежда-Мастер!
    </div>
</div>
<div style="z-index: 2; height: 820px; font-size: 40px; font-weight: 400; text-align: center;">
    <div style="font-size: 24px; line-height: 45px; height: 100%;">
        <div style="width: 30%; height: 90%; display: inline-block; margin: auto; position: relative;">
            <div style="width: 49%; height: 100%; float: left;">
                <div style="height: 50%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/vest.png"></div>
                        <div style="margin-top: 25px;">Куртки<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 50%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/pants.png"></div>
                        <div style="margin-top: 25px;">Брюки<br>от 98р.</div>
                    </div>
                </div>
            </div>
            <div style="width: 49%; height: 100%; float: right;">
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/dress.png"></div>
                        <div style="margin-top: 25px;">Платья<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/blouse.png"></div>
                        <div style="margin-top: 25px;">Блузки<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/shirt.png"></div>
                        <div style="margin-top: 25px;">Футболки<br>от 98р.</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 39%; display: inline-block; position: relative; height: 100%;">
            <div style="position: absolute; z-index: 2; font-size: 40px; font-weight: 400; text-align: center; top: 0px; bottom: 0px; left: 0px; right: 0px;">
                <img style="z-index: 72;" src="/images/lp/girl1.png">
            </div>
        </div>
        <div style="width: 30%; height: 90%; display: inline-block;">
            <div style="width: 49%; height: 100%; float: left;">
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/brassiere.png"></div>
                        <div style="margin-top: 25px;">Нижнее белье<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/handbag.png"></div>
                        <div style="margin-top: 25px;">Сумки<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 33%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/shoe.png"></div>
                        <div style="margin-top: 25px;">Кеды<br>от 98р.</div>
                    </div>
                </div>
            </div>
            <div style="width: 49%; height: 100%; float: right;">
                <div style="height: 50%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/stilettos.png"></div>
                        <div style="margin-top: 25px;">Туфли<br>от 98р.</div>
                    </div>
                </div>
                <div style="height: 50%; position: relative;">
                    <div style="position: absolute; bottom: 0px; right: 0px; left: 0px; top: 0%; height: 200px; margin: auto; font-size: 19px; line-height: 30px;">
                        <div><img src="/images/lp/sunglasses.png"></div>
                        <div style="margin-top: 25px;">Очки от солнца<br>от 98р.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="z-index: 1; height: 195px; font-size: 40px; font-weight: 400; text-align: center; position: relative;">
    <div style="background:url(/images/lp/Path6Copy.png) 50% 0% no-repeat; background-size: cover ;position: absolute; z-index: 2; font-size: 40px; font-weight: 400; text-align: center; top: 0px; bottom: 0px; left: 0px; right: 0px;">
    </div>
    <div style="background:url(/images/lp/Path6.png) 50% 0% no-repeat; background-size: cover;position: absolute; z-index: 2; font-size: 40px; font-weight: 400; text-align: center; top: 0px; bottom: 0px; left: 0px; right: 0px;">
    </div>
    <!--Якорь после оправки формы-->
    <div id="inviteForm" style="background: #FFF;border-radius: 4px;position: absolute; z-index: 2; height: 115px; font-size: 40px; font-weight: 400; text-align: center; top: 130px; left: 0px; right: 0px; margin: 5px 210px; padding: 30px;">
        <div style="border-radius: 4px; position: relative;">
            <div style="position: absolute; top: 0px; bottom: 0px; left:0px; right: 0px; margin: auto;">

                <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'form-invite']); ?>
                <?= $form->field($model, 'email', [
                    'options'=>[
                    ],
                    'template' => '{input}',
                    'inputOptions'=>[
                        'placeholder'=>'Ваш E-mail',
                        'value' => Yii::$app->request->queryParams['model']['email'] ? Yii::$app->request->queryParams['model']['email'] : '',
                        'class'=>'',
                        'style'=>'display: inline-block; width: 47%; float: left; font-size: 24px; line-height: 60px; border: 2px solid rgb(204, 204, 204); border-radius: 4px; height: 60px; text-align: center;'
                    ]
                ])->label(false); ?>
                <?= \yii\helpers\Html::submitButton('Зарегистрироваться', [
                    'class' => 'btn btn-primary',
                    'name' => 'signup-button',
                    'style'=>'outline: none;border: none;display: inline-block; width: 45%; font-size: 24px; line-height: 50px; float: right; color: rgb(255, 255, 255); border-radius: 4px; height: 60px; background: rgb(234, 81, 109) none repeat scroll 0% 0%;']) ?>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div style="background: rgb(122, 72, 220) none repeat scroll 0% 0%; color: rgb(255, 255, 255); height: 720px; font-size: 36px; font-weight: 400; text-align: left; position: relative; padding-top: 20px;">
    <div style="width: 49%; height: 100%; float: left; position: relative;">
        <div style="height: 400px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto; padding: 30px;">
            <div style="height: 130px; padding: 30px;">
                Почему я совершаю совместные покупки на Одежде-Мастер?
            </div>
            <div style="height: 200px; padding: 30px;">
                <img src="/images/lp/arrow_green_up.png">
            </div>
        </div>
    </div>
    <div style="width: 49%; height: 100%; float: right; position: relative;">
        <div style="height: 600px; position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto; padding: 30px;">
            <div style="height: 200px; width: 100%; padding: 30px;">
                Очень большой ассортимент
                <p style="font-size: 24px">
                    Свыше 350 000 наименований товара!
                    <br>
                    До 2000 новинок ежедневно!
                </p>
            </div>
            <div style="height: 200px; width: 100%; padding: 30px;">
                Всего 5000р.
                <p style="font-size: 24px">
                    Сумма заказа, при которой совместная покупка состоится. Не придется долго ждать пока наберется большая группа
                </p>
            </div>
            <div style="height: 200px; width: 100%; padding: 30px;">
                Удобное отслеживание товара
                <p style="font-size: 24px">
                    Всю информацию по заказу можно отследить в личном кабинете
                </p>
            </div>
        </div>
    </div>
</div>
<div style="z-index: 1; height: 540px; font-size: 40px; font-weight: 400; text-align: center; position: relative;">
    <div style="background: white none repeat scroll 0% 0%; z-index: 2; height: 180px; font-size: 40px; font-weight: 400; text-align: center; padding: 70px 0px;">
        Как работают совместные покупки?
    </div>
    <div style="height: 360px; margin-top: -50px;">
        <div style="position: relative; height: 360px; width: 100%;">
            <div style="width: 15%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/OM_logo.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 24px;">Совместный заказ я<br>размещаю в оптовой<br>компании</div>
                    </div>
                </div>
            </div>
            <div style="width: 5%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/right-arrow.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 36px;"></div>
                    </div>
                </div>
            </div>
            <div style="width: 10%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;  font-size: 18px; line-height: 20px; color: rgb(136, 136, 136); padding: 100px 0px;">
                                <img src="/images/lp/krestik.png" style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto; ">Магазин<br>(Посредник)
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 24px;">В процессе закупки<br>исключаются<br>посредники</div>
                    </div>
                </div>
            </div>
            <div style="width: 5%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/right-arrow.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 36px;"></div>
                    </div>
                </div>
            </div>
            <div style="width: 15%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/shop.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 24px;">Организатор<br>закупки</div>
                    </div>
                </div>
            </div>
            <div style="width: 5%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/right-arrow.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 36px;"></div>
                    </div>
                </div>
            </div>
            <div style="width: 10%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;  font-size: 18px; line-height: 20px; color: rgb(136, 136, 136); padding: 100px 0px;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;  " src="/images/lp/krestik.png">Розничная<br>наценка
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 24px;">И всевозможные<br>розничные наценки</div>
                    </div>
                </div>
            </div>
            <div style="width: 5%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/right-arrow.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 36px;"></div>
                    </div>
                </div>
            </div>
            <div style="width: 15%; display: inline-block; height: 100%;">
                <div style="position: relative; height: 100%; width: 100%;">
                    <div style="position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; height: 300px;">
                        <div style="height: 80%; position: relative;">
                            <div style="position: absolute; top: 0px; left: 0px; right: 0px; bottom: 0px; margin: auto; height: 100%;">
                                <img style="position: absolute; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;" src="/images/lp/shop_girl.png">
                            </div>
                        </div>
                        <div style="height: 30%; font-size: 18px; line-height: 24px;">Вы получаете<br>модный товар<br>по оптовой цене</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="z-index: 1; height: 630px; font-size: 40px; font-weight: 400; text-align: center; position: relative;">
    <div style="border-top:2px solid #CCC; background: white; z-index: 2; height: 180px; font-size: 40px; font-weight: 400; text-align: center; padding: 70px 0px;">
        Какая цена нравится больше?
    </div>
    <div style="width: 100%;position: absolute;">
        <div style="width: 30%; display: inline-block; height: 100%; position: relative; text-align: left; padding: 0px 70px;">
            <div style="
    width: 100%;
">350p.<p style="font-size: 22px;">цена на Одежда-Мастер</p></div>
            <div style="position: relative;width: 100%;">
                <img src="/images/lp/arrow_green_down.png" style="">
            </div>
        </div>
        <div style="width: 30%; display: inline-block; height: 100%; position: relative; top: 120px;">
            <img src="/images/lp/bosonozka.png" style="position: relative; top: 0px; bottom: 0px; right: 0px; left: 0px; margin: auto;">
        </div>
        <div style="width: 30%; display: inline-block; height: 100%; position: relative; text-align: right; padding: 0px 70px;">
            <div style="
    width: 100%;
">950p.<p style="font-size: 22px;">цена розничного продавца</p></div>
            <div style="position: relative;width: 100%;">
                <img src="/images/lp/arrow_blue.png" style="">
            </div>
        </div>
    </div>
</div>
<div style="background:rgb(250, 40, 90); z-index: 1; height: 290px; font-size: 40px; font-weight: 400; text-align: center; position: relative;">
    <div style="border-radius: 4px; display: inline-block; left: 60px; position: absolute; text-align: left; font-size: 48px; top: 70px; color: rgb(255, 255, 255);">
        Начни экономить<br> до 100% на покупках!
    </div>
    <div style="border-radius: 4px;position: absolute;display: inline-block;top: 0px;bottom: 0px;height: 50%;margin: auto;">
        <?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'form-invite-down']); ?>
        <?= $form->field($model, 'email', [
            'options'=>[
            ],
            'template' => '{input}',
            'inputOptions'=>[
                'placeholder'=>'Ваш E-mail',
                'value' => Yii::$app->request->queryParams['model']['email'] ? Yii::$app->request->queryParams['model']['email'] : '',
                'class'=>'',
                'style'=>'width: 100%; font-size: 24px; line-height: 60px; border: 2px solid rgb(204, 204, 204); border-radius: 4px; height: 60px; text-align: center; margin-bottom: 15px;'
            ]
        ])->label(false); ?>
        <?= \yii\helpers\Html::submitButton('Зарегистрироваться', [
            'class' => 'btn btn-primary',
            'name' => 'signup-button',
            'style'=>' outline: none;border: none; width: 100%; font-size: 24px; line-height: 50px; border-radius: 4px; height: 60px; background: rgb(68, 226, 194) none repeat scroll 0% 0%; color: rgb(0, 0, 0);']) ?>
        <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div style="z-index: 1; height: 235px; font-size: 40px; font-weight: 400; text-align: center; position: relative; background: rgb(120, 211, 62) none repeat scroll 0% 0%; color: rgb(255, 255, 255);">
    <a  href="/catalog?cat=1632" style="z-index: 1;height: 235px;font-size: 40px;font-weight: 400;text-align: center;position: relative;background: rgb(120, 211, 62) none repeat scroll 0% 0%;color: rgb(255, 255, 255);margin: auto;line-height: 6;">
        Перейти в каталог товаров
    </a>
    <img style="position: absolute; right: 0px; bottom: 0px;" src="/images/lp/girl2.png" />
</div>


</body></html>