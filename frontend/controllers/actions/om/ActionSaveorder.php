<?php

namespace frontend\controllers\actions\om;


use common\models\OrdersStatusHistory;
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

        $userpartnerdata = $user;
        $userdata = $user['userinfo'];
        $userCustomer = $user['customers'];

        echo'<pre>';
        print_r($user);
            echo'</pre>';
        die();
        $product_in_order = Yii::$app->request->post('product');
//        echo '<pre>';
//        print_r(Yii::$app->request->post());
//        echo '<pre>';
        //die();
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




        if($validprice < 5000){
            return $this->render('cartresult', [
                'result'=>  [
                    'code' => 0,
                    'text'=>'Минимальная сумма заказа 5000р',
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
            $entrycountry = Countries::find()->where(['countries_id'=>$userOM['entry_country_id']])->asArray()->one();
            $entryzones = Zones::find()->where(['zone_id'=>$userOM['entry_zone_id']])->asArray()->one();
            $orders = new Orders();
            $partner_id = $userpartnerdata['id_partners'];
            $ship = Yii::$app->request->post('ship');
            $orders->ur_or_fiz = 'f';


            $orders->customers_id = $userCustomer['customers_id'];
            $orders->customers_name = $userCustomer['customers_firstname'] . ' ' . $userCustomer['customers_lastname'].' '.$userCustomer['otchestvo'] ;
            $orders->customers_groups_id = $userCustomer['customers_groups_id'];
            $orders->customers_company = $userOM['entry_company'];
            $orders->customers_suburb = $userOM['entry_suburb'];
            $orders->customers_country = $entrycountry['countries_name'];
            $orders->customers_state = $entryzones['zone_name'];
            $orders->customers_city = $userOM['entry_city'];
            $orders->customers_street_address = $userOM['entry_street_address'];
            $orders->customers_postcode = $userOM['entry_postcode'];
            $orders->customers_address_format_id = 1;
            $orders->customers_telephone = $userCustomer['customers_telephone'];
            $orders->customers_email_address = $userCustomer['customers_email_address'];
            $orders->customers_address_format_id = 1;


            $orders->delivery_adress_id =  $userCustomer['delivery_adress_id'];
            $orders->delivery_name = $userOM['entry_firstname'];
            $orders->delivery_lastname = $userOM['entry_lastname'];
            $orders->delivery_otchestvo = $userOM['otchestvo'];
            $orders->delivery_country = $entrycountry['countries_name'];
            $orders->delivery_state = $entryzones['zone_name'];
            $orders->delivery_city = $userOM['entry_city'];
            $orders->delivery_street_address = $userOM['entry_street_address'];
            $orders->delivery_postcode = $userOM['entry_postcode'];
            $orders->delivery_adress_id = $userOM['address_book_id'];
            $orders->delivery_pasport_seria = $userOM['pasport_seria'];
            $orders->delivery_pasport_nomer = $userOM['pasport_nomer'];
            $orders->delivery_pasport_kogda_vidan = $userOM['pasport_kogda_vidan'];
            $orders->delivery_pasport_kem_vidan = $userOM['pasport_kem_vidan'];
            $orders->delivery_address_format_id = 1;
            $orders->shipping_module = $ship;


            $orders->billing_name = $userCustomer['customers_firstname'] . ' ' . $userCustomer['customers_lastname'];
            $orders->billing_country = $entrycountry['countries_name'];
            $orders->billing_state = $entryzones['zone_name'];
            $orders->billing_city = $userOM['entry_street_address'];
            $orders->billing_street_address = $userOM['entry_street_address'];
            $orders->billing_postcode = $userOM['entry_postcode'];
            $orders->billing_address_format_id = 1;


            $orders->customers_referer_url = $_SERVER['HTTP_HOST'];
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
                echo '<pre>';
                print_r(yii::$app->request->post());
                print_r($orders);
                echo '</pre>';
                die();
                $price_total = '';
                $reindexprod = ArrayHelper::index($proddata, 'products_id');
                    foreach ($product_in_order as $keyin_order => $valuein_order) {
                            $reindexattrdescr = ArrayHelper::index($reindexprod[$keyin_order ]['productsAttributesDescr'], 'products_options_values_id');
                        foreach($valuein_order  as $keyinattr_order => $valueinattr_order){
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
                            $ordersprod->verificatiuon = 0;
                            $ordersprod->status_add = NULL;
                            $ordersprod->stickers_confirmed = 0;
                            $ordersprod->automatically_sent_to_manufacturer = 0;
                            $ordersprod->status_add = NULL;
                            $ordersprod->sub_orders_id = NULL;
                            $ordersprod->old_orders_id = NULL;
                            $ordersprod->products_tax = '0.0000';
                            $price_total += intval($price_total) +  $ordersprod->products_price * $ordersprod->products_quantity;
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
                                        $ordersprodattr =  $ordersprodattr->toArray();
                                        $validproduct[]=[$ordersprod->toArray(), $ordersprodattr];
                                   } else {

                                  }

                            } else {
                                $validproduct[]=[$ordersprod->toArray()];
                            }

                        }
//                        echo '<pre>';
//                        print_r($reindexprod);
//                     //   print_r($ordersprodattr);
//                        echo '</pre>';
//                            die();

                  //  } else {
//                        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//                        return $partnerorder;
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
                $orderstotalprice->save();
                $orderstotalship = new OrdersTotal();
                $orderstotalship->orders_id = $orders->orders_id;
                $orderstotalship->title = 'Всего: ';
                $orderstotalship->text = '<b>' . $price_total . ' руб.</b>';
                $orderstotalship->value = $price_total;
                $orderstotalship->class = 'ot_total';
                $orderstotalship->sort_order = 800;
                $orderstotalship->save();
                $orderstotalprint = new OrdersTotal();
                $orderstotalprint->orders_id = $orders->orders_id;
                $orderstotalprint->title = 'Стоимость товара: ';
                $orderstotalprint->text = $price_total . ' руб.';
                $orderstotalprint->value = $price_total;
                $orderstotalprint->class = 'ot_subtotal';
                $orderstotalprint->sort_order = 1;
                $orderstotalprint->save();
                $neworderpartner = new PartnersOrders();
                $neworderpartner->partners_id = $partner_id;
                $neworderpartner->user_id = $user['id'];
                $neworderpartner->order = 'LinkToOm';
                $neworderpartner->status = 1;
                $neworderpartner->delivery = 'LinkToOm';
                $neworderpartner->orders_id = $orders->orders_id;
                $neworderpartner->update_date = $nowdate;
                $neworderpartner->create_date = $nowdate;
                $neworderpartner->save();
                $ordershistory = new OrdersStatusHistory();
                $ordershistory->orders_id = $orders->orders_id;
                $ordershistory->orders_status_id = '1';
                $ordershistory->date_added = $nowdate;
                $ordershistory->customer_notified = '0';
                $ordershistory->comments = 'Заказ с нового фронта';
                $ordershistory->save();
//                echo '<pre>';
//var_dump($this);
//                echo '</pre>';
//                die();
            } else {

            }
            $transaction->commit('suc');

                return $this->render('cartresult', [
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

        } catch (\Exception $e) {
            $transaction->rollBack();
            echo '<pre>';
            echo  $orders->orders_id;
            echo $e->getCode();
            echo $e->getFile();
            echo $e->getLine();
            echo $e->getMessage();
            echo $e->getTrace();
            echo $e->getPrevious();
            var_dump($this);
            echo '<pre>';
            die();
        }


        return $this->redirect(Yii::$app->request->referrer);
    }
}