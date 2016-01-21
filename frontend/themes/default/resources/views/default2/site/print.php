<?
$id_zakaz = $data['id'];
$name_shop = Yii::$app->params['constantapp']['APP_NAME'];
$adress_shop = Yii::$app->params['partnersset']['contacts']['adress']['value'];
$phone_shop = Yii::$app->params['partnersset']['contacts']['telephone']['value'];
$email_shop = Yii::$app->params['partnersset']['contacts']['email']['value'];
$delivery = unserialize($data['delivery']);
$name_client = $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname;
$adress_client = $delivery->country . ', ' . $delivery->state . ', ' . $delivery->city . ', ' . $delivery->adress . ', ' . $delivery->postcode;
$phone_client = $delivery->telephone;
$email_client = $data['user']['username'];
$zakaz_date = $data['create_date'];
$order = unserialize($data['order']);
echo Yii::$app->params['partnersset']['logotype']['value'];
echo '<span>' . $adress_shop . '</span>';
?>


<table class="table table-bordered" width="100%">
    <tr>
        <td width="25%">Номер заказа:</td>
        <td width="25%"><?= $id_zakaz ?></td>
        <td width="25%">ФИО клиента:</td>
        <td width="25%"><?= $name_client ?></td>
    </tr>
    <tr>
        <td width="25%">Дата заказа:</td>
        <td width="25%"><?= $zakaz_date ?></td>
        <td width="25%">Адрес клиента:</td>
        <td width="25%"><?= $adress_client ?></td>
    </tr>
    <tr>
        <td width="25%">E-mail магазина:</td>
        <td width="25%"><?= $email_shop ?></td>
        <td width="25%">E-mail клиента:</td>
        <td width="25%"><?= $email_client ?></td>
    </tr>
    <tr>
        <td width="25%">Телефон магазина:</td>
        <td width="25%"><?= $phone_shop ?></td>
        <td width="25%">Телефон клиента:</td>
        <td width="25%"><?= $phone_client ?></td>
    </tr>
</table>
<?
$shipping = ['flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'], 'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'], 'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'], 'flat7_flat7' => ['value' => 'Почта ЕМС России']];
$shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
$inner = '';
$ship = $order['ship'];
$discount = $order['discount'];
$discounttotalprice = $order['discounttotalprice'];
unset($order['ship'], $order['discount'], $order['discounttotalprice'], $order['paymentmethod']);
$inner .= '<table class="table table-striped table-bordered table-hover table-responsive">';
$inner .= '<thead><tr>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">#</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Артикул</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Цена за шт</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Количество</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-3">Изображение</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Размер</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Описание</th>';
$inner .= '</tr></thead><tbody>';
$count = 0;
$countprod = 0;
$totalprice = 0;
$totalomquant = 0;
$totalomcount = 0;
$finalomprice = 0;
foreach ($order as $key => $value) {
    $positionquantity = $data['oMOrdersProducts'][$key]['products_quantity'] + $data['oMOrdersProductsSP'][$key]['products_quantity'] - $value[8]['count'];
    $price = round($value[3] - $value[3] / 100 * $discounttotalprice);
    $count++;
    $countprod += $value[4];
    $totalprice += (integer)$price * $value[4];
    if ($data['oMOrdersProducts']) {
        if ($positionquantity == 0 && isset($data['oMOrdersProducts'])) {
            $col = 'red';
        } elseif ($positionquantity == $value[4] && isset($data['oMOrdersProducts'])) {
            $col = 'green';
        } else {
            $col = 'yellow';
        }

    } else {
        $col = 'white';
    }
    $inner .= '<tr style="background: ' . $col . '">';
    $inner .= '<td class="col-md-1">' . $key . '</td>';
    $inner .= '<td class="col-md-2">' . $value[1] . '</td>';
    if ($data['oMOrdersProducts']) {
        $omfinalquant = '<br/>(В наличии: ' . $positionquantity . ')';
        if ($positionquantity > 0) {
            $totalomcount++;
            $totalomquant += (float)$positionquantity;
            $finalomprice += (float)$price * $positionquantity;
        }
    } else {
        $omfinalquant = '';
    }
    if ($value[6] == 'undefined') {
        $value[6] = 'Без размера';
    }
    $inner .= '<td class="col-md-2">' . (float)$price . ' Руб.</td>';
    $inner .= '<td class="col-md-1">' . $value[4] . $omfinalquant . '</td>';
    $inner .= '<td class="col-md-3"><img style="width: 50%;" src="' . BASEURL . '/imagepreview?src=' . $value[5] . '"/></td>';
    $inner .= '<td class="col-md-1">' . $value[6] . '</td>';
    $inner .= '<td class="col-md-1">' . $value[7] . '</td>';
    $inner .= '</tr>';
}
if ($totalomcount > 0) {
    $totalomcount = '<br/>(После сверки: ' . $totalomcount . ')';
    $finalomprice = '<br/>(После сверки: ' . $finalomprice . ')';

    $totalomquant = '<br/>(После сверки: ' . $totalomquant . ')';
} else {
    $totalomcount = '';
    $finalomprice = '';
    $totalomquant = '';
}
$inner .= '</tbody><tfooter>';
$inner .= '<tr>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Итого</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Позиций: ' . $count . ' шт' . $totalomcount . '</th>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-2">Товаров: ' . $countprod . ' шт' . $totalomquant . '</th>';
$inner .= '<th colspan="2" style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-3">Скидка: ' . (float)$discounttotalprice . '%</th>';
$inner .= '<th colspan="2" style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Стоимость заказа: ' . $totalprice . ' Руб.' . $finalomprice . '</th>';
$inner .= '</tr>';
$inner .= '<tr>';
$inner .= '<th style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">Доставка: </th>';
$inner .= '<th colspan="6" style="background: #FFBF08 none repeat scroll 0% 0%;" class="col-md-1">' . $shipping[$ship]['value'] . '</th>';
$inner .= '</tr>';
$inner .= '</tfooter></table>';
echo $inner;
    ?>


