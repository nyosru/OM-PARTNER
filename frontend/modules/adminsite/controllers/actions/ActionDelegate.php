<?php
namespace frontend\modules\adminsite\controllers\actions;

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

trait ActionDelegate
{
    public function actionDelegate()
    {
        $data = (integer)(Yii::$app->request->getQueryParam('id'));
        $self = (integer)(Yii::$app->request->getQueryParam('self'));
        $ordersdata = new PartnersOrders();
        $userpartnerdata = new User();
        $userdata = new PartnersUsersInfo();
        $ordersparam = $ordersdata->find()->where(['id' => $data])->asArray()->one();
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $userparam = $userdata->find()->where(['id' => $ordersparam['user_id']])->asArray()->one();
            $userpartnersparam = $userpartnerdata->find()->select('email,id_partners')->where(['id' => $ordersparam['user_id']])->asArray()->one();
            if ($userparam['customer_id'] == '') {
                $country = new Countries();
                $zones = new Zones();
                $entrycountry = $country->find()->select('countries_id as id')->where(['countries_name' => $userparam['country']])->asArray()->one();
                $entryzones = $zones->find()->select('zone_id as id')->where(['zone_name' => $userparam['state']])->asArray()->one();
                $userOM = new AddressBook();
                $userCustomer = new Customers();
                $partner = Partners::findOne($userpartnersparam['id_partners']);
                $check_email = $userCustomer->find()->where(['customers_email_address' => 'partnerom' . $partner->id . '@@@' . $userpartnersparam['email']])->asArray()->one();
                if (!$check_email) {
                    $userOM->entry_firstname = $userparam['name'];
                    $userOM->entry_lastname = $userparam['lastname'];
                    $userOM->entry_city = $userparam['city'];
                    $userOM->entry_street_address = $userparam['adress'];
                    $userOM->otchestvo = $userparam['secondname'];
                    $userOM->pasport_seria = $userparam['pasportser'];
                    $userOM->pasport_nomer = $userparam['pasportnum'];
                    $userOM->pasport_kem_vidan = $userparam['pasportwhere'];
                    if (isset($userparam['pasportdate'])) {
                        $userOM->pasport_kogda_vidan = $userparam['pasportdate'];
                    } else {
                        $userOM->pasport_kogda_vidan = date('Y-m-d H:i:s');
                    }
                    $userOM->entry_postcode = $userparam['postcode'];
                    $userOM->entry_gender = 'M';
                    $userOM->entry_country_id = $entrycountry['id'];
                    $userOM->entry_zone_id = $entryzones['id'];
                    if ($userOM->save()) {
                        $userCustomer->customers_firstname = $userparam['name'];
                        $userCustomer->customers_lastname = $userparam['lastname'];
                        $userCustomer->customers_email_address = 'partnerom' . $partner->id . '@@@' . $userpartnersparam['email'];
                        $userCustomer->customers_default_address_id = $userOM->address_book_id;
                        $userCustomer->customers_selected_template = '1';
                        $userCustomer->customers_telephone = $userparam['telephone'];
                        $password = $userpartnersparam['password_hash'];
                        for ($i = 0; $i < 10; $i++) {
                            $password .= rand(0, 10);
                        }
                        $salt = substr(md5($password), 0, 2);
                        $password = md5($salt . $password) . ':' . $salt;
                        $userCustomer->customers_password = $password;
                        $userCustomer->customers_newsletter = '1';
                        $userCustomer->delivery_adress_id = $userOM->address_book_id;
                        $userCustomer->pay_adress_id = $userOM->address_book_id;
                        if ($userCustomer->save()) {
                            $customer_id = $userCustomer->customers_id;
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
                            $userCustomerInfo->customers_info_date_account_created = date("Y-m-d H:i:s");
                            if ($userCustomerInfo->save()) {
                                $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam['id']);
                                $newuserpartnerscastid->customers_id = $customer_id;
                                $newuserpartnerscastid->update();
                            } else {
                                return $userCustomerInfo;
                            }
                        } else {

                            return $userCustomer;
                        }
                    } else {
                        return $userOM;
                    }
                } else {

                    $newuserpartnerscastid = PartnersUsersInfo::findOne($userparam['id']);
                    $customer_id = $newuserpartnerscastid->customers_id;

                }
            }

