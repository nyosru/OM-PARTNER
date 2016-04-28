<?php
namespace frontend\controllers\actions;

use common\models\Customers;
use common\models\OrdersToPartners;
use common\models\PartnersCategories;
use common\models\PartnersProducts;
use common\models\PartnersToRegion;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

trait ActionTestUnit
{
    public function actionTestunit()
    {
        
       if(Yii::$app->user->can('admin')){
           if (($check = OrdersToPartners::find()->where(['order_id' => 571110])->one()) == FALSE) {

               if (($region_partners = PartnersToRegion::find()->joinWith('partnersCompanies')->where(['region_id' => 185])->andWhere('active > 0')->asArray()->all()) == TRUE) {
                   $partners = [];
                   $last_partner_id = 0;
                   foreach ($region_partners as $key_region => $value_region){
                       $last_partner_id = $value_region['partner_id'];
                       $partners[$last_partner_id]['name'] = $value_region['partnersCompanies']['short_name'];
                       $partners[$last_partner_id]['parent_ids'][] = (int)$value_region['parent_companies_id'];
                       $partners[$last_partner_id]['default_region'] = $value_region['partnersCompanies']['default_region'];
                       $partners[$last_partner_id]['active_after'] = (int)$value_region['partnersCompanies']['active_after'];
                       $partners[$last_partner_id]['num_of_region'] = (int)$value_region['partnersCompanies']['num_of_region'];
                       $partners[$last_partner_id]['min_raiting'] = (int)$value_region['partnersCompanies']['min_raiting'];
                       $partners[$last_partner_id]['support_black_list'] = ((int)$value_region['partnersCompanies']['support_black_list']) > 0 ? true : false;
                       unset($partner);
                   }
                   $region_id = 0;
                   // если найден один партнер
                   if (count($partners) === 1) {
                       // если партнер обслуживает заказы поставщика customers.default_provider
                       if (in_array((int)1, $partners[$last_partner_id]['parent_ids'])) {
                           $region_id = $partners[$last_partner_id]['default_region'];
                       }
                   } else if (count($partners) > 1) {
                       // Если партнеров несколько, то выбираем того партнера, который обслуживает заказы customers.default_provider
                       foreach ($partners as $pid => $info) {
                           // если партнер обслуживает заказы customers.default_provider
                           if (in_array((int)1, $info['parent_ids'])) {
                               $region_id = $info['default_region'];
                               $last_partner_id = (int)$pid;
                           }
                           unset($info);
                       }
                   }

                   if ($region_id != 0) {
                       // проверяем: когда был сделан заказ и когда был создан партнер, если заказ был создан после создания партнера и на момент создания заказа клиент оплатил более min_raiting заказов, а так же не находится в ЧС, то пытаемся переключить заказ на регионала
                       $in_black_list = $partners[$last_partner_id]['support_black_list'] ? false : in_array(customerGroupID($orders->customers_id), [3]);
                       if ((int)$orders->date_purchased >= $partners[$last_partner_id]['active_after'] && customerRating($orders->customers_id, $orders->date_purchased) >= $partners[$last_partner_id]['min_raiting'] && !$in_black_list) {
                           $response['partner_id'] = $last_partner_id;
                           $response['company_name'] = $partners[$last_partner_id]['name'];
                           $last_insert_id = lastPartnerOrderID($order_info['year'], $last_partner_id) + 1;
                           $response['name'] = $order_info['year'] . '-' . partnerRegionAndLitera($last_partner_id) . '-' . $last_insert_id;
                           if (tep_db_perform('orders_to_partners', [
                               'order_id' => $order_id,
                               'partner_id' => $last_partner_id,
                               'region_id' => $region_id,
                               'order_name' => $response['name'],
                               'order_number' => $last_insert_id,
                           ])) {
                               inc_last_partner_id('order_id', $last_partner_id, 0, $order_info['year']);
                           }
                       } else {
                           $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
                           $response['partner_id'] = 0;
                       }
                   } else {
                       $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
                       $response['partner_id'] = 0;
                   }
                   unset($partners);
               } else {
                   $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
                   $response['partner_id'] = 0;
               }
               unset($order_info);

           } else {
               $about_order = tep_db_fetch_array(tep_db_query('SELECT o2p.partner_id, o2p.order_name, CONCAT(pc.lname, " ", LEFT(pc.fname,1), ".", LEFT(pc.oname,1)) AS short_name FROM orders_to_partners AS o2p LEFT JOIN partners_companies AS pc ON(o2p.partner_id=pc.partner_id) WHERE o2p.order_id=' . (int)$order_id . ' LIMIT 1'));
               $response['name'] = $about_order['order_name'];
               $response['partner_id'] = (int)$about_order['partner_id'];
               $response['company_name'] = $about_order['short_name'];
               unset($about_order);
           }

       }
        return '';
    }
}