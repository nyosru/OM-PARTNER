<?php
include('all.php');

?>

<style>
    .product-to-order {
        text-align: center;
        position: absolute;
        left: 28%;
        bottom: 9px;
        text-transform: uppercase;
        padding: 10px 20px;
        color: #FFF;
        background: #00a5a1;
        border-radius: 4px;
        cursor:pointer;
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
<script>

    $(document).on('click', '.product-to-order', function(){
        $id_product =  this.getAttribute('data-sale');
        $id_order = $('.order-line').attr('data-order');
        $cart_add_obj = $('[data-prod='+$id_product+']').filter('input');
        $id = $(this).attr('data-sale');
        $attr = new Object;
        $attr[$id] = new Object;
        $data = new Object;
        $.each($cart_add_obj, function(index, i){
            $attr[$id][$(this).attr('data-attr').toString()] = $(this).val();
        });
        $data["new"] = $attr;
        $data["id"] = $id_order;
        $.ajax({
            type: "POST",
            url: '/sp/admin/orders-edit',
            data: $data,
            success: function(data){
                   console.log(data);
            },
            dataType: 'json'
        });





    //    console.log($id,  $data);

    });

    var Lock = false;

    $(document).on('click', '.search-models-button', function(){
        if(!isNaN(parseInt($('.search-models-value').val()))){
            $("#modal-product").remove();
            inProgressSearch = false;
            var dp = parseInt($('.search-models-value').val());
                if(!inProgressSearch){
                    $('[class="client-plate client-active"]').removeClass('client-active');
                    inProgressSearch = true;
                    $.post('/site/product', {model: dp}, function (data) {
                        $spec_html = '<div class="spec" style="margin-top:25px; ">';
                        $.each(data['spec'].productsSpecification, function (i, item) {
                            if (typeof(data['spec']['specificationDescription'][item.specifications_id]) != "undefined") {
                                $spec_html += data['spec']['specificationDescription'][item.specifications_id]['specification_name'] + ': ';
                            } else {
                                $spec_html += '';
                            }
                            if (typeof(data['spec']['specificationValuesDescription'][item.specification_values_id]) != "undefined") {
                                $spec_html += data['spec']['specificationValuesDescription'][item.specification_values_id]['specification_value'] + '<br/>';
                            } else {
                                $spec_html += 'Не указан<br/>';
                            }


                        });

                        $spec_html += '</div>';
                        $activelabel=0;
                        if(Array.isArray(data.product.productsAttributes)){
                            if(parseInt(data.product.products.products_quantity)>0){
                                $activelabel++;
                            }
                        }
                        else{
                            $.each(data.product.productsAttributes,function(i,item){
                                if(item.quantity>0){
                                    $activelabel++;
                                }
                            })
                        }
                        $size_html ='';
                        if($activelabel>0) {
                            $size_html += '<div data-sale="' + data.product.products_id + '"  class="product-to-order" style="left:0">Добавить в заказ</div>';
                        }else{
                            $size_html += '<div class="product-to-order" style="left:0; background: #E9516D;">Продано</div>';
                        }
                        $imgs = new Array('/site/imagepreview?src=' + data['product']['products']['products_id']);
                        $imgs2 = new Array(data['product']['products']['products_image']);
                        $miniimg = '';
                        $bigimg = '';

                        $.each($imgs, function (i, item) {
                            $miniimg += '<div id="carousel-selector-' + i + '" style="float:left; margin-top: 5px; overflow: hidden" class="mini-img-item"><img style="height:80px; display: block; margin: auto; border:1px solid #cccccc; border-radius:4px;" src="' + item + '"/></div>';
                            if (i == 0) {
                                $bigimg += '<div class="item active"><div style="position: absolute; bottom: 0;"></div><a class="cloud-zoom"  href="http://odezhda-master.ru/images/' + data.product.products.products_image+'"><img  style="border:1px solid #cccccc; border-radius:4px;" src=' + item + '></a></div>';
                            }
                            else {
                                $bigimg += '<div class="item"><img style="border:1px solid #cccccc; border-radius:4px;" src=' + item + '></div>';
                            }

                        });

                        $size_html += '<div class="size-block" style="overflow: hidden;margin-bottom: 38px; width: 340px;">';
                        $baseduri = window.location.hostname;

                        if (typeof (data.product.productsAttributesDescr.keys) == "undefined") {

                            if(data.product.products.products_quantity_order_units === '1'  || data.product.products.products_quantity_order_min === '1'){
                                $disable_for_stepping = '';
                            }else{
                                $disable_for_stepping = 'disabled';
                            }

                            $.each(data.product.productsAttributesDescr, function (i, item) {
                                if (data.product.productsAttributes[item['products_options_values_id']]['quantity'] > 0) {
                                    $classpos = 'active-options';
                                    $add_class = 'add-count';
                                    $del_class = 'del-count';
                                    $stylepos = '';
                                    $inputpos = '';
                                    $some_text = 0;
                                } else {
                                    $classpos = 'disable-options';
                                    $inputpos = 'readonly';
                                    $stylepos = 'display:none; ';
                                    $add_class = 'add-count-dis';
                                    $del_class = 'del-count-dis';
                                    $some_text = '';
                                }

                                $size_html += '<div class="' + $classpos + '" style="' + $stylepos + 'width: 50%; overflow: hidden; float: left; margin-bottom:10px;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div style="margin-bottom: 3px ;">' + item.products_options_values_name + '</div>';
                                //   $size_html += '<div class="' + $classpos + '" style="width: 50%; overflow: hidden; float: left; margin-bottom:10px;"><div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;"><div style="margin: auto; width: 100%;"><div style="margin-bottom: 5px;">' + item.products_options_values_name + '</div>';
                                $size_html += '<input '+ $disable_for_stepping +' ' + $inputpos + ' id="input-count" style="width: 40%;height: 22px; text-align: center; position: relative;top:0px;border-radius: 4px;border:1px solid #CCC;" data-prod="' + data.product.products_id + '" data-name="' + data.product.productsDescription.products_name + '" data-model="' + data.product.products.products_model + '" data-price="' + Math.round(data.product.products.products_price) + '" data-image="' + data.product.products.products_image + '" data-count="' + data.product.products.products_quantity + '" data-step="' + data.product.products.products_quantity_order_units + '" data-min="' + data.product.products.products_quantity_order_min + '" data-attrname="' + data.product.productsAttributesDescr[i].products_options_values_name + '" data-attr="'+data.product.productsAttributesDescr[i].products_options_values_id+'" placeholder="' + $some_text + '" type="text">';
                                $size_html += '<div id="' + $add_class + '" style="margin: 0px;line-height: 1.6;">+</div><div id="' + $del_class + '" style="margin: 0px;line-height: 1.6;">-</div></div></div></div>';
                            });

                        } else {
                            if(data.product.products.products_quantity_order_units === '1'  || data.product.products.products_quantity_order_min === '1'){
                                $disable_for_stepping = '';
                            }else{
                                $disable_for_stepping = 'disabled';
                            }
                            if (data.product.products.products_quantity > 0) {
                                $classpos = 'active-options';
                                $add_class = 'add-count';
                                $del_class = 'del-count';
                                $inputpos = '';
                                $some_text = 0;
                            } else {
                                $classpos = 'disable-options';
                                $inputpos = 'readonly';
                                $add_class = 'add-count-dis';
                                $del_class = 'del-count-dis';
                                $some_text = '';
                            }
                            $size_html += '<div class="' + $classpos + '" style="width: 50%; overflow: hidden; float: left; margin-bottom:10px;">' +
                                '<div class="size-desc" style="color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;">' +
                                '<div style="margin: auto; width: 100%;">' +
                                '<input  '+ $disable_for_stepping +'  ' + $inputpos + ' id="input-count" style="width: 40%;height: 22px; text-align: center; position: relative;top:0px;border-radius: 4px;border:1px solid #CCC;" data-prod="' + data.product.products_id + '" data-name="' + data.product.productsDescription.products_name + '" data-model="' + data.product.products.products_model + '" data-price="' + Math.round(data.product.products.products_price) + '" data-image="' + data.product.products.products_image + '" data-count="' + data.product.products.products_quantity + '" data-step="' + data.product.products.products_quantity_order_units + '" data-min="' + data.product.products.products_quantity_order_min + '" data-attrname="" data-attr="" placeholder="' + $some_text + '" type="text" />' +
                                '<div id="' + $add_class + '" style="margin: 0px;line-height: 1.6;">' +
                                '+</div>' +
                                '<div id="' + $del_class + '" style="margin: 0px;line-height: 1.6;">-' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                        $size_html += '</div>';
                        $breadcruumpsresult = [];
                        $.each(data.catpath['num'], function(i, index){

                            $breadcruumpsresult.push('<a target="_blank" href="/catalog?cat='+data.catpath['num'][i]+'">'+data.catpath['name'][i]+'</a>');

                        });
                        $prod_html = '';
                        $breadcruumpsresult =  $breadcruumpsresult.join(' &#47; ');
                        $prod_html += '<div class="prod-attr" style="width: 100%; position: relative;float: left; overflow: hidden;">' +
                            '<div class="prod-show" style="position: relative; float: left;width: 100%;">' +
                            '<div class="col1" style="float: left; width: 50%;position: relative;overflow: hidden; min-width: 430px;margin-left:4px;">' +
                            '<div>'+$breadcruumpsresult+'</div>'+
                            '<div class="prod-img" style="overflow: hidden; margin-bottom: 10px; max-width: 400px; margin-right: 10px;">' +
                            '<div style=" min-width: 380px;">' +
                            '<div id="carousel" class="carousel slide">' +
                            '<div class="carousel-inner">' +
                            $bigimg +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="mini-img">' +
                            $miniimg +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="col2" style="float: left;width: 340px;position: relative; overflow: hidden;line-height: 1; color: black; font-weight: 400;">' +
                            '<div style=" font-weight: 300;">' +
                            '<div class="min-opt" style="font-size: 12px; margin-bottom: 19px; text-align:left;">' +
                            'Заказано: ' + data['product']['products']['products_ordered'] + ' шт.' +
                            '</div>' +
                            '<div class="min-opt" style="font-size: 12px; margin-bottom: 19px; text-align:left;">' +
                            'Минимальный оптовый заказ: ' + data['product']['products']['products_quantity_order_min'] + ' шт.' +
                            '</div>' +
                            '<div itemprop="model" class="prod-code" style="width: 100%;float: left; margin-right: 12%; font-size: 12px;margin-bottom: 19px; ">' +
                            'Код товара: ' + data['product']['products']['products_model'] +
                            '</div>' +
                            '<div class="prodname" itemprope="name" style="font-size: 24px;margin-bottom: 15px; text-align: left; ">' +
                            data['product']['productsDescription']['products_name'] +
                            '</div>' +
                            '<a itemprop="url" href="/site/product?id=' + dp + '">' +
                            '</a>' +
                            '</div>' +
                            '<div class="prod-pricing" style="margin-bottom: 25px;">' +
                            '<div style="overflow: hidden;">' +
                            '<div class="prod-price-lable" style="font-size: 12px; margin-bottom: 7px;text-align:left;float: left;line-height: 3;">' +
                            'Цена' +
                            '</div>' +
                            '<div class="prod-price" itemprop="price" style="float: right; margin-right: 30px; font-size: 28px; font-weight: 400;margin-bottom: 30px;">' +
                            Math.round(data['product']['products']['products_price']) + ' руб' +
                            '</div>' +
                            '</div>' +
                            '<div style="margin-bottom: 20px;">' +
                            '<span>' +
                            'Размеры' +
                            '</span>' +
                            '<i style="margin-left: 20px; color:#00a5a1;" class="fa fa-angle-down">' +
                            '</i>' +
                            '</div>' +
                            '<div class="prod-sizes" style="margin: 0 0 38px 0; font-size: 12px; font-weight: 300;padding-bottom: 12px;">' +
                            $size_html +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '<div class="prod-compos" style="font-size: 12px; width:100%;float: left;padding-left: 10px;">' +
                            '<div itemprop="description" id="prd" style="display: block; max-height:340px; overflow:auto; font-size: 12px !important; font-weight: 400 !important; ">' +
                            data.product.productsDescription.products_description + ' ' + $spec_html + '' +
                            '</div>' +
                            '<div>' +
                            '<a target="_blank" href="/site/product?id=' + data.product.products_id + '" style="color:#007BC1;font-weight: 600;">' +
                            'Перейти к полному описанию товара' +
                            '</a>' +
                            '<span style="float: right;padding-right: 10px;">' +
                            'Добавлено: ' + data.product.products.products_date_added +
                            '</span>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                            $("body").append(
                                '<div id="modal-product" style="min-height: 300px;">'+
                                    '<span id="modal-close">' +
                                '<i class="fa fa-times" style="font-size:24px;"></i>' +
                                '</span>' + $prod_html+
                                '</div>'+
                            '<div id="overlay"></div>');
                        $("#modal-product").show();
                        $("#overlay").show();
                        var cloud = function () {
                            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({
                                'position' : 'inside'
                            });
                        };
                        setTimeout(cloud, 1000);
                    });
                    inProgressSearch = false;
                }else{
                    console.log('Выполняется запрос');
                }

        }else{
            alert('Укажите корректый артикул');
        }
    });
    var maindata = '';
    function renderOrder(data) {
    $('[data-detail="'+data.id+'"]').addClass('client-active');
    moment.locale('ru');

        $products = '';
       $.each(data.order.order.products, function(){
           console.log(this);
           $products +=     '<div style=""  class="product-card"> ' +
               '<div  style="" class="product-main-board"> ' +
               '<div style="display: inline-block;min-width: 100px;height: 150px;width: 19%;position: relative;"> ' +
               '<img height="100%" src="/imagepreview?src='+this[0]+'" style="position: absolute; left: 0px; right: 0px;margin: auto;"> ' +
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
               '</div></div> ' +
               '  ';
       });

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
            '<div>' +
                 $products+
            '</div><div style="border-top: 1px solid #CCC; font-weight: 400;  font-size: 32px; text-align: right;padding: 10px 25px;">Итого: 1500 р.</div> ' +
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
        '<div class="search-models" > ' +
                                '<input class="search-models-value" style="margin: 0px 10px;outline:none;border: 1px solid #CCC; border-radius: 4px;width: 300px;padding: 0px 10px;" placeholder="Введите название или артикул" type="text"/> ' +
        '<div class="search-models-button"></div>'+
        '</div> ' +
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
</script>

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