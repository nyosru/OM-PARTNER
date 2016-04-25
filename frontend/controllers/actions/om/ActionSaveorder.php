<?php

namespace frontend\controllers\actions\om;


use common\models\Configuration;
use common\models\OrdersStatusHistory;
use common\models\PartnersProductsAttributes;
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
        $wrapart=Configuration::find()->where(['configuration_key'=>'ORDERS_PACKAGING_OPTIONS'])->asArray()->one();
        $wrapp=PartnersProducts::find()->where(['products_model'=>$wrapart['configuration_value']])->one();
        if(Yii::$app->user->isGuest || ($user = User::find()->where(['partners_users.id'=>Yii::$app->user->getId(), 'partners_users.id_partners'=>Yii::$app->params['constantapp']['APP_ID']])->joinWith('userinfo')->joinWith('customers')->joinWith('addressBook')->asArray()->one()) == FALSE || !isset($user['userinfo']['customers_id']) ){
            return $this->redirect(Yii::$app->request->referrer);
        }else{
        }
        if(!Yii::$app->request->post('address')){
            $adress_num = $user['customers']['delivery_address_id'];
            $userOM = $user['addressBook'][$adress_num];
            $user['addressBook'] = ArrayHelper::index($user['addressBook'],'address_book_id');
        }else{
            $adress_num = (int)Yii::$app->request->post('address');
            $user['addressBook'] = ArrayHelper::index($user['addressBook'],'address_book_id');
            $userOM = $user['addressBook'][$adress_num];
        }
        $default_user_address = $user['addressBook'][$user['customers']['customers_default_address_id']];
        $pay_user_address = $user['addressBook'][$user['customers']['pay_adress_id']];
        $userpartnerdata = $user;
        $userCustomer = $user['customers'];
        $product_in_order = Yii::$app->request->post('product');
        $wrap = Yii::$app->request->post('wrap');
        if($wrap=='boxes') {
            $product_in_order[$wrapp['products_id']] = [0=>1];
        }
        $type_order = Yii::$app->request->post('order-type');
        $plusorder = Yii::$app->request->post('plusorder');
        $comments = Yii::$app->request->post('comments');
        $ship = Yii::$app->request->post('ship');
        $shipping = $this->actionShipping()[$ship];
        Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
        if(!$shipping){
            return $this->render('cartresult', [
                'result'=>  [
                    'code' => 0,
                    'text'=>'Укажите транспортную компанию',
                    'data'=>[
                        'paramorder'=>[
                        ],

                    ]
                ]
            ]);

        }elseif($shipping['wantpasport'] && (!$userOM['pasport_seria'] || !$userOM['pasport_nomer']|| !$userOM['pasport_kogda_vidan'] || !$userOM['pasport_kem_vidan'])){
            return $this->render('cartresult', [
                'result'=>  [
                    'code' => 0,
                    'text'=>'Выбранной транспортной компании требуются ваши паспортные данные. Укажите их пожалуйста в личном кабинете для выбраного адреса',
                    'data'=>[
                        'paramorder'=>[
                        ],

                    ]
                ]
            ]);

        }
        $wrap = Yii::$app->request->post('wrap');
        $quant=[];

        foreach($product_in_order as $prodkey =>$prodvalue){
            if($prodvalue)
                foreach($prodvalue as $k=> $v){
                    $quant[$prodkey]+= $v;
                }
            $queryproduct[] = $prodkey;
        }
        if($queryproduct) {
            $proddata = PartnersProducts::find()->where(['products.`products_id`' => $queryproduct])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->asArray()->all();
        }else{
            return $this->redirect(Yii::$app->request->referrer);
        }
        $man = $this->manufacturers_diapazon_id();
        $validprice = 0;
        foreach($proddata as $keyrequest => $valuerequest){
            $thisweeekday = date('N')-1;
            $timstamp_now = (integer)mktime(date('H'),date('i'), date('s'), 1, 1, 1970);
            if(array_key_exists($valuerequest['manufacturers_id'],$man) && $man[$valuerequest['manufacturers_id']][$thisweeekday]){
                $stop_time = (int)$man[$valuerequest['manufacturers_id']][$thisweeekday]['stop_time'];
                $start_time = (int)$man[$valuerequest['manufacturers_id']][$thisweeekday]['start_time'];
                if(isset($start_time) && isset($stop_time) && ($start_time <= $timstamp_now) && ($timstamp_now <= $stop_time)){
                    $validprice += ((float)$valuerequest['products_price']*(int)$quant[$valuerequest['products_id']]);
                    $origprod[$valuerequest['products_id']] = $valuerequest;
                }else{
                    unset($proddata[$keyrequest]);
                    $related[]=$valuerequest;
                }
            }else{
                $validprice += ((float)$valuerequest['products_price']*(int)$quant[$valuerequest['products_id']]);
                $origprod[$valuerequest['products_id']] = $valuerequest;
            }
        }

        if(($orders = Orders::findOne(['customers_id'=>$userCustomer['customers_id']]))==FALSE){
            $minprice = 5000;
        }else{
            $minprice = 1000;
        }
        if($validprice < $minprice ){
            return $this->render('cartresult', [
                'result'=>  [
                    'code' => 0,
                    'text'=>'Минимальная сумма заказа '.$minprice.' рублей',
                    'data'=>[
                        'paramorder'=>[
                        ],
                        'origprod' => $origprod,
                        'timeproduct'=>$related,
                        'totalpricesaveproduct'=>$validprice
                    ]
                ]
            ]);
        }
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $nowdate = date('Y-m-d H:i:s');
            $defaultentrycountry = Countries::find()->where(['countries_id'=>$default_user_address['entry_country_id']])->asArray()->one();
            $defaultentryzones = Zones::find()->where(['zone_id'=>$default_user_address['entry_zone_id']])->asArray()->one();
            $orders = new Orders();
            $partner_id = $userpartnerdata['id_partners'];

            $orders->ur_or_fiz = 'f';

            $orders->customers_id = $userCustomer['customers_id'];
            $orders->customers_name = $default_user_address['entry_lastname'] . ' ' . $default_user_address['entry_firstname'].' '.$default_user_address['otchestvo'] ;
            $orders->customers_groups_id = $userCustomer['customers_groups_id'];
            $orders->customers_company = $default_user_address['entry_company'];
            $orders->customers_suburb = $default_user_address['entry_suburb'];
            $orders->customers_country = $defaultentrycountry['countries_name'];
            $orders->customers_state = $defaultentryzones['zone_name'];
            $orders->customers_city = $default_user_address['entry_city'];
            $orders->customers_street_address = $default_user_address['entry_street_address'];
            if($default_user_address['entry_postcode']) {
                $orders->customers_postcode = $default_user_address['entry_postcode'];
            }else{
                $orders->customers_postcode = '000000';
            }
            $orders->customers_address_format_id = 1;
            $orders->customers_telephone = $userCustomer['customers_telephone'];
            $orders->customers_email_address = $userCustomer['customers_email_address'];

            $entrycountry = Countries::find()->where(['countries_id'=>$userOM['entry_country_id']])->asArray()->one();
            $entryzones = Zones::find()->where(['zone_id'=>$userOM['entry_zone_id']])->asArray()->one();

            $orders->delivery_adress_id =  $userOM['delivery_adress_id'];
            $orders->delivery_name = $userOM['entry_firstname'];
            $orders->delivery_lastname = $userOM['entry_lastname'];
            $orders->delivery_otchestvo = $userOM['otchestvo'];
            if($entrycountry['countries_name']){
                $orders->delivery_country = $entrycountry['countries_name'];
            }else{
                $orders->delivery_country = '176';
            }

            $orders->delivery_state = $entryzones['zone_name'];
            $orders->delivery_city = $userOM['entry_city'];

            if($userOM['entry_street_address']){
                $orders->delivery_street_address = $userOM['entry_street_address'];
            }else{
                $orders->delivery_street_address = 'Не указан';
            }

            if($userOM['entry_postcode']){
                $orders->delivery_postcode = $userOM['entry_postcode'];
            }else{
                $orders->delivery_postcode = '000000';
            }

            $orders->delivery_adress_id = $userOM['address_book_id'];
            $orders->delivery_pasport_seria = $userOM['pasport_seria'];
            $orders->delivery_pasport_nomer = $userOM['pasport_nomer'];
            $orders->delivery_pasport_kogda_vidan = $userOM['pasport_kogda_vidan'];
            $orders->delivery_pasport_kem_vidan = $userOM['pasport_kem_vidan'];
            $orders->delivery_address_format_id = 1;
            $orders->shipping_module = $ship;



            $payentrycountry = Countries::find()->where(['countries_id'=>$pay_user_address['entry_country_id']])->asArray()->one();
            $payentryzones = Zones::find()->where(['zone_id'=>$pay_user_address['entry_zone_id']])->asArray()->one();


            if($pay_user_address['entry_lastname']) {
                $orders->billing_name = $pay_user_address['entry_lastname'] . ' ' . $pay_user_address['entry_firstname'] . ' ' . $pay_user_address['otchestvo'];
            }else{
                $orders->billing_name = $orders->customers_name;

            }

            if($payentrycountry['countries_name']) {
                $orders->billing_country = $payentrycountry['countries_name'];
            }else{
                $orders->billing_country =   $orders->customers_country;

            }

            if($payentryzones['zone_name']) {
                $orders->billing_state = $payentryzones['zone_name'];
            }else{
                $orders->billing_state =   $orders->customers_state;

            }

            if($payentryzones['zone_name']) {
                $orders->billing_state = $payentryzones['zone_name'];
            }else{
                $orders->billing_state =   $orders->customers_state;

            }

            if($pay_user_address['entry_city']) {
                $orders->billing_city =   $pay_user_address['entry_city'];
            }else{
                $orders->billing_city =     $orders->customers_city;

            }

            if($pay_user_address['entry_street_address']) {
                $orders->billing_street_address =    $pay_user_address['entry_street_address'];
            }else{
                $orders->billing_street_address =      $orders->customers_street_address;

            }

            if($pay_user_address['entry_postcode']) {
                $orders->billing_postcode =    $pay_user_address['entry_postcode'];
            }else{
                $orders->billing_postcode =      $orders->customers_postcode;

            }


            $orders->billing_address_format_id = 1;


            $orders->customers_referer_url = 'ompartnernew';
            $orders->currency = 'RUR';
            $orders->currency_value = '1.000000';
            $orders->last_modified = $nowdate;
            $orders->date_purchased = $nowdate;
            $orders->date_akt = $nowdate;
            $orders->nomer_akt =   '0';
            $orders->orders_date_finished = 0;
            $orders->payment_info = '';
            $orders->orders_status = 1;
            $orders->site_side_email_flag = 1;
            $orders->print_torg = 'b';
            $orders->default_provider = $userCustomer['default_provider'];
            $orders->payment_method = 'Оплата <font size="4" color="red">Для физических лиц</font>';
            $buh_id = Orders::find()->where(['default_provider' => $userCustomer['default_provider']])->andWhere('DATE_FORMAT(date_purchased, "%y")='.date("y"))->orderBy('buh_orders_id DESC')->asArray()->one();
            $orders->buh_orders_id = intval($buh_id['buh_orders_id']) + 1;

            if ($orders->save()) {
                $price_total = 0;
                $reindexprod = ArrayHelper::index($proddata, 'products_id');

                foreach ($product_in_order as $keyin_order => $valuein_order) {
                    if(array_key_exists($keyin_order,$origprod)){
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

                                        if(($orderedproducts = PartnersProductsAttributes::find()->where('products_attributes.products_id = :products_id and products_attributes.options_values_id = :productattr',[':products_id'=>$keyin_order, ':productattr'=>$reindexattrdescr[$keyinattr_order]['products_options_values_id']])->one()) == TRUE) {
                                            if(empty($orderedproducts->price_prefix)){
                                                $orderedproducts->price_prefix = '-';
                                            }
                                            if(empty($orderedproducts->products_attributes_weight_prefix)){
                                                $orderedproducts->products_attributes_weight_prefix = '-';
                                            }
                                            $orderedproducts->quantity = max(0, (($orderedproducts->quantity) - ($ordersprod->products_quantity)));
                                            $orderedproducts->save();
                                        }
                                        $ordersprodattr = $ordersprodattr->toArray();


                                    } else {
//                                    print_r($ordersprodattr->errors);
//                                    die();
                                        return $this->render('cartresult', ['wrapprice'=>(integer)$wrapp['products_price'],
                                            'result' => [
                                                'code' => 0,
                                                'text' => 'Ошибка оформления позиции ' . $reindexprod[$keyin_order]['products_model'],
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
                                    if(($orderedproductsquantyty = PartnersProducts::find()->where('products.products_id = :products_id ',[':products_id'=>$keyin_order])->one())== TRUE){
                                        $orderedproductsquantyty->products_quantity = max(0,(($orderedproductsquantyty->products_quantity) - ($ordersprod->products_quantity)));
                                        $orderedproductsquantyty->products_last_modified = $nowdate;
                                        $orderedproductsquantyty->products_ordered = $orderedproductsquantyty->products_ordered+$orderedproductsquantyty->products_quantity;
                                        $orderedproductsquantyty->save();
                                    }


                                }
                                $validproduct[] = [$ordersprod->toArray(), $ordersprodattr];
                                $price_total += (float)($price_total) + $ordersprod->products_price * $ordersprod->products_quantity;

                            } else {
                                return $this->render('cartresult', [
                                    'result' => [
                                        'code' => 0,
                                        'text' => 'Ошибка оформления продукта' . $reindexprod[$keyin_order]['products_model'],
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
                ];
                if (!$dostavka[$ship]) {
                    $dostavka[$ship] = 'Партнерская доставка';
                }
                $orderstotalprice->title = $dostavka[$ship];
                $orderstotalprice->text = '0.00 руб';
                $orderstotalprice->value = '0.0000';
                $orderstotalprice->class = 'ot_shipping';
                $orderstotalprice->sort_order = 2;
                if($orderstotalprice->save()){

                }else{
                    return $this->render('cartresult', [
                        'result'=>  [
                            'code' => 0,
                            'text'=>'Ошибка оформления заказа',
                            'data'=>[
                                'paramorder'=>[
                                ],
                                'origprod' => $origprod,
                                'timeproduct'=>$related,
                                'totalpricesaveproduct'=>$validprice
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
                if($orderstotalship->save()){

                }else{
                    return $this->render('cartresult', [
                        'result'=>  [
                            'code' => 0,
                            'text'=>'Ошибка оформления заказа',
                            'data'=>[
                                'paramorder'=>[
                                ],
                                'origprod' => $origprod,
                                'timeproduct'=>$related,
                                'totalpricesaveproduct'=>$validprice
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
                if($orderstotalprint->save()){

                }else{
                    return $this->render('cartresult', [
                        'result'=>  [
                            'code' => 0,
                            'text'=>'Ошибка оформления заказа',
                            'data'=>[
                                'paramorder'=>[
                                ],
                                'origprod' => $origprod,
                                'timeproduct'=>$related,
                                'totalpricesaveproduct'=>$validprice
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
                if($neworderpartner->save()){

                }else{
                    return $this->render('cartresult', [
                        'result'=>  [
                            'code' => 0,
                            'text'=>'Ошибка оформления заказа',
                            'data'=>[
                                'paramorder'=>[
                                ],
                                'origprod' => $origprod,
                                'timeproduct'=>$related,
                                'totalpricesaveproduct'=>$validprice
                            ]
                        ]
                    ]);
                }

                $ordershistory = new OrdersStatusHistory();
                $ordershistory->orders_id = $orders->orders_id;
                $ordershistory->orders_status_id = '1';
                $ordershistory->date_added = $nowdate;
                $ordershistory->customer_notified = '0';
                if(($ordercomments = $this->trim_tags_text(Yii::$app->request->post('ordercomments'), 300)) == TRUE){
                    $ordershistory->comments = $ordercomments;
                }else{
                    $ordershistory->comments = NULL;
                }
//                if($type_order == 'plus'){
//                    $ordershistory->comments .= ' Авто-комментарий - Дозаказ к заказу №'. (integer)Yii::$app->request->post('plusorders');
//                }
                if($wrap == 'boxes'){
                    $ordershistory->comments .= ' Авто-комментарий - Упаковка: крафт коробки. ';
                }
                $ordershistory->comments .= ' Заказ с нового фронта';
                $ordershistory->validate();
                if($ordershistory->save()){

                }else{
                    return $this->render('cartresult', [
                        'result'=>  [
                            'code' => 0,
                            'text'=>'Ошибка оформления заказа',
                            'data'=>[
                                'paramorder'=>[
                                ],
                                'origprod' => $origprod,
                                'timeproduct'=>$related,
                                'totalpricesaveproduct'=>$validprice
                            ]
                        ]
                    ]);
                }

            } else {
                return $this->render('cartresult', [
                    'result'=>  [
                        'code' => 0,
                        'text'=>'Ошибка оформления заказа',
                        'data'=>[
                            'paramorder'=>[
                            ],
                            'origprod' => $origprod,
                            'timeproduct'=>$related,
                            'totalpricesaveproduct'=>$validprice
                        ]
                    ]
                ]);
            }

            $transaction->commit('suc');
            Yii::$app->mailer->compose(['html' => 'orderom-save'], ['wrapprice'=>(integer)$wrapp['products_price'],
                'result'=>  [
                    'code' => 200,
                    'text'=>'<div style="font-size: xx-large; padding-left: 10px;">Ваш заказ в магазине Одежда-Мастер оформлен</div>',
                    'data'=>[
                        'paramorder'=>[
                            'delivery' => $dostavka[$ship],
                            'number'=> $orders->orders_id,
                            'date' => $orders->date_purchased,
                            'wrap' => $wrap,
                            'name' => $orders->customers_name,
                            'telephone' => $orders->customers_telephone,
                            'email' => $orders->customers_email_address,
                        ],
                        'saveproduct'=>$validproduct,
                        'origprod' => $origprod,
                        'timeproduct'=>$related,
                        'totalpricesaveproduct'=>$validprice
                    ]
                ]
            ])
                ->setFrom('support@' . $_SERVER['HTTP_HOST'])
                ->setTo('desure85@gmail.com')
                ->setSubject('Новый заказ"')
                ->send();
            Yii::$app->session->set('order-succes', ['wrapprice'=>(integer)$wrapp['products_price'],
                'result'=>  [
                    'code' => 200,
                    'text'=>'Спасибо, Ваш заказ оформлен',
                    'data'=>[
                        'paramorder'=>[
                            'delivery' => $dostavka[$ship],
                            'number'=> $orders->orders_id,
                            'date' => $orders->date_purchased,
                            'wrap' => $wrap,
                            'name' => $orders->customers_name,
                            'telephone' => $orders->customers_telephone,
                            'email' => $orders->customers_email_address,
                        ],
                        'saveproduct'=>$validproduct,
                        'origprod' => $origprod,
                        'timeproduct'=>$related,
                        'totalpricesaveproduct'=>$validprice
                    ]
                ]
            ]);
            return header('location: '.BASEURL.'/cartresult');

        } catch (\Exception $e) {
            Yii::$app->mailer->compose()
                ->setFrom('support@newodezhdamaster.com')
                ->setTo('desure85@gmail.com')
                ->setSubject('Ошибка оформления')
                ->setTextBody(

                    $orders->orders_id.'/////'.
                    $e->getCode().'/////'.
                    $e->getFile().'/////'.
                    $e->getLine().'/////'.
                    $e->getMessage().'/////'.
                    $e->getTrace().'/////'.
                    $e->getPrevious()
                )
                ->send();
            $transaction->rollBack();
        }
//        echo'<pre>';
//        print_r($orders->errors);
//        echo '</pre>';
//        die();
        return $this->redirect(Yii::$app->request->referrer);
    }
}