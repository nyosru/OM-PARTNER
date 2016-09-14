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
    .client-orders-board-table > div > div> .table>thead>tr>th {
        border:none;
    }
    .pag{
        text-align: center;
    }
    .pag > .pagination>.active>a, .pag > .pagination>.active>span, .pag > .pagination>.active>a:hover, .pag > .pagination>.active>span:hover, .pag > .pagination>.active>a:focus, .pag > .pagination>.active>span:focus{
        z-index: 3;
        cursor: default;
        background-color: #ffbf08;
        border-color: #ffbf08;
        color:black;
    }
    .pag > .pagination>li>a, .pagination>li>span {
        position: relative;
        float: left;
        padding: 6px 12px;
        margin-left: -1px;
        line-height: 1.42857143;
        color: black;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid #CCC;
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