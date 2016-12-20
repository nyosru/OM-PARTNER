<?php
use yii\filters\AccessControl;
use yii\web\User;
/* @var $this yii\web\View */
?>
<?php
use yii\bootstrap\Collapse;



$this -> title = 'Мои заказы';

?>
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

            $sorter .=  '<a class="sort" name="order"  type="submit" href="" ><button style="background: rgb(245, 245, 245) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); float: left; color: rgb(0, 165, 161); font-size: 16px; border-radius: 4px; font-weight: 500; margin: 0px;" name="filter" type="submit" value="'.$i.'" class="'.$addclass.'">'.$sort_order[$i].'</button></a>';
        }
        ?>
        <div id="" style="width: 50%;">
            <?= $sorter?>
        </div>
        <div id="find-date" style="float: right; width: 30%; text-align: right;">

            <?php
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'di',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => 'от', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'value'=>Yii::$app->request->getQueryParam('di'),
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <?php
            echo \kartik\date\DatePicker::widget( [
                'language'=>'ru',
                'name' => 'do',
                'type' => \kartik\date\DatePicker::TYPE_INPUT,
                'value'=>Yii::$app->request->getQueryParam('do'),
                'options' => ['placeholder' => 'до', 'class'=>'no-shadow-form-control', 'style'=>'float: left;width: 45%;'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]);?>
            <button style="background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); width: 10%; height: 33px; line-height: 1.2; margin-right: 0px;" class="btn" type="submit">»</button>

        </div>
        <div id="find-order"  style="float: right; width: 20%; text-align: right;">

            <input name="id" value="<?= Yii::$app->request->getQueryParam('id');?>" class="no-shadow-form-control" type="text" placeholder="числовой идентификатор"></input>
            <button style="width: 10%; height: 32px; background-color: rgb(234, 81, 109); border-color: rgb(234, 81, 109); color: rgb(255, 255, 255); margin-right: 0px; float: left; position: relative; left: 90%; bottom: 33px; line-height: 1.2;" class="btn" type="submit">»</button>

        </div>

    </div>
</form><?php

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
                return '<a class="collapse-toggle" style="color:#007BC1" href="#expanded-order-'.$data->orders_id.'-collapse1" data-toggle="collapse" data-parent="#expanded-order-'.$data->orders_id.'">'.$data->NumOrder().'<br/>('.$data->orders_id.')</a>';
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
                $shipping = [
                    'flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'],
                    'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'],
                    'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'],
                    'flat7_flat7' => ['value' => 'Почта ЕМС России'],
                    'flat11_flat11' => ['value'=>'Бесплатная доставка до ТК КИТ'],
                    'flat10_flat10' => ['value'=>'Бесплатная доставка до ТК ОПТИМА'],
                    'flat9_flat9' => ['value'=>'Бесплатная доставка до ТК Севертранс'],
                    'flat12_flat12' => ['value'=>'Бесплатная доставка до ТК ЭНЕРГИЯ'],
                    'courierExpress_courierExpress' => ['value'=>'Бесплатная доставка до ТК Служба доставки Экспресс-Курьер'],
                    'russianpostpf_russianpostpf'=> ['value'=>'Почта России - http://pochta.ru/']
                ];
                $shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
                $inner ='';
                $ship = $data->shipping_module;
                $inner .= '<table class="table table-striped  table-hover table-responsive">';
                $inner .= '<thead><tr>';
                $inner .= '<th style="border: none" class="col-md-1">#</th>';
                $inner .= '<th style="border: none" class="col-md-1">Изображение</th>';
                $inner .= '<th style="border: none" class="col-md-2">Артикул</th>';
                $inner .= '<th style="border: none" class="col-md-2">Комментарий</th>';
                $inner .= '<th style="border: none" class="col-md-2">Цена за шт</th>';
                $inner .= '<th style="border: none" class="col-md-1">Количество</th>';
                $inner .= '<th style="border: none" class="col-md-1">Размер</th>';
                $inner .= '<th style="border: none" class="col-md-1">Наименование</th>';
                $inner .= '</tr></thead><tbody>';
                $count = 0;
                $countprod = 0;
                $totalomquant = 0;
                $totalomcount = 0;
                $finalomprice = 0;
                $omfirstquant = 0;
                $omfirstprice = 0;
                $orig_products = \yii\helpers\ArrayHelper::index($data->products, 'orders_products_id');
                $attr = \yii\helpers\ArrayHelper::index($data->productsAttr, 'orders_products_id');
                $sp  = \yii\helpers\ArrayHelper::index($data->productsSP, 'orders_products_id');
                foreach ($orig_products as $key => $value) {
                    $positionquantity =  min($value->first_quant,((int)$value->products_quantity + (int)$sp[$key]['products_quantity']));
                    $price = round($value->final_price);
                    $count++;
                    $countprod += (int)$value->first_quant;
                    $firstcountprod = $value->first_quant;
                    if ($positionquantity == 0 && isset($data->products)) {
                        $col = '#F8A7A7';
                    } elseif ($positionquantity == $firstcountprod && isset($data->products)) {
                        $col = '#ACDBAC';
                    } else {
                        $col = '#FFBF08 ';
                    }
                    $inner .= '<tr style="background: ' . $col . '">';
                    $inner .= '<td class="col-md-1">' . $count . '</td>';
                    $inner .= '<td class="col-md-1"><a target="_blank" href="'.BASEURL.'/product?id='. $value->products_id.'" style="display:block;clear: both; min-height: 300px; min-width: 200px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $value->products_id . ');"></a></td>';
                    $inner .= '<td class="col-md-2">'.$value->products_model.'</td>';
                    $omfinalquant = $positionquantity . ' шт';
                    if ($positionquantity > 0) {
                        $totalomcount++;
                        $totalomquant += (int)$positionquantity;
                        $finalomprice += (float)$price * (int)$positionquantity;
                    }
                    $omfirstprice += (float)$price * (int)$firstcountprod;
                    $inner .= '<td class="col-md-2">'.$value->comment.'</td>';
                    $inner .= '<td class="col-md-2">' . (float)$price . ' Руб.</td>';
                    $inner .= '<td class="col-md-1">'. $omfinalquant . '</td>';
                    $inner .= '<td class="col-md-1">'.$attr[$value->orders_products_id]['products_options_values'].'</td>';
                    $inner .= '<td class="col-md-1">'.$value->products_name.'</td>';
                    $inner .= '</tr>';
                    if($data->orders_status == 5){
                        $inner .= '<tr><td colspan="7">
                                            <div class="partners-main-right claim">
                                                 <div class="panel-group" style="margin: 0px;">
                                                    <div class="panel panel-default">
                                                        <a data-toggle="collapse" href="#collapse'.$value->orders_products_id.'">
                                                            <div class="panel-heading" data-opid-collapse="'.$value->orders_products_id.'">
                                                                <h4 class="panel-title">
                                                                    Претензии к данному товару
                                                                </h4>
                                                            </div>
                                                        </a>
                                                        <div id="collapse'.$value->orders_products_id.'" class="panel-collapse collapse">
                                                            <div class="panel-body"><div style="margin: 5px; width: calc(50% - 10px); float:left">';
                        $model = new \common\models\ClaimForm();
                        $form = \yii\bootstrap\ActiveForm::begin();
                        $inner .= $form->field($model, 'myphoto',['inputOptions'=>['data-opid'=>$value->orders_products_id,'multiple'=>'multiple','class'=>'']])->fileInput()->label('Фото полученного продукта');
                        $inner .= '<div data-post="file" data-id="'.$value->orders_products_id.'" style="background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 4px; padding: 4px; text-align: center; color: beige; font-weight: 500; cursor: pointer;">Загрузить</div>';
                        $form =   \yii\bootstrap\ActiveForm::end();
                        $inner .= '<div class="progress" >
  <div class="progress-bar" data-progress-opid="' .$value->orders_products_id.'" role="progressbar"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
    0%
  </div>
</div>';
                        $form = \yii\bootstrap\ActiveForm::begin();
                        $inner .= $form->field($model, 'pritenwrite',['inputOptions'=>['style'=>'max-width:100%', 'data-opid'=>$value->orders_products_id]])->textarea()->label('Сообщение');
                        $inner .= '<div data-post="comment" data-id="'.$value->orders_products_id.'" style="background: rgb(0, 165, 161) none repeat scroll 0% 0%; border-radius: 4px; padding: 4px; text-align: center; color: beige; font-weight: 500; cursor: pointer;">Отправить</div>';
                        $form =   \yii\bootstrap\ActiveForm::end();
                        $inner .=                           '</div>
                                                <div style="margin: 5px; width: calc(50% - 10px); float:right">
                                                    <div style="font-weight: 500">
                                                        <div style="float:left; width:100%">Загруженные фото</div>
                                                        <div class="photobank-'.$value->orders_products_id.'"></div>
                                                    </div>
                                                    </div>
                                                    <div style="font-weight: 500">
                                                        <div style="float:left; width:100%">История</div>
                                                        <div class="message-bank-'. $value->orders_products_id.'" style="float:left; width:100%;max-height: 300px; overflow: auto; border: 1px solid rgb(204, 204, 204); border-radius: 4px;"><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></div>
                                                    </div>
                                                </div>
                                             </div>
                                                        </div>
                                                    </div>
                                                 </div>
                                            </div></td></tr>';
                    }
                }

                // если при заказе использовался купон
                if(!empty($data->coupons)){
                    $coupon = $data->coupons[0]->redeem_sum;
                    $finalomprice -=$coupon;
                }

                $inner .= '</tbody><tfooter>';
                $inner .= '<tr>';
                $inner .= '<th style="border: none" class="col-md-1">Итого</th>';
                $inner .= '<th style="border: none" class="col-md-2">Позиций: ' . $totalomcount . ' шт </th>';
                $inner .= '<th style="border: none" class="col-md-2">Товаров: ' . $totalomquant . ' шт</th>';
                $inner .= '<th colspan="2" style="border: none" class="col-md-2">Стоимость заказа: '.$finalomprice . ' Руб. </th>';
                $inner .= '</tr>';
                $inner .= '<tr>';
                $inner .= '<th style="border: none" class="col-md-1">Доставка: </th>';
                $inner .= '<th colspan="6" style="border: none" class="col-md-1">' . $shipping[$ship]['value'] . '</th>';
                $inner .= '</tr>';
                $inner .= '</tfooter></table>';
                
                //$inner = '<a class="" role="" data-toggle="collapse" href="#collapseOrd' . $data->orders_id . '" aria-expanded="false" aria-controls="collapseOrd' . $data->orders_id . '">'. $finalomprice . ' Руб</a><div class="collapse"  style="position: absolute; z-index: 999999; left: 19px; height: 0px;" id="collapseOrd' . $data->orders_id . '"><div class="well">';
                return Collapse::widget([
                    'items' => [
                        [
                            'label' => $finalomprice,
                            'content' => $inner,
                            'contentOptions' => ['class' => 'user-order-row-expand'],
                            'options' => ['class' => 'user-order-row']
                        ],

                    ],
                    'id'=>'expanded-order-'.$data->orders_id,
                    'options'=>['style'=>'margin:0px;']
                ]);


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
                $('.photobank-'+data.opid).html('');

                $.each(data.photo,function(){
                    $('.photobank-'+data.opid).append('<a class="pritenphoto"  rel="light" data-gallery="'+data.opid+'" href="/images/priten/'+this.image_name_server+'"><div class="pritenphotoimg" style="background: url(/images/priten/'+this.image_name_server+') no-repeat 50% 50% /contain"></div></a>');
                });

                $('a[rel=light]').light();

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
    $(document).on('click','[data-opid-collapse]', function(){
        $opid =   $(this).attr('data-opid-collapse');
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
