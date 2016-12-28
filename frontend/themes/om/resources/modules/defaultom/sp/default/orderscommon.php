<?php
/**
 * @var $data yii\data\ActiveDataProvider;
 */
?>
<?= \frontend\widgets\HeaderFilterBarNew::widget([
    'dataProvider' => $data,
    'sortOrderByData'  =>
        [
            'sort' => [
                'status'      => ['Статус'],
                'date_added' => ['Последний заказ'],
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
]);

?>
<div id="container2">
    <div id="container1">
        <div id="col1">
            <div id="scroll1" style="height: 100%">
                <?php
                \yii\widgets\Pjax::begin(['id' => 'orders']);
                $i_model = 0;
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

                                $total_price = 0;
                                $total_count_products = 0;
                                foreach ($model->partnerOrders as $order) {
                                    $products_list = unserialize($order->order);
                                    $total_count_products += count($products_list['products']);
                                    foreach ($products_list['products'] as $product) {
                                        if(count($product) > 5) {
                                            $total_price += round($product[3] * $product[4]);
                                        }
                                    }
                                }

                                $stat_class = [
                                    'status-cancel',
                                    'status-new',
                                    'status-proceed',
                                    'status-like',
                                    'status-payed',
                                    'status-ordered',
                                    'status-return',
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

                                $params = new \php_rutils\struct\TimeParams();
                                $params->date = $model->date_added; //это значение по умолчанию
                                $params->format = 'd F Y H:i:s';
                                $params->monthInflected = true;
                                $dateorder  = \php_rutils\RUtils::dt()->ruStrFTime($params);

                                $i_model += 1;
                                ( $i_model % 2 ) ? '' : $back_fff = 'background: #FFF;';
                                return
                            '<div class="client-plate lock-on" data-detail="'.$model->id.'" style="'.$back_fff.'">
                                <div class="line-info-orders">
                                    <div class="client-info-fr-order">
                                        <div class="client-order">
                                            <div class="client-order-num">№ '.$model->id.'</div>
                                            <div class="client-order-status '.$stat_class[$model->status].'"></div>
                                        </div>
                                        <div class="client-name">
                                            '.$model->header.' ('.$total_count_products.' товаров)
                                            </div>
                                        <div class="client-last-order-date">
                                            '.$dateorder.'
                                            </div>
                                    </div>
                                    <div class="client-info-fr-price">
                                        <div style="font-size: 18px;color: #4A90E2;font-weight: 400;">'.$total_price.' руб.</div>
                                    </div>
                                </div>
                            </div>';
                            }
                        ],
                    ],
                ]);
  ?>
                <?php
                \yii\widgets\Pjax::end();
                ?>
            </div>
        </div>

        <div id="col2">
            <div id="scroll2" style="height: 100%">
                <div style="margin:25px;">
                    <div style="width: 100%;  display:inline-block;" class="datacontainer">
                    <!-- renderOrders(data) -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="send_orders" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="om_partners_modal_block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Отправка заказа в ОМ</h4>
                </div>
                <div class="modal-body" id="send_orders_body">
                    <?php
                    \yii\widgets\Pjax::begin([
                        'id'=>'send',
                        'enablePushState' =>false
                    ]);
                    ?>
                    <?php
                    \yii\widgets\Pjax::end();
                    ?>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->render('modals/comment_to_product.php')?>

<?= $this->render('modals/add_new_commonorder.php')?>

