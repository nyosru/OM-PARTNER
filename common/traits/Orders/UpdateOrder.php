<?php
namespace common\traits\Orders;

use common\models\PartnersOrders;

class UpdateOrder
{
    /**
     * @param PartnersOrders $order
     * @param array $client_order_products
     * @return PartnersOrders
     */
    public function updateOrderWithClientProducts(PartnersOrders $order, $client_order_products = [])
    {

        $un_order = unserialize($order->order);
        $forunset = $client_order_products;
        foreach ($un_order['products'] as $key_back => &$product_back) {
            foreach ($client_order_products as $key_client => $product_client) {
                if ($product_back[0] == $product_client[0] && $product_back[2] == $product_client[2]) {
                    $un_order['products'][$key_back][4] = ((int)$product_client[4] >= 0) ? $product_client[4] : 0;
                    unset($forunset[$key_client]);
                }
            }
        }
        $products_after_deleting = array_filter($un_order['products'],
            function ($element) use ($client_order_products) {
                return in_array($element, $client_order_products);
            });
        if($forunset){
            foreach ($forunset as $key=>$val){
                $products_after_deleting[] = $val;
            }
        }
        $un_order['products'] = $products_after_deleting;

        $un_order['products'] = array_values($un_order['products']);

        $order->order = serialize($un_order);

        return $order;
    }
}