<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 15.12.15
 * Time: 13:52
 */
use kartik\export\ExportColumnAsset;
use kartik\grid\GridView;


$objPHPExcel = new \PHPExcel();
$objPHPExcel = PHPExcel_IOFactory::load("blank_t_12.xls");
$objPHPExcel->getProperties()->setCreator(YII::$app->params['partnersset']['APP_NAME']);
$objPHPExcel->getProperties()->setLastModifiedBy(YII::$app->params['partnersset']['APP_NAME']);
$objPHPExcel->getProperties()->setTitle('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->getProperties()->setSubject('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->getProperties()->setDescription('ТОРГ-12. Заказ №' . $order['id']);
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Накладная ТОРГ-12');
$objPHPExcel->getActiveSheet()->SetCellValue('A7', 'Отправитель');
$delivery = unserialize($order['delivery']);
$objPHPExcel->getActiveSheet()->SetCellValue('L12', $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname . ', ' . $delivery->country . ', ' . $delivery->state . ', ' . $delivery->adress . ', ' . $delivery->postcode);
$objPHPExcel->getActiveSheet()->SetCellValue('I14', 'Поставщик');
$objPHPExcel->getActiveSheet()->SetCellValue('I16', $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname . ', ' . $delivery->country . ', ' . $delivery->state . ', ' . $delivery->adress . ', ' . $delivery->postcode);
$objPHPExcel->getActiveSheet()->SetCellValue('I18', 'Договор');
$objPHPExcel->getActiveSheet()->SetCellValue('CF10', 'Форма по ОКДП');
$objPHPExcel->getActiveSheet()->SetCellValue('CF12', 'Форма по ОКПО1');
$objPHPExcel->getActiveSheet()->SetCellValue('CF13', 'Форма по ОКПО2');
$objPHPExcel->getActiveSheet()->SetCellValue('CF15', 'Форма по ОКПО3');
$objPHPExcel->getActiveSheet()->SetCellValue('CF17', 'ТН-Номер');
$objPHPExcel->getActiveSheet()->SetCellValue('CF19', 'ТН-Дата');
$objPHPExcel->getActiveSheet()->SetCellValue('CF21', 'ТН-Номер2');
$objPHPExcel->getActiveSheet()->SetCellValue('CF22', 'ТН-дата2');
$objPHPExcel->getActiveSheet()->SetCellValue('CF23', 'Вид операции');
$objPHPExcel->getActiveSheet()->SetCellValue('AL26', $order['id'] . '-' . $order['user_id'] . '-' . date('Ymd'));
$objPHPExcel->getActiveSheet()->SetCellValue('BI26', date('Y-m-d'));
$objPHPExcel->getActiveSheet()->SetCellValue('O66', 'Содержит записей');
$ship = $order['ship'];
$discount = $order['discount'];
$discounttotalprice = $order['discounttotalprice'];
$paymentmethod = $order['paymentmethod'];
$orderset = unserialize($order['order']);
unset($orderset['ship'], $orderset['discount'], $orderset['discounttotalprice'], $orderset['paymentmethod']);
$start = 31;
$offset = 0;
foreach ($orderset as $key => $val) {
    $rowpos = $start + $offset;
    $objPHPExcel->getActiveSheet()->insertNewRowBefore($rowpos, 1);
    $objPHPExcel->getActiveSheet()->getRowDimension($rowpos + 1)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowpos . ':C' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowpos, ($offset + 1));

    $objPHPExcel->getActiveSheet()->mergeCells('D' . $rowpos . ':S' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowpos, $val[7] . PHP_EOL . 'Артикул: ' . $val[1]);

    $objPHPExcel->getActiveSheet()->mergeCells('T' . $rowpos . ':W' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowpos, $val[1]);

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
    $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . $rowpos, $val[3]);

    $objPHPExcel->getActiveSheet()->mergeCells('BX' . $rowpos . ':CA' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('BX' . $rowpos, '0');

    $objPHPExcel->getActiveSheet()->mergeCells('CB' . $rowpos . ':CH' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('CB' . $rowpos, '0');

    $objPHPExcel->getActiveSheet()->mergeCells('CI' . $rowpos . ':CQ' . $rowpos);
    $objPHPExcel->getActiveSheet()->SetCellValue('CI' . $rowpos, $val[3]);

    $offset++;
}


//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Simple');

// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

$objWriter->save('rt.xslx');

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";