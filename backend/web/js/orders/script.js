$.ajax({
    url : "/orders/default/orderslist",
    data : 'cat=1',
    cache : false,
    async : true,
    dataType : 'json',
    success : function(data) {
        $('#orders-table').DataTable( {
            data: data,
            paging: true,
            ordering: true,
            LengthChange: true,
            responsive: true,
            columns: [
                { data: 'id', title: "id" },
                { data: 'orders_id', title: "Заказ ОМ", "render": function(data){
                    if(data !== null){
                        return data;
                    }else{
                        return 'Не передан в систему ОМ';
                    }
                }},
                { data: 'partners_id', title: "Партнер" },
                { data: 'user_id', title: "Пользователь" },
                { data: 'order', title: "Заказ", "render": function ( data, type, full, meta ) {
                    delete data.ship;
                    $inner = '<table class="cell-border"><thead></thead><tbody>';
                    $i = 0;
                    $allitem = 0;
                    $allprice = 0;
                    $.each(data, function(){
                        $inner += '<tr>';
                        $inner += '<td style="width: 100%;"><img src="http://odezhda-master.ru/images/'+this[5]+'" width="50px" height="50px"/></td>';
                        $inner += '<td style="width: 100%;">'+this[1]+'</td>';
                        console.log(this[6]);
                        if(this[6] != 'undefined') {
                            $inner += '<td style="width: 100%;">' + this[6] + '</td>';
                        }else{
                            $inner += '<td style="width: 100%;">Без размера</td>';
                        }
                        $inner += '<td style="width: 100%;">'+this[4]+'</td>';
                        $inner += '<td style="width: 100%;">'+parseInt(this[3])+'</td>';
                        $inner += '</tr>'
                        $i++;
                        $allitem += parseInt(this[4]);
                        $allprice += parseInt(this[3])*parseInt(this[4]);
                    });
                    $inner +='<tr style="background: rgb(224, 228, 233) none repeat scroll 0% 0%;"><td>Позиций: '+$i+'</td><td>Товаров: '+$allitem+'</td><td colspan="3">Цена заказа: '+$allprice+'</td></tr></tbody></table>';
                    return $inner;
                }},
                { data: 'delivery', title: "Адрес доставки",  "render": function ( data, type, full, meta ) {
                    console.log(data);
                    return data.country+'\, '+data.state+'\, '+data.city+'\, '+data.adress+'\, '+data.postcode;
                }},
                { data: 'status', title: "Статус" },
            ]
        } );
        $('#orders-table tbody').on('click', 'tr', function () {
            var id = $('td', this).eq(0).text();

        } );
    }

});