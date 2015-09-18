$(document).on('click', '.settings', function() {





});

$(document).on('click', '.admin-orders-data-phantom', function() {

        $(this).children().modal('show');

});

$(document).on('click', '.admin-orders-adress-phantom', function() {
    $(this).children().children().modal('show');
});

$(document).on('click', '.admin-order-adress', function() {
    $(this).children().children().modal('close');
});

$(document).on('click', '.admin-orders-data', function() {
    $(this).children().children().modal('close');
});

$(document).on('click', '.users', function() {
    $.ajax({
        url : "/admin/default/requestusers",
        data : 'cat=1',
        cache : false,
        async : true,
        dataType : 'json',
        success : function($data) {
           $('.bside').html('');
            $inner = '<div class="admin-users-row"><div class="admin-users-num-header">№ п/п</div><div class="admin-users-name-header">Логин</div><div class="admin-users-mail-header">E-mail</div><div class="admin-users-date-reg-header">Зарегистрирован</div><div class="admin-users-date-update-header">Профиль обновлен</div></div>';
            $innercount = '';
           $.each($data,function(){
               $inner +='<div class="admin-users-row"><div class="admin-users-num">'+($innercount++)+'</div><div class="admin-users-name">'+this['username']+'</div><div class="admin-users-mail">'+this['email']+'</div><div class="admin-users-date-reg">'+timeConverter(this['created_at'])+'</div><div class="admin-users-date-update">'+timeConverter(this['updated_at'])+'</div></div>';
           });
            $('.bside').append($inner);


        }

    });
});
$(document).on('click', '.orders', function() {
    $pagenav = 0;
    if($('[data-page-nav]').length > 0) {
        $page = $('[data-page-nav]');
        $page =  parseInt($page[0].getAttribute('data-page-nav'));
    }else{
        $page = 0;
    }

    if(this.getAttribute('class').indexOf('nav-next') != -1){
        $page += 1;

    }else if(this.getAttribute('class').indexOf('nav-prev')!= -1){
        $page += -1;
    }
    $.ajax({
        url : "/admin/default/requestorders",
        data : 'cat=1&nav='+$pagenav+'&page='+$page,
        cache : false,
        async : true,
       // dataType : 'json',
        success : function($data) {
            $statusarr =  new Object();
            $statusarr[100] = 'Принят в обработку';
            $statusarr[1] = 'Ожидает проверки';
            $statusarr[2] = 'Ждём оплаты';
            $statusarr[3] = 'Оплачен';
            $statusarr[4] = 'Оплачен - Доставляется';
            $statusarr[5] = 'Оплачен - Доставлен';
            $statusarr[6] = 'Отменён';
            $statusarr[11] = 'Сборка';
            $statusarr[0] = 'Спецпредложение';
            if($data.ordersatus != undefined) {
                $orders = $data.ordersatus;
                delete $data.ordersatus;
                $page = $data.page;
                delete $data.page;
            }else{
                $orders = '';
            }
            $('.bside').html('');
            $inner = '<div class="admin-orders-row"><div class="admin-orders-num-header">№ п/п</div><div class="admin-orders-id-header">Идентификатор</div><div class="admin-orders-name-header">Заказчик</div><div class="admin-orders-data-head">Заказ</div><div class="admin-order-adress-header">Адрес</div><div class="admin-order-status-header">Статус</div></div>';
            $innercount = '';
            $.each($data,function() {

                $innerdata = '';
                $adress = '';
                $dataq = this.order;
                $dataadress = this.delivery;
                $dataordersnum = this.orders_id;
                $dataorderinfo = $orders[$dataordersnum];
                if (this['orders_id'] == undefined ) {
                    $status = '<div class="admin-order-status"><div style="background:#48C04E">Доставка <input type="checkbox" value="0">клиенту</div><div style="background:#48C04E;"><input type="checkbox" value="1">магазину</div></div>';
                    if (this.order != undefined) {
                        $.each($dataq, function () {
                            $innerdata += '<div style="clear: both;" class="admin-order-show"><div class="admin-orders-prodimg" style="float: left;  max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px;  background: #fff no-repeat scroll 50% 50% / contain url(http://odezhda-master.ru/images/' + this[5] + ');"></div><div class="admin-orders-prodid">' + this[0] + '</div><div class="admin-orders-prodmodel">' + this[1] + '</div><div class="admin-orders-prodsize">' + this[6] + '</div><div class="admin-orders-prodcount">' + this[4] + '</div></div>';
                        });
                        $adress += '<div><div id="user-country"><b>Страна: </b>'+$dataadress['country']+'</div><div id="user-state"><b>Область/регион: </b>'+$dataadress['state']+'</div><div id="user-city"><b>Город: </b>'+$dataadress['city']+'</div><div id="user-adress"><b>Адрес: </b>'+$dataadress['adress']+'</div><div id="user-postcode"><b>Почтовый код: </b>'+$dataadress['postcode']+'</div><div id="user-lastname"><b>Фамилия: </b>'+$dataadress['lastname']+'</div><div id="user-name"><b>Имя: </b>'+$dataadress['name']+'</div><div id="user-secondname"><b>Отчество: </b>'+$dataadress['secondname']+'</div><div id="user-telephone"><b>Телефон: </b>'+$dataadress['telephone']+'</div><div id="user-pasportser"><b>Серия паспорта: </b>'+$dataadress['pasportser']+'</div><div id="user-pasportnum"><b>Номер паспорта: </b>'+$dataadress['pasportnum']+'</div><div id="user-pasportwhere"><b>Кем выдан: </b>'+$dataadress['pasportwhere']+'</div><div id="user-pasportdate"><b>Когда выдан: </b>'+$dataadress['pasportdate']+'</div></div>';
                    } else {
                        $innerdata = 'Ошибка чтения из базы';
                    }
                }
                else if(this['orders_id'] > 0){
                    $status = '<div class="admin-order-status2">'+$statusarr[$dataorderinfo.orders_status]+'</div>';
                    $adress += '<div><div id="user-country"><b>Страна: </b>'+$dataadress['country']+'</div><div id="user-state"><b>Область/регион: </b>'+$dataadress['state']+'</div><div id="user-city"><b>Город: </b>'+$dataadress['city']+'</div><div id="user-adress"><b>Адрес: </b>'+$dataadress['adress']+'</div><div id="user-postcode"><b>Почтовый код: </b>'+$dataadress['postcode']+'</div><div id="user-lastname"><b>Фамилия: </b>'+$dataadress['lastname']+'</div><div id="user-name"><b>Имя: </b>'+$dataadress['name']+'</div><div id="user-secondname"><b>Отчество: </b>'+$dataadress['secondname']+'</div><div id="user-telephone"><b>Телефон: </b>'+$dataadress['telephone']+'</div><div id="user-pasportser"><b>Серия паспорта: </b>'+$dataadress['pasportser']+'</div><div id="user-pasportnum"><b>Номер паспорта: </b>'+$dataadress['pasportnum']+'</div><div id="user-pasportwhere"><b>Кем выдан: </b>'+$dataadress['pasportwhere']+'</div><div id="user-pasportdate"><b>Когда выдан: </b>'+$dataadress['pasportdate']+'</div></div>';
                    $prod_content = '';
                    $resultprice = 0;
                    $resultcount = 0;
                    $resultcountpos = 0;
                    $oldresultprice = 0;
                    $oldresultcount = 0;
                    $oldresultcountpos = 0;
                    $.each($dataorderinfo.products, function(index){
                        if(this.products_quantity == 0){
                            $raw_style = 'style="background: rgb(255, 92, 92) none repeat scroll 0% 0%;"';
                            $prod_stat = 'Нет в наличии!';
                        }else if(this.products_quantity === this.first_quant){
                            $raw_style= 'style="background: #45B74A  none repeat scroll 0% 0%;"';
                            $prod_stat = 'Количество соответствует';
                        }else{
                            $raw_style= 'style="background: #ECE37F none repeat scroll 0% 0%;"';
                            $prod_stat = 'Количество измененно';
                        }
                        $checkattr = this.orders_products_id;
                        $attr = '';
                        $.each($dataorderinfo.productsAttr, function(){
                           if(this.orders_products_id == $checkattr){
                               $attr = this.products_options_values;
                           }
                        });
                        if($attr != ''){
                            $prod_atr = $attr;
                        }else{
                            $prod_atr = 'Без размера';

                        }
                        $resultprice += (parseInt(this.products_quantity)*parseInt($dataorderinfo.products[index].products_price));
                        $oldresultprice += (parseInt(this.first_quant)*parseInt($dataorderinfo.products[index].products_price));
                        $resultcount += parseInt(this.products_quantity);
                        $oldresultcount += parseInt(this.first_quant);
                        $oldresultcountpos += 1;
                        if(parseInt(this.products_quantity) != 0){
                            $resultcountpos += 1;
                        }
                        $prod_content += '<div class="row-prod"><div class="prod-content-raw" '+$raw_style+'><div class="admin-orders-prodimg" style="float: left;  max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px;  background: #fff no-repeat scroll 50% 50% / contain url(http://odezhda-master.ru/images/' + $dataq[index][5] + ');"></div><div>'+$prod_stat+'</div></div><div class="colone"><div class="prod-content-count">'+this.products_quantity+'х'+this.products_name+'</div><div class="prod-content-attr">Размер: '+$prod_atr+'</div></div><div  class="coltwo"><div class="prod-content-code">'+$dataorderinfo.products[index].products_model+'</div></div><div  class="colthree"><div class="prod-content-price">'+this.products_quantity+'х'+parseInt($dataorderinfo.products[index].products_price)+' Руб.</div></div><div class="prod-content-priceallraw">'+(parseInt(this.products_quantity)*parseInt($dataorderinfo.products[index].products_price))+' Руб.</div></div>';
                    });

                    $prod_content += '<div class="result-prod"><div class="old-prod-order"><div>Товаров в наличии: '+$resultcount+' позиций: '+$resultcountpos+'</div><div><font color="red">Новая сумма товаров в заказе: '+$resultprice+' Руб.</font></div></div><div class="new-prod-order"><div>Товаров в заказе '+$oldresultcount+' позиций: '+$oldresultcountpos+'</div><div>Сумма товаров в заказе: '+$oldresultprice+' Руб.</div></div></div>';

                    $innerdata += '<div class="admin-order-om-wrap" style="height: 100%; width:100%"><div class="admin-order-om-show">'+$dataorderinfo.orders_id+'</div><div class="admin-order-om-adress">'+$dataorderinfo.delivery_country+', '+$dataorderinfo.delivery_state+', '+$dataorderinfo.delivery_city+', '+$dataorderinfo.delivery_street_address+', '+$dataorderinfo.delivery_postcode+'</div><div class="admin-order-om-name">'+$dataorderinfo.delivery_lastname+' '+$dataorderinfo.delivery_name+' '+$dataorderinfo.delivery_otchestvo+'</div><div class="admin-order-om-prod-container">'+$prod_content+'</div></div>';

                }else{
                    $status = '<div class="admin-order-status3">Неопределен</div>';
                }
                $inner +='<div class="admin-orders-row"><div class="admin-orders-num">'+(($innercount++)+$page*10)+'</div><div class="admin-orders-id">'+this['id']+'</div><div class="admin-orders-name">'+this.delivery.lastname+' '+this.delivery.name+' '+this.delivery.secondname+'</div><div class="admin-orders-data-phantom"><div data-tog="'+$innercount+'" class="admin-orders-data  modal"><div style="padding: 10px; overflow: auto; background: rgb(251, 251, 251) none repeat scroll 0% 0%; box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); height: 100%;"><div data-tog="'+$innercount+'" id="admclose">x</div>'+$innerdata+'</div></div></div><div class="admin-orders-adress-phantom"><div><div data-tog="'+$innercount+'" class="admin-order-adress modal"><div data-tog="'+$innercount+'" id="admclose">x</div>'+$adress+'</div></div></div>'+$status+'</div>';
            });

            $pager = '';
            $pager += ' <div data-page="" class="page orders nav-prev btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="#"></a></i></div> ';
            $pager += ' <div data-page="" class="page  orders nav-next  btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="#"></a></i></div> ';
            $('.bside').append('<div data-page-nav="'+$page+'">'+$inner+$pager+'</div>');

        }
    });
});



