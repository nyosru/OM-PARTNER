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



    .client-new {
        position: absolute;
        bottom: 17px;
        right: 29px;
        height: 16px;
        width: 16px;
        background: #009f9c;
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
<div style="height: 60px;background: #FFF">
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
<div class="">
    <div class="client-orders-board-table" style="background: #FFF">
        <?php

        \yii\widgets\Pjax::begin(['id' => 'clients']);
        $myArray = [
            '0' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '1', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '1' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '2', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '2' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '1', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '3' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '1', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '4' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '23', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '5' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '1234', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '6' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '123', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '7' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '234', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '8' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '13', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '9' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '234', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '10' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '235234', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '11' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '12' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '13' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '2', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '14' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '15' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '16' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'],'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
            '17' => ['id' => ' Егоров Дмитрий Владимирович','key' => ['num'=>'№ 10036','date'=>'10 августа 2016', 'price'=>'25000р.'], 'value' => '25', 'description' => '45000руб.', 'jo'=>'вип клиент', 'ko' =>'10 августа 2016' ],
        ];
        $dataProvider = new \yii\data\ArrayDataProvider([
            'key' => 'Фио клента',
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
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n<div class=\"pag\">{pager}</div>",
            'columns' => [
                [
                    'attribute' => 'Фио клента',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        return '<div class="">
                                    <div class="client-avatar">
                                        <div class="avatar">
                                            <div class="client-image">
                                            </div>
                                            <div class="client-new">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="client-info-fr">
                                            <div class="client-name" style="margin-bottom: 4%; margin-top: 4%">
                                                '.$model['id'].'
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
                        return '<div style="color:#5b8acf;font-weight: 400;font-size: 18px;margin-bottom: 4%;margin-top: 4%;">'.$model['key']['num'].'</div>
                        <div style="font-size: 16px;">'.$model['key']['date'].'</div>
                        <div style="font-size: 16px;">'.$model['key']['price'].'</div>';
                    }
                ],
                [
                    'attribute' => 'Всего заказов',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        return '<span class="orders-count" style="border-radius: 4px;padding: 2px 25px;background: #5b8acf;color:#FFF; font-weight: 400">'.$model['value'].'</span>';
                    }
                ],
                [
                    'attribute' => 'Сумма заказов',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'value' => function($model) {
                        return $model['description'];
                    }
                ],
                [
                    'attribute' => 'Статус клиента',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'content' => function($model) {
                        return '<div style="width: 14px; height: 14px;  background: #CCC;border-radius: 45px; display: inline-block;padding: 6px;margin: -3px 10px;"></div>'.$model['jo'];
                    }
                ],
                [
                    'attribute' => 'Зарегистрирован',
                    'contentOptions'=>[
                        'style' => 'vertical-align:middle;border:none'
                    ],
                    'value' => function($model) {
                        return $model['ko'];
                    }
                ],
            ],
        ]);
        \yii\widgets\Pjax::end();
        ?>
    </div>
</div>