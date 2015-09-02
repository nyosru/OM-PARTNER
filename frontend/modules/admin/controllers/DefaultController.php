<?php

namespace app\modules\admin\controllers;


use common\models\OrdersTotal;
use common\models\PartnersOrders;
use common\models\PartnersProducts;
use common\models\PartnersUsersInfo;
use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Partners;
use common\models\AddressBook;
use common\models\Customers;
use common\models\CustomersInfo;
use common\models\Orders;
use common\models\OrdersProducts;
use common\models\OrdersProductsAttributes;
use common\models\OrdersHistory;
use common\models\Countries;
use common\models\Zones;
use common\models\OrdersStatus;




class DefaultController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'requestsettings', 'requestusers', 'requestorders', 'delegate'],
                        'allow' => true,
                        'roles' => ['admin'],

                    ],
                ]
            ]
        ];
    }

    private function id_partners()
    {
        $run = new Partners();
        $check = $run->GetId($_SERVER['HTTP_HOST']);
        return $check;
    }

    public function actions()
    {
        $this->layout = 'main';
        return 'Админка';
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRequestsettings()
    {

    }

    public function actionRequestusers()
    {
        $check = $this->id_partners();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = User::find()->select('username, email, created_at, updated_at')->where('id_partners=' . $check)->asArray()->all();
        return $query;
    }

    public function actionRequestorders()
    {
        $model = new PartnersOrders();
        $check = $this->id_partners();
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = $model->find()->where(['partners_id' => $check])->asArray()->all();
        $orders_status_arr = OrdersStatus::find()->asArray()->all();
        foreach($orders_status_arr as $valueos){
            $orders_status[$valueos[0]] = $valueos[1];
        }
        $check = array();
        foreach ($query as $key => $value) {
            $query[$key]['order'] = unserialize($value['order']);
            unset($query[$key]['order'][ship]);
            $query[$key]['delivery'] = unserialize($value['delivery']);
            if($value['orders_id'] != '' and $value['orders_id'] != NULL){$check[]= $value['orders_id'];};

        }

       if(count($check) > 1){
        $checkstr = implode(',', $check);
    }elseif(count($check) == 1){
        $checkstr = $check[0];
    }
        if($checkstr != '') {
            $orders = new Orders();
            // $query[ordersatus] = $checkstr;
            $ordersatusn = $orders->find()->select('orders.`orders_id`, orders.`orders_status`, orders.`delivery_lastname`, orders.`delivery_name`,orders.`delivery_otchestvo`, orders.`delivery_postcode`, orders.`delivery_state`, orders.`delivery_country`, orders.`delivery_state`, orders.`delivery_city`, orders.`delivery_street_address`, orders.`customers_telephone`')->where('orders.`orders_id` IN (' . $checkstr . ')')->joinWith('products')->joinWith('productsAttr')->asArray()->all();
           foreach( $ordersatusn as $valuesn){
                $valuesn = $orders_status;
           }

            foreach ($query as $key => $value) {
                $query[ordersatus][$ordersatusn[$key][orders_id]] = $ordersatusn[$key];
                $query[ordersatus][$ordersatusn[$key][orders_status]] =  $ordersatusn[$key];
            }
        }

        return $query;
    }

    public function actionDelegate()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $data = intval(Yii::$app->request->post('id'));
            $self = intval(Yii::$app->request->post('self'), 0);
            $ordersdata = new PartnersOrders();
            $userpartnerdata = new User();
            $userdata = new PartnersUsersInfo();
            $ordersparam = $ordersdata->find()->where(['id' => $data])->asArray()->one();
            $userparam = $userdata->find()->where(['id' => $ordersparam['user_id']])->asArray()->one();
            $userpartnersparam = $userpartnerdata->find()->select('email')->where(['id' => $ordersparam['user_id']])->asArray()->one();


                if ($userparam['customer_id'] == '') {
                    $country = new Countries();
                    $zones = new Zones();
                    $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $userparam['country']])->asArray()->one();
                    $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $userparam['state']])->asArray()->one();
                    $userOM = new AddressBook();
                    $userCustomer = new Customers();
                    $check_email = $userCustomer->find()->where(['customers_email_address' => $userpartnersparam[email]])->asArray()->one();
                    if (!$check_email) {
                        $userOM->entry_firstname = $userparam[name];
                        $userOM->entry_lastname = $userparam[lastname];
                        $userOM->entry_city = $userparam[city];
                        $userOM->entry_street_address = $userparam[adress];
                        $userOM->otchestvo = $userparam[secondname];
                        $userOM->pasport_seria = $userparam[pasportser];
                        $userOM->pasport_nomer = $userparam[pasportnum];
                        $userOM->pasport_kem_vidan = $userparam[pasportwhere];
                        $userOM->pasport_kogda_vidan = $userparam[pasportdate];
                        $userOM->entry_postcode = $userparam[postcode];
                        $userOM->entry_gender = 'M';
                        $userOM->entry_country_id = $entrycountry['id'];
                        $userOM->entry_zone_id = $entryzones['id'];
                        if ($userOM->save()) {
                            $userCustomer->customers_firstname = $userparam[name];
                            $userCustomer->customers_lastname = $userparam[lastname];
                            $userCustomer->customers_email_address = $userpartnersparam[email];
                            $userCustomer->customers_default_address_id = $userOM->GetId();
                            $userCustomer->customers_selected_template = '1';
                            $userCustomer->customers_telephone = $userparam[telephone];
                            $password = $userpartnersparam[password_hash];
                            for ($i = 0; $i < 10; $i++) {
                                $password .= rand(0, 10);
                            }
                            $salt = substr(md5($password), 0, 2);
                            $password = md5($salt . $password) . ':' . $salt;
                            $userCustomer->customers_password = $password;
                            $userCustomer->customers_newsletter = '1';
                            $userCustomer->delivery_adress_id = $userOM->GetId();
                            $userCustomer->delivery_adress_id = $userOM->GetId();
                            $userCustomer->pay_adress_id = $userOM->GetId();
                            if ($userCustomer->save()) {
                                $customer_id = $userCustomer->GetId();
                                $userOM->customers_id = $customer_id;
                                $userOM->update();
                                if ($customer_id % 2 == 0) {
                                    $userCustomer->default_provider = 1;
                                    $userCustomer->update();
                                } else {
                                    $userCustomer->default_provider = 2;
                                    $userCustomer->update();
                                }
                                $userCustomerInfo = new CustomersInfo();
                                $userCustomerInfo->customers_info_id = $customer_id;
                                $userCustomerInfo->customers_info_date_account_created = date("Y-m-d h:i:s");
                                if ($userCustomerInfo->save()) {
                                    $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam[id]);
                                    $newuserpartnerscastid->customers_id = $customer_id;
                                    $newuserpartnerscastid->update();
                                } else {
                                    return false;
                                }
                            } else {

                                return false;
                            }
                        } else {
                            return false;
                        }
                    } else {
                        $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam[id]);
                        $customer_id = $newuserpartnerscastid->customers_id;
                    }
                }

            if (intval($self) !== 0) {
                $run = new Partners();
                $check = $run->GetId($_SERVER['HTTP_HOST']);
                $custompartnersid = Partners::findOne($check);
                $customer_id_delivery = $custompartnersid->customers_id;
            }

            if ($customer_id !== '' and $ordersparam[orders_id] == '') {
                if ($userCustomer->GetId()) {

                } else {
                    $userCustomer = Customers::findOne($customer_id);
                    $userOM = AddressBook::findOne($userCustomer->delivery_adress_id);
                }
                $entrycountry = Countries::findOne($userOM->entry_country_id);
                $entryzones = Zones::findOne($userOM->entry_zone_id);
                $orders = new Orders();
                $orderforsavedata = PartnersOrders::findOne($data);
                $partner_id = $orderforsavedata->partners_id;
                $partner_user_id = $orderforsavedata->user_id;
                $partnerorder = unserialize($orderforsavedata->order);
                $ship = $partnerorder[ship];
                unset($partnerorder[ship]);
                //  $partnerdelivery = unserialize($orderforsavedata->delivery); //may-be понадобится для сверки адреса
                $orders->ur_or_fiz = 'f';
                $orders->customers_id = $userCustomer->customers_id;
                $orders->customers_name = $userCustomer->customers_firstname . ' ' . $userCustomer->customers_lastname;
                $orders->customers_groups_id = 1;
                $orders->customers_country = $entrycountry->countries_name;
                $orders->customers_state = $entryzones->zone_name;
                $orders->customers_city = $userOM->entry_city;
                $orders->customers_street_address = $userOM->entry_street_address;
                $orders->customers_postcode = $userOM->entry_postcode;
                $orders->customers_address_format_id = 1;
                $orders->customers_telephone = $userCustomer->customers_telephone;
                $orders->customers_email_address = $userCustomer->customers_email_address;
                if(isset($customer_id_delivery)){
                    $userCustomerDelivery = AddressBook::findOne(Customers::findOne($customer_id_delivery)->delivery_adress_id);
                    $entrycountrydelivery = Countries::findOne($userCustomerDelivery->entry_country_id);
                    $entryzonesdelivery = Zones::findOne($userCustomerDelivery->entry_zone_id);
                    $orders->delivery_name = $userCustomerDelivery->entry_firstname;
                    $orders->delivery_lastname = $userCustomerDelivery->entry_lastname;
                    $orders->delivery_otchestvo = $userCustomerDelivery->otchestvo;
                    $orders->delivery_country = $entrycountrydelivery->countries_name;
                    $orders->delivery_state = $entryzonesdelivery->zone_name;
                    $orders->delivery_city = $userCustomerDelivery->entry_city;
                    $orders->delivery_street_address = $userCustomerDelivery->entry_street_address;
                    $orders->delivery_postcode = $userCustomerDelivery->entry_postcode;
                    $orders->delivery_adress_id = $userCustomerDelivery->id;
                    $orders->delivery_pasport_seria = $userCustomerDelivery->pasport_seria;
                    $orders->delivery_pasport_nomer = $userCustomerDelivery->pasport_nomer;
                    $orders->delivery_pasport_kogda_vidan = $userCustomerDelivery->pasport_kogda_vidan;
                    $orders->delivery_pasport_kem_vidan = $userCustomerDelivery->pasport_kem_vidan;
                    $orders->delivery_address_format_id = 1;
                    $orders->shipping_module = $ship;
                }else {
                    $orders->delivery_name = $userOM->entry_firstname;
                    $orders->delivery_lastname = $userOM->entry_lastname;
                    $orders->delivery_otchestvo = $userOM->otchestvo;
                    $orders->delivery_country = $entrycountry->countries_name;
                    $orders->delivery_state = $entryzones->zone_name;
                    $orders->delivery_city = $userOM->entry_city;
                    $orders->delivery_street_address = $userOM->entry_street_address;
                    $orders->delivery_postcode = $userOM->entry_postcode;
                    $orders->delivery_adress_id = $userOM->id;
                    $orders->delivery_pasport_seria = $userOM->pasport_seria;
                    $orders->delivery_pasport_nomer = $userOM->pasport_nomer;
                    $orders->delivery_pasport_kogda_vidan = $userOM->pasport_kogda_vidan;
                    $orders->delivery_pasport_kem_vidan = $userOM->pasport_kem_vidan;
                    $orders->delivery_address_format_id = 1;
                    $orders->shipping_module = $ship;
                }
                $orders->billing_name = $userCustomer->customers_firstname . ' ' . $userCustomer->customers_lastname;
                $orders->billing_country = $entrycountry->countries_name;
                $orders->billing_state = $entryzones->zone_name;
                $orders->billing_city = $userOM->entry_street_address;
                $orders->billing_street_address = $userOM->entry_street_address;
                $orders->billing_postcode = $userOM->entry_postcode;
                $orders->billing_address_format_id = 1;
                $orders->customers_referer_url = '{"Partner":' . $partner_id . ',"User":' . $partner_user_id . '}';
                $orders->currency = 'RUR';
                $orders->currency_value = '1.000000';
                $orders->last_modified = date("Y-m-d h:i:s");
                $orders->date_purchased = date("Y-m-d h:i:s");
                $orders->date_akt = date("Y-m-d h:i:s");
                $orders->payment_info = '';
                $orders->orders_status = 1;
                $orders->default_provider = $userCustomer->default_provider;
                $orders->payment_method = 'Оплата <font size="4" color="red">Для физических лиц</font>';
                $buh_id = Orders::find()->where(['default_provider' => $userCustomer->default_provider])->orderBy('orders_id DESC')->one();
                $orders->buh_orders_id = intval($buh_id->buh_orders_id) + 1;
                if ($orders->save()) {
                    $price_total = '';
                    foreach ($partnerorder as $value) {
                        $ordersprod = new OrdersProducts();
                        $prod = new PartnersProducts();
                        $proddata = $prod->find()->where(['products.`products_id`' => $value[0], 'products_options_values.`products_options_values_id`' => $value[2]])->JoinWith('productsDescription')->JoinWith('productsAttributes')->JoinWith('productsAttributesDescr')->groupBy('products.`products_id`')->asArray()->one();
                        if (!$proddata) {
                            $proddata = $prod->find()->where(['products.`products_id`' => $value[0]])->JoinWith('productsDescription')->groupBy('products.`products_id`')->asArray()->one();
                        }
                        $ordersprod->first_quant = intval($value[4]);
                        $ordersprod->products_quantity = intval($value[4]);
                        $ordersprod->orders_id = $orders->GetId();
                        $ordersprod->products_id = intval($value[0]);
                        $ordersprod->products_model = $proddata[products_model];
                        $ordersprod->products_name = $proddata[productsDescription][products_name];
                        $ordersprod->final_price = $proddata[products_price];
                        $ordersprod->products_price = $proddata[products_price];
                        $ordersprod->price_coll = $proddata[price_coll];
                        $ordersprod->products_status = $proddata[products_status];
                        $price_total += $price_total + $ordersprod[products_price] * $ordersprod->products_quantity;
                        if ($ordersprod->save()) {
                            if ($proddata[productsAttributes][products_attributes_id]) {
                                $ordersprodattr = new OrdersProductsAttributes();
                                $ordersprodattr->orders_products_id = $ordersprod->GetId();
                                $ordersprodattr->orders_id = $orders->GetId();
                                $ordersprodattr->products_options = 'Размер';
                                $ordersprodattr->products_options_values = $value[6];
                                $ordersprodattr->options_values_price = '0.0000';
                                $ordersprodattr->vid = $value[2];
                                $ordersprodattr->oid = '1';
                                $ordersprodattr->sub_vid = 0;
                                if ($ordersprodattr->save()) {
                                } else {
                                    return false;
                                }
                            } else {
                            }
                        } else {
                            return false;
                        }
                    }
                    $orderstotalprice = new OrdersTotal();
                    $orderstotalprice->orders_id = $orders->GetId();
                    $dostavka = ['flat1_flat1' => 'Бесплатная доставка до ТК Деловые Линии', 'flat2_flat2' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция', 'flat3_flat3' => 'Бесплатная доставка до ТК ПЭК', 'flat7_flat7' => 'Почта ЕМС России',];
                    $orderstotalprice->title = $dostavka[$ship];
                    $orderstotalprice->text = '0.00 руб';
                    $orderstotalprice->value = '0.0000';
                    $orderstotalprice->class = 'ot_shipping';
                    $orderstotalprice->sort_order = 2;
                    $orderstotalprice->save();
                    $orderstotalship = new OrdersTotal();
                    $orderstotalship->orders_id = $orders->GetId();
                    $orderstotalship->title = 'Всего: ';
                    $orderstotalship->text = '<b>' . $price_total . ' руб.</b>';
                    $orderstotalship->value = $price_total;
                    $orderstotalship->class = 'ot_total';
                    $orderstotalship->sort_order = 800;
                    $orderstotalship->save();
                    $orderstotalprint = new OrdersTotal();
                    $orderstotalprint->orders_id = $orders->GetId();
                    $orderstotalprint->title = 'Стоимость товара: ';
                    $orderstotalprint->text = $price_total . ' руб.';
                    $orderstotalprint->value = $price_total;
                    $orderstotalprint->class = 'ot_subtotal';
                    $orderstotalprint->sort_order = 1;
                    $orderstotalprint->save();
                    $neworderpartner = PartnersOrders::findOne($ordersparam[id]);
                    $neworderpartner->orders_id = $orders->GetId();
                    $neworderpartner->update_date = date("Y-m-d H:i:s");
                    $neworderpartner->update();
                } else {
                    return false;
                }
            } else {
                return false;
            }
            $transaction->commit('suc');
        } catch (Exception $e) {
         $transaction->rollBack();

}
}
}
