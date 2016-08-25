<?php


?>
<style>
    .search-console {
        height: 100%;
        width: 80%;
        padding: 15px 59px;
        border: none;
        font-size: 16px;
        outline: none;
    }

    .search-console:active, .search-console:focus {
        border: none;
    }

    .sort-clients:after {
        content: "\2193";
    }

    .search-bar:before {
        height: 59px;
        width: 59px;
        content:'';
        background: url(/images/lksp/search.png) no-repeat 50% 50%;
        position: absolute;
    }
    #container2 {
        clear: left;
        width: 100%;
        overflow: hidden;
        background: #FFF;
        height: 80%;
        position: fixed;
        bottom: 0px;
    }
    #container1 {
        float: left;
        width: 100%;
        right: 70%;
        height: 80%;
        position: fixed;
    }

    #col1 {
        float: left;
        width: 30%;
        position: relative;
        left: 70%;
        border-right: 1px solid #CCC;
        height: 100%;
    }

    #col2 {
        float: left;
        width: 70%;
        position: relative;
        left: 70%;
        overflow: hidden;
        height: 100%;
    }


    .client-plate {
        height: 100%;
        width: 100%;
        border-bottom: 1px solid #CCC;
    }

    .client-avatar {
        width: 30%;
        height: 100%;
    }

    .avatar {
        height: 100px;
        width: 100px;
        position: relative;
        float: left;
    }

    .client-old {
        position: absolute;
        bottom: 17px;
        right: 29px;
        height: 16px;
        width: 16px;
        background: #CCC;
        border-radius: 45px;
    }

    .client-new {
        position: absolute;
        bottom: 17px;
        right: 29px;
        height: 16px;
        width: 16px;
        background: #009f9c;
        border-radius: 45px;
    }
    .client-vip {
        position: absolute;
        bottom: 17px;
        right: 29px;
        height: 16px;
        width: 16px;
        background: #6200ea;
        border-radius: 45px;
    }

    .client-info {
        display: block;
        height: 100%;
        width: 70%;
        margin: 0px 0px 0px 119px;
        position: relative;
    }
    .client-active:before {
        position: absolute;
        content: "\25B8";
        right: -15px;
        font-size: 30px;
        color: #CCC;
        line-height: 100px;
    }
    [class="client-plate client-active"]{
        background: #fff9c4;
    }
    .client-image {
        height: 70%;
        width: 70%;
        position: absolute;
        top: 0px;
        bottom: 0px;
        left: 0px;
        right: 0px;
        margin: auto;
        border-radius: 45px;
        background: #FFF;
        border: 1px solid #f6f6f6;
        background: url(/images/lksp/group6.png) no-repeat 50% 50%;
    }
    .client-info-fr{
        width: 100%;
        padding: 20px 0px;
    }
    .client-name{
        font-size: 16px;
        font-weight: 400;
        margin-bottom: 10px;
    }
    .client-board-avatar{
        width: 10%;
        display: inline-block;
        height: 190px;
        position: relative;
    }
    .client-board-plain{
        width: 90%;
        display: block;
        height: 190px;
        float: right;
        padding: 0px 30px;
    }
    .client-board{
        margin-left: 25px;
        border-bottom: 1px solid #CCC;
    }
    .client-orders-board{
        margin-left: 25px;
        margin-right: 25px;
    }
    .client-board-avatar-image {
        width: 100%;
        height: 50%;
        position: absolute;
        top: 0px;
        bottom: 0px;
        margin: auto;
        left: 0px;
        right: 0px;
    }
    .client-board-plain-info{
        height: 70%;
    }
    .client-board-plain-name{
        font-size: 24px;
        font-weight: 400;
        color: #4a90e2;
        padding: 10px 0px;
    }
    .client-orders-board-last{
        font-size: 20px;
        font-weight: 400;
        padding: 30px 0px;
    }
    .client-board-plain-info-col1{
        display: inline-block;
        width: 50%;
        height: 100%;
    }
    .client-board-plain-info-col2{
        width: 50%;
        float: right;
        height: 100%;
    }
    .client-board-plain-item{
        margin-bottom: 20px;
        font-weight: 400;
    }
    .client-plate:nth-of-type(odd){
        background: #f5f5f5;
    }
    .client-plate:nth-of-type(aven){
        background: #FFF;
    }
</style>
<div style="height: 50px;background: rgb(238, 238, 238);">
    <a style="font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;" href="#">Все клиенты</a>
    <a style="border-bottom: 2px solid #009f9c;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Новые</a>
    <a style="border-bottom: 2px solid #9B9B9B;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Постоянные</a>
    <a style="border-bottom: 2px solid #6200ea;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Вип клиенты</a>
