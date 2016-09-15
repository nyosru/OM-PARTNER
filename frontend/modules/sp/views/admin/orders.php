<?php


?>
    <style>
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
        #container1 {
            float: left;
            width: 100%;
            right: 70%;
            height: calc(100% - 210px);
            position: fixed;
        }
        #container2 {
            clear: left;
            width: 100%;
            overflow: hidden;
            background: #FFF;
            height: calc(100% - 210px);
            position: fixed;
            bottom: 0px;
        }
        #product-plane > .panel {
            margin-bottom: -6px;
            border-radius: 4px;
            border: none;
        }

        #product-plane .panel-heading + .panel-collapse > .panel-body, .panel-group .panel-heading + .panel-collapse > .list-group {
            border: none;
        }
        #product-plane > .panel > .panel-heading {
            color: #333;
            background-color: #F5F5F5;
            border-color: #DDD;
            padding: 0px;
        }
        .all-num-order {
            font-size: 24px;
            font-weight: 400;
            color: #5b8acf;
        }
        .avatar {
            height: 100px;
            width: 100px;
            position: relative;
            float: left;
        }
        .client-active:before {
            position: absolute;
            content: "\25B8";
            right: -15px;
            font-size: 30px;
            color: #CCC;
            line-height: 100px;
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
        .client-avatar {
            width: 30%;
            height: 100%;
        }
        .client-board{
            margin-left: 25px;
            border-bottom: 1px solid #CCC;
        }
        .client-board-avatar{
            width: 10%;
            display: inline-block;
            height: 190px;
            position: relative;
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
        .client-board-plain{
            width: 90%;
            display: block;
            height: 190px;
            float: right;
            padding: 0px 30px;
        }
        .client-board-plain-info{
            height: 70%;
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
        .client-board-plain-name{
            font-size: 24px;
            font-weight: 400;
            color: #4a90e2;
            padding: 10px 0px;
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
        .client-info {
            display: block;
            height: 100%;
            width: 70%;
            margin: 0px 0px 0px 119px;
            position: relative;
        }
        .client-info-fr{
            width: 100%;
            padding: 20px 0px;
        }
        .client-info-fr-order {
            width: 60%;
            padding: 20px 0px;
            display: inline-block;
        }
        .client-info-fr-price {
            padding: 25px 0px;
            display: inline-block;
            float: right;
            width: 40%;
        }
        .client-info-li-order {
            width: 30%;
            padding: 20px 0px;
            display: inline-block;
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
            margin: 0px 0px 0px 119px;
            position: relative;
        }
        .client-name{
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 10px;
        }
        .client-name-in {
            font-size: 16px;
            font-weight: 400;
            margin: 10px 0px;
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
        .client-old {
            position: absolute;
            bottom: 17px;
            right: 29px;
            height: 16px;
            width: 16px;
            background: #CCC;
            border-radius: 45px;
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
        .client-orders-board
        {
            margin-left:25px;
            margin-right:25px
        }
        .client-orders-board-last
        {
            font-size:20px;
            font-weight:400;
            padding:30px 0
        }
        .client-orders-board-table > div > div > .table > thead > tr > th
        {
            border:none
        }
        .client-plate
        {
            height:100%;
            width:100%;
            border-bottom:1px solid #CCC
        }
        .client-plate-collapsed
        {
            height:100%;
            width:100%;
            margin-left:30px
        }
        .client-plate:hover
        {
            background:#fff9c4!important
        }
        .client-plate:nth-of-type(even)
        {
            background:#FFF
        }
        .client-plate:nth-of-type(odd)
        {
            background:#f5f5f5
        }

        .client-row
        {
            font-size:14px;
            font-weight:400;
            margin-bottom:5px
        }
        .client-vip
        {
            position:absolute;
            bottom:17px;
            right:29px;
            height:16px;
            width:16px;
            background:#6200ea;
            border-radius:45px
        }
        .common-num-order
        {
            font-size:24px;
            font-weight:400;
            color:#009f9c
        }
        .create-common-order
        {
            background:#ff1744 none repeat scroll 0 0;
            display:inline-block;
            border-radius:4px;
            margin:0 10px;
            padding:5px 20px;
            font-weight:400;
            color:#FFF;
            position:relative;
            top:-7px
        }
        .date-order
        {
            margin:0 10px
        }
        .edit-line
        {
            margin:10px 0
        }
        .edit-order
        {
            display:inline-block;
            width:33%;
            text-align:center
        }
        .edit-order:before
        {
            content:"";
            height:20px;
            width:20px;
            display:inline-block;
            background:url(/images/lksp/edit.png) no-repeat 50% 50%;
            padding:0;
            margin:-5px 10px
        }
        .hrefline
        {
            display:block;
            width:100%;
            height:100%;
            margin:0;
            position:relative;
            padding:0 20px
        }
        .hrefline:before
        {
            content:'';
            display:inline-block;
            width:20px;
            height:20px;
            border-right:2px solid #CCC;
            border-bottom:2px solid #CCC;
            transform:rotate(225deg);
            transform-origin:70% 70%;
            transition:transform .3s ease 0s,-webkit-transform .3s ease 0s,-o-transform .3s ease 0;
            position:absolute;
            top:0;
            bottom:0;
            margin:auto
        }
        .line-info-orders
        {
            display:block;
            height:100%;
            margin:0 0 0 30px;
            position:relative
        }
        .mail-client
        {
            display:inline-block;
            width:33%;
            text-align:center
        }
        .mail-client:before
        {
            content:"";
            height:20px;
            width:30px;
            display:inline-block;
            background:url(/images/lksp/mail.png) no-repeat 50% 50%;
            padding:0;
            margin:-5px 10px
        }
        .order-retry
        {
            position:relative;
            top:-3px;
            padding:10px;
            cursor:pointer
        }
        .order-retry:before
        {
            content:"\2190"
        }
        .orders-edit-search:before
        {
            content:"";
            height:25px;
            width:25px;
            display:inline-block;
            background:url(/images/lksp/plus4.png) no-repeat 0 0 /cover;
            padding:0;
            margin:-8px 10px
        }
        .orders-swap:after
        {
            content:"\2193"
        }
        .pag
        {
            text-align:center
        }
        .pag > .pagination > .active > a,.pag > .pagination > .active > span,.pag > .pagination > .active > a:hover,.pag > .pagination > .active > span:hover,.pag > .pagination > .active > a:focus,.pag > .pagination > .active > span:focus
        {
            z-index:3;
            cursor:default;
            background-color:#ffbf08;
            border-color:#ffbf08;
            color:#000
        }

        .pag > .pagination > li > a,.pagination > li > span
        {
            position:relative;
            float:left;
            padding:6px 12px;
            margin-left:-1px;
            line-height:1.42857143;
            color:#000;
            text-decoration:none;
            background-color:#fff;
            border:1px solid #CCC
        }
        .product-card
        {
            margin:15px 0;
            padding:15px 0;
            border-bottom:1px solid #CCC
        }
        .product-card-common
        {
            margin:0;
            padding:30px 0;
            border-bottom:1px solid #CCC
        }

        .product-card-common:last-child
        {
            margin:0;
            padding:30px 0;
            border-bottom:none
        }
        .product-card-edit
        {
            margin:30px 0;
            padding:30px 0;
            border-bottom:1px solid #CCC
        }
        .product-card:last-child
        {
            border-bottom:none
        }
        .product-comment:before
        {
            content:"";
            height:15px;
            width:15px;
            display:inline-block;
            background:url(/images/lksp/plus.png) no-repeat 0 0 /cover;
            padding:0;
            margin:-3px 10px
        }
        .product-delete:before
        {
            content:"";
            height:20px;
            width:20px;
            display:inline-block;
            background:url(/images/lksp/delete.png) no-repeat 50% 50%;
            padding:0;
            margin:-5px 10px
        }
        .search-bar:before
        {
            height:59px;
            width:59px;
            content:'';
            background:url(/images/lksp/search.png) no-repeat 50% 50%;
            position:absolute
        }
        .search-console
        {
            height:100%;
            width:80%;
            padding:15px 59px;
            border:none;
            font-size:16px;
            outline:none
        }

        .search-console:active,.search-console:focus
        {
            border:none
        }
        .sort-clients:after
        {
            content:"\2193"
        }
        .sp-client-info
        {
            display:block;
            height:100%;
            width:30%;
            position:relative;
            float:right;
            border:1px solid #CCC;
            border-radius:4px
        }
        .sp-client-info-dr
        {
            padding:10px 20px
        }
        .sp-client-info-fr
        {
            padding:20px
        }
        .status-cancel
        {
            background:#d8d8d8 none repeat scroll 0 0
        }
        .status-like
        {
            background:#ffea00 none repeat scroll 0 0
        }
        .status-new
        {
            background:#009f9c none repeat scroll 0 0
        }
        .status-order
        {
            padding:2px 5px;
            border-radius:4px;
            color:#FFF;
            font-weight:400
        }
        .status-ordered
        {
            background:#9c27b0 none repeat scroll 0 0
        }
        .status-payed
        {
            background:#ff5722 none repeat scroll 0 0
        }
        .status-proceed
        {
            background:#5b8acf none repeat scroll 0 0
        }
        .status-return
        {
            background:#ff1744 none repeat scroll 0 0
        }
        .to-order
        {
            display:inline-block;
            width:33%;
            text-align:center;
            padding:5px;
            background:#ffea00;
            border-radius:4px;
            font-weight:400
        }
        .to-order:after
        {
            content:"\2193";
            padding:0 10px
        }
        [class="client-plate client-active"]
        {
            background:#fff9c4 !important;
        }
        [class="hrefline collapsed"]:before
        {
            transform:rotate(45deg)
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
                <div id="scroll1" style="height: 100%">
                    <?php
                    \yii\widgets\Pjax::begin(['id' => 'clients']);

                    echo \yii\grid\GridView::widget([
                        'tableOptions' => [
                            'class' => 'table table-striped',
                            'style' => 'vertical-align:middle; border-bottom:1px solid #CCC;'
                        ],
                        'rowOptions'=>[
                            'style'=>'border:none'
                        ],
                        'headerRowOptions'=>[
                            'style'=>'display:none'
                        ],
                        'captionOptions'=>[
                            'style'=>'border:none'
                        ],
                        'dataProvider' => $data,
                        'layout' => "{items}\n<div class=\"pag\">{pager}</div>",
                        'columns' => [
                            [
                                'attribute' => 'Фио клента',
                                'contentOptions'=>[
                                    'style' => 'vertical-align:middle;border:none; padding:0px'
                                ],
                                'content' => function($model) {
                                    $stat_class = [
                                        'status-new',
                                        'status-proceed',
                                        'status-like',
                                        'status-payed',
                                        'status-ordered',
                                        'status-return',
                                        'status-cancel',
                                    ];
                                    if($model['name']){
                                        $name = $model['lastname'].' '.$model['name'].' '.$model['secondname'];
                                    }else{
                                        $name = 'Пользователь еще не заполнял свои данные';
                                    }
                                    $class = ['client-new','client-new','client-old','client-vip'];

                                    $params = new \php_rutils\struct\TimeParams();
                                    $params->date = $model['create_date']; //это значение по умолчанию
                                    $params->format = 'd F Y H:i:s';
                                    $params->monthInflected = true;
                                    $dateorder  = \php_rutils\RUtils::dt()->ruStrFTime($params);

                                    return '<div class="client-plate" style="display:block;" data-detail="'.$model['ids'].'">
                                            <div class="client-avatar">
                                                <div class="avatar">
                                                    <div class="client-image">
                                                    </div>
                                                    <div class="'.$class[$model['user_status']].'">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="client-line-info-orders">
                                                <div class="client-info-fr-order">
                                                    <div class="client-order">
                                                        <div class="client-order-num">
                                                            № '.$model['ids'].'
                                                        </div>
                                                        <div class="client-order-status '.$stat_class[$model['order_status']].'">
                                                        </div>
                                                    </div>
                                                    <div class="client-name">
                                                        '.$name.'
                                                    </div>
                                                    <div class="client-last-order-date">
                                                        '.$dateorder.'
                                                    </div>
                                                </div>
                                                <div class="client-info-fr-price">
                                                    <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">
                                                        13144 руб.
                                                    </div>
                                                    <div>
                                                        Мой %: 1314 руб.
                                                    </div>
                                                </div>
                </div>
            </div>';
                                }
                            ],
                        ],
                    ]);
                    ?>
                    <div class="pag">
                        <?php
                        echo \yii\widgets\LinkPager::widget([
                            'options'=>[
                                'class'=>'pagination'
                            ],
                            'pagination' => $paginate,
                        ]);
                        ?>
                    </div>
                    <script>
                        var maindata = '';
                        function renderOrder(data) {
                            $('[data-detail="'+data.id+'"]').addClass('client-active');
                            moment.locale('ru');
                            $('.datacontainer').html('<div style="margin:25px;"> ' +
                                '<div style="width: 70%;  display:inline-block;"> ' +
                                '<div style="margin-right: 25px;"> ' +
                                '<div class="order-line" data-order="'+data.id+'"> ' +
                                '<span class="all-num-order">Заказ № '+data.id+'</span> ' +
                                '<span class="date-order" >от '+moment(data.order.create_date).format("D MMMM  YYYY, H:mm:ss ")+'</span> ' +
                                '<span class="status-order status-new">новый</span> ' +
                                '</div> ' +
                                '<div class="edit-line"> ' +
                                '<div class="to-order">В общий заказ</div> ' +
                                '<div class="edit-order"  edit-mode="read">Редактировать заказ</div> ' +
                                '<div class="mail-client" data-toggle="modal" data-target="#modal-mail" >Написать клиенту</div> ' +
                                '</div> ' +
                                '<div> ' +
                                '<div style=""  class="product-card"> ' +
                                '<div  style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div>250 p. x 2шт.</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div > ' +
                                '<div  style="cursor:pointer;color: #5b8acf;" class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style=""  class="product-card"> ' +
                                '<div  style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div>250 p. x 2шт.</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div > ' +
                                '<div  style="cursor:pointer;color: #5b8acf;" class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style=""  class="product-card"> ' +
                                '<div  style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="display: inline-block;  height: 150px;float: right;width: 40%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div>250 p. x 2шт.</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р.</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div > ' +
                                '<div  style="cursor:pointer;color: #5b8acf;" class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> <div style="border-top: 1px solid #CCC; font-weight: 400;  font-size: 32px; text-align: right;padding: 10px 25px;">Итого: 1500 р.</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div class="sp-client-info"> ' +
                                '<div class="client-avatar"> ' +
                                '<div class="avatar"> ' +
                                '<div class="client-image"> ' +
                                '</div> ' +
                                '<div class="client-vip"> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div class="sp-client-info-fr"> ' +
                                '<div class="client-name">' +
                                'Егоров Дмитрий Владимирович ' +
                                '</div> ' +
                                '<div class="client-register">' +
                                'Зарегистрирован: 10 августа 2016 ' +
                                '</div> ' +
                                '</div> ' +
                                '<div class="sp-client-info-dr"> ' +
                                '<div class="client-row">' +
                                'Заказов: 2 ' +
                                '</div> ' +
                                '<div class="client-row">' +
                                'Статус клиента: Новый ' +
                                '</div> ' +
                                '<div class="client-row">' +
                                'gedeon@bk.ru ' +
                                '</div> ' +
                                '<div class="client-row"> ' +
                                '+79300056787 ' +
                                '</div> ' +
                                '<div class="btn btn-default client-all-orders">' +
                                'Все заказы клиента ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ');
                        }
                        function renderOrderEdit(data) {
                            $('[data-detail="'+data.id+'"]').addClass('client-active');
                            moment.locale('ru');
                            $('.datacontainer').html('<div style="margin:25px;"> ' +
                                '<div style="width: 100%;  display:inline-block;"> ' +
                                '<div> ' +
                                '<div class="order-line" data-order="'+data.id+'"> ' +
                                '<span class="order-retry">Назад</span> ' +
                                '<span class="all-num-order">Заказ № '+data.id+'</span> ' +
                                '<span class="date-order">от '+moment(data.order.create_date).format("D MMMM  YYYY, H:mm:ss ")+'</span> ' +
                                '</div> ' +
                                '<div> ' +
                                '<div style="width: 100%;font-size: 18px;padding: 15px 0px;">' +
                                'Комментарий к заказу ' +
                                '</div> ' +
                                '<textarea style="resize:none;margin: 0px;width: 100%;height: 200px;border-radius: 4px;border: 1px solid #CCC;"></textarea> ' +
                                '</div> ' +
                                '<div style="" class="product-card-edit"> ' +
                                '<div style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 20%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;"> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Цена ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Количество ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;"> ' +
                                '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"> ' +
                                '<div style=""><input id="input-count" style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;" data-prod="1691573" data-model="961000846" data-price="210" data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG" data-count="10000" data-attrname=""  data-attr="" data-name="Шапка" data-step="1"  data-min="1" placeholder="0" type="text"> ' +
                                '<div id="add-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;"> ' +
                                '+ ' +
                                '</div> ' +
                                '<div id="del-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;"> ' +
                                '- ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Сумма ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="position: relative;"> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;"' +
                                'class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;"' +
                                'class="product-delete">' +
                                'Удалить товар из заказа ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="" class="product-card-edit"> ' +
                                '<div style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 20%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div  style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;"> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Цена ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Количество ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;"> ' +
                                '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"> ' +
                                '<div style=""><input id="input-count" style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;" data-prod="1691573" data-model="961000846" data-price="210"  data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG"   data-count="10000" data-attrname="" data-attr="" data-name="Шапка" data-step="1" data-min="1" placeholder="0" type="text"> ' +
                                '<div id="add-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;"> ' +
                                '+ ' +
                                '</div> ' +
                                '<div id="del-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;"> ' +
                                '- ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Сумма ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="position: relative;"> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;" class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;" class="product-delete">                             ' +
                                'Удалить товар из заказа ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="" class="product-card-edit"> ' +
                                '<div style="" class="product-main-board"> ' +
                                '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
                                '<img height="100%" src="/imagepreview?src=1345499" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;width: 20%; position: relative;"> ' +
                                '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                                '<div style="font-weight: 400;">Арт. 982742354</div> ' +
                                '<div>Платье</div> ' +
                                '<div>Размер: 23</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="display: inline-block;height: 150px;float: right;width: 60%;position: relative;"> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Цена ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Количество ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;"> ' +
                                '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"> ' +
                                '<div style=""><input id="input-count" style="width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;" data-prod="1691573" data-model="961000846"  data-price="210"    data-image="apix/products/bb100ce63b0f4fb0851bc4c01c843c9d.JPG"  data-count="10000" data-attrname=""   data-attr="" data-name="Шапка" data-step="1"  data-min="1" placeholder="0" type="text"> ' +
                                '<div id="add-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;"> ' +
                                '+ ' +
                                '</div> ' +
                                '<div id="del-count" style="margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;"> ' +
                                '- ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;"> ' +
                                '<div> ' +
                                '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                                'Сумма ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">500 р. ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style="position: relative;"> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;" class="product-comment">' +
                                'Добавить комментарий к товару ' +
                                '</div> ' +
                                '<div style="cursor:pointer;color: #5b8acf;position: absolute;right: 0px;width: 70%;text-align: center;" class="product-delete">' +
                                'Удалить товар из заказа ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '<div style=" font-weight: 400;  font-size: 16px;"> ' +
                                '<span class="orders-edit-search">' +
                                'Добавить позиции ' +
                                '</span> ' +
                                '<span> ' +
                                '<input style="margin: 0px 10px;outline:none;border: 1px solid #CCC; border-radius: 4px;width: 260px;padding: 0px 10px;" placeholder="Введите название или артикул" type="text"/> ' +
                                '</span> ' +
                                '<span> ' +
                                '<div style="background: #009f9c;    padding: 1px;    width: 200px;    border: 1px solid #CCC;margin-top: -2px;color: #FFF;font-weight: 400;" class="btn">Выбрать из каталога</div> ' +
                                '</span> ' +
                                '</div> ' +
                                '<div style="font-weight: 400;font-size: 15px;text-align: right;padding: 10px 25px;color: #CCC;"> ' +
                                '<span style=" margin-right: 10px;"> Процент организатора</span> ' +
                                '<span> ' +
                                '<input placeholder="%">' +
                                '</span> ' +
                                '</div> ' +
                                '<div style=" font-weight: 400; font-size: 32px; text-align: right;padding: 10px 25px;"> ' +
                                '<span> Итого 1500 р.</span> ' +
                                '<span class="btn" style="padding: 10px; background: #ffea00;margin: 0px 0px  0px 20px;">Сохранить заказ</span> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div> ' +
                                '</div>');
                        }
                        if($('.order-line').attr('data-order')){
                            $('[data-detail="'+$('.order-line').attr('data-order')+'"]').addClass('client-active');
                        }

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

                        (function($){
                            inProgress = false;
                            $('.client-plate').on("click",function(){
                                if(!inProgress){
                                    $('[class="client-plate client-active"]').removeClass('client-active');
                                    inProgress = true;
                                    $.ajax({
                                        method:"post",
                                        url: "/sp/admin/detail-order",
                                        data: { "_csrf":yii.getCsrfToken(),
                                            "id": $(this).attr('data-detail')
                                        },
                                        cache: false,
                                        async: true,
                                        dataType: 'json',
                                        beforeSend: function () {
                                            inProgress = false;
                                        }
                                    }).done(function (data) {

                                        maindata = data;
                                        renderOrder(maindata);
                                    });
                                    inProgress = false;
                                }else{
                                    alert('Выполняется запрос');
                                }
                            });
                        })(jQuery);
                        (function($){
                            $(document).on('click', '.edit-order', function () {
                                renderOrderEdit(maindata);
                            });
                            $(document).on('click', '.order-retry', function () {
                                renderOrder(maindata);
                            });
                        })(jQuery);
                    </script>
                    <?php
                    \yii\widgets\Pjax::end();
                    ?>

                </div>
            </div>
            <div id="col2">
                <div id="scroll2" style="height: 100%">
                    <div class="datacontainer"></div>
                </div>
            </div>
        </div>
    </div>
<?php
$modal = '<div style="display: none;" id="modal-mail" class="fade modal" role="dialog" tabindex="-1">';
    $modal .= '<div class="modal-dialog modal-lg">';
        $modal .= '<div class="modal-content">';
            $modal .= '<div class="modal-header">';
                $modal .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
                $modal .= 'Отправить e-mail пользователю ' . $model->user->username;
                $modal .= '</div>';
            $modal .= '<div class="modal-body">';
                $modal .= '<div></div><div style="margin-left: auto; margin-right: auto; padding: 14px; text-align: left;">';
                    $modal .= '<form id="groupdiscountuser" action="/sp/admin/mail-to-user" method="post" role="form">';
                        $form = \yii\bootstrap\ActiveForm::begin();
                        $mailmodel = new \frontend\models\MailToUserForm();
                        $modal .= $form->field($mailmodel, 'subject')->label('Тема письма')->input('text');
                        $modal .= $form->field($mailmodel, 'body')->label('Текст письма')->input('text')->widget('\vova07\imperavi\Widget', [
                        'settings' => [
                        'verifiedTags' => ['div', 'a', 'img', 'b', 'strong', 'sub', 'sup', 'i', 'em', 'u', 'small', 'strike', 'del', 'cite', 'ul', 'ol', 'li'],
                        'lang' => 'ru',
                        'minHeight' => 200,
                        'plugins' => ['fontsize', 'fontcolor', 'table']]]);
                        $form = \yii\bootstrap\ActiveForm::end();
                        $modal .= '</div><div class="form-group">';
                    $modal .= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'mailtouser']);
                    $modal .= '</div>';
                $modal .= '</form>';

                $modal .= '</div></div></div></div></div></div>';
echo $modal;