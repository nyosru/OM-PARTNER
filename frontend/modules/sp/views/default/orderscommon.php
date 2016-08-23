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
        content: '';
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

    .client-info-orders {
        display: block;
        height: 100%;
        width: 55%;
        margin: 0px 0px 0px 119px;
        position: relative;
    }
    .client-line-info-orders {
        display: block;
        height: 100%;
        width: 75%;
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

    [class="client-plate client-active"] {
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

    .client-info-fr-order {
        width: 50%;
        padding: 20px 0px;
        display: inline-block;
    }
    .client-info-fr-price {
        padding: 25px 0px;
        display: inline-block;
        float: right;
    }
    .client-name {
        font-size: 16px;
        font-weight: 400;
        margin-bottom: 10px;
    }

    .client-plate:nth-of-type(odd) {
        background: #f5f5f5;
    }

    .client-plate:nth-of-type(aven) {
        background: #FFF;
    }

    .client-order-num {
        color: #4A90E2;
        font-weight: 400;
        display: inline-block;
        font-size: 18px;
    }

    .client-order-status {
        width: 30px;
        height: 20px;
        display: inline-block;
        border-radius: 4px;
        margin: 0px 10px;
    }

    .status-new {
        background: #009f9c none repeat scroll 0% 0%;
    }

    .status-proceed {
        background: #5b8acf none repeat scroll 0% 0%;
    }

    .status-like {
        background: #ffea00 none repeat scroll 0% 0%;
    }

    .status-payed {
        background: #ff5722 none repeat scroll 0% 0%;
    }

    .status-ordered {
        background: #9c27b0 none repeat scroll 0% 0%;
    }

    .status-return {
        background: #ff1744 none repeat scroll 0% 0%;
    }

    .status-cancel {
        background: #d8d8d8 none repeat scroll 0% 0%;
    }

    .sp-client-info {
        display: block;
        height: 100%;
        width: 30%;
        position: relative;
        float: right;
        border: 1px solid #CCC;
        border-radius: 4px;
    }

    .sp-client-info-fr {
        padding: 20px;
    }

    .sp-client-info-dr {
        padding: 10px 20px;
    }

    .client-row {
        font-size: 14px;
        font-weight: 400;
        margin-bottom: 5px;
    }

    .client-all-orders {
        margin: 20px 0px;
        width: 100%;
        background: #009f9c;
        color: #FFF;
    }

    .client-all-orders:hover, .client-all-orders:active {
        background: #009f9c;
        color: #FFF;
    }

    .all-num-order {
        font-size: 24px;
        font-weight: 400;
        color: #5b8acf;
    }

    .date-order {
        margin: 0px 10px;
    }

    .status-order {
        padding: 2px 5px;
        border-radius: 4px;
        color: #FFF;
        font-weight: 400;
    }

    .to-order {
        display: inline-block;
        width: 33%;
        text-align: center;
        padding: 5px;
        background: #ffea00;
        border-radius: 4px;
        font-weight: 400;
    }

    .to-order:after {
        content: "\2193";
        padding: 0px 10px;
    }

    .edit-line {
        margin: 10px 0px;
    }

    .edit-order:before {
        content: "";
        height: 20px;
        width: 20px;
        display: inline-block;
        background: url(/images/lksp/edit.png) no-repeat 50% 50%;
        padding: 0px;
        margin: -5px 10px;
    }

    .edit-order {
        display: inline-block;
        width: 33%;
        text-align: center;
    }

    .mail-client {
        display: inline-block;
        width: 33%;
        text-align: center;
    }

    .mail-client:before {
        content: "";
        height: 20px;
        width: 30px;
        display: inline-block;
        background: url(/images/lksp/mail.png) no-repeat 50% 50%;
        padding: 0px;
        margin: -5px 10px;
    }
    .product-comment:before {
        content: "";
        height: 15px;
        width: 15px;
        display: inline-block;
        background: url(/images/lksp/plus.png) no-repeat 0% 0% /cover;
        padding: 0px;
        margin: -3px 10px;
    }
    .product-card {
        margin: 15px 0px;
        padding: 15px 0px;
        border-bottom: 1px solid #CCC;
    }
    .product-card:last-child {
        border-bottom: none;
    }

</style>
<div style="height: 50px;background: rgb(238, 238, 238);">
    <a style="font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;" href="#">Все заказы</a>
    <a style="border-bottom: 2px solid #009f9c;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Новые</a>
    <a style="border-bottom: 2px solid #5b8acf;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">В обработке</a>
    <a style="border-bottom: 2px solid #ffea00;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Одобренные</a>
    <a style="border-bottom: 2px solid #ff5722;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Оплаченные</a>
    <a style="border-bottom: 2px solid #9c27b0;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Выполненные</a>
    <a style="border-bottom: 2px solid #ff1744;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Возврат</a>
    <a style="border-bottom: 2px solid #d8d8d8;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Удален</a>
</div>
<div style="border-bottom: 1px solid #CCC;height: 60px;background: #FFF">
    <div class="search-bar" style="height: 100%;width: 49%;display: inline-block;box-sizing: border-box;float: left;">
        <input class="search-console" style="" placeholder="Поиск по заказам">
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-proceed"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                       <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-new"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-like"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-payed"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-return"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-cancel"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-ordered"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-like"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
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
                <div class="client-line-info-orders">
                    <div class="client-info-fr-order">
                        <div class="client-order">
                            <div class="client-order-num"> № 10036</div>
                            <div class="client-order-status status-like"></div>
                        </div>
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-last-order-date">
                            10 августа 2016 12:10
                        </div>
                    </div>
                    <div class="client-info-fr-price">
                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">13144 руб.</div>
                        <div>Мой %: 1314 руб.</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="col2">
            <div id="scroll2" style="height: 100%">
            <div style="margin:25px;">
                <div style="width: 70%;  display:inline-block;">
                    <div style="margin-right: 25px;">
                    <div class="order-line">
                        <span class="all-num-order">Заказ № 10036</span>
                        <span class="date-order">от 10 августа 2016</span>
                        <span class="status-order status-new">новый</span>
                    </div>
                    <div class="edit-line">
                        <div class="to-order">В общий заказ</div>
                        <div class="edit-order">Редактировать заказ</div>
                        <div class="mail-client">Написать клиенту</div>
                    </div>
                    <div>
                        <div style=""  class="product-card">
                            <div  style="" class="product-main-board">
                                <div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                  <img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div>250 p. x 2шт.</div>
                                        <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <div  style="cursor:pointer;color: #5b8acf;" class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                            </div>
                        </div>
                        <div style=""  class="product-card">
                            <div  style="" class="product-main-board">
                                <div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                    <img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div>250 p. x 2шт.</div>
                                        <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <div  style="cursor:pointer;color: #5b8acf;" class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                            </div>
                        </div>
                        <div style=""  class="product-card">
                            <div  style="" class="product-main-board">
                                <div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                    <img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div>250 p. x 2шт.</div>
                                        <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div>
                                    </div>
                                </div>
                            </div>
                            <div >
                                <div  style="cursor:pointer;color: #5b8acf;" class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                            </div>
                        </div>
                    </div>
                        <div style="
    border-top: 1px solid #CCC; font-weight: 400;  font-size: 32px; text-align: right;padding: 10px 25px;">Итого: 1500 р.</div>
                </div>
                </div>
                <div class="sp-client-info">
                    <div class="client-avatar">
                        <div class="avatar">
                            <div class="client-image">
                            </div>
                            <div class="client-vip">

                            </div>
                        </div>

                    </div>
                    <div class="sp-client-info-fr">
                        <div class="client-name">
                            Егоров Дмитрий Владимирович
                        </div>
                        <div class="client-register">
                            Зарегистрирован: 10 августа 2016
                        </div>
                    </div>
                    <div class="sp-client-info-dr">
                        <div class="client-row">
                            Заказов: 2
                        </div>
                        <div class="client-row">
                            Статус клиента: Новый
                        </div>
                        <div class="client-row">
                            gedeon@bk.ru
                        </div>
                        <div class="client-row">
                            +79300056787
                        </div>
                        <div class="btn btn-default client-all-orders">
                            Все заказы клиента
                        </div>
                    </div>
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