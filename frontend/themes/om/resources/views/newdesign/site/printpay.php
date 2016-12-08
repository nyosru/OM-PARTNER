<?php


$tBody = '<TR>
    <th style="border: 1px solid black;">&#8470; п/п</th>
    <th style="border: 1px solid black;">Артикул</th>
    <th style="border: 1px solid black;">Наименование товара</th>
    <th style="border: 1px solid black;">Размер</th>
    <th style="border: 1px solid black;">Цена за единицу (Руб)</th>
    <th style="border: 1px solid black;">Количество</th>
    <th style="border: 1px solid black;">Стоимость (Руб.)*</th>
</TR>';
$shipping = [
    'flat2_flat2' => ['value' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция'],
    'flat1_flat1' => ['value' => 'Бесплатная доставка до ТК Деловые Линии'],
    'flat3_flat3' => ['value' => 'Бесплатная доставка до ТК ПЭК'],
    'flat7_flat7' => ['value' => 'Почта ЕМС России'],
    'flat11_flat11' => ['value'=>'Бесплатная доставка до ТК КИТ'],
    'flat10_flat10' => ['value'=>'Бесплатная доставка до ТК ОПТИМА'],
    'flat9_flat9' => ['value'=>'Бесплатная доставка до ТК Севертранс'],
    'flat12_flat12' => ['value'=>'Бесплатная доставка до ТК ЭНЕРГИЯ'],
    'russianpostpf_russianpostpf'=> ['value'=>'Почта России - http://pochta.ru/']
];
$shipping = array_merge($shipping, Yii::$app->params['partnersset']['transport']['value']);
$inner ='';
$ship = $order['shipping_module'];
$orig_products = \yii\helpers\ArrayHelper::index($order['products'], 'orders_products_id');
$attr = \yii\helpers\ArrayHelper::index($order['productsAttr'], 'orders_products_id');
$sp  = \yii\helpers\ArrayHelper::index($order['productsSP'], 'orders_products_id');
$string = 1;
$date_time = explode(" ", $order['date_purchased']);
$ymd = explode('-', $date_time[0]);
$aymd = explode('-', $order->info['date_akt']);
foreach ($orig_products as $key => $value) {
    $positionquantity =  min($value['first_quant'],((int)$value['products_quantity'] + (int)$sp[$key]['products_quantity']));
    $price = round($value['final_price']);
    $count++;
    $countprod += (int)$value['first_quant'];
    $firstcountprod = $value['first_quant'];
    if ($positionquantity > 0) {
        $totalomcount++;
        $totalomquant += (int)$positionquantity;
        $finalomprice += (float)$price * (int)$positionquantity;
        $omfirstprice += (float)$price * (int)$firstcountprod;
        $tBody .= '<TR>'
            . '<TD style="border: 1px solid black;">' . ($string++) . '</TD>'
            . '<TD align="center" style="border: 1px solid black;">' . $value['products_model'] . '</TD>'
            . '<TD align="center" style="border: 1px solid black;">' . $value['products_name'] . '</TD>'
            . '<TD align="center" style="border: 1px solid black;">' . $attr[$value['orders_products_id']]['products_options_values'] . '</TD>'
            . '<TD align="center" style="border: 1px solid black;">' . (float)$price . '</TD>'
            . '<TD align="center" style="border: 1px solid black;">' . (int)$positionquantity . '</TD>'
            . '<TD style="border: 1px solid black;text-align:center;">' . (float)$price *  (int)$positionquantity  . '</TD>'
            . '</TR>' //
        ;
    }

}

if ($partner['type'] == 'partner') {
$short_name = $partner['partner']['lname']. mb_substr($partner['partner']['fname'],0,1). mb_substr($partner['partner']['oname'],0,1);
$full_name = $partner['partner']['lname'].' '. $partner['partner']['fname'].' '. $partner['partner']['partnersCompanies']['oname'] ;
$org_name = stripslashes($partner['partner']['organization_name']);
$phone = $partner['partner']['telephone'];
$email = $partner['partner']['email'];
} else {
$short_name = $partner['partner']['name'];
$full_name = $partner['partner']['name_full'];
}
if ($meta) {
$result =
'<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN"><html dir="LTR" lang="ru">'
. '<head>'
    . '<title>Женская одежда оптом в Москве, мелкий опт: мужская одежда, детская, модная. Джинсы, юбка, брюки оптом в Москве от производителя.</title>'
    . '<link rel="shortcut icon" href="favicon.ico" >'
    . '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">'
    . '<base href="http://odezhda-master.ru/">'
    . '<meta name="Description" Content="Продажа женской одежды, мужской оптом в Москве. Одежда больших размеров мелким оптом. Оптовая продажа: брюки, джинсы, юбка, капри. Детская одежда от производителя, молодежная одежда модная со склада в Москве.">'
    . '<meta name="Keywords" CONTENT="женская одежда оптом в Москве, купить одежду мужскую оптом, юбки оптом брюки, склад одежды оптом мелким, опт мужская одежда модная, джинсы опт блузки, детская одежда опт, верхняя одежда больших размеров, сток одежда опт в Москве">'
    . '<meta name="Reply-to" CONTENT="odezhdamaster@gmail.com">
</head>' //
;
} else {
$result = '';
}

$tBody .=
'<TR>'
    . '<TD style="border: 1px solid black;" COLSPAN="6"><b>Итого**:</b></TD>'
    . '<TD style="border: 1px solid black;text-align:center;"><b>' . $finalomprice . '</b></TD>'
    . '</TR>';

$result .= '<TABLE BORDER="0" CELLSPACING="2" width="100%">';
    if ($partner['type'] == 'partner') {
    $result .=
    '<TR>'
        . '<TD colspan="7">'
            . 'Ваш региональный менеджер <span style="text-decoration: underline">' . $org_name . '</span>.<br>'
            . 'Для уточнения реквизитов на оплату Вам нужно связаться с ним по телефону: ' . $phone . (!empty($email) ? ' или по электронной почте:&nbsp;<a href="mailto:' . $email . '">' . $email . '</a>' : '') . '<br>'
            . '<span style="color:#ff0000;">Обязательно перед оплатой счета не забывайте проконсультироваться, т.к. <b>реквизиты на оплату МОГУТ ИЗМЕНИТЬСЯ!</b></span><br>'
            . '</TD>'
        . '</TR>' //
    ;
    } else {
    $result .=
    '<TR>'
        . '<TD colspan="7">' . $full_name . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="7" style="border-bottom: 1px solid black">' . $partner['partner']['address'] . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="7">&nbsp;</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">Образец заполнения платежного поручения</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="2" style="border: 1px solid black">ИНН ' . $partner['partner']['inn'] . '</TD>'
        . '<TD colspan="2" style="border: 1px solid black">КПП ' . $partner['partner']['kpp'] . '</TD>'
        . '<TD rowspan="2" style="border: 1px solid black" valign="bottom">Расч/сч. №</TD>'
        . '<TD colspan="2" rowspan="2" style="border: 1px solid black" valign="bottom">' . htmlspecialchars(stripslashes(trim($order['ordersBanks']['rs']))) . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="4" style="border: 1px solid black">Получатель<br>' . $full_name . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="4" style="border: 1px solid black">Банк получателя<br>' . htmlspecialchars(stripslashes(trim($order['ordersBanks']['adress']))) . '</TD>'
        . '<TD style="border: 1px solid black" valign="bottom">БИК<br>Кор/сч. №</TD>'
        . '<TD colspan="2" style="border: 1px solid black" valign="bottom">'
            . htmlspecialchars(stripslashes(trim($order['ordersBanks']['bik']))) . '<br>' . htmlspecialchars(stripslashes(trim($order['ordersBanks']['ks'])))
            . '</TD>'
        . '</TR>' //
    ;
    }
    $result .=
    '<TR>'
        . '<TD align="center" colspan="7">&nbsp;</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">Счет &#8470; ' . $ordernum . ' от ' . $ymd['2'] . '.' . $ymd['1'] . '.' . $ymd['0'] . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">&nbsp;</TD>'
        . '</TR>' //
    ;
    if ($partner['type'] != 'partner') {
    $result .=
    '<TR><TD align="center" colspan="7">на основании Заявки/Заказа &#8470; ' . $ordernum. ' от ' . $ymd['2'] . '.' . $ymd['1'] . '.' . $ymd['0'] . '</TD></TR>'
    . '<TR><TD align="center" colspan="7">&nbsp;</TD></TR>' //
    ;
    }
    $result .=
    '<TR>'
        . '<TD align="right" colspan="2">Плательщик (Комитент):</TD>'
        . '<TD style="border-bottom: 1px solid black" align="center" colspan="5">' . $fio . '</TD>'
        . '</TR><TR>'
        . '<TD align="right" colspan="2">&nbsp;</TD>'
        . '<TD align="center" colspan="5">(ФИО)</TD>'
        . '</TR>'
    . '<tr><td colspan="7">&nbsp;</td></tr>'
    . $tBody
    . '<TR>'
        . '<TD colspan="7">* НДС не облагается  в соответствии с  п.2 ст.346.11 НК РФ.</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="7">** С учетом комиссионного вознаграждения</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="7">&nbsp;</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="2" align="right">' . ($partner['type'] == 'partner' ? stripslashes($partner['partner']['organization_name']) : $partner['partner']['name_full']) . '</TD>'
        . '<TD style="border-bottom: 1px solid black">&nbsp;</TD>'
        . '<TD colspan="4">&nbsp;</TD>'
        . '</TR>'
    . '</table>' //
;
echo $result;