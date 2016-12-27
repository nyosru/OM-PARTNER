<?php
use yii\filters\AccessControl;
use yii\web\User;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
?>
<?php
use yii\bootstrap\Collapse;



$this -> title = 'Мои заказы';

?>
<div class="container">
<div class="row" style="margin: 15px 0;">
<?=$this->render('_navlk',['user'=>$cust])?>
<div class="col-sm-9">
<form>
    <input type="hidden" value="myorder" name="view">
    <div style="float: left; width: 100%;">
        <?php
        $sorter = '';
        $cs = count($sort_order);
        for($i=0; $i<$cs; $i++){
            switch($i){
                case '0':
                    $addclass = 'first-sorter';
                    break;
                case $cs-1:
                    $addclass = 'last-sorter';
                    break;
                default:
                    $addclass = '';
                    break;
            }

            $sorter .=  '<button class="button  '.$addclass.'" name="filter" type="submit" value="'.$i.'">'.$sort_order[$i].'</button>';
        }
        ?>
        <div class="btn-group" role="group">
            <?= $sorter?>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="row">
                    <div class="col-xs-8" style="padding-right: 5px;">
                        <input style="width: 100%;" name="id" value="<?= Yii::$app->request->getQueryParam('id');?>" class="form-control" type="text" placeholder="Числовой идентификатор">
                    </div>
                    <div class="col-xs-4" style="padding-left: 5px;">
                        <button style="margin: 6px 0;" class="button" type="submit"><span style="line-height: 22px;" class="glyphicon glyphicon-menu-right"></span></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-xs-4" style="padding-right: 5px;">
                        <?php
                        echo \kartik\date\DatePicker::widget( [
                            'language'=>'ru',
                            'name' => 'di',
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'options' => ['placeholder' => 'от', 'class'=>'form-control', 'style'=>['width'=>'100%']],
                            'value'=>Yii::$app->request->getQueryParam('di'),
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]);?>
                    </div>
                    <div class="col-xs-4" style="padding: 0 5px;">
                        <?= \kartik\date\DatePicker::widget( [
                            'language'=>'ru',
                            'name' => 'do',
                            'type' => \kartik\date\DatePicker::TYPE_INPUT,
                            'value'=>Yii::$app->request->getQueryParam('do'),
                            'options' => ['placeholder' => 'до', 'class'=>'form-control', 'style'=>['width'=>'100%']],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy'
                            ]
                        ]);?>
                    </div>
                    <div class="col-xs-4" style="padding-left: 5px;">
                        <button style="margin: 6px 0;" class="button" type="submit"><span style="line-height: 22px;" class="glyphicon glyphicon-menu-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $orders,
    'layout' => "{pager}\n{items}",
    'options' => ['class' => 'grid-view admin-news', 'style'=>'float: left; width: 100%;'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            }
        ],
        [
            'attribute' => 'orders_id',
            'label' => 'Номер заказа',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%; '],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return $this->render('_lkmyorder-view',['data'=>$data]).
                '<button class="button" data-toggle="modal" data-target="#modal-order-'.$data->orders_id.'">'.$data->NumOrder().'<br/>('.$data->orders_id.')</button>';
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Дата',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                return date('d.m.Y',strtotime($data->date_purchased));
            }
        ],
        [
            'attribute' => 'create_date',
            'label' => 'Сумма, руб.',
            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                $finalomprice = 0;
                $orig_products = \yii\helpers\ArrayHelper::index($data->products, 'orders_products_id');
                $sp  = \yii\helpers\ArrayHelper::index($data->productsSP, 'orders_products_id');
                foreach ($orig_products as $key => $value) {
                    $positionquantity =  min($value->first_quant,((int)$value->products_quantity + (int)$sp[$key]['products_quantity']));
                    $price = round($value->final_price);
                    if ($positionquantity > 0) {
                        $finalomprice += (float)$price * (int)$positionquantity;
                    }
                }

                // если при заказе использовался купон
                if(!empty($data->coupons)){
                    $coupon = $data->coupons[0]->redeem_sum;
                    $finalomprice -=$coupon;
                }
                return $finalomprice;
            }


        ],
        [
            'attribute' => 'orders_status',
            'label' => 'Статус заказа',
            'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
            'contentOptions' => function ($model, $key, $index, $column) {
                return ['class' => 'user-order-table-row'];
            },
            'content' => function ($data) {
                switch ($data->orders_status) {
                    case '100':
                        return 'Обработка заказа';
                    case '1':
                        return 'Ожидает проверки';
                    case '22':
                        return 'Объединен';
                    case '2':
                        return 'Ждём оплаты';
                    case '3':
                        return 'Оплачен';
                    case '4':
                        return 'Оплачен - Доставляется';
                    case '5':
                        return 'Оплачен - Доставлен';
                    case '6':
                        return 'Отменён';
                    case '11':
                        return 'Сборка';
                    case '0':
                        return 'Спецпредложение';
                    default:
                        return $data->orders_status;
                }

            }

        ],
       [
        'attribute' => 'payment',
        'label' => 'Счет',
        'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['class' => 'user-order-table-row'];
        },
        'content' => function ($data) {
            if($data->orders_status != 1) {
                return '<a href="' . BASEURL . '/payview?id=' . $data->orders_id . '">Счет</a>';
            }else{
                return 'Не выставлен';
            }
        }
        ],
        [
        'attribute' => 'delivery_adress',
        'label' => 'Копия ТН ТК',
        'headerOptions' => ['style' => 'background: none repeat scroll 0% 0%;'],
        'contentOptions' => function ($model, $key, $index, $column) {
            return ['class' => 'user-order-table-row'];
        },
        'content' => function ($data) {

            if($data->ordersReports){
               if(($datakostyl = \common\models\OrdersReportsOrdersFiles::find()->where(['orders_reports_id'=>$data->ordersReports[0]['orders_reports_id'], 'groups_id'=> $data->ordersReports[0]['groups_id']])->asArray()->one()) == TRUE)
                return '<a href="'.BASEURL.'/tcncopy?id='.$data->orders_id.'" target="_blank">Открыть</a>';
            }
        }
        ],