            if (($self) !== 0) {

                $check = Yii::$app->params['constantapp']['APP_ID'];
                $custompartnersid = Partners::findOne($check);
                $customer_id_delivery = $custompartnersid->customers_id;
            }
            if ($customer_id !== '' and $ordersparam['orders_id'] == '') {
                if ($userCustomer->customers_id) {

                } else {
                    $userCustomer = Customers::findOne($customer_id);
                    $userOM = AddressBook::findOne($userCustomer->delivery_adress_id);
                }
                $entrycountry = Countries::findOne($userOM->entry_country_id);
                $entryzones = Zones::findOne($userOM->entry_zone_id);
                $orders = new Orders();
                $orderforsavedata = $ordersparam;
                $partner_id = $orderforsavedata['partners_id'];
                $partner_user_id = $orderforsavedata['user_id'];
                $partnerorder = unserialize($orderforsavedata['order']);
                $ship = $partnerorder['ship'];
                $discount = $partnerorder['discount'];
                unset($partnerorder['ship'], $partnerorder['discount'], $partnerorder['discounttotalprice'], $partnerorder['paymentmethod']);
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
                if (isset($customer_id_delivery)) {
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
                    $orders->delivery_adress_id = $userCustomerDelivery->address_book_id;
                    $orders->delivery_pasport_seria = $userCustomerDelivery->pasport_seria;
                    $orders->delivery_pasport_nomer = $userCustomerDelivery->pasport_nomer;
                    $orders->delivery_pasport_kogda_vidan = $userCustomerDelivery->pasport_kogda_vidan;
                    $orders->delivery_pasport_kem_vidan = $userCustomerDelivery->pasport_kem_vidan;
                    $orders->delivery_address_format_id = 1;
                    $orders->shipping_module = 'Партнерская доставка';
                } else {
                    $orders->delivery_name = $userOM->entry_firstname;
                    $orders->delivery_lastname = $userOM->entry_lastname;
                    $orders->delivery_otchestvo = $userOM->otchestvo;
                    $orders->delivery_country = $entrycountry->countries_name;
                    $orders->delivery_state = $entryzones->zone_name;
                    $orders->delivery_city = $userOM->entry_city;
                    $orders->delivery_street_address = $userOM->entry_street_address;
                    $orders->delivery_postcode = $userOM->entry_postcode;
                    $orders->delivery_adress_id = $userOM->address_book_id;
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
                $validkey = '';
                $char = "QWERTYUPASDFGHJKLZXCVBNMqwertyuopasdfghjkzxcvbnm123456789";
                $site = $_SERVER['HTTP_HOST'];
                while (strlen($validkey) < 20) {
                    $validkey .= $char[mt_rand(0, strlen($char))];
                }

                $orders->customers_referer_url = '{"Partner":' . $partner_id . ',"User":' . $partner_user_id . ',"Key":"' . $validkey . '","Site":"' . $site . '"}';
                $orders->currency = 'RUR';
                $orders->currency_value = '1.000000';
                $orders->last_modified = date("Y-m-d H:i:s");
                $orders->date_purchased = date("Y-m-d H:i:s");
                $orders->date_akt = date("Y-m-d H:i:s");
                $orders->payment_info = '';
                $orders->orders_status = 1;
                $orders->site_side_email_flag = 0;
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
                        $ordersprod->orders_id = $orders->orders_id;
                        $ordersprod->products_id = intval($value[0]);
                        $ordersprod->products_model = $proddata['products_model'];
                        $ordersprod->products_name = $proddata['productsDescription']['products_name'];
                        $ordersprod->final_price = $proddata['products_price'];
                        $ordersprod->products_price = $proddata['products_price'];
                        $ordersprod->price_coll = $proddata['price_coll'];
                        $ordersprod->products_status = 0;
                        $price_total += intval($price_total) + $ordersprod['products_price'] * $ordersprod->products_quantity;
                        if ($ordersprod->save()) {
                            if ($proddata['productsAttributes']['products_attributes_id']) {
                                $ordersprodattr = new OrdersProductsAttributes();
                                $ordersprodattr->orders_products_id = $ordersprod->orders_products_id;
                                $ordersprodattr->orders_id = $orders->orders_id;
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
                            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                            return $partnerorder;
                        }
                    }
                    $orderstotalprice = new OrdersTotal();
                    $orderstotalprice->orders_id = $orders->orders_id;
                    $dostavka = ['flat1_flat1' => 'Бесплатная доставка до ТК Деловые Линии', 'flat2_flat2' => 'Бесплатная доставка до ТК ЖелДорЭкспедиция', 'flat3_flat3' => 'Бесплатная доставка до ТК ПЭК', 'flat7_flat7' => 'Почта ЕМС России',];
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
                    $neworderpartner = PartnersOrders::findOne($ordersparam['id']);
                    $neworderpartner->orders_id = $orders->orders_id;
                    if ($self == 0) {
                        $neworderpartner->status = 20;
                    } elseif ($self == 1) {
                        $neworderpartner->status = 10;
                    }
                    $neworderpartner->update_date = date("Y-m-d H:i:s");
                    $neworderpartner->update();
                } else {
                    $orders->errors;
                }
            } else {
                return false;
            }
            $transaction->commit('suc');
        } catch (Exception $e) {
            $transaction->rollBack();

        }


        return $this->redirect(Yii::$app->request->referrer);
    }
}