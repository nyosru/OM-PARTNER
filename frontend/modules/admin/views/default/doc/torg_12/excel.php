<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 15.12.15
 * Time: 13:52
 */

$runumber = new php_rutils\Numeral();

$objPHPExcel = new \PHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load(__DIR__ . '/blank_t_12.xls');
$objPHPExcel->getProperties()->setCreator(YII::$app->params['partnersset']['APP_NAME']);
$objPHPExcel->getProperties()->setLastModifiedBy(YII::$app->params['partnersset']['APP_NAME']);
$objPHPExcel->getProperties()->setTitle('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->getProperties()->setSubject('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->getProperties()->setDescription('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Накладная ТОРГ-12');
$objPHPExcel->getActiveSheet()->SetCellValue('A7', Yii::$app->params['partnersset']['requisites']['value']['shortname'] . ', ' . Yii::$app->params['partnersset']['requisites']['value']['legaladdress'] . ', ИНН: ' . Yii::$app->params['partnersset']['requisites']['value']['inn'] . ', БИК: ' . Yii::$app->params['partnersset']['requisites']['value']['bik'] . ', К/С: ' . Yii::$app->params['partnersset']['requisites']['value']['ks'] . ', Р/С: ' . Yii::$app->params['partnersset']['requisites']['value']['rs']);
$delivery = unserialize($order['delivery']);
$objPHPExcel->getActiveSheet()->SetCellValue('L12', $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname . ', ' . $delivery->country . ', ' . $delivery->state . ', ' . $delivery->adress . ', ' . $delivery->postcode);
$objPHPExcel->getActiveSheet()->SetCellValue('I14', Yii::$app->params['partnersset']['requisites']['value']['shortname'] . ', ' . Yii::$app->params['partnersset']['requisites']['value']['legaladdress'] . ', ИНН: ' . Yii::$app->params['partnersset']['requisites']['value']['inn'] . ', БИК: ' . Yii::$app->params['partnersset']['requisites']['value']['bik'] . ', К/С: ' . Yii::$app->params['partnersset']['requisites']['value']['ks'] . ', Р/С: ' . Yii::$app->params['partnersset']['requisites']['value']['rs']);
$objPHPExcel->getActiveSheet()->SetCellValue('I16', $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname . ', ' . $delivery->country . ', ' . $delivery->state . ', ' . $delivery->adress . ', ' . $delivery->postcode);
$objPHPExcel->getActiveSheet()->SetCellValue('I18', 'Договор');
$objPHPExcel->getActiveSheet()->SetCellValue('AL26', $order['id'] . '-' . $order['user_id'] . '-' . date('Ymd'));
$objPHPExcel->getActiveSheet()->SetCellValue('BI26', date('d-m-Y'));
$objPHPExcel->getActiveSheet()->SetCellValue('CF12', Yii::$app->params['partnersset']['requisites']['value']['okpo']);
$ship = $order['ship'];
$discount = $order['discount'];
$discounttotalprice = $order['discounttotalprice'];
$paymentmethod = $order['paymentmethod'];
$orderset = unserialize($order['order']);
unset($orderset['ship'], $orderset['discount'], $orderset['discounttotalprice'], $orderset['paymentmethod']);
$start = 31;
$offset = 0;
$countprod = 0;
$totalprice = 0;
$totalomquant = 0;
$totalomcount = 0;
$finalomprice = 0;
$omfinalprice = 0;
foreach ($orderset as $key => $val) {
    $positionquantity = $order['oMOrdersProducts'][$key]['products_quantity'] + $order['oMOrdersProductsSP'][$key]['products_quantity'];
    $price = round($val[3] - $val[3] / 100 * $discounttotalprice);
    $count++;
    $countprod += $val[4];
    $totalprice += $price * $val[4];
    $rowpos = $start + $offset;
    if ($order['oMOrdersProducts']) {
        $ompriceprod = round($order['oMOrdersProducts'][$key]['products_price']);
        $omprice = $ompriceprod;
        $omfinalquant = $positionquantity;
        if ($positionquantity > 0) {
            $omfinalprice += ($ompriceprod * $positionquantity);
            $totalomcount++;
            $totalomquant += $positionquantity;
            $finalomprice += $price * $positionquantity;
        } else {

        }
    } else {
        $omprice = '';
        $omfinalquant = '';
    }
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($rowpos, 1);
    if ($val[6] != 'undefined') {
        $size = ' Размер: ' . $val[6];
    } else {
        $size = '';
    }
    if (!$positionquantity > 0) {
        $positionquantity = $val[4];
    }
    $positiondatastring = $val[7] . ' Артикул: ' . $val[1] . $size;
    $rowheight = mb_strlen($positiondatastring) / 2.5;
    $objPHPExcel->getActiveSheet()->getRowDimension($rowpos)->setRowHeight($rowheight);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowpos . ':C' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowpos, ($offset + 1));

    $objPHPExcel->getActiveSheet()->mergeCells('D' . $rowpos . ':S' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowpos, $positiondatastring);
    $objPHPExcel->getActiveSheet()->getStyle('D' . $rowpos)->getAlignment()->setWrapText(true);

    $objPHPExcel->getActiveSheet()->mergeCells('T' . $rowpos . ':W' . $rowpos);

    $objPHPExcel->getActiveSheet()->mergeCells('X' . $rowpos . ':AB' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowpos, 'шт.');

    $objPHPExcel->getActiveSheet()->mergeCells('AC' . $rowpos . ':AG' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $rowpos, '');

    $objPHPExcel->getActiveSheet()->mergeCells('AH' . $rowpos . ':AL' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $rowpos, '');

    $objPHPExcel->getActiveSheet()->mergeCells('AM' . $rowpos . ':AQ' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('AM' . $rowpos, '1');

    $objPHPExcel->getActiveSheet()->mergeCells('AR' . $rowpos . ':AV' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('AR' . $rowpos, $val[4]);

    $objPHPExcel->getActiveSheet()->mergeCells('AW' . $rowpos . ':BA' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('AW' . $rowpos, '');

    $objPHPExcel->getActiveSheet()->mergeCells('BB' . $rowpos . ':BG' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('BB' . $rowpos, $val[4]);

    $objPHPExcel->getActiveSheet()->mergeCells('BH' . $rowpos . ':BP' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('BH' . $rowpos, $val[3]);

    $objPHPExcel->getActiveSheet()->mergeCells('BQ' . $rowpos . ':BW' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . $rowpos, $val[3] * $val[4]);

    $objPHPExcel->getActiveSheet()->mergeCells('BX' . $rowpos . ':CA' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('BX' . $rowpos, '0');

    $objPHPExcel->getActiveSheet()->mergeCells('CB' . $rowpos . ':CH' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('CB' . $rowpos, '0');

    $objPHPExcel->getActiveSheet()->mergeCells('CI' . $rowpos . ':CQ' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . $rowpos, $val[3] * $val[4]);

    $offset++;
}
if ($finalomprice > 0) {
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 1), $finalomprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 2), $finalomprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . ($rowpos + 1), $finalomprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . ($rowpos + 2), $finalomprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($rowpos + 16), $runumber->getInWordsInt($finalomprice));
} else {
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 1), $totalprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 2), $totalprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . ($rowpos + 1), $totalprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . ($rowpos + 2), $totalprice);
    $objPHPExcel->getActiveSheet()->SetCellValue('N' . ($rowpos + 16), $runumber->getInWordsInt($totalprice));
}

$objPHPExcel->getActiveSheet()->SetCellValue('J' . ($rowpos + 20), Yii::$app->params['partnersset']['requisites']['value']['chiefpost']);
$objPHPExcel->getActiveSheet()->SetCellValue('AG' . ($rowpos + 20), Yii::$app->params['partnersset']['requisites']['value']['chiefname']);
$objPHPExcel->getActiveSheet()->SetCellValue('AG' . ($rowpos + 22), Yii::$app->params['partnersset']['requisites']['value']['glavbuh']);
$objPHPExcel->getActiveSheet()->SetCellValue('AG' . ($rowpos + 24), Yii::$app->params['partnersset']['requisites']['value']['chiefname']);


$objPHPExcel->getActiveSheet()->SetCellValue('AR' . ($rowpos + 1), $countprod);
$objPHPExcel->getActiveSheet()->SetCellValue('AR' . ($rowpos + 2), $countprod);
$objPHPExcel->getActiveSheet()->SetCellValue('BB' . ($rowpos + 1), $countprod);
$objPHPExcel->getActiveSheet()->SetCellValue('BB' . ($rowpos + 2), $countprod);
$objPHPExcel->getActiveSheet()->SetCellValue('O' . ($rowpos + 5), $runumber->getInWordsInt($count));
$objPHPExcel->getActiveSheet()->SetCellValue('K' . ($rowpos + 11), $runumber->getInWordsInt($count, \php_rutils\RUtils::NEUTER));
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('ТОРГ-12');


// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWr = new PHPExcel_Writer_Excel5($objPHPExcel);

$objWr->save('rt2.xls');

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";