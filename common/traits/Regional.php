<?php
if (($region_partners = PartnersToRegion::find()->joinWith('partnersCompanies')->where(['region_id' => $default_user_address['entry_zone_id']])->andWhere('active > 0')->asArray()->all()) == TRUE) {
    $partners = [];
    $last_partner_id = 0;
    foreach ($region_partners as $key_region => $value_region) {
        $last_partner_id = $value_region['partner_id'];
        $partners[$last_partner_id]['name'] = $value_region['partnersCompanies']['short_name'];
        $partners[$last_partner_id]['parent_ids'][] = (int)$value_region['parent_companies_id'];
        $partners[$last_partner_id]['default_region'] = $value_region['partnersCompanies']['default_region'];
        $partners[$last_partner_id]['active_after'] = (int)$value_region['partnersCompanies']['active_after'];
        $partners[$last_partner_id]['num_of_region'] = (int)$value_region['partnersCompanies']['num_of_region'];
        $partners[$last_partner_id]['min_raiting'] = (int)$value_region['partnersCompanies']['min_raiting'];
        $partners[$last_partner_id]['support_black_list'] = ((int)$value_region['partnersCompanies']['support_black_list']) > 0 ? true : false;
    }
    $region_id = 0;
// если найден один партнер
    if (count($partners) === 1) {
// если партнер обслуживает заказы поставщика customers.default_provider
        if (in_array((int)$orders->default_provider, $partners[$last_partner_id]['parent_ids'])) {
            $region_id = $partners[$last_partner_id]['default_region'];
        }
    } else if (count($partners) > 1) {
// Если партнеров несколько, то выбираем того партнера, который обслуживает заказы customers.default_provider
        foreach ($partners as $pid => $info) {
// если партнер обслуживает заказы customers.default_provider
            if (in_array((int)$orders->default_provider, $info['parent_ids'])) {
                $region_id = $info['default_region'];
                $last_partner_id = (int)$pid;
            }

        }
    }


    if ($region_id != 0) {
        $year = date('y', strtotime($nowdate));
// проверяем: когда был сделан заказ и когда был создан партнер, если заказ был создан после создания партнера и на момент создания заказа клиент оплатил более min_raiting заказов, а так же не находится в ЧС, то пытаемся переключить заказ на регионала
        if ($partners[$last_partner_id]['support_black_list'] && $userCustomer['customers_groups_id'] != 3) {
            $in_black_list = false;
        } else {
            $in_black_list = true;
        }
        $rating = Orders::find()->where(['customers_id' => $orders->customers_id, 'orders_status' => 5]);
        if (isset($orders->date_purchased) && $orders->date_purchased > 1) {
            $rating->andWhere('unix_timestamp(date_purchased) < "' . $orders->date_purchased . '"');
        }
        $rating = $rating->asArray()->count();

// заказы со статусами: Оплачен, Оплачен-доставляется, Оплачен-доставлен

        if ((int)$orders->date_purchased >= $partners[$last_partner_id]['active_after'] && $rating >= $partners[$last_partner_id]['min_raiting'] && !$in_black_list) {
            $response['partner_id'] = $last_partner_id;
            $response['company_name'] = $partners[$last_partner_id]['name'];
            $cur_year = (int)$year == 0 ? date('y', time()) : (int)$year;
            if (trim($cur_year) == '') {
                $cur_year = date('y', time());
            }
            $field = 'order_id';
            $cur_year = (int)$cur_year == 0 ? date('y', time()) : (int)$cur_year;
            if ((int)$region_id == 0) {
                if (($response = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partner_id' => (int)$partner_id, 'year' => $cur_year, 'region_id' => $info['default_region']])->asArray()->one()) == FALSE) {
                    $response = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partner_id' => (int)$partner_id, 'year' => $cur_year, 'region_id' => $region_id])->asArray()->one();
                }
                $last_insert_id = $response[$field] + 1;

                $response['name'] = $cur_year . '-' . partnerRegionAndLitera($last_partner_id) . '-' . $last_insert_id;
                $OrdersToPartners = new OrdersToPartners();
                $OrdersToPartners->order_id = $orders->orders_id;
                $OrdersToPartners->partner_id = $last_partner_id;
                $OrdersToPartners->region_id = $region_id;
                $OrdersToPartners->order_name = $response['name'];
                $OrdersToPartners->order_number = $last_insert_id;
                if ($OrdersToPartners->save()) {

//     inc_last_partner_id('order_id', $last_partner_id, 0, $order_info['year']);
                } else {

// $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
                    $response['partner_id'] = 0;

                }

            }

        } else {
            $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
            $response['partner_id'] = 0;
        }

    } else {
        $response['name'] = $order_info['year'] . $order_info['litera'] . '-' . $order_info['buh_orders_id'];
        $response['partner_id'] = 0;
    }
}

