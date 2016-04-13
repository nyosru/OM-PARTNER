<?php

$paramset = Yii::$app->params['partnersset'];
$activegate=$paramset['paymentgate']['value']['activegate'];
echo '<pre>';
echo 'Общая сумма заказа равна '.$totalcost.'<br>';

echo '</pre>';
if ($paramset['paymentgate']['active']==1) {
    switch ($activegate) {
        case 'robokassa':
            $rk_login=$paramset['paymentgate']['value']['robokassa']['value']['login'];
            $rk_pass1=$paramset['paymentgate']['value']['robokassa']['value']['password1'];
            $rk_pass2=$paramset['paymentgate']['value']['robokassa']['value']['password2'];
            break;
        case 'rbkmoney':
            $rbk_login=$paramset['paymentgate']['value']['rbkmoney']['value']['login'];
            $rbk_eshopid=$paramset['paymentgate']['value']['rbkmoney']['value']['eshopId'];
            $rbk_keyword=$paramset['paymentgate']['value']['rbkmoney']['value']['keyword'];
            break;
        case 'payonline':
            $payon_merchid=$paramset['paymentgate']['value']['payonline']['value']['merchantid'];
            $payon_psk=$paramset['paymentgate']['value']['payonline']['value']['privatesecurekey'];
            break;
        case 'payanyway':
            $paw_merchid=$paramset['paymentgate']['value']['payanyway']['value']['merchantid'];
            break;
        case 'dengionline':
            $do_projid=$paramset['paymentgate']['value']['dengionline']['value']['projectid'];
            $do_psk=$paramset['paymentgate']['value']['dengionline']['value']['privatesecurekey'];
            $do_mode=$paramset['paymentgate']['value']['dengionline']['value']['modetype'];
            break;
        case 'walletone':
            $wal_merchid=$paramset['paymentgate']['value']['walletone']['value']['merchantid'];
            $wal_psk=$paramset['paymentgate']['value']['walletone']['value']['privatesecurekey'];
            break;
        case 'payu':
            $payu_merchid=$paramset['paymentgate']['value']['payu']['value']['merchantid'];
            $payu_psk=$paramset['paymentgate']['value']['payu']['value']['privatesecurekey'];
            break;
        case 'pay2pay':
            $p2p_merchid=$paramset['paymentgate']['value']['pay2pay']['value']['merchantid'];
            $p2p_psk=$paramset['paymentgate']['value']['pay2pay']['value']['privatesecurekey'];
            break;
        case 'interkassa':
            $ik_merchid=$paramset['paymentgate']['value']['interkassa']['value']['merchantid'];
            $ik_psk=$paramset['paymentgate']['value']['interkassa']['value']['privatesecurekey'];
            break;
        case 'zpayment':
            $z_merchid=$paramset['paymentgate']['value']['zpayment']['value']['merchantid'];
            $z_psk=$paramset['paymentgate']['value']['zpayment']['value']['privatesecurekey'];
            break;
        default:
            echo 'Произошла ошибка при оплате';
    }
}
else echo 'Извините, автоматическая оплата отключена';