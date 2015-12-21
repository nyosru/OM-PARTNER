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

if (Yii::$app->request->getQueryParam('action') == 'gen') {
    $runumber = new php_rutils\Numeral();
    $objPHPExcel = new \PHPExcel();
    $objPHPExcel = PHPExcel_IOFactory::load(__DIR__ . '/blank_schet.xls');
    $objPHPExcel->getProperties()->setCreator(YII::$app->params['partnersset']['APP_NAME']);
    $objPHPExcel->getProperties()->setLastModifiedBy(YII::$app->params['partnersset']['APP_NAME']);
    $objPHPExcel->getProperties()->setTitle('Счет. Заказ №' . $order['id']);
    $objPHPExcel->getProperties()->setSubject('Счет. Заказ №' . $order['id']);
    $objPHPExcel->getProperties()->setDescription('Счет. Заказ №' . $order['id']);
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->setActiveSheetIndex(0)->setTitle('Счет');
    $objPHPExcel->getActiveSheet()->SetCellValue('D8', Yii::$app->params['partnersset']['requisites']['value']['inn']);
    $objPHPExcel->getActiveSheet()->SetCellValue('M8', Yii::$app->params['partnersset']['requisites']['value']['kpp']);
    $delivery = unserialize($order['delivery']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B5', Yii::$app->params['partnersset']['requisites']['value']['bankname']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B9', Yii::$app->params['partnersset']['requisites']['value']['shortname'] . ', ' . Yii::$app->params['partnersset']['requisites']['value']['legaladdress']);
    $objPHPExcel->getActiveSheet()->SetCellValue('Y5', Yii::$app->params['partnersset']['requisites']['value']['bik']);
    $objPHPExcel->getActiveSheet()->SetCellValue('Y8', Yii::$app->params['partnersset']['requisites']['value']['rs']);
    $objPHPExcel->getActiveSheet()->SetCellValue('Y6', Yii::$app->params['partnersset']['requisites']['value']['ks']);
    $objPHPExcel->getActiveSheet()->SetCellValue('B13', 'Счет на оплату № ' . $order['id'] . '-' . $order['user_id'] . '-' . date('Ymd') . ' от ' . date('d-m-Y'));
    $objPHPExcel->getActiveSheet()->SetCellValue('F17', Yii::$app->params['partnersset']['requisites']['value']['shortname'] . ', ' . Yii::$app->params['partnersset']['requisites']['value']['legaladdress'] . ', ИНН: ' . Yii::$app->params['partnersset']['requisites']['value']['inn'] . ', БИК: ' . Yii::$app->params['partnersset']['requisites']['value']['bik'] . ', К/С: ' . Yii::$app->params['partnersset']['requisites']['value']['ks'] . ', Р/С: ' . Yii::$app->params['partnersset']['requisites']['value']['rs']);
    $objPHPExcel->getActiveSheet()->SetCellValue('F19', $delivery->lastname . ' ' . $delivery->name . ' ' . $delivery->secondname . ', ' . $delivery->country . ', ' . $delivery->state . ', ' . $delivery->adress . ', ' . $delivery->postcode);

    $ship = $order['ship'];
    $discount = $order['discount'];
    $discounttotalprice = $order['discounttotalprice'];
    $paymentmethod = $order['paymentmethod'];
    $orderset = unserialize($order['order']);
    unset($orderset['ship'], $orderset['discount'], $orderset['discounttotalprice'], $orderset['paymentmethod']);
    $start = 22;
    $offset = 0;
    $countprod = 0;
    $totalprice = 0;
    $totalomquant = 0;
    $totalomcount = 0;
    $finalomprice = 0;
    $omfinalprice = 0;
    foreach ($orderset as $key => $val) {
        $positionquantity = $order['oMOrdersProducts'][$key]['products_quantity'] + $order['oMOrdersProductsSP'][$key]['products_quantity'] - $val[8]['count'];
        if ($order['oMOrdersProducts'][$key]['products_quantity']) {
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
            $objPHPExcel->getActiveSheet()->mergeCells('B' . $rowpos . ':C' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowpos, ($offset + 1));

            $objPHPExcel->getActiveSheet()->mergeCells('D' . $rowpos . ':R' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowpos, $positiondatastring);
            $objPHPExcel->getActiveSheet()->getStyle('D' . $rowpos)->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->mergeCells('W' . $rowpos . ':Y' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowpos, 'шт.');

            $objPHPExcel->getActiveSheet()->mergeCells('S' . $rowpos . ':V' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowpos, $positionquantity);

            $objPHPExcel->getActiveSheet()->mergeCells('Z' . $rowpos . ':AE' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowpos, $price);

            $objPHPExcel->getActiveSheet()->mergeCells('AF' . $rowpos . ':AK' . $rowpos);
            $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $rowpos, $price * $positionquantity);
            $offset++;
        }
    }
    if ($finalomprice > 0) {
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 2), $finalomprice);
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 3), $finalomprice);
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 4), $finalomprice);
    } else {
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 2), $totalprice);
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 3), $totalprice);
        $objPHPExcel->getActiveSheet()->SetCellValue('AF' . ($rowpos + 4), $totalprice);
    }

    $objPHPExcel->getActiveSheet()->SetCellValue('B' . ($rowpos + 9), Yii::$app->params['partnersset']['requisites']['value']['chiefpost']);
    $objPHPExcel->getActiveSheet()->SetCellValue('K' . ($rowpos + 9), Yii::$app->params['partnersset']['requisites']['value']['chiefname']);
    $objPHPExcel->getActiveSheet()->SetCellValue('AE' . ($rowpos + 9), Yii::$app->params['partnersset']['requisites']['value']['glavbuh']);

    $objPHPExcel->getActiveSheet()->SetCellValue('I' . ($rowpos + 5), $runumber->getInWordsInt($count, \php_rutils\RUtils::NEUTER));

    $objPHPExcel->getActiveSheet()->setTitle('Счет');


    $objWr = new PHPExcel_Writer_Excel5($objPHPExcel);
    $path = Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id']);

    mkdir($path, 0777, true);
    $objWr->save(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/schetpc-' . $order['id'] . '.xls'));
    $objhtml = new PHPExcel_Writer_HTML($objPHPExcel);
    $objhtml->save(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/schetpc-' . $order['id'] . '.html'));
    echo file_get_contents(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/schetpc-' . $order['id'] . '.html'));

}
if (Yii::$app->request->getQueryParam('action') == 'load') {
    send_file(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/schetpc-' . $order['id'] . '.xls'));
}

if (Yii::$app->request->getQueryParam('action') == 'senduser') {
    if (isset(Yii::$app->params['partnersset']['contacts']['email']['value']) && Yii::$app->params['partnersset']['contacts']['email']['value'] != '') {
        $mailfrom = Yii::$app->params['partnersset']['contacts']['email'];
    } else {
        $mailfrom = 'support@' . $_SERVER['HTTP_HOST'];
    }

    Yii::$app->mailer->compose()
        ->attach(Yii::getAlias('@documents/' . $order['partners_id'] . '/' . $order['user_id'] . '/' . $order['id'] . '/schetpc-' . $order['id'] . '.xls'))
        ->setFrom($mailfrom)
        ->setTo($order['user']['email'])
        ->setSubject('Счет к заказу № ' . $order['id'])
        ->send();

}