$(document).on('click', '.admin-order-status', function() {
    $id = $(this).siblings('div.admin-orders-id')[0].textContent;
    $self = $(this).children().children('input:checked').val();
    $where = '';
    if($self == 1){
        $where = 'на адрес вашего магазина?';
    }else{
        $where = 'на адрес указанный клиентом?';

    }
    $(".accept").remove();
    $('html').append('<div class="modal accept"><div class="diax">Вы подтверждаете отправку заказа № '+$id+' '+$where+'<div></div><button class="button-accept-delegate" data-id="'+$id+'" data-where="'+$self+'">yes</button><button class="close-button-accept">no</button></div></div>');
    $('.accept').show();
});

$(document).on('click', '.close-button-accept', function() {
    $('.accept').remove();
    $('input:checked').removeAttr('checked');

});
$(document).on('click', '.button-accept-delegate', function() {
   $id = this.getAttribute('data-id');
    $self = this.getAttribute('data-where');
    $('.accept').remove();
    $('input:checked').removeAttr('checked');
    location.reload();
    $(this).html('Отправка заказа').addClass('admin-order-status2').removeClass('admin-order-status');
    $.ajax({
        type: "POST",
        url : "/admin/default/delegate",
        data : {
            id: $id,
            self: $self
        },
        cache : false,
        async : true,
        dataType : 'json',
        statuscode :{
            200 : function() {
           $('.admin-order-status2').html('ОК');
        },
            404 : function() {
                $('.admin-order-status2').html('Не доступно');
            },
            500 : function() {
                $('.admin-order-status2').html('Ошибка обработки');
            }

        }

    });

});

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp*1000);
    var year = a.getFullYear();
    var month = a.getMonth();
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + '-' + month + '-' + year + '   ' + hour + '.' + min + '.' + sec ;
    return time;
}

$(document).on('click', '#admclose', function() {
    $cl = this.getAttribute('data-tog');
    $('[data-tog='+$cl+']').modal('hide');
});