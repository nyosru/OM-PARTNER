<?php

namespace frontend\controllers\actions\om;


use common\models\AdminCompaniesBank;
use common\models\AdminCompaniesBankToOrders;
use common\models\Configuration;
use common\models\LastPartnersIds;
use common\models\OrdersStatusHistory;
use common\models\OrdersToPartners;
use common\models\PartnersProductsAttributes;
use common\models\PartnersToRegion;
use common\models\ProductsCache;
use common\models\SelerAnket;
use common\models\SpsrZones;
use Yii;
use common\models\PartnersOrders;
use common\models\User;
use common\models\PartnersUsersInfo;
use common\models\Countries;
use common\models\Zones;
use common\models\AddressBook;
use common\models\Customers;
use common\models\Partners;
use common\models\CustomersInfo;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\PartnersProducts;
use common\models\OrdersProductsAttributes;
use common\models\OrdersTotal;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

trait ActionSaveorder
{
    public function actionSaveorder()
    {

        date_default_timezone_set('Europe/Moscow');
        $wrapart = Configuration::find()->where(['configuration_key' => 'ORDERS_PACKAGING_OPTIONS'])->asArray()->one();
        $wrapp = PartnersProducts::find()->where(['products_model' => $wrapart['configuration_value']])->one();
        if (Yii::$app->user->isGuest || ($user = User::find()->where(['partners_users.id' => Yii::$app->user->getId(), 'partners_users.id_partners' => Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->asArray()->one()) == FALSE || !isset($user['userinfo']['customers_id'])) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
        }
        if (!Yii::$app->request->post('address')) {
            $adress_num = $user['customers']['delivery_address_id'];
            $userOM = $user['addressBook'][$adress_num];
            $user['addressBook'] = ArrayHelper::index($user['addressBook'], 'address_book_id');
        } else {
            $adress_num = (int)Yii::$app->request->post('address');
            $user['addressBook'] = ArrayHelper::index($user['addressBook'], 'address_book_id');
            $userOM = $user['addressBook'][$adress_num];
        }
        $default_user_address = $user['addressBook'][$user['customers']['customers_default_address_id']];
        $pay_user_address = $user['addressBook'][$user['customers']['pay_adress_id']];
        $userpartnerdata = $user;
        $userCustomer = $user['customers'];
        $product_in_order = Yii::$app->request->post('product');
        $wrap = Yii::$app->request->post('wrap');
        if ($wrap == 'boxes') {
            $product_in_order[$wrapp['products_id']] = [0 => 1];
        }
        $type_order = Yii::$app->request->post('order-type');
        $plusorder = Yii::$app->request->post('plusorder');
        $comments = Yii::$app->request->post('comments');
        $ship = Yii::$app->request->post('ship');
        $shipping = $this->actionShipping()[$ship];
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        if (!$shipping) {
            return $this->render('cartresult', [
                'result' => [
                    'code' => 0,
                    'text' => 'Укажите транспортную компанию',
                    'data' => [
                        'paramorder' => [
                        ],

                    ]
                ]
            ]);

        } elseif ($shipping['wantpasport'] && (!$userOM['pasport_seria'] || !$userOM['pasport_nomer'] || !$userOM['pasport_kogda_vidan'] || !$userOM['pasport_kem_vidan'])) {
            return $this->render('cartresult', [
                'result' => [
                    'code' => 0,
                    'text' => 'Выбранной транспортной компании требуются ваши паспортные данные. Укажите их пожалуйста в личном кабинете для выбраного адреса',
                    'data' => [
                        'paramorder' => [
                        ],

                    ]
                ]
            ]);

        }
        $wrap = Yii::$app->request->post('wrap');
        $quant = [];

        foreach ($product_in_order as $prodkey => $prodvalue) {
            if ($prodvalue)
                foreach ($prodvalue as $k => $v) {
                    $quant[$prodkey] += $v;
                }
            $queryproduct[] = $prodkey;
        }
        if ($queryproduct) {
            $proddata = PartnersProducts::find()->where(['products.`products_id`' => $queryproduct])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->andWhere('products_status = 1 and products.products_quantity > 0 and  products.products_price != 0 ')->asArray()->all();
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $man = $this->manufacturers_diapazon_id();
        $validprice = 0;
        foreach ($proddata as $keyrequest => $valuerequest) {
            $thisweeekday = date('N') - 1;
            $timstamp_now = (integer)mktime(date('H'), date('i'), date('s'), 1, 1, 1970);
            if (array_key_exists($valuerequest['manufacturers_id'], $man) && $man[$valuerequest['manufacturers_id']][$thisweeekday]) {
                $stop_time = (int)$man[$valuerequest['manufacturers_id']][$thisweeekday]['stop_time'];
                $start_time = (int)$man[$valuerequest['manufacturers_id']][$thisweeekday]['start_time'];
                if (isset($start_time) && isset($stop_time) && ($start_time <= $timstamp_now) && ($timstamp_now <= $stop_time)) {
                    $validprice += ((float)$valuerequest['products_price'] * (int)$quant[$valuerequest['products_id']]);
                    $origprod[$valuerequest['products_id']] = $valuerequest;
                } else {
                    unset($proddata[$keyrequest]);
                    $related[] = $valuerequest;
                }
            } else {
                $validprice += ((float)$valuerequest['products_price'] * (int)$quant[$valuerequest['products_id']]);
                $origprod[$valuerequest['products_id']] = $valuerequest;
            }
        }

        if (($orders = Orders::findOne(['customers_id' => $userCustomer['customers_id']])) == FALSE) {
            $minprice = 5000;
        } else {
            $minprice = 1000;
        }
        if ($validprice < $minprice) {
            return $this->render('cartresult', [
                'result' => [
                    'code' => 0,
                    'text' => 'Минимальная сумма заказа ' . $minprice . ' рублей',
                    'data' => [
                        'paramorder' => [
                        ],
                        'origprod' => $origprod,
                        'timeproduct' => $related,
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $nowdate = date('Y-m-d H:i:s');
            $defaultentrycountry = Countries::find()->where(['countries_id' => $default_user_address['entry_country_id']])->asArray()->one();
            $defaultentryzones = Zones::find()->where(['zone_id' => $default_user_address['entry_zone_id']])->asArray()->one();
            $orders = new Orders();
            $partner_id = $userpartnerdata['id_partners'];

            $orders->ur_or_fiz = 'f';

            $orders->customers_id = $userCustomer['customers_id'];
            $orders->customers_name = substr($default_user_address['entry_lastname'] . ' ' . $default_user_address['entry_firstname'] . ' ' . $default_user_address['otchestvo'], 0, 64);
            $orders->customers_groups_id = $userCustomer['customers_groups_id'];
            $orders->customers_company = $default_user_address['entry_company'];
            $orders->customers_suburb = $default_user_address['entry_suburb'];
            $orders->customers_country = $defaultentrycountry['countries_name'];
            $orders->customers_state = $defaultentryzones['zone_name'];
            $orders->customers_city = $default_user_address['entry_city'];
            $orders->customers_street_address = substr($default_user_address['entry_street_address'], 0, 64);
            if ($default_user_address['entry_postcode']) {
                $orders->customers_postcode = $default_user_address['entry_postcode'];
            } else {
                $orders->customers_postcode = '000000';
            }
            $orders->customers_address_format_id = 1;
            $orders->customers_telephone = $userCustomer['customers_telephone'];
            $orders->customers_email_address = $userCustomer['customers_email_address'];

            $entrycountry = Countries::find()->where(['countries_id' => $userOM['entry_country_id']])->asArray()->one();
            $entryzones = Zones::find()->where(['zone_id' => $userOM['entry_zone_id']])->asArray()->one();

            $orders->delivery_adress_id = $userOM['delivery_adress_id'];
            $orders->delivery_name = $userOM['entry_firstname'];
            $orders->delivery_lastname = $userOM['entry_lastname'];
            $orders->delivery_otchestvo = $userOM['otchestvo'];
            if ($entrycountry['countries_name']) {
                $orders->delivery_country = $entrycountry['countries_name'];
            } else {
                $orders->delivery_country = '176';
            }

            $orders->delivery_state = $entryzones['zone_name'];
            $orders->delivery_city = $userOM['entry_city'];

            if ($userOM['entry_street_address']) {
                $orders->delivery_street_address = $userOM['entry_street_address'];
            } else {
                $orders->delivery_street_address = 'Не указан';
            }

            if ($userOM['entry_postcode']) {
                $orders->delivery_postcode = $userOM['entry_postcode'];
            } else {
                $orders->delivery_postcode = '000000';
            }

            $orders->delivery_adress_id = $userOM['address_book_id'];
            $orders->delivery_pasport_seria = $userOM['pasport_seria'];
            $orders->delivery_pasport_nomer = $userOM['pasport_nomer'];
            $orders->delivery_pasport_kogda_vidan = $userOM['pasport_kogda_vidan'];
            $orders->delivery_pasport_kem_vidan = $userOM['pasport_kem_vidan'];
            $orders->delivery_address_format_id = 1;
            $orders->shipping_module = $ship;


            $payentrycountry = Countries::find()->where(['countries_id' => $pay_user_address['entry_country_id']])->asArray()->one();
            $payentryzones = Zones::find()->where(['zone_id' => $pay_user_address['entry_zone_id']])->asArray()->one();


            if ($pay_user_address['entry_lastname']) {
                $orders->billing_name = $pay_user_address['entry_lastname'] . ' ' . $pay_user_address['entry_firstname'] . ' ' . $pay_user_address['otchestvo'];
            } else {
                $orders->billing_name = $orders->customers_name;

            }

            if ($payentrycountry['countries_name']) {
                $orders->billing_country = $payentrycountry['countries_name'];
            } else {
                $orders->billing_country = $orders->customers_country;

            }

            if ($payentryzones['zone_name']) {
                $orders->billing_state = $payentryzones['zone_name'];
            } else {
                $orders->billing_state = $orders->customers_state;

            }

            if ($payentryzones['zone_name']) {
                $orders->billing_state = $payentryzones['zone_name'];
            } else {
                $orders->billing_state = $orders->customers_state;

            }

            if ($pay_user_address['entry_city']) {
                $orders->billing_city = $pay_user_address['entry_city'];
            } else {
                $orders->billing_city = $orders->customers_city;

            }

            if ($pay_user_address['entry_street_address']) {
                $orders->billing_street_address = $pay_user_address['entry_street_address'];
            } else {
                $orders->billing_street_address = $orders->customers_street_address;

            }

            if ($pay_user_address['entry_postcode']) {
                $orders->billing_postcode = $pay_user_address['entry_postcode'];
            } else {
                $orders->billing_postcode = $orders->customers_postcode;

            }


            $orders->billing_address_format_id = 1;


            $orders->customers_referer_url = 'ompartnernew';
            $orders->currency = 'RUR';
            $orders->currency_value = '1.000000';
            $orders->last_modified = $nowdate;
            $orders->date_purchased = $nowdate;
            $orders->date_akt = $nowdate;
            $orders->nomer_akt = '0';
            $orders->orders_date_finished = 0;
            $orders->payment_info = '';
            $orders->orders_status = 1;
            $orders->site_side_email_flag = 1;
            $orders->print_torg = 'b';
            $orders->default_provider = $userCustomer['default_provider'];
            $orders->payment_method = 'Оплата <font size="4" color="red">Для физических лиц</font>';
            $buh_id = Orders::find()->select('MAX(buh_orders_id) as buh_orders_id')->where(['default_provider' => $userCustomer['default_provider']])->andWhere('DATE_FORMAT(date_purchased, "%y")=' . date("y"))->asArray()->one();
            $orders->buh_orders_id = (integer)($buh_id['buh_orders_id']) + 1;

            $latestseller = Orders::find()->select('seller_id as seller')->orderBy('date_purchased DESC')->asArray()->one();
            $new_seller_id = 0;
            $first_seller_id = 0;
            $seller_key = false;
            $iterator = 0;
            $active_seller = SelerAnket::find()->select('seler_anket_id as id')->where('active_seller = 1')->orderBy('seler_anket_id')->asArray()->all();
            while (list($key_active_seller, $value_active_seller) = each($active_seller)) {
                if ($first_seller_id == 0) {
                    $first_seller_id = $value_active_seller['id'];
                }
                if ($seller_key) {
                    $new_seller_id = $value_active_seller['id'];
                    $seller_key = false;
                    break;
                }
                if ($latestseller['seller'] == $value_active_seller['id']) {
                    $seller_key = true;
                }
            }
            if ($new_seller_id == 0) {
                $new_seller_id = $first_seller_id;
            }
            $orders->seller_id = $new_seller_id;

            if ($orders->save()) {

                if (($check = OrdersToPartners::find()->where(['order_id' => $default_user_address['entry_zone_id']])->one()) == FALSE) {
                    if (($region_partners = PartnersToRegion::find()->joinWith('partnersCompanies')->where(['region_id' => $default_user_address['entry_zone_id']])->andWhere('active > 0')->asArray()->all()) == TRUE) {
                        $partners = [];
                        $last_partner_id = 0;
                        foreach ($region_partners as $key_region => $value_region) {
                            $last_partner_id = $value_region['partner_id'];
                            $partners[$last_partner_id]['name'] = $value_region['partnersCompanies']['lname'] . ' ' . mb_substr($value_region['partnersCompanies']['fname'], 0, 1, 'UTF-8') . ' ' . mb_substr($value_region['partnersCompanies']['oname'], 0, 1, 'UTF-8');
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

                            $year = date('Y', strtotime($nowdate));
                            // проверяем: когда был сделан заказ и когда был создан партнер, если заказ был создан после создания партнера и на момент создания заказа клиент оплатил более min_raiting заказов, а так же не находится в ЧС, то пытаемся переключить заказ на регионала
                            if ($partners[$last_partner_id]['support_black_list'] || $userCustomer['customers_groups_id'] != 3) {
                                $in_black_list = false;
                            } else {
                                $in_black_list = true;
                            }

                            $rating = Orders::find()->where(['customers_id' => $orders->customers_id, 'orders_status' => 5]);
                            $rating->andWhere('date_purchased < "' . $orders->date_purchased . '"');
                            $rating = $rating->asArray()->count();


//                        // заказы со статусами: Оплачен, Оплачен-доставляется, Оплачен-доставлен


                            if ((int)$year >= $partners[$last_partner_id]['active_after'] && $rating >= $partners[$last_partner_id]['min_raiting'] && !$in_black_list) {
                                $response['partner_id'] = $last_partner_id;
                                $response['company_name'] = $partners[$last_partner_id]['name'];
                                $cur_year = date('y', strtotime($nowdate));
                                $field = 'order_id';


                                if (($response = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partners_companies.partner_id' => (int)$last_partner_id, 'year' => $cur_year, 'region_id' => $info['default_region']])->asArray()->one()) == FALSE) {
                                    $response = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partners_companies.partner_id' => (int)$last_partner_id, 'year' => $cur_year, 'region_id' => $region_id])->asArray()->one();
                                }
                                $last_insert_id = $response[$field] + 1;

                                // $response = $region_number['id'] . (count($partner['parent_ids']) > 1 ? ((int)$region_number['num_of_region'] > 1 ? '/' . $region_number['num_of_region'] : '') : $pr_litr[$partner['parent_ids'][0]]);

                                $spsr_region = SpsrZones::find()->where(['zone_id' => $response['region_id']])->asArray()->one();

                                $response['name'] = $cur_year . '-' . $spsr_region['id'] . '-' . $last_insert_id;
                                $OrdersToPartners = new OrdersToPartners();
                                $OrdersToPartners->order_id = $orders->orders_id;
                                $OrdersToPartners->partner_id = $last_partner_id;
                                $OrdersToPartners->region_id = $region_id;
                                $OrdersToPartners->order_name = $response['name'];
                                $OrdersToPartners->order_number = $last_insert_id;

                                if ($OrdersToPartners->save()) {
                                    if (($lastids = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partners_companies.partner_id' => (int)$last_partner_id, 'year' => $cur_year, 'region_id' => $info['default_region']])->one()) == FALSE) {
                                        $lastids = LastPartnersIds::find()->joinWith('partnerscompanies')->where(['partners_companies.partner_id' => (int)$last_partner_id, 'year' => $cur_year])->one();
                                    }
                                    $lastids->order_id = $last_insert_id;
                                    if ($lastids->save()) {
                                        $orders->buh_orders_id = 0;
                                        $orders->save();
                                        $numberorders = $response['name'];
                                        $flag_to_region = true;
                                    } else {
                                        $numberorders = $orders->NumOrder();
                                    }

                                } else {

                                    $numberorders = $orders->NumOrder();

                                }
                            } else {
                                $numberorders = $orders->NumOrder();
                            }
                        } else {
                            $numberorders = $orders->NumOrder();
                        }
                    } else {
                        $numberorders = $orders->NumOrder();
                    }

                } else {
                    $numberorders = $orders->NumOrder();

                }

                if (($banks = AdminCompaniesBankToOrders::find()->joinWith('bank')->joinWith('orders')->where(['orders.customers_id' => $orders->customers_id, 'default_provider' => $userCustomer['default_provider'], 'bank_active' => '1'])->andWhere('admin_companies_bank.rs <> ""')->orderBy('orders.orders_id DESC')->asArray()->one()) == TRUE) {
                    $bankID = [
                        'id' => (int)$banks['admin_companies_bank_id'],
                        'rs' => stripslashes(trim($banks['rs'])),
                        'ks' => stripslashes(trim($banks['ks'])),
                        'bik' => stripslashes(trim($banks['bik'])),
                        'adress' => stripslashes(trim($banks['adress'])),
                        'short_name' => stripslashes(trim($banks['short_name'])),
                        'addInfo' => 'Найден по прошлым записям',
                    ];
                } else {

                    $id_config = Configuration::find()->where(['configuration_key' => 'LAST_BANK_ID_TO_USER_' . $userCustomer['default_provider']])->one();
                    $id = (int)$id_config->configuration_value;
                    $ratio_config = Configuration::find()->where(['configuration_key' => 'LAST_BANK_RATIO_TO_USER_' . $userCustomer['default_provider']])->one();
                    $ratio = (int)$ratio_config->configuration_value;
                    $customerBankQuery = AdminCompaniesBank::find()->where(['admin_companies_id' => $userCustomer['default_provider'], 'bank_active' => '1'])->orderBy('admin_companies_bank_id')->asArray()->all();
                    $bankKey = false;
                    $customerBankQueryRowsCount = count($customerBankQuery);
                    if ($customerBankQueryRowsCount > 1) {
                        $first_bank_id = 0;
                        while (list($bank_key, $bank_value) = each($customerBankQuery)) {

                            if ($first_bank_id === 0) {
                                $first_bank_id = (int)$bank_value['admin_companies_bank_id'];
                            }
                            if ($bankKey) {
                                $id = (int)$bank_value['admin_companies_bank_id'];
                                $ratio = 1;
                                $bankKey = false;
                                break;
                            }
                            if ((int)$bank_value['admin_companies_bank_id'] === $id) {
                                if ($ratio < (int)$bank_value['ratio']) {
                                    $id = (int)$bank_value['admin_companies_bank_id'];
                                    $ratio += 1;
                                    $bankKey = false;
                                    break;
                                } else {
                                    $bankKey = true;
                                }
                            } else {
                                $bankKey = false;
                            }
                        }

                        if ($bankKey || $id === 0) {
                            $id = (int)$first_bank_id;
                            $ratio = 1;
                            $bankKey = false;
                        }
                    } else {

                        $id = (int)$customerBankQuery['admin_companies_bank_id'];
                        $ratio = 1;
                    }

                    $ratio_config->configuration_value = $ratio;
                    $ratio_config->update();
                    $id_config->configuration_value = $id;
                    $id_config->update();
                    $customerBankQuery = ArrayHelper::index($customerBankQuery, 'admin_companies_bank_id');


                    if ($customerBankQuery[$id]) {
                        $bankID = [
                            'id' => (int)$customerBankQuery[$id]['admin_companies_bank_id'],
                            'rs' => stripslashes(trim($customerBankQuery[$id]['rs'])),
                            'ks' => stripslashes(trim($customerBankQuery[$id]['ks'])),
                            'bik' => stripslashes(trim($customerBankQuery[$id]['bik'])),
                            'adress' => stripslashes(trim($customerBankQuery[$id]['adress'])),
                            'short_name' => stripslashes(trim($customerBankQuery[$id]['short_name'])),
                            'addInfo' => 'Найден по поиску в очереди из ' . $customerBankQueryRowsCount,
                        ];
                    } else {
                        return false;
                    }

                }
                $admin_companies_bank_to_orders = new AdminCompaniesBankToOrders();
                $admin_companies_bank_to_orders->orders_id = (integer)$orders->orders_id;
                $admin_companies_bank_to_orders->admin_companies_bank_id = (integer)$bankID['id'];
                $admin_companies_bank_to_orders->admin_companies_id = (integer)$userCustomer['default_provider'];
                $admin_companies_bank_to_orders->rs = $bankID['rs'];
                $admin_companies_bank_to_orders->ks = $bankID['ks'];
                $admin_companies_bank_to_orders->bik = $bankID['bik'];
                $admin_companies_bank_to_orders->adress = $bankID['adress'];
                $admin_companies_bank_to_orders->short_name = $bankID['short_name'];
                $admin_companies_bank_to_orders->validate();

                if ($admin_companies_bank_to_orders->save()) {

                }
                $price_total = 0;
                $reindexprod = ArrayHelper::index($proddata, 'products_id');

                foreach ($product_in_order as $keyin_order => $valuein_order) {
                    if (array_key_exists($keyin_order, $origprod)) {
                        $reindexattrdescr = ArrayHelper::index($reindexprod[$keyin_order]['productsAttributesDescr'], 'products_options_values_id');
                        foreach ($valuein_order as $keyinattr_order => $valueinattr_order) {
                            $ordersprod = new OrdersProducts();
                            $ordersprod->first_quant = intval($valueinattr_order);
                            $ordersprod->products_quantity = intval($valueinattr_order);
                            $ordersprod->orders_id = $orders->orders_id;
                            $ordersprod->products_id = intval($keyin_order);
                            $ordersprod->products_model = $reindexprod[$keyin_order]['products_model'];
                            $ordersprod->products_name = $reindexprod[$keyin_order]['productsDescription']['products_name'];
                            $ordersprod->final_price = $reindexprod[$keyin_order]['products_price'];
                            $ordersprod->products_price = $reindexprod[$keyin_order]['products_price'];
                            $ordersprod->price_coll = $reindexprod[$keyin_order]['price_coll'];
                            $ordersprod->products_tax = $reindexprod[$keyin_order]['products_tax'];
                            $ordersprod->products_status = 0;
                            $ordersprod->checks = 0;
                            if ($comments[$keyin_order][$reindexattrdescr[$keyinattr_order]['products_options_values_id']]) {
                                $ordersprod->comment = $this->trim_tags_text($comments[$keyin_order][$reindexattrdescr[$keyinattr_order]['products_options_values_id']]);
                            } elseif ($comments[$keyin_order]['all']) {
                                $ordersprod->comment = $this->trim_tags_text($comments[$keyin_order]['all']);
                            } else {
                                $ordersprod->comment = NULL;
                            }
                            $ordersprod->verificatiuon = 0;
                            $ordersprod->status_add = NULL;
                            $ordersprod->stickers_confirmed = 0;
                            $ordersprod->automatically_sent_to_manufacturer = 0;
                            $ordersprod->status_add = NULL;
                            $ordersprod->sub_orders_id = NULL;
                            $ordersprod->old_orders_id = NULL;
                            $ordersprod->products_tax = '0.0000';
                            if ($ordersprod->save()) {
                                if ($keyinattr_order) {
                                    $ordersprodattr = new OrdersProductsAttributes();
                                    $ordersprodattr->orders_products_id = $ordersprod->orders_products_id;
                                    $ordersprodattr->orders_id = $orders->orders_id;
                                    $ordersprodattr->products_options = 'Размер';
                                    $ordersprodattr->products_options_values = $reindexattrdescr[$keyinattr_order]['products_options_values_name'];
                                    $ordersprodattr->options_values_price = '0.0000';
                                    $ordersprodattr->vid = $reindexattrdescr[$keyinattr_order]['products_options_values_id'];
                                    $ordersprodattr->oid = '1';
                                    $ordersprodattr->sub_vid = 0;
                                    if ($ordersprodattr->save()) {

                                        if (($orderedproducts = PartnersProductsAttributes::find()->where('products_attributes.products_id = :products_id and products_attributes.options_values_id = :productattr', [':products_id' => $keyin_order, ':productattr' => $reindexattrdescr[$keyinattr_order]['products_options_values_id']])->one()) == TRUE) {
                                            if (empty($orderedproducts->price_prefix)) {
                                                $orderedproducts->price_prefix = '-';
                                            }
                                            if (empty($orderedproducts->products_attributes_weight_prefix)) {
                                                $orderedproducts->products_attributes_weight_prefix = '-';
                                            }
                                            if (($orderedproductsquantyty = PartnersProducts::find()->where('products.products_id = :products_id ', [':products_id' => $keyin_order])->one()) == TRUE) {
                                                $orderedproductsquantyty->products_quantity = max(0, (($orderedproductsquantyty->products_quantity) - ($ordersprod->products_quantity)));
                                                $orderedproductsquantyty->products_last_modified = $nowdate;
                                                $orderedproductsquantyty->products_ordered = $orderedproductsquantyty->products_ordered + $orderedproductsquantyty->products_quantity;
                                                $orderedproductsquantyty->save();
                                                //      ProductsCache::find()->where(['products_id'=>$keyin_order])->one()->delete();

                                            }
                                            $orderedproducts->quantity = max(0, (($orderedproducts->quantity) - ($ordersprod->products_quantity)));
                                            $orderedproducts->save();
                                        }
                                        $ordersprodattr = $ordersprodattr->toArray();


                                    } else {

                                        return $this->render('cartresult', ['wrapprice' => (integer)$wrapp['products_price'],
                                            'result' => [
                                                'code' => 0,
                                                'text' => 'Ошибка оформления позиции код 345 ' . $reindexprod[$keyin_order]['products_model'],
                                                'data' => [
                                                    'paramorder' => [
                                                    ],
                                                    'origprod' => $origprod,
                                                    'timeproduct' => $related,
                                                    'totalpricesaveproduct' => $validprice
                                                ]
                                            ]
                                        ]);
                                    }
                                } else {
                                    if (($orderedproductsquantyty = PartnersProducts::find()->where('products.products_id = :products_id ', [':products_id' => $keyin_order])->one()) == TRUE) {
                                        $orderedproductsquantyty->products_quantity = max(0, (($orderedproductsquantyty->products_quantity) - ($ordersprod->products_quantity)));
                                        $orderedproductsquantyty->products_last_modified = $nowdate;
                                        $orderedproductsquantyty->products_ordered = $orderedproductsquantyty->products_ordered + $orderedproductsquantyty->products_quantity;
                                        $orderedproductsquantyty->save();
                                    }


                                }
                                $validproduct[] = [$ordersprod->toArray(), $ordersprodattr];
                                $price_total += (float)($price_total) + $ordersprod->products_price * $ordersprod->products_quantity;

                            } else {
                                return $this->render('cartresult', [
                                    'result' => [
                                        'code' => 0,
                                        'text' => 'Ошибка оформления продукта код 425' . $reindexprod[$keyin_order]['products_model'],
                                        'data' => [
                                            'paramorder' => [
                                            ],
                                            'origprod' => $origprod,
                                            'timeproduct' => $related,
                                            'totalpricesaveproduct' => $validprice
                                        ]
                                    ]
                                ]);
                            }
                        }
                    }
                }
                $orderstotalprice = new OrdersTotal();
                $orderstotalprice->orders_id = $orders->orders_id;
                $dostavka = [
                    'flat1_flat1' => 'Бесплатная доставка до ТК Деловые Линии',
                    'flat2_flat2' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция',
                    'flat3_flat3' => 'Бесплатная доставка до ТК ПЭК',
                    'flat7_flat7' => 'Почта ЕМС России',
                    'flat11_flat11' => 'Бесплатная доставка до ТК КИТ',
                    'flat10_flat10' => 'Бесплатная доставка до ТК ОПТИМА',
                    'flat9_flat9' => 'Бесплатная доставка до ТК Севертранс',
                    'flat12_flat12' => 'Бесплатная доставка до ТК ЭНЕРГИЯ',
                    'courier_express' => 'Бесплатная доставка до ТК Служба доставки Экспресс-Курьер',
                    'russianpostpf_russianpostpf' => 'Почта России - http://pochta.ru/'
                ];
                if (!$dostavka[$ship]) {
                    $dostavka[$ship] = 'Партнерская доставка';
                }
                $orderstotalprice->title = $dostavka[$ship];
                $orderstotalprice->text = '0.00 руб';
                $orderstotalprice->value = '0.0000';
                $orderstotalprice->class = 'ot_shipping';
                $orderstotalprice->sort_order = 2;
                if ($orderstotalprice->save()) {

                } else {
                    return $this->render('cartresult', [
                        'result' => [
                            'code' => 0,
                            'text' => 'Ошибка оформления заказа код 101',
                            'data' => [
                                'paramorder' => [
                                ],
                                'origprod' => $origprod,
                                'timeproduct' => $related,
                                'totalpricesaveproduct' => $validprice
                            ]
                        ]
                    ]);
                }

                $orderstotalship = new OrdersTotal();
                $orderstotalship->orders_id = $orders->orders_id;
                $orderstotalship->title = 'Всего: ';
                $orderstotalship->text = '<b>' . $price_total . ' руб.</b>';
                $orderstotalship->value = $price_total;
                $orderstotalship->class = 'ot_total';
                $orderstotalship->sort_order = 800;
                if ($orderstotalship->save()) {

                } else {
                    return $this->render('cartresult', [
                        'result' => [
                            'code' => 0,
                            'text' => 'Ошибка оформления заказа код 102',
                            'data' => [
                                'paramorder' => [
                                ],
                                'origprod' => $origprod,
                                'timeproduct' => $related,
                                'totalpricesaveproduct' => $validprice
                            ]
                        ]
                    ]);
                }

                $orderstotalprint = new OrdersTotal();
                $orderstotalprint->orders_id = $orders->orders_id;
                $orderstotalprint->title = 'Стоимость товара: ';
                $orderstotalprint->text = $price_total . ' руб.';
                $orderstotalprint->value = $price_total;
                $orderstotalprint->class = 'ot_subtotal';
                $orderstotalprint->sort_order = 1;
                if ($orderstotalprint->save()) {

                } else {
                    return $this->render('cartresult', [
                        'result' => [
                            'code' => 0,
                            'text' => 'Ошибка оформления заказа код 103',
                            'data' => [
                                'paramorder' => [
                                ],
                                'origprod' => $origprod,
                                'timeproduct' => $related,
                                'totalpricesaveproduct' => $validprice
                            ]
                        ]
                    ]);
                }

                $neworderpartner = new PartnersOrders();
                $neworderpartner->partners_id = $partner_id;
                $neworderpartner->user_id = $user['id'];
                $neworderpartner->order = 'LinkToOm';
                $neworderpartner->status = 1;
                $neworderpartner->delivery = 'LinkToOm';
                $neworderpartner->orders_id = $orders->orders_id;
                $neworderpartner->update_date = $nowdate;
                $neworderpartner->create_date = $nowdate;
                if ($neworderpartner->save()) {

                } else {
                    return $this->render('cartresult', [
                        'result' => [
                            'code' => 0,
                            'text' => 'Ошибка оформления заказа код 104',
                            'data' => [
                                'paramorder' => [
                                ],
                                'origprod' => $origprod,
                                'timeproduct' => $related,
                                'totalpricesaveproduct' => $validprice
                            ]
                        ]
                    ]);
                }

                $ordershistory = new OrdersStatusHistory();
                $ordershistory->orders_id = $orders->orders_id;
                $ordershistory->orders_status_id = '1';
                $ordershistory->date_added = $nowdate;
                $ordershistory->customer_notified = '0';
                if (($ordercomments = $this->trim_tags_text(Yii::$app->request->post('ordercomments'), 300)) == TRUE) {
                    $ordershistory->comments = $ordercomments;
                } else {
                    $ordershistory->comments = NULL;
                }
//                if($type_order == 'plus'){
//                    $ordershistory->comments .= ' Авто-комментарий - Дозаказ к заказу №'. (integer)Yii::$app->request->post('plusorders');
//                }
                if ($wrap == 'boxes') {
                    $ordershistory->comments .= ' Авто-комментарий - Упаковка: крафт коробки. ';
                }
                $ordershistory->comments .= ' Заказ с нового фронта';
                $ordershistory->validate();
                if ($ordershistory->save()) {

                } else {
                    return $this->render('cartresult', [
                        'result' => [
                            'code' => 0,
                            'text' => 'Ошибка оформления заказа код 105',
                            'data' => [
                                'paramorder' => [
                                ],
                                'origprod' => $origprod,
                                'timeproduct' => $related,
                                'totalpricesaveproduct' => $validprice
                            ]
                        ]
                    ]);
                }

            } else {
                $orders->validate();
                return $this->render('cartresult', [
                    'result' => [
                        'code' => 0,
                        'text' => 'Ошибка оформления заказа код 106 ' . json_encode($orders->errors),
                        'data' => [
                            'paramorder' => [
                            ],
                            'origprod' => $origprod,
                            'timeproduct' => $related,
                            'totalpricesaveproduct' => $validprice
                        ]
                    ]
                ]);
            }

            $transaction->commit('suc');
            Yii::$app->mailer->compose(['html' => 'orderom-save'], ['wrapprice' => (integer)$wrapp['products_price'],
                'result' => [
                    'code' => 200,
                    'text' => '<div style="font-size: xx-large; padding-left: 10px;">Ваш заказ ' . $numberorders . ' в магазине Одежда-Мастер оформлен</div>',
                    'data' => [
                        'paramorder' => [
                            'delivery' => $dostavka[$ship],
                            'number' => $orders->orders_id . ' (' . $numberorders . ')',
                            'date' => $orders->date_purchased,
                            'wrap' => $wrap,
                            'name' => $orders->customers_name,
                            'telephone' => $orders->customers_telephone,
                            'email' => $orders->customers_email_address,
                        ],
                        'saveproduct' => $validproduct,
                        'origprod' => $origprod,
                        'timeproduct' => $related,
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ])
                ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                ->setTo($orders->customers_email_address)
                ->setSubject('Новый заказ"')
                ->send();
            Yii::$app->mailer->compose(['html' => 'orderom-save'], ['wrapprice' => (integer)$wrapp['products_price'],
                'result' => [
                    'code' => 200,
                    'text' => '<div style="font-size: xx-large; padding-left: 10px;">Ваш заказ ' . $numberorders . ' в магазине Одежда-Мастер оформлен</div>',
                    'data' => [
                        'paramorder' => [
                            'delivery' => $dostavka[$ship],
                            'number' => $orders->orders_id . ' (' . $numberorders . ')',
                            'date' => $orders->date_purchased,
                            'wrap' => $wrap,
                            'name' => $orders->customers_name,
                            'telephone' => $orders->customers_telephone,
                            'email' => $orders->customers_email_address,
                        ],
                        'saveproduct' => $validproduct,
                        'origprod' => $origprod,
                        'timeproduct' => $related,
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ])
                ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                ->setTo('desure85@gmail.com')
                ->setSubject('Новый заказ"')
                ->send();
            Yii::$app->session->set('order-succes', ['wrapprice' => (integer)$wrapp['products_price'],
                'result' => [
                    'code' => 200,
                    'text' => 'Спасибо, Ваш заказ оформлен',
                    'data' => [
                        'paramorder' => [
                            'delivery' => $dostavka[$ship],
                            'number' => $orders->orders_id . ' (' . $numberorders . ')',
                            'date' => $orders->date_purchased,
                            'wrap' => $wrap,
                            'name' => $orders->customers_name,
                            'telephone' => $orders->customers_telephone,
                            'email' => $orders->customers_email_address,
                        ],
                        'saveproduct' => $validproduct,
                        'origprod' => $origprod,
                        'timeproduct' => $related,
                        'totalpricesaveproduct' => $validprice
                    ]
                ]
            ]);
            return header('location: ' . BASEURL . '/cartresult');

        } catch (\Exception $e) {
            Yii::$app->mailer->compose()
                ->setFrom('support@newodezhdamaster.com')
                ->setTo('desure85@gmail.com')
                ->setSubject('Ошибка оформления 7')
                ->setTextBody(

                    $orders->orders_id . '/////' .
                    $e->getCode() . '/////' .
                    $e->getFile() . '/////' .
                    $e->getLine() . '/////' .
                    $e->getMessage() . '/////' .
                    $e->getTrace() . '/////' .
                    $e->getPrevious()
                )
                ->send();
            $transaction->rollBack();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}