</div>
<div style="border-bottom: 1px solid #CCC;height: 60px;background: #FFF">
    <div class="search-bar" style="height: 100%;width: 49%;display: inline-block;box-sizing: border-box;float: left;">
        <input class="search-console" style="" placeholder="Поиск по клиентам">
    </div>
    <div
        style="line-height: 60px;height: 100%;display: inline-block;box-sizing: border-box;width: 49%;float: right;text-align: right;padding: 0px 25px;">
        <div style="margin: 0px 20px;display:inline-block;margin:0px 20px;">Сортировать<a class="sort-clients" href="#">
                новые </a></div>
        <div style="margin: 0px 20px;display: inline-block">Дата с: <input
                style="height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;"">
        </div>
        <div style="display: inline-block">Дата по: <input
                style="height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;"">
        </div>
    </div>
</div>
<div id="container2">
    <div id="container1">
        <div id="col1">
            <div id="scroll1" style="height: 100%">
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-vip">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate  client-active">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-old">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">
                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">

                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">

                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-plate">
                <div class="client-avatar">
                    <div class="avatar">
                        <div class="client-image">

                        </div>
                        <div class="client-new">

                        </div>
                    </div>

                </div>
                <div class="client-info">
                    <div class="client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order">
                            Последний заказ: № 10036
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div id="col2">
            <div id="scroll2" style="height: 100%">
            <div class="client-board">
                <div class="client-board-avatar" >
                    <div class="client-board-avatar-image">
                        <div class="avatar">
                            <div class="client-image">

                            </div>
                            <div class="client-new">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="client-board-plain">
                    <div class="client-board-plain-name">
                        <div>Егоров Дмитрий Владимирович</div>
                    </div>
                    <div class="client-board-plain-info">
                        <div class="client-board-plain-info-col1">
                            <div  class="client-board-plain-item">
                                Дата рождения: 17 августа 1985
                            </div>
                            <div  class="client-board-plain-item">
                                Статус клиента: Новый
                            </div>
                            <div  class="client-board-plain-item">
                                Зарегистрирован: 20 июня 2015
                            </div>
                        </div>
                        <div class="client-board-plain-info-col2">
                            <div  class="client-board-plain-item">
                                E-mail: gedeon34@bk.ru
                            </div>
                            <div  class="client-board-plain-item">
                                Телефон: +79300056787
                            </div>
                            <div  class="client-board-plain-item">
                                Адрес: г. Кохма, ул. Ивановская, д.38Б, кв. 56
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="client-orders-board">
                <div class="client-orders-board-last">
                    <div>Последний заказ 5 дней назад (5 августа 2016)</div>
                </div>
                <div class="client-orders-board-table">
                    <?php

                    \yii\widgets\Pjax::begin(['id' => 'notes']);
                    $myArray = [
                        '0' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '1' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '2' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '3' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '4' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '5' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '6' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '7' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '8' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '9' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '10' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '11' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '12' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '13' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '14' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '15' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '16' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '2', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                        '17' => ['id' => 10036, 'file' => '1.txt', 'stroka' => '3', 'key' => '10.09.2016', 'value' => '25000руб.', 'description' => 'Оплачен'],
                    ];
                    $dataProvider = new \yii\data\ArrayDataProvider([
                        'key' => 'id',
                        'allModels' => $myArray,
                        'sort' => [
                            'attributes' => ['id', 'key', 'value', 'description'],
                        ],
                        'pagination' => [
                            'pageSize' => 10,
                        ],
                    ]);
                    echo \yii\grid\GridView::widget([
                        'tableOptions' => [
                            'class' => 'table table-striped'
                        ],
                        'dataProvider' => $dataProvider,
                        'showHeader'=> false,
                        'layout' => "{items}\n{pager}",
                        'columns' => [
                            'id',
                            'key',
                            'value',
                            'description',
                        ],
                    ]);
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    (function($){
        $(window).on("load",function(){
            $("#scroll1").mCustomScrollbar({
                theme: "dark",
                axis: "y",
                contentTouchScroll: "TRUE",
                advanced: {autoExpandHorizontalScroll: true}
            } );
            $("#scroll2").mCustomScrollbar({
                theme: "dark",
                axis: "y",
                contentTouchScroll: "TRUE",
                advanced: {autoExpandHorizontalScroll: true}
            } );
        });
    })(jQuery);
</script>