<?php
use yii\grid\GridView;
$this->title = 'Мои претензии';
?>
<style>
    .data-table th>a{
        color: #FFFFff;
    }
    .pritenphotoimg{
        display: block;
        width: 50%;
        float: left;
        height: 130px;
        margin: 5px 0;
    }
</style>
<div class="container">
    <div class="row" style="margin: 15px 0;">
        <?=$this->render('_navlk',['user'=>$cust])?>
        <div class="col-sm-9">
            <?=GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => "{pager}\n{items}",
                'tableOptions' => ['class' => 'data-table'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'orders_id',
                        'label' => 'Номер заказа',
                        'headerOptions' => [],
                        'content' => function ($data) {
                            return $data->order->NumOrder().' ('.$data->orders_id.')';
                        }
                    ],
                    [
                        'attribute' => 'products_id',
                        'label' => 'Изображение',
                        'headerOptions' => ['style' => ''],
                        'content' => function ($data) {
                            return '<a target="_blank" href="'.BASEURL.'/product?id='. $data->products_id.'" style="display:block;clear: both; min-height: 200px; min-width: 150px; background-size:cover; background: no-repeat scroll 50% 50% / contain url(' . BASEURL . '/imagepreview?src=' . $data->products_id . ');"></a>';
                        }
                    ],
                    [
                        'attribute' => 'products_name',
                        'label' => 'Наименование',
                    ],
                    [
                        'label' => 'Размер',
                        'content' => function ($data) {
                            $attr = \yii\helpers\ArrayHelper::index($data->order->productsAttr, 'orders_products_id');
                            return $attr[$data->orders_products_id]['products_options_values'];
                        }
                    ],
                    [
                        'label' => 'Количество сообщений',
                        'content' => function ($data) {
                            return count($data->ordersProductsPriten);
                        }
                    ],
                    [
                        'label' => 'Претензии',
                        'content' => function ($data) {
                            return $this->render('_lkclaims-dialog',['data'=>$data]);
                        }
                    ],
                ]
            ]); ?>
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
