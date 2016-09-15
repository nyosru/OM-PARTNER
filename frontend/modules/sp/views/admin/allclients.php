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
    <a style="font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;" href="#">Все клиенты</a>
    <a style="border-bottom: 2px solid #009f9c;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Новые</a>
    <a style="border-bottom: 2px solid #d8d8d8;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Постоянные</a>
    <a style="border-bottom: 2px solid #9c27b0;font-size: 18px;font-weight: 400;line-height: 50px; margin: 0px 20px;"
       href="#">Вип клиенты</a>
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
<div class="">
    <div class="client-orders-board-table" style="background: #FFF">
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
                'style'=>'border-top:1px solid #CCC; border-bottom:1px solid #CCC'
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
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        if($model->userinfo->name){
                            $name = $model->userinfo->lastname.' '.$model->userinfo->name.' '.$model->userinfo->secondname;
                        }else{
                            $name = 'Пользователь еще не заполнял свои данные';
                        }
                        $class = ['client-new','client-new','client-old','client-vip'];
                        return '<div class="">
                                    <div class="client-avatar">
                                        <div class="avatar">
                                            <div class="client-image">
                                            </div>
                                            <div class="'.$class[$model->status].'">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="client-info-fr">
                                            <div class="client-name" style="margin-bottom: 4%; margin-top: 4%">
                                                '.$name.'
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                    }
                ],
                [
                    'attribute' => 'Последний заказ',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        if($model->order){
                            return '<div style="color:#5b8acf;font-weight: 400;font-size: 18px;margin-bottom: 4%;margin-top: 4%;">'.$model->lastOrder['id'].'</div>
                        <div style="font-size: 16px;">'.$model->lastOrder['create_date'].'</div>
                        <div style="font-size: 16px;">'.$model->lastOrder['order'].'</div>';         }else{
                            return 'Заказов от этого клиента не поступало';
                        }

                    }
                ],
                [
                    'attribute' => 'Всего заказов',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        return '<span class="orders-count" style="border-radius: 4px;padding: 2px 25px;background: #5b8acf;color:#FFF; font-weight: 400">'.count($model->order).'</span>';
                    }
                ],
                [
                    'attribute' => 'Сумма заказов',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'value' => function($model) {
                        if($model->user['total_order']){
                            return $model->user['total_order'];
                        }else{
                            return '0';
                        }

                    }
                ],
                [
                    'attribute' => 'Статус клиента',
                    'label'=> 'Статус клиента',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        $color = ['000000', '009f9c','CCCCCC','6200ea'];
                        $text = ['Неизвестный', 'Новый', 'Старый клиент', 'VIP-клиент'];
                        return '<div style="width: 14px; height: 14px;  background: #'.$color[$model->status].';border-radius: 45px; display: inline-block;padding: 6px;margin: -3px 10px;"></div>'.$text[$model->status];
                    }
                ],
                [
                    'attribute' => 'Зарегистрирован',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'value' => function($model) {
                        return $model->date_added;
                    }
                ],
            ],
        ]);
        \yii\widgets\Pjax::end();
        ?>
    </div>
</div>

<?php

?>