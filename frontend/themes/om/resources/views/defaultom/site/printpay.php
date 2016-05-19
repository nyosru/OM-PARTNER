<?php

$date_time = explode(" ", $order->info['date_purchased']);
$ymd = explode('-', $date_time[0]);
$aymd = explode('-', $order->info['date_akt']);

$info = '';
$trans = ["\\" => ''];
$fio = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
$tBody = '<TR>
    <th style="border: 1px solid black;">&#8470; п/п</th>
    <th style="border: 1px solid black;">Артикул</th>
    <th style="border: 1px solid black;">Наименование товара</th>
    <th style="border: 1px solid black;">Размер</th>
    <th style="border: 1px solid black;">Цена за единицу (Руб)</th>
    <th style="border: 1px solid black;">Количество</th>
    <th style="border: 1px solid black;">Стоимость (Руб.)*</th>
</TR>';
$summ2 = 0;
$summ = 0;
$string = 0;
foreach ($order->products as $i => $thePosition) {
//for ($i = 0; $i < count($order->products); $i++) {
if ((int)$thePosition['qty'] > 0) {
$attr = '';
if (isset($order->info['discount']) && $order->info['discount'] > 0) {
$thePosition['final_price'] = round($thePosition['final_price'] * (1 - ($order->info['discount'] / 100)));
}
if (count($thePosition['attributes']) > 0) {
foreach ($thePosition['attributes'] as $j => $theAttribute) {
$attr .= $theAttribute['value'];
}
}
if (!$order->akcia['discount']) {
$price = ceil($thePosition['final_price']);
} else {
$price = ceil($thePosition['final_price']) * (100 - $order->akcia['discount']) / 100;
}
$tBody .= '<TR>'
    . '<TD style="border: 1px solid black;">' . ($string + 1) . '</TD>'
    . '<TD align="center" style="border: 1px solid black;">' . $thePosition['model'] . '</TD>'
    . '<TD align="center" style="border: 1px solid black;">' . $thePosition['name'] . '</TD>'
    . '<TD align="center" style="border: 1px solid black;">' . ($attr ? $attr : '&nbsp;') . '</TD>'
    . '<TD align="center" style="border: 1px solid black;">' . round($thePosition['final_price']) . '</TD>'
    . '<TD align="center" style="border: 1px solid black;">' . (int)$thePosition['qty'] . '</TD>'
    . '<TD style="border: 1px solid black;text-align:center;">' . round($thePosition['final_price']) * (int)$thePosition['qty'] . '</TD>'
    . '</TR>' //
;
$summ += round($thePosition['final_price']) * (int)$thePosition['qty'];
$summ2 += round($thePosition['final_price'] * 10 / 11) * (int)$thePosition['qty'];
$string++;
}
}

if (!empty($order->partner)) {
$isset_regional = true;
$short_name = $order->partner['short_name'];
$full_name = $order->partner['full_name'];
$org_name = stripslashes($order->partner['org_name']);
$phone = $order->partner['phone'];
$email = $order->partner['email'];
} else {
$isset_regional = false;
$short_name = $order->provider['name'];
$full_name = $order->provider['name_full'];
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
    . '<TD style="border: 1px solid black;text-align:center;"><b>' . $summ . '</b></TD>'
    . '</TR>';

$result .= '<TABLE BORDER="0" CELLSPACING="2" width="100%">';
    if ($isset_regional) {
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
        . '<TD colspan="7" style="border-bottom: 1px solid black">' . $order->provider['address'] . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="7">&nbsp;</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">Образец заполнения платежного поручения</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="2" style="border: 1px solid black">ИНН ' . $order->provider['inn'] . '</TD>'
        . '<TD colspan="2" style="border: 1px solid black">КПП ' . $order->provider['kpp'] . '</TD>'
        . '<TD rowspan="2" style="border: 1px solid black" valign="bottom">Расч/сч. №</TD>'
        . '<TD colspan="2" rowspan="2" style="border: 1px solid black" valign="bottom">' . htmlspecialchars(stripslashes(trim($order->provider['banks']['rs']))) . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="4" style="border: 1px solid black">Получатель<br>' . $full_name . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD colspan="4" style="border: 1px solid black">Банк получателя<br>' . htmlspecialchars(stripslashes(trim($order->provider['banks']['adress']))) . '</TD>'
        . '<TD style="border: 1px solid black" valign="bottom">БИК<br>Кор/сч. №</TD>'
        . '<TD colspan="2" style="border: 1px solid black" valign="bottom">'
            . htmlspecialchars(stripslashes(trim($order->provider['banks']['bik']))) . '<br>' . htmlspecialchars(stripslashes(trim($order->provider['banks']['ks'])))
            . '</TD>'
        . '</TR>' //
    ;
    }
    $result .=
    '<TR>'
        . '<TD align="center" colspan="7">&nbsp;</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">Счет &#8470; ' . $order->info['new_id'] . ' от ' . $ymd['2'] . '.' . $ymd['1'] . '.' . $ymd['0'] . '</TD>'
        . '</TR>'
    . '<TR>'
        . '<TD align="center" colspan="7">&nbsp;</TD>'
        . '</TR>' //
    ;
    if (!$isset_regional) {
    $result .=
    '<TR><TD align="center" colspan="7">на основании Заявки/Заказа &#8470; ' . $order->info['new_id'] . ' от ' . $ymd['2'] . '.' . $ymd['1'] . '.' . $ymd['0'] . '</TD></TR>'
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
        . '<TD colspan="2" align="right">' . (!empty($order->partner) ? stripslashes($order->partner['org_name']) : $order->provider['name_full']) . '</TD>'
        . '<TD style="border-bottom: 1px solid black">&nbsp;</TD>'
        . '<TD colspan="4">&nbsp;</TD>'
        . '</TR>'
    . '</table>' //
;
echo $result;