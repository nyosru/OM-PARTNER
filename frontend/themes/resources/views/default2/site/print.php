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
$email_client = $user;
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
$totalcountorder = 0;
$totalpositionorder = 0;
$totalpriceorder = 0;
$innerdata = '';
$discount = $order['discounttotalprice'];
$discountd = $order['discount'];
$ship = $order['ship'];
unset($order['ship']);
unset($order['discount']);
unset($order['discounttotalprice']); ?>
<table class="table table-bordered" width="100%">
    <tr>
        <td>№</td>
        <td>Артикул, наименование</td>
        <td>Размер,количество</td>
        <td>Цена</td>
    </tr><?
    foreach ($order as $key => $value) {
        if ($value[7] == 'undefined' || $value[7] == '') {
            $prodname = 'Не указанно';
        } else {
            $prodname = $value[7];
        }
        if ($value[6] == 'undefined' || $value[6] == '') {
            $size = 'Без размера';
        } else {
            $size = $value[6];
        }
        $totalcountorder = $totalcountorder + intval($value[4]);
        $totalpositionorder = $totalpositionorder + 1;
        $totalpriceorder = $totalpriceorder + intval($value[3]) * intval($value[4]);
        $innerdata .= '<tr><td class="">' . ($key + 1) . '</td><td class="" style="width:25%;"><div>Артикул: ' . $value[1] . '</div><div>Наименование: ' . $prodname . '</div></td><td class="" style=" width:25%;">' . $size . ' x ' . $value[4] . '</td><td class="" ><div>Цена за штуку: ' . intval($value[3]) . ' Руб.</div><div>Цена позиции: ' . intval($value[3]) * intval($value[4]) . ' Руб.</div></td></tr>';
    }
    $innerdata .= '<table class="table table-bordered"><tr><td class="">Итого: </td><td class="">Позиций: ' . $totalpositionorder . '</td><td class="">Товаров: ' . $totalcountorder . '</td><td class="">Сумма заказа: ' . $totalpriceorder . ' Руб.</td></tr>';
    if ($discount > 0) {
        $totalpriceorder = intval($totalpriceorder - $totalpriceorder / 100 * $discount);
        $innerdata .= '<tr  class=""><td class="">Ваша скидка: ' .
            $discount . '%</td><td class="" colspan="3">Сумма заказа c учетом скидки: ' .
            $totalpriceorder . ' Руб.</td></tr>';

    }
    $innerdata .= '</table>';
    echo $innerdata;


    ?>
</table>

