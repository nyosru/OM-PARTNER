
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
<form style="height: 60px;background: #FFF">
    <div class="search-bar" style="height: 100%;width: 49%;display: inline-block;box-sizing: border-box;float: left;">
        <input class="search-console" value="<?=Yii::$app->request->getQueryParam('search')?>" name="search" placeholder="Поиск по клиентам">
        <?php
        echo \yii\helpers\Html :: hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);
        ?>
    </div>
    <div
        style="line-height: 60px;height: 100%;display: inline-block;box-sizing: border-box;width: 49%;text-align: right;padding: 0px 25px;">
        <div style="float: left;width: 50%;position: relative;">Сортировать<a  href="#sorting" data-toggle="collapse" aria-expanded="true" class="sort-clients">
                новые </a>
            <div id="sorting" style="width: 200px; position: absolute; z-index: 98; right: 0px;     top: 40px;" class="collapse" aria-expanded="true">
                <div id="sort-order">
                    <div class="header-sort sort sort-checked" data="0">
                        <a class="sort " data="3" style="line-height: 20px" href="?cat=932"><div class="header-sort-item-model header-sort-item lock-on">Статус</div></a>
                        <a class="sort " data="3" style="line-height: 20px" href="?cat=932"><div class="header-sort-item-model header-sort-item lock-on">ФИО</div></a>
                        <a class="sort " data="3" style="line-height: 20px" href="?cat=932"><div class="header-sort-item-model header-sort-item lock-on">Последний заказ</div></a>
                        <a class="sort " data="3" style="line-height: 20px" href="?cat=932"><div class="header-sort-item-model header-sort-item lock-on">Зарегистрирован</div></a>
                    </div>
                </div></div></div>
        <div style="margin: -5px 20px;display: inline-block;">
            <?=\kartik\date\DatePicker::widget([
                'language'=>'ru',
                'layout'=>'<div>
                            <div style="display: inline-block;float: left;line-height: 20px; padding: 0px 20px;">Дата с: </div>
                            {input1}
                            <div style=" display: inline-block; float: left; line-height: 20px;padding: 0px 20px;" >Дата по:</div>
                            {input2}
                            </div>',
                'name' => 'ds',
                'name2' => 'de',
                'value'=> (new \DateTime(date(Yii::$app->request->getQueryParam('ds'))))->format('Y-m-d'),
                'value2'=>(new \DateTime(date(Yii::$app->request->getQueryParam('de'))))->format('Y-m-d'),
                'type' => \kartik\date\DatePicker::TYPE_RANGE,
                'options'=>[
                    'style'=>"height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;"
                ],
                'options2'=>[
                    'style'=>"height: 20px;width: 100px;border-radius: 4px;border: 1px solid #CCC;display: inline-block;float: left;"
                ],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);?>
        </div>
    </div>
    <?= \yii\helpers\Html::submitButton('Submit', [
            'class'=> 'btn btn-primary',
            'style'=> 'display:none']
    ) ;?>

</form>
<div id="container2">
    <div id="container1">
        <div id="col1">
            <div id="scroll1"  class="" style="height: 100%">
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
            <div id="scroll2" class="" style="height: 100%">
            <div style="margin:25px;">
                <div style="width: 100%;  display:inline-block;">
                    <div>
                        <div class="order-line">
                            <span class="order-retry">Назад</span>
                            <span class="all-num-order">Заказ № 10036</span>
                            <span class="date-order">от 10 августа 2016</span>
                        </div>
                        <div>
                            <div style="width: 100%;font-size: 18px;padding: 15px 0px;">
                                Комментарий к заказу
                            </div>
                            <textarea
                                style="resize:none;margin: 0px;width: 100%;height: 200px;border-radius: 4px;border: 1px solid #CCC;"></textarea>
                        </div>
                        <div style="" class="product-card-edit">
                            <div style="" class="product-main-board">
                                <div
                                    style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                    <img height="100%" src="/imagepreview?src=1345499"
                                         style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 20%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div
                                    style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;">
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Цена
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Количество
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">
                                                <div class="size-desc"
                                                     style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">
                                                    <div style=""><input id="input-count"
                                                                         style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;"
                                                                         data-prod="1691573" data-model="961000846"
                                                                         data-price="210"
                                                                         data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG"
                                                                         data-count="10000" data-attrname=""
                                                                         data-attr="" data-name="Шапка" data-step="1"
                                                                         data-min="1" placeholder="0" type="text">
                                                        <div id="add-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;">
                                                            +
                                                        </div>
                                                        <div id="del-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;">
                                                            -
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Сумма
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: relative;">
                                <div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;"
                                     class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                                <div
                                    style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;"
                                    class="product-delete">
                                    Удалить товар из заказа
                                </div>
                            </div>
                        </div>
                        <div style="" class="product-card-edit">
                            <div style="" class="product-main-board">
                                <div
                                    style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                    <img height="100%" src="/imagepreview?src=1345499"
                                         style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 20%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div
                                    style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;">
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Цена
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Количество
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">
                                                <div class="size-desc"
                                                     style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">
                                                    <div style=""><input id="input-count"
                                                                         style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;"
                                                                         data-prod="1691573" data-model="961000846"
                                                                         data-price="210"
                                                                         data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG"
                                                                         data-count="10000" data-attrname=""
                                                                         data-attr="" data-name="Шапка" data-step="1"
                                                                         data-min="1" placeholder="0" type="text">
                                                        <div id="add-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;">
                                                            +
                                                        </div>
                                                        <div id="del-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;">
                                                            -
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Сумма
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: relative;">
                                <div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;"
                                     class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                                <div
                                    style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;"
                                    class="product-delete">
                                    Удалить товар из заказа
                                </div>
                            </div>
                        </div>
                        <div style="" class="product-card-edit">
                            <div style="" class="product-main-board">
                                <div
                                    style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;">
                                    <img height="100%" src="/imagepreview?src=1345499"
                                         style="position: absolute; left: 0px; right: 0px;margin: auto;">
                                </div>
                                <div style="display: inline-block;height: 150px;width: 20%; position: relative;">
                                    <div style="position: absolute;margin: 25px;line-height: 30px;">
                                        <div style="font-weight: 400;">Арт. 982742354</div>
                                        <div>Платье</div>
                                        <div>Размер: 23</div>
                                    </div>
                                </div>
                                <div
                                    style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;">
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Цена
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Количество
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">
                                                <div class="size-desc"
                                                     style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">
                                                    <div style=""><input id="input-count"
                                                                         style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;"
                                                                         data-prod="1691573" data-model="961000846"
                                                                         data-price="210"
                                                                         data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG"
                                                                         data-count="10000" data-attrname=""
                                                                         data-attr="" data-name="Шапка" data-step="1"
                                                                         data-min="1" placeholder="0" type="text">
                                                        <div id="add-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;">
                                                            +
                                                        </div>
                                                        <div id="del-count"
                                                             style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;">
                                                            -
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;">
                                        <div>
                                            <div
                                                style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">
                                                Сумма
                                            </div>
                                            <div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="position: relative;">
                                <div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;"
                                     class="product-comment">
                                    Добавить комментарий к товару
                                </div>
                                <div
                                    style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;"
                                    class="product-delete">
                                    Удалить товар из заказа
                                </div>
                            </div>
                        </div>
                        <div style=" font-weight: 400;  font-size: 16px;">
                           <span class="orders-edit-search">
                               Добавить позиции
                           </span>
                            <span>
                                <input
                                    style="margin: 0px 10px;outline:none;border: 1px solid #CCC; border-radius: 4px;width: 260px;padding: 0px 10px;"
                                    placeholder="Введите название или артикул" type="text"/>
                            </span>
                            <span>
                                <div
                                    style="background: #009f9c;    padding: 1px;    width: 200px;    border: 1px solid #CCC;margin-top: -2px;color: #FFF;font-weight: 400;"
                                    class="btn">Выбрать из каталога</div>
                            </span>
                        </div>
                        <div style="font-weight: 400;font-size: 15px;text-align: right;padding: 10px 25px;color: #CCC;">
                            <span style=" margin-right: 10px;"> Процент организатора</span>
                            <span> <input placeholder="%"></span>
                        </div>
                        <div style=" font-weight: 400; font-size: 32px; text-align: right;padding: 10px 25px;">
                            <span> Итого 1500 р.</span>
                            <span class="btn" style="padding: 10px; background: #ffea00;margin: 0px 0px  0px 20px;">Сохранить заказ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
