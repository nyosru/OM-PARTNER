$(document).on("click", ".settings", function () {
    window.location = "/admin"
});
$(document).on("click", ".admin-orders-data-phantom", function () {
    $(this).children().modal("show")
});
$(document).on("click", ".admin-orders-adress-phantom", function () {
    $(this).children().children().modal("show")
});
$(document).on("click", ".admin-order-adress", function () {
    $(this).children().children().modal("close")
});
$(document).on("click", ".admin-orders-data", function () {
    $(this).children().children().modal("close")
});
$(document).on("click", ".users", function () {
    $.ajax({
        url: "/admin/default/requestusers",
        data: "cat=1",
        cache: false,
        async: true,
        dataType: "json",
        success: function (a) {
            $(".bside").html("");
            $inner = '<div class="admin-users-row"><div class="admin-users-num-header">№ п/п</div><div class="admin-users-name-header">Логин</div><div class="admin-users-mail-header">E-mail</div><div class="admin-users-date-reg-header">Зарегистрирован</div><div class="admin-users-date-update-header">Профиль обновлен</div></div>';
            $innercount = "";
            $.each(a, function () {
                $inner += '<div class="admin-users-row"><div class="admin-users-num">' + ($innercount++) + '</div><div class="admin-users-name">' + this["username"] + '</div><div class="admin-users-mail">' + this["email"] + '</div><div class="admin-users-date-reg">' + timeConverter(this["created_at"]) + '</div><div class="admin-users-date-update">' + timeConverter(this["updated_at"]) + "</div></div>"
            });
            $(".bside").append($inner)
        }
    })
});
$(document).on("click", ".orders", function () {
    $pagenav = 0;
    if ($("[data-page-nav]").length > 0) {
        $page = $("[data-page-nav]");
        $page = parseInt($page[0].getAttribute("data-page-nav"))
    } else {
        $page = 0
    }
    if (this.getAttribute("class").indexOf("nav-next") != -1) {
        $page += 1
    } else {
        if (this.getAttribute("class").indexOf("nav-prev") != -1) {
            $page += -1
        }
    }
    $.ajax({
        url: "/admin/default/requestorders",
        data: "cat=1&nav=" + $pagenav + "&page=" + $page,
        cache: false,
        async: true,
        success: function (a) {
            $statusarr = new Object();
            $statusarr[100] = "Обработка заказа";
            $statusarr[1] = "Обработка заказа";
            $statusarr[2] = "Ждём оплаты";
            $statusarr[3] = "Оплачен";
            $statusarr[4] = "Оплачен - Доставляется";
            $statusarr[5] = "Оплачен - Доставлен";
            $statusarr[6] = "Отменён";
            $statusarr[11] = "Сборка";
            $statusarr[0] = "Спецпредложение";
            $statusinner = "";
            if (a.ordersatus != undefined) {
                $orders = a.ordersatus;
                delete a.ordersatus;
                $page = a.page;
                delete a.page
            } else {
                $orders = ""
            }
            $(".bside").html("");
            $inner = '<div class="admin-orders-row"><div class="admin-orders-num-header">№ п/п</div><div class="admin-orders-id-header">Идентификатор</div><div class="admin-orders-name-header">Заказчик</div><div class="admin-orders-data-head">Заказ</div><div class="admin-order-adress-header">Адрес</div><div class="admin-order-status-header">Статус</div><div class="admin-order-adress-header">Управление</div></div>';
            $innercount = "";
            $.each(a, function () {
                if (this != 0) {
                    $innerdata = "";
                    $adress = "";
                    $dataq = this.order;
                    $datadiscount = this.discounttotal;

                    if (typeof this.userDecription !== 'undefined') {
                        $useremail = this.userDescription;
                    } else {
                        $useremail = 'E-mail не указан';
                    }
                    $useremail = this.userDescription;
                    if (this.delivery == undefined) {
                        $dataadress = ""
                    } else {
                        $dataadress = this.delivery
                    }
                    if (this.status == 1) {
                        $status = '<div class="admin-order-status">Новый</div>';
                        $statusinner = '<i class="fa fa-truck admin-orders-navigation-control" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" id="order-to-storage"></i><i id="order-to-user"  data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control"></i><i id="cancel-order" data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control"></i>'
                    } else {
                        if (this.status == 0) {
                            $status = '<div class="admin-order-status">Отменен</div>';
                            $statusinner = '<i class="fa fa-truck admin-orders-navigation-control-inactive" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" ></i><i   data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control-inactive"></i><i  data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control-inactive"></i>'
                        } else {
                            if (this.status == 10) {
                                $statusinner = '<i class="fa fa-truck admin-orders-navigation-control-active" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" ></i><i  data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control-inactive"></i><i  data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control-inactive"></i>'
                            } else {
                                if (this.status == 20) {
                                    $statusinner = '<i class="fa fa-truck admin-orders-navigation-control-inactive" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" ></i><i   data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control-active"></i><i  data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control-inactive"></i>'
                                } else {
                                    $status = '<div class="admin-order-status">Ошибка</div>';
                                    $statusinner = '<i class="fa fa-truck admin-orders-navigation-control" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" ></i><i id="order-to-user"  data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control"></i><i  data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control"></i>'
                                }
                            }
                        }
                    }
                    $dataordersnum = this.orders_id;
                    $dataorderinfo = $orders[$dataordersnum];
                    if (this["orders_id"] == undefined) {
                        $innerdata += '<div><div class="order-show-image">Изображение</div><div class="order-show-model">Артикул, наименование</div><div class="order-show-count">Размер x Количество</div><div class="order-show-price">Цена</div></div>';
                        $totalcountorder = 0;
                        $totalpriceorder = 0;
                        $totalpositionorder = 0;
                        if (this.order != undefined) {
                            $.each($dataq, function () {
                                if (this[7] == 'undefined' || this[7] == '' || typeof this[7] == 'undefined') {
                                    $prodname = 'Не указанно';
                                } else {
                                    $prodname = this[7];
                                }
                                if (this[6] == 'undefined' || this[6] == '') {
                                    $size = 'Без размера';
                                } else {
                                    $size = this[6];
                                }
                                $totalcountorder = $totalcountorder + parseInt(this[4]);
                                $totalpositionorder = $totalpositionorder + 1;
                                $totalpriceorder = $totalpriceorder + parseInt(this[3]) * parseInt(this[4]);
                                $innerdata += '<div style="clear: both;" class="order-show"><div class="orders-prodimg" style="float: left;  max-height: 100px;  min-height: 100px; min-width: 180px;  background: url(/site/imagepreview?src=' + this[5] + ') #fff no-repeat scroll 50% 50% / contain;"></div><div class="orders-prodid"><div>Артикул: ' + this[1] + '</div><div>Наименование: ' + $prodname + '</div></div><div class="orders-prodsize">' + $size + ' x ' + this[4] + '</div><div class="orders-prodsize"><div>Цена за штуку: ' + parseInt(this[3]) + ' Руб.</div><div>Цена позиции: ' + parseInt(this[3]) * parseInt(this[4]) + ' Руб.</div></div></div>';
                            });
                            $innerdata += '<div style="clear: both;" class="order-show"><div class="count-order-position">Итого: </div><div class="count-order-position">Позиций: ' + $totalpositionorder + '</div><div class="count-order-position">Товаров: ' + $totalcountorder + '</div><div class="count-order-position">Сумма заказа: ' + $totalpriceorder + ' Руб.</div></div>';
                            if ($datadiscount > 0) {
                                $totalpriceorder = parseInt($totalpriceorder - $totalpriceorder / 100 * $datadiscount);
                                $innerdata += '<div style="clear: both;" class="order-show"><div class="count-order-position">Ваша скидка: ' + $datadiscount + '%</div><div class="order-total-discount">Сумма заказа c учетом скидки: ' + $totalpriceorder + ' Руб.</div></div>';
                            }
                            $adress += '<div><div id="user-country"><b>Страна: </b>' + $dataadress.country + '</div><div id="user-state"><b>Область/регион: </b>' + $dataadress.state + '</div><div id="user-city"><b>Город: </b>' + $dataadress.city + '</div><div id="user-adress"><b>Адрес: </b>' + $dataadress.adress + '</div><div id="user-postcode"><b>Почтовый код: </b>' + $dataadress.postcode + '</div><div id="user-lastname"><b>Фамилия: </b>' + $dataadress.lastname + '</div><div id="user-name"><b>Имя: </b>' + $dataadress.name + '</div><div id="user-secondname"><b>Отчество: </b>' + $dataadress.secondname + '</div><div id="user-telephone"><b>Телефон: </b>' + $dataadress.telephone + '</div><div id="user-pasportser"><b>Серия паспорта: </b>' + $dataadress.pasportser + '</div><div id="user-pasportnum"><b>Номер паспорта: </b>' + $dataadress.pasportnum + '</div><div id="user-pasportwhere"><b>Кем выдан: </b>' + $dataadress.pasportwhere + '</div><div id="user-pasportdate"><b>Когда выдан: </b>' + $dataadress.pasportdate + "</div></div>"
                        } else {
                            $innerdata = "Ошибка чтения из базы"
                        }
                    } else {
                        if (this["orders_id"] > 0) {
                            $status = '<div class="admin-order-status2">' + $statusarr[$dataorderinfo.orders_status] + "</div>";
                            $adress += '<div><div id="user-country"><b>Страна: </b>' + $dataadress.country + '</div><div id="user-state"><b>Область/регион: </b>' + $dataadress.state + '</div><div id="user-city"><b>Город: </b>' + $dataadress.city + '</div><div id="user-adress"><b>Адрес: </b>' + $dataadress.adress + '</div><div id="user-postcode"><b>Почтовый код: </b>' + $dataadress.postcode + '</div><div id="user-lastname"><b>Фамилия: </b>' + $dataadress.lastname + '</div><div id="user-name"><b>Имя: </b>' + $dataadress.name + '</div><div id="user-secondname"><b>Отчество: </b>' + $dataadress.secondname + '</div><div id="user-telephone"><b>Телефон: </b>' + $dataadress.telephone + '</div><div id="user-pasportser"><b>Серия паспорта: </b>' + $dataadress.pasportser + '</div><div id="user-pasportnum"><b>Номер паспорта: </b>' + $dataadress.pasportnum + '</div><div id="user-pasportwhere"><b>Кем выдан: </b>' + $dataadress.pasportwhere + '</div><div id="user-pasportdate"><b>Когда выдан: </b>' + $dataadress.pasportdate + "</div></div>";
                            $prod_content = "";
                            $resultprice = 0;
                            $resultcount = 0;
                            $resultcountpos = 0;
                            $oldresultprice = 0;
                            $oldresultcount = 0;
                            $oldresultcountpos = 0;
                            $resultpricewithdiscount = 0;
                            $resultpricewithdiscountolder = 0;
                            $.each($dataorderinfo.products, function (b) {
                                if (this.products_quantity == 0) {
                                    $raw_style = 'style="background: rgb(255, 92, 92) none repeat scroll 0% 0%;"';
                                    $prod_stat = "Нет в наличии!"
                                } else {
                                    if (this.products_quantity === this.first_quant) {
                                        $raw_style = 'style="background: #45B74A  none repeat scroll 0% 0%;"';
                                        $prod_stat = "Количество соответствует"
                                    } else {
                                        $raw_style = 'style="background: #ECE37F none repeat scroll 0% 0%;"';
                                        $prod_stat = "Количество измененно"
                                    }
                                }
                                $checkattr = this.orders_products_id;
                                $attr = "";
                                $snprice = 0;
                                $snpricehtml = "";
                                $.each($dataorderinfo.productsAttr, function () {
                                    if (this.orders_products_id == $checkattr) {
                                        $attr = this.products_options_values
                                    }
                                });
                                if ($attr != "") {
                                    $prod_atr = $attr
                                } else {
                                    $prod_atr = "Без размера"
                                }
                                $resultprice += (parseInt(this.products_quantity) * parseInt($dataorderinfo.products[b].products_price));
                                $oldresultprice += (parseInt(this.first_quant) * parseInt($dataorderinfo.products[b].products_price));
                                $resultcount += parseInt(this.products_quantity);
                                $oldresultcount += parseInt(this.first_quant);
                                $oldresultcountpos += 1;
                                if ($dataorderinfo.discount > 0) {
                                    $snprice = parseInt($dataorderinfo.products[b].products_price) + (parseInt($dataorderinfo.products[b].products_price) / 100 * parseInt($dataorderinfo.discount));
                                    $snpricehtml = '<div>С учетом наценки <font color="red">' + this.products_quantity + "x" + parseInt($snprice) + " Руб.</font></div>";
                                    $snpricehtmlin = '<p>С учетом наценки <font color="red">' + this.products_quantity * parseInt($snprice) + " Руб.</font></p>";
                                    $resultpricewithdiscount += (parseInt(this.products_quantity) * (parseInt($dataorderinfo.products[b].products_price) + (parseInt($dataorderinfo.products[b].products_price) / 100 * parseInt($dataorderinfo.discount))));
                                    $resultpricewithdiscountolder += (parseInt(this.first_quant) * (parseInt($dataorderinfo.products[b].products_price) + (parseInt($dataorderinfo.products[b].products_price) / 100 * parseInt($dataorderinfo.discount))))
                                } else {
                                    $resultpricewithdiscount += 0;
                                    $resultpricewithdiscountolder += 0;
                                    $snpricehtml = "";
                                    $snpricehtmlin = ""
                                }
                                if (parseInt(this.products_quantity) != 0) {
                                    $resultcountpos += 1
                                }
                                $prod_content += '<div class="row-prod"><div class="prod-content-raw" ' + $raw_style + '><div class="admin-orders-prodimg" style="float: left;  max-height: 100px; max-width: 180px; min-height: 100px; min-width: 180px;  background: #fff no-repeat scroll 50% 50% / contain url(http://odezhda-master.ru/images/' + $dataq[b][5] + ');"></div><div>' + $prod_stat + '</div></div><div class="colone"><div class="prod-content-count">' + this.products_quantity + "х" + this.products_name + '</div><div class="prod-content-attr">Размер: ' + $prod_atr + '</div></div><div  class="coltwo"><div class="prod-content-code">' + $dataorderinfo.products[b].products_model + '</div></div><div  class="colthree"><div class="prod-content-price">' + this.products_quantity + "х" + parseInt($dataorderinfo.products[b].products_price) + " Руб.</div>" + $snpricehtml + '</div><div class="prod-content-priceallraw">' + (parseInt(this.products_quantity) * parseInt($dataorderinfo.products[b].products_price)) + " Руб." + $snpricehtmlin + "</div></div>"
                            });
                            if ($resultpricewithdiscount > 0) {
                                $resultpricewithdiscounthtml = "<div>Результирующая наценка составила " + $dataorderinfo.discount + ' %</div><div> Стоимость для клиента с учетом наценки составила <font color="red">' + parseInt($resultpricewithdiscount) + " Руб.</font></div>";
                                $resultpricewithdiscountolderhtml = "<div>Результирующая наценка составила " + $dataorderinfo.discount + ' %</div><div> Стоимость для клиента с учетом наценки составила <font color="red">' + parseInt($resultpricewithdiscount) + " Руб.</font></div>"
                            } else {
                                $resultpricewithdiscounthtml = "";
                                $resultpricewithdiscountolderhtml = ""
                            }
                            $prod_content += '<div class="result-prod"><div class="old-prod-order"><div>Товаров в наличии: ' + $resultcount + " позиций: " + $resultcountpos + '</div><div><font color="red">Новая сумма товаров в заказе: ' + $resultprice + " Руб.</font></div>" + $resultpricewithdiscounthtml + '</div><div class="new-prod-order"><div>Товаров в заказе ' + $oldresultcount + " позиций: " + $oldresultcountpos + "</div><div>Сумма товаров в заказе: " + $oldresultprice + " Руб.</div>" + $resultpricewithdiscountolderhtml + "</div></div>";
                            $innerdata += '<div class="admin-order-om-wrap" style="height: 100%; width:100%"><div class="admin-order-om-show">' + $dataorderinfo.orders_id + '</div><div class="admin-order-om-adress">' + $dataorderinfo.delivery_country + ", " + $dataorderinfo.delivery_state + ", " + $dataorderinfo.delivery_city + ", " + $dataorderinfo.delivery_street_address + ", " + $dataorderinfo.delivery_postcode + '</div><div class="admin-order-om-name">' + $dataorderinfo.delivery_lastname + " " + $dataorderinfo.delivery_name + " " + $dataorderinfo.delivery_otchestvo + '</div><div class="admin-order-om-prod-container">' + $prod_content + "</div></div>"
                        } else {
                            $status = '<div class="admin-order-status3">Новый</div>';
                            $statusinner = '<i class="fa fa-truck admin-orders-navigation-control" data-toggle="tooltip" data-placement="top" title="Доставить в магазин" id="order-to-storage"></i><i id="order-to-user"  data-toggle="tooltip" data-placement="top" title="Доставить клиенту"  class="fa fa-user admin-orders-navigation-control"></i><i id="cancel-order" data-toggle="tooltip" data-placement="top" title="Отмена заказа" class="fa fa-close admin-orders-navigation-control"></i>'
                        }
                    }
                    $inner += '<div class="admin-orders-row"><div class="admin-orders-num">' + (($innercount++) + $page * 10) + '</div><div class="admin-orders-id">' + this["id"] + '</div><div class="admin-orders-name">' + $dataadress.lastname + " " + $dataadress.name + " " + $dataadress.secondname + '<br/>' + $useremail + '</div><div class="admin-orders-data-phantom"><div data-tog="' + $innercount + '" class="admin-orders-data  modal"><div style="padding: 10px; overflow: auto; background: rgb(251, 251, 251) none repeat scroll 0% 0%; box-shadow: 0px 0px 7px 1px rgb(180, 180, 180); height: 100%;"><div data-tog="' + $innercount + '" id="admclose">x</div>' + $innerdata + '</div></div></div><div data-toggle="' + $innercount + '" class="admin-orders-data-print"><a href="/site/printorders?id=' + this['id'] + '" target="blank"><i class="fa fa-print"></i></a></div><div class="admin-orders-adress-phantom"><div><div data-tog="' + $innercount + '" class="admin-order-adress modal"><div data-tog="' + $innercount + '" id="admclose">x</div>' + $adress + "</div></div></i></div>" + $status + '<div data-navorder="' + this["id"] + '" class="admin-orders-navigation">' + $statusinner + "</div></div>"
                }
            });
            $pager = "";
            $pager += ' <div data-page="" class="page orders nav-prev btn btn-default btn-sm" href="#"><i class="fa fa-chevron-left"><a href="#"></a></i></div> ';
            $pager += ' <div data-page="" class="page  orders nav-next  btn btn-default btn-sm" href="#"><i class="fa fa-chevron-right"><a href="#"></a></i></div> ';
            $(".bside").append('<div data-page-nav="' + $page + '">' + $inner + $pager + "</div>")
        }
    })
});
$(document).on("click", "#cancel-order", function () {
    $id = $(this).parent().siblings("div.admin-orders-id")[0].textContent;
    $(".accept").remove();
    $("html").append('<div class="modal accept"><div class="diax">Вы подтверждаете отмену заказа № ' + $id + ' ?<div></div><button class="button-accept-cancel btn btn-info btn-sm"  style="margin: 20px;" data-id="' + $id + '">да</button><button class="close-button-accept btn btn-danger btn-sm"  style="margin: 20px;">нет</button></div></div>');
    $(".accept").show()
});
$(document).on("click", "#order-to-storage", function () {
    $id = $(this).parent().siblings("div.admin-orders-id")[0].textContent;
    $self = 1;
    $where = "на адрес вашего магазина?";
    $(".accept").remove();
    $("html").append('<div class="modal accept"><div class="diax">Вы подтверждаете отправку заказа № ' + $id + " " + $where + '<div></div><button class="button-accept-delegate btn btn-info btn-sm"  style="margin: 20px;" data-id="' + $id + '" data-where="' + $self + '">да</button><button class="close-button-accept btn btn-danger btn-sm"  style="margin: 20px;">нет</button></div></div>');
    $(".accept").show()
});
$(document).on("click", "#order-to-user", function () {
    $id = $(this).parent().siblings("div.admin-orders-id")[0].textContent;
    $self = 0;
    $where = "на адрес вашего клиента?";
    $(".accept").remove();
    $("html").append('<div class="modal accept"><div class="diax">Вы подтверждаете отправку заказа № ' + $id + " " + $where + '<div></div><button class="button-accept-delegate btn btn-info btn-sm"  style="margin: 20px;" data-id="' + $id + '" data-where="' + $self + '">да</button><button class="close-button-accept btn btn-danger btn-sm"  style="margin: 20px;">нет</button></div></div>');
    $(".accept").show()
});
$(document).on("click", ".close-button-accept", function () {
    $(".accept").remove();
    $("input:checked").removeAttr("checked")
});
$(document).on("click", ".button-accept-delegate", function () {
    $id = this.getAttribute("data-id");
    $self = this.getAttribute("data-where");
    $("[data-navorder=" + $id + "]").html("Отправка");
    $(".accept").remove();
    $("input:checked").removeAttr("checked");
    $(this).html("Отправка заказа").addClass("admin-order-status2").removeClass("admin-order-status");
    $.ajax({
        type: "POST",
        async: true,
        url: "/admin/default/delegate",
        data: {id: $id, self: $self},
        cache: false,
        dataType: "json",
        complete: function (b, c, a) {
            $id = this.data.split("&")[0].split("=")[1];
            if (b.status === 200) {
                $("[data-navorder=" + $id + "]").html("Отправлено")
            } else {
                $("[data-navorder=" + $id + "]").html("Ошибка")
            }
        }
    })
});
$(document).on("click", ".button-accept-cancel", function () {
    $id = this.getAttribute("data-id");
    $(".accept").remove();
    $("input:checked").removeAttr("checked");
    $(this).html("Отправка заказа").addClass("admin-order-status2").removeClass("admin-order-status");
    $("[data-navorder=" + $id + "]").html("Отмена");
    $.ajax({
        type: "POST",
        url: "/admin/default/cancelorder",
        data: {id: $id},
        cache: false,
        async: true,
        dataType: "json",
        statuscode: {
            200: function () {
                $(".admin-order-status2").html("ОК")
            }, 404: function () {
                $(".admin-order-status2").html("Не доступно")
            }, 500: function () {
                $(".admin-order-status2").html("Ошибка обработки")
            }
        }
    })
});
function timeConverter(j) {
    var i = new Date(j * 1000);
    var h = i.getFullYear();
    var g = i.getMonth();
    var c = i.getDate();
    var d = i.getHours();
    var e = i.getMinutes();
    var f = i.getSeconds();
    var b = c + "-" + g + "-" + h + "   " + d + "." + e + "." + f;
    return b
}
$(document).on("click", "#admclose", function () {
    $cl = this.getAttribute("data-tog");
    $("[data-tog=" + $cl + "]").modal("hide")
});
$(document).on("click", ".news", function () {
    $.ajax({
        url: "/admin/default/requestnews",
        data: "",
        cache: false,
        async: true,
        dataType: "json",
        success: function (a) {
            $(".bside").html("");
            $inner = '<div class="admin-users-row"><div class="admin-news-num-header">№ п/п</div><div class="admin-news-name-header">Заголовок</div><div class="admin-news-date-added-header">Дата добавления</div><div class="admin-news-date-update-header">Дата обновления</div><div class="admin-news-tags-header">Теги</div><div class="admin-news-status-header">Статус</div><div class="admin-news-controls-header">Управление</div></div>';
            $innercount = "";
            $.each(a, function () {
                $inner += '<div class="admin-users-row"><div class="admin-users-num">' + ($innercount++) + '</div><div class="admin-users-name">' + this["username"] + '</div><div class="admin-users-mail">' + this["email"] + '</div><div class="admin-users-date-reg">' + timeConverter(this["created_at"]) + '</div><div class="admin-users-date-update">' + timeConverter(this["updated_at"]) + "</div></div>"
            });
            $(".bside").append($inner)
        }
    })
});