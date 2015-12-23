<?php
/**
 * Created by PhpStorm.
 * User: dmitriy
 * Date: 15.12.15
 * Time: 13:52
 */
function send_file($filename)
{
    if (file_exists($filename)) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filename));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }
}

$taxrates = new \common\models\TaxRates();
$taxrates = $taxrates->find()->select('tax_class_id, tax_rate')->asArray()->all();
foreach ($taxrates as $key => $value) {
    $taxratesarray[$value['tax_class_id']] = $value['tax_rate'];
}
$manufacturerstax = [];


foreach ($order['oMOrdersProducts'] as $key => $value) {
    $manufacturerstax[] = $value['products_id'];
}
if (count($manufacturerstax) > 0) {
    $products = new \common\models\PartnersProducts();
    $products = $products->find()->select('products_id, manufacturers_id, products_tax_class_id')->where('products_id IN (' . implode(',', $manufacturerstax) . ')')->asArray()->all();
    $productsarr = [];
    foreach ($products as $key => $value) {
        $productsarr[$value['products_id']] = $value['manufacturers_id'];
        $productsarrtr[$value['products_id']] = $value['products_tax_class_id'];
    }
    $manufacturerstax = new \common\models\ManufacturersInfoList();
    $manufacturerstax = $manufacturerstax->find()->select('manufacturers_id , nds_proc')->where('manufacturers_id IN (' . implode(',', $productsarr) . ')')->asArray()->all();
    $manufacturerstaxarr = [];
    foreach ($manufacturerstax as $key => $value) {
        $manufacturerstaxarr[$value['manufacturers_id']] = $value['nds_proc'];
    }
    foreach ($productsarr as $key => $value) {
        $prodtax[$key]['to_man'] = $manufacturerstaxarr[$value];
        $prodtax[$key]['to_prod'] = $taxratesarray[$productsarrtr[$key]];
    }
}
if (Yii::$app->request->getQueryParam('action') == 'gen') {
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
    $orderset = unserialize($order['order']);
    $ship = $orderset ['ship'];
    $discount = $orderset ['discount'];
    $discounttotalprice = $orderset ['discounttotalprice'];
    $paymentmethod = $orderset ['paymentmethod'];
    unset($orderset['ship'], $orderset['discount'], $orderset['discounttotalprice'], $orderset['paymentmethod']);
    $start = 31;
    $offset = 0;
    $countprod = 0;
    $totalprice = 0;
    $totalomquant = 0;
    $totalomcount = 0;
    $finalomprice = 0;
    $omfinalprice = 0;
    $finalnonnds = 0.0;
    $finalsumnonnds = 0.0;
    foreach ($orderset as $key => $val) {
        $positionquantity = $order['oMOrdersProducts'][$key]['products_quantity'] + $order['oMOrdersProductsSP'][$key]['products_quantity'] - $val[8]['count'];
        if ($order['oMOrdersProducts'][$key]) {
        } else {
            $positionquantity = $val[4];
        }
        if ($positionquantity > 0) {
            $price = round($val[3] - $val[3] / 100 * $discounttotalprice);

            $count++;
            $countprod += $positionquantity;
            $totalprice += $price * $positionquantity;
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
            $objPHPExcel->getActiveSheet()->SetCellValue('AR' . $rowpos, $positionquantity);

            $objPHPExcel->getActiveSheet()->mergeCells('AW' . $rowpos . ':BA' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('AW' . $rowpos, '');

            $objPHPExcel->getActiveSheet()->mergeCells('BB' . $rowpos . ':BG' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('BB' . $rowpos, $positionquantity);

            $objPHPExcel->getActiveSheet()->mergeCells('BH' . $rowpos . ':BP' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('BH' . $rowpos, $price);
            if ($prodtax[$order['oMOrdersProducts'][$key]['products_id']]['to_prod']) {
                $nds = $prodtax[$order['oMOrdersProducts'][$key]['products_id']]['to_prod'];
            } else {
                $nds = $prodtax[$order['oMOrdersProducts'][$key]['products_id']]['to_man'];
            }
            if ($nds > 0) {
                $nondsprice = round(($price * $positionquantity) / (100 + (integer)$nds) * 100, 2);
                $finalnonnds += $nondsprice;
                $sumndsprice = round(($price * $positionquantity) - ($price * $positionquantity) / (100 + (integer)$nds) * 100, 2);
                $finalsumnonnds += $sumndsprice;
            } else {
                $nondsprice = $price * $positionquantity;
                $finalnonnds += $nondsprice;
                $sumndsprice = 0.00;
                $finalsumnonnds += $sumndsprice;
                $nds = 0;
            }

            $objPHPExcel->getActiveSheet()->mergeCells('BQ' . $rowpos . ':BW' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . $rowpos, $nondsprice);



            $objPHPExcel->getActiveSheet()->mergeCells('BX' . $rowpos . ':CA' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('BX' . $rowpos, $nds);

            $objPHPExcel->getActiveSheet()->mergeCells('CB' . $rowpos . ':CH' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('CB' . $rowpos, $sumndsprice);

            $objPHPExcel->getActiveSheet()->mergeCells('CI' . $rowpos . ':CQ' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('CI' . $rowpos, $price * $positionquantity);

            $offset++;
        }
    }
    if ($finalomprice > 0) {
        $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 1), $finalnonnds);
        $objPHPExcel->getActiveSheet()->SetCellValue('BQ' . ($rowpos + 2), $finalnonnds);
        $objPHPExcel->getActiveSheet()->SetCellValue('CB' . ($rowpos + 1), $sumndsprice);
        $objPHPExcel->getActiveSheet()->SetCellValue('CB' . ($rowpos + 2), $sumndsprice);
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


    $objWr = new PHPExcel_Writer_Excel5($objPHPExcel);
    $path = Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id']);

    if (!file_exists($path)) {
    mkdir($path, 0777, true);
    }
    $objWr->save(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.xls'));
    $objhtml = new PHPExcel_Writer_HTML($objPHPExcel);
    $objhtml->save(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.html'));

    echo file_get_contents(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.html'));

}

if (Yii::$app->request->getQueryParam('action') == 'load') {
    send_file(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.xls'));
}
if (Yii::$app->request->getQueryParam('action') == 'senduser') {
    if (isset(Yii::$app->params['partnersset']['contacts']['email']['value']) && Yii::$app->params['partnersset']['contacts']['email']['value'] != '') {
        $mailfrom = Yii::$app->params['partnersset']['contacts']['email']['value'];
    } else {
        $mailfrom = 'support@' . $_SERVER['HTTP_HOST'];
    }

    Yii::$app->mailer->compose()
        ->attach(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.xls'))
        ->setFrom($mailfrom)
        ->setTo($order['user']['email'])
        ->setSubject('Торг-12 заказу № ' . $order['id'])
        ->send();

}
if (Yii::$app->request->getQueryParam('action') == 'sendself') {
    if (isset(Yii::$app->params['partnersset']['contacts']['email']['value']) && Yii::$app->params['partnersset']['contacts']['email']['value'] != '') {
        $mailfrom = Yii::$app->params['partnersset']['contacts']['email']['value'];
    } else {
        $mailfrom = 'support@' . $_SERVER['HTTP_HOST'];
    }

    Yii::$app->mailer->compose()
        ->attach(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/torg12pc-' . $order['id'] . '.xls'))
        ->setFrom($mailfrom)
        ->setTo($mailfrom)
        ->setSubject('Торг-12 заказу № ' . $order['id'])
        ->send();

}