<script>
    $(document).ready(function () {

        $('#send').on('pjax:end', function(){
           $('.preload').remove();
        });
        //add_new_commonorder.php после запроса обновить список
        $('#pjax_common').on('pjax:end', function(){
            refresh_list();
        });
        var order_status_label = [
            'удален',
            'новый',
            'в обработке',
            'Одобренный',
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
             'status-return',
        ];

        var orders_list = new Object();
        var in_progress = false;
        var common_orders_list = new Object();
        var input_searcncommon_order = false;

        $(document).on("click", '.client-plate' ,function(){
            if(!in_progress){
                $('.client-plate.client-active').removeClass('client-active');
                in_progress = true;
                $.ajax({
                    method:"post",
                    url: "<?=Yii::$app->urlManager->createUrl(['/sp/detail-common-orders'])?>",
                    data: {
                        "_csrf":yii.getCsrfToken(),
                        "id": $(this).attr('data-detail')
                    },
                    cache: false,
                    async: true,
                    dataType: 'json',
                    beforeSend: function () {
                        in_progress = false;
                    }
                }).done(function (data) {
                    $('[data-detail="'+data.id+'"]').addClass('client-active');
                    orders_list = data;
                    renderOrders(orders_list);
                });
                in_progress = false;
            }else{
                alert('Выполняется запрос');
            }
        });

        $(document).on('click', '.common-order', function(){
            var act = $(this).closest('.panel-default').find('.common-order-refresh').attr('data-act');
            var request = $(this).closest('.panel-default').find(".input-searcncommon-order").val();
            common_orders_list = requestCommon(act, request);
            renderCommonList(common_orders_list);

        });


        $(document).on('click', '.common-order-refresh', function(){
            var act = $(this).attr('data-act');
            var request =  $(this).closest('.panel-default').find(".input-searcncommon-order").val();
            common_orders_list = requestCommon(act, request);
            renderCommonList(common_orders_list);
        });

        function updateAllOrdersView(updated_orders_list, client_plate_update = false) {
            var final_common_price = 0;

            $.each(updated_orders_list.partnerOrders, function(index_partner_orders, partner_orders){

                var final_order_price = 0;
                var total_count_products = 0;
                if (partner_orders.order['products'] != null && partner_orders.order['products'].length > 0) {
                    total_count_products = Object.keys(partner_orders.order['products']).length;
                }
                $.each(partner_orders.order['products'], function(index_order, product){

                    final_order_price += Math.round(product[3]) * Math.round(product[4]);
                });

                final_common_price += final_order_price;
                $('.final_order_price'+partner_orders.id).text(final_order_price+ " р.");
                $('.total_count_products'+partner_orders.id).text(total_count_products);
            });

            $('.total_count_products').text('Итого '+final_common_price+' р.');

            if(client_plate_update) {
                $('[data-detail="'+updated_orders_list.id+'"]').find('.client-info-fr-price').find('div').text(final_common_price +" руб.");
            }

        }


        function refresh_list(){
            var act = $(this).closest('.panel-default').children('common-order-refresh').attr('data-act');
            var request = $(this).closest('.panel-default').children(".input-searcncommon-order").val();
            common_orders_list = requestCommon(act, request);
            renderCommonList(common_orders_list);

        }

        function renderCommonList(common_list) {
            var list_html = '';
            if(typeof(common_list) == 'undefined'){
                list_html = 'Нет общих заказов'
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
                var panel_footer = $(event.target).closest('.panel-footer');
                var act = panel_footer.children(".common-order-refresh").attr('data-act');
                var request = $(event.target).val();
                common_orders_list = requestCommon(act, request);
                renderCommonList(common_orders_list);
            }
        });


        $(document).on('click', '.list-child', function(){
            var old_text = 'Переместить в общий заказ №';
            var id_common_order = $(this).attr("common-order-id");
            var id_order = $(this).closest('.panel-default').attr('order-id');
            var button_to_common_order = $(".orders-swap-id"+id_order);
            $.ajax({
                method: 'post',
                url: "<?=Yii::$app->urlManager->createUrl(['/sp/swap-attach-order-to-common'])?>",
                data: {
                    "id_common_order": id_common_order,
                    "id_order": id_order
                },
                beforeSend: function() {
                    button_to_common_order.click();
                },
                success: function(data) {
                    if(data == true) {
                        button_to_common_order.text('Перемещен в общий заказ №'+id_common_order);
                    } else {
                        button_to_common_order.text('Ошибка!');
                        setTimeout(function() {
                            button_to_common_order.text(old_text)
                        }, 2500);
                    }
                    checkAlerts();
                }
            });
        });


        function updateCommonTotalOrder(){
            var total = 0;
            setTimeout(function() {
                $x =    $('[class*="final-product-price"]');
                $.each($x, function(){
                    total = total + parseInt($(this).text());
                });
                $('[class="final_common_price"]').text('Итого '+total+' р.');
            }, 100);
        };
        $(document).on('click', '.count-event', function(){
            var input_count = $(this).closest("#input-count-block").children("#input-count");
            calculateCommonorder(input_count);
        });
        $(document).on('keyup', '#input-count', function(){
            var input_count = $(this);
            calculateCommonorder(input_count);
        });
        function calculateCommonorder(input_count){

            setTimeout(function() {
                var new_value = input_count.val();
                var product_id = input_count.attr('data-prod');
                var attr = input_count.attr('data-attr');
                if(attr == 'undefined'){
                    attr = '';
                }
                var price = input_count.attr('data-price');
                var order_id = input_count.attr('data-order-id');
                var index_product_card = input_count.attr('data-index-product');
                updateCountProducts(product_id, attr, new_value, order_id);
                updateAllOrdersView(orders_list, false);
                updateCommonTotalOrder();
                $('.final-product-price'+index_product_card+'-'+order_id).text(Math.round(price) * Math.round(new_value) + " р.");
            }, 50);
        }
        function updateCountProducts(product_id, attr, new_value, order_id) {
            $.each(orders_list.partnerOrders, function(index_partner_orders, partner_orders){
                $.each(partner_orders.order['products'], function(index_order, product){
                    if(typeof product !== 'undefined') {
                        if(typeof (product[2]) == 'undefined' || !product[2] ){
                            product[2] = '';
                        }
                        if (product[0] == product_id && product[2] == attr && partner_orders.id == order_id) {
                            orders_list.partnerOrders[index_partner_orders].order['products'][index_order][4] = new_value;
                            return true;
                        }
                    }
                });
            });
        }

        $(document).on('click', '.product-delete.order', function(){
            var click_object = $(this);
            var order_id = click_object.closest(".panel.panel-default").attr('order-id');
            var common_id = click_object.closest(".panel.panel-default").attr('common-id');

            if (!confirm("Вы уверены, что хотите удалить этот товар из заказа?")) {
                return;
            }

            $.ajax({
                method:"post",
                url: '<?=Yii::$app->urlManager->createUrl(['/sp/delete-order-from-common-orders-links'])?>',
                data: {
                    "_csrf":yii.getCsrfToken(),
                    "order_id": order_id,
                    "common_id": common_id
                },
                cache: false,
                async: true,
                dataType: 'json'
            }).done(function (data) {
                if(data == true) {
                    click_object.closest(".panel.panel-default").hide("fast");
                    $.each(orders_list.partnerOrders, function(index_partner_orders, partner_orders){
                        if(typeof partner_orders !== 'undefined') {
                            if (partner_orders.id == order_id) {
                                orders_list.partnerOrders.splice(index_partner_orders, 1);
                                return true;
                            }
                        }
                    });
                    updateAllOrdersView(orders_list, true);
                    updateCommonTotalOrder();
                }
                checkAlerts();
            });
        });

        $(document).on('click', '.js-delete-product', function(){
            var order_id = $(this).attr('order_id');
            var product_id = $(this).attr('product_id');
            var attr = $(this).attr('attr');
            var queue_card_id = $(this).attr('queue_card_id');
            var click_object = $(this);

            if (!confirm("Вы уверены, что хотите удалить этот товар из заказа?")) {
                return;
            }
            $.each(orders_list.partnerOrders, function(index_partner_orders, partner_orders){
                $.each(partner_orders.order['products'], function(index_order, product){
                    if(typeof product !== 'undefined') {
                        if (product[0] == product_id && product[2] == attr && partner_orders.id == order_id) {

                            orders_list.partnerOrders[index_partner_orders].order['products'].splice(index_order, 1);
                            return true;
                        }
                    }
                });
            });
            click_object.closest(".product-card-common").hide("fast");
            updateAllOrdersView(orders_list, false);
        });

        var new_product = new Object();
        var product_arr = new Object();
        var maindata_arr = new Object();
        var maindata = new Object();
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
                    url: "/site/product",
                    async: false,
                    data: {id: $id}
                });
                product_arr[$id] = new Object();
                $result.product = product_arr[$id] = requestdata.responseJSON.product;
            }else{
                $result.product = product_arr[$id];
            }
            if(typeof (maindata_arr[$id]) == 'undefined'){
                maindata = $.ajax({
                    method:'post',
                    url: "/site/pre-check-product-to-orders",
                    async: false,
                    data: {
                        product: requestdata.responseJSON.product.products_id,
                        category :requestdata.responseJSON.categories_id,
                        attr :$attr,
                        count : $count,
                        skiptime: true
                    }
                });
                maindata_arr[$id] = new Object();
                $result.maindata = maindata_arr[$id] = JSON.parse(maindata.responseText);
            }else{
                $result.maindata = maindata_arr[$id];
            }

            return $result;
        }

        // СОХРАНЯЕМ ОБНОВЛЕННЫЕ ДАННЫЕ О ЗАКАЗЕ
        $(document).on('click', '#save_orders', function(){
            $.ajax({
                method: 'post',
                url: "<?=Yii::$app->urlManager->createUrl(['/sp/save-common-orders'])?>",
                data: {
                    common_order_id: orders_list.id,
                    orders_list: Object.values(orders_list.partnerOrders)
                },
                error: function (data) {
                    console.log(data);
                },
                success: function (partnerOrders) {

                    if(partnerOrders != false) {
                        orders_list.partnerOrders = partnerOrders;
                        renderOrders(orders_list);
                        updateCommonTotalOrder();
                        updateAllOrdersView(orders_list, true);
                    }
                    checkAlerts();
                }
            });
        });

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


        // Скрытие списка с объединенными заказами
        $(document).on('click', '.common-order[href*="#collapse-list-attach-order"]', function () {
            var id_collapse = $(this).attr('href');
            $('.collapse-list-attach-order:not('+id_collapse+')').collapse('hide');
        });

        $(document).on('click', function (e) {
            var collapse_blocks = $("[id*='collapse-list-attach-order']");
            if (collapse_blocks.has(e.target).length === 0){
                collapse_blocks.collapse('hide');
            }
        });
        /******************************************/

        function renderOrders(data) {

            moment.locale('ru');
            var final_common_price = 0;
            var str_html="";
            var common_id = data.id;
            $.each(data.partnerOrders, function(index_partner_orders, partner_orders){
                var final_order_price = 0;
                var total_count_products = 0;
                if (partner_orders.order['products'] != null && partner_orders.order['products'].length > 0) {
                    total_count_products = Object.keys(partner_orders.order['products']).length;
                }
                $.each(partner_orders.order['products'], function(index_order, product){
                    final_order_price += Math.round(product[3]) * Math.round(product[4]);
                });
                final_common_price += final_order_price;
                var user_name = '';
                var telephone = '';
                if(typeof (partner_orders.referral_user.userinfo) != "undefined" || typeof (partner_orders.referral_user.userinfo) != "null"){
                    if(partner_orders.referral_user.userinfo.name || partner_orders.referral_user.userinfo.lastname || partner_orders.referral_user.userinfo.secondname) {
                        user_name = partner_orders.referral_user.userinfo.name + ' ' + partner_orders.referral_user.userinfo.lastname + ' ' + partner_orders.referral_user.userinfo.secondname;
                        telephone =  partner_orders.referral_user.userinfo.telephone;
                    } else {
                        telephone = 'Не указанно';
                        user_name = 'Данных нет';
                    }
                }else {
                    telephone = 'Не указанно';
                    user_name = 'Данных нет';
                }

                str_html += "<div class=\"panel panel-default order-id-"+partner_orders.id+"\" common-id=\""+common_id+"\" order-id=\""+partner_orders.id+"\">";
                str_html += "<div class=\"panel-heading flex-container-order-header flex-container-style fixed-height\">";

                str_html += "    <a class=\"hrefline collapsed\" data-toggle=\"collapse\"";
                str_html += "       data-parent=\"#product-plane\" href=\"#product-line-"+index_partner_orders+"\">";
                str_html += "        <div class=\"flex-item\" style=\"margin-left: 30px\">";
                str_html += "                 <div class=\"client-avatar\">";
                str_html += "                     <div class=\"avatar\">";
                str_html += "                         <div class=\"client-image\">";
                str_html += "                         <\/div>";
                str_html += "                         "+img_block_client_status[partner_orders.referral_user.status]+"";
                str_html += "                     <\/div>";
                str_html += "                 <\/div>";
                str_html += "         <\/div>";
                str_html += "    <\/a>";

                str_html += "        <div class=\"flex-item\">";
                str_html += "    <a class=\" collapsed\" data-toggle=\"collapse\"";
                str_html += "       data-parent=\"#product-plane\" href=\"#product-line-"+index_partner_orders+"\">";
                str_html += "                     <div class=\"client-info-li-order\">";
                str_html += "                         <div class=\"client-order\">";
                str_html += "                             <div class=\"client-order-num\"> № "+partner_orders.id+"<\/div>";
                str_html += "                             <div class=\"client-order-status "+ stat_class[partner_orders.status] +"\"><\/div>";
                str_html += "                         <\/div>";
                str_html += "                         <div class=\"client-name-in\">";
                str_html += "                             "+user_name+"";
                str_html += "                         <\/div>";
                str_html += "                         <div class=\"client-last-order-date\">";
                str_html += "                             "+moment(partner_orders.create_date).format("D MMMM  YYYY H:mm")+"";
                str_html += "                         <\/div>";
                str_html += "                     <\/div>";
                str_html += "                     <div";
                str_html += "                         style=\"width: 15%; padding: 20px 0px;display: inline-block;\">";
                str_html += "                         <div>";
                str_html += "                             <div";
                str_html += "                                 style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                str_html += "                                 Сумма";
                str_html += "                             <\/div>";
                str_html += "                             <div class=\"final_order_price"+partner_orders.id+"\"";
                str_html += "                                 style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                str_html += "                                 "+final_order_price+" р.";
                str_html += "                             <\/div>";
                str_html += "                         <\/div>";
                str_html += "                     <\/div>";
                str_html += "                     <div";
                str_html += "                         style=\"width: 15%; padding: 20px 0px;display: inline-block;\">";
                str_html += "                         <div>";
                str_html += "                             <div";
                str_html += "                                 style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                str_html += "                                 Товаров в заказе";
                str_html += "                             <\/div>";
                str_html += "                             <div class=\"total_count_products"+partner_orders.id+"\"";
                str_html += "                                 style=\"font-weight: 400;font-size: 18px;padding: 10px 0px;text-align: center;background: #5b8acf;border-radius: 4px;padding: 2px;color: #FFF;width: 70%;line-height: 19px;margin-top: 12px;\">";
                str_html += "                                 "+total_count_products+"";
                str_html += "                             <\/div>";
                str_html += "                         <\/div>";
                str_html += "                     <\/div>";
                str_html += "    <\/a>";
                str_html += "                     <div style=\" padding: 20px 0px;display: inline-block;\">";
                str_html += "                         <div>";
                str_html += "                             <div class=\"product-delete order\">";
                str_html += "                                 <a href='#'>Удалить из общего заказа</a>";
                str_html += "                             <\/div>";
                str_html += "                             <div style='cursor: pointer' class=\"orders-swap common-order orders-swap-id"+partner_orders.id+"\"  data-toggle=\"collapse\" data-parent=\"#product-plane\" href=\"#collapse-list-attach-order-"+index_partner_orders+"\" aria-expanded=\"true\">";
                str_html += "                                 Переместить в общий заказ №";
                str_html += "                             <\/div>";
                str_html +=         '<div id="collapse-list-attach-order-'+index_partner_orders+'" class="collapse-list-attach-order panel-collapse collapse" style="z-index: 999; border: 1px solid rgb(245, 245, 245); width: 270px; position: absolute;margin-left: 45px;"> ' +
                    '<div class="panel-body" style="background: rgb(254, 254, 254) none repeat scroll 0% 0%;">' +
                    '<div class="list"></div></div> ' +
                    '<div class="panel-footer" style="line-height: 0px;">' +
                    '<input class="input-searcncommon-order" value="" placeholder="Поиск" style="max-width: 145px">'+
                    '<div class="searcncommon-order"  style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                    '<i class="mdi">&#xE8B6;</i>' +
                    '</div>' +
                    '<div class="common-order-refresh" data-act="refresh" style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                    '<i class="mdi">&#xE042;</i>' +
                    '</div>' +
                    '<div data-toggle="modal" data-target="#modal-common"  style="display: inline; font-size: 24px; padding: 5px; cursor: pointer;">' +
                    '<i class="mdi">&#xE145;</i>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                str_html += "                         <\/div>";
                str_html += "                     <\/div>";
                str_html += "        <\/div>";

                str_html += "<\/div>";

                str_html += " <div id=\"product-line-"+index_partner_orders+"\" class=\"panel-collapse collapse\">";
                str_html += "  <div class=\"panel-body\">";


                $.each(partner_orders.order['products'], function(index_order, order){
                    var product_data = requestProduct(order[0], order[2] , order[4]);
                    if((typeof(product_data.product.productsAttributes[this[2]]) !=='undefined' && product_data.product.productsAttributes[this[2]].quantity == 0) || product_data.product.products.products_quantity == 0){
                        $access = product_data.maindata.message ;
                        $identypay = false;
                    }else if(product_data.maindata.result == false){
                        $access = product_data.maindata.message;
                        $identypay = false;
                    }else{
                        $access = product_data.maindata.message;
                        $identypay = true;
                    }
                    if(product_data.product.products.products_quantity_order_min === '1'  || product_data.product.products.products_quantity_order_units === '1'){
                        $disable_for_stepping = '';
                    }else{
                        $disable_for_stepping = 'readonly';
                    }

                    if(typeof (product_data.product.productsAttributesDescr[this[6]]) == "undefined" || product_data.product.productsAttributesDescr[this[6]].length == 0){
                        product_data.product.productsAttributesDescr[this[6]]= new Object;
                        product_data.product.productsAttributesDescr[this[6]].products_options_values_name = 'Без размера';
                        product_data.product.productsAttributesDescr[this[6]].products_options_values_id = '';
                    }

                    if(typeof (product_data.product.productsDescription.products_name) == 'undefined'){
                        product_data.product.productsAttributesDescr[this[6]].products_name = new Object;
                        product_data.product.productsDescription['products_name'] = 'Имя не указанно';
                    }
                    if(product_data.product.productsAttributes[this[2]]){
                        datacount = product_data.product.productsAttributes[this[2]].quantity;
                    }else{
                        datacount = product_data.product.products.products_quantity;
                    }

                    str_html += "<div style=\"\" class=\"product-card-common order-"+index_order+" product-"+index_order+"\">";
                    str_html += "<div class = \"access "+$identypay+"\">"+$access+"</div><hr style=\"height: 10px;margin: 0px;\" />";

                    str_html += " <div style=\"display: flex;\" class=\"product-main-board\">";
                    str_html += "      <div";
                    str_html += "          style=\"display: inline-block;min-width: 100px;min-height: 150px;width: 19%;position: relative; margin-top: 25px;\">";
                    str_html += '       <div style="margin: 0 auto;display: inline-block;min-height: 150px;position: relative;"> ';
                    str_html += "          <img  src=\"\/imagepreview?src="+order[0]+"\"";
                    str_html += "               style=\"width: 100%;position: relative;\">";
                    str_html += "      <\/div>";
                    str_html += "      <\/div>";
                    str_html += "      <div";
                    str_html += "          style=\"display: inline-block;width: 20%;\">";
                    str_html += "          <div style=\"position: relative;margin: 25px;line-height: 30px;\">";
                    str_html += "              <div style=\"font-weight: 400;\">Арт. "+order[1]+"<\/div>";
                    str_html += "              <div>"+order[7]+"<\/div>";
                    str_html += "              <div>Размер: "+product_data.product.productsAttributesDescr[this[6]].products_options_values_name+"<\/div>";
                    str_html += "          <\/div>";
                    str_html += "      <\/div>";
                    str_html += "      <div";
                    str_html += "          style=\"display: inline-block;min-height: 150px;float: right;width: 60%;position: relative;\">";
                    str_html += "          <div";
                    str_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 0px;bottom: 0px;margin: auto;height: 80%;\">";
                    str_html += "              <div>";
                    str_html += "                  <div";
                    str_html += "                      style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                    str_html += "                      Цена";
                    str_html += "                  <\/div>";
                    str_html += "                  <div";
                    str_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                    str_html += "                      "+Math.round(order[3])+" р.";
                    str_html += "                  <\/div>";
                    str_html += "              <\/div>";
                    str_html += "          <\/div>";
                    str_html += "          <div";
                    str_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;left: 33%;bottom: 0px;margin: auto;height: 80%;\">";
                    str_html += "              <div>";
                    str_html += "                  <div";
                    str_html += "                      style=\"font-weight: 300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                    str_html += "                      Количество";
                    str_html += "                  <\/div>";
                    str_html += "                  <div";
                    str_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                    str_html += "                      <div class=\"size-desc\"";
                    str_html += "                           style=\"color: black; padding: 0px; font-size: small; position: relative; max-width: 90%;\">";
                    str_html += "                          <div id=\"input-count-block\" style=\"\"><input id=\"input-count\"";
                    str_html += "                                               style=\"width: 60%;height: 30px;text-align: center;position: relative;top: 0px;border: none;outline: none;font-size: 24px;\"";
                    str_html += "                                               data-order-id=\""+partner_orders.id+"\"";
                    str_html += "                                               data-index-product=\""+index_order+"\"";
                    str_html += "                                               data-prod=\""+product_data.product.products_id+"\"";
                    str_html += "                                               data-model=\""+product_data.product.products.products_model+"\"";
                    str_html += "                                               data-price=\""+Math.round(product_data.product.products.products_price)+"\"";
                    str_html += "                                               data-image=\""+product_data.product.products.products_image+"\"";
                    str_html += "                                               data-count=\""+datacount+"\"";
                    str_html += "                                               data-attrname=\""+product_data.product.productsAttributesDescr[order[6]].products_options_values_name+"\"";
                    str_html += "                                               data-attr=\""+product_data.product.productsAttributesDescr[order[6]].products_options_values_id+"\"";
                    str_html += "                                               data-name=\""+product_data.product.productsDescription.products_name+"\"";
                    str_html += "                                               data-step=\""+product_data.product.products.products_quantity_order_units+"\"";
                    str_html += "                                               data-min=\""+product_data.product.products.products_quantity_order_min+"\"";
                    str_html += "                                               placeholder=\"0\"";
                    str_html += "                                               value=\""+order[4]+"\"";
                    str_html += "                                               type=\"text\">";
                    str_html += "                              <div class=\"count-event\" id=\"add-count\"";
                    str_html += "                                   style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;float: right;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;\">";
                    str_html += "                                  +";
                    str_html += "                              <\/div>";
                    str_html += "                              <div class=\"count-event\" id=\"del-count\"";
                    str_html += "                                   style=\"margin: 0px;line-height: 30px;font-size: 15px;font-weight: 500;padding: 0;background: 0 center rgb(255, 255, 255);text-align: center;color: #000;border-radius: 3px;width: 30px;height: 30px;border: 1px solid #CCC;float: left;\">";
                    str_html += "                                  -";
                    str_html += "                              <\/div>";
                    str_html += "                          <\/div>";
                    str_html += "                      <\/div>";
                    str_html += "                  <\/div>";
                    str_html += "              <\/div>";
                    str_html += "          <\/div>";
                    str_html += "          <div";
                    str_html += "              style=\"line-height: 30px;display: inline-block;width: 30%;position: absolute;top: 0px;    right: 0;bottom: 0px;margin: auto;height: 80%;\">";
                    str_html += "              <div>";
                    str_html += "                  <div";
                    str_html += "                      style=\"font-weight:300;font-size: 16px;padding: 10px 0px;color: #555;\">";
                    str_html += "                      Сумма";
                    str_html += "                  <\/div>";
                    str_html += "                  <div class=\"final-product-price"+index_order+"-"+partner_orders.id+"\"";
                    str_html += "                      style=\"font-weight: 400;font-size: 24px;padding: 10px 0px;\">";
                    str_html += "                      "+(Math.round(order[3]) * Math.round(order[4])) +" р.";
                    str_html += "                  <\/div>";
                    str_html += "              <\/div>";
                    str_html += "          <\/div>";
                    str_html += "      <\/div>";
                    str_html += "  <\/div>";
                    str_html += "  <div style=\"position: relative;\">";
                    str_html += "      <div data-toggle=\"modal\" data-target=\"#modal-comment\"";
                    str_html += "          style=\"cursor:pointer;color: #5b8acf;position: absolute;left: 0px;\"";
                    str_html += "           data-order='"+partner_orders.id+"' data-attr='"+product_data.product.productsAttributesDescr[order[6]].products_options_values_id+"' data-product="+product_data.product.products_id+" " ;
                    str_html += "          class=\"product-comment\">";
                    str_html += "          Добавить комментарий к товару";
                    str_html += "      <\/div>";
                    str_html += "      <div";
                    str_html += "          class=\"product-delete product js-delete-product\" queue_card_id=\""+index_order+"\" order-index=\""+index_partner_orders+"\" order_id=\""+partner_orders.id+"\" product_id=\""+order[0]+"\" attr=\""+order[2]+"\">";
                    str_html += "          Удалить товар из заказа";
                    str_html += "      <\/div>";
                    str_html += "  <\/div>";
                    str_html += "<\/div>";
                });
                str_html += "        <\/div>";
                str_html += "    <\/div>";
                str_html += "<\/div>";


            });

            $('.datacontainer').html(
                '<div id="accordion-common-list">' +
                '<div style="margin-bottom: 25px;" class="order-line">' +
                '<span data-order="'+data.id+'"  class="common-num-order">Общий заказ № '+data.id+'</span>' +
                '<span class="date-order">от '+moment(data.date_added).format("D MMMM  YYYY")+'</span>' +
                '<a class="create-common-order"  data-toggle="modal" style="cursor: pointer">Одобрить заказ</a>' +
                '</div>' +
                '<div class="panel-group" id="product-plane">' +
                str_html +
                '</div>' +
                '<div></div>' +
                '<div style=" font-weight: 400; font-size: 32px; text-align: right;padding: 10px 25px;">' +
                '<span class="final_common_price"> Итого '+final_common_price+' р.</span>' +
                '<span id="save_orders" class="btn" style="padding: 10px; color:#FFF; background: #ff1744;margin: 0px 0px  0px 20px;">Сохранить заказ</span>' +
                '</div>' +
                '</div>' +
                '<div style="min-height: 100px"></div>'
            );


            $(document).on('click', '.create-common-order', function () {
                $.ajax({
                        url: '/sp/send-common-orders',
                        method: 'post',
                        async: false,
                        data:{
                            form : $('[data-order]').attr('data-order')
                        },
                        success: function (data) {
                            $('#send').html(data);
                            $('#send_orders').modal('show');
                        }
                    }
                )
            })
            $('.preload').remove();
        }
    });
</script>

<div style="display: none;" id="modal-comment" class="fade modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4>Редактировать комментарий</h4>
            </div>
            <div class="modal-body">
                <div>
                </div>
                <?php
                \yii\widgets\Pjax::begin([
                    'id'=>'comment',
                    'enablePushState' =>false
                ]);
                ?>
                <div class="comment-content-body"></div>
                <?php
                \yii\widgets\Pjax::end();
                ?>
            </div>
        </div>
    </div>
</div>