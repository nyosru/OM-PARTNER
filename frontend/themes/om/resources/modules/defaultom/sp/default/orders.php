
<?= \frontend\widgets\HeaderFilterBarNew::widget([
    'dataProvider' => $data,
    'sortOrderByData'  =>
    [
        'sort' => [
            'status'      => ['Статус'],
            'create_date' => ['Последний заказ'],
        ],
    ],
    'sortStatusData'  => [
        'status' => [
            ''   => ['Все заказы'],
            '1'  => ['Новые', 'options' => ['style' => 'border-bottom: 2px solid #009f9c;']],
            '2'  => ['В обработке', 'options' => ['style' => 'border-bottom: 2px solid #5b8acf;']],
            '3'  => ['Одобренные', 'options' => ['style' => 'border-bottom: 2px solid #ffea00;']],
            '4'  => ['Оплаченные', 'options' => ['style' => 'border-bottom: 2px solid #ff5722;']],
            '5'  => ['Выполненные', 'options' => ['style' => 'border-bottom: 2px solid #9c27b0;']],
            '6'  => ['Возврат', 'options' => ['style' => 'border-bottom: 2px solid #ff1744;']],
            '0'  => ['Удален', 'options' => ['style' => 'border-bottom: 2px solid #d8d8d8;']],
        ],
    ],
]); ?>

    <div id="container2">
        <div id="container1">
            <div id="col1">
                <div id="scroll1" style="height: 100%">
                    <?php
                    $i_model = 0;
                    \yii\widgets\Pjax::begin([
                        'id'=>'grid'
                    ]);
                    echo \yii\grid\GridView::widget([
                        'id'=>'grid-orders',
                        'tableOptions' => [
                            'class' => 'table table-striped',
                            'style' => 'vertical-align:middle; border-bottom:1px solid #CCC;',
                            'data-pjax'=>'88'
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
                        'emptyText' => 'Данных нет',
                        'dataProvider' => $data,
                        'layout' => "{items}\n<div class=\"pag\">{pager}</div>",
                        'columns' => [
                            [
                                'attribute' => 'Фио клента',
                                'contentOptions'=>[
                                    'style' => 'vertical-align:middle;border:none; padding:0px'
                                ],
                                'content' => function($model) use (&$i_model) {
                                    $stat_class = [
                                        'status-cancel',
                                        'status-new',
                                        'status-proceed',
                                        'status-like',
                                        'status-payed',
                                        'status-ordered',
                                        'status-return',
                                    ];
                                    $img_block_client_status = [
                                        '',
                                        '<div class="client-new"></div>',
                                        '<div class="client-old"></div>',
                                        '<div class="client-vip"></div>'
                                    ];
                                    $order_status_label = [
                                        'Удален',
                                        'Новый',
                                        'В обработке',
                                        'Одобренный',
                                        'Оплаченый',
                                        'Выполненный',
                                        'Возврат'
                                    ];

                                    $order_un = unserialize($model['order']);
                                    $order_price = 0;
                                    foreach ($order_un['products'] as $product) {
                                        if(count($product) > 5) {
                                            $order_price = $order_price + round($product[3]) * round($product[4]);
                                        }
                                    }
                                    if($model['name']){
                                        $name = $model['lastname'].' '.$model['name'].' '.$model['secondname'];
                                    }else{
                                        $name = 'Пользователь еще не заполнял свои данные';
                                    }
                                    $params = new \php_rutils\struct\TimeParams();
                                    $params->date = $model['create_date']; //это значение по умолчанию
                                    $params->format = 'd F Y H:i:s';
                                    $params->monthInflected = true;
                                    $dateorder  = \php_rutils\RUtils::dt()->ruStrFTime($params);

                                    $i_model += 1;
                                    ( $i_model % 2 ) ? '' : $back_fff = 'background: #FFF;';
                                    $common_orders_id = $model['common_orders_id'];
                                      if($common_orders_id){
                                          $common = '<div class="common_order_detail">В объединенном заказе №: '.$common_orders_id.' </div>';
                                      } else{
                                          $common = '<div class="common_order_detail">Не закреплен</div>';
                                      }
                                    return '<a class="client-plate lock-on" style="display:block; '.$back_fff.'" href="#id='.$model['ids'].'" data-detail="'.$model['ids'].'">
                                            <div class="client-avatar">
                                                <div class="avatar">
                                                    <div class="client-image"> </div>
                                                    '.$img_block_client_status[$model['user_status']].'
                                               </div>
                                            </div>
                                            <div class="client-line-info-orders">
                                                <div class="client-info-fr-order">
                                                    <div class="client-order">
                                                        <div class="client-order-num">№ '.$model['ids'].'</div>
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
                                                    <div>Начальная цена заказа</div>
                                                    <div class="client-price" style="font-size: 18px;color: #4A90E2;font-weight: 400;">
                                                        '.$order_price.' руб.
                                                    </div>
                                                </div>
                                                '.$common.'
                </div>
                
            </a>';
                                }
                            ],
                        ],
                    ]);

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

<?= $this->render('modals/comment_to_product.php')?>

<?= $this->render('modals/email_to_user.php')?>

<?= $this->render('modals/add_new_commonorder.php')?>

<script>
    var product_arr = new Object();
    var maindata_arr = new Object();
    var maindata = new Object();
    var updated_main_data = new Object();
    $(document).ready(function () {

        //add_new_commonorder.php после запроса обновить список
        $('#pjax_common').on('pjax:end', function(){
            refresh_list();
        });
        function scrollToTopCustomScrollBar(pointer) {
            $(pointer).mCustomScrollbar("scrollTo", $(pointer).position().top, {
                // scroll as soon as clicked
                timeout:0,

                // scroll duration
                scrollInertia:200
            });
            // disable original jumping
            return false;
        }
        $("#grid").on("pjax:end", function() {
            scrollToTopCustomScrollBar('#scroll1');
        });


        function update_main($main) {
            maindata = $main;
        }
        function update_upd($upd) {
            updated_main_data = $upd;
        }
        inProgress = false;

        if($('.order-line').attr('data-order')){
            $('[data-detail="'+$('.order-line').attr('data-order')+'"]').addClass('client-active');
        }
        (function($){
            var hash    = location.hash.substr(1),
                id = hash.substr(hash.indexOf('id='))
                    .split('&')[0]
                    .split('=')[1];
            if (id) {
                loaddetail(id);
            }
        })(jQuery);
        (function($){
            $(document).on("click", '.client-plate',function(){
                $id = $(this).attr('data-detail');
                loaddetail($id);
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
        (function($){
            $(document).on('click', '.product-comment', function (){
                var comment_id = $(this).attr('data-product');
                var comment_attr =  $(this).attr('data-attr');
                var comment_order =  $(this).attr('data-order');
                var comment_text = $('[comment-'+comment_order+'-'+comment_id+'-'+comment_attr+']').text();
                $.post(
                    '/sp/add-position-order-comments',
                    {
                        id: comment_id,
                        attr: comment_attr,
                        order: comment_order,
                        comment: comment_text
                    },
                    function (data) {
                        $('.comment-content-body').html('<div>'+data+'</div>');
                    });
            });
        })(jQuery);
        function loaddetail($id){
            if(!inProgress){
                inProgress = true;
                $('.client-plate.client-active').removeClass('client-active');
                inProgress = true;
                $.ajax({
                    method:"post",
                    url: "/sp/detail-order",
                    data: { "_csrf":yii.getCsrfToken(),
                        "id": $id
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
        }

        $(document).on('click', '.mail-client',function() {
            //функции в зависимостях вида email_to_user.php
            setRecipientNameModalMail($(this).attr('recipient_name'));
            setRecipientIdModalMail($(this).attr('recipient_id'));
        });

        (function($){

            $(document).on('click', '.product-delete',function() {
                var order_id = $(this).attr('order_id');
                var product_id = $(this).attr('product_id');
                var attr = $(this).attr('attr');
                var product_card_block = $(this).closest('.product-card-edit');

                if (!confirm("Вы уверены, что хотите удалить этот товар из заказа?")) {
                    return;
                }

                $.each(updated_main_data.order.order['products'], function(index_order, product){
                    if(typeof product !== 'undefined') {
                        if (product[0] == product_id && product[2] == attr && updated_main_data.id == order_id) {
                            updated_main_data.order.order['products'].splice(index_order, 1);
                            maindata.order.order['products'].splice(index_order, 1);
                            return true;
                        }
                    }
                });
                product_card_block.hide('fast');
                updateAllOrdersView(updated_main_data, false);

            });
        })(jQuery);

        function renderCommonList(common_list) {
            var list_html = '';
            if(typeof(common_list) == 'undefined' || common_list.length <= 0){
                list_html = 'Ничего не найдено';
            }else{
                list_html = '';
                $.each(common_list, function(i, index){
                    list_html += '<div class="list-child" common-order-id="'+index.id+'">';
                    list_html += '<div class="number">'+index.id+'</div>';
                    list_html += '<div class="title">'+index.header+'</div>';
                    list_html += '</div>';
                });
            }
            $('.list').html(list_html);
        }
        var common_orders_list = new Object();
        function requestCommon(action, request) {
            var result = new Object();
            if(typeof (common_orders_list['list']) == 'undefined' || action ===  'refresh'){
                var request_data = $.ajax({
                    method: 'post',
                    url: "<?=Yii::$app->urlManager->createUrl(['/sp/list-common-orders'])?>",
                    async: false,
                    data: {
                        "search": request
                    },
                    dataType: 'json'
                });

                result = common_orders_list['list'] = request_data.responseJSON;
            }else{
                result = common_orders_list['list'];
            }
            return result;
        }
        function refresh_list(){
            var act = $(this).attr('data-act');
            var request = $(".input-searcncommon-order").val();
            common_orders_list = requestCommon(act, request);
            renderCommonList(common_orders_list);
        }
        $(document).on('click', '.common-order', function(){
            refresh_list();
        });

        var input_searcncommon_order = false;
        $(document).on('click', '.searcncommon-order', function(){
            $(".input-searcncommon-order").val('');
            if(input_searcncommon_order == true) {
                $(".input-searcncommon-order").css('display', 'none');
                input_searcncommon_order = false
            } else {
                $(".input-searcncommon-order").css('display', 'block');
                input_searcncommon_order = true;
            }
        });

        $(document, ".input-searcncommon-order").keyup(function(event){
            if(event.keyCode == 13){
                var act = $(".common-order").attr('data-act');
                var request = $(".input-searcncommon-order").val();
                common_orders_list = requestCommon(act, request);
                renderCommonList(common_orders_list);
            }
        });


        $(document).on('click', '.list-child', function(){
            var old_text = 'В общий заказ';
            var button_to_common_order = $("a.to-order.common-order");
            var id_common_order = $(this).attr("common-order-id");
            var id_order = $('.order-line').attr('data-order');
            var comment = '';
            var common_order_detail = $("[data-detail='" + id_order + "']").find('.common_order_detail');

            $.ajax({
                method: 'post',
                url: "<?=Yii::$app->urlManager->createUrl(['/sp/attach-order-to-common'])?>",
                data: {
                    "id_common_order": id_common_order,
                    "id_order": id_order,
                    "comment": comment
                },
                beforeSend: function() {
                    button_to_common_order.click();
                },
                success: function(data) {
                    checkAlerts();
                    $.pjax.reload('#grid', {cache: false});
                    if(data == true) {
                        $('.edit-line .panel-title').html('<div class="common-order" style="text-align: center;padding: 10px;background: beige;"">В заказе № '+ id_common_order);
                        common_order_detail.text('В объединенном заказе №: '+id_common_order);
                    } else {
                        button_to_common_order.text('Ошибка!');
                        setTimeout(function() {
                            button_to_common_order.text(old_text)
                        }, 4000);
                    }

                }
            });
        });
        (function($){
            //      yii.pjax.recast();
        })(jQuery);

        var order_status_label = [
            'удален',
            'новый',
            'в обработке',
            'одобренный',
            'оплаченый',
            'выполненный',
            'возврат'
        ];
        var client_status_label = [
            'Неизвестный',
            'Новый',
            'Старый клиент',
            'VIP-клиент'
        ];
        var img_block_client_status = [
            '',
            '<div class="client-new"></div>',
            '<div class="client-old"></div>',
            '<div class="client-vip"></div>'
        ];
        var stat_class = [
            'status-cancel',
            'status-new',
            'status-proceed',
            'status-like',
            'status-payed',
            'status-ordered',
            'status-return'
        ];

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
                url: '/sp/orders-edit',
                data: $data,
                success: function(data){

                },
                dataType: 'json'
            });

        });

        function updateAllOrdersView(maindata, client_plate_update = false) {
            var final_order_price = 0;
            $.each(maindata.order.order['products'], function(index_order, product){

                var product_data = requestProduct(product[0], product[2] , product[4]);
                if(product_data.maindata.result == true){
                    final_order_price += Math.round(product[3]) * Math.round(product[4]);
                }

            });

            if(client_plate_update) {
             //   $('[data-detail="'+maindata.id+'"]').find('.client-info-fr-price').find('.client-price').text(final_order_price +" руб.");
            }

            $('.final_order_price').text("Итого "+ final_order_price +" р.");

        }

        $(document).on('click', '.count-event-new', function(){
            var input_count = $(this).closest("#input-count-block").children("#input-count");
            var new_value = input_count.val();
            var price = input_count.attr('data-price');
            $('.final-product-price').text(Math.round(price) * Math.round(new_value) + " р.");
        });

        $(document).on('click', '.count-event', function(){
            var input_count = $(this).closest("#input-count-block").children("#input-count");

            setTimeout(function() {
                var new_value = input_count.val();
                var product_id = input_count.attr('data-prod');
                var data_attr = input_count.attr('data-attr');
                var price = input_count.attr('data-price');
                var index_product_card = input_count.attr('data-index-product');
                updateUpdatedDataCountProducts(product_id, data_attr, new_value);
                updateAllOrdersView(updated_main_data, false);
                $('.final-product-price'+index_product_card).text(Math.round(price) * Math.round(new_value) + " р.");
            }, 50);

        });

        function updateUpdatedDataCountProducts(product_id, data_attr, new_value) {
            $.each(updated_main_data.order.order['products'], function(index_product, product){
                if(typeof product !== 'undefined') {
                    if (product[0] == product_id && product[2] == data_attr) {
                        updated_main_data.order.order['products'][index_product][4] = new_value;
                        maindata.order.order['products'][index_product][4] = new_value;
                        return true;
                    } else if (product[0] == product_id && (typeof (product[2]) == data_attr) || product[2] == '') {
                        updated_main_data.order.order['products'][index_product][4] = new_value;
                        maindata.order.order['products'][index_product][4] = new_value;
                        return true;
                    }
                }
            });
        }

        var Lock = false;
        function requestProduct($id, $attr, $count) {
            $result = new Object();
            $result.product = new Object();
            $result.maindata = new Object();
            var maindata = [];
            var requestdata = [];
            if(typeof(product_arr[$id]) == 'undefined'){
                requestdata = $.ajax({
                    _csrf:yii.getCsrfToken(),
                    method: 'post',
                    url: "/product",
                    async: false,
                    data: {id: $id}
                });
                product_arr[$id] = new Object();
                $result.product = product_arr[$id] = requestdata.responseJSON.product;
            }else{
                $result.product = product_arr[$id];
            }
            $keymaindata = $id+'-'+$attr;
            if(typeof (maindata_arr[$keymaindata]) == 'undefined'){
                maindata = $.ajax({
                    method:'post',
                    url: "/pre-check-product-to-orders",
                    async: false,
                    data: {
                        product: $result.product.products.products_id,
                        category :$result.product.categories_id,
                        attr :$attr,
                        count : $count,
                        skiptime: true
                    }
                });
                maindata_arr[$keymaindata] = new Object();
                $result.maindata = maindata_arr[$keymaindata] = JSON.parse(maindata.responseText);
            }else{
                $result.maindata = maindata_arr[$keymaindata];
            }
            return $result;

        }
        // СОХРАНЯЕМ ОБНОВЛЕННЫЕ ДАННЫЕ О ЗАКАЗЕ
        $(document).on('click', '#save_order', function(){
            $.ajax({
                method: 'post',
                url: "<?=Yii::$app->urlManager->createUrl(['/sp/save-one-order'])?>",
                data: {
                    order_id: updated_main_data.id,
                    products: Object.values(updated_main_data.order.order['products'])
                },
                dataType: 'json',
                error: function (data) {
                },
                success: function (products) {
                    if(products != false) {
                        maindata.order.order['products'] = products;
                        renderOrder(maindata);
                        updateAllOrdersView(maindata, true);
                        $.pjax.reload('#grid', {cache: false});
                    }

                    checkAlerts();
                    $.pjax.reload('#grid', {cache: false});
                }
            });
        });

        $(document).on('click', '[confirm_product]', function(){
            var input_count = $("[new-product-input-count]");
            var data_attr =$('#pick_attr_value option:selected').attr('data-attr');
            var val = parseInt(input_count.val());
            var data_id = input_count.attr('data-prod');
            var data_model = parseInt(input_count.attr('data-model'));

            if (isNaN(val)){
                alert('Не выбрано количество!');
                return false;
            }
            $.ajax({
                method: 'post',
                url: "<?=Yii::$app->urlManager->createUrl(['/sp/add-product-to-order'])?>",
                async: true,
                dataType: 'json',
                data: {
                    order_id: maindata.id,
                    product_id: data_id,
                    attr: data_attr,
                    val: val
                },
                error: function (data) {
                },
                    success: function (data) {
                        console.log(data);
                        update_test(data);
                }
            });
        });

        function update_test(data){
            $("#overlay").remove();
            $("#modal-product").remove();

            checkAlerts();

            if(data === false) {
                return;
            }

            $is_a_match = false;
            $.each(maindata.order.order['products'], function(index_product, product){
                if(typeof product !== 'undefined') {
                    if (product[0] == data[0] && product[2] == data[2]) {
                        maindata.order.order['products'][index_product] = data;
                        updated_main_data.order.order['products'][index_product] = data;
                        $is_a_match = true;
                    }
                }
            });
            if ($is_a_match == false) {
                if(maindata.order.order['products'] == null) {
                    maindata.order.order['products'] = [];
                    updated_main_data.order.order['products'] = [];
                }
                maindata.order.order['products'].push(data);
                updated_main_data.order.order['products'].push(data);
            }
            renderOrderEdit(maindata);
            updateAllOrdersView(maindata, true);
        }

        $(document).on('click', '.search-models-button', function(){
            var abort = false;
            if(!isNaN(parseInt($('.search-models-value').val()))) {
                $("#modal-product").remove();
                inProgressSearch = false;
                var attr_id = parseInt($('.search-models-value').val());
                if (!inProgressSearch) {
                    inProgressSearch = true;
                    $.ajax({
                        method: 'post',
                        url: "<?=Yii::$app->urlManager->createUrl(['/site/product'])?>",
                        async: true,
                        dataType: 'json',
                        data: {
                            model: attr_id
                        },
                        error: function (data) {

                        },
                        success: function (data) {
                            $('.preload').remove();
                            if (typeof (data) != "object") {
                                alert('Ничего не найдено по вашему запросу');
                                abort = true;
                            }
                            if ($.isArray(data) && data.length <= 0) {
                                alert('Ничего не найдено по вашему запросу');
                                abort = true;
                            }
                            if(typeof (data.product.productsDescription) == "undefined") {
                                alert('Ничего не найдено по вашему запросу');
                                return false;
                            }
                            var  new_product = data.product;
                            var quant = true;
                            var quant_allias = 0;
                            if(new_product.productsAttributesDescr.length == 0){
                                new_product.productsAttributesDescr[0]= new Object;
                                new_product.productsAttributesDescr[0].products_options_values_name = 'Без размера';
                                new_product.productsAttributesDescr[0].products_options_values_id = '';
                                quant = false;
                            }
                            var product_html = '';
                            product_html += "<div style=\"\" class=\"product-card-common\">";
                            product_html += " <div style=\"display: flex\" class=\"product-main-board\">";
                            product_html += "   <div style=\"width: 20%; display: inline-block;\">";
                            product_html += "      <div";
                            product_html += "          style=\"padding: 20px;\">";
                            product_html += "          <img width=\"100%\" src=\"\/imagepreview?src="+new_product.products_id+"\"";
                            product_html += "               style=\"\">";
                            product_html += "      <\/div>";
                            product_html += "    <\/div>";
                            product_html += "      <div";
                            product_html += "          style=\"display: inline-block;height: 150px;width: 20%; position: relative;\">";
                            product_html += "          <div style=\"position: absolute;margin: 10px 0px;line-height: 30px; width: 80%;\">";
                            product_html += "              <div style=\"font-weight: 400;\">Арт. "+new_product.products.products_model+"<\/div>";
                            product_html += "              <div>"+new_product.productsDescription.products_name+"<\/div>";
                            product_html += "              <div>Размер: ";
                            product_html += "                   <div class=\"select-style\">";
                            product_html += "                     <select id=\"pick_attr_value\">";
                            $.each(new_product.productsAttributesDescr, function (index, attribute) {
                                if(quant == true) {
                                    quant_allias = new_product.productsAttributes[attribute.products_options_values_id]["quantity"];
                                }else{
                                    quant_allias = new_product.products.products_quantity;
                                }
                                product_html += "<option data-attr=\""+attribute.products_options_values_id+"\"  data-attr-count=\""+quant_allias+"\" data-attrname=\""+attribute.products_options_values_name+"\">"+attribute.products_options_values_name+"<\/option>";
                            });

                            product_html += "                     <\/select>";
                            product_html += "               <\/div>";
                            product_html += "                   <\/div>";
                            product_html += "          <\/div>";
                            product_html += "      <\/div>";
                            product_html += "      <div";
                            product_html += "          style=\"display: inline-block;min-height: 150px;float: right;width: 60%;position: relative;\">";
                            product_html += "          <div";
                            product_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;\">";
                            product_html += "              <div>";
                            product_html += "                  <div";
                            product_html += "                      style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                            product_html += "                      Цена";
                            product_html += "                  <\/div>";
                            product_html += "                  <div";
                            product_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                            product_html += "                      "+Math.round(new_product.products.products_price)+" р.";
                            product_html += "                  <\/div>";
                            product_html += "              <\/div>";
                            product_html += "          <\/div>";
                            product_html += "          <div";
                            product_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;\">";
                            product_html += "              <div>";
                            product_html += "                  <div";
                            product_html += "                      style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                            product_html += "                      Количество";
                            product_html += "                  <\/div>";
                            product_html += "                  <div";
                            product_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                            product_html += "                      <div class=\"size-desc\"";
                            product_html += "                           style=\"color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;\">";
                            product_html += "                          <div id=\"input-count-block\" style=\"\"><input new-product-input-count id=\"input-count\"";
                            product_html += "                                               style=\"width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;\"";
                            product_html += "                                               data-prod=\""+new_product.products_id+"\"";
                            product_html += "                                               data-model=\""+new_product.products.products_model+"\"";
                            product_html += "                                               data-price=\""+Math.round(new_product.products.products_price)+"\"";
                            product_html += "                                               data-image=\""+new_product.products.products_image+"\"";
                            product_html += "                                               data-count=\""+new_product.products.products_quantity+"\"";
                            product_html += "                                                data-name=\""+new_product.productsDescription.products_name+"\"";
                            product_html += "                                               data-step=\""+new_product.products.products_quantity_order_units+"\"";
                            product_html += "                                               data-min=\""+new_product.products.products_quantity_order_min+"\"";
                            product_html += "                                               placeholder=\"0\"";
                            product_html += "                                               type=\"text\">";
                            product_html += "                              <div class=\"count-event-new\" id=\"add-count\"";
                            product_html += "                                   style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;\">";
                            product_html += "                                  +";
                            product_html += "                              <\/div>";
                            product_html += "                              <div class=\"count-event-new\" id=\"del-count\"";
                            product_html += "                                   style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;\">";
                            product_html += "                                  -";
                            product_html += "                              <\/div>";
                            product_html += "                          <\/div>";
                            product_html += "                      <\/div>";
                            product_html += "                  <\/div>";
                            product_html += "              <\/div>";
                            product_html += "          <\/div>";
                            product_html += "          <div";
                            product_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;\">";
                            product_html += "              <div>";
                            product_html += "                  <div";
                            product_html += "                      style=\"font-weight:300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                            product_html += "                      Сумма";
                            product_html += "                  <\/div>";
                            product_html += "                  <div new-product-price class=\"final-product-price\"";
                            product_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                            product_html += "                      0 р.";
                            product_html += "                  <\/div>";
                            product_html += "              <\/div>";
                            product_html += "          <\/div>";
                            product_html += "      <\/div>";
                            product_html += "  <\/div>";
                            product_html += "<\/div>";

                            $("body").append(
                                '<div id="modal-product" style="background: #ffffff; min-height: 300px; ">' +
                                '<span id="modal-close">' +
                                '<i class="fa fa-times" style="font-size:24px;"></i>' +
                                '</span>' +
                                product_html +
                                '<div class="modal-footer">'+
                                '<div style="display: inline-block; top: 10px; ">'+
                                '<div confirm_product class="btn-custom-red" style="">Добавить в заказ</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<div id="overlay"></div>');
                            $("#modal-product").show();
                            $("#overlay").show();
                            $('[new-product-input-count]').attr('data-count', $('#pick_attr_value option:selected')[0].getAttribute('data-attr-count'));
                            $(document).on('change','#pick_attr_value', function () {
                                $('[new-product-input-count]').attr('data-count', $('#pick_attr_value option:selected')[0].getAttribute('data-attr-count'));
                                $count = $('[new-product-input-count]').val();
                                $step=parseInt($('[new-product-input-count]').attr('data-step'));
                                $countprodpos=parseInt($('[new-product-input-count]').attr('data-count'));
                                if ($count == '') {
                                    $count = 0;
                                }
                                if (isNaN(parseInt($count))) {
                                    $count = -1;
                                }
                                $('[new-product-input-count]').val(Math.min(parseInt($count), $countprodpos));

                                $('[new-product-price]').html(parseInt($('[new-product-input-count]').val())*parseInt($('[new-product-input-count]').attr('data-price'))+' р.');
                            });
                            var cloud = function () {
                                $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({
                                    'position': 'inside'
                                });
                            };
                            setTimeout(cloud, 1000);
                        }
                    });

                    if(abort == true) {
                        return false;
                    }
                } else {
                    console.log('Выполняется запрос.')
                }
                inProgressSearch = false;
            } else {
                alert('Введите корректный артикул.');
                var preloadRemove = function () {
                    $('.preload').remove();
                };
                setTimeout(preloadRemove, 200);


            }
        });


        function renderOrder(data) {
            scrollToTopCustomScrollBar('#scroll2');
            var user_name = '';
            var telephone = '';
            var user_email = data.refus.user.email;
            var date_added = data.refus.date_added;

            if(typeof (data.refus.userinfo) != "undefined" || !data.refus.userinfo){
                if(data.refus.userinfo.name || data.refus.userinfo.lastname) {
                    user_name = data.refus.userinfo.name + ' ' + data.refus.userinfo.lastname;
                    telephone =  data.refus.userinfo.telephone;
                } else {
                    telephone = 'Не указанно';
                    user_name = 'Данных нет';
                }
            }else {
                telephone = 'Не указанно';
                user_name = 'Данных нет';
            }
            var final_price = 0;
            $('[data-detail="'+data.id+'"]').addClass('client-active');
            moment.locale('ru');

            $products = '';

            $.each(data.order.order.products, function(){
                var product_data = requestProduct(this[0],this[2],this[4]);
                if((typeof(product_data.product.productsAttributes[this[2]]) !=='undefined' && product_data.product.productsAttributes[this[2]].quantity == 0) || product_data.product.products.products_quantity == 0){
                    $access = product_data.maindata.message ;
                    $identypay = false;
                }else if(product_data.maindata.result == false){
                    $access = product_data.maindata.message;
                    $identypay = false;
                }else{
                    $access = product_data.maindata.message;
                    $identypay = true;
                    final_price += Math.round(this[3]) * Math.round(this[4]);
                }
                if(product_data.product.products.products_quantity_order_min === '1'  || product_data.product.products.products_quantity_order_units === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'readonly';
                }
                $products +=     '<div style=""  class="product-card"> ' +
                    '<div class = "access '+$identypay+'" >'+$access+'</div><hr style="height: 10px;margin: 0px;" />'+
                    '<div class = "access '+$identypay+'" style="display:flex;" class="product-main-board"> ' +
                    '<div style="display: inline-block; margin: 0 25px;width: 30%;"> ' +
                    '<div style="margin: 25px auto 0;display: inline-block;min-height: 150px;position: relative;"> ' +
                    '<img src="/imagepreview?src='+this[0]+'" style="position: relative; width: 100%"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div style="display: inline-block;min-height: 150px;width: 25%; position: relative;"> ' +
                    '<div style="position: relative;margin: 25px;line-height: 30px;"> ' +
                    '<div style="font-weight: 400;">Арт. '+this[1]+'</div> ' +
                    '<div>'+this[7]+'</div> ';
                    $size = '';
                    if(this[6] == false || this[6] == 'undefined' || this[6] == null){
                        $size = 'Без размера';
                    }else{
                        $size = this[6];
                    }
                    $products +='<div>Размер: '+ $size+'</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div style="display: inline-block;  height: 150px;float: right;width: 30%; position: relative;"> ' +
                    '<div style="position: absolute;margin: 25px;line-height: 30px;"> ' +
                    '<div>'+Math.round(this[3])+' p. x '+this[4]+'шт.</div> ' +
                    '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">'+Math.round(this[3]) * this[4]+' р.</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div > ' +
                    '<div data-toggle="modal" data-target="#modal-comment" style="cursor:pointer;    z-index: 1;color: #5b8acf;position: absolute;left: 0px;" data-order="'+data.id+'" data-attr="'+this[2]+'" data-product="'+this[0]+'" class="product-comment">' +
                    'Добавить комментарий к товару ' +
                    '</div> ' +
                    '</div></div> ' +
                    '  ';
            });
            var common_html = '';
            if(data.order.commonOrder){
                common_html = '<div class="common-order" style="text-align: center;padding: 10px;background: beige;"">В заказе № '+data.order.commonOrder.common_orders_id+'</div>';
            }else{
                common_html = '<a data-toggle="collapse" href="#collapse-list" class="to-order common-order" style="width: 100%;">В общий заказ</a>';
            }

            var order_status_label_html;
            if(typeof (order_status_label[data.order.status]) != 'undefined') {
                order_status_label_html = order_status_label[data.order.status]
            }
            else {
                order_status_label_html =  'Неизвестно';
            }

            $('.datacontainer').html('<div style="margin:25px;"> ' +
                '<div style="width: 70%;  display:inline-block;"> ' +
                '<div style="margin-right: 25px;"> ' +
                '<div class="order-line" data-order="'+data.id+'"> ' +
                '<span class="all-num-order">Заказ № '+data.id+'</span> ' +
                '<span class="date-order" >от '+moment(data.order.create_date).format("D MMMM  YYYY, H:mm:ss ")+'</span> ' +
                '<span class="status-order '+stat_class[data.order.status]+'">' +
                order_status_label_html +
                '</span> ' +
                '</div> ' +
                '<div class="edit-line"> ' +
                '<div class="panel-group" style="display: inline-block; width: 33%;"> ' +
                '<div class="panel panel-default" style="border-color: rgb(255, 255, 255); box-shadow: none; position: relative;"> '+
                '<div class="panel-heading" style="padding: 0px; width: 100%;">'+
                '<h4 class="panel-title">'+
                common_html+
                '</h4> ' +
                '</div> ' +
                '<div id="collapse-list" class="panel-collapse collapse" style="z-index: 999; border: 1px solid rgb(245, 245, 245); width: 100%; position: absolute;"> ' +
                '<div class="panel-body" style="background: rgb(254, 254, 254) none repeat scroll 0% 0%;">' +
                '<div class="list"></div></div> ' +
                '<div class="panel-footer" style="line-height: 0px;">' +
                '<input class="input-searcncommon-order" value="" placeholder="Поиск">'+
                '<div class="searcncommon-order"  style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                '<i class="mdi">&#xE8B6;</i>' +
                '</div>' +
                '<div class="common-order" data-act="refresh" style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                '<i class="mdi">&#xE042;</i>' +
                '</div>' +
                '<div data-toggle="modal" data-target="#modal-common"  style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                '<i class="mdi">&#xE145;</i>' +
                '</div>' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="edit-order" style="cursor:pointer" edit-mode="read">Редактировать заказ</div> ' +
                '<div class="mail-client" recipient_id="'+data.refus.user_id+'" recipient_name="'+user_name+'" style="cursor:pointer" data-toggle="modal" data-target="#modal-mail" >Написать клиенту</div> ' +
                '</div> ' +
                '<div>' +
                $products+
                '</div><div style="border-top: 1px solid #CCC; font-weight: 400;  font-size: 32px; text-align: right;padding: 10px 25px;">Итого: ' + final_price + ' р.</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="sp-client-info"> ' +
                '<div class="client-avatar"> ' +
                '<div class="avatar"> ' +
                '<div class="client-image"></div> ' +
                img_block_client_status[data.refus.status] +
                '</div> ' +
                '</div> ' +
                '<div class="sp-client-info-fr"> ' +
                '<div class="client-name">' +
                user_name +
                '</div> ' +
                '<div class="client-register">' +
                'Зарегистрирован: <br>' + moment(date_added).format("D MMMM YYYY") +
                '</div> ' +
                '</div> ' +
                '<div class="sp-client-info-dr"> ' +
                '<div class="client-row">' +
                'Заказов: ' + data.orders_count +
                '</div> ' +
                '<div class="client-row">' +
                'Статус клиента: '+ client_status_label[data.refus.status] +
                '</div> ' +
                '<div class="client-row">' +
                user_email +
                '</div> ' +
                '<div class="client-row"> ' +
                telephone +
                '</div> ' +
                '<a class="btn btn-default client-all-orders lock-on" href="<?=Yii::$app->urlManager->createUrl(['/sp/orders', 'user_id' => ''])?>' + data.order.user_id + '">' +
                'Все заказы клиента' +
                '</a> ' +
                '</div> ' +
                '</div> ' +
                '</div> ');
            $('.preload').remove();
        }



        function renderOrderEdit(data) {
            updated_main_data = JSON.parse(JSON.stringify(maindata));
            $('[data-detail="'+data.id+'"]').addClass('client-active');
            moment.locale('ru');
            var final_price = 0;
            var products_html = '';
            var i_product_card_edit = 0;
            $.each(data.order.order.products, function(index_product, data_product){
                var product_data = requestProduct(this[0],this[2],this[4]);
                if((typeof(product_data.product.productsAttributes[this[2]]) !=='undefined' && product_data.product.productsAttributes[this[2]].quantity == 0) || product_data.product.products.products_quantity == 0){
                    $access = product_data.maindata.message ;
                    $identypay = false;
                }else if(product_data.maindata.result == false){
                    $access = product_data.maindata.message;
                    $identypay = false;
                }else{
                    $access = product_data.maindata.message;
                    $identypay = true;
                    final_price += Math.round(this[3]) * Math.round(this[4]);
                }
                if(product_data.product.products.products_quantity_order_min === '1'  || product_data.product.products.products_quantity_order_units === '1'){
                    $disable_for_stepping = '';
                }else{
                    $disable_for_stepping = 'readonly';
                }
                var product = product_data.product;
                var datacount = 0;

                if(typeof (product.productsAttributesDescr[this[6]]) == 'undefined'){
                    product.productsAttributesDescr[this[6]] = new Object;
                }
                if(typeof (product.productsDescription.products_name) == 'undefined'){
                    product.productsAttributesDescr[this[6]].products_name = new Object;
                    product.productsDescription['products_name'] = 'Имя не указанно';
                }
                if(product.productsAttributes[this[2]]){
                    datacount = product.productsAttributes[this[2]].quantity;
                }else{
                    datacount = product.products.products_quantity;
                }
                products_html += '' +
                    '<div style="" class="product-card-edit queue-product-card-'+i_product_card_edit+'"> ' +
                    '<div class = "access '+$identypay+'" style="display: flex">'+$access+'</div><hr style="height: 10px;margin: 0px;" />'+
                    '<div style="display: flex" class="product-main-board"> ' +
                    '<div style="display: inline-block; margin: 0 25px;width: 15%;"> ' +
                    '<div style="margin: 25px auto 0;display: inline-block;min-height: 150px;position: relative;"> ' +
                    '<img src="/imagepreview?src='+this[0]+'" style="position: relative; width: 100%"> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div style="display: inline-block;min-height: 150px;width: 20%; position: relative;"> ' +
                    '<div style="margin: 25px;line-height: 30px;"> ' +
                    '<div style="font-weight: 400;">Арт. '+this[1]+'</div> ' +
                    '<div>'+this[7]+'</div> ';
                    $size = '';
                    if(this[6] == false || this[6] == 'undefined' || this[6] == null){
                        $size = 'Без размера';
                    }else{
                        $size = this[6];
                    }
                    products_html +='<div>Размер: '+ $size+'</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div style="display: inline-block;min-height: 150px;float: right;width: 60%;position: relative;"> ' +
                    '<div style="line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;"> ' +
                    '<div> ' +
                    '<div style="font-weight: 400;font-size: 16px;padding: 10px 0px;color: #CCC;">' +
                    'Цена ' +
                    '</div> ' +
                    '<div style="font-weight: 400;font-size: 24px;padding: 10px 0px;">'+Math.round(this[3])+' р. ' +
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
                    '<div id="input-count-block" style="">' +
                    "<input id=\"input-count\""+
                    "                  style=\"width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;\""+
                    "                  data-prod=\""+product.products_id+"\""+
                    "                  data-index-product=\""+index_product+"\""+
                    "                  data-model=\""+product.products.products_model+"\""+
                    "                  data-price=\""+Math.round(product.products.products_price)+"\""+
                    "                  data-image=\""+product.products.products_image+"\""+
                    "                  data-count=\""+datacount+"\""+
                    "                  data-attrname=\""+product.productsAttributesDescr[this[6]].products_options_values_name+"\""+
                    "                  data-attr=\""+product.productsAttributesDescr[this[6]].products_options_values_id+"\""+
                    "                  data-name=\""+product.productsDescription.products_name+"\""+
                    "                  data-step=\""+product.products.products_quantity_order_units+"\""+
                    "                  data-min=\""+product.products.products_quantity_order_min+"\""+
                    "                  placeholder=\"0\""+
                    "                  value=\""+this[4]+"\""+
                    "                  type=\"text\">"+
                    " <div class=\"count-event\" id=\"add-count\"" +
                    "  style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;\">"+
                    " +"+
                    "<\/div>"+
                    "<div class=\"count-event\" id=\"del-count\""+
                    "  style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;\">"+
                    " -"+
                    "<\/div>"+
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
                    '<div class="final-product-price'+index_product+'" style="font-weight: 400;font-size: 24px;padding: 10px 0px;">'+Math.round(this[3]) * Math.round(this[4])+' р. ' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div> ' +
                    '<div style="position: relative;"> ' +
                    '<div  data-toggle="modal" data-target="#modal-comment" style="cursor:pointer;color: #5b8acf;position: absolute;left: 0px;" data-order="'+data.id+'" data-attr="'+this[2]+'" data-product="'+this[0]+'" class="product-comment">' +
                    'Добавить комментарий к товару ' +
                    '</div> ' +
                    '<div class="product-delete product" queue_card_id="'+i_product_card_edit+'" order_id="'+data.id+' "product_id="'+this[0]+'" attr="'+this[2]+'">' +
                    '<span class="url"> Удалить товар из заказа </span> ' +
                    '</div> ' +
                    '</div> ' +
                    '</div>' ;
                i_product_card_edit++
            });
            var comment_text = '';
            if(typeof (data.order.order.comment) !== 'undefined'){
                comment_text = data.order.order.comment;
            }
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
                '<textarea style="resize:none;margin: 0px;width: 100%;height: 200px;border-radius: 4px;border: 1px solid #CCC;">' +
                comment_text +
                '</textarea> ' +
                '</div> ' +
                products_html +
                '<div style=" font-weight: 400;  font-size: 16px;"> ' +
                '<span class="orders-edit-search" style="display: inline-block;">' +
                'Добавить позиции ' +
                '</span> ' +
                '<div class="search-models" style="display: inline-block;"> ' +
                '<input class="search-models-value" style="display: inline-block; margin: 0px 10px;outline:none;border: 1px solid #CCC; border-radius: 4px;width: 300px;padding: 0px 10px;" placeholder="Введите название или артикул" type="text"/> ' +
                '<div class="search-models-button"  style="display: inline-block;"></div>'+
                '</div> ' +
                '<span> ' +
                '<div class="btn search-models-button lock-on" style="display: inline-block;background: #009f9c;    padding: 1px;    width: 200px;    border: 1px solid #CCC;margin-top: -2px;color: #FFF;font-weight: 400;" class="btn">Выбрать из каталога</div> ' +
                '</span> ' +
                '</div> ' +
                '<div style="font-weight: 400;font-size: 15px;text-align: right;padding: 10px 25px;color: #CCC;"> ' +
//        '<span style=" margin-right: 10px;"> Процент организатора</span> ' +
//        '<span> ' +
//                                '<input placeholder="%">' +
//                                '</span> ' +
                '</div> ' +
                '<div style=" font-weight: 400; font-size: 32px; text-align: right;padding: 10px 25px;"> ' +
                '<span class="final_order_price"> Итого '+ final_price +' р.</span> ' +
                '<span id="save_order" class="btn" style="padding: 10px; background: #ffea00;margin: 0px 0px  0px 20px;">Сохранить заказ</span> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '</div>');
            $('.preload').remove();
        }
    });

</script>
