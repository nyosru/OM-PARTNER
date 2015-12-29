<?php
$order = unserialize($data['order']);
$markup = $order['discount']; // наценка партнера на заказ
$discount = $order['discounttotalprice']; // скидка с заказа
$overall = $data['oMOrdersProducts'];
$sp_ids=[]; // массив с oMOrdersProductsSP id=>количество
foreach ($data['oMOrdersProductsSP'] as $item){
    $sp_ids[$item['orders_products_id']]=$item['products_quantity'];
}
$orderRev=[]; // массив с возвратами id продукта=>количество
foreach($order as $item){
    $orderRev[$item['0']]=$item['8']['count'];
}

$totalCost=0;
foreach ($overall as $item) {
    $price = $item['final_price'];
    $firstQuant = $item['first_quant'];
    $productsQuant = $item['products_quantity'];
    $spQuantity=$sp_ids[$item['orders_products_id']];
    $reverce=$orderRev[$item['products_id']];
    $quantity=$productsQuant+$spQuantity-$reverce;
    if($firstQuant<$quantity){
        $quantity=$firstQuant;
    }
    $totalPrice=($price*(1+$markup/100))*(1-$discount/100);
    $cost=$totalPrice*$quantity;
    $totalCost+=$cost;
}


echo '<pre>';
echo $totalCost;
print_r($sp_ids);
print_r($orderRev);
echo 'testtest';
print_r($order);
echo 'testtest';
print_r($data);
echo '</pre>';