<?php
$order = unserialize($data['order']);
$markup = $order['discount']; // наценка партнера на заказ
$discount = $order['discounttotalprice']; // скидка с заказа
$overall = $data['oMOrdersProducts'];
$i = 0;
foreach ($overall as $item) {
    $price = $item['finalprice'];
    $firstQuant = $item['first_quant'];
    $productsQuant = $item['products_quantity'];

}


echo '<pre>';
print_r($data);
echo '</pre>';