//        [
//            'attribute' => 'customers_name',
//            'label' => 'Действия',
//            'headerOptions' => ['style' => 'background:  none repeat scroll 0% 0%;'],
//            'contentOptions' => function ($model, $key, $index, $column) {
//                return ['class' => 'user-order-table-row'];
//            },
//            'content' => function ($data) {
//                return 'Оставить комментарий';
//            }
//        ],

    ],
    'tableOptions' => ['class' => 'table table-striped admin-news-grid'],

]);


?>
</div>
</div>
</div>
<script>
    function reloaddata($opid){
        $.ajax({
            url: '/site/loadclaim',
            type: 'POST',
            data: {
                'opid': $opid
            },
            async: true,
            success: function (data) {
                console.log(data);
                $('.photobank-'+data.opid).html('');

                $.each(data.photo,function(){
                    $('.photobank-'+data.opid).append('<a class="pritenphoto"  rel="light" data-gallery="'+data.opid+'" href="/images/priten/'+this.image_name_server+'"><div class="pritenphotoimg" style="background: url(/images/priten/'+this.image_name_server+') no-repeat 50% 50% /contain"></div></a>');
                });

                //$('a[rel=light]').light();

                $('.message-bank-'+data.opid).html('');
                $.each(data.comments,function(){
                    $who = {'1':'Клиент',
                        '2':'Администратор',
                        '3':'Сборщик'};
                    $('.message-bank-'+data.opid).append('<div><div style="clear: left;padding: 4px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; float: left; border-radius: 4px; color: rgb(251, 251, 251); font-weight: 500; margin: 10px;">'+$who[this.type]+'</div><div style="padding: 4px; background: rgb(0, 165, 161) none repeat scroll 0% 0%; float: left; border-radius: 4px; color: rgb(251, 251, 251); font-weight: 500; margin: 10px;">'+this.date_add+'</div><div style="padding: 4px; background: rgb(227, 240, 240) none repeat scroll 0% 0%; border-radius: 4px; font-weight: 500; margin: 10px; float: left; clear: both; color: rgb(0, 0, 0);">'+this.orders_products_priten+'</div></div>');
                });

            }
        });
    }

    $(document).on('click','.show-dialog', function(){
        $opid =   $(this).attr('data-opid');
        reloaddata($opid);
    });
    $(document).on('click','[data-post="file"]', function(){
        $opid = $(this).attr('data-id');
        var formData = new FormData();

        files = $('[type=file][data-opid="'+$opid+'"]')[0].files;
        if(files.length==0){
            alert("Выберите хотя бы одно изображение");
        }
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image.*')) {
                alert("Разрешенные форматы - jpg, png, gif, jpeg");
                continue;
            }
            formData.append('file['+i+']', file, file.name);
        }

        formData.append('opid', $opid);
        formData.append('action', 'savefiles');
        formData.append('_csrf', yii.getCsrfToken());
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/site/saveclaim', true);
        xhr.send(formData);
        xhr.upload.onprogress = function(event) {
            $width = $('.progress').width();
            $progress =   $width*(event.loaded/event.total);
            $('[role="progressbar"]').html( 'Загружено на сервер ' + event.loaded + ' байт из ' + event.total );
            $('[role="progressbar"]').width($progress);
        };

        xhr.upload.onload = function() {
            $('[role="progressbar"]').html( 'Данные полностью загружены на сервер!' );
        };

        xhr.upload.onerror = function() {
            $('[role="progressbar"]').html( 'Произошла ошибка при загрузке данных на сервер!' );
        };
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                if(data.myphoto!=undefined){
                    alert(data.myphoto);
                } else {
                    reloaddata($opid);
                }
            } else {
                alert("Ошибка ответа сервера");
            }
        };
    });
    $(document).on('click','[data-post="comment"]', function(){
        $opid = $(this).attr('data-id');

        $comment = $('textarea[data-opid='+$opid+']')[0].value;
        $.ajax({
            url: '/site/saveclaim',
            type: 'POST',
            data: {'comment': $comment,
                'opid': $opid,
                'action': 'savecomment'},
            async: false,
            success:function (data) {
                if(data.pritenwrite!=undefined){
                    alert(data.pritenwrite);
                } else {
                    reloaddata($opid);
                }
            }
        });
    });

